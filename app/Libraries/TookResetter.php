<?php
require('/home/httpd/html/users/maki01/pills-intake/app/Libraries/db.php');

$users = $db->query('UPDATE schedule SET took_today = 0 WHERE took_today <> 0');


