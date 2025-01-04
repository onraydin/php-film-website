<!DOCTYPE html>
<?php
include('baglan.php');
$sorgu_gnl = mysqli_query($conn, "SELECT * FROM genel_bilgiler");
$satir_gnl = mysqli_fetch_array($sorgu_gnl);

// Sayfalama Ayarları
$limit = 4; // Her sayfada gösterilecek yönetmen sayısı
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Geçerli sayfa
$offset = ($page - 1) * $limit; // Veritabanı sorgusunda atlanacak kayıt sayısı

// Toplam Kayıt Sayısı
$total_records_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM yonetmenler");
$total_records_row = mysqli_fetch_assoc($total_records_query);
$total_records = $total_records_row['total'];

// Toplam Sayfa Sayısı
$total_pages = ceil($total_records / $limit);

// Yönetmenler Sorgusu
$sorgu_yonetmen = mysqli_query($conn, "SELECT id, adi, soyadi, resim, SUBSTRING(ozgecmis, 1, LOCATE('.', ozgecmis)) AS kisa_ozg FROM yonetmenler ORDER BY adi ASC LIMIT $offset, $limit");
?>

<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php echo $satir_gnl['site_adi']; ?></title>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
  <style>
    .img-box img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 10px;
    }

    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .pagination a {
      margin: 0 5px;
      padding: 10px 15px;
      text-decoration: none;
      color: #000;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .pagination a.active {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -- 
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
          <a class="navbar-brand mr-5" href="index.php">
            <img src="images/logo.png" alt="">
            <span>
              <?php //echo $satir_gnl['site_adi'] ?>
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="hakkinda.php"> Hakkımızda </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="filmler.php"> Filmler </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="yonetmenler.php"> Yönetmenler </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="oyuncular.php"> Oyuncular </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="iletisim.php">İletişim</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="rapor.php">Rapor</a>
                </li>
              </ul>
              <form class="form-inline">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </header>
    !-- end header section -->
  </div>

  <div class="body_bg layout_padding">
    <section class="blog_section layout_padding">
      <div class="container">
        <div class="heading_container">
          <h2>Yönetmenler</h2>
        </div>
        <!--<div class="alphabet_filter">
          <?php 
          //$sorgu_ilk_harfler = mysqli_query($conn,"select substr(adi,1,1) as harf, count(id) as sayi from yonetmenler group by substr(adi,1,1) order by harf");
          //echo "<table width=100% border=0>";							
          //while ( $satir_ilkharf = mysqli_fetch_array($sorgu_ilk_harfler)) {
           // $h_adi = $satir_ilkharf['harf'];
           // echo "<td align=center>";
            //echo "<a href='#' id='yonetmen_ilk_harf' harf='$h_adi'>$h_adi [".$satir_ilkharf['sayi']."]</a>";
            //echo "</td>";
          //}
          //echo "</table>";
          ?>
        </div>-->
        <!--<hr style="width:100%;text-align:center;margin-left:0">-->
        <div id="sonuc">
          <div class="row">
            <?php
            while ($satir_yonetmen = mysqli_fetch_array($sorgu_yonetmen)) {
              $yonetmen_id = $satir_yonetmen['id'];
            ?>
              <div class="col-md-6 col-lg-3 mx-auto">
                <div class="box">
                  <div class="img-box">
                    <a href="yonetmen_detay.php?yonetmen_id=<?php echo $yonetmen_id; ?>">
                      <img src="images/yönetmen/<?php echo $satir_yonetmen['resim']; ?>" title="<?php echo $satir_yonetmen['adi'] . " " . $satir_yonetmen['soyadi']; ?>" alt="<?php echo $satir_yonetmen['adi'] . " " . $satir_yonetmen['soyadi']; ?>">
                    </a>
                  </div>
                  <div class="detail-box">
                    <h4><?php echo $satir_yonetmen['adi'] . " " . $satir_yonetmen['soyadi']; ?></h4>
                    <p><?php echo html_entity_decode($satir_yonetmen['kisa_ozg']); ?></p>
                    <a href="yonetmen_detay.php?yonetmen_id=<?php echo $yonetmen_id; ?>">İncele</a>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <!-- Sayfa Numaraları -->
        <div class="pagination">
          <?php 
          $query_string = $_SERVER['QUERY_STRING'];
          parse_str($query_string, $query_array);
          unset($query_array['page']);
          $query_string = http_build_query($query_array);
          for ($i = 1; $i <= $total_pages; $i++) { 
            $page_link = "?page=$i&$query_string";
          ?>
            <a href="<?php echo $page_link ?>" class="<?php echo ($i == $page) ? 'active' : '' ?>"><?php echo $i ?></a>
          <?php } ?>
        </div>
      </div>
    </section>
  </div>

 <!-- <section class="container-fluid footer_section">
    <p>Copyright &copy; 2019 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
  </section>-->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('a#yonetmen_ilk_harf').click(sonucAl1);
    });

    function sonucAl1() {
      $('#sonuc').html("<center><img src='images/yukleniyor.svg'></center>");
      var harf = $(this).attr("harf");

      $.ajax({
        type: 'GET',
        url: 'islemler.php',
        data: 'islem=yonetmen&istek_harf=' + harf + '&r=' + Math.random(),
        success: function(sonuc) {
          $('#sonuc').html(sonuc);
        }
      });

      return false;
    }
  </script>
</body>

</html>