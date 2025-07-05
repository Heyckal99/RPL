<?php
	include "function/function.php"; 
	
	$pdo = koneksi();
	
	buat_session();
	cek_session();
	
	$id_warkah = $_POST['id_warkah'];
	
	$id_tower = $_POST['id_tower'];	
	$nama_rak = $_POST['nama_rak'];
	$no_rak = $_POST['no_rak'];
	$id_kolom = $_POST['id_kolom'];	
	$id_baris = $_POST['id_baris'];
	$baris_lorong_id = isset($_POST['baris_lorong_id']) ? $_POST['baris_lorong_id'] : null;
	$no_album = trim($_POST['no_album']);
	
	$di208_nomor = $_POST['di208_nomor'];
	$di208_tahun = $_POST['di208_tahun'];
	$scan_warkah = trim($_POST['scan_warkah']);
	
	$sql = "";
	$jenis_simpan = "";		// indikator jenis simpan (insert atau update), 0 => gagal simpan, 1 =>insert,  2 => update
	
	$username = $_SESSION['username'];
	
	$cek_isian = cek_isian_di208($di208_nomor, $di208_tahun);
	
	if($cek_isian > 0) {		// jika error pada isian textbox DI.208 ada textbox yang tidak diisi	
	  $pesan_error_di208 = pesan_error_isian_di208($cek_isian);
	}
	else {
		
	  if(empty($id_warkah)) {	// jika hidden	id_warkah = "" 	//  insert data	
		if(cek_di208_no_tahun($pdo, $di208_nomor, $di208_tahun) == 1) {	// jika no dan tahun DI.208 sudah pernah dientri dan ada di album
		  $jenis_simpan = 0;
		  $pesan_error_di208 = "Nomor dan Tahun DI.208 sudah pernah dientri";
		}
		else {
			  $id_warkah = generator_id();
			  $tgl_entri = set_tanggal_waktu();

			  $data_baris = "";
			  $data_lorong = "";

			  if($id_baris == 1) {	//jika pilih baris
				$data_baris = $baris_lorong_id;
				$data_lorong = NULL;

			  } elseif($id_baris == 2) {	// jika pilih lorong
				$data_baris = NULL;
				$data_lorong = $baris_lorong_id;
			  }	 
			  
			  $sql = $pdo->prepare("INSERT INTO warkah (id_warkah, id_tower, nama_rak, no_rak, id_kolom, id_baris, id_lorong, album_nomor, 
															di_208_nomor, di_208_tahun, scan, tgl_entri, username)	
								VALUES(:id_warkah, :id_tower, :nama_rak, :no_rak, :id_kolom, :id_baris, :id_lorong, :album_nomor, 
										:di_208_nomor, :di_208_tahun, :scan, :tgl_entri, :username)");
									
			  $sql->bindParam(':id_warkah', $id_warkah);
			  $sql->bindParam(':id_tower', $id_tower);
			  $sql->bindParam(':nama_rak', $nama_rak);
			  $sql->bindParam(':no_rak', $no_rak);
			  $sql->bindParam(':id_kolom', $id_kolom);
			  $sql->bindParam(':id_baris', $data_baris);
			  $sql->bindParam(':id_lorong', $data_lorong);
			  $sql->bindParam(':album_nomor', $no_album);
			  
			  $sql->bindParam(':di_208_nomor', $di208_nomor);
			  $sql->bindParam(':di_208_tahun', $di208_tahun);
			  $sql->bindParam(':scan', $scan_warkah);
			  $sql->bindParam(':tgl_entri', $tgl_entri);
			  $sql->bindParam(':username', $username);
			  $sql->execute(); // Eksekusi query insert
			  
			  $jenis_simpan = 1; // jenis simpan // 0 => gagal simpan, 1 =>insert,  2 => update
		}	    
	  }
	  else {
			// jika hidden	id_warkah = tidak kosong 	//  update data	
			if(cek_di208_no_tahun_ubah($pdo, $id_warkah, $di208_nomor, $di208_tahun) == 1) {	// jika no dan tahun DI.208 sudah pernah dientri dan ada di album
			  $jenis_simpan = 0;
			  $pesan_error_di208 = "Nomor dan Tahun DI.208 sudah pernah dientri";
			}
			else {
			  $data_baris = "";
			  $data_lorong = "";

			  if($id_baris == 1) {	//jika pilih baris
				$data_baris = $baris_lorong_id;
				$data_lorong = NULL;

			  } elseif($id_baris == 2) {	// jika pilih lorong
				$data_baris = NULL;
				$data_lorong = $baris_lorong_id;
			  }	 
			
			  $sql = $pdo->prepare("UPDATE warkah SET id_tower = :id_tower, nama_rak = :nama_rak, no_rak = :no_rak, 
													id_kolom = :id_kolom, id_baris = :id_baris, id_lorong = :id_lorong, album_nomor = :album_nomor, 
													di_208_nomor = :di_208_nomor, di_208_tahun = :di_208_tahun, scan = :scan
								  WHERE id_warkah = :id_warkah");
									
			  $sql->bindParam(':id_warkah', $id_warkah);
			  $sql->bindParam(':id_tower', $id_tower);
			  $sql->bindParam(':nama_rak', $nama_rak);
			  $sql->bindParam(':no_rak', $no_rak);
			  $sql->bindParam(':id_kolom', $id_kolom);
			  $sql->bindParam(':id_baris', $data_baris);
			  $sql->bindParam(':id_lorong', $data_lorong);
			  $sql->bindParam(':album_nomor', $no_album);
			  
			  $sql->bindParam(':di_208_nomor', $di208_nomor);
			  $sql->bindParam(':di_208_tahun', $di208_tahun);
			  $sql->bindParam(':scan', $scan_warkah);
			  $sql->execute(); // Eksekusi query insert
			  
			  $jenis_simpan = 2; // jenis simpan // 0 => gagal simpan, 1 =>insert,  2 => update
			}  
	  }
	}
	
	if($sql) {	// jika perintah sql dijalankan
	  $response = array(
		'status' => 'sukses',
		'judul' => 'sukses',
		'pesan' => 'nomor DI.208 sudah disimpan',
		'tipe' => 'success',
		'jenis_simpan' => $jenis_simpan
	  );
	}
	else {		// jika perintah sql gagal/tidak dijalankan
	  $response = array(
		'status' => 'gagal',
		'judul' => 'gagal',
		'pesan' => $pesan_error_di208,
		'tipe' => 'error'
	  );
	}
	
	echo json_encode($response);
?>