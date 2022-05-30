<?php

require('/home/httpd/html/users/maki01/pills-intake/app/Libraries/db.php');

$delete_query = $db->prepare('DELETE FROM drugs WHERE drug_id IN (
    SELECT drug_id
    FROM schedule
    WHERE date_to = :today
)');

$delete_query->execute([
    ':today' => date('Y-m-d')
]);