<?php
	function view_nav_title() {
	  ?>
		<div class="navbar nav_title" style="border: 0;">
              <a href="index.html"> 
				<img src="images/logo.png" alt="..." class="img-circle profile_img">
			  </a>
			<!--  <span style="margin-top:50px; margin-right:7px; font-size:13px; color:#E7E7E7;">Sistem Manajemen<br>Warkah</span>		-->
        </div>
	  <?php			
	}
	
	function view_nav_left() {
	  ?>
		<ul class="nav side-menu">          
            <li><a href="warkah.php"><i class="fa fa-building"></i> Warkah</a></li>
			<li><a href="laporan.php"><i class="fa fa-file"></i> Laporan</a></li>
	<?php	
			if($_SESSION['no_level'] == 1) {
	?>			
		
	<?php	} ?>
	
			<li><a href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
		</ul>		  
	  <?php			
	}
	
	function top_navigation() {
	  ?>
		<div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
		  
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li style="padding-left: 15px;">
            <!--    Aplikasi Warkah	-->
				<?php
					tampilkan_session();  //   load file untuk menampilkan data session pengguna
				?>
              </li>
            </ul>
          </nav>
        </div>
	  <?php			
	}
?>