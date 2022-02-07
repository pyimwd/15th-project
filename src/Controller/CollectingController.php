<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemType;
use App\Entity\Collecting;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\CollectingType;
use App\Repository\CollectingRepository;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CollectingController extends AbstractController
{
    /**
     * @Route("/collectings", name="collecting", methods={"GET"})
     */
    public function index(CollectingRepository $collectingRepository): Response
    {
        $collectings = $collectingRepository->findAll();

        return $this->render('collecting/index.html.twig', [
            'collectings' => $collectings,
        ]);
    }

    /**
     * @Route("/collectings/new", name="collecting_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $collecting = new Collecting();
        $addCollectingForm = $this->createForm(CollectingType::class, $collecting);

        $addCollectingForm->handleRequest($request);

        if ($addCollectingForm->isSubmitted() && $addCollectingForm->isValid()) {
            $collecting = $addCollectingForm->getData();

            $addMessage = $collecting->getName() . ' a bien été ajouté.';

            $entityManager->persist($collecting);
            $entityManager->flush();

            $this->addFlash('success', $addMessage);

            return $this->redirectToRoute('collecting');
        }

        return $this->render('collecting/new.html.twig', [
            'addCollectingForm' => $addCollectingForm->createView()
        ]);
    }

    /**
     * @Route("/collectings/{collecting}", name="collecting_show", methods={"GET"})
     */
    public function show(Collecting $collecting, Item $item, ItemRepository $itemRepository): Response
    {

        $items = $itemRepository->findByCollecting($collecting);

        return $this->render('collecting/show.html.twig', [
            'collecting' => $collecting,
            'items' => $items,
            'item' => $item,
        ]);
    }

    /**
     * @Route("/collectings/{collecting}/edit", name="collecting_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Collecting $collecting, EntityManagerInterface $entityManager)
    {
        $updateCollectingForm = $this->createForm(CollectingType::class, $collecting);
        $updateCollectingForm->handleRequest($request);

        if ($updateCollectingForm->isSubmitted() && $updateCollectingForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('collecting', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collecting/edit.html.twig', [
            'updateCollectingForm' => $updateCollectingForm->createView(),
            'collecting' => $collecting,
        ]);
    }

    /**
     * @Route("/collectings/{id}/delete", name="collecting_delete")
     */
    public function delete(Collecting $collecting, EntityManagerInterface $entityManager, Item $item)
    {
        $deleteMessage = 'La collection ' . $collecting->getName() . ' a bien été supprimée !';

        $entityManager->remove($collecting);
        $entityManager->flush();

        $this->addFlash('danger', $deleteMessage);

        return $this->redirectToRoute('collecting');
    }

    /**
     * @Route("/collectings/{collecting}/new_item", name="collecting_new_item", methods={"GET", "POST"})
     */
    public function new_item(Collecting $collecting, Request $request, EntityManagerInterface $entityManager)
    {

        // if (!$item) {
        //     $item = new Item();
        // }

        $item = new Item();

        $item->setCollecting($collecting);

        $collectingItemForm = $this->createForm(ItemType::class, $item);

        $collectingItemForm->handleRequest($request);

        if ($collectingItemForm->isSubmitted() && $collectingItemForm->isValid()) {
            // if(!$item->getId()) {
            //     $item->setCreatedAt(new \DateTimeImmutable());
            // }

            $item = $collectingItemForm->getData();

            $addMessage = 'L\'item ' . $item->getTitle() . ' a bien été ajouté.';

            $entityManager->persist($item);
            $entityManager->flush();

            $this->addFlash('success', $addMessage);

            return $this->redirectToRoute('collecting_show', [
                'collecting' => $collecting->getId()
            ]);
        }

        return $this->render('collecting/collecting_new_item.html.twig', [
            'collecting' => $collecting,
            // 'category' => $category,
            'collectingItemForm' => $collectingItemForm->createView()
        ]);
    }

    /**
     * @Route("/collectings/{collecting}/{item}/update_item", name="collecting_update_item")
     */
    public function update_item(Collecting $collecting, Request $request, EntityManagerInterface $entityManager, Item $item, ItemRepository $itemRepository)
    {
        $updateItemForm = $this->createForm(ItemType::class, $item);

        $updateItemForm->handleRequest($request);

        if ($updateItemForm->isSubmitted() && $updateItemForm->isValid()) {

            $updateMessage = 'L\'item ' . $item->getTitle() . ' a bien été modifié.';

            $entityManager->flush();

            $this->addFlash('success', $updateMessage);

            return $this->redirectToRoute('collecting_show', [
                'collecting' => $collecting->getId()
            ]);
        }

        return $this->render('collecting/update_item.html.twig', [
            'updateItemForm' => $updateItemForm->createView(),
            'collecting'    => $collecting,
            'item'           => $item
        ]);
    }

    /**
     * @Route("/collectings/{collecting}/{item}", name="collecting_show_item")
     */
    public function show_item(Collecting $collecting, CollectingRepository $collectingRepository, Item $item, ItemRepository $itemRepository)
    {
        $item = $itemRepository->findOneById($item->getId());

        return $this->render('collecting/show_item.html.twig', [
            'collecting'    => $collecting,
            'item' => $item,
        ]);
    }

    /**
     * @Route("/collectings/{collecting}/{item}/delete_item", name="collecting_delete_item")
     */
    public function delete_item(Collecting $collecting, EntityManagerInterface $entityManager, Item $item)
    {
        $deleteMessage = 'L\'item ' . $item->getTitle() . ' a bien été supprimé !';

        $entityManager->remove($item);
        $entityManager->flush();

        $this->addFlash('danger', $deleteMessage);

        return $this->redirectToRoute('collecting_show', [
            'collecting' => $collecting->getId()
        ]);
    }
}