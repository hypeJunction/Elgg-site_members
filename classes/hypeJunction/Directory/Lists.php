<?php

namespace hypeJunction\Directory;

class Lists {

	/**
	 * Prepares members list
	 *
	 * @param string $hook   "members:list"
	 * @param string $type   newest|alpha|popular|online
	 * @param string $return List view
	 * @param array  $params Getter options
	 * @return array
	 */
	public static function render($hook, $type, $return, $params) {
		if ($return) {
			return;
		}
		if (elgg_view_exists("members/listing/$type")) {
			return elgg_view("members/listing/$type", $params);
		}
	}
}
