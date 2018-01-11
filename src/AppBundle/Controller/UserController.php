<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @Route("/user/create")
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setFullName('Reida');
        $user->setEmail('kiss');
        $user->setPassword('password');
        $em->persist($user);
        $em->flush();

        return new Response('Saved new user with id '.$user->getId());
    }
}
