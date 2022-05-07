<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b9;
 }
 nav{
   height: 90px;
 }
 .icon {
   margin-right: 20px;
   color: #fff;
  }
  .icofont-logout{
    padding-left: 20px;
  }
</style>

<nav class="navbar navbar-light fixed-top bg-success">
  <div class="container-fluid mt-2 mb-2 d-flex">
    <div class="col-md-6 float-left d-flex text-center">
      <p class="text-white font-weight-bold mb-0"><i class="fas fa-home icon"></i>SISTEMA DE AHORRO Y PRESTAMOS COOPRERJ</p>
    </div>
	  <div class="col-md-6 float-right" style="text-align: end;">
	  	<a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'].' '.$_SESSION['login_last_name'] ?> <i class="icofont-logout"></i></a>
	  </div>
  </div>
</nav>