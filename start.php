<?php

/**
 * Member directory
 *
 * @author Ismayil Khayredinov <info@hypejunction.com>
 * @copyright Copyright (c) 2015-2016, Ismayil Khayredinov
 */
use hypeJunction\Directory\Lists;
use hypeJunction\Directory\Menus;

require_once __DIR__ . '/autoloader.php';

elgg_register_event_handler('init', 'system', function() {

	// Clean up members plugin hook registration
	$list_types = array('newest', 'alpha', 'popular', 'online');
	foreach ($list_types as $type) {
		elgg_unregister_plugin_hook_handler('members:list', $type, "members_list_$type");
	}

	elgg_register_plugin_hook_handler('members:config', 'tabs', [Menus::class, 'prepareTabs'], 999);
	elgg_register_plugin_hook_handler('members:list', 'all', [Lists::class, 'render']);

	elgg_register_plugin_hook_handler('register', 'menu:site', [Menus::class, 'setupSiteMenu']);
});
