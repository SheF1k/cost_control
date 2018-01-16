<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserForm;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function getAction(User $user = null)
    {
        if (!$user instanceof User) {
            throw new NotFoundHttpException('User not found');
        }
        return $user;
    }

    /**
     * Return users.
     *
     * @Rest\QueryParam(name="_sort")
     * @Rest\QueryParam(name="_limit",  requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="_offset", requirements="\d+", nullable=true, strict=true)
     * @Rest\QueryParam(name="fullName", description="Full name")
     * @Rest\QueryParam(name="email", description="email")
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        /** @var EntityRepository $repository */
        $repository = $this->getRepository('AppBundle:User');
        $paramFetcher = $paramFetcher->all();

        return $this->matching($repository, $paramFetcher, null, ['default']);
    }

    /**
     * Create a new user.
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
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
     * Edit existing user.
     * @param Request $request
     * @param User $user
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     */
    public function putAction(Request $request, User $user)
    {
        $groups = [
            'serializerGroups' => [
                'default',
            ],
            'formOptions' => [
                'validation_groups' => [
                    'default',
                    'Default',
                ],
            ],
        ];

        return $this->handleForm($request, UserForm::class, $user, $groups, true);
    }

    /**
     * Delete user by id.
     *
     * @Rest\View(statusCode=204)
     *
     * @param User $user
     * @return Response
     */
    public function deleteAction(User $user = null)
    {
        if (!$user instanceof User) {
            throw new NotFoundHttpException('User not found');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return null;
    }
}