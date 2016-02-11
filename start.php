<?php

/**
 * User Friends
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 * @copyright Copyright (c) 2015, Ismayil Khayredinov
 */
require_once __DIR__ . '/autoloader.php';

elgg_register_event_handler('init', 'system', 'site_members_init');

/**
 * Initialize the plugin
 * @return void
 */
function site_members_init() {

	elgg_register_plugin_hook_handler('members:config', 'tabs', 'site_members_nav_tabs', 999);
	elgg_register_plugin_hook_handler('members:list', 'all', 'site_members_list');
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
function site_members_nav_tabs($hook, $type, $return, $params) {

	$remove = array('newest', 'alpha', 'popular', 'online');
	foreach ($return as $key => $value) {
		if (!isset($value['name'])) {
			$value['name'] = $key;
		}
		if (in_array($value['name'], $remove)) {
			unset($return[$key]);
		}
		if (isset($value['title'])) {
			$value['text'] = $value['title'];
		}
		if (isset($value['url'])) {
			$value['href'] = $value['url'];
		}
	}

	$tab = array(
		'name' => 'all',
		'text' => elgg_echo('site:members:all'),
		'href' => 'members',
	);
	array_unshift($return, $tab);

	return $return;
}

/**
 * Prepares members list
 *
 * @param string $hook   "members:list"
 * @param string $type   "all"
 * @param string $return List view
 * @param array  $params Getter options
 * @return array
 */
function site_members_list($hook, $type, $return, $params) {

	$options = elgg_extract('options', $params);
	if (elgg_view_exists('lists/users')) {
		return elgg_view('lists/users', array(
			'options' => $options,
			'callback' => 'elgg_list_entities',
		));
	} else {
		$dbprefix = elgg_get_config('dbprefix');
		$options['joins'][] = "JOIN {$dbprefix}users_entity ue ON ue.guid = e.guid";
		$options['order_by'] = 'ue.name ASC';

		return elgg_list_entities_from_relationship($options);
	}
}
