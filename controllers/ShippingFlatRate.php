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

	public function getAllUrls($include_filter = NULL, $exclude_filter = NULL) {
		return [];
	}

	public function shipping() {
		$cart = new Cart($this->config, $this->database, $this->request);
		$module_config = $this->config->moduleConfig('\modules\shipping_flat_rate');
		$method = $this->config->siteConfig()->checkout->shipping_methods->flat_rate;

		$free_shipping = $module_config->free_if_over;
		try {
			$exchange_rate = $this->model->getModel('modules\exchange_rates\classes\models\ExchangeRate');
			if ($free_shipping) {
				$free_shipping = $exchange_rate->convert($this->config->siteConfig()->currency, $free_shipping);
			}
		}
		catch (\Exception $ex) { }

		if ($free_shipping && $cart->getCartTotal() > $free_shipping) {
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
