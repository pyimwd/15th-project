<?php

namespace App\Controller;

use App\Entity\UserCollecting;
use App\Repository\CollectingRepository;
use App\Repository\ItemRepository;
use App\Repository\UserCollectingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(UserCollectingRepository $userCollectingRepository, ItemRepository $itemRepository): Response
    {

        // $userCollectingList = $userCollectingRepository->findBy(["User" => $this->getUser()]);
        $userCollectingList = $userCollectingRepository->findByUser($this->getUser());
        // $items = $this->entityManager->getRepository(Item::class)->findByUser($this->getUser());


        // dd($this->getUser());

        return $this->render('profile/index.html.twig', [
            'userCollectingList' => $userCollectingList,
            // 'items' => $itemRepository->findByUser($this->getUser()),
        ]);
    }
}
