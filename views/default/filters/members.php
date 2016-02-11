<?php

$filter_context = elgg_extract('filter_context', $vars);

$tabs = elgg_trigger_plugin_hook('members:config', 'tabs', null, array());
foreach ($tabs as $tab) {
	$tab['selected'] = $tab['name'] == $filter_context;
	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array(
	'sort_by' => 'priority',
));