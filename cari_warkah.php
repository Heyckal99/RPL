<?php
	include "function/function.php";
	
	$pesan_error_cari_warkah = "";
	
	$txt_cari_di208_nomor = trim($_POST['txt_cari_di208_nomor']);	
	$txt_cari_di208_tahun = trim($_POST['txt_cari_di208_tahun']);
	  
	if(empty($txt_cari_di208_nomor)) {
	  $pesan_error_cari_warkah = "masukan Nomor DI.208 yang dicari"; 
	}
	elseif(empty($txt_cari_di208_tahun)) {
	  $pesan_error_cari_warkah = "masukan Tahun DI.208 yang dicari"; 
	}	  

	
	if(!empty($txt_cari_di208_nomor) && !empty($txt_cari_di208_tahun)) {
		// Load view_warkah.php
		$_POST['btn_cari_warkah'] = true;
		ob_start();
		include "function/view_warkah.php";
		$html = ob_get_contents(); // Masukan isi dari view.php ke dalam variabel $html
		ob_end_clean();

		$response = array (
			'status'=>'sukses',
			'hasil'=>$html
		);
	}
	else {
		$response = array (
			'status' => 'gagal',
			'judul' => 'gagal',
			'pesan' => $pesan_error_cari_warkah,
			'tipe' => 'error'
		);
	}
	
	echo json_encode($response);
	
?>