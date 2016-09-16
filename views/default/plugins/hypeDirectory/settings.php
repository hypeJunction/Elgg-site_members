<?php

$entity = elgg_extract('entity', $vars);

$tabs = \hypeJunction\Directory\Menus::getTabs(false, false);

$options_values = [
	0 => elgg_echo('directory:tabs:disable'),
];

for ($i = 1; $i <= count($tabs); $i++) {
	$options_values[$i] = elgg_echo('directory:tabs:position', [$i]);
}

foreach ($tabs as $tab) {
	$name = $tab['name'];
	echo elgg_view_input('select', [
		'name' => "params[tab:$name]",
		'label' => elgg_echo("members:title:{$name}"),
		'help' => elgg_echo('directory:tabs:position:help'),
		'value' => $entity->{"tab:$name"} ? : $tab['priority'],
		'options_values' => $options_values,
	]);
}

echo elgg_view_input('select', [
	'name' => 'params[disable_public_access]',
	'label' => elgg_echo('directory:disabled_public_access'),
	'help' => elgg_echo('directory:disabled_public_access:help'),
	'value' => $entity->disable_public_access,
	'options_values' => [
		0 => elgg_echo('option:no'),
		1 => elgg_echo('option:yes'),
	],
]);

$sorts = [
	'alpha::asc',
	'alpha::desc',
	'time_created::desc',
	'time_created::asc',
	'friend_count::desc',
	'friend_count::asc',
	'last_action::desc',
	'last_action::asc',
];

$sort_options = [];
foreach ($sorts as $sort) {
	$sort_options[$sort] = elgg_echo("sort:user:$sort");
}

echo elgg_view_input('select', [
	'name' => "params[default_sort]",
	'label' => elgg_echo('directory:default_sort'),
	'help' => elgg_echo('directory:default_sort:help'),
	'value' => $entity->default_sort ? : 'alpha::asc',
	'options_values' => $sort_options,
]);
