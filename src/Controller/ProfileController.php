<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\UserCollecting;
use App\Repository\ItemRepository;
use App\Repository\UserItemRepository;
use App\Repository\CollectingRepository;
use App\Repository\UserCollectingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(UserCollectingRepository $userCollectingRepository, UserItemRepository $userItemRepository): Response
    {

        // $userCollectingList = $userCollectingRepository->findBy(["User" => $this->getUser()]);
        $userCollectingList = $userCollectingRepository->findByUser($this->getUser());
        $userItemList = $userItemRepository->findByUser($this->getUser());
        // $items = $this->entityManager->getRepository(Item::class)->findByUser($this->getUser());
        // dd($userItemList);

        // dd($this->getUser());

        return $this->render('profile/index.html.twig', [
            'userCollectingList' => $userCollectingList,
            'userItemList' => $userItemList,
            // 'items' => $itemRepository->findByUser($this->getUser()),
        ]);
    }
}
