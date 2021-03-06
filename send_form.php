<?php
header("content-type: application/json; charset=utf-8");

$name = isset($_POST['name']) ? $_POST['name'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$message = isset($_POST['message']) ? $_POST['message'] : "";

if ($name && $email && $message) {
    $headers = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: 8bit";
    $message_body = "Formularz kontaktowy wysłany ze strony www.elizanowakowska.com\n";
    $message_body .= "Imię: $name\n";
    $message_body .= "Adres email: $email\n\n";
    $message_body .= $message;
    if (mail("kontakt@elizanowakowska.com", "Formularz kontaktowy", $message_body, $headers)) {
        $json = array("status" => 1, "msg" => "<b>Twój formularz został pomyślnie wysłany.</b>");
    } else {
        $json = array("status" => 0, "msg" => "<b>Wystąpił problem z wysłaniem formularza.</b>");
    }
} else {
    $json = array("status" => 0, "msg" => "<b>Proszę wypełnić wszystkie pola przed wysłaniem.</b>");
}

echo json_encode($json);

exit;
