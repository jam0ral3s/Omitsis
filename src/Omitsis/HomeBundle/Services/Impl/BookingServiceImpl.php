<?php
namespace Omitsis\HomeBundle\Services\Impl;

use Omitsis\HomeBundle\Entity\Booking;
use Omitsis\HomeBundle\Services\BookingService;
use Doctrine\ORM\EntityManager;

/**
 * Servicio de soporte para el controlador de Booking.
 */
class BookingServiceImpl implements BookingService {

	/**
	 * EntityManager
	 *
	 * @var \Symfony\Bundle\DoctrineBundle\EntityManager $em
	 */
	protected $em;

	/**
	 * Clase Hotel
	 * @var Hotel $class
	 */
	protected $class;

	/**
	 * Repositorio de la clase
	 *
	 * @var  \Omitsis\HomeBundle\Repository\BookingRepository $repo
	 */
	protected $repo;

	/** @var RoomService $roomService  */
	private $roomService;

	/** @var \Omitsis\HomeBundle\Services\CustomerService $customerService  */
	private $customerService;

	/**
	 * Método que devuelve el Servicio de Room
	 * @return \Omitsis\HomeBundle\Services\RoomService
	 */
	private function getRoomService() {
		return $this->roomService;
	}

	/**
	 * Método que devuelve el Servicio de Room
	 * @return \Omitsis\HomeBundle\Services\RoomService
	 */
	private function getCustomerService() {
		return $this->customerService;
	}

	public function __construct (EntityManager $em, $class, $roomService, $customerService ) {
		$this->em = $em;
		$this->class = $class;
		$this->repo = $em->getRepository( $class );
		$this->roomService = $roomService;
		$this->customerService = $customerService;
	}

	public function reservas ($idHotel) {
		$hoteles = $this->repo->listadoReservasHotel($idHotel);
		return $hoteles;
	}

	/**
	 * Retorna los días ocupados de una habitación
	 *
	 * @param $room
	 * @return array
	 */
	public function reservasHabitacion($room){
		$reservas = $this->repo->reservasHabitacion($room);
		$diasReservados = array();
		foreach ( $reservas as $reserva ) {
			for($i=$reserva->getCheckIn()->getTimestamp(); $i<=$reserva->getCheckOut()->getTimestamp(); $i+=86400){
				array_push($diasReservados, date("d-m-Y", $i));
			}
		}
		return $diasReservados;
	}

	/**
	 * Mètodo que prepara la reserva para ser insertada y llama al repositorio para insertarla
	 *
	 * @param  \Omitsis\HomeBundle\Model\BookingDTO $reservaDTO
	 */
	function doReserva($reservaDTO){
		$reserva = new Booking();

		$room = $this->getRoomService()->findById($reservaDTO->getRoom());
		$customer = $this->getCustomerService()->findById($reservaDTO->getCustomer());

		$reserva->setRoom($room);
		$reserva->setCustomer($customer);
		$reserva->setCheckIn($reservaDTO->getCheckIn());
		$reserva->setCheckOut($reservaDTO->getCheckOut());

		$this->em->persist($reserva);
		$this->em->flush();
	}

}
