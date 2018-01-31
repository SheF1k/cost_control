<?php

namespace AppBundle\Repository\Traits;

use AppBundle\Entity\User;

trait ExportTrait
{
    public function getDataForLastMonth(User $user)
    {
        $end_date = new \DateTime();
        $start_date = clone $end_date;
        $start_date->sub(new \DateInterval('P1M'));

        $qb = $this->createQueryBuilder("entity");
        $result = $qb->select(array("entity"))
            ->where($qb->expr()->eq('entity.user', $user->getId()))
            ->andWhere($qb->expr()->between('entity.creationDate',':from', ':to'))
            ->setParameters(array('from' => $start_date->format('Y-m-d H:i:s'),
                'to' => $end_date->format('Y-m-d H:i:s')))
            ->getQuery()
            ->getArrayResult();
        return $result;
    }
}