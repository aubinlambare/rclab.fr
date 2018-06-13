<?php
namespace RCLAB\WebsiteBundle\Repository;
use RCLAB\UserBundle\Entity\User;
/**
 * DemandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DemandeRepository extends \Doctrine\ORM\EntityRepository
{
    /** Les cours **/
    private function allDemandsCourses()
    {
        return $this
            ->createQueryBuilder('d')
            ->join('d.matiere', 'matiere')
            ->join('d.demandeur', 'demandeur')
            ->join('d.tdemande', 'tdemande')
            ->leftJoin('d.niveau', 'niveau')
            ->leftJoin('d.responsable', 'responsable')
            ->leftJoin('d.inscrits', 'inscrits')
            ->leftJoin('d.professeur', 'professeur')
            ->where("tdemande.typeDemande = 'cours'");
    }
    private function allCourses()
    {
        return $this
            ->allDemandsCourses()
            ->andWhere("d.etat = 'validé'");
    }
    private function allCoursesNotHistory()
    {
        return $this
            ->allCourses()
            ->andWhere('d.debut >= :NOW')
            ->setParameter('NOW', new \DateTime('NOW'))
            ->orderBy('d.debut', 'asc');
    }
    private function allCoursesHistory()
    {
        return $this
            ->allCourses()
            ->andWhere('d.debut <= :NOW')
            ->setParameter('NOW', new \DateTime('NOW'))
            ->orderBy('d.debut', 'desc');
    }
    public function findAvailableCourses($user)
    {
        return $this
            ->allCoursesNotHistory()
            ->andWhere('d.professeur != :USER')
            ->setParameter('USER', $user)
            ->getQuery()
            ->getResult();
    }
    public function findAllCoursesHistory($offset, $nbResults)
    {
        return $this
            ->allCoursesHistory()
            ->setFirstResult($offset)
            ->setMaxResults($nbResults)
            ->getQuery()
            ->getResult();
    }
    public function findAllCoursesNotHistory()
    {
        return $this
            ->allCoursesNotHistory()
            ->getQuery()
            ->getResult();
    }
    public function findMyCourses(User $user)
    {
        return $this
            ->allCoursesNotHistory()
            ->andWhere('(inscrits = :USER) OR (professeur = :USER)')
            ->setParameter('USER', $user)
            ->getQuery()
            ->getResult();
    }
    public function findMyCoursesHistory(User $user, $offset, $nbResults)
    {
        return $this
            ->allCoursesHistory()
            ->andWhere('(inscrits = :USER) OR (professeur = :USER)')
            ->setParameter('USER', $user)
            ->setFirstResult($offset)
            ->setMaxResults($nbResults)
            ->getQuery()
            ->getResult();
    }
//    public function findToTeachCourses(User $user)
//    {
//        return $this
//            ->allCoursesNotHistory()
//            ->andWhere('professeur = :USER')
//            ->setParameter('USER', $user)
//            ->getQuery()
//            ->getResult();
//    }
//
//    public function findTeachedCourses(User $user)
//    {
//        return $this
//            ->allCoursesHistory()
//            ->andWhere('professeur = :USER')
//            ->setParameter('USER', $user)
//            ->getQuery()
//            ->getResult();
//    }
    public function findCoursesToHandle($offset, $nbResults)
    {
        return $this
            ->allDemandsCourses()
            ->andWhere("(d.etat = 'demande') OR ( (d.etat = 'validé') AND (d.debut > :NOW) )" )
            ->setParameter('NOW', new \DateTime('NOW'))
            ->setFirstResult($offset)
            ->setMaxResults($nbResults)
            ->orderBy('d.dateDemande', 'desc')
            ->getQuery()
            ->getResult();
    }
    public function findMyCoursesDemandsHistory(User $user, $offset, $nbResults)
    {
        return $this
            ->allDemandsCourses()
            ->andWhere("d.etat != 'demande'")
            ->andWhere("d.demandeur = :USER")
            ->setParameter("USER", $user)
            ->setFirstResult($offset)
            ->setMaxResults($nbResults)
            ->orderBy("d.dateDemande", 'desc')
            ->getQuery()
            ->getResult();
    }
    public function findMyCoursesDemandsNotHistory(User $user)
    {
        return $this
            ->allDemandsCourses()
            ->andWhere("d.etat = 'demande'")
            ->andWhere("d.demandeur = :USER")
            ->setParameter("USER", $user)
            ->getQuery()
            ->getResult();
    }
//    public function findAllCoursesDemandsHistory()
//    {
//        return $this
//            ->allDemandsCourses()
//            ->andWhere("d.etat != 'demande'")
//            ->getQuery()
//            ->getResult();
//    }
    /** Les réparations **/
    private function allRepairs()
    {
        return $this
            ->createQueryBuilder('d')
            ->join('d.tdemande', 'tdemande')
            ->join('d.demandeur', 'demandeur')
            ->leftJoin('d.responsable', 'responsable')
            ->addSelect('tdemande')
            ->addSelect('demandeur')
            ->addSelect('responsable')
            ->where("tdemande.typeDemande = 'réparation'")
            ->orderBy('d.dateDemande', 'desc');
    }
    private function allRepairsNotHistory()
    {
        return $this
            ->allRepairs()
            ->andWhere("d.etat != 'délivré'");
    }
    private function allRepairsHistory()
    {
        return $this
            ->allRepairs()
            ->andWhere("d.etat = 'délivré'");
    }
    public function findMyRepairsNotHistory(User $user)
    {
        return $this
            ->allRepairsNotHistory()
            ->andWhere('(demandeur = :USER) OR (responsable = :USER)')
            ->setParameter('USER', $user)
            ->getQuery()
            ->getResult();
    }
    public function findMyRepairsHistory(User $user, $offset, $nbResults)
    {
        return $this
            ->allRepairsHistory()
            ->andWhere('(demandeur = :USER) OR (responsable = :USER)')
            ->setParameter('USER', $user)
            ->setFirstResult($offset)
            ->setMaxResults($nbResults)
            ->getQuery()
            ->getResult();
    }
    public function findAllRepairsNotHistory($offset, $nbResults)
    {
        return $this
            ->allRepairsNotHistory()
            ->setFirstResult($offset)
            ->setMaxResults($nbResults)
            ->getQuery()
            ->getResult();
    }
    public function findAllRepairsHistory($offset, $nbResults)
    {
        return $this
            ->allRepairsHistory()
            ->setFirstResult($offset)
            ->setMaxResults($nbResults)
            ->getQuery()
            ->getResult();
    }
//    public function findToMakeRepairs(User $user)
//    {
//        return $this
//            ->allRepairsNotHistory()
//            ->andWhere('responsable = :USER')
//            ->setParameter('USER', $user)
//            ->getQuery()
//            ->getResult();
//    }
//
//    public function findMadeRepairs(User $user)
//    {
//        return $this
//            ->allRepairsHistory()
//            ->andWhere('responsable = :USER')
//            ->setParameter('USER', $user)
//            ->getQuery()
//            ->getResult();
//    }
}
