<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlanlar</title>
    <link rel="stylesheet" href="liste_style.css">

</head>
<body>
        <?php

            include "../connect.php";

            if(isset($_POST['ilanAra'])){

                

                $_POST['ilan_ara_min_fiyat'] = str_replace(".","",$_POST['ilan_ara_min_fiyat']);
                $_POST['ilan_ara_max_fiyat'] = str_replace(".","",$_POST['ilan_ara_max_fiyat']);

                $sorgu = "SELECT * FROM ilanlar ";

                if(isset($_POST['ilan_ara_min_fiyat']) && $_POST['ilan_ara_min_fiyat'] != NULL){
                    $sorgu_min_fiyat = $_POST['ilan_ara_min_fiyat'];
                    if($sorgu == "SELECT * FROM ilanlar ") $sorgu .= " WHERE fiyat >= $sorgu_min_fiyat ";
                    else $sorgu .= "fiyat >= $sorgu_min_fiyat ";
                }
                if(isset($_POST['ilan_ara_max_fiyat']) && $_POST['ilan_ara_max_fiyat'] != NULL){
                    $sorgu_max_fiyat = $_POST['ilan_ara_max_fiyat'];
                    if($sorgu == "SELECT * FROM ilanlar ") $sorgu .= " WHERE fiyat <= $sorgu_max_fiyat"; 
                    else $sorgu .= " AND fiyat <= $sorgu_max_fiyat "; 
                }
                if(isset($_POST['ilan_ara_oda']) && $_POST['ilan_ara_oda'] != NULL){
                    $sorgu_oda = $_POST['ilan_ara_oda'];
                    if($sorgu == "SELECT * FROM ilanlar ") $sorgu .= " WHERE oda LIKE '$sorgu_oda' ";
                    else $sorgu .= " AND oda LIKE '$sorgu_oda' ";
                }
                if(isset($_POST['ilan_ara_m2']) && $_POST['ilan_ara_m2'] != NULL){
                    $sorgu_m2 = $_POST['ilan_ara_m2'];
                    if($sorgu == "SELECT * FROM ilanlar ") $sorgu .= " WHERE m2 = $sorgu_m2 ";
                    else $sorgu .= " AND m2 = $sorgu_m2 ";
                }
                if(isset($_POST['ilan_ara_il']) && $_POST['ilan_ara_il'] != NULL){
                    $sorgu_il = $_POST['ilan_ara_il'];
                    if($sorgu == "SELECT * FROM ilanlar ") $sorgu .= " WHERE il LIKE '$sorgu_il' ";
                    else $sorgu .= " AND il LIKE '$sorgu_il' ";
                }
                if(isset($_POST['ilan_ara_ilce']) && $_POST['ilan_ara_ilce'] != NULL){
                    $sorgu_ilce = $_POST['ilan_ara_ilce'];
                    if($sorgu == "SELECT * FROM ilanlar ") $sorgu .= " WHERE ilce LIKE '$sorgu_ilce' ";
                    else $sorgu .= " AND ilce LIKE '$sorgu_ilce' ";
                }
                if(isset($_POST['ilan_ara_durumu']) && $_POST['ilan_ara_durumu'] != NULL){
                    $sorgu_durumu = $_POST['ilan_ara_durumu'];
                    if($sorgu == "SELECT * FROM ilanlar ") $sorgu .= " WHERE ilanDurumu LIKE '$sorgu_durumu' ";
                    else $sorgu .= " AND ilanDurumu LIKE '$sorgu_durumu' ";
                }
                if(isset($_POST['search_input'])){
                    $sorgu_durumu = $_POST['search_input'];
                    $sorgu_durumu_1 = $sorgu_durumu;
                    $sorgu_durumu_il = "";
                    $sorgu_durumu_ilce = "";
                    $sorgu_durumu_ilanDurum = "";
                    for($i=0; $i<strlen($sorgu_durumu); $i++) if($sorgu_durumu[$i] == 'ı') $sorgu_durumu_1[$i] = 'i';
                    $sorgu .= "WHERE il LIKE '$sorgu_durumu_1' OR ilce LIKE '$sorgu_durumu_1' OR ilanDurumu LIKE '$sorgu_durumu_1' OR aciklama LIKE '%$sorgu_durumu%' OR ilanBasligi LIKE '%$sorgu_durumu%' ";
                }

                //echo $sorgu;

                $ilan_ara_min_fiyat = $_POST['ilan_ara_min_fiyat'];
                $ilan_ara_max_fiyat = $_POST['ilan_ara_max_fiyat'];
                $GLOBALS['durum'] = $ilan_ara_durumu = $_POST['ilan_ara_durumu'];
                $ilan_ara_il = $_POST['ilan_ara_il'];
                $ilan_ara_ilce = $_POST['ilan_ara_ilce'];
                $ilan_ara_m2 = $_POST['ilan_ara_m2'];
                $ilan_ara_oda = $_POST['ilan_ara_oda'];

                if($_GET['fiyat'] == 'max'){
                    $sorgu .= " ORDER BY fiyat DESC";
                }elseif($_GET['fiyat'] == 'min'){
                    $sorgu .= " ORDER BY fiyat ASC";
                }

                $ilanGetir = $baglanti->query($sorgu);
                if ($baglanti->connect_error) die("Connection failed: " . $baglanti->connect_error);
                $satir = mysqli_num_rows($ilanGetir); 
                $_SESSION['satir_sayisi'] = $satir;

            
        ?>

    <div class="listeler">
    <?php 
            $satir_sayisi = $_SESSION['satir_sayisi'];
            ?>
            <center><h2><?php if($satir_sayisi != 0)  echo $satir_sayisi .  " ilan listelendi." ?></h2></center>
            <center><h2><?php if($satir_sayisi == 0)  echo " Filtreye uygun ilan bulunamadı." ?></h2></center>
        <table>
            
            <tr>
                <th class="displayNone" >İlan No</th>
                <th>Fotoğraf</th>
                <th>İlan Başlığı</th>
                <th>Durum</th>
                <th class="displayNone" >m²(Net)</th>
                <th class="displayNone" >Oda Sayısı</th>
                <th>Fiyat</th>
                <th>İlan Tarihi</th>
                <th>İl / İlçe</th> 
            </tr>
            <?php while($sonuc = $ilanGetir->fetch_array()){?>

                <?php 
                $chr = strlen($sonuc['fiyat']);
                    while($chr >= 4){
                    $sonuc['fiyat'] = substr_replace($sonuc['fiyat'], '.', $chr-3, 0);
                    $chr -= 3;
                    }


                ?>
                
                <tr onclick="ilanListele(<?php echo $sonuc['ilanNo'] ?>)">
                    <td class="displayNone" ><?php echo $sonuc['ilanNo'] ?></td>
                    <td><img src="<?php echo "../uploads/".$sonuc['fotograf'] ?>" alt="" width="100" height="100"></td>
                    <td><?php echo $sonuc['ilanBasligi'] ?></td>
                    <td><?php echo $sonuc['ilanDurumu'] ?></td>
                    <td class="displayNone" ><?php echo $sonuc['m2'] ?></td>
                    <td class="displayNone" ><?php echo $sonuc['oda'] ?></td>
                    <td id="fiyat-td"><?php echo $sonuc['fiyat']."₺" ?> </td>
                    <td><?php echo $sonuc['tarih'] ?></td>
                    <td><?php echo $sonuc['il']." / ".$sonuc['ilce'] ?></td>
                </tr>
            <?php }} ?>
               
            


        </table>
        
    </div>
    <script src="index.js"></script>
    <div class="goMain"><a href="./mainpage.php">A</a></div>
    <div class="goUp"><a href="#">^</a></div>
    
</body>
</html>