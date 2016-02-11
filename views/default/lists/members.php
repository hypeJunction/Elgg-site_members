<?php

$filter_context = elgg_extract('filter_context', $vars, 'all');

$base_url = elgg_normalize_url("members/$filter_context") . '?' . parse_url(current_page_url(), PHP_URL_QUERY);

$list_class = (array) elgg_extract('list_class', $vars, array());
$list_class[] = 'elgg-list-members';

$item_class = (array) elgg_extract('item_class', $vars, array());
$item_class[] = 'elgg-member';

$options = (array) elgg_extract('options', $vars, array());

$list_options = array(
	'full_view' => false,
	'limit' => elgg_extract('limit', $vars, elgg_get_config('default_limit')) ? : 10,
	'list_class' => implode(' ', $list_class),
	'item_class' => implode(' ', $item_class),
	'no_results' => elgg_echo('site:members:no_results'),
	'pagination' => elgg_is_active_plugin('hypeLists') || !elgg_in_context('widgets'),
	'pagination_type' => 'default',
	'base_url' => $base_url,
	'list_id' => "members",
	'auto_refresh' => false,
	'item_view' => 'user/format/friend',
);

$getter_options = array(
	'types' => array('user'),
);

$options = array_merge($list_options, $options, $getter_options);

$content = elgg_trigger_plugin_hook('members:list', $filter_context, ['options' => $options], null);

echo $content;
