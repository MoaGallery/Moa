<?php

namespace Moa\Event;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class TerminateSubscriber implements EventSubscriberInterface {
	
	protected $container;
	
	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}
	
	public static function getSubscribedEvents()
	{
		return array(
			KernelEvents::TERMINATE => 'onTerminate'
		);
	}
	
	public function OnTerminate()
	{
		$thumb_provider = $this->container->get('Moa\Service\ThumbnailProvider');

		// TODO: Properly daemonise this bit
		$thumb_provider->DoRegen(200);
	}
}