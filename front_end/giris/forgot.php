<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifremi Unuttum</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .main{
            width: 500px;
            height: 30%;
            background-color: white;
            border: 2px solid grey;
            border-radius: 7px;
            align-items: center;
            text-align: center;
            align-content: center;
            margin-top: 15%;
            padding: 20px;
        
        }

        .main strong{
            color: green;
            font-weight: 900;
            font-size: 20px;
        }

        .main #p1{
            margin-top: 10%;
            margin-bottom: 2%;
        }

        .main #p2{
            margin-bottom: 5%;
        }

        button{
            background-color: rgb(70, 120, 70);
            color: white;
            width: 80%;
            height: 40px;
            border-radius: 7px;
        }

    </style>
</head>
<body>

<?php

/*
    if(isset($_GET['id']) && isset($_GET['user'])){
        $get_id = $_GET['id'];
        $baglanti = $GLOBALS['baglanti'];
        $sil = $baglanti->query("DELETE FROM kisiler WHERE id = '$get_id'");
        if ($baglanti->errno > 0) die("<b>Sorgu Hatası:</b> " . $baglanti->error);
    }
*/
?>
    <center><div class="main">
        <form action="mail.php" method="post"><br>
            <input type="text" name="IDS" id="" placeholder="Kullanıcı adınızı girin."> <br><br>
            <input type="text" name="mailS" id="" placeholder="Mail adresinizi girin."> <br><br>
            
            <strong><?php if(isset($_GET['send'])) if($_GET['send']== "ok") echo "Şifreniz mail adresinize iletilmiştir.<br>" ?></strong><br>
            <button name="sifre">Şifremi gönder</button><br><br>
        </form>
        <button onclick="loginAgain();">Giriş Yap / Kayıt OL</button>

        

    </div></center>
    <script src="index.js"></script>
</body>
</html>