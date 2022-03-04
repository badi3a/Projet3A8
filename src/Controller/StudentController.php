<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
