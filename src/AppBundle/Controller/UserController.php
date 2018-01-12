<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserForm;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("User")
 */
class UserController extends BaseRestController
{
    public function getAction(User $user)
    {
        return $user;
    }
}
