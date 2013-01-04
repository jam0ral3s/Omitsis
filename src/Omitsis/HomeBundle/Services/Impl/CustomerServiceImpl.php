<?php
namespace Omitsis\HomeBundle\Services\Impl;

use Omitsis\HomeBundle\Entity\Hotel;
use Omitsis\HomeBundle\Services\CustomerService;
use Doctrine\ORM\EntityManager;

/**
 * Servicio de soporte para el repositorio de Customer.
 */
class CustomerServiceImpl implements CustomerService {

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
	 * @var  \Omitsis\HomeBundle\Repository\CustomerRepository $repo
	 */
	protected $repo;

	public function __construct (EntityManager $em, $class ) {
		$this->em = $em;
		$this->class = $class;
		$this->repo = $em->getRepository( $class );
	}

	/**
	 * Retorna una lista de los customer en formato select
	 * @return array
	 */
	public function listadoSelect(){
		$hoteles = $this->repo->listado();
		$customerSelect = array();

		foreach ( $hoteles  as $registro ) {
			$customerSelect[$registro->getId()] = $registro->getName();
		}

		return $customerSelect;
	}

	/**
	 * Mètodo que busca un Customer por el id
	 * @param $id
	 * @return mixed
	 */
	public function findById($id){
		return $this->repo->findOneById($id);
	}

}
