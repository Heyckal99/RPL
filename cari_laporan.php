<?php
	include "function/function.php";
	
	$pesan_error_cari_laporan = "";
	
	$txt_cari_laporan = trim($_POST['txt_cari_laporan']);	
	  
	if(empty($txt_cari_laporan)) {
	  $pesan_error_cari_warkah = "masukan Nomor Album yang dicari"; 
	}
	
	if(!empty($txt_cari_laporan)) {
		// Load view_warkah.php
		$_POST['btn_laporan'] = true;
		ob_start();
		include "function/view_laporan.php";
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