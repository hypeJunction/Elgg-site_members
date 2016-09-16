<?php

namespace hypeJunction\Directory;

class Menus {

	/**
	 * Get filter tabs
	 *
	 * @param string $selected Selected tab name
	 * @param bool   $filter   Filter tabs according to plugin settings
	 * @return array
	 */
	public static function getTabs($selected = '', $filter = true) {
		$tabs = elgg_trigger_plugin_hook('members:config', 'tabs', null, []);
		foreach ($tabs as $name => $tab) {
			$priority = elgg_extract('priority', $tab, 1);
			$priority = elgg_get_plugin_setting("tab:$name", 'hypeDirectory', $priority);
			if ($filter && !$priority) {
				// disabled tab
				unset($tabs[$name]);
				continue;
			}
			$tab['priority'] = (int) $priority;
			if (!isset($tab['name'])) {
				$tab['name'] = $name;
			}
			if (!isset($tab['selected']) && $selected) {
				$tab['selected'] = $tab['name'] == $selected;
			}
			$tabs[$name] = $tab;
		}

		uasort($tabs, function ($a, $b) {
			if ($a['priority'] == $b['priority']) {
				return 0;
			}
			return ($a['priority'] < $b['priority']) ? -1 : 1;
		});

		return $tabs;
	}

	/**
	 * Configure navigation
	 *
	 * @param string $hook   "members:config"
	 * @param string $type   "tabs"
	 * @param array  $return Tabs
	 * @param array  $params Hook params
	 * @return array
	 */
	public static function prepareTabs($hook, $type, $return, $params) {

		$return['all'] = [
			'title' => elgg_echo('members:title:all'),
			'url' => 'members/all',
		];

		foreach ($return as $key => $value) {
			if (!isset($value['name'])) {
				$value['name'] = $key;
			}
			if (isset($value['title'])) {
				$value['text'] = $value['title'];
			}
			if (isset($value['url'])) {
				$value['href'] = $value['url'];
			}
			$return[$key] = $value;
		}

		return $return;
	}

	/**
	 * Prepare site menu
	 *
	 * @param string         $hook   "register"
	 * @param string         $type   "menu"
	 * @param ElggMenuItem[] $return Menu
	 * @param array          $params Hook params
	 * @return ElggMenuItem[]
	 */
	public function setupSiteMenu($hook, $type, $return, $params) {

		$tabs = self::getTabs();
		if (empty($tabs)) {
			// Unregister menu item if there are no tabs to display
			foreach ($return as $key => $item) {
				if ($item->getName() == 'members') {
					unset($return[$key]);
				}
			}
		}

		return $return;
	}

}
