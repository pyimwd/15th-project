<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemType;
use App\Entity\Category;
use App\Entity\UserItem;
use App\Entity\Collecting;
use App\Form\CategoryType;
use App\Form\UserItemType;
use App\Form\CollectingType;
use App\Entity\UserCollecting;
use App\Form\UserCollectingType;
use App\Repository\ItemRepository;
use App\Repository\CollectingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class CollectingController extends AbstractController
{
    /**
     * @Route("/collectings", name="collecting", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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
     * @Route("/collectings/add_user_collecting", name="add_user_collecting", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return void
     */
    public function add_user_collecting(Request $request, EntityManagerInterface $entityManager)
    {
        $addUserCollecting = new UserCollecting();

        $addUserCollectingForm = $this->createForm(UserCollectingType::class, $addUserCollecting);

        $addUserCollectingForm->handleRequest($request);

        if ($addUserCollectingForm->isSubmitted() && $addUserCollectingForm->isValid()) {

            $addUserCollecting = $addUserCollectingForm->getData();

            $addMessage = 'You added a new collection';

            $addUserCollecting->setUser($this->getUser());

            $entityManager->persist($addUserCollecting);
            $entityManager->flush();

            $this->addFlash('success', $addMessage);

            return $this->redirectToRoute('profile');
        }

        return $this->render('collecting/add_user_collecting.html.twig', [
            'addUserCollectingForm' => $addUserCollectingForm->createView(),
        ]);
    }

    /**
     * @Route("/add_user_item", name="add_user_item", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return void
     */
    public function add_user_item(Request $request, EntityManagerInterface $entityManager)
    {
        $addUserItem = new UserItem();

        $addUserItemForm = $this->createForm(UserItemType::class, $addUserItem);

        $addUserItemForm->handleRequest($request);

        if ($addUserItemForm->isSubmitted() && $addUserItemForm->isValid()) {

            $addUserItem = $addUserItemForm->getData();

            // dd($addUserItem);

            $addMessage = 'You added a new item';

            $addUserItem->setUser($this->getUser());

            $entityManager->persist($addUserItem);
            $entityManager->flush();

            $this->addFlash('success', $addMessage);

            // return $this->redirectToRoute('profile');
        }

        return $this->render('collecting/add_user_item.html.twig', [
            'addUserItemForm' => $addUserItemForm->createView(),
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
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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

            // dd($collectingItemForm);

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
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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
