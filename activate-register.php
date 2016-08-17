<?php
require_once('./common/configure.php');
require_once('./classes/Database.class.php');
require_once('./classes/Query.class.php');	
$db = new Query();

$db->storeDetails('tb_users', ' user_status = "A" ',' WHERE user_id="'.$ud.'"');
header('Location: index.php');
