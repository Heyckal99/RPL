<?php
	include "function/function.php"; 
	
	$pdo = koneksi();
	
	buat_session();
	cek_session();
	
	$pilih = $_POST['pilih'];

	$sql_string = "";
	$sql = "";
	$jenis_simpan = "";		// indikator jenis simpan (insert atau update), 0 => gagal simpan, 1 =>insert,  2 => update
	
	if($pilih == 1) {	// jika pilih baris
		$sql_string = "SELECT id_baris id, no_baris posisi FROM baris ORDER BY no_baris";

	} elseif ($pilih == 2) {	// jika pilih lorong
		$sql_string = "SELECT id_lorong id, posisi_lorong posisi FROM lorong ORDER BY id_lorong";
	}

	$sql = $pdo->prepare($sql_string);
	$sql->execute();
	
	$id_baris_lorong = array();
	$posisi_baris_lorong = array();

	while($data = $sql->fetch()) {
		$id_baris_lorong[] = $data['id'];
		$posisi_baris_lorong[] = $data['posisi']; 
	}
	
	if($sql) {	// jika perintah sql dijalankan
	  $response = array(
		'status' => 'sukses',
		'judul' => 'sukses',
		'id_baris_lorong' => $id_baris_lorong,
		'posisi_baris_lorong' => $posisi_baris_lorong
	  );
	}
	else {		// jika perintah sql gagal/tidak dijalankan
	  $response = array(
		'status' => 'gagal',
		'judul' => 'gagal',
		'pesan' => 'data gagal',
		'tipe' => 'error'
	  );
	}
	
	echo json_encode($response);
?>