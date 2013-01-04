<?php
namespace Omitsis\HomeBundle\Controller;

use Omitsis\HomeBundle\Services\HotelService;
use Omitsis\HomeBundle\Services\BookingService;
use Omitsis\HomeBundle\Services\RoomService;
use Omitsis\HomeBundle\Services\CustomerService;
use Omitsis\HomeBundle\Model\BookingDTO;
use Omitsis\HomeBundle\Form\BookingType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
/**
 * Controlador principal encargado de realizar las siguientes acciones del Test:
 *     1 - Poder realizar reservas de los hoteles.
 *     2 - Listado de las habitaciones reservadas de los distintos hoteles.
 */
class HomeController extends Controller {

	/** @var HotelService $hotelService  */
	private $hotelService;

	/** @var BookingService $bookingService  */
	private $bookingService;

	/** @var RoomService $roomService  */
	private $roomService;

	/** @var CustomerService $customerService  */
	private $customerService;

	/**
	 * Método que devuelve el Servicio de Hotel
	 * @return HotelService
	 */
	private function getHotelService() {
		if(is_null($this->hotelService)){
			$this->hotelService = $this->get('home.hotel_service');
		}
		return $this->hotelService;
	}

	/**
	 * Método que devuelve el Servicio de Booking
	 * @return BookingService
	 */
	private function getBookingService() {
		if(is_null($this->bookingService)){
			$this->bookingService = $this->get('home.booking_service');
		}
		return $this->bookingService;
	}

	/**
	 * Método que devuelve el Servicio de Booking
	 * @return BookingService
	 */
	private function getRoomService() {
		if(is_null($this->roomService)){
			$this->roomService = $this->get('home.room_service');
		}
		return $this->roomService;
	}

	/**
	 * Método que devuelve el Servicio de Booking
	 * @return BookingService
	 */
	private function getCustomerService() {
		if(is_null($this->customerService)){
			$this->customerService = $this->get('home.customer_service');
		}
		return $this->customerService;
	}


	/**
	 * Método que muestra la pagina principal
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(){
		return $this->render( 'HomeBundle:Home:index.html.twig');
	}

	/**
	 * Método que devuelve una pagina con la lista de los hoteles
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function listaHotelesAction(){
		$hoteles = $this->getHotelService()->listado();
		return $this->render( 'HomeBundle:Home:listaHoteles.html.twig', array('hoteles' => $hoteles));
	}

	/**
	 * Método que devuelve las reservas de un hotel
	 */
	public function reservasHotelAction($codigoHotel = 0){
		$peticion = $this->getRequest();

		// Si viene por Post Modificamos el valor recibido
		if($peticion->getMethod() == 'POST'){
			$codigoHotel = $peticion->request->get('hotel');
		}

		if($codigoHotel != 0){
			$reservas = $this->getBookingService()->reservas($codigoHotel);

			// Si la petición es de tipo Ajax se enviara solo la información de la tabla si es una peticion  URL se enviara toda la página
			if ($peticion->isXmlHttpRequest()) {
				return $this->render( 'HomeBundle:Home:includes/reservas_tabla.html.twig', array('reservas' => $reservas));
			}else {
				return $this->render( 'HomeBundle:Home:reservasHotel.html.twig', array('reservas' => $reservas));
			}
		} else {
			throw $this->createNotFoundException('ERROR - La pagina no existe');
		}

		$hoteles = $this->getHotelService()->listado();
		return $this->render( 'HomeBundle:Home:listaHoteles.html.twig', array('hoteles' => $hoteles));
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function reservarAction(){
		$peticion = $this->getRequest();

		$hoteles = $this->getHotelService()->listadoSelect();
		$customers = $this->getCustomerService()->listadoSelect();
		$reservaDTO = new BookingDTO();
		$formulario = $this->createForm( new BookingType($hoteles, $customers), $reservaDTO);

		// Si la petición es de tipo post, es que el usuario ha rellenado el formulario
		if($peticion->getMethod() == 'POST'){
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$this->getBookingService()->doReserva($reservaDTO);
				return $this->render( 'HomeBundle:Home:reservaFinalizada.html.twig');
			}else{
				return $this->render( 'HomeBundle:Home:reservar.html.twig', array('inicio' => 'N', 'formulario' =>  $formulario->createView()));
			}
		}else{
			return $this->render( 'HomeBundle:Home:reservar.html.twig', array('inicio' => 'S' , 'formulario' =>  $formulario->createView()));
		}
	}

	/**
	 * Metodo encargado de retornar en formato SELECT las habitaciones de un Hotel
	 *
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function habitacionesHotelSelectAction(){
		$peticion = $this->getRequest();

		echo $peticion->request->get('selected');

		// Si la petición no viene de un formulario, se muestra un mensaje de error
		if($peticion->getMethod() == 'POST'){
			$habitaciones = $this->getRoomService()->habitacionesHotelSelect($peticion->request->get('hotel'));
			return $this->render( 'HomeBundle:Home:includes/room_select.html.twig', array('habitaciones' => $habitaciones , 'selected' => $peticion->request->get('selected')));
		}else {
			throw $this->createNotFoundException('ERROR - La pagina no existe');
		}
	}

	/**
	 * Mètodo encargado de devolver la lista de dias ocupados de un hotel
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	public function habitacionDiasOcupadosAction(){
		$peticion = $this->getRequest();

		// Si la petición no viene de un formulario, se muestra un mensaje de error
		if($peticion->getMethod() == 'POST'){
			$reservas = $this->getBookingService()->reservasHabitacion($peticion->request->get('room'));
			return new Response(json_encode(array('reservas'=>$reservas)));
		}else {
			throw $this->createNotFoundException('ERROR - La pagina no existe');
		}
	}
}
