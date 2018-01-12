<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserForm;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseRestController
{
    /**
     * @Rest\Get("/user")
     * @param User $user
     * @return User
     */
    public function getAction(User $user)
    {
        return $user;
    }
}
