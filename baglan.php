<?php
// geliştirme
$conn = mysqli_connect("127.0.0.1","root","","sahnekeyfi");
// yayin
// $conn = mysqli_connect("127.0.0.1","121619981009","casdasxas","db_121619981009");
/* Bağlantı Kontrolu */
if ( mysqli_connect_errno() ) {
	echo "Bağlantı Başarısız. Hata : ".mysqli_connect_error();
	die();
}
else {
	//echo "Bağlantı Başarılı";	
}
/* Olası Türkçe karakter sorunları için */
// Karakter setini ayarlamak için aşağıdaki komutta kullanılabilir.
	mysqli_query($conn,"SET NAMES 'utf8'");
/* Bağlantıyı Sonlandırmak için */
// mysqli_close($conn);


?>