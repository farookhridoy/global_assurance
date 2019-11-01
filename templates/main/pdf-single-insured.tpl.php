<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

global $footerFunctions,$insuredInfo;
$footerFunctions = array("scriptHealthRateup");
require_once 'dompdf/autoload.inc.php'; 

$policyinfo = getSinglePolicy($insuredInfo['idpolicy']);

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

//$htmlString = '';

ob_start();

$customPaper = array(0,0,225,145);
//echo rest($post_id);
$htmlString = include('policy-single-print.tpl.php');

$htmlString = ob_get_clean();

$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$options->set('tempDir', 'pdf/tmp');

// instantiate and use the dompdf class
$dompdf = new Dompdf($options);
$dompdf->set_option('defaultFont', 'Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
//echo $htmlString;
$dompdf->loadHtml($htmlString);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper($customPaper);

// Render the HTML as PDF
$dompdf->render();


//$output = $dompdf->output();
#file_put_contents('filename.pdf', $output);
// Output the generated PDF to Browser
//$dompdf->stream();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("codex",array("Attachment"=>0));
?>