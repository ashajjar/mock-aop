<?php
return array(
	/**
	 * When running unit-tests this variable must be true, so all the
	 * methods defined as Mockable in the 'mockable_methods' array
	 * return what is specified as mock result.
	 */
	'testing' => true,
	
	/**
	 * Mockable methods are the methods that will not be called actually
	 * in unit testing, but a mock (pseudo) result will be returned.
	 */
	'mockable_methods' => array(
		"Jenssegers\\Mongodb\\Model" => array(
			"save" => true, // when Model->save() is invoked in test environment 'true must be returned
			"delete" => true
		)
	)
);