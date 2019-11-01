<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');
        </style>
    </head>
    <body style="margin:0; padding:20px; font-family: 'Montserrat', sans-serif;"> 
  
        <?php global $insuredInfo,$policyInfo,$footerFunctions,$policyNumber;
            //print_r($policyInfo);
            
            $footerFunctions = array("scriptHealthRateup");
            $insuredLists = getHealthInsuredLists($policyInfo['id']);
            //print_r($insuredLists);
        
        
        ?>
        <?php $insuredCount = 1; foreach($insuredLists as $inLists){
            $policy_info = getSinglePolicy($inLists['idpolicy']);    
            $policyNumber = $policy_info['policynumber'];
            if($insuredCount%3 == 0){
                $className = 'last';
            }else{$className = '';}
        ?>
        <div class="single-insured-wrapper">
            <div class="single-insured-block">
                <div class="single-insured-left-block"></div>
                <div class="single-insured-right-block">
                    <p style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: 700; font-family: 'Montserrat';">Insured:</p>
                    <p style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: 700; font-family: 'Montserrat';"><?php echo $inLists['first_name'].' '.$inLists['last_name'];?></p>
                    <br />
                    <p style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: 700; font-family: 'Montserrat';">Since:</p>
                    <p style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: 700; font-family: 'Montserrat';"><?php echo dateFormFormat($inLists['effectivedate']);?></p>
                    <br />
                    <p style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: 700; font-family: 'Montserrat';">Policy Number:</p>
                    <p style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: 700; font-family: 'Montserrat';"><?php echo $policyNumber;?></p>
                </div>
            </div>
        </div>
        <?php $insuredCount++; }?>
    
    
    </body>
  
            
    <style>
        .single-insured-block {
        	width: 100%;
            height: 120px;
        }
        .single-insured-right-block {
        	width: 50%;
        	float: right;
        }
        .single-insured-left-block {
        	width: 50%;
        	float: left;
        }
        .single-insured-block.last{
            margin-right: 0;
        }
        .clearfix {
        	clear: both;
            margin: 0;
        }
        .single-insured-wrapper {margin-bottom: 1px; padding-top: 5px;}
        @page {
            margin: 0;
        }
    </style>
</html>