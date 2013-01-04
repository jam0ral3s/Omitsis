<?php
namespace Omitsis\HomeBundle\Services\Impl;

use Omitsis\HomeBundle\Entity\Hotel;
use Omitsis\HomeBundle\Services\HotelService;
use Doctrine\ORM\EntityManager;

/**
 * Servicio de soporte para el controlador de Hotel.
 */
class HotelServiceImpl implements HotelService {

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
	 * @var  \Omitsis\HomeBundle\Repository\HotelRepository $repo
	 */
	protected $repo;

	public function __construct (EntityManager $em, $class ) {
		$this->em = $em;
		$this->class = $class;
		$this->repo = $em->getRepository( $class );
	}

	/**
	 * Retorna una lista con todos los hoteles
	 *
	 * @return array
	 */
	public function listado () {
		$hoteles = $this->repo->listado();
		return $hoteles;
	}

	/**
	 * Retorna una lista de los hoteles en formato select
	 * @return array
	 */
	public function listadoSelect(){
		$hoteles = $this->repo->listado();
		$hotelesSelect = array();

		foreach ( $hoteles  as $registro ) {
			$hotelesSelect[$registro->getId()] = $registro->getName();
		}

		return $hotelesSelect;
	}

}
