<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

global $insuredInfo,$footerFunctions,$policyInfo,$insuredLists,$insuredName,$policyType,$totalDeductible,$totalCoverage,$insuredCountry;
    
$insuredLists = getHealthInsuredLists($policyInfo['id']);
//print_r($insuredLists);
/*$totalPremium = 0;
foreach($insuredLists as $inLists){
    $totalPremium+= $inLists['premium']; 
}

$policyCountry = getCountryLists();
//print_r($policyCycle);
foreach($policyCountry as $keyCountry => $valCountry){
    if($keyCountry == $policyInfo['idcountry'])
    $insuredCountry = $valCountry;
}

$PolicyCoverage = getPolicyCoverages($policyInfo['idplan']);
//print_r($PolicyCoverage);
foreach($PolicyCoverage as $keyCoverage => $valCoverage){
    if($keyCoverage == $policyInfo['idcoverage'])
    $totalCoverage = $valCoverage;
}

$PolicyDeductible = getPolicyDeductibles($policyInfo['idcoverage']);
//print_r($PolicyDeductible);
foreach($PolicyDeductible as $keyDeductible => $valDeductible){
    if($valDeductible['id'] == $policyInfo['iddeductible'])
    $totalDeductible = $valDeductible['deductible'];
}

$policyCycle = getPayCycleLists();
//print_r($policyCycle);
foreach($policyCycle as $keyCycle => $valCycle){
    if($keyCycle == $policyInfo['idpaycycle'])
    $policyType = $valCycle;
}

foreach($insuredLists as $inLists){
    if($inLists['idrelation'] == 1){
        $insuredName = $inLists['first_name'].' '.$inLists['last_name'];
    }
}*/

//echo $policyInfo['idplan'];
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");
require_once 'dompdf/autoload.inc.php'; 

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$htmlString = '';
ob_start();

//echo rest($post_id);
if($policyInfo['idplan'] == 1){
    include('policy-print.tpl.php');    /* Template for Mundial */
}elseif($policyInfo['idplan'] == 2){
    include('policy-print.tpl.php');    /* Template for Sky */
}elseif($policyInfo['idplan'] == 3){
    include('policy-print.tpl.php');    /* Template for Star */
}elseif($policyInfo['idplan'] == 4){
    include('policy-print.tpl.php');    /* Template for Sun */
}


$customPaper = array(0,0,767,990);

$htmlString .= ob_get_clean();

$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$options->set('tempDir', 'pdf/tmp');

// instantiate and use the dompdf class
$dompdf = new Dompdf($options);
$dompdf->set_option('defaultFont', 'Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
//echo $htmlString;
$dompdf->loadHtml($htmlString);

$dompdf->get_canvas();

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Letter');

// Render the HTML as PDF
$dompdf->render();


$output = $dompdf->output();
#file_put_contents('filename.pdf', $output);
// Output the generated PDF to Browser
//$dompdf->stream();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("codex",array("Attachment"=>0));
?>