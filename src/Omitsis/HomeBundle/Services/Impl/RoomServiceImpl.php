<?php
namespace Omitsis\HomeBundle\Services\Impl;

use Omitsis\HomeBundle\Entity\Room;
use Omitsis\HomeBundle\Services\RoomService;
use Doctrine\ORM\EntityManager;

/**
 * Servicio de soporte para la Entidad Room
 */
class RoomServiceImpl implements RoomService {

	/**
	 * EntityManager
	 *
	 * @var \Symfony\Bundle\DoctrineBundle\EntityManager $em
	 */
	protected $em;

	/**
	 * Clase Room
	 * @var Hotel $class
	 */
	protected $class;

	/**
	 * Repositorio de la clase
	 *
	 * @var  \Omitsis\HomeBundle\Repository\RoomRepository $repo
	 */
	protected $repo;

	public function __construct (EntityManager $em, $class ) {
		$this->em = $em;
		$this->class = $class;
		$this->repo = $em->getRepository( $class );
	}

	/**
	 * Retorna una lista de las habitaciones de un hotel en formato select
	 *
	 * @param $hotel
	 * @return array
	 */
	public function habitacionesHotelSelect($hotel){
		$hoteles = $this->repo->habitacionesHotelSelect($hotel);
		$hotelesSelect = array();

		foreach ( $hoteles  as $registro ) {
			$hotelesSelect[$registro->getId()] = $registro->getNumber();
		}

		return $hotelesSelect;
	}

	/**
	 * Mètodo que busca una Room por el id
	 * @param $id
	 * @return mixed
	 */
	public function findById($id){
		return $this->repo->findOneById($id);
	}

}
