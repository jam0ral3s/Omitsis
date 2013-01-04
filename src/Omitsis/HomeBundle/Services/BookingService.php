<?php
namespace Omitsis\HomeBundle\Services;

/**
 * Servicio de soporte para el controlador de Booking.
 */
interface BookingService {

	function reservas($idHotel);

	/**
	 * Retorna los días ocupados de una habitación
	 *
	 * @param $room
	 * @return array
	 */
	function reservasHabitacion($room);

	/**
	 * Mètodo que prepara la reserva para ser insertada
	 *
	 * @param $reservaDTO
	 */
	function doReserva($reservaDTO);
}
