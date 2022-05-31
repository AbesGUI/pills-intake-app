<?php

require('/home/httpd/html/users/maki01/pills-intake/vendor/phpmailer/phpmailer/src/PHPMailer.php');
require('/home/httpd/html/users/maki01/pills-intake/vendor/phpmailer/phpmailer/src/SMTP.php');
require('/home/httpd/html/users/maki01/pills-intake/vendor/phpmailer/phpmailer/src/Exception.php');
require('/home/httpd/html/users/maki01/pills-intake/vendor/phpmailer/phpmailer/src/POP3.php');
require('/home/httpd/html/users/maki01/pills-intake/app/Libraries/db.php');

$users = $db->query('SELECT user_id FROM oauth_users')->fetchAll(PDO::FETCH_COLUMN);

foreach ($users as $key => $value) {
    $results = $db->query('SELECT d.name AS drug_name, s.periodicity, ou.email
                        FROM drugs d
                            JOIN schedule s USING (drug_id)
	                        JOIN categories c 
	                            ON d.drug_category_id = c.category_id
                            JOIN oauth_users ou USING (user_id) WHERE user_id =' . $value . ';')->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($results)) {
        $mailer = new PHPMailer\PHPMailer\PHPMailer();
        $mailer->isSendmail();

        $mailer->addAddress($results[0]['email']);
        $mailer->setFrom('pills_intake@vse.cz');

        $mailer->CharSet = 'utf-8';
        $mailer->Subject = 'Daily pills reminder from "pills-intake"';
        $mailer->isHTML(true);
        $str_to_send = '<html><head><meta charset="utf-8" /></head><body> Hi, here is your pills-intake with
            a reminder, that today you should take:<br><br>';
        foreach ($results as $drug) {
            $str_to_send .= '<b>' . htmlspecialchars($drug['drug_name']) . '</b> at ' . date_format(date_create($drug['periodicity']), 'G:i') . '<br>';
        }
        $str_to_send .= '<br> Sincerely yours, <br> pills-intake app</body></html>';
        $mailer->Body = $str_to_send;
        $mailer->send();
    }
}
