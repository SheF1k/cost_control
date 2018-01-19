<?php

namespace AppBundle\EventListener\DoctrineEntityListener;

use AppBundle\Entity\User;
use AppBundle\Service\ApiTokenService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserEntityListener implements EventSubscriber
{
    /**
     * @var ApiTokenService $apiTokenService
     */
    private $apiTokenService;

    private $encoder;

    public function __construct(ApiTokenService $apiTokenService, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->apiTokenService = $apiTokenService;
        $this->encoder = $passwordEncoder;
    }

    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof User) {
            return;
        }
        $this->encodePassword($entity);
        $this->apiTokenService->generateApiToken($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof User) {
            return;
        }
        $this->encodePassword($entity);
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    private function encodePassword(User $user)
    {
        if (null === $plainPassword = $user->getPlainPassword()) {
            return;
        }

        $encoded = $this->encoder->encodePassword(
            $user,
            $plainPassword
        );

        $user->setPassword($encoded);
    }
}