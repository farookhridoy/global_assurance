<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8"/>
    <title></title>
    <style>
        @font-face {
          font-family: 'Montserrat-rg';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v14/JTUSjIg1_i6t8kCHKm459WRhyzbi.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
        
        @font-face {
          font-family: 'Montserrat';
          font-style: normal;
          font-weight: 700;
          font-display: swap;
          src: local('Montserrat Bold'), local('Montserrat-Bold'), url(https://fonts.gstatic.com/s/montserrat/v14/JTURjIg1_i6t8kCHKm45_dJE3gTD_u50.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
    </style>
  </head>
  <body style="margin:0; padding: 30px 20px 10px;"> 
  
    <?php global $insuredInfo;
        //print_r($insuredInfo);
        
        $footerFunctions = array("scriptHealthRateup");
        $policyinfo = getSinglePolicy($insuredInfo['idpolicy']);
        //print_r($policyinfo);
    
    
    ?>
    
    <div class="single-insured-block">
        <div class="single-insured-left-block"></div>
        <div class="single-insured-right-block">
            <h3 style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: bold; font-family: 'Montserrat';">Insured:</h3>
            <h3 style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: bold; font-family: 'Montserrat';"><?php echo $insuredInfo['first_name'].' '.$insuredInfo['last_name'];?></h3>
            <br />
            <h3 style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: bold; font-family: 'Montserrat';">Since:</h3>
            <h3 style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: bold; font-family: 'Montserrat';"><?php echo dateFormFormat($insuredInfo['effectivedate']);?></h3>
            <br />
            <h3 style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: bold; font-family: 'Montserrat';">Policy Number:</h3>
            <h3 style="display: block; font-size: 12px; color: #000; margin: 0; font-weight: bold; font-family: 'Montserrat';"><?php echo $policyinfo['policynumber']?></h3>
        </div>
        <div class="clearfix"></div>
    </div>
    
    
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
        @page {
            margin: 0;
        }
    </style>
</html>