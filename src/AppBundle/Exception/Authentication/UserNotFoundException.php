<?php

namespace AppBundle\Exception\Authentication;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class UserNotFoundException extends UnauthorizedHttpException
{
}
