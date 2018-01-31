<?php

namespace AppBundle\Repository\Traits;

use AppBundle\Entity\User;
use Doctrine\ORM\QueryBuilder;

trait ExportTrait
{
    public function getData(User $user, QueryBuilder $qb)
    {
        $result = $qb->select(array("entity"))
            ->where($qb->expr()->eq('entity.user', $user->getId()))
            ->getQuery()
            ->getResult();
        return $result;
    }
}