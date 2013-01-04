<?php
namespace Omitsis\HomeBundle\Repository\Impl;

use Doctrine\ORM\EntityRepository;
use Omitsis\HomeBundle\Repository\HotelRepository;

/**
 * Clase de soporte que contiene las acciones de consulta que se pueden realizar sobre la clase de dominio Hotel.
 */
class HotelRepositoryImpl extends EntityRepository implements HotelRepository{

	/**
	 * Retorna una lista con todos los hoteles
	 * @return array
	 */
	public function listado(){
		/** @var \Doctrine\ORM\QueryBuilder $qb  */
		$qb = $this->createQueryBuilder('htl');
		return $qb->getQuery()->getResult();
	}

	/**
	 * Extrae todas las reservas de un hotel
	 * @param $idHotel
	 * @return array
	 */
	public function reservas($idHotel){
		/** @var \Doctrine\ORM\QueryBuilder $qb  */
		$qb = $this->createQueryBuilder('htl');
		$qb->where('htl.id = :idHotel')->setParameter('idHotel', $idHotel);
		return $qb->getQuery()->getOneOrNullResult();
	}

}