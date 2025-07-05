<?php
	include "function/function.php";
	
	buat_session();
	
	$pdo = koneksi();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(!(empty($username)) && !(empty($password))) {
		$sql = $pdo->prepare("SELECT username.username, username.nama, username.no_level, username_level.otoritas FROM username, username_level
								WHERE username.no_level = username_level.no_level 
									  AND username.username = :user AND username.password = :pass");
		
		$sql->bindParam(':user', $username);
		$sql->bindParam(':pass', $password);
		$sql->execute();
		$data = $sql->fetch();
		$row = $sql->rowCount();
		
		if($row >= 1 ) {
			$_SESSION['username'] = $data['username'];
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['no_level'] = $data['no_level'];
			$_SESSION['otoritas'] = $data['otoritas'];
									
			$response = array (
				'status'=>'sukses',
				'url'=>'warkah.php'
			);
		}
		else {
			$response = array (
				'status'=>'gagal',
				'pesan'=>'username atau password salah',
				'tipe' => 'error'
			);
		}
	}
	else {
		$response = array (
			'status'=>'gagal',
			'pesan'=>'isi username atau password',
			'tipe' => 'error'
		);
	}
	
	echo json_encode($response);
?>