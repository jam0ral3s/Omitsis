<?php
namespace Omitsis\HomeBundle\Repository;

/**
 * Clase de soporte que contiene las acciones de consulta que se pueden realizar sobre la clase de dominio Booking.
 */
interface BookingRepository {

	/**
	 * Retorna una lista con las reservas de un hotel
	 * @param  integer $hotel
	 * return array
	 */
	function listadoReservasHotel($hotel);

	/**
	 * Retorna las reservas de una habitacion
	 *
	 * @param $room
	 * @return array
	 */
	function reservasHabitacion($room);

}
