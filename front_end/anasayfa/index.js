function ilanVer() {
    var ilan_middle = document.getElementById('ilan-middle');
    var ilan_middle_2 = document.getElementById('ilan-middle-2');
    document.getElementById('pp1').style.color = "black";
    document.getElementById('pp2').style.color = "darkolivegreen";

    ilan_middle.style.display = 'block';
    ilan_middle_2.style.display = 'none';

}


function ilanAra() {
    var ilan_middle = document.getElementById('ilan-middle');
    var ilan_middle_2 = document.getElementById('ilan-middle-2');
    document.getElementById('pp2').style.color = "black";
    document.getElementById('pp1').style.color = "darkolivegreen";


    ilan_middle.style.display = 'none';
    ilan_middle_2.style.display = 'block';

}

function ilanListele(ilanNo) {
    var link = "./detayListele.php?ilanNo=" + ilanNo;
    window.location = link;
}

var silinecekID = 0;
var silKisiID = 0;

function ilanSil(ilanNo, kisiID) {
    if (ilanNo == 'yes') {
        var link = "../giris/control.php?S_ilanNo=" + silinecekID + "&kisiID=" + silKisiID;
        window.location = link;
        document.getElementById("popUp").style.display = "none";
        document.getElementById("shadow").style.display = "none";


    } else if (ilanNo == 'no') {
        document.getElementById("popUp").style.display = "none";
        document.getElementById("shadow").style.display = "none";

    } else {
        silinecekID = ilanNo;
        silKisiID = kisiID;
        document.getElementById("popUp").style.display = "block";
        document.getElementById("shadow").style.display = "block";
    }
}

function ilanDuzenle(idNo, userN) {
    var link = "ilanDuzenle.php?editIlanNo=" + idNo + "&user=" + userN;
    window.location = link;
}

function kisiDuzenle(id, userN) {
    var link = "hesapDuzenle.php?id=" + id + "&user=" + userN;
    window.location = link;
}

function kisiSil(res, id, user) {

    if (res == 'ilk') {
        document.getElementById("popUp").style.display = "block";
        document.getElementById("shadow").style.display = "block";
    } else if (res == 'no') {
        document.getElementById("popUp").style.display = "none";
        document.getElementById("shadow").style.display = "none";
    } else if (res == 'yes') {
        document.getElementById("popUp").style.display = "none";
        document.getElementById("shadow").style.display = "none";
        var link = "delete.php?id=" + id + "&user=" + user;
        window.location = link;
    }

}


function loginAgain() {
    var link = "../giris/index.php";
    window.location = link;
}

function anasayfayaDon() {
    var link = "../anasayfa/mainpage.php";
    window.location = link;
}

function ilanDeneme() {
    alert("silindi");

}