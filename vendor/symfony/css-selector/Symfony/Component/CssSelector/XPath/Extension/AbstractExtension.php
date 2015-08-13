<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symfony\Component\CssSelector\XPath\Extension;

/**
 * XPath expression translator abstract extension.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
abstract class AbstractExtension implements ExtensionInterface
{

	/**
	 * @ERROR!!!
	 */
	public function getNodeTranslators()
	{
		return array();
	}

	/**
	 * @ERROR!!!
	 */
	public function getCombinationTranslators()
	{
		return array();
	}

	/**
	 * @ERROR!!!
	 */
	public function getFunctionTranslators()
	{
		return array();
	}

	/**
	 * @ERROR!!!
	 */
	public function getPseudoClassTranslators()
	{
		return array();
	}

	/**
	 * @ERROR!!!
	 */
	public function getAttributeMatchingTranslators()
	{
		return array();
	}
}
