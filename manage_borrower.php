<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM borrowers where id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-borrower">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<h4>CUSTOMERS PERSONAL INFORMATION</h4>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">Last Name</label>
						<input  name="lastname" class="form-control" required="" value="<?php echo isset($lastname) ? $lastname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">First Name</label>
						<input required name="firstname" class="form-control" required="" value="<?php echo isset($firstname) ? $firstname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Middle Name</label>
						<input name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename : '' ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">National ID Number</label>
						<input required name="id_no" class="form-control" required="" value="<?php echo isset($id_no) ? $id_no : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Marital Status</label>
						<input required name="marital" class="form-control" required="" value="<?php echo isset($marital) ? $marital : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Date of Birth</label>
						<input required name="dob" type="date" class="form-control" value="<?php echo isset($dob) ? $dob : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
							<label for="">Address</label>
							<textarea required name="address" id="" cols="30" rows="2" class="form-control" required=""><?php echo isset($address) ? $address : '' ?></textarea>
				</div>
				<div class="col-md-5">
					<div class="">
						<label for="">Contact </label>
						<input required type="text" class="form-control" name="contact_no" value="<?php echo isset($contact_no) ? $contact_no : '' ?>">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">Town</label>
						<input required name="town" class="form-control" required="" value="<?php echo isset($town) ? $town : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Estate</label>
						<input required name="estate" class="form-control" required="" value="<?php echo isset($estate) ? $estate : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Street</label>
						<input required name="street" class="form-control" value="<?php echo isset($street) ? $street : '' ?>">
					</div>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-md-6">
							<label for="">Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
				</div>
				<div class="col-md-5">
					<div class="">
						<label for="">KRA PIN</label>
						<input type="text" class="form-control" name="tax_id" value="<?php echo isset($tax_id) ? $tax_id : '' ?>">
					</div>
				</div>
			</div>
			<h4>BUSINESS DETAILS</h4>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">Business Name</label>
						<input required name="bus_name" class="form-control" required="" value="<?php echo isset($bus_name) ? $bus_name : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Regration Number</label>
						<input required name="bus_no" class="form-control" required="" value="<?php echo isset($bus_no) ? $bus_no : '' ?>">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">Business Location: Town</label>
						<input required name="bus_town" class="form-control" required="" value="<?php echo isset($bus_town) ? $bus_town : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Address</label>
						<input required name="bus_address" class="form-control" required="" value="<?php echo isset($bus_address) ? $bus_address : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Street</label>
						<input required name="bus_street" class="form-control" value="<?php echo isset($bus_street) ? $bus_street : '' ?>">
					</div>
				</div>
			</div>
			<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Building</label>
								<input required name="bus_building" class="form-control" value="<?php echo isset($bus_building) ? $bus_building : '' ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">House No/Suit</label>
								<input required name="bus_house" class="form-control" required="" value="<?php echo isset($bus_house) ? $bus_house : '' ?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Number of Years in Business</label>
								<input type="number" name="bus_years" class="form-control" value="<?php echo isset($bus_years) ? $bus_years : '' ?>">
							</div>
				   </div>
			  </div>

		</form>
	</div>
</div>

<script>
	 $('#manage-borrower').submit(function(e){
	 	e.preventDefault()
	 	start_load()
	 	$.ajax({
	 		url:'ajax.php?action=save_borrower',
	 		method:'POST',
	 		data:$(this).serialize(),
	 		success:function(resp){
	 			if(resp == 1){
	 				alert_toast("Borrower data successfully saved.","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}
	 		}
	 	})
	 })
</script>