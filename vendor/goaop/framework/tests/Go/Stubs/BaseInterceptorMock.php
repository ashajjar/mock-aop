<?php
namespace Go\Stubs;

use Go\Aop\Framework\BaseInterceptor;
use Go\Aop\Intercept\Joinpoint;
use Go\Aop\Pointcut;

class BaseInterceptorMock extends BaseInterceptor
{

	private static $advice = null;

	/**
	 * @ERROR!!!
	 */
	public function __construct($adviceMethod, $order = 0, Pointcut $pointcut = null)
	{
		self::$advice = $adviceMethod;
		parent::__construct($adviceMethod, $order, $pointcut);
	}

	/**
	 * @ERROR!!!
	 */
	public static function serializeAdvice($adviceMethod)
	{
		return array(
			'scope' => 'aspect',
			'method' => 'Go\Aop\Framework\{closure}',
			'aspect' => 'Go\Aop\Framework\BaseInterceptorTest'
		);
	}

	/**
	 * @ERROR!!!
	 */
	public static function unserializeAdvice($adviceData)
	{
		return self::$advice;
	}

	/**
	 * Implement this method to perform extra treatments before and
	 * after the invocation of joinpoint.
	 *
	 * @param Joinpoint $joinpoint
	 *        	current joinpoint
	 *        	
	 * @return mixed the result of the call
	 */
	public function invoke(Joinpoint $joinpoint)
	{
		return $joinpoint;
	}
}
