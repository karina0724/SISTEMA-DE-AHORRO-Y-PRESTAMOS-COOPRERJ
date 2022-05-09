<nav id="sidebar" class='mx-lt-5 bg-dark' >	
		<div class="sidebar-list">
			<a href="index.php?page=home" class="nav-item nav-home"></i></span> Inicio</a>
			<a href="index.php?page=loans" class="nav-item nav-loans"></i></span> Prestamos</a>	
			<a href="index.php?page=payments" class="nav-item nav-payments"></i></span> Pagos</a>
			<a href="index.php?page=borrowers" class="nav-item nav-borrowers"></i></span> Socios</a>
			<a href="index.php?page=plan" class="nav-item nav-plan"></i></span> Planes de Prestamos</a>	
			<a href="index.php?page=loan_type" class="nav-item nav-loan_type"></i></span> Tipos de Prestamos</a>
			<a href="index.php?page=saving" class="nav-item nav-users">Ahorro
				<a href="index.php?page=saving_mutual_help" class="nav-item nav-users" style="padding-left: 35px;"><i class="icofont-ui-clip text-secondary mr-2"></i>Ayuda Mutua</a>
				<a href="index.php?page=saving_contribution" class="nav-item nav-users" style="padding-left: 35px;"><i class="icofont-ui-clip text-secondary mr-2"></i>Aportaciones</a>	
				<a href="index.php?page=saving_withdrawable" class="nav-item nav-users" style="padding-left: 35px;"><i class="icofont-ui-clip text-secondary mr-2"></i>Ahorro Retirable</a>		
			</a>		
			<?php if($_SESSION['login_type'] == "admin"): ?>
				<a href="index.php?page=users" class="nav-item nav-users"></i></span> Usuarios</a>	
			<?php endif; ?>
		</div>
</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
