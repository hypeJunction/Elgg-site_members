<?php

$filter_context = elgg_extract('filter_context', $vars);

$tabs = \hypeJunction\Directory\Menus::getTabs($filter_context);

if (sizeof($tabs) <= 1) {
	return;
}

foreach ($tabs as $tab) {
	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array(
	'sort_by' => 'priority',
));