<!DOCTYPE html>
<?php
  include('baglan.php');
  $sorgu_gnl = mysqli_query($conn,"Select * from genel_bilgiler");
  $satir_gnl = mysqli_fetch_array($sorgu_gnl);
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
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
  </div>
  <div class="body_bg layout_padding">


  <!-- contact section -->

  <section class="contact_section">
    <div class="container">
    <div class="heading_container">
      <h2>
      Bize Mesaj Gönderin!
      </h2>
    </div>
    </div>
    <div class="container contact_bg layout_padding2-top">
    <div class="row">
      <div class="col-md-6">
      <div class="contact_form ">
      <form id='iletisim_formu' action="islemler.php">
        
    <div>
      <input name='ad_soyad' required type="text" placeholder="Ad-Soyad">
    </div>
    <div>
      <input name='tel' required pattern="[0-9]{11}" placeholder='Telefon Numarası : 05321234567'  type="tel">
    </div>
    <div>
      <input name='mail' required type="email" placeholder="E-posta">
    </div>
    <div>
      <input name='mesaj' required type="text" placeholder="Mesajınız" class="input_message">
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn_on-hover">
      GÖNDER
      </button>
    </div>

    </form>
      </div>
      <div id='sonuc' style='margin: auto;'>  </div> 
      </div>
      <div class="col-md-6">
      <div class="img-box" id="contact-img">
        <img src="images/contact-img.jpg" alt="">
      </div>
      </div>
    </div>
    </div>
  </section>

  <!-- end contact section -->

  </div>
  <!-- info section -->
  <section class="info_section layout_padding">
  <div class="footer_contact">
    <div class="heading_container">
    <h2>İletişime Geç</h2>
    </div>
    <div class="box">
    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($satir_gnl['adres']); ?>" target="_blank" class="img-box">
      <img src="images/location.png" alt="Location Icon">
      <span><?php echo $satir_gnl['adres']; ?></span>
    </a>
    <a href="tel:<?php echo $satir_gnl['telefon']; ?>" class="img-box">
      <img src="images/call.png" alt="Call Icon">
      <span><?php echo $satir_gnl['telefon']; ?></span>
    </a>
    <a href="mailto:<?php echo $satir_gnl['e-mail']; ?>" class="img-box">
      <img src="images/envelope.png" alt="Email Icon">
      <span><?php echo $satir_gnl['e-mail']; ?></span>
    </a>
    </div>
  </div>
  </section>
  <!-- info section ends -->

  <!-- footer section -- 
  <section class="container-fluid footer_section">
  <p>
    Copyright &copy; 2019 All Rights Reserved By
    <a href="https://html.design/">Free Html Templates</a>
  </p>
  </section>
  !-- footer section -->  

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script> 
  $("#iletisim_formu").submit(function(e) {

  e.preventDefault(); // avoid to execute the actual submit of the form.
  var form = $(this);
  var actionUrl = form.attr('action');

  $.ajax({
    type: "GET",
    url: actionUrl,
    data: form.serialize() + '&islem=iletisim', 
    success: function(data)
    {
    $('#sonuc').html(data);
    $('.contact_form').hide();
    }
  });

  });
</script>

</body>

</html>
