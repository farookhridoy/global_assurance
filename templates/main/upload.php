<?php
//error_reporting(E_ALL);
require_once('spreadsheet-plugin/php-excel-reader/excel_reader2.php');
require_once('spreadsheet-plugin/SpreadsheetReader.php');

global $db;
$user_id = state('user_id');
 
$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
	$check = $_FILES["fileToUpload"]["tmp_name"];
	$name = $_FILES["fileToUpload"]["name"];

}

$policy_id =  trim($_POST['policy_id']);
$data_id =  trim($_POST['data_id']);

$country=getCountryLists();



$policyInfo = getSinglePolicy($policy_id);
/*print_r($policyInfo);

echo $policy_id.$data_id ;*/
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $flag=0;  $cflag=0;    
	$Reader = new SpreadsheetReader($target_file);
	$sheetCount = count($Reader->sheets());
	for($i=0;$i<$sheetCount;$i++){

		$Reader->ChangeSheet($i);
		foreach ($Reader as $row){


			if($data_id==1){

				if ($name=="Heartland.xlsx") {

					if ($cflag==0 && $i==$i) {

						if ($row[15]=="Auth Amt" && $row[12]=="Status") {	
							$cflag=1;						
						}else {
							$_SESSION["error"]='Please upload Heartland valid file';
							unlink($target_file);
							header('Location: '.THE_URL."main/file-upload/".$policyInfo['id']);
						}

					}else{

						if(isset($row[5])){
							$paid_date= date("Y-m-d",strtotime($row[5]));
						}

						if(isset($policyInfo['paymentduedate'])){
							$due_date= date("Y-m-d",strtotime($policyInfo['paymentduedate']));
						}

						if($row[12]!="APPROVAL"){
							$status= "Recieved";
						}else{
							$status= "Pending";
						}
						$type= "Payment";

						$sql = "INSERT INTO `payments`(`id_policy`,`id_pay_cycle`,`amount`,`agent_1_discount`, `agent_2_discount`, `agent_3_discount`, `agent_4_discount`, `agent_5_discount`,`date_paid`,`action`,`id_pay_type`,`fee`,`id_discount`,`id_user`,`date_due`,`locked`,`type`,`details`,`paid`,`date_created`,
						`receipt_pay`,`receipt_type`,`receipt_note`) VALUES ('".trim($policyInfo['id'])."','".trim($policyInfo['idpaycycle'])."','".strval($row[15])."','0.00','0.00','0.00','0.00','0.00','".trim($paid_date)."','".trim($status)."','1','".trim($policyInfo['fee'])."','','".trim($user_id)."','".trim($due_date)."','0','".$type."','".trim($row[21])."','0','','".addslashes($row[10])."','".addslashes($row[7]).'-'.addslashes($row[9])."','".addslashes($row[21])."')";

						$_SESSION["message"]='Heartland record created successfully from CSV/XLSX file.';
					}
				}else{
					$_SESSION["error"]='Please upload "Heartland.xlsx" not '.$_FILES["fileToUpload"]["name"];
					unlink($target_file);
					header('Location: '.THE_URL."main/file-upload/".$policyInfo['id']);
				}

			}elseif($data_id==2){

				if ($name=="Authorize.xlsx") {

					if ($cflag==0 && $i==$i) {

						if ($row[5]=="Submit Date/Time" && $row[10]=="Total Amount") {

							$cflag=1;						
						}else {

							$_SESSION["error"]='Please upload valid Authorize file';
							unlink($target_file);
							header('Location: '.THE_URL."main/file-upload/".$policyInfo['id']);
						}

					}else{

						if(isset($row[5])){
							$paid_date= date("Y-m-d",strtotime($row[5]));
						}

						if(isset($policyInfo['paymentduedate'])){
							$due_date= date("Y-m-d",strtotime($policyInfo['paymentduedate']));
						}


						$status= "Pending";
						$type= "Payment";

						

						$sql = "INSERT INTO `payments`(`id_policy`,`id_pay_cycle`,`amount`,`agent_1_discount`, `agent_2_discount`, `agent_3_discount`, `agent_4_discount`, `agent_5_discount`,`date_paid`,`action`,`id_pay_type`,`fee`,`id_discount`,`id_user`,`date_due`,`locked`,`type`,`details`,`paid`,`date_created`,
						`receipt_pay`,`receipt_type`,`receipt_note`) VALUES ('".trim($policyInfo['id'])."','".trim($policyInfo['idpaycycle'])."','".strval($row[10])."','0.00','0.00','0.00','0.00','0.00','".trim($paid_date)."','".trim($status)."','1','".trim($policyInfo['fee'])."','','".trim($user_id)."','".trim($due_date)."','0','".$type."','','0','','".addslashes($row[14]).'-'.addslashes($row[15])."','".addslashes($row[11]).'-'.addslashes($row[6])."','".addslashes($row[9])."')";

						$_SESSION["message"]='Authorize record created successfully from CSV/XLSX file.';
					}
					

				}else{
					$_SESSION["error"]='Please upload "Authorize.xlsx" not '.$_FILES["fileToUpload"]["name"];
					unlink($target_file);
					header('Location: '.THE_URL."main/file-upload/".$policyInfo['id']);
				}
			}elseif($data_id==3){

				

					if ($cflag==0 && $i==$i) {

						if ($row[1]=="name" && $row[2]=="lastname") {

							$cflag=1;						
						}else {

							$_SESSION["error"]='Please upload valid  file';
							unlink($target_file);
							header('Location: '.THE_URL."main/file-upload/".$policyInfo['id']);
						}

					}else{

						if(isset($row[7]) && $row[7]=='TRUE'){
							$pay_by='CK';
						}
						if(isset($row[8]) && $row[8]=='TRUE'){
							$pay_by='DD';
						}
						if(isset($row[9]) && $row[9]=='TRUE'){
							$pay_by='WT';
						}

						$country_id=0;
						foreach ($country as $key=> $country_data) {

							if ($country_data == strtoupper($row[6])) {
								$country_id = $key;
							}
						}

						$date_created= date("Y-m-d h:i:s");

								$sql = "INSERT INTO `agents` (`id`,
								`name`,`lastname`,`idagent`,`level`,`email`,`phone`,`notes`,`number`,`idcountry`,`idpaytypeagent`,`payto`,`health`,`life`,`datecreated`,`commission`,
								`sys_nb`,`nb`,`sys_rn`,`rn`,`pay_by`,`active`)
								VALUES ('".trim($row[0])."','".addslashes($row[1])."','".addslashes($row[2])."','".trim($row[12])."','".trim($row[11])."','info@example.com','0','notes','".addslashes($row[5])."','".strtoupper($country_id)."','0','".addslashes($row[10])."','1','0','".trim($date_created)."',
								'0','0','".trim($row[3])."','0','".trim($row[4])."','".trim($pay_by)."','1')";
						

						$_SESSION["message"]='Agents record created successfully from CSV/XLSX file.';
					}
					

				
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
	
	$_SESSION["error"]='Sorry, there was an error uploading your file.';
	header('Location: '.THE_URL."main/file-upload/".$policyInfo['id']);
}

?>

