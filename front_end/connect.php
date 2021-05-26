<?php 

$baglanti = new mysqli("localhost", "<dbusername>", "<dbpassword>", "dbname");   // veritabanına baglanma komutları
$GLOBALS['baglanti'] = $baglanti;
if ($baglanti->connect_errno > 0) die("<b>Bağlanti Hatası:</b> " . $baglanti->connect_error);
$baglanti->set_charset("utf8");
//echo "<br>"."baglanti tamam !"."<br>";


?>
