<?php

// don't load directly
defined( 'ABSPATH' ) || exit;

require_once TFSP_ROOT . 'inc/container/interface/ContainerInterface.php';

class DependencyContainer implements ContainerInterface {
	/**
	 * @throws ReflectionException
	 */
	public function get( $id ) {
		return $this -> resolve( $id );
	}
	
	public function has( $id ): bool {
		return class_exists( $id );
	}
	
	/**
	 * @throws ReflectionException
	 * @throws Exception
	 */
	protected function resolve( $class ) {
		$reflectionClass = new ReflectionClass( $class );
		$constructor     = $reflectionClass -> getConstructor();
		
		if ( ! $constructor ) {
			return new $class();
		}
		
		$parameters   = $constructor -> getParameters();
		$dependencies = array();
		
		if ( ! $parameters ) {
			return new $class();
		}
		
		foreach ( $parameters as $parameter ) {
			$dependencyClass = $parameter -> getType();
			
			if ( ! $dependencyClass ) {
				throw new Exception( 'Class Parameters Do Not have any Type Hint' );
			}
			
			if ( $dependencyClass instanceof ReflectionNamedType && ! $dependencyClass -> isBuiltin() ) {
				$dependencies[] = $this -> resolve( $dependencyClass -> getName() );
			} else {
				throw new Exception( 'Class Do not have classified Dependency' );
			}
		}
		
		return $reflectionClass -> newInstanceArgs( $dependencies );
	}
}