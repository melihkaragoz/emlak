
<?php


session_start(); // oturum işlemi için session olayını başlat.

$_SESSION['girisControl'] = false;
$kayitli = false;
include "../connect.php";
$yarat = $baglanti->query("CREATE TABLE IF NOT EXISTS kisiler(id TEXT,username TEXT,pass TEXT,mail TEXT)");

function delete($id){ 
    $baglanti = $GLOBALS['baglanti'];
    $sil = $baglanti->query("DELETE FROM kisiler WHERE id = '$id'");
    if ($baglanti->errno > 0) die("<b>Sorgu Hatası:</b> " . $baglanti->error);
    echo "<br>"."silme islemi basarili"."<br>";
}  // kullanıcı silme fonksiyonu.

function selectAll(){ 
    $baglanti = $GLOBALS['baglanti'];
    $all = $baglanti->query("SELECT * FROM kisiler");
    return $all;
}  // veritabanından tüm kullanıcı verilerini çek.

function addUser($kullaniciAdi,$sifre,$mail,$phone){

    $baglanti = $GLOBALS['baglanti'];
    $tarih = date("d.m.Y");    
    $add = $baglanti->query("INSERT INTO kisiler(id,username,pass,mail,phone,registerDate) VALUES('0','$kullaniciAdi','$sifre','$mail','$phone','$tarih')");
    if ($baglanti->errno > 0) die("<b>Sorgu Hatası:</b> " . $baglanti->error);
    echo "<br>"."kayit basarili"."<br>";

}  // kullanıcı ekleme fonksiyonu.

function addAd($ilan_basligi,$ilan_foto,$kisiID,$ilan_fiyati,$ilan_durumu,$ilan_il,$ilan_ilce,$ilan_adres,$ilan_m2,$ilan_oda,$ilan_aciklama){
    $aciklamaChar = strlen($ilan_aciklama);
    $tarih = date("d.m.Y");    
    if($aciklamaChar <= 255){
    $baglanti = $GLOBALS['baglanti'];
    for($i=0; $i<$aciklamaChar; $i++){
        if($ilan_aciklama[$i]=="'"){
            $ilan_aciklama[$i] = " ";
        }
    }
    $add = $baglanti->query("INSERT INTO ilanlar(ilanBasligi,fotograf,kisiID,fiyat,ilanDurumu,il,ilce,adres,m2,oda,aciklama,tarih) VALUES('$ilan_basligi','$ilan_foto','$kisiID','$ilan_fiyati','$ilan_durumu','$ilan_il','$ilan_adres','$ilan_ilce',$ilan_m2,'$ilan_oda','$ilan_aciklama','$tarih')");
    //if ($baglanti->errno > 0) die("<b>Sorgu Hatası:</b> " . $baglanti->error);
    if ($baglanti->errno > 0) header("Location: ../anasayfa/mainpage.php?adFailed=yes");
    else{
        echo "<br>"."ilan girisi basarili"."<br>";
        header("Location: ../anasayfa/mainpage.php?ilanConfirm=yes");
    }
    }else header("Location: ../anasayfa/mainpage.php?ilanConfirm=no");
}   

function deleteAd($ilanNo,$kisiID){
    $baglanti = $GLOBALS['baglanti'];
    $sorgu = $baglanti->query("SELECT username FROM kisiler WHERE id = '$kisiID'");
    $sonuc = $sorgu->fetch_array();
    if($_SESSION['username'] == $sonuc['username']){
        $fotoSil = $baglanti->query("SELECT fotograf FROM ilanlar WHERE ilanNo = '$ilanNo'");
        if ($baglanti->errno > 0) die("<b>Sorgu Hatası:</b> " . $baglanti->error);
        $foto = $fotoSil->fetch_array();
        if(isset($foto['fotograf'])){
            if($foto['fotograf'] != "no-foto.png" ){
                $fotoTMP = $foto['fotograf'];
                $command=shell_exec("rm ../uploads/$fotoTMP 2>&1");
                print_r($command);
            }
        } 
        $sil = $baglanti->query("DELETE FROM ilanlar WHERE ilanNo = '$ilanNo' ");
        if ($baglanti->errno > 0) die("<b>Sorgu Hatası:</b> " . $baglanti->error);
        else{
            header("Location: ../anasayfa/ilanlarim.php?delete=ok&id=$kisiID");
        }    
    }else echo "BU İLANA ERİŞİM İZNİNİZ BULUNMUYOR";
}


