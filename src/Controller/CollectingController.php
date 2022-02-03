<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemType;
use App\Entity\Collecting;
use App\Entity\Category;
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

            return $this->redirectToRoute('collecting_show', [
                'collecting' => $collecting->getId()
            ]);
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
        $form = $this->createForm(CollectingType::class, $collecting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('collecting', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collecting/edit.html.twig', [
            'form' => $form->createView(),
            'collecting' => $collecting,
        ]);
    }

    /**
     * @Route("/collectings/{collecting}/delete", name="collecting_delete", methods={"POST"})
     */
    public function delete(Collecting $collecting, EntityManagerInterface $entityManager)
    {
        $deleteMessage = $collecting->getName() . ' a bien été supprimé !';

        $entityManager->remove($collecting);
        $entityManager->flush();

        $this->addFlash('success', $deleteMessage);

        return $this->redirectToRoute('collecting');
    }

    /**
     * @Route("/collectings/{collecting}/new_item", name="collecting_new_item", methods={"GET", "POST"})
     */
    public function new_item(Collecting $collecting, Request $request, EntityManagerInterface $entityManager)
    {
        $item = new Item();
        $item->setCollecting($collecting);

        $collectingItemForm = $this->createForm(ItemType::class, $item);

        $collectingItemForm->handleRequest($request);

        if ($collectingItemForm->isSubmitted() && $collectingItemForm->isValid()) {
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
}
