<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Exception\Authentication\UserNotFoundException;
use AppBundle\Service\UserAuthService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Class AuthController
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("Authorize", pluralize=false)
 */
class AuthController extends FOSRestController
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
        $authService = $this->getAuthService();
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
    private function getAuthService()
    {
        /**
         * @var UserAuthService $userAuthService
         */
        $userAuthService = $this->get('app.user_auth.service');

        return $userAuthService;
    }
}