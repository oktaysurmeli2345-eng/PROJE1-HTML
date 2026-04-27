<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sonucu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white text-center py-4 rounded-top-4">
                        <h2 class="mb-0">Mesajınız Başarıyla İletildi!</h2>
                    </div>
                    <div class="card-body p-5">
                        <p class="lead text-muted mb-4">Göndermiş olduğunuz form verileri PHP sunucusu tarafından işlenmiş ve aşağıda listelenmiştir:</p>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <?php
                                    // Sadece POST metodu ile gelindiyse işlemi yap
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        
                                        // Formdan gelen verileri değişkene atama (Eğer boşsa 'Belirtilmedi' yaz)
                                        $ad = !empty($_POST['adSoyad']) ? htmlspecialchars($_POST['adSoyad']) : 'Belirtilmedi';
                                        $email = !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : 'Belirtilmedi';
                                        $telefon = !empty($_POST['telefon']) ? htmlspecialchars($_POST['telefon']) : 'Belirtilmedi';
                                        $konu = !empty($_POST['konu']) ? htmlspecialchars($_POST['konu']) : 'Belirtilmedi';
                                        $cinsiyet = !empty($_POST['cinsiyet']) ? htmlspecialchars($_POST['cinsiyet']) : 'Belirtilmedi';
                                        $mesaj = !empty($_POST['mesaj']) ? htmlspecialchars($_POST['mesaj']) : 'Belirtilmedi';
                                        
                                        // Checkbox (Dizi olarak gelir, bunu metne çeviriyoruz)
                                        $tercih = !empty($_POST['iletisimTercihi']) ? implode(", ", $_POST['iletisimTercihi']) : 'Herhangi bir tercih belirtilmedi';

                                        // Verileri Ekrana Basma
                                        echo "<tr><th class='w-25'>Ad Soyad</th><td>$ad</td></tr>";
                                        echo "<tr><th>E-posta</th><td>$email</td></tr>";
                                        echo "<tr><th>Telefon</th><td>$telefon</td></tr>";
                                        echo "<tr><th>Konu</th><td>$konu</td></tr>";
                                        echo "<tr><th>Cinsiyet</th><td>$cinsiyet</td></tr>";
                                        echo "<tr><th>Ulaşım Tercihi</th><td>$tercih</td></tr>";
                                        echo "<tr><th>Mesajınız</th><td>$mesaj</td></tr>";

                                    } else {
                                        echo "<tr><td colspan='2' class='text-danger fw-bold'>HATA: Bu sayfaya doğrudan erişim izniniz yok. Lütfen iletişim formunu kullanın.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="iletisim.html" class="btn btn-outline-dark px-4">Geri Dön</a>
                            <a href="index.html" class="btn btn-primary px-4 ms-2">Ana Sayfa</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>