var usernameLogin = document.getElementById("loginUsername");
var passwordLogin = document.getElementById("loginPassword");
// --------------------------------------------------- \\
var usernameRegister = document.getElementById("registerUsername");
var passwordRegister = document.getElementById("registerPassword");
var emailRegister = document.getElementById("registerEmail");
// --------------------------------------------------- \\


function girisYap() {
    if (usernameLogin.value && passwordLogin.value) {
        // alert(usernameLogin.value + " olarak giris yapildi .");
        document.getElementById("loginUsername").value = "";
        document.getElementById("loginPassword").value = "";
        window.location.pathname = '../anasayfa/mainpage.html'
    } else {
        alert("Lütfen gerekli alanları doldurun.");
    }
}

function kayitOl() {
    if (usernameRegister.value && passwordRegister.value && emailRegister.value) {
        alert(usernameRegister.value + " adına kayit yapildi .");
        document.getElementById("registerUsername").value = "";
        document.getElementById("registerEmail").value = "";
        document.getElementById("registerPassword").value = "";
        // var bilgiler = {kullaniciAdi : usernameRegister, sifre : passwordRegister,email : emailRegister};
    } else {
        alert("Lütfen gerekli alanları doldurun.");
        console.log("gerekli alanlari doldurun.")
    }
}

function kaydolTxt() {
    document.getElementById("sol").style.display = "none";
    document.getElementById("sag").style.display = "block";
    document.getElementById("kayitx").style.display = "none";
    document.getElementById("girisx").style.display = "block";
}

function girisTxt() {
    document.getElementById("kayitx").style.display = "none";
}

function sifremiUnuttum() {
    alert("Şifre sıfırlama linki hesabınıza gönderildi.");
}

function loginAgain() {
    var link = "../giris/index.php";
    window.location = link;
}