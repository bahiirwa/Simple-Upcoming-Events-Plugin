<?php

namespace Inc\Base;

class BaseController {
    
	public $plugin_url;

	public function __construct() {

		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );

    }

}