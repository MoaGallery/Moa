<?php

namespace Moa\Event;

use Moa\Service\ThumbnailProvider;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class TerminateSubscriber implements EventSubscriberInterface {
	
	protected $container;
	protected $thumbnailProvider;
	
	public function __construct(ContainerInterface $container, ThumbnailProvider $thumbnailProvider) {
		$this->container = $container;
		$this->thumbnailProvider = $thumbnailProvider;
	}
	
	public static function getSubscribedEvents()
	{
		return array(
			KernelEvents::TERMINATE => 'onTerminate'
		);
	}
	
	public function OnTerminate()
	{
		// TODO: Properly daemonise this bit
		$this->thumbnailProvider->DoRegen(200);
	}
}
