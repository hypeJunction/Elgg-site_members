<?php

$params = $vars;

$params['show_sort'] = false;
$params['show_search'] = true;

$params['sort'] = 'alpha::asc';

echo elgg_view('lists/users', $params);