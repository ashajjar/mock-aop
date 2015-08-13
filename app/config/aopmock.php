<?php
return array(
	/**
	 * When running unit-tests this variable must be true
	 */
	'testing' => false,
	
	/**
	 * Mockable methods are the methods that will not be called actually
	 * in unit testing, but a mock (pseudo) result will be returned.
	 */
	'mockable_methods' => array(
		"Fully\\Qualified\\Class\\Name" => array(
			"methodName" => "return value"
		)
	)
) // when Fully\Qualified\Class\Name->save() is invoked in test environment "return value" must be returned

;