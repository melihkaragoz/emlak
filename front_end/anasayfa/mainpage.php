<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karagoz Emlak</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();
include "../connect.php";
?>

<body>
    <div class="main">

        <div class="for_bck">
            <div class="top">
                <div class="header">

                    <div class="logo">
                        <h2><i onclick="anasayfayaDon();">KARAGOZ</i></h2>
                    </div>

                    <div class="search">
                        <form action="listele.php" method="POST">
                            <input type="text" name="search_input" id="search_input" placeholder="Tek kelime ile ilan ara..." autocomplete="off">
                            <button name="ilanAra">ARA</button>
                        </form>
                    </div>

                    <div class="ilanlarim">
                        <?php
                            $username = $_SESSION['username'];
                            $sorgu = $baglanti->query("SELECT * from kisiler WHERE username = '$username'");
                            $sonuc = $sorgu->fetch_array();
                            $sonuc2 =  $sonuc['id'];
                            $getAddres = "../anasayfa/ilanlarim.php?id=".$sonuc2."&user=".$username;
                            $MyUser = "../anasayfa/hesabim.php?id=".$sonuc2."&user=".$username;

                        ?>
                        <a href= <?php echo $getAddres ?>> <button>İLANLARIM</button></a>
                        <a href= <?php echo $MyUser ?>> <button>HESABIM</button></a>

                    </div>

                    <div class="profile">
                        <center>
                            <p><?php echo $_SESSION['username'] ?></p>
                        </center>
                        <center><a href="../giris/index.php?cikis=ok">çıkış yap </a></center>
                    </div>
                </div>
            </div>
            <?php
                if($_GET['ilanConfirm']== 'yes') echo "<center style=\"margin-top:5%;color:lawngreen;font-weight:bold;font-size:20px;\"><p>İLAN GİRİŞİ BAŞARILI</p></center>";            
                elseif($_GET['ilanConfirm'] == 'no') echo "<center style=\"margin-top:5%;color:orange;font-weight:bold;font-size:20px;\"><p>İLAN GİRİŞİ BAŞARISIZ, LÜTFEN FORMU KONTROL EDİN</p></center>";
            ?>
            
            <div class="bodyx">

                <div class="ilan-top">
                    <p id="pp1" onclick="ilanAra()">İLAN ARA</p>
                    <p id="divider-1"></p>
                    <p id="pp2" onclick="ilanVer()">İLAN VER</p>
                </div>

                <div id="ilan-middle">
                    <?php include "sehirler.php"; ?>

                    <form action="../giris/control.php" method="POST" enctype="multipart/form-data">
                    <p><?php if($_GET['form']=='empty') echo "<p id='centerP'>* LÜTFEN BOŞ ALANLARI DOLDURUN</p>" ?></p><br>
                    <p><?php if($_GET['adFailed']=='yes') echo "<p id='centerP'>* LÜTFEN UYGUN DEĞERLER GİRİN</p>" ?></p><br>

                            <input type="text"  placeholder="İlan başlığı" name="ilan_basligi" autocomplete="off" id="inputT">

                            <input type="file" name="dosya" id="inputImg" ><br><br>

                            <input type="text" style="display: inline; width:30%;" name="ilan_fiyat" placeholder="Fiyat">

                            <input type="radio" value="satilik" name="ilan_durumu" id="inputR0"> <b>Satılık</b>

                            <input type="radio" value="kiralik" name="ilan_durumu" id="inputR"> <b>Kiralık</b> <br><br>

                            <select name="ilan_il" class="inL" id="inputS">
                                <option value="default" selected>İl seçiniz</option>
                                <?php foreach ($sehir as $city) { ?>
                                    <option value=<?php echo $city ?>><?php echo $city; ?></option>
                                <?php } ?>
                            </select>

                            <select name="ilan_ilce" class="inL"  id="inputSa">
                                <option value="merkez" selected>İlçe seçiniz</option>
                            </select>

                            <input type="text" class="selecteD" name="ilan_m2" id="inputM" placeholder="m² (Net)">

                            <input type="text" class="selecteD"  name="ilan_oda" id="inputO" placeholder="Oda Sayısı">

                            <textarea name="adres" id="adres" cols="34" rows="3" placeholder="Adres girin."></textarea>

                            <textarea name="ilan_aciklama" style="display: inline;margin-left:22%;margin-top:5%;" placeholder="Açıklama (Max. 255 karakter)" cols="34" rows="5"></textarea><br>

                        <button name="ilanVer">İlan Ver</button>
                    </form>

                </div>
                <div id="ilan-middle-2"> 
                    <form action="listele.php" method="POST">

                    <div class="formMain">
                    <p>Aşağıdaki formu aradığınız ilandaki <br> özelliklere göre doldurun.</p><br><br>
                        <input type="text" name="ilan_ara_min_fiyat" class="fiyat" placeholder="Min-Fiyat">
                        <input type="text" name="ilan_ara_max_fiyat" class="fiyat" placeholder="Max-Fiyat"><br><br>

                        <input type="radio" value="satilik" class="radioB" name="ilan_ara_durumu"> <b>Satılık</b>

                        <input type="radio" value="kiralik" name="ilan_ara_durumu" id="inputR2"> <b>Kiralık</b> <br><br>

                        <select name="ilan_ara_il" class="inL" id="inputS">
                            <option value="" selected>İl seçiniz</option>
                            <?php foreach ($sehir as $city) { ?>
                                <option value=<?php echo $city ?>><?php echo $city; ?></option>
                            <?php } ?>
                        </select>

                        <select name="ilan_ara_ilce" id="inputS">
                            <option value="" selected>İlçe seçiniz</option>
                        </select><br><br>

                        <input type="text" name="ilan_ara_m2" id="araM" placeholder="m² (Net)"><br><br>

                        <input type="text" name="ilan_ara_oda" id="araO" placeholder="Oda Sayısı"><br><br><br>

                        <button name="ilanAra" class="ilanAramaButon">İLAN ARA</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <div>
            <div>
                <p id="m-header">Yeni Eklenenler</p>
            </div>
            <div class="middle">
            <?php 
                    $baglanti = $GLOBALS['baglanti'];
                    $satir_sayisi = $baglanti->query("SELECT * FROM ilanlar ORDER BY ilanNo DESC");
                    $satir = mysqli_num_rows($satir_sayisi);
                    $for_satir = 0;
                    if($satir > 8){
                        $satir_first = $satir-8;
                    }
                    while($sonuc = $satir_sayisi->fetch_array()){

                        if($for_satir < 8){

                        if($sonuc['ilanDurumu']== 'satilik') $sonuc['ilanDurumu'] = "Satılık";
                        elseif($sonuc['ilanDurumu']== 'kiralik') $sonuc['ilanDurumu'] = "Kiralık";
                        $sonuc['il'] = ucfirst($sonuc['il']);
                        $chr = strlen($sonuc['fiyat']);
                        while($chr >= 4){
                        $sonuc['fiyat'] = substr_replace($sonuc['fiyat'], '.', $chr-3, 0);
                        $chr -= 3;
                        }
            ?>
                <div class="ilan">
                    <article>
                        <?php $hrefID = "detayListele.php?ilanNo=".$sonuc['ilanNo']; ?>
                        <a href=<?php echo $hrefID ?>><img src=<?php echo "../uploads/".$sonuc['fotograf'] ?> width="250px" height="150" alt=""></a>
                    </article>
                    <div class="detay lr">
                        <p id="p1"><?php echo $sonuc['ilanDurumu']. " Daire"; ?> </p>
                        <p id="p2"><?php echo $sonuc['il']?></p>
                    </div>
                    <div class="detay-2 lrb">
                        <p id="p3"><?php echo $sonuc['oda'] ?></p>
                        <p id="p4" class="price"><?php echo $sonuc['fiyat']."₺" ?> </p>
                    </div>
                </div>
                    <?php }$for_satir++;} ?>
            </div>
        </div>
    </div>
    <script src="index.js"></script>
    <div class="goMain"><a href="./mainpage.php">A</a></div>
    <div class="goUp"><a href="#">^</a></div>
    <?php  if($_GET['form'] == 'empty' || $_GET['adFailed'] == 'yes') echo "<script>ilanVer();</script>" ?>
</body>
</html>