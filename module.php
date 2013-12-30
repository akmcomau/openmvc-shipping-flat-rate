<?php
$_MODULE = [
	"name" => "Shipping - Flat Rate",
	"description" => "Flat Rate Shipping",
	"namespace" => "\\modules\\shipping_flat_rate",
	"config_controller" => "administrator\\ShippingFlatRate",
	"controllers" => [
		"ShippingFlatRate",
		"administrator\\ShippingFlatRate"
	],
	"default_config" => [
		"shipping_cost" => 5,
		"shipping_sell" => 5,
		"free_if_over" => null
	]
];
