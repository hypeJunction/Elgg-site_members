<?php

$query = get_input("member_query");
forward("members?query=$query");