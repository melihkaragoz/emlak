<?php
    include "../connect.php";

    if(isset($_POST['mailS'])){
        $mail = $_POST['mailS'];
        $username = $_POST['IDS'];
        $baglanti = $GLOBALS['baglanti'];
        $mailControl = $baglanti->query("SELECT mail FROM kisiler WHERE mail = '$mail' AND username = '$username'");
        $satir = mysqli_num_rows($mailControl);
        $userData = $mailControl->fetch_assoc();
        
        if($satir != 0){

            $sifreControl = $baglanti->query("SELECT pass FROM kisiler WHERE mail = '$mail' AND username = '$username'");
            $sorguPass = $sifreControl->fetch_assoc();
            $sifre = $sorguPass['pass'];

            /*mail($mail,"Şifre hatırlatma",$sorguPass['pass']);*/  
            
            $runPython =exec("python3 ./sendmail.py "."$mail"." $sifre");
            echo $runPython;
            header("Location: ../giris/forgot.php?send=ok");
            #print(sys.argv[1])

            echo "<strong><?php echo 'Şifre mail adresinize gönderilmiştir ' ?></strong><br>";

        }else echo "<strong><?php echo 'Mail adresi sistemde kayıtlı değil.' ?></strong><br>";
    }else echo "hata var";
?>