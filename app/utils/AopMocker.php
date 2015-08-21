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
			$mocks[$class][$method] = $result;
			Config::set('aopmock.mockable_methods', $mocks);
			return;
		}
		$mocks[$class] = array(
			$method => $result
		);
		Config::set('aopmock.mockable_methods', $mocks);
	}
	
		/**
	 * Remove the mock defined for this method in the given class.
	 *
	 * @param string $class
	 *        	Fully qualified class name.
	 * @param string $method
	 *        	Method name.
	 * @param bool $onlyThisMethod
	 *        	Default is true, meaning that only this single method of this class
	 *        	is going to be unmocked. If it is set to false, all mocked methods
	 *        	in this class will be unmocked
	 */
	public static function unmock($class, $method, $onlyThisMethod = true)
	{
		$mocks = Config::get('aopmock.mockable_methods');
		if (isset($mocks[$class])) {
			
			if (! $onlyThisMethod) {
				unset($mocks[$class]);
				return;
			}
			
			if (isset($mocks[$class][$method])) {
				unset($mocks[$class][$method]);
				return;
			}
		}
		Config::set('aopmock.mockable_methods', $mocks);
	}
}

?>
