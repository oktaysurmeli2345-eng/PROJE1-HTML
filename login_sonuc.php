<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sonucu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

    <?php
    // SİSTEMDE KAYITLI OLAN DOĞRU BİLGİLER 
    // SİSTEMDE KAYITLI OLAN DOĞRU BİLGİLER
    $dogru_email = "b251210106@sakarya.edu.tr"; 
    $dogru_sifre = "b251210106";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen verileri al
        $gelen_email = strtolower(trim($_POST['email']));
        $gelen_sifre = strtolower(trim($_POST['password']));

        // Şartname Kuralı: Bilgiler doğruysa "Hoşgeldiniz [Öğrenci No]" yazdır
        if ($gelen_email === $dogru_email && $gelen_sifre === $dogru_sifre) {
            
            // Mail adresinden @ işaretinden önceki kısmı (öğrenci numarasını) parçalayarak alıyoruz
            $ogrenci_no = explode("@", $dogru_email)[0];
            
            echo '
            <div class="col-md-6 text-center">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <i class="fa-solid fa-circle-check text-success fa-5x mb-4"></i>
                        <h1 class="display-5 fw-bold text-dark">Hoşgeldiniz</h1>
                        <h2 class="text-primary fw-bold">' . strtoupper($ogrenci_no) . '</h2>
                        <p class="text-muted mt-3">Sisteme başarıyla giriş yaptınız.</p>
                        <a href="index.html" class="btn btn-dark mt-4 px-5 rounded-pill">Ana Sayfaya Dön</a>
                    </div>
                </div>
            </div>';

        } else {
            // Şartname Kuralı: Bilgiler hatalıysa tekrar login sayfasına yönlendir ve hata mesajı göster
            header("Location: login.html?error=1");
            exit();
        }
    } else {
        // Sayfaya direkt linkten girmeye çalışanları geri at
        header("Location: login.html");
        exit();
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>