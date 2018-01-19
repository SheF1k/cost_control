<?php

namespace AppBundle\EventListener\DoctrineEntityListener;


use AppBundle\Entity\HasOwnerInterface;
use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class SetOwnerListener
{

    private  $tokenStorage;
    /**
     * SparePartTypeListener constructor.
     *
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Set user
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     *
     * @param HasOwnerInterface $entity
     * @param LifecycleEventArgs $args
     */

    public function setOwner(HasOwnerInterface $entity, LifecycleEventArgs $args)
    {

      $token = $this->tokenStorage->getToken();
      if ($entity->getUser() === null && isset($token)) {
          $user = $token->getUser();
          if ($user instanceof User) {
              $entity->setUser($user);
          }
      }
      elseif (empty($entity->getUser())){
          throw new UnprocessableEntityHttpException();
      }


    }
}
