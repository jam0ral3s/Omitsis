<?php
namespace Omitsis\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Omitsis\HomeBundle\Repository\Impl\BookingRepositoryImpl")
 * @ORM\Table(name="booking")
 */
class Booking
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Room")
	 * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
	 */
	protected $room;


	/**
	 * @ORM\ManyToOne(targetEntity="Customer" )
	 * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
	 */
	protected $customer;

	/**
	 * @ORM\Column(type="date", nullable=false, name="check_in")
	 */
	protected $checkIn;

	/**
	 * @ORM\Column(type="date", nullable=false, name="check_out")
	 */
	protected $checkOut;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

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

	/**
	 * @param Customer $customer
	 */
	public function setCustomer ( \Omitsis\HomeBundle\Entity\Customer $customer = NULL  ) {
		$this->customer = $customer;
	}

	/**
	 * @return \Omitsis\HomeBundle\Entity\Customer
	 */
	public function getCustomer () {
		return $this->customer;
	}

	/**
	 * @param Room $room
	 */
	public function setRoom ( \Omitsis\HomeBundle\Entity\Room $room = NULL ) {
		$this->room = $room;
	}

	/**
	 * @return \Omitsis\HomeBundle\Entity\Room
	 */
	public function getRoom () {
		return $this->room;
	}


}