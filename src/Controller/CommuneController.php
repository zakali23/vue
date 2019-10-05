<?php

namespace App\Controller;

use App\Entity\Commune;

use App\Repository\CommuneRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CommuneController extends AbstractController
{
    /**
     * @Route("/commune", name="commune")
     * @param CommuneRepository $repository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function index(CommuneRepository $repository,SerializerInterface $serializer)
    {
        $commune = $repository->findAll();
       $data =  $serializer->serialize(count($commune),'json');
        $response=new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;



    }

    /**
     * @Route("/commune/by/codepostal/{search}", name="commune_search_cp")
     * @param CommuneRepository $repository
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function search(string $search,CommuneRepository $repository,SerializerInterface $serializer)
    {
        $commune = $repository->findByCodePostal($search);
        $data =  $serializer->serialize($commune,'json');
        $response=new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;



    }

    /**
     * @Route("/commune/new",name="add_commune",methods={"GET","POST"},options = { "expose" = true })
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function add(Request $request,ObjectManager $manager){
        set_time_limit(0);
        $data = $request->getContent();
        $decoders = json_decode($data);
        foreach ($decoders as $decoder){
            $commune = new Commune();
            $commune->setCommune($decoder->commune);
            $commune->setInsee($decoder->insee);
            $commune->setCodePostal($decoder->codePostal);
            $commune->setAcheminement($decoder->acheminement);
            $commune->setLigne($decoder->ligne);
            $commune->setCoordonneesGps($decoder->coordonneesGps);
            //dump($commune);die;
            $manager->persist($commune);
            $manager->flush();
        }

        return new Response('valider',Response::HTTP_CREATED);


    }


}
