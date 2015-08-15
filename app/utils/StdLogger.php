<?php
namespace Helpers;

/**
 * A utility class for looging to standard output stream
 * 
 * @author Ahmad Hajjar
 *
 */
class StdLogger
{
/**
	 * Log the object to the server's console.
	 *
	 * @param $object        	
	 */
	public static function log($object)
	{
		$object = print_r($object, true);
		$object = "Application Log [" . date("d-M-Y H:i:s") . "] :" . $object . "\n";
		file_put_contents("php://stdout", $object);
	}
}

?>