<?php
namespace Helpers;

use Illuminate\Support\Facades\Config;

/**
 * This class mocks objects for unit tests
 */
class AopMocker
{

	/**
	 * Mocks the passed method on the passed class, so whenever this method
	 * is called on this class, the result will be returned.
	 *
	 * @param string $class
	 *        	Fully qualified class name.
	 * @param string $method
	 *        	Method name.
	 * @param object $result
	 *        	the result that will be returned instead of executing the method.
	 */
	public static function mock($class, $method, $result)
	{
		$mocks = Config::get('aopmock.mockable_methods');
		if (isset($mocks[$class])) {
			if (! isset($mocks[$class][$method])) {
				$mocks[$class][$method] = $result;
				Config::set('aopmock.mockable_methods', $mocks);
				return;
			}
		}
		$mocks[$class] = array(
			$method => $result
		);
		Config::set('aopmock.mockable_methods', $mocks);
	}
}

?>