<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesap Ayarlarım</title>
    <style>
        *{
            box-sizing: content-box;
        }
        body{
            position: relative;
            background-image: url(./images/house_photos/white.jpg);
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
            margin: 10% 25%;
            padding: 30px;
            border-radius: 17px;
            width: 50%;
            min-height: 400px;
            /* background-color: rgba(140, 80, 70, 0.5); */
            background-color: rgba(33, 33, 33,0.3);
            position: relative;
        }
        .ilan input{
            background-color: rgba(255, 255, 255, 0.3);
            width: 45%;
            padding: 5px;
            border:1px solid rgb(33, 33, 33);
            border-radius: 7px;
        }
        ul{
            list-style: none;
            margin-bottom: 7%;
        }
        ul li{
            padding-bottom: 3%;
            margin-left: 5px;
            width: 80%;
        }
        ul li i{
            color: green;
        }
        #foto{
            float: right;
            margin-right: 5%;
        }
        #bilgiler{
            display: inline;
        }
        #bilgiler input{
            display: inline;
        }
        #bilgiler b{
            display: inline;
        }
        strong{
            /*float: right;*/
            position: absolute;
            top: 5;
            right: 0;
            z-index: 1;
            color: green;
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
            top: 2%;
            right: 2%;
            background-color: red;
            color: white;
            font-weight: bold;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
        }
        #duzenle{
            position: absolute;
            top: 2%;
            right: 25%;
            background-color: orange;
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

        button{
            width: 20%;
            padding: 8px;
            border-radius: 7px;
            background-color: orange;
            font-weight: bolder;
            border:none;
        }
        #ilce{
            width: 10%;
        }
        #il{
            width: 25%;
        }
        .hidden input{
            display: none;
        }

    </style>
</head>
<body>
    <div id="popUp">
        Bilgileri güncellemek istediğinize emin misiniz ?<br><br><br>
        <button onclick="guncelle('no');">Hayır</button>
        <form action="../giris/control.php" method="post"></form>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <button name="sil" >Evet</button>
    </div>
    <div id="shadow"></div>

 

    <?php 
    $idNo =  $_POST['id'];
    $userN = $_POST['username'];
    include "../connect.php";
    $sorgu = $baglanti->query("SELECT * FROM kisiler WHERE id = '$idNo'");
    if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
    ?>

    <center><h3><?php if($_GET['delete']=='ok') echo "KİŞİ SİLME BAŞARILI." ?></h3></center>

    <?php 
    while($sonuc = $sorgu->fetch_array()){   
    ?>

    <div class="ilan">
        <form action="editControl.php" method="POST">
        <div id="bilgiler">
            <ul>

                <li><b>Kullanıcı Adı : </b> <input type="text" name="guncelleUsername" value="<?php echo $sonuc['username'] ?>"> </li>
                <li><b>Şifre : </b> <input type="text" name="guncellePass" value="<?php echo $sonuc['pass'] ?>"> </li>
                <li><b>Telefon Numarası :</b> <input type="text" name="guncellePhone" value="<?php echo $sonuc['phone'] ?>"></li>
                <li><b>Mail adresi :  </b><input type="text" name="guncelleMail" value="<?php echo $sonuc['mail']?>">
                <li><b> Kayıt Tarihi :  </b><?php echo $sonuc['registerDate'] ?></li>
                <div class="hidden">
                <input type="text" name="username" style="display: none;"   value="<?php echo $_POST['username'] ?>">
                <input type="text" name="id" style="display: none;"   value="<?php echo $idNo ?>">
                </div>

            </ul>
        </div>

        <center><button name="kisi">Güncelle</button></center>
        </form>
    </div><?php } ?>


<div class="goMain"><a href="./mainpage.php">A</a></div>
<div class="goUp"><a href="#">^</a></div>


</body>
</html>