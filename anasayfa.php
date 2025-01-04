<!DOCTYPE html>
<?php
    include('baglan.php');
    $sorgu_gnl = mysqli_query($conn,"Select * from genel_bilgiler");
    $satir_gnl = mysqli_fetch_array($sorgu_gnl);
    // Sayfa parametresini kontrol et
    $sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : 'anasayfa';
?>
<html lang="tr">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?php echo $satir_gnl['site_adi'] ?></title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />


    <!-- font wesome stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    
    <style>
    .img-box img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 10px;
    }

    .info_section .box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .info_section .img-box {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #000;
        font-size: 16px;
    }

    .info_section .img-box img {
        width: 30px;
        height: 30px;
        margin-right: 10px;
    }

    .info_section .img-box span {
        font-size: 16px;
    }

    .footer_contact {
        text-align: center;
        margin: 20px 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .footer_section {
        margin-top: auto;
    }
    </style>
</head>

<body>
    <!-- Grafik 1 -->		
<?php
    $say_yonetmen_bay = mysqli_num_rows(mysqli_query($conn,"select * from yonetmenler where cinsiyet='E'"));
    $say_yonetmen_bayan = mysqli_num_rows(mysqli_query($conn,"select * from yonetmenler where cinsiyet='K'"));	
?>	

<!-- Grafik 2 -->

<?php
 $sorgu_kategori = mysqli_query($conn,"select count(B.id) as sayi, C.id as f_id, C.adi as f_adi  from filmler as B, kategoriler as C where  B.kategori_id = C.id group by B.kategori_id order by C.adi"); 
 $dizi_kategori_adi = array();
 $dizi_kategori_film_sayisi = array();
 
 while ( $satir_kategori = mysqli_fetch_array($sorgu_kategori)) {  
    $dizi_kategori_adi[] = $satir_kategori['f_adi'];
    $dizi_kategori_film_sayisi[] = $satir_kategori['sayi'];
}

$toplam_film_sayisi = array_sum($dizi_kategori_film_sayisi);
?>

<!-- Grafik 3 -->

<?php
 $sorgu_yonetmen = mysqli_query($conn,"select count(K.id) as sayi, Y.id as y_id, Y.adi as y_adi, Y.soyadi as y_soyadi  from filmler as K, yonetmenler as Y where K.yonetmen_id = Y.id group by K.yonetmen_id order by sayi desc limit 5"); 
 $dizi_yonetmen_adi = array();
 $dizi_yonetmen_film_sayisi = array();
 
 while ( $satir_yonetmen = mysqli_fetch_array($sorgu_yonetmen)) {  
    $dizi_yonetmen_adi[] = $satir_yonetmen['y_adi']." ".$satir_yonetmen['y_soyadi'];
    $dizi_yonetmen_film_sayisi[] = $satir_yonetmen['sayi'];
}

$toplam_film_sayisi = array_sum($dizi_kategori_film_sayisi);
?>
<!-- Grafik 4 -->
<?php
    $say_oyuncu_bay = mysqli_num_rows(mysqli_query($conn,"select * from oyuncular where cinsiyet='E'"));
    $say_oyuncu_bayan = mysqli_num_rows(mysqli_query($conn,"select * from oyuncular where cinsiyet='K'"));
?>

    <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
            <a class="navbar-brand mr-5" href="index.php">
            <img src="images/logo.png" alt="">
            <span>
            <?php echo $satir_gnl['site_adi'] ?>
            </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav  ">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                        <a class="nav-link" href="anasayfa.php?sayfa=hakkinda">Hakkında</a>
                </li>
                <li class="nav-item ">
                        <a class="nav-link" href="anasayfa.php?sayfa=filmler">Filmler</a>
                </li>
                <li class="nav-item ">
                        <a class="nav-link" href="anasayfa.php?sayfa=yönetmenler">Yönetmenler</a>
                </li>
                <li class="nav-item ">
                        <a class="nav-link" href="anasayfa.php?sayfa=oyuncular">Oyuncular</a>
                </li>
                <li class="nav-item ">
                        <a class="nav-link" href="anasayfa.php?sayfa=iletisim">İletişim</a>
                </li>
                <li class="nav-item ">
                        <a class="nav-link" href="anasayfa.php?sayfa=rapor">Rapor</a>
                </li>
                </ul>
                <div class="quote_btn-container">
                <a class="nav-link" href="anasayfa.php?sayfa=arama">
                <i class="fa fa-search" ></i>
                </a>
            </div>
            </div>
            </div>
        </nav>
        </div>
    </header>
    <!-- end header section -->
    </div>
     
    <?php
$sayfa_id = @$_GET['sayfa'];

if ( isset($sayfa_id) == false ) {
    $sayfa_id = 'hakkinda';
}

if ( $sayfa_id == 'hakkinda'  ) {
    include('hakkinda.php');
} elseif ( $sayfa_id == 'filmler' ) {
    include('filmler.php');
} elseif ( $sayfa_id == 'yönetmenler' ) {
    include('yonetmenler.php');
} elseif ( $sayfa_id == 'oyuncular' ) {
    include('oyuncular.php');
} elseif ( $sayfa_id == 'iletisim' ) {
    include('iletisim.php');
} elseif ( $sayfa_id == 'rapor' ) {
    include('rapor.php');
} elseif ( $sayfa_id == 'arama' ) {
    include('arama.php');
} else {
    include('hakkinda.php');
}

?>
    <!-- footer section -->
    <section class="container-fluid footer_section">
    <p>
        Copyright &copy; 2019 All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a>
    </p>
    </section>
    <!-- footer section -->

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
</body>
</html>
