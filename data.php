<?php
// filepath: /c:/xampp/htdocs/film_web/data.php
<?php
include('baglan.php');

$response = array();

// Yönetmen Cinsiyet Dağılımı
$say_yonetmen_bay = mysqli_num_rows(mysqli_query($conn,"select * from yonetmenler where cinsiyet='E'"));
$say_yonetmen_bayan = mysqli_num_rows(mysqli_query($conn,"select * from yonetmenler where cinsiyet='K'"));
$response['yonetmen_cinsiyet'] = array($say_yonetmen_bay, $say_yonetmen_bayan);

// Kategorilere Göre Filmler
$sorgu_kategori = mysqli_query($conn,"select count(F.id) as sayi, C.id as k_id, C.adi as k_adi  from filmler as F, kategoriler as C where  F.kategori_id = C.id group by F.kategori_id order by C.adi"); 
$dizi_kategori_adi = array();
$dizi_kategori_film_sayisi = array();
while ($satir_kategori = mysqli_fetch_array($sorgu_kategori)) {  
    $dizi_kategori_adi[] = $satir_kategori['k_adi'];
    $dizi_kategori_film_sayisi[] = $satir_kategori['sayi'];
}
$response['kategori_adi'] = $dizi_kategori_adi;
$response['kategori_film_sayisi'] = $dizi_kategori_film_sayisi;

// En Çok Filmi Olan Yönetmenler
$sorgu_yonetmen = mysqli_query($conn,"select count(F.id) as sayi, Y.id as y_id, Y.adi as y_adi, Y.soyadi as y_soyadi  from filmler as F, yonetmenler as Y where F.yonetmen_id = Y.id group by F.yonetmen_id order by sayi desc limit 5"); 
$dizi_yonetmen_adi = array();
$dizi_yonetmen_film_sayisi = array();
while ($satir_yonetmen = mysqli_fetch_array($sorgu_yonetmen)) {  
    $dizi_yonetmen_adi[] = $satir_yonetmen['y_adi']." ".$satir_yonetmen['y_soyadi'];
    $dizi_yonetmen_film_sayisi[] = $satir_yonetmen['sayi'];
}
$response['yonetmen_adi'] = $dizi_yonetmen_adi;
$response['yonetmen_film_sayisi'] = $dizi_yonetmen_film_sayisi;

echo json_encode($response);
?>