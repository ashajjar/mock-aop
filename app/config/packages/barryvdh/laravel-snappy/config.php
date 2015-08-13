<?php
$wkhtmltopdf_binary = base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
$wkhtmltoimage_binary = base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64');

if (isset($_ENV['wkhtmltopdf.binary'])) {
	$wkhtmltopdf_binary = $_ENV['wkhtmltopdf.binary'];
}

if (isset($_ENV['wkhtmltoimage.binary'])) {
	$wkhtmltoimage_binary = $_ENV['wkhtmltoimage.binary'];
}

return array(
	
	'pdf' => array(
		'enabled' => true,
		'binary' => $wkhtmltopdf_binary,
		'timeout' => false,
		'options' => array()
	),
	'image' => array(
		'enabled' => true,
		'binary' => $wkhtmltoimage_binary,
		'timeout' => false,
		'options' => array()
	)
);
