<?php

declare( strict_types = 1 );

// don't load directly
defined( 'ABSPATH' ) || exit;

interface ContainerInterface {
	public function get( string $id );
	
	public function has( string $id ): bool;
}