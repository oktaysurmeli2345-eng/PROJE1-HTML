<!--Formdan gönderilen verileri $_POST süper küresel dizisi ile yakaladım.Sayfanın doğrudan URL yazılarak açılmasını 
engellemek için REQUEST_METHOD == POST kontrolü yaptım; böylece form doldurulmadan bu sayfaya girilemiyor.Kullanıcıdan 
gelen tüm verileri htmlspecialchars() süzgecinden geçirdim. Bu sayede, kötü niyetli birinin form üzerinden zararlı kod 
(script) çalıştırmasını (XSS saldırısı) önledim.Birden fazla seçilebilen "İletişim Tercihi" kutucuklarını (checkbox), 
PHP'deki implode() fonksiyonu ile aralarına virgül koyarak okunabilir bir metne dönüştürdüm.Toplanan ve temizlenen bu 
verileri, Bootstrap'in table-bordered ve table-striped sınıflarını kullanarak profesyonel bir tablo düzeninde ekrana yansıttım.-->

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Sonucu - Oktay Sürmeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="iletisim.html"><i class="fa-solid fa-arrow-left me-2"></i>Geri Dön</a>
            <span class="navbar-text text-white">Sistem Yanıtı</span>
        </div>
    </nav>

    <main class="container mt-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0"><i class="fa-solid fa-circle-check me-2"></i>Mesajınız Başarıyla İletildi</h3>
                        <p class="mb-0 mt-2 opacity-75">Sunucuya ulaşan veriler aşağıda listelenmiştir.</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <?php
                        // Formun POST metoduyla gercekten gonderilip gonderilmedigini kontrol ediyoruz.
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            
                            // Guvenlik: htmlspecialchars ile kullanicidan gelen HTML kodlarini etkisiz hale getirerek XSS saldirilarini onluyoruz.
                            $adSoyad = htmlspecialchars($_POST['adSoyad']);
                            $email = htmlspecialchars($_POST['email']);
                            $telefon = htmlspecialchars($_POST['telefon']);
                            $konu = htmlspecialchars($_POST['konu']);
                            $cinsiyet = isset($_POST['cinsiyet']) ? htmlspecialchars($_POST['cinsiyet']) : "Belirtilmedi";
                            $mesaj = htmlspecialchars($_POST['mesaj']);
                            
                            // Birden fazla secilebilen checkbox verilerini (dizi), aralarina virgul koyarak tek bir metne donusturuyoruz.
                            if (isset($_POST['iletisimTercihi'])) {
                                $tercihler = implode(", ", $_POST['iletisimTercihi']);
                                $tercihler = htmlspecialchars($tercihler);
                            } else {
                                $tercihler = "Tercih belirtilmedi";
                            }

                            // Ekrana tablo şeklinde yazdırmayı sağlıyoruz
                            echo "<table class='table table-bordered table-striped mt-3'>";
                            echo "<tbody>";
                            echo "<tr><th class='w-25 text-end'>Ad Soyad:</th><td>$adSoyad</td></tr>";
                            echo "<tr><th class='text-end'>E-posta:</th><td>$email</td></tr>";
                            echo "<tr><th class='text-end'>Telefon:</th><td>$telefon</td></tr>";
                            echo "<tr><th class='text-end'>Cinsiyet:</th><td>$cinsiyet</td></tr>";
                            echo "<tr><th class='text-end'>Konu:</th><td><span class='badge bg-dark'>$konu</span></td></tr>";
                            echo "<tr><th class='text-end'>Ulaşım Tercihi:</th><td>$tercihler</td></tr>";
                            echo "<tr><th class='text-end'>Mesaj:</th><td class='fst-italic'>\"$mesaj\"</td></tr>";
                            echo "</tbody>";
                            echo "</table>";

                        } else {
                            // Form doldurulmadan bu URL'ye ulasmaya calisanlara hata mesaji gosteriyoruz(alert danger uyarısı).
                            echo "<div class='alert alert-danger text-center'>Bu sayfaya doğrudan erişim izni yoktur. Lütfen iletişim formunu kullanın.</div>";
                        }
                        ?>
                    </div>
                    <!-- Kullanici deneyimi (UX) acisindan, islem bittikten sonra ana sayfaya kolayca donusu saglayan navigasyon butonu. -->
                    <div class="card-footer bg-white text-center py-3 rounded-bottom-4">
                        <a href="iletisim.html" class="btn btn-outline-dark">Yeni Mesaj Gönder</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <p class="mb-0 small">Oktay Sürmeli | PHP Form İşleme Sonucu</p>
    </footer>

</body>
</html>