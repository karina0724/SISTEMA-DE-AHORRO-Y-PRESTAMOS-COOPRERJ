<?php 
include('db_connect.php');

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM saving where id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-saving">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                        <label class="control-label">Socio</label>
                        <?php
                        $borrower = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name, salary FROM borrowers order by concat(lastname,', ',firstname,' ',middlename) asc ");
                        ?>
                        <select name="borrower_id" id="borrower_id" class="custom-select browser-default select2">
                            <option value=""></option>
                                <?php while($row = $borrower->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id'] ?>" data-salary="<?php echo $row['salary'] ?>" <?php echo isset($borrower_id) && $borrower_id == $row['id'] ? "selected" : '' ?>><?php echo $row['name'] . ' | Tax ID:'.$row['tax_id'] ?></option>
                                <?php endwhile; ?>
                        </select>
					</div>
				</div>
		
				<div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" id="saving_type_id">Tipo de Ahorro</label>
                        <?php
                        $saving_types = $conn->query("SELECT *, name FROM saving_types order by name asc ");
                        ?>
                        <select name="saving_type_id" id="saving_type_id" class="custom-select browser-default select2">
                            <option value=""></option>
                                <?php while($row = $saving_types->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($saving_type_id) && $saving_type_id == $row['id'] ? "selected" : '' ?>><?php echo $row['name'] ?></option>
                                <?php endwhile; ?>
                        </select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="amount">Monto</label>
						<input name="amount" id="amount" class="form-control" value="<?php echo isset($amount) ? $amount : '' ?>">
					</div>
				</div>
                <div class="col-md-12">
				    <label for="current_balance">Balance Actual</label>
				    <input type="text" name="current_balance" id="current_balance" class="form-control" value="<?php echo isset($current_balance) ? $current_balance : 0 ?>" required>
			    </div>
			</div>
		</form>
	</div>
</div>

<script>
   
    if($('#current_balance').val() <= 0) {
        $('#amount').change(function(){
        $('#current_balance').val($(this).val());
      });
    }

	$('#borrower_id').change(function(){
        $('#borrower_salary').val($(this).val());
    });
        
	$('#manage-saving').submit(function(e){
	 	e.preventDefault()
	 	start_load()
	 	$.ajax({
	 		url:'ajax.php?action=save_saving',
	 		method:'POST',
	 		data:$(this).serialize(),
	 		success:function(resp){
	 			if(resp){
	 				alert_toast("Agregado correctamente","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}else{ 
					$('#manage-saving').prepend('<div class="alert alert-danger">Revise los datos ingresados.</div>')
					$('#manage-saving button[type="button"]').removeAttr('disabled').html('Login');
				}
	 		}
	 	})
	 })
</script>