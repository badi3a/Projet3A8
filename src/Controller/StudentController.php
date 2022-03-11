<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    /**
     * @Route("/list",name="studentListPage")
     */
    public function listStudent():Response{
        $list=$this->getDoctrine()
            ->getRepository(Student::class)
            ->findAll();
        return $this->render('student/list.html.twig',
        array(
            'list'=>$list
        ));
    }
    //add Student method
    /**
     * @Route("/new",name="newStudentPage")
     */
    public function newClassroom(Request $request):Response{
        //1.Create form view
        //1.a prepare an instance of the Student
        $student= new Student();
        //1.b prepare the form
        $form= $this->createForm(StudentType::class, $student);
        //2. Handel http request sent by the user
        $form=$form->handleRequest($request);
        //2.b check the form
        if($form->isSubmitted() && $form->isValid()){
            //3.Persist data
            $em=$this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("studentListPage");
        }
        //1.c render the form
        return $this->render('student/new.html.twig',[
            'f'=>$form->createView()
        ]);
    }
}
