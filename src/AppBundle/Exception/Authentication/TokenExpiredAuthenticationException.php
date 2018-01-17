<?php

namespace AppBundle\Exception\Authentication;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class TokenExpiredAuthenticationException extends AuthenticationException
{
}
