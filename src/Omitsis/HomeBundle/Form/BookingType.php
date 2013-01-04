<?php

namespace Omitsis\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookingType extends AbstractType
{
	protected $hotelArr;
	protected $customerArr;

	public function __construct ( $hotelArr, $customerArr )
	{
		$this->hotelArr = $hotelArr;
		$this->customerArr = $customerArr;
	}

	public function buildForm(FormBuilderInterface  $builder, array $options)
	{
		$builder
			->add('hotel', 'choice', array('required' => false,'choices' => $this->hotelArr ,'empty_value' => 'Seleccione un hotel'))
			->add('customer', 'choice', array('required' => false,'choices' => $this->customerArr ,'empty_value' => 'Identifiquese'))
			->add('room', 'text')
			->add('checkIn' ,'date', array('required' => true, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy'))
			->add('checkOut' ,'date', array('required' => true, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy'));
	}

	public function getName()
	{
		return 'booking';
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{

	}
}
