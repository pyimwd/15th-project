<?php

namespace App\Controller;

use App\Entity\Collecting;
use App\Repository\ItemRepository;
use App\Repository\CollectingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CollectingRepository $collectingRepository, ItemRepository $itemRepository): Response
    {
        $items = $itemRepository->findBy([], ['id' => 'DESC'], '6');

        $collectings = $collectingRepository->findBy([], ['created_at' => 'DESC'], 4);

        // $collecting = $collectingRepository->findOneById($collecting->getId());


        return $this->render('home/index.html.twig', [
            'collectings' => $collectings,
            // 'collecting' => $collecting,
            'items' => $items,
        ]);
    }
}
