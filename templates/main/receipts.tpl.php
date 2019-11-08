<?php 
global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole,$paymentsList;$datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 

$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");

$policyCycle = getPayCycleLists();


$user_id = state('user_id');
$user_name = state("user_name");

if (isset($_GET['from_date']) && isset($_GET['to_date'])) {

	$from_date=date("Y-m-d",strtotime(trim($_GET['from_date'])));
	$to_date=date("Y-m-d",strtotime(trim($_GET['to_date'])));

	$sql="SELECT * FROM payments WHERE  date_due >= '".$from_date."' AND date_due <='".$to_date."' ";
	$paymentsData = $db->select($sql);
}else{

	$sql="SELECT * FROM payments";
	$paymentsData = $db->select($sql);
}



?>
<div class="sectionPanel_Right">
	<div class="content_section">
		<div class="page-breadcrumbs">
			<ul>
				<li><a href="#"><i class="fas fa-home"></i></a></li>
				<li><a href="#">Dashboard</a></li>
				<li>Payment Receipts Report</li>
			</ul>
		</div><!-- page-breadcrumbs END -->
			
			<div class="col-md-6 content_section_aside">
				<h4 class="content_section_aside_header">Date Due</h4> 
				<div class="row">

					<div class="col-md-12">
						<div class="paymode_status">
							<form method="get" action="" id="payment_receipt" enctype="multipart/form-data">
								<ul>
									<li><span>From Date</span>
										<p><input type="text" name="from_date" id="from_date" class="input-no-border useDatePicker datepicker-dob" value="<?=$_GET['from_date']; ?>" size="14"/></p>
									</li>
									<li><span>To Date</span>
										<p><input type="text" name="to_date" id="to_date" class="input-no-border useDatePicker datepicker-dob" value="<?=$_GET['to_date']; ?>" size="14"/></p>
									</li>
									<li><span></span>
										<p><button class="btn btn-primary bgorange" type="submit">View Info</button></p>

									</li>
									<li><span></span>
										<p><div class="btn btn-primary "><a href="<?php echo THE_URL."main/receipts/"?>"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</a></div></p>

									</li>
								</ul>
							</form>
						</div>
					</div>
				</div>
				</div><!-- content_section_aside END -->
				<form method="post" action="<?php echo THE_URL."main/payment-report-rcv"; ?>" id="print_all" enctype="multipart/form-data">
					<input type="hidden" name="from_date"   value="<?=$_GET['from_date']; ?>"/>
					<input type="hidden" name="to_date" value="<?=$_GET['to_date']; ?>" />

				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12"> 
						<div class="content_section_aside" id="content_section_payments">
							<?php 
								if(isset($_SESSION["error"])) {
									$success = $_SESSION["error"];
									unset($_SESSION["error"]);
									echo '<strong style="color:red;font-size: 18px;font-weight: bold;">'.$success.'</strong>';
								}else {
									$success = "";
								}
							?>
							<div class="title_bar" style="margin-top: 20px;">
								
								<input class="btn btn-info" target="_blank" type="submit" name="print_receipt_btn" value="Print Receipt">
							</div>
							<div class="table_overlay" style="height: 600px;">
								<table class="tableContent tableHover" >
									<tr>
										<th class="fltersearch"><span>Policy Number</span></th>
										<th class="fltersearch"><span>Main Insured</span></th>
										<th class="fltersearch"><span>Date Paid</span></th>
										<th class="fltersearch"><span>Payment Cycle</span></th>
										<th class="fltersearch"><span>Amount</span></th>
										<th class="fltersearch"><span>Policy Fee</span></th>

										<th class="fltersearch"><span>Total</span></th>
										<th class="fltersearch"><span>Person Pay</span></th>
										<th class="fltersearch"><span>Type</span></th>
										<th class="fltersearch"><span>Notes</span></th>
										<th><span>
											<input type="checkbox" name="chkbx_all_first" id="chkbx_all_unsigned"
											onclick="return check_all_first()" style="margin-top: 15px;">
											<label for="chkbx_all_unsigned" style="font-size: 14px;">Select All</label>
										</span></th>
									</tr>
									<?php

									$ins_loop = 1;
									if(count($paymentsData)>0){
										foreach($paymentsData as $payments_key => $payments_value){
											$policyInfo=getSinglePolicy($payments_value['id_policy']);
											$payCycle_name = getPayCyclebyid($payments_value['id_pay_cycle']);
											?>
											<tr class="row_payment" id="row_payment<?php echo $ins_loop; ?>" data-id="<?php echo $ins_loop; ?>" >
												<td><?php echo $policyInfo['policynumber']; ?></td>
												<td><?php echo getHealthPrimaryInsuredText($payments_value['id_policy']); ?></td>

												<td><?php echo dateFormFormat($payments_value['date_paid']);?></td>

												<td><?php echo $payCycle_name['paycycle']; ?></td>

												<td>$<?php echo number_format($payments_value['amount'],2);?></td>
												<td>$<?php echo number_format($payments_value['fee'],2); ?></td>
												<td>$<?php echo number_format($payments_value['amount']+$payments_value['fee'],2);?></td>
												<td><?=$payments_value['receipt_pay']?></td>
												<td>

													<?php $paytype = getPayTypeLists(); 
													if($paytype)
														{foreach($paytype as $pt_key => $pt_value)
															{
																echo $selected_text = ($payments_value['id_pay_type'] == $pt_key) ? $pt_value: ''; 

															}
														} 
														?>
													</td>
													<td><input type="text" readonly  size="14" value="<?=$payments_value['receipt_note']?>"></td>
													<td><input type="checkbox" name="payment_id[]" class="input-no-border element_first" size="1" value="<?=$payments_value['id'] ?>"/></td>

												</tr>
												<?php 
												$ins_loop++;
											} //end foreach
										}
										?>
									</table>
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>

<script type="text/javascript">
	function check_all_first() {

		if ($('#chkbx_all_unsigned').is(':checked')) {

			$('input.element_first').prop('checked', true);

		} else {

			$('input.element_first').prop('checked', false);

		}
	}


	function check_all() {

		if ($('#chkbx_all').is(':checked')) {

			$('input.check_elmnt').prop('checked', true);

		} else {

			$('input.check_elmnt').prop('checked', false);

		}
	}
</script>