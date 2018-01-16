<?php

namespace AppBundle\Service;


use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApiTokenService
{
    /** @var UserPasswordEncoderInterface $encoder */
    private $encoder;

    /**
     * ApiTokenService constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function generateApiToken(User $user)
    {
        $token = sha1(
            $this->encoder->encodePassword(
                $user,
                openssl_random_pseudo_bytes(4) . date('Y-m-d H:i:s')
            )
        );
        $user->setAccessToken($token);

        return $user;
    }
}