<?php
namespace Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

/**
 * Monitor aspect
 */
class MockingAspect implements Aspect
{

	/**
	 * Mocking service to return mock objects when static method
	 * being invoked is registered as mockable.
	 *
	 * @param MethodInvocation $invocation
	 *        	Invocation
	 *        	@Around("execution(public *\*::*(*))")
	 */
	public function aroundStaticMethodExecution(MethodInvocation $invocation)
	{
		$mock = static::isMockable($invocation);
		if (isset($mock)) {
			return $mock;
		}
		
		return $invocation->proceed();
	}

	/**
	 * Mocking service to return mock objects when method being
	 * invoked is registered as mockable.
	 *
	 * @param MethodInvocation $invocation
	 *        	Invocation
	 *        	@Around("execution(public **\*->*(*))")
	 */
	public function aroundMethodExecution(MethodInvocation $invocation)
	{
		$mock = static::isMockable($invocation);
		if (isset($mock)) {
			return $mock;
		}
		
		return $invocation->proceed();
	}

	/**
	 * Checks if this method invocation is mockable.
	 *
	 * @param MethodInvocation $invocation        	
	 * @return object The mock return value if this invocation is happening in test
	 *         environment and it is listed in the mockable_methods array null otherwise.
	 */
	private static function isMockable(MethodInvocation $invocation)
	{
		// Check for testing config, nothing is mockable if we are not testing
		if (Config::get('aopmock.testing') === false) {
			return null;
		}
		// Get the object
		$obj = $invocation->getThis();
		
		// Get the method name
		$methodName = $invocation->getMethod()->name;
		
		// Get class name
		if ($invocation->getMethod()->isStatic()) {
			$class = $obj;
			$obj = new $class();
		} else {
			$class = get_class($obj);
		}
		
		$types = Config::get('aopmock.mockable_methods');
		
		foreach ($types as $type => $val) {
			if ($obj instanceof $type) {
				if (isset($types[$type][$methodName])) {
					return $types[$type][$methodName];
				}
			}
		}
		return null;
	}
}

?>
