<?php 
$connect = mysqli_connect("localhost","root","","db_spp_rpa");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>