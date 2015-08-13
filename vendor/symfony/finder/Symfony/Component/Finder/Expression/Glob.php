<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symfony\Component\Finder\Expression;

/**
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class Glob implements ValueInterface
{

	/**
	 *
	 * @var string
	 */
	private $pattern;

	/**
	 *
	 * @param string $pattern        	
	 */
	public function __construct($pattern)
	{
		$this->pattern = $pattern;
	}

	/**
	 * @ERROR!!!
	 */
	public function render()
	{
		return $this->pattern;
	}

	/**
	 * @ERROR!!!
	 */
	public function renderPattern()
	{
		return $this->pattern;
	}

	/**
	 * @ERROR!!!
	 */
	public function getType()
	{
		return Expression::TYPE_GLOB;
	}

	/**
	 * @ERROR!!!
	 */
	public function isCaseSensitive()
	{
		return true;
	}

	/**
	 * @ERROR!!!
	 */
	public function prepend($expr)
	{
		$this->pattern = $expr . $this->pattern;
		
		return $this;
	}

	/**
	 * @ERROR!!!
	 */
	public function append($expr)
	{
		$this->pattern .= $expr;
		
		return $this;
	}

	/**
	 * Tests if glob is expandable ("*.{a,b}" syntax).
	 *
	 * @return bool
	 */
	public function isExpandable()
	{
		return false !== strpos($this->pattern, '{') && false !== strpos($this->pattern, '}');
	}

	/**
	 *
	 * @param bool $strictLeadingDot        	
	 * @param bool $strictWildcardSlash        	
	 *
	 * @return Regex
	 */
	public function toRegex($strictLeadingDot = true, $strictWildcardSlash = true)
	{
		$firstByte = true;
		$escaping = false;
		$inCurlies = 0;
		$regex = '';
		$sizeGlob = strlen($this->pattern);
		for ($i = 0; $i < $sizeGlob; $i ++) {
			$car = $this->pattern[$i];
			if ($firstByte) {
				if ($strictLeadingDot && '.' !== $car) {
					$regex .= '(?=[^\.])';
				}
				
				$firstByte = false;
			}
			
			if ('/' === $car) {
				$firstByte = true;
			}
			
			if ('.' === $car || '(' === $car || ')' === $car || '|' === $car || '+' === $car || '^' === $car || '$' === $car) {
				$regex .= "\\$car";
			} elseif ('*' === $car) {
				$regex .= $escaping ? '\\*' : ($strictWildcardSlash ? '[^/]*' : '.*');
			} elseif ('?' === $car) {
				$regex .= $escaping ? '\\?' : ($strictWildcardSlash ? '[^/]' : '.');
			} elseif ('{' === $car) {
				$regex .= $escaping ? '\\{' : '(';
				if (! $escaping) {
					++ $inCurlies;
				}
			} elseif ('}' === $car && $inCurlies) {
				$regex .= $escaping ? '}' : ')';
				if (! $escaping) {
					-- $inCurlies;
				}
			} elseif (',' === $car && $inCurlies) {
				$regex .= $escaping ? ',' : '|';
			} elseif ('\\' === $car) {
				if ($escaping) {
					$regex .= '\\\\';
					$escaping = false;
				} else {
					$escaping = true;
				}
				
				continue;
			} else {
				$regex .= $car;
			}
			$escaping = false;
		}
		
		return new Regex('^' . $regex . '$');
	}
}
