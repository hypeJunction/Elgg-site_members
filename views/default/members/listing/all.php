<?php

$params = $vars;

$params['show_search'] = true;

$params['show_sort'] = true;
$default_sort = elgg_get_plugin_setting('default_sort', 'hypeDirectory', 'alpha::asc');
$params['sort'] = get_input('sort', $default_sort);

echo elgg_view('lists/users', $params);