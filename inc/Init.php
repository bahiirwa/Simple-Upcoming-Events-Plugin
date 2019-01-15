<?php
/**
 * @package woopaymart
 */
namespace Inc;

final class Init
{

	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function getServices() 
	{
		return [
			Base\CustomPost::class,
			Base\Metabox::class,
			Base\Enqueue::class,
			Admin\Widget::class,
			Admin\Columns::class
		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::getServices() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();
		return $service;
	}
}