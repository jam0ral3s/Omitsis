<?php
namespace Omitsis\HomeBundle\Services;

/**
 * Servicio de soporte para el controlador de Hotel.
 */
interface CustomerService {

	/**
	 * Retorna una lista de los customers en formato select
	 * @return array
	 */
	function listadoSelect();

	/**
	 * Mètodo que busca un Customer por el id
	 * @param $id
	 * @return mixed
	 */
	function findById($id);

}
