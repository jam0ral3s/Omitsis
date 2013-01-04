<?php
namespace Omitsis\HomeBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/* todo: Validar que dentro del rango escogido no exista ninguna reserva.
 * @Assert\Callback(methods={"rangoReservaDisponible"})
 */
class BookingDTO {

	function __construct () {}

	/**
	 * @Assert\NotBlank()
	 */
	protected $hotel;

	/**
	 * @Assert\NotBlank()
	 */
	protected $customer;

	/**
	 * @Assert\NotBlank()
	 */
	protected $room;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Date
	 */
	protected $checkIn;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Date
	 */
	protected $checkOut;

	public function setCheckIn ( $checkIn ) {
		$this->checkIn = $checkIn;
	}

	public function getCheckIn () {
		return $this->checkIn;
	}

	public function setCheckOut ( $checkOut ) {
		$this->checkOut = $checkOut;
	}

	public function getCheckOut () {
		return $this->checkOut;
	}

	public function setHotel ( $hotel ) {
		$this->hotel = $hotel;
	}

	public function getHotel () {
		return $this->hotel;
	}

	public function setRoom ( $room ) {
		$this->room = $room;
	}

	public function getRoom () {
		return $this->room;
	}

	public function setCustomer ( $customer ) {
		$this->customer = $customer;
	}

	public function getCustomer () {
		return $this->customer;
	}
}