if(isset($_POST)){

    if(isset($_POST['giris'])){ // giris butonuna tıklanınca girilen bilgileri kontrol edip giris yap.

        if(!empty($_POST['login_username']) && !empty($_POST['login_password'])){
            echo "giris islemi"."<br>";
            $gecici_username = $_POST['login_username'];
            $gecici_password = $_POST['login_password'];
            $sorgu = $baglanti->query("SELECT pass FROM kisiler WHERE username = '$gecici_username'");
            $row = $sorgu->fetch_assoc();
            $real_password = $row["pass"];
    
            if(isset($real_password)){
                if($gecici_password == $real_password){
                    echo "giris basarili";
                    $_SESSION['girisControl'] = true;
                    $_SESSION['username'] = $gecici_username;
                    $GLOBALS['username'] = $gecici_username;
                    $_SESSION['password'] = $gecici_password;
                    if(!$_SESSION['girisControl']==false){
                        header("Location: ../anasayfa/mainpage.php"); 
                    }else echo "cikis yapildi.";
                } else{
                    header("Location: ../giris/index.php?falseAuth=yes");
                    echo "giris basarisiz, sifrenizi kontrol ediniz.";
                    $_SESSION['girisControl'] = false;
                    $kayitli = true;
                } 
            } else {
                header("Location: ../giris/index.php?falseAuth=yes");
            }
        } else header("Location: ../giris/index.php?lconfirm=no");
    }

    if(isset($_POST['kayit'])){ // kayıt butonuna tıklanınca kontrolleri gerçekleştirip kullanıcıyı ekle.

        //if(!empty(isset($_POST['register_username'])) && !empty(isset($_POST['register_password']))){
        if(!empty($_POST['register_username']) && !empty($_POST['register_password']) && !empty($_POST['register_mail']) && !empty($_POST['register_phone']) ){

            $register_username = $_POST['register_username'];
            $register_password = $_POST['register_password'];
            $register_mail = $_POST['register_mail'];
            $register_phone = $_POST['register_phone'];
            $username_select = $baglanti->query("SELECT * FROM kisiler WHERE username = '$register_username' "); //kullanıcı adının kullanımda olup olmadıgı sorgusu

            //echo "sorgu tamam";
            $satir = mysqli_num_rows($username_select);
            //printf($satir);
            
            if(!($satir==0)) header("Location: ../giris/index.php?kayitli=true");
            else {
                addUser($register_username,$register_password,$register_mail,$register_phone); // kullanıcıyı ekle.
                $runPython =exec("python3 ./kayitmail.py "."$register_mail");
                echo $runPython;
                header("Location: ../giris/kayit.html"); // kullanıcı eklendi bilgisini göster.
            }      

        }else header("Location: ../giris/index.php?empty_rconfirm=yes"); // veriler boş gönderilirse uyarı ver
    }

    if(isset($_POST['girisGeriDon'])){ 
        header("Location: ../giris/index.php"); 
    }  // kayıt işlemi başarılı olursa giris sayfasına yönlendir.


    // #---------------------#
    // #- İLAN VERME İŞLEMİ -#
    // #---------------------#


    if(isset($_POST['ilanVer'])){

        $formDolu = false;
        $kisiUsername = $_SESSION['username'];
        $sorguID = $baglanti->query("SELECT * FROM kisiler WHERE username = '$kisiUsername' ");
        $sorguID = $sorguID->fetch_assoc();
        echo "ID : ".$sorguID['id']."<br>";
        if ($baglanti->connect_error) die("Connection failed: " . $baglanti->connect_error);

        $ID = $sorguID['id'];

        $sonID = $baglanti->query("SELECT ilanNo FROM ilanlar WHERE kisiID = $ID ORDER BY ilanNo DESC LIMIT 1 ");
        $sonID = $sonID->fetch_assoc();
        if ($baglanti->connect_error) die("Connection failed: " . $baglanti->connect_error);
        $newTMP = "";
        $imgErr = false;

        if(isset($_FILES['dosya'])){
            $hata = $_FILES['dosya']['error'];
            if($hata != 0) {
               echo 'Yüklenirken bir hata gerçekleşmiş.';
               $imgErr = true;
            } else {
               $boyut = $_FILES['dosya']['size'];
               if($boyut > (1024*1024*3)){
                  echo 'Dosya 3MB den büyük olamaz.';
                } else {
                  $tip = $_FILES['dosya']['type'];
                  $isim = $_FILES['dosya']['name'];
                  $dosya = $_FILES['dosya']['tmp_name'];
                  $uzanti = explode('.', $isim);
                  $uzanti = $uzanti[count($uzanti)-1];
                  if($tip == 'image/png' || $tip == 'image/jpeg' || $tip == 'image/jpg'){
                    $idNO = $sonID['ilanNo']+1;
                    $newTMP = $sorguID['username'] . "-" . $idNO . "." . $uzanti;
                    if(move_uploaded_file($dosya, '../uploads/' . $newTMP)) echo 'Dosyanız upload edildi!'; 
                    else echo "dosya upload edilemedi.";
                  }else echo "yüklediğiniz dosya bir fotograf degil.";
                }
            }
        }

        echo "dosya yolu : ".$newTMP;
        if($imgErr) $newTMP = "no-foto.png";
        $ilan_basligi = $_POST['ilan_basligi'];
        $kisiID = $sorguID['id'];
        $ilan_fiyati = trim($_POST['ilan_fiyat']);
        $ilan_durumu = $_POST['ilan_durumu'];
        $ilan_il = $_POST['ilan_il'];
        $ilan_ilce = $_POST['ilan_ilce'];
        $ilan_m2 = trim($_POST['ilan_m2']);
        $ilan_oda = trim($_POST['ilan_oda']);
        $ilan_aciklama = $_POST['ilan_aciklama'];
        $ilan_fiyati = str_replace(".","",$ilan_fiyati);
        $ilan_foto = $newTMP;
        $ilan_adres = $_POST['adres'];


        if(!empty($ilan_basligi) && !empty($ilan_fiyati)&& 
        !empty($ilan_durumu) && !empty($ilan_il) && 
        !empty($ilan_ilce) && !empty($ilan_m2) && 
        !empty($ilan_oda)){
            $formDolu = true;
        }

        if($formDolu){
            addAd($ilan_basligi,$ilan_foto,$kisiID,$ilan_fiyati,$ilan_durumu,$ilan_il,$ilan_adres,$ilan_ilce,$ilan_m2,$ilan_oda,$ilan_aciklama);
        }else header("Location: ../anasayfa/mainpage.php?form=empty");

    }


    if(isset($_GET['S_ilanNo']) || isset($_GET['kisiID'])){

        if($_GET['S_ilanNo'] && $_GET['kisiID']){
            $silinecekIlanNo = $_GET['S_ilanNo'];
            $dogrulamaID = $_GET['kisiID'];
            deleteAd($silinecekIlanNo,$dogrulamaID);
        }

    }




    // #---------------------------------# 
    // #- İLAN ARAMA & LİSTELEME İŞLEMİ -#
    // #---------------------------------# 
        
}
if(isset($_GET['forgotpassword'])){ 
    header("Location: ../giris/forgot.php");
}  // sifremi unuttum butonuna tıklayınca şifre sıfırlama ekranına yönlendir.

if(isset($_POST['sil'])){
    $id = $_POST['id'];
    $test = $baglanti->query("SELECT * FROM kisiler WHERE id = '$id'");
   // if ($baglanti->errno > 0) die("<b> Sorgu Hatası:</b> " . $baglanti->error);
    $sonuc = $test->fetch_array();
    delete($id);
}

//addUser($kullaniciAdi,$sifre);

$sorgu->close();
$baglanti->close();


?>
