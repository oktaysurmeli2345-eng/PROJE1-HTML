<?php
// Form POST metoduyla gönderilmiş mi kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Gelen verileri temizle
    $email = htmlspecialchars(trim($_POST['email']));
    $sifre = htmlspecialchars(trim($_POST['sifre']));

    // 1. Sunucu Tarafı Boş Alan Kontrolü
    if (empty($email) || empty($sifre)) {
        // Hatalıysa giriş sayfasına yönlendir
        header("Location: login.html?durum=bos");
        exit();
    }

    // 2. Doğru Kullanıcı Bilgilerini Tanımlama
    $ogrenciNo = "b251210106";
    $dogru_email = $ogrenciNo . "@sakarya.edu.tr";
    $dogru_sifre = $ogrenciNo;

    // 3. Bilgileri Karşılaştırma
    if ($email === $dogru_email && $sifre === $dogru_sifre) {
        // GİRİŞ BAŞARILI: Başarı sayfasını göster
?>
        <!DOCTYPE html>
        <html lang="tr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hoşgeldiniz - Sisteme Giriş Yapıldı</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        </head>
        <body class="bg-dark d-flex align-items-center justify-content-center min-vh-100">
            <div class="text-center text-white">
                <i class="fa-solid fa-shield-check fa-5x text-success mb-4"></i>
                <h1 class="display-4 fw-bold">Hoşgeldiniz <?php echo $ogrenciNo; ?></h1>
                <p class="lead mt-3 text-secondary">Sisteme başarıyla giriş yaptınız.</p>
                <a href="hakkimda.html" class="btn btn-outline-light mt-4 px-4 rounded-pill">Siteye Dön</a>
            </div>
        </body>
        </html>
<?php
    } else {
        // GİRİŞ BAŞARISIZ: Hata parametresiyle giriş sayfasına geri gönder
        header("Location: login.html?durum=hata");
        exit();
    }

} else {
    // Sayfaya direkt linkle girmeye çalışanları login'e atar.
    header("Location: login.html");
    exit();
}
?>
