<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="build/css/style.css">
  <title>SiMawar - Sistem Manajemen Warkah</title>
  
  <!-- Bootstrap -->
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	
  <!-- sweetalert -->
	<link href="vendors/sweetalert/css/sweetalert2.min.css" rel="stylesheet"> 	
	
</head>
<body>

  <div class="login-wrapper">
    <form id="loginform" action="" class="form">
      <img src="images/Simawar.png" alt="">
      <h2>L O G I N</h2>
      <div class="input-group">
        <input type="text" name="loginUser" id="loginUser" required>
        <label for="loginUser">Username</label>
      </div>
      <div class="input-group">
        <input type="password" name="loginPassword" id="loginPassword" required>
        <label for="loginPassword">Password</label>
      </div>
	  <button type="button" class="btn btn-success" id="btn_login" name="btn_login" style="float: right; width: 100px;">O K</button>
    </form>
  </div>
  
  <!-- jQuery -->
	<script src="vendors/jquery/dist/jquery.min.js"></script>
  <!-- Custom Theme Scripts -->
	<script src="build/js/ajax.js"></script>  
  <!-- sweetalert -->
	<script src="vendors/sweetalert/js/sweetalert2.min.js"></script>
  <!-- JQuery blockUI -->
	<script src="vendors/blockui_master/jquery.blockUI.js"></script>
  
</body>
</html>