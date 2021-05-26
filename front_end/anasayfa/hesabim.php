<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesabım</title>
    <style>
        *{
            box-sizing: content-box;
        }
        body{
            position: relative;
            background-image: url(./images/house_photos/white.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        a{
            text-decoration: none;
        }
        #popUp{
            position: fixed;
            top: 30%;
            left: 35%;
            z-index: 8;
            width: 30%;
            background-color: black;
            border: 2px solid gray;
            color: white;
            padding: 20px;
            border-radius: 8px;
            display: none;
        }
        #popUp button{
            float: right;
            margin-left: 5%
        }
        #shadow{
            position: fixed;
            top: 0;
            left: 0;
            z-index: 5;
            width: 1500px;
            height: 100%;
            background-color: gray;
            opacity: 0.9;
            display: none;
        }
        .ilan{
            margin: 3% 25%;
            padding: 30px;
            border-radius: 17px;
            width: 50%;
            min-height: 400px;
            /* background-color: rgba(140, 80, 70, 0.5); */
            background-color: rgba(33, 33, 33,0.3);
            position: relative;
        }
        ul{
            list-style: none;
            margin-bottom: 7%;
            margin-bottom: 50px;
            position: relative;
        }
        ul li{
            padding-bottom: 4%;
            width: 100%;
        }
        ul li i{
            color: green;
        }
        #foto{
            float: left;
            margin-right: 7%;
            margin-top: 4%;
        }
        #foto img{
            border-radius: 10px;
        }
        #bilgiler{
            display: inline;
        }
        #aciklama{
            width: 100%;
            height: 100px;
            border-top: 1px solid gray;
            padding: 10px;
            position: relative;
            overflow: auto;
        }
        #aciklama i{
            position: absolute;
            top: 50%;
            left: 0;
            z-index: 0;
        }
        #aciklama b{
            font-size: 20px;
        }
        strong{
            /*float: right;*/
            position: absolute;
            top: 5;
            right: 0;
            z-index: 1;
            color: rgb(33, 33, 33);
            font-size: 20px;
            letter-spacing: .5px;
        }
        b{
            margin-right: 1%;
        }
        .bla{
            position: relative;
        }
        #yayinK{
            position: absolute;
            bottom: 10%;
            left : 55%;
            width: 20%;
            background-color: darkred;
            border: 2px solid darkred;
            color: white;
            font-weight: bold;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
        }
        #duzenle{
            position: absolute;
            bottom: 10%;
            left: 20%;
            width: 20%;
            background-color: darkgoldenrod;
            border: 2px solid darkgoldenrod;
            color: white;
            font-weight: bold;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
        }

        #loginAgain{
            position: absolute;
            bottom: 10%;
            right: 40%;
            background-color: darkgoldenrod;
            border: 2px solid darkgoldenrod;
            color: white;
            font-weight: bold;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
        }

        .goUp {
            width: 3%;
            border: 3px solid black;
            border-radius: 10px;
            text-align: center;
            position: fixed;
            bottom: 15%;
            right: 2%;
        }

        .goUp a {
            padding: 0px;
            color: black;
            font-size: 25px;
            font-weight: bold;
        }

        .goMain {
            width: 3%;
            border: 3px solid black;
            border-radius: 10px;
            text-align: center;
            position: fixed;
            bottom: 8%;
            right: 2%;
        }

        .goMain a {
            padding: 0px;
            color: black;
            font-size: 25px;
            font-weight: bold;
        }

        h3{
            color: green;
        }


    </style>
</head>
<body>

    <?php 
    $idNo =  $_GET['id'];
    $userN = $_GET['user'];
    $username = $userN;
    include "../connect.php";
    $sorgu = $baglanti->query("SELECT * FROM kisiler WHERE id = '$idNo'");
    if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
    ?>

    <div id="popUp">
        Hesabı silmek istediğinize emin misiniz ?<br><br><br>
        <button onclick="kisiSil('no','0','0');">Hayır</button>
        <button onclick="kisiSil('yes','<?php echo $_GET['id'] ?>','<?php echo $_GET['user'] ?>');">Evet</button>
    </div>
    <div id="shadow"></div>

    <center><h2> HESABIM </h2></center>
    <center><h3><?php if($_GET['edit']=='ok') echo "✓ BİLGİLERİNİZ BAŞARIYLA GÜNCELLENDİ "; else echo " " ?></h3></center>

    <?php 

    $sonuc = $sorgu->fetch_array();
    $pass = $sonuc['pass'];
    for($i=0; $i<strlen($pass); $i++) $pass[$i] = "*";
    ?>


    <div class="ilan">
        <div id="bilgiler">
            <ul>
                <br><br>
                <li><b> Kullanıcı Adı : </b> <?php echo $sonuc['username'] ?></li>
                <li><b> Şifre : </b> <?php echo $pass ?></li>
                <li><b> Telefon Numarası :</b> <?php echo $sonuc['phone'] ?></li>
                <li><b> Mail Adresi : </b><?php echo $sonuc['mail'] ?></li>
                <li><b> Kayıt Tarihi </b><?php echo $sonuc['registerDate'] ?></li>

            </ul>
        </div>
        <form action="hesapDuzenle.php" method="post">
            <input type="hidden" name="id" value="<?php echo $sonuc['id']?>">
            <input type="hidden" name="pass" value="<?php echo $sonuc['pass']?>">
            <input type="hidden" name="username" value="<?php echo $sonuc['username']?>">

            <button id="duzenle" name="duzenle">DÜZENLE</button>
        </form>

        <button id="yayinK" name="sil" onclick="kisiSil('ilk','0','0');">HESABI SİL</button>

        <button id="loginAgain" onclick="loginAgain();" >TEKRAR GİRİŞ YAP</button>

    </div>

<script src="index.js"></script>
<script> document.getElementById('loginAgain').style.display = "none" </script>
<?php 
        if(isset($_GET['edit'])) if($_GET['edit'] == "ok"){ ?>
            <script> document.getElementById('yayinK').style.display = 'none'; </script>
            <script> document.getElementById('duzenle').style.display = 'none'; </script>
            <script> document.getElementById('loginAgain').style.display = "block" </script>
        <?php } ?>
<div class="goMain" id="goMainID"><a href="./mainpage.php">A</a></div>
<div class="goUp" id="goUpID"><a href="#">^</a></div>


</body>
</html>