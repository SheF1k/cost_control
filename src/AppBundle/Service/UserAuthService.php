<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Strategy\Auth\AuthStrategyInterface;
use Symfony\Component\HttpFoundation\Request;

class UserAuthService
{
    /** @var array $strategies */
    private $strategies;

    /**
     * UserAuthService constructor.
     *
     * @param array $strategies
     */
    public function __construct(array $strategies)
    {
        foreach ($strategies as $strategy) {
            $this->addAuthStrategy($strategy);
        }
    }

    /**
     * Log user in.
     *
     * @param Request $request
     *
     * @return User|bool
     */
    public function authorize(Request $request)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($request)) {
                return $strategy->authorize($request);
            }
        }

        return false;
    }

    /**
     * Add authorization strategy.
     *
     * @param AuthStrategyInterface $strategy
     */
    public function addAuthStrategy(AuthStrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
    }
}
