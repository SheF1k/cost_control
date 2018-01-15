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

    /**
     * Create a new user.
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     */
    public function postAction(Request $request)
    {
        $groups = [
            'serializerGroups' => [
                'default',
                'auth'
            ],
            'formOptions' => [
                'validation_groups' => [
                    'default',
                    'Default',
                    'registration'
                ],
            ],
        ];

        return $this->handleForm($request, UserForm::class, new User(), $groups);
    }

    /**
     * Delete user by id.
     *
     * @param User $user
     * @return Response
     */
    public function deleteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return null;
    }
}