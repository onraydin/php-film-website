<?php
include('baglan.php');

$sql = "SELECT f.id as id, f.adi as adi, f.cikis_yili as yil, f.tanitim as tanitim, f.durum as durum,
    y.id as y_id, y.adi as y_adi, y.soyadi as y_soyadi, k.id as kategori_id, k.adi as kategori
    FROM filmler as f
    JOIN yonetmenler as y ON f.yonetmen_id = y.id
    JOIN kategoriler as k ON f.kategori_id = k.id";

//echo $sql;
$sorgu_film = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film Arama</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>
<body class="sub_page">
  <div class="hero_area">
  </div>
  <div class="container">
    <div class="heading_container">
      <h2>Film Arama</h2>
    </div>
    <table id="aramaTablosu" class="display">
      <thead>
    <tr>
      <th>Film</th>
      <th>Yönetmen</th>
      <th class='text-center'>Yıl</th>
      <th>Kategori</th>
      <th class='text-center'>Durum</th>
    </tr>
      </thead>
      <tbody>
    <?php
    while ($satir_film = mysqli_fetch_array($sorgu_film)) {
    ?>
      <tr>
        <td><a href="film_detay.php?film_id=<?php echo $satir_film['id'] ?>"><?php echo $satir_film['adi'] ?></a></td>
        <td><a href="yonetmen_detay.php?yonetmen_id=<?php echo $satir_film['y_id'] ?>"><?php echo $satir_film['y_adi'] . ' ' . $satir_film['y_soyadi'] ?></a></td>
        <td class='text-center'><?php echo $satir_film['yil'] ?></td>
        <td><?php echo $satir_film['kategori'] ?></td>
        <td class='text-center'>
          <?php
          if ($satir_film['durum'] == 'R') {
        echo 'Rafta';
          } else {
        echo 'İzleyicide';
          }
          ?>
        </td>
      </tr>
    <?php
    }
    ?>
      </tbody>
    </table>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      if (!$.fn.DataTable.isDataTable('#aramaTablosu')) {
    $('#aramaTablosu').DataTable({
      pageLength: 25,
      responsive: true,
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json"
      }
    });
      }
    });
  </script>
</body>
</html>
