<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CensusController extends AbstractActionController
{
    public function indexAction()
    {
        $om = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        $qb = $om->createQueryBuilder();
        $qb->select(array('a','c'))
        	->from('Application\Entity\Alien','a')
        	->from('Application\Entity\City','c')
        	->where('c.name = a.city')
        	->orderBy('a.lastName','ASC')
        	->addOrderBy('a.firstName');
        $dql = $qb->getDQL();
        $query = $om->createQuery($dql);
        $query->useQueryCache(false);
        $query->useResultCache(false);
        $result = $query->getResult();
    }
}