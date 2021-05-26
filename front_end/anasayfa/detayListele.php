<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            box-sizing: content-box;
            color: black;
        }
        body{
            background-image: url(./images/house_photos/pexels-adam-borkowski-4389409.jpg);
            background-size: cover;
        }
        a{
            text-decoration: none;
        }

        .ilan{
            background-color: rgba(150, 180, 150,0.5);
            margin: 5% 25%;
            border: 2px solid gray;
            padding: 20px;
            border-radius: 15px;
            width: 50%;
            min-height: 300px;
        }
        ul{
            list-style: none;
            margin-bottom: 7%;
        }
        ul li{
            padding-bottom: 2%;
            margin-left: 5px;
            font-size: 14px;
            width: 80%;
            font-size: 14px;
        }
        ul li b{
            font-weight: bold !important;
        }
        ul li i{
            color: green;
        }
        #foto{
            float: right;
            margin-right: 2%;
        }
        #foto img{
            border-radius: 7px;
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
            top: 45%;
            left: 3%;
            z-index: 0;
            font-size: 15px;
        }
        #aciklama b{
            font-size: 15px;
        }
        strong{
            /*float: right;*/
            position: absolute;
            top: 5;
            right: 2%;
            z-index: 1;
            color: rgb(33, 33, 33);
            font-size: 20px;
            letter-spacing: .5px;
        }
        b{
            margin-right: 1%;
            color: black !important;
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
    <?php 

    $ilanNo =  $_GET['ilanNo'];

    include "../connect.php";

    $sorgu = $baglanti->query("SELECT * FROM ilanlar WHERE ilanNo = $ilanNo");
    if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
    

    $sonuc = $sorgu->fetch_array();
    $kisiID = $sonuc['kisiID'];
    $kullaniciSorgu = $baglanti->query("SELECT mail,phone FROM kisiler WHERE id = '$kisiID' ");
    $kullaniciSonuc = $kullaniciSorgu->fetch_array();
 
        
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
                <li><b style="color:rgb(33,33,33)"> ----  İlan Bilgileri  ----  </b></li>
                <li><b> İlan başlığı : </b> <?php echo $sonuc['ilanBasligi'] ?></li>
                <li><b> Satılık/Kiralık :</b> <?php echo $sonuc['ilanDurumu'] ?></li>
                <li><b> İl/İlçe : </b><?php echo $sonuc['il']." / ".$sonuc['ilce'] ?></li>
                <li><b> Oda sayısı : </b><?php echo $sonuc['oda'] ?></li>
                <li><b> M²(Net) :</b> <?php echo $sonuc['m2']."m²" ?></li>
                <li><b> İlan tarihi :</b> <?php echo $sonuc['tarih'] ?></li>
                <li></li>
                <li> <b style="color:rgb(33,33,33)">---- Kullanıcı Bilgileri ---- </b></li>
                <li><b> Kullanıcı Tel :</b> <?php echo $kullaniciSonuc['phone']?></li>
                <li><b> Kullanıcı Mail :</b> <?php echo $kullaniciSonuc['mail']?></li>

            </ul>
        </div>
        <div id="aciklama">
            <b>İlan Açıklaması :</b>
            <i><?php echo $sonuc['aciklama'] ?></i>
            <strong><?php echo $sonuc['fiyat']."₺" ?> </strong>
        </div>

    </div>
    <div class="goMain"><a href="./mainpage.php">A</a></div>
    <div class="goUp"><a href="#">^</a></div>



</body>
</html>