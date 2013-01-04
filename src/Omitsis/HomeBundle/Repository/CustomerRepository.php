<?php
namespace Omitsis\HomeBundle\Repository;

/**
 * Clase de soporte que contiene las acciones de consulta que se pueden realizar sobre la clase de dominio Customer.
 */
interface CustomerRepository {

	/**
	 * Retorna una lista con todos los customers
	 * return array
	 */
	function listado();

}
