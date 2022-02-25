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
     * @Route("/list", name="listClassroom")
     */
    public function listClassroom():Response{

        //get the data from the DB
        $data= $this->getDoctrine()
            ->getManager()->getRepository(Classroom::class)
            ->findAll();
        //test the render of the database
        //var_dump($data);
        //die();
        //return a view
         return $this->render('classroom/list.html.twig',array(
             //data
             'list'=>$data
         ));
    }

    //delete method
    /**
     * @Route("/delete/{id}",name="deleteClassroomPage")
     */
    public function deleteClassroom($id):Response{
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $object= $em->getRepository(Classroom::class)
            ->find($id);
        $em->remove($object);
        $em->flush();
        return $this->redirectToRoute("listClassroom");
    }


}
