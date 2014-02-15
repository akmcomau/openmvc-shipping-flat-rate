<?php

namespace modules\shipping_flat_rate\controllers;

use core\classes\exceptions\RedirectException;
use core\classes\exceptions\SoftRedirectException;
use core\classes\renderable\Controller;
use core\classes\Model;
use core\classes\FormValidator;
use core\classes\Pagination;
use core\widgets\CategoryGrid;
use modules\checkout\classes\Cart;
use modules\products\widgets\ProductGrid;

class ShippingFlatRate extends Controller {

	public function shipping() {
		$cart = new Cart($this->config, $this->database, $this->request);
		$module_config = $this->config->moduleConfig('\modules\shipping_flat_rate');
		$method = $this->config->siteConfig()->checkout->shipping_methods->flat_rate;

		if ($module_config->free_if_over && $cart->getCartTotal() > $module_config->free_if_over) {
			$cart->setShipping(['flat_rate' => 0]);
		}
		else {
			$cart->setShipping(['flat_rate' => [
				'cost' => $module_config->shipping_cost,
				'sell' => $module_config->shipping_sell
			]]);
		}
		throw new RedirectException($this->url->getUrl('Checkout'));
	}
}