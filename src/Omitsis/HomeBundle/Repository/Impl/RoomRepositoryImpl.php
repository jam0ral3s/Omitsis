<?php
namespace Omitsis\HomeBundle\Repository\Impl;

use Doctrine\ORM\EntityRepository;
use Omitsis\HomeBundle\Repository\RoomRepository;

/**
 * Clase de soporte que contiene las acciones de consulta que se pueden realizar sobre la clase de dominio Room.
 *
 */
class RoomRepositoryImpl extends EntityRepository implements RoomRepository{

	/**
	 * @param $idHotel
	 * @return array
	 */
	public function habitacionesHotelSelect($idHotel){
		/** @var \Doctrine\ORM\QueryBuilder $qb  */
		$qb = $this->createQueryBuilder('room');
		$qb->where('room.hotel = :idHotel')->setParameter('idHotel', $idHotel);
		return $qb->getQuery()->getResult();
	}

}