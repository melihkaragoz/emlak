<?php

include "../connect.php";

if(isset($_POST)){

    if(isset($_POST['kisi'])){

        $guncelleUsername = $_POST['guncelleUsername'];
        $guncellePass = $_POST['guncellePass'];
        $guncellePhone = $_POST['guncellePhone'];
        $guncelleMail = $_POST['guncelleMail'];
        $id = $_POST['id'];
        $username = $_POST['username'];

        $guncelle = $baglanti->query(
            "UPDATE kisiler SET 
            username = '$guncelleUsername', 
            pass = '$guncellePass' ,
            phone = '$guncellePhone', 
            mail = '$guncelleMail' 
            WHERE id = '$id'");

        if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);

        $link = "Location:hesabim.php?id=".$id."&user=".$username."&edit=ok";
        header($link); 

    }

    if(isset($_POST['ilan'])){
        if(isset($_POST['guncelleBaslik'])){
            

            $guncelleBaslik = $_POST['guncelleBaslik'];
            $guncelleDurum = $_POST['guncelleDurum'];
            $guncelleIl = $_POST['guncelleIl'];
            $guncelleIlce = $_POST['guncelleIlce'];
            $guncelleOda = $_POST['guncelleOda'];
            $guncelleM2 = $_POST['guncelleM2'];
            $guncelleAciklama = $_POST['guncelleAciklama'];
            $guncelleFiyat = $_POST['guncelleFiyat'];
            $idNo  = $_POST['ilanNo'];
            $user = $_POST['userN'];
            $username = $_POST['username'];
            $guncelleFiyat = str_replace(".","",$guncelleFiyat);
    
    
    
    
            $guncelle = $baglanti->query(
                "UPDATE ilanlar SET 
                ilanBasligi = '$guncelleBaslik', 
                ilanDurumu = '$guncelleDurum', 
                fiyat = '$guncelleFiyat', 
                il = '$guncelleIl', 
                ilce = '$guncelleIlce', 
                oda = '$guncelleOda', 
                m2 = '$guncelleM2', 
                aciklama = '$guncelleAciklama' 
                WHERE ilanNo = '$idNo'");
    
                if ($baglanti->connect_errno > 0) die("<b>Bağlantı Hatası:</b> " . $baglanti->connect_error);
                $link = "Location:ilanlarim.php?editIlanNo=".$idNo."&id=".$user."&edit=ok";
                header($link); 
                
        }
    }



}

?>