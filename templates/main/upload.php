<?php
//error_reporting(E_ALL);
require_once('spreadsheet-plugin/php-excel-reader/excel_reader2.php');
require_once('spreadsheet-plugin/SpreadsheetReader.php');

global $db;

 
$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = $_FILES["fileToUpload"]["tmp_name"];

}

$policy_id =  trim($_POST['policy_id']);
$data_id =  trim($_POST['data_id']);


$policyInfo = getSinglePolicy($policy_id);
/*print_r($policyInfo);

echo $policy_id.$data_id ;*/
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $flag=0;      
	$Reader = new SpreadsheetReader($target_file);
	$sheetCount = count($Reader->sheets());
	for($i=0;$i<$sheetCount;$i++){

		$Reader->ChangeSheet($i);
		foreach ($Reader as $row){


			if($data_id==1){
				if(isset($row[3])){
					$paid_date= date("Y-m-d",strtotime($row[3]));
				}

				if(isset($policyInfo['paymentduedate'])){
					$due_date= date("Y-m-d",strtotime($policyInfo['paymentduedate']));
				}

				if($row[10]!="APPROVAL"){
					$status= "Recieved";
				}else{
					$status= "Pending";
				}
				if($row[9]!="RepeatSale"){
					$type= "Payment";
				}else{
					$type= "Discount";
				}

				$sql = "INSERT INTO `payments`(`id_policy`,`id_pay_cycle`,`amount`,`agent_1_discount`, `agent_2_discount`, `agent_3_discount`, `agent_4_discount`, `agent_5_discount`,`date_paid`,`action`,`id_pay_type`,`fee`,`id_discount`,`id_user`,`date_due`,`locked`,`type`,`details`,`paid`,`date_created`,
				`receipt_pay`,`receipt_type`,`receipt_note`) VALUES ('".trim($policyInfo['id'])."','".trim($policyInfo['idpaycycle'])."','".number_format($row[12],2)."','0.00','0.00','0.00','0.00','0.00','".trim($paid_date)."','".trim($status)."','1','".trim($policyInfo['fee'])."','','".trim($row[15])."','".trim($due_date)."','0','".trim($type)."','','0','','".trim($row[8])."','".trim($row[5]).'-'.trim($row[7])."','".trim($row[18])."')";

				$_SESSION["message"]='New Hartland record created successfully from CSV/XLSX file.';

			}elseif($data_id==2){

					if(isset($row[5])){
						$paid_date= date("Y-m-d",strtotime($row[5]));
					}

					if(isset($policyInfo['paymentduedate'])){
						$due_date= date("Y-m-d",strtotime($policyInfo['paymentduedate']));
					}


					$status= "Pending";
					$type= "Payment";
				

				$sql = "INSERT INTO `payments`(`id_policy`,`id_pay_cycle`,`amount`,`agent_1_discount`, `agent_2_discount`, `agent_3_discount`, `agent_4_discount`, `agent_5_discount`,`date_paid`,`action`,`id_pay_type`,`fee`,`id_discount`,`id_user`,`date_due`,`locked`,`type`,`details`,`paid`,`date_created`,
				`receipt_pay`,`receipt_type`,`receipt_note`) VALUES ('".trim($policyInfo['id'])."','".trim($policyInfo['idpaycycle'])."','".number_format($row[10],2)."','0.00','0.00','0.00','0.00','0.00','".trim($paid_date)."','".trim($status)."','1','".trim($policyInfo['fee'])."','','".trim($row[13])."','".trim($due_date)."','0','".trim($type)."','','0','','".trim($row[14])."','".trim($row[6])."','".trim($row[9])."')";

				$_SESSION["message-authrize"]='New Authrize record created successfully from CSV/XLSX file.';

			}


			if ($flag>0) {
				$result = $db->insert($sql);
				
			}

			
			$flag++;
		}
	}

	if (!empty($result)) {
		
		header('Location: '.THE_URL."main/file-upload/".$policyInfo['id']);
	} 

} else {
	echo "Sorry, there was an error uploading your file.";
}

?>