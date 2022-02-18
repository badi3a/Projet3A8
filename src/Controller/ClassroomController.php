<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/classroom")
 */
class ClassroomController extends AbstractController
{
    /**
     * @Route("/", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    //get list classRoom
    /**
     * @Route("/list", name="ListClassroom")
     */
    public function list():Response{
        $list= $this->getDoctrine()
                    ->getRepository(Classroom::class)
                    ->findAll();

        return $this->render(
            'classroom/list.html.twig'
            ,
            array('list'=>$list)
        );
    }
}
