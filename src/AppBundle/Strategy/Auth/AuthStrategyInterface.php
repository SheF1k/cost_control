<?php

namespace AppBundle\Strategy\Auth;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

interface AuthStrategyInterface
{
    /**
     * Log user in.
     *
     * @param Request $request
     *
     * @return User|bool
     */
    public function authorize(Request $request);

    /**
     * Tells if strategy supports given request parameters.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request);
}
