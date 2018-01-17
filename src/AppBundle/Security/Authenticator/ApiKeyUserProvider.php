<?php

namespace AppBundle\Security\Authenticator;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityManagerInterface;

class ApiKeyUserProvider implements UserProviderInterface
{

    /** @var EntityManagerInterface $em */
    protected $em;


    /**
     * ApiKeyUserProvider constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $username
     *
     * @return null|object
     */
    public function loadUserByUsername($username)
    {
        $user = $this->em->getRepository('AppBundle:User')->findOneBy(['accessToken' => $username]);
        if (null === $user) {
            return null;
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class ===$class;
    }
}