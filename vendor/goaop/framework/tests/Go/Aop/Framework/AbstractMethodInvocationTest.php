<?php
namespace Go\Aop\Framework;

class AbstractMethodInvocationTest extends \PHPUnit_Framework_TestCase
{

	/**
	 *
	 * @var AbstractMethodInvocation
	 */
	protected $invocation;

	public function setUp()
	{
		$this->invocation = $this->getMockForAbstractClass('Go\Aop\Framework\AbstractMethodInvocation', array(
			__CLASS__,
			__FUNCTION__,
			array()
		));
	}

	public function testInvocationReturnsMethod()
	{
		$this->assertEquals(__CLASS__, $this->invocation->getMethod()->class);
		$this->assertEquals('setUp', $this->invocation->getMethod()->name);
	}

	public function testStaticPartEqualsToReflectionMethod()
	{
		$this->assertInstanceOf('ReflectionMethod', $this->invocation->getStaticPart());
	}
}
