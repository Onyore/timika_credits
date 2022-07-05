


<!-- <div class="d-grid gap-2">
<a class=""><button class="btn btn-primary" type="button">Loan Application</button></a>
<a class=""><button class="btn btn-primary" type="button">Offer Letter</button></a>
</div> -->

<?php include 'db_connect.php' ?>

<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Documentations</b>
				</large>
			</div>
			<div class="card-body">
				<table class="table table-borderedtable table-success table-striped" id="borrower-list">
					
					<colgroup>
						<col width="2%">
						<col width="10%">
						<col width="20%">
					
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Borrower</th>
							<th class="text-center">Documents</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
							$qry = $conn->query("SELECT * FROM borrowers order by id desc");
							while($row = $qry->fetch_assoc()):

						 ?>
						 <tr>
						 	
						 	<td class="text-center"><?php echo $i++ ?></td>
						 	<td>
						 		<p>Name :<b><?php echo ucwords($row['lastname'].", ".$row['firstname'].' '.$row['middlename']) ?></b></p>
								 <p><small>ID NO. :<b><?php echo $row['id_no'] ?></small></b></p>
						 		<p><small>KRA PIN. :<b><?php echo $row['tax_id'] ?></small></b></p>
						 		
						 		
						 	</td>
						 	
						 	<td class="">
								 <!-- <a href='tcpdf/pdf/timika.php? id="<?php echo $row['id'] ?>"' class=""><button class="btn btn-primary" type="button">Download</button></a> -->
								 
								 <div class="dropdown">
										<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Downloads
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										[<a href='tcpdf/pdf/business_loan_application.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">Loan Application form</a>]
										[<a href='tcpdf/pdf/pre-registration.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">PRE-REGISTRATION</a>]
										[<a href='tcpdf/pdf/post-registration.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">POST-REGISTRATION</a>]
										[<a href='tcpdf/pdf/final_demand_letter.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">FINAL DEMAND LETTER</a>]
										[<a href='tcpdf/pdf/first_demand_letter.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">FIRST DEMAND LETTER</a>]
										[<a href='tcpdf/pdf/release_motor.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">MOTOR RELEASE</a>]
										[<a href='tcpdf/pdf/loan.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">Loan Application form</a>]
										[<a href='tcpdf/pdf/loan_disbursement.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">Offer Letter</a>]
										[<a href='tcpdf/pdf/loan_facility.php? id="<?php echo $row['id'] ?>"' title="PDF [new window]" target="_blank">Offer letter</a>]
											<!-- <a class="dropdown-item" href="#">Something else here</a> -->
										</div>
										</div>
								</td>
						 	
						 </tr>

						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<style>
	td p {
		margin:unset;
	}
	td img {
	    width: 8vw;
	    height: 12vh;
	}
	td{
		vertical-align: middle !important;
	}
</style>	

<script>
	$('#borrower-list').dataTable()
	$('#new_borrower').click(function(){
		uni_modal("New borrower","manage_borrower.php",'mid-large')
	})
	$('.edit_borrower').click(function(){
		uni_modal("Edit borrower","manage_borrower.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_borrower').click(function(){
		_conf("Are you sure to delete this borrower?","delete_borrower",[$(this).attr('data-id')])
	})
function delete_borrower($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_borrower',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("borrower successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>