<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlan Düzenle</title>
    <style>
        *{
            box-sizing: content-box;
        }
        body{
            position: relative;
            background-image: url(./images/house_photos/pexels-adam-borkowski-4389409.jpg);
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
            margin: 3% 20%;
            border: 2px solid gray;
            padding: 30px;
            border-radius: 7px;
            width: 60%;
            min-height: 350px;
            background-color: rgba(150, 160, 140, 0.5);
            position: relative;
        }
        .ilan input{
            background-color: rgba(255, 255, 255, 0.3);
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
        #aciklama{
            width: 100%;
            height: 150px;
            border-top: 1px solid gray;
            padding: 10px;
            position: relative;
            overflow: auto;
        }
        #aciklama i{
            position: absolute;
            top: 35%;
            left: 0;
            z-index: 0;
        }
        #aciklama textarea{
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            border-radius: 7px;
            padding: 10px;
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
        İlanı güncellemek istediğinize emin misiniz ?<br><br><br>
        <button onclick="guncelle('no');">Hayır</button>
        <button onclick="guncelle('yes');">Evet</button>
    </div>
    <div id="shadow"></div>
    <?php 

    $idNo =  $_GET['editIlanNo'];
    $userN = $_GET['userN'];
    include "../connect.php";
    $sorgu = $baglanti->query("SELECT * FROM ilanlar WHERE ilanNo = '$idNo'");
    if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
    
    ?>
    <center><h3><?php if($_GET['delete']=='ok') echo "İLAN SİLME BAŞARILI." ?></h3></center>
    <?php 
    
    while($sonuc = $sorgu->fetch_array()){
   
       
        
    ?>


    <div class="ilan">
        <form action="editControl.php" method="POST">
        <div id="foto"><img src=<?php echo "../uploads/".$sonuc['fotograf'] ?> alt="" width="250" height="250"></div>
        <div id="bilgiler">
            <ul>

                <li><b>~ İlan başlığı : </b> <input type="text" name="guncelleBaslik" value="<?php echo $sonuc['ilanBasligi'] ?>"> </li>
                <li><b>~ Satılık/Kiralık :</b> <input type="text" name="guncelleDurum" value="<?php echo $sonuc['ilanDurumu'] ?>"></li>
                <li><b>~ İl/İlçe : </b><input type="text" id="il" name="guncelleIl" value="<?php echo $sonuc['il']?>">
                <input type="text" id="ilce" name="guncelleIlce" value="<?php echo $sonuc['ilce'] ?>"></li>
                <li><b>~ Oda sayısı : </b><input type="text" name="guncelleOda" value="<?php echo $sonuc['oda'] ?>"></li>
                <li><b>~ M²(Net) :</b> <input type="text" name="guncelleM2" value="<?php echo $sonuc['m2'] ?>"></li>
                <div class="hidden">
                <input type="text" name="userN" style="display: none;"   value="<?php echo $_GET['user'] ?>">
                <input type="text" name="ilanNo" style="display: none;"   value="<?php echo $idNo ?>">
                </div>

            </ul>
        </div>
        <div id="aciklama">
            <b>İlan Açıklaması :</b>
            <i><textarea name="guncelleAciklama" cols="105" rows="5" ><?php echo $sonuc['aciklama'] ?></textarea></i>
            <strong><input type="text" name="guncelleFiyat" value="<?php echo $sonuc['fiyat'] ?>"></strong>
        </div><br><br>
        <center><button name="ilan">Güncelle</button></center>
        </form>
    </div><?php } ?>


<script src="index.js"></script>
<div class="goMain"><a href="./mainpage.php">A</a></div>
<div class="goUp"><a href="#">^</a></div>


</body>
</html>