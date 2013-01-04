<?php
namespace Omitsis\HomeBundle\Services;

/**
 * Servicio de soporte para la entidad de Room
 */
interface RoomService {

	/**
	 * Retorna una lista de las habitaciones de un hotel en formato select
	 *
	 * @param $hotel
	 * @return array
	 */
	function habitacionesHotelSelect($hotel);

	/**
	 * Mètodo que busca una Room por el id
	 * @param $id
	 * @return mixed
	 */
	function findById($id);



}
