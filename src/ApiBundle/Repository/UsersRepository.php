<?php

namespace ApiBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersRepository extends \Doctrine\ORM\EntityRepository
{
	public function getAll()
	{
		$query = $this->getEntityManager()->createQueryBuilder('ca1')
	        ->add('select', 'user')
	        ->add('from', 'ApiBundle:User user')
	        ->join('user.usersFablabs', 'usersFablabs', 'WITH', "usersFablabs.role='maker'")
	        ->getQuery();

    	return $query->getResult();
	}
}
