<?php
namespace Traits;

/**
 * This trait should be used when a model needs to be mocked, that is 
 * to override the save and delete methods and any other methods that 
 * need to be mocked but they are not in the namespaces that the AOP
 * lib can read.
 *
 * @author Ahmad Hajjar
 *        
 */
trait MockableModel
{

	public function save(array $options = array())
	{
		return parent::save();
	}

	public function delete()
	{
		return parent::delete();
	}
}

?>