<?php
	include "function/function.php";
	
	$pesan_error_cari_username = "";
	
	$txt_cari_nama = trim($_POST['txt_cari_nama']);	
	  
	if(empty($txt_cari_nama)) {
	  $pesan_error_cari_nama = "masukan Nama yang dicari"; 
	}  

	
	if(!empty($txt_cari_nama)) {
		// Load view_warkah.php
		$_POST['btn_cari_nama'] = true;
		ob_start();
		include "function/view_pengguna.php";
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
			'pesan' => $pesan_error_cari_nama,
			'tipe' => 'error'
		);
	}
	
	echo json_encode($response);
	
?>