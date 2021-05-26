<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMLAK</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php 


if(isset($_GET['cikis'])){
        if($_GET['cikis']=='ok'){
        $_SESSION['girisControl']= false; 
        header("Location: ".$_SERVER['PHP_SELF']);
        } 
}
?>


<script type = "text/javascript" >
    history.pushState(null, null, location.href);
    history.back();
    history.forward();
    window.onpopstate = function () { history.go(1); };
     
    function preventBack() { window.history.forward(); }
 
    setTimeout("preventBack()", 0);
    window.onunload = function () { null };
    
    preventBack();
    
    window.onload = preventBack();
    window.onpageshow = function(evt) { if (evt.persisted) preventBack() }
</script><!-- SAYFADA GERİ DÖNMEYİ ENGELLEMEK İÇİN -->


<body>
    <!-- <div class="baslik"><center> <p style="display: inline;font-size: 60px;">|</p><p style="display: inline; color: red;">RUB</p>WALLY</center></div> -->
    <div class="baslik">
        <center>
            <p id="gondergelsin1"
                style="display: inline; color: rgb(255,255,100); padding-top: 10px;padding-left: 15px;margin-left: 8%;">KARAGOZ</p>
            <p id="gondergelsin" style="display: inline;">EMLAK</p>
            <p id="alttire" style="display: inline; color: transparent;">|</p>
        </center>
    </div>
    <div class="main">
        <div id="sol" class="left box">
            <h2>Giriş Yap</h2>
            <form action="control.php" method="POST">
                <input type="text" id="loginUsername" name="login_username" placeholder="Kullanıcı adı"
                    autocomplete="off"><br><br>
                <input type="password" id="loginPassword" name="login_password" placeholder="Şifre" autocomplete="off">
                <p id="forgotpass"><a href="control.php?forgotpassword"  onclick="sifremiUnuttum();">Şifreni mi unuttun ?</a></p>
                <button type="submit" class="button0" name="giris" onclick="girisYap();" d>GİRİŞ</button>
                <?php if(isset($_GET['lconfirm'])){if($_GET['lconfirm']=="no") echo "<p id='req'>* LÜTFEN GEREKLİ ALANLARI DOLDURUN.</p>";}  ?>
                <?php if(isset($_GET['falseAuth'])){if($_GET['falseAuth']=="yes") echo "<p id='req'>* KULLANICI ADI VE ŞİFRE YANLIŞ.</p>";}  ?>
            </form>
        </div>
        <div class="divider"></div>
        <div id="sag" class="right box">
            <h2>Kayıt OL</h2>
            <form action="control.php" method="POST">
                <input type="text" name="register_username" id="register_username" placeholder="Kullanıcı adı"
                    autocomplete="off"><br><br>
                <input type="email" name="register_mail" id="register_mail" placeholder="E-Posta" autocomplete="off"><br><br>
                <input type="password" name="register_password" id="register_password" placeholder="Şifre" autocomplete="off"><br><br>
                <input type="phone" name="register_phone" id="register_phone" placeholder="Telefon Numarası" autocomplete="off"><br><br>
                <button class="button0 btnMarg" name="kayit" onclick="kayitOl();">KAYIT</button>
                <?php if(isset($_GET['empty_rconfirm'])){if($_GET['empty_rconfirm']=="yes") echo "<p id='req'>* LÜTFEN GEREKLİ ALANLARI DOLDURUN.</p>";}  ?>
                <?php if(isset($_GET['kayitli'])){ if($_GET['kayitli']=="true") echo "<p id='req'>* BU KULLANICI ADI DAHA ÖNCE ALINMIŞ.</p>" ;} ?>
                <?php if(isset($_GET['mail_rconfirm'])){if($_GET['mail_rconfirm']=="yes") echo "<p id='req'>* MAİL ADRESİ KULLANIMDA.</p>" ;} ?>
            </form>
        </div>
    </div>
    <center>
        <p id="kayitx">Hesabın yok mu ? <a href="#" onclick="kaydolTxt();">Kaydol.</a></p>
        <p id="girisx">Zaten hesabın var mı ? <a onclick="girisTxt();" href="">Giriş Yap.</a></p>
    </center>




 
</body>

</html>