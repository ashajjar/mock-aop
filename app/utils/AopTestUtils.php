<?php
namespace Tests;

/**
 * This class is a utility class that can be used for mocking and testing.
 */
class AopTestUtils
{

	public static function cast($obj, $to_class)
	{
		if (! isset($obj)) {
			return null;
		}
		if (class_exists($to_class)) {
			$obj_in = serialize($obj);
			$obj_out = 'O:' . strlen($to_class) . ':"' . $to_class . '":' . substr($obj_in, $obj_in[2] + 7);
			return unserialize($obj_out);
		} else
			return null;
	}
}

?>