<?php
	include "function/function.php"; 
	
	$pdo = koneksi();
	
	$id_warkah = trim($_POST['id_warkah_hapus']);
	$txt_cari_di208_nomor = trim($_POST['di208_nomor_hapus']);	
	$txt_cari_di208_tahun = trim($_POST['di208_tahun_hapus']);

	// hapus data dari tabel pengguna
	$sql = $pdo->prepare("DELETE FROM warkah WHERE id_warkah LIKE :id_warkah");
	$sql->bindParam(':id_warkah', $id_warkah);
	$sql->execute(); // Eksekusi/Jalankan query   
	

	if($sql) {
	  $_POST['btn_cari_warkah'] = true;
	  ob_start();
	  include "function/view_warkah.php";
	  $html = ob_get_contents();
	  ob_end_clean();
				
	  $response = array(
		'status' => 'sukses',
		'hasil'=>$html
	  );
	} else{
	  $response = array(
		'status' => 'error',
		'pesan' => 'data gagal dihapus',
		'tipe' => 'error'
	  );
	}
	
	echo json_encode($response); // konversi variabel response menjadi JSON
?>
