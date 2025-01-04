<?php
include('baglan.php');			  
sleep(1);

$islem = @$_GET['islem'];
$harf = @$_GET['filtre_harf'];
$f_kategori = @$_GET['filtre_kategori'];

if ($islem == 'film') {
  $sql = "SELECT f.id as id, f.adi as adi, f.cikis_yili as cikis_yili, f.tanitim as tanitim, f.durum as durum,
          y.id as y_id, y.adi as y_adi, y.soyadi as y_soyadi, k.id as kategori_id, k.adi as kategori
          FROM filmler as f
          JOIN yonetmenler as y ON f.yonetmen_id = y.id
          JOIN kategoriler as k ON f.kategori_id = k.id
          WHERE 1=1";

  if ($harf && $harf != 'tum') {
    $sql .= " AND f.adi LIKE '$harf%'";
  }

  if ($f_kategori) {
    $kategori_dizi = explode(',', $f_kategori);
    $kategori_dizi = array_map('intval', $kategori_dizi);
    $kategori_dizi = implode(',', $kategori_dizi);
    $sql .= " AND f.kategori_id IN ($kategori_dizi)";
  }

  $sql .= " ORDER BY f.adi ASC";
  $sorgu_film = mysqli_query($conn, $sql);

  echo "<style>
          .img-box img {
            width: 100%;
            height: 400px; /* Sabit yükseklik */
            object-fit: cover; /* Resmi kutuya sığdır */
            border-radius: 10px;
          }
          .film-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
          }
          .film-item {
            margin-bottom: 20px;
            flex: 1 1 30%; /* Genişliği ayarlamak için */
            
            box-sizing: border-box; /* Padding ve border dahil */
            padding: 10px; /* Aralık eklemek için */
          }
          .box {
            display: flex;
            flex-direction: column;
            align-items: center;
          }
          .detail-box {
            text-align: center;
          }
        </style>";

  echo "<div class='film-container row'>";
  while ($satir_film = mysqli_fetch_array($sorgu_film)) {
    $film_id = $satir_film['id'];
    $sorgu_resim = mysqli_query($conn, "SELECT * FROM resimler WHERE film_id = $film_id");
    $satir_resim = mysqli_fetch_array($sorgu_resim);

    echo "<div class='film-item'>";
    echo "<div class='box'>";
    echo "<div class='img-box'>";
    echo "<a href='film_detay.php?film_id=" . $film_id . "'>";
    echo "<img src='images/filmler/" . $satir_resim['adi'] . "' alt='" . $satir_film['adi'] . "'>";
    echo "</a>";
    echo "</div>";
    echo "<div class='detail-box'>";
    echo "<h5>" . $satir_film['adi'] . "</h5>";
    echo "<div class='price_box'>";
    echo "<h6 class='price_heading'>" . $satir_film['cikis_yili'] . "</h6>";
    echo "<a href='film_detay.php?film_id=" . $film_id . "'>İncele</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
  echo "</div>";
} elseif ($islem == 'iletisim') {
  $ip = $_SERVER['REMOTE_ADDR'];
  $ad_soyad = mysqli_real_escape_string($conn, @$_GET['ad_soyad']);
  $tel = mysqli_real_escape_string($conn, @$_GET['tel']);
  $mail = mysqli_real_escape_string($conn, @$_GET['mail']);
  $mesaj = mysqli_real_escape_string($conn, @$_GET['mesaj']);
  
  $sql = "INSERT INTO iletisim_mesajlari (ad_soyad, tel, mail, mesaj, ip) VALUES ('$ad_soyad', '$tel', '$mail', '$mesaj', '$ip')";

  if (mysqli_query($conn, $sql)) {
    echo "<center><img src='images/ok.png' width=96><br>Teşekkürler<p>";
    echo "Mesajınız Gönderildi</center>";
  } else {
    echo "Beklenmeyen bir hata oluştu.";
  }
} else {
  echo "Geçersiz İstek <br>";
}
?>