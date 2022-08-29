<?php if ( ! defined('CARTTHROB_PATH')) Cartthrob_core::core_error('No direct script access allowed');

use CartThrob\Plugins\Discount\DiscountPlugin;
use CartThrob\Math\Number;

class Cartthrob_discount_percentage_off_over_x_items extends DiscountPlugin
{
	public $title = 'percentage_off_over_x_items';
	public $settings = [
		[
			'name' => 'percentage_off',
			'short_name' => 'percentage_off',
			'note' => 'percentage_off_note',
			'type' => 'text'
		],
		[
			'name' => 'if_more_than_x_items_in_cart',
			'short_name' => 'order_over',
			'note' => 'enter_required_minimum',
			'type' => 'text'
		]
	];
	
	public function get_discount()
	{
		$count = count($this->core->cart->items());
		if ($count >= Number::sanitize($this->plugin_settings('order_over'))) {
			return $this->core->cart->subtotal() * (Number::sanitize($this->plugin_settings('percentage_off')) / 100);
		}
		
		return 0;
		
	}
}