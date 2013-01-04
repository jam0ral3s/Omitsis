<?php
namespace Omitsis\HomeBundle\Repository;

/**
 * Clase de soporte que contiene las acciones de consulta que se pueden realizar sobre la clase de dominio Hotel.
 */
interface HotelRepository {

	/**
	 * Retorna una lista con todos los hoteles
	 * return array
	 */
	function listado();

	/**
	 * Extrae todas las reservas de un hotel
	 * @param $idHotel
	 * @return mixed
	 */
	function reservas($idHotel);

}
