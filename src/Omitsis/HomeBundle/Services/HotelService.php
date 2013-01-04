<?php
namespace Omitsis\HomeBundle\Services;

/**
 * Servicio de soporte para el controlador de Hotel.
 */
interface HotelService {

	/**
	 * Retorna una lista con todos los hoteles
	 * @return array
	 */
	function listado();

	/**
	 * Retorna una lista de los hoteles en formato select
	 * @return array
	 */
	function listadoSelect();

}
