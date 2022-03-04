<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
       // $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        //prepare the object
        $object= $em->getRepository(Classroom::class)
            ->find($id);
        $em->remove($object);
        $em->flush();
        return $this->redirectToRoute("listClassroom");
    }

    //add Classroom method
    /**
     * @Route("/new",name="newClassroomPage")
     */
    public function newClassroom(Request $request):Response{
        //1.Create form view
        //1.a prepare an instance of the classroom
       $classroom= new Classroom();
        //1.b prepare the form
        $form= $this->createForm(ClassroomType::class, $classroom);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($request);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute("listClassroom");
        }
        //1.c render the form
        return $this->render('classroom/new.html.twig',[
            'f'=>$form->createView()
        ]);
    }


    //update Classroom method
    /**
     * @Route("/update/{id}",name="updateClassroomPage")
     */
    public function updateClassroom($id,Request $request):Response{

        //1.Create form view
        //1.a prepare an instance of the classroom
        $classroom= $this->getDoctrine()
            ->getRepository(Classroom::class)
            ->find($id);
        //1.b prepare the form
        $form= $this->createForm(ClassroomType::class, $classroom);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($request);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.update data
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("listClassroom");
        }
        //1.c render the form
        return $this->render('classroom/new.html.twig',[
            'f'=>$form->createView()
        ]);
    }



}
