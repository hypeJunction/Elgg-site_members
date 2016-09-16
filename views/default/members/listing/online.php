<?php

$params = $vars;

$params['show_sort'] = false;
$params['show_search'] = false;

$params['sort'] = 'last_action::desc';

$time = time() - 600;

$dbprefix = elgg_get_config('dbprefix');
$params['options']['joins']['users_entity'] = "JOIN {$dbprefix}users_entity users_entity on e.guid = users_entity.guid";
$params['options']['wheres']['online'] = "users_entity.last_action >= $time";

echo elgg_view('lists/users', $params);