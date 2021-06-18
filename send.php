<?php
require_once "connection.php";
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $rooms = $_POST['rooms'];
    define('TELEGRAM_TOKEN', '1824312426:AAGPjCvZZclAJSuulCHRm8XWaR15ID6slg4');
    define('TELEGRAM_CHATID', '-1001415200128');
    $text = "Новое сообщение: \n" .
    "Имя: " . $name . "\n" .
    "Номер телефона: " . $phone . "\n" .
    "Количество комнат: " . $rooms;
    message_to_telegram($text);
    $query = "INSERT INTO messages (name, phone, rooms) VALUES ('$name', '$phone', '$rooms')";
    mysqli_query($link, $query);
}

function message_to_telegram($text) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
