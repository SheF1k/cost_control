<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserForm;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * Class UserController
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("User")
 */
class UserController extends BaseRestController
{
    /**
     * @param User $user
     * @return User
     *
     * @Rest\View(serializerGroups={"default"})
     */
    public function getAction(User $user)
    {
        return $user;
    }
}