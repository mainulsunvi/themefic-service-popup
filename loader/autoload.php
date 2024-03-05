<?php

function tfsp_autoloader( $class ): void {
	$prefix   = 'TFSP\\';
	$base_dir = TFSP_ROOT . 'inc' . DIRECTORY_SEPARATOR;
	
	$class = substr( $class, strlen( $prefix ) );
	
	if ( preg_match( '/[^\\\\]+$/', $class, $matches ) ) {
		$dirname = strtolower( rtrim( $class, $matches[0] ) );
	}
	
	$fileName = !empty($matches[0]) ? (( str_contains( $matches[0], '_' ) ) ? strtolower( str_replace( '_', '-', $matches[0] ) ) : strtolower( $matches[0] )) : '';

	if(!empty($dirname) && $dirname == "traits\\") {
		$path = !empty($dirname) ? $base_dir . $dirname . 'trait-' . $fileName . '.php' : '';
	} else {
		$path = !empty($dirname) ? $base_dir . $dirname . 'class-' . $fileName . '.php' : '';
	}
	
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

spl_autoload_register( "tfsp_autoloader" );