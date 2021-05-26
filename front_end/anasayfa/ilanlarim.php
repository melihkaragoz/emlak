<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlanlarım</title>
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
            border-radius: 7px;
            width: 50%;
            min-height: 400px;
            background-color: rgba(150, 160, 140, 0.5);
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
            top: 2%;
            right: 2%;
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
            top: 2%;
            right: 25%;
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
    



    </style>
</head>
<body>
    <div id="popUp">
        İlanı yayından kaldırmak istediğinize emin misiniz ?<br><br><br>
        <button onclick="ilanSil('no');">Hayır</button>
        <button onclick="ilanSil('yes');">Evet</button>
    </div>
    <div id="shadow"></div>
    <?php 

    $idNo =  $_GET['id'];
    $userN = $_GET['user'];
    $username = $userN;
    include "../connect.php";
    $sorgu = $baglanti->query("SELECT * FROM ilanlar WHERE kisiID = '$idNo'");
    if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);

    $satir = mysqli_num_rows($sorgu);
    
    ?>
    <center><h2><?php if($satir != 0)  echo $satir .  " ilan listelendi." ?></h2></center>
    <center><h2><?php if($satir == 0)  echo " Henüz hiç ilan girmediniz " ?></h2></center>
    <center><h3><?php if($_GET['delete']=='ok') echo "İLAN SİLME BAŞARILI." ?></h3></center>
    <?php 
    
    while($sonuc = $sorgu->fetch_array()){

        $chr = strlen($sonuc['fiyat']);
        while($chr >= 4){
        $sonuc['fiyat'] = substr_replace($sonuc['fiyat'], '.', $chr-3, 0);
        $chr -= 3;
        }        
       
        
    ?>


    <div class="ilan">
        <div id="foto"><img src=<?php echo "../uploads/".$sonuc['fotograf'] ?> alt="" width="250" height="250"></div>
        <div id="bilgiler">
            <ul>
                <br><br>
                <li><b>~ İlan başlığı : </b> <?php echo $sonuc['ilanBasligi'] ?></li>
                <li><b>~ Satılık/Kiralık :</b> <?php echo $sonuc['ilanDurumu'] ?></li>
                <li><b>~ İl/İlçe : </b><?php echo $sonuc['il']." / ".$sonuc['ilce'] ?></li>
                <li><b>~ Oda sayısı : </b><?php echo $sonuc['oda'] ?></li>
                <li><b>~ M²(Net) :</b> <?php echo $sonuc['m2']."m²" ?></li>

            </ul>
        </div>
        <div id="aciklama">
            <b>İlan Açıklaması :</b>
            <i><?php echo $sonuc['aciklama'] ?></i>
            <strong><?php echo $sonuc['fiyat']."₺" ?> </strong>
        </div>  
        
        <button id="yayinK" onclick="ilanSil(<?php echo $sonuc['ilanNo']?>,<?php echo $sonuc['kisiID'] ?>);">YAYINDAN KALDIR</button>
        <button id="duzenle" onclick="ilanDuzenle(<?php echo $sonuc['ilanNo'] ?>,<?php echo $sonuc['kisiID'] ?>);">DÜZENLE</button>


    </div><?php } ?>


<script src="index.js"></script>
<div class="goMain"><a href="./mainpage.php">A</a></div>
<div class="goUp"><a href="#">^</a></div>


</body>
</html>