<?php
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $rooms = $_POST['rooms'];
    // сюда нужно вписать токен вашего бота
    define('TELEGRAM_TOKEN', '1824312426:AAGPjCvZZclAJSuulCHRm8XWaR15ID6slg4');
    // сюда нужно вписать ваш внутренний айдишник
    define('TELEGRAM_CHATID', '-1001415200128');
    // Проверяем последнюю цифру кол-ва комнат для корректного окончания

    $text = "Новое сообщение: \n" .
    "Имя: " . $name . "\n" .
    "Номер телефона: " . $phone . "\n" .
    "Количество комнат: " . $rooms;
    message_to_telegram($text);
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
