<?php
	function koneksi() {
	  $host = 'localhost'; // Nama hostnya
	  $username = 'root'; // Username
	  $password = ''; // Password (Isi jika menggunakan password)
	  $database = 'db_warkah'; // Nama databasenya

		// Koneksi ke MySQL dengan PDO
	  $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
	  
	  return $pdo;
	}
	
	function buat_session() {
		session_start();
	}
	
	function tampilkan_session() {
		if(isset($_SESSION['username'])) {
			$nama = $_SESSION['nama'];
			$no_level = $_SESSION['no_level'];
			$otoritas = $_SESSION['otoritas'];
			
			echo "<b>$nama - $otoritas</b>";
		}
	}
	
	function cek_session() {
		if(!isset($_SESSION['username'])) {
			header("location: index.php");
			exit;
		}
	}
	
	function cek_jabatan() {
		return $_SESSION['no_level'];
	}
	
	function hancurkan_session() {
		session_destroy();
	}
	
	function generator_id() {
		$id = base_convert(microtime(false), 16, 36);
		
		return $id;
	}
	
	function cek_isian_di208($di208_nomor, $di208_tahun) {
	  if(empty(trim($di208_nomor)))
		return 1;
	  elseif(empty(trim($di208_tahun)))
		return 2;
	  elseif(strlen(trim($di208_tahun)) < 4)
	    return 3;
	  else
		return 0;	
	}
	
	function pesan_error_isian_di208($error_di208) {
	  switch($error_di208) {
		case 1: 
			return "isi nomor DI.208";
			break;
		case 2:
			return "isi tahun DI.208";
			break;	
		case 3:
			return "tahun DI.208 harus 4 digit";
			break;
		default:
			return "";
			break;
	  }
	}
	
	function cek_di208_no_tahun($pdo, $di208_nomor, $di208_tahun) {
		$sql_di208 = $pdo->prepare("SELECT di_208_nomor, di_208_tahun FROM warkah WHERE di_208_nomor LIKE :di_208_nomor 
										AND di_208_tahun LIKE :di_208_tahun");	
										
		$sql_di208->bindParam(':di_208_nomor', $di208_nomor);
		$sql_di208->bindParam(':di_208_tahun', $di208_tahun);
		$sql_di208->execute(); 		
		$row = $sql_di208->rowCount();
		
		if($row >= 1) {
		  return 1;
		}
		else {
		  return 0;
		}
	}
	
	function cek_di208_no_tahun_ubah($pdo, $id_warkah, $di208_nomor, $di208_tahun) {
		$sql_di208 = $pdo->prepare("SELECT di_208_nomor, di_208_tahun FROM warkah WHERE di_208_nomor LIKE :di_208_nomor 
										AND di_208_tahun LIKE :di_208_tahun 
										AND id_warkah NOT LIKE :id_warkah");	
										
		$sql_di208->bindParam(':di_208_nomor', $di208_nomor);
		$sql_di208->bindParam(':di_208_tahun', $di208_tahun);
		$sql_di208->bindParam(':id_warkah', $id_warkah);
		$sql_di208->execute(); 		
		$row = $sql_di208->rowCount();
		
		if($row >= 1) {
		  return 1;
		}
		else {
		  return 0;
		}
	}
	
	function cek_isian_username($username_baru, $nama, $password, $level_user) {
	  if(empty(trim($username_baru)))
		return 1;
	  elseif(empty(trim($nama)))
		return 2;
	  elseif(empty($password))
		return 3;
	  elseif($level_user == 0)
	    return 4;
	  else
		return 0;	
	}
	
	function pesan_error_username($error_username_baru) {
	  switch($error_username_baru) {
		case 1: 
			return "isi username";
			break;
		case 2:
			return "isi nama";
			break;	
		case 3:
			return "isi password";
			break;
		case 4:
			return "pilih level pengguna";
			break;
		default:
			return "";
			break;
	  }
	}
	
	function cek_username_baru($pdo, $username) {
		$sql_username = $pdo->prepare("SELECT username FROM username WHERE username LIKE :username");	
										
		$sql_username->bindParam(':username', $username);
		$sql_username->execute(); 		
		$row = $sql_username->rowCount();
		
		if($row >= 1) {
		  return 1;
		}
		else {
		  return 0;
		}
	}
	
	function cek_username_ubah($pdo, $hidden_username) {
		$sql_username = $pdo->prepare("SELECT username FROM username WHERE username LIKE :hidden_username");	
										
		$sql_username->bindParam(':hidden_username', $hidden_username);
		$sql_username->execute(); 		
		$row = $sql_username->rowCount();
		
		if($row > 1) {	// username sudah dipakai orang lain
		  return 1;
		}
		else {
		  return 0;
		}
	}
	
	function tower() {
		$pdo = koneksi();
		$sql = $pdo->prepare("SELECT id_tower, nama_tower FROM tower ORDER BY nama_tower");
		$sql->execute();
									
		while($data = $sql->fetch()){
			?><option value= <?php echo $data['id_tower']; ?>><?php echo $data['nama_tower']; ?></option> <?php
		}
	}
	
	function nomor_rak() {
		$pdo = koneksi();
		$sql = $pdo->prepare("SELECT id_nomor_rak, rak_nomor FROM nomor_rak ORDER BY rak_nomor");
		$sql->execute();
									
		while($data = $sql->fetch()){
			?><option value= <?php echo $data['id_nomor_rak']; ?>><?php echo $data['rak_nomor']; ?></option> <?php
		}
	}
	
	function kolom() {
		$pdo = koneksi();
		$sql = $pdo->prepare("SELECT id_kolom, no_kolom FROM kolom ORDER BY no_kolom");
		$sql->execute();
									
		while($data = $sql->fetch()){
			?><option value= <?php echo $data['id_kolom']; ?>><?php echo $data['no_kolom']; ?></option> <?php
		}
	}
	
	function baris() {
		$pdo = koneksi();
		$sql = $pdo->prepare("SELECT id_baris, no_baris FROM baris ORDER BY no_baris");
		$sql->execute();
									
		while($data = $sql->fetch()){
			?><option value= <?php echo $data['id_baris']; ?>><?php echo $data['no_baris']; ?></option> <?php
		}
	}
	
	function username_level() {
		$pdo = koneksi();
		$sql = $pdo->prepare("SELECT no_level, otoritas FROM username_level ORDER BY otoritas");
		$sql->execute();
									
		while($data = $sql->fetch()){
			?><option value= <?php echo $data['no_level']; ?>><?php echo $data['otoritas']; ?></option> <?php
		}
	}
	
	function set_tanggal_waktu() {	
		date_default_timezone_set('Asia/Jakarta');
		
		return date('Y-m-d H:i:s');
	}
	
	function ubah_tglwaktu_sql($tgl_waktu) {
		if(empty($tgl_waktu)) 
			return "";
		else
			return date('d-m-Y H:i:s', strtotime($tgl_waktu));
	}
	
?>