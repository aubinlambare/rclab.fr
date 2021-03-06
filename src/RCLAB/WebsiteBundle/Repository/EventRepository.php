<?php
namespace RCLAB\WebsiteBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{
    public function findEventsToHandle()
    {
        return $this
            ->createQueryBuilder('e')
            ->where("e.maxParticipants != 'null'")
            ->getQuery()
            ->getResult();
    }
}
