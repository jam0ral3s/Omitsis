<?php
namespace Omitsis\HomeBundle\Repository\Impl;

use Doctrine\ORM\EntityRepository;
use Omitsis\HomeBundle\Repository\CustomerRepository;

/**
 * Clase de soporte que contiene las acciones de consulta que se pueden realizar sobre la clase de dominio Customer.
 */
class CustomerRepositoryImpl extends EntityRepository implements CustomerRepository{

	/**
	 * Retorna una lista con todos los hoteles
	 * @return array
	 */
	public function listado(){
		/** @var \Doctrine\ORM\QueryBuilder $qb  */
		$qb = $this->createQueryBuilder('cust');
		return $qb->getQuery()->getResult();
	}
}