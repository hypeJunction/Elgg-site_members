<?php

if (elgg_get_plugin_setting('disable_public_access', 'hypeDirectory')) {
	elgg_gatekeeper();
}

$tabs = \hypeJunction\Directory\Menus::getTabs();
if (empty($tabs)) {
	forward('', '404');
}

$selected = elgg_extract('page', $vars);
if (!$selected || !array_key_exists($selected, $tabs)) {
	$selected = array_values($tabs)[0]['name'];
}

$params = array(
	'selected' => $selected,
	'options' => array(
		'type' => 'user',
		'full_view' => false,
		'no_results' => elgg_echo('members:no_results'),
		'item_view' => 'user/format/friend',
		'list_class' => 'elgg-list-members',
		'item_class' => 'elgg-member',
		'pagination_type' => 'default',
		'base_url' => current_page_url(),
		'list_id' => "members-$selected",
	),
);

$content = elgg_trigger_plugin_hook('members:list', $selected, $params, null);
if ($content === null) {
	forward('', '404');
}

if (elgg_is_xhr()) {
	echo $content;
	return;
}

$title = elgg_echo("members:title:$selected");

$body = elgg_view_layout('content', [
	'content' => $content,
	'title' => $title,
	'filter' => elgg_view('members/filter', [
		'filter_context' => $selected,
	]),
	'sidebar' => elgg_view('members/sidebar', [
		'filter_context' => $selected,
	]),
]);

echo elgg_view_page($title, $body);
