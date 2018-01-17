<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Exception\Authentication\UserNotFoundException;
use AppBundle\Form\UserForm;
use AppBundle\Service\UserAuthService;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Class UserController
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("Authorize", pluralize=false)
 */
class AuthController extends BaseRestController
{
    /**
     * User authentication.
     *
     * @Rest\View(serializerGroups={"auth"})
     *
     * @param Request $request
     *
     * @return User
     *
     * @throws AuthenticationException
     */
    public function postAction(Request $request)
    {
        $authService = $this->getAuthServcie();
        /** @var User $user */
        $user = $authService->authorize($request);

        if (false === $user) {
            throw new UserNotFoundException('');
        }

        return $user;
    }

    /**
     * @return UserAuthService
     */
    private function getAuthServcie()
    {
        /**
         * @var UserAuthService $userAuthService
         */
        $userAuthService = $this->get('app.user_auth.service');

        return $userAuthService;
    }
}