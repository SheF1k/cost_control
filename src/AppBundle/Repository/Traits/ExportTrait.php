<?php

namespace AppBundle\Repository\Traits;

use AppBundle\Entity\User;

trait ExportTrait
{
    public function getCostsForLastMonth(User $user)
    {
        $qb = $this->createQueryBuilder("entity");

        $result = $qb->select(array("entity"))
            ->where($qb->expr()->eq('entity.user', $user->getId()))
            ->getQuery()
            ->getResult();
        return $result;
    }
}