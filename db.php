<?php
$servername = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "2023yaz";

try {
  $DB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die();
}




function TelegramdanMesajGonder($Mesaj)
{

  $Token = "6539946911:AAHX9EtrZE2g9fMVyJQ9HbR-io9oKjdhnQ4";
  $AliciAdi =  "@yaz2023kanal_isinnur";

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.telegram.org/bot{$Token}/sendMessage",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
      'text' => "{$Mesaj}",
      'disable_web_page_preview' => false,
      'disable_notification' => false,
      'reply_to_message_id' => null,
      'chat_id' => "{$AliciAdi}"
    ]),
    CURLOPT_HTTPHEADER => [
      "accept: application/json",
      "content-type: application/json"
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
}
