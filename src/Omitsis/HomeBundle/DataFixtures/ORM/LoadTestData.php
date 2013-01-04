<?php
namespace Omitsis\HomeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;
use DateInterval;

use Omitsis\HomeBundle\Entity\Hotel;
use Omitsis\HomeBundle\Entity\Room;
use Omitsis\HomeBundle\Entity\Customer;
use Omitsis\HomeBundle\Entity\Booking;

class LoadTestData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //hotels
        $hotels['names'] = array('Melia', 'Wella', 'NH', 'Princesa Sofía', 'Ritz', 'Mandarín Oriental', 'Palace');
        $hotels['cities'] = array('Palma de Mallorca', 'Barcelona', 'Barcelona', 'Barcelona', 'París', 'Barcelona', 'New York');
        $hotels['stars'] = array(4, 5, 3, 5, 5, 5, 5);

		//rooms
		$_rooms = array();

		//customers
		$_customers = array();
        
        for($i=0; $i<count($hotels['names']); $i++)
        {
            $hotel = new Hotel();
            $hotel->setName($hotels['names'][$i]);
            $hotel->setCity($hotels['cities'][$i]);
            $hotel->setStars($hotels['stars'][$i]);
            
            //rooms
            for($j=0; $j<=20; $j++)
            {
                $room = new Room();
                $room->setHotel($hotel);
                $room->setNumber(101+$j);
                $manager->persist($room);
				array_push($_rooms, $room);
            }
            
            $manager->persist($hotel);
        }
        
        //customers
        $customers['names'] = array('Joan', 'Fran', 'Carles', 'Jose', 'Marta', 'Amagoia', 'Albert', 'Oriol');
        
        for($i=0; $i<count($customers['names']); $i++)
        {
            $customer = new Customer();
            $customer->setName($customers['names'][$i]);
            $customer->setAge(rand(18, 50));
			array_push($_customers, $customer);
            $manager->persist($customer);
        }



			// Bookings
			$bookings['in'] = array(0, 4, 10, 15);
			$bookings['stay'] = array(1,2,3);

		// Para cada una de las habitaciones se asignan dos reservas. Es posible que los nombres se repitan en reservas realizadas el mismo dia en distintos hoteles.
			for($j=0; $j<count($_rooms); $j++)
			{
				for ($k=0; $k<=rand(1,2); $k++){
					$booking = new Booking();
					$booking->setRoom($_rooms[$j]);
					$booking->setCustomer($_customers[rand(0,7)]);

					//Stay
					$dat_in = new DateTime('now');
					$dat_fin = new DateTime('now');
					$in = $bookings['in'][rand(0,3)];
					$out = $in + $bookings['stay'][rand(0,2)];

					$booking->setCheckIn($dat_in->add(new DateInterval('P'. $in. 'D')));
					$booking->setCheckOut($dat_fin->add(new DateInterval('P'. $out. 'D')));

					$manager->persist($booking);
				}
			}

        $manager->flush();
    }
}