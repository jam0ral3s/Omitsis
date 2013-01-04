<?php
namespace Omitsis\HomeBundle\Repository\Impl;

use Doctrine\ORM\EntityRepository;
use Omitsis\HomeBundle\Repository\BookingRepository;

/**
 * Clase de soporte que contiene las acciones de consulta que se pueden realizar sobre la clase de dominio Booking.
 */
class BookingRepositoryImpl extends EntityRepository implements BookingRepository{

	/**
	 * Retorna una lista con las reservas de un hotel
	 *
	 * @param  integer $hotel
	 * @return array
	 */
	public function listadoReservasHotel($hotel){
		/** @var \Doctrine\ORM\QueryBuilder $qb  */

		$qb = $this->createQueryBuilder('bk')->select(array('bk','rm','ht'));
		$qb->innerJoin('bk.room', 'rm');
		$qb->innerJoin('rm.hotel', 'ht');
		$qb->where('ht.id = :idHotel')->setParameter('idHotel' , $hotel);
		$qb->orderBy('rm.number', 'ASC');

		return $qb->getQuery()->getResult();
	}

	/**
	 * Retorna las reservas de una habitacion
	 *
	 * @param $room
	 * @return array
	 */
	public function reservasHabitacion($room){
		$qb = $this->createQueryBuilder('bk');
		$qb->where('bk.room = :room')->setParameter('room', $room);

		return $qb->getQuery()->getResult();
	}


}