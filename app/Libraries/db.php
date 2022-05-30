<?php

$db = new PDO('mysql:host=127.0.0.1;dbname=maki01;charset=utf8', 'maki01', 'ahpoo9quah7Feetai7');

//při chybě v SQL chceme vyhodit Exception
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);