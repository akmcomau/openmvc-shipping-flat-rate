<?php

namespace modules\shipping_flat_rate\controllers\administrator;

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

	protected $show_admin_layout = TRUE;

	protected $permissions = [
		'config' => ['administrator'],
	];


	public function config() {
	}
}