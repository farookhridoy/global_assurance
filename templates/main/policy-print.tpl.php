<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <style>
    @font-face {
      font-family: 'Calibri';
      src: url(http://bdmonster.com/module-insurance-system/dompdf/lib/fonts/CalibriRegular.ttf);
      font-weight: normal;
      font-style: normal;
    }

    </style>
</head>


<body style="margin:0; padding:0; font-family: courier; font-size: 10px; color: #232b2b;">

    <?php global $insuredInfo,$footerFunctions,$policyInfo,$insuredLists,$insuredName,$policyType,$totalDeductible,$totalCoverage,$insuredCountry,$totalPremium;
    
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        //print_r($policyInfo);idrelation
        
        $footerFunctions = array("scriptHealthRateup");
        //$insuredInfo = getHealthSingleInsured($policyInfo['id']);
        $insuredLists = getHealthInsuredLists($policyInfo['id']);
        //print_r($insuredLists);
        $totalPremium = 0;
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
        }
    
    
    ?>
    <div class="wrapper" style="max-width: 816px;margin: 0 auto;">
        <div class="banner-con">
            <img src="http://bdmonster.com/module-insurance-system/images/banner.jpg" alt="Banner Image" />
        </div>
    </div>

    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto; height: 0;">
        <div class="common-page common-blank-page" style="padding-top: 200px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; opacity: 0;">

            <div>

                <p><strong>Cl&aacute;usula de Cobertura</strong></p>

                <p>
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compa��a" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compa��a, y cuyo nombre se identifica en la tarjeta de identificaci�n y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compa��a. La cobertura se brinda s�lo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los l�mites especificados en este documento y como se se�ala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta p�liza se emite basada en la informaci�n suministrada en la solicitud. Si alguna informaci�n en la solicitud no es correcta o est� incompleta, o cualquier otra informaci�n se ha omitido, la Compa��a a su discreci�n, revocara, cancelara o modificara los beneficios de la p�liza del Asegurado que omiti� informaci�n, as� como el Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no.
                </p>

                <p><strong>SECCI�N 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El t�rmino <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El t�rmino <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la p�rdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El t�rmino <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o c�nyuge debido a la p�rdida de vidas causada �nicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, as� como la p�rdida de las partes del cuerpo que se detallan en la Tabla de P�rdidas.
                </p>

                <p>
                    El t�rmino <b>"Addendum ":</b> se refiere a un documento a�adido a la p�liza por la Compa��a y ser� una parte de la p�liza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El t�rmino <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organizaci�n contratada con la Compa��a para proporcionar servicios de suscripci�n, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>


        </div>
    </div>

    <div class="wrapper-2" style="height: 1055px; max-width: 816px;margin: 0 auto; background-image: url('http://bdmonster.com/module-insurance-system/images/water-mark1.jpg'); background-repeat: no-repeat;">
        <div class="sec-page" style="padding-top: 200px;padding-left: 50px; padding-right: 50px;padding-bottom: 1px; margin-bottom: 20px;">
            <h3 style="text-align: center; font-size: 30px; font-weight: bold; font-family: 'Montserrat', sans-serif; margin-bottom: 40px; margin-top: 0; display: inline-block; width: 100%;">Certificate of Insurance</h3>
            <ul style="list-style-type: none; padding: 0; margin-bottom: 20px;">
                <li>
                    <h4 style="font-size: 20px; margin: 0; font-weight: bold;"><?php echo $insuredName;?></h4>
                </li>
                <li style="font-size: 12px;"><?php echo $policyInfo['addressl1'];?></li>
                <li style="font-size: 12px;"><?php echo $policyInfo['addressl2'];?></li>
                <li style="font-size: 12px;"><?php echo $policyInfo['city'];?>, <?php echo $insuredCountry;?></li>
            </ul>


            <ul style="list-style-type: none; padding: 0;">
                <li style="font-size: 12px;">
                    <h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: top; color: #000;">Policy #:</h3>
                    <p style="display: inline-block;vertical-align: top; margin: 0; color: #232b2b;"> <?php echo $policyInfo['policynumber'];?></p>
                </li>

                <li style="font-size: 12px;">
                    <h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Payment Period:</h3>
                    <p style="display: inline-block;vertical-align: top; margin: 0; color: #232b2b;"> <?php echo dateFormFormat($policyInfo['paymentstart'], 'm/d/y');?> to <?php echo dateFormFormat($policyInfo['paymentend'], 'm/d/y');?> </p>
                </li>

                <li style="font-size: 12px;">
                    <h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Annual Major Medical Limit:</h3>
                    <p style="display: inline-block;vertical-align: top; margin: 0; color: #232b2b;"> $<?php echo $totalCoverage;?></p>
                </li>

                <li style="font-size: 12px;">
                    <h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Annual Major Medical Deductible ICR :</h3>
                    <p style="display: inline-block;vertical-align: top; margin: 0; color: #232b2b;"> $0</p>
                </li>

                <li style="font-size: 12px;">
                    <h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Annual Major Medical Deductible OCR:</h3>
                    <p style="display: inline-block;vertical-align: top; margin: 0; color: #232b2b;"> <?php echo $totalDeductible;?></p>
                </li>

                <li style="font-size: 12px;">
                    <h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Policy Mode:</h3>
                    <p style="display: inline-block;vertical-align: top; margin: 0; color: #232b2b;"> <?php echo $policyType;?></p>
                </li>
            </ul>

            <div style="text-align: center; height: 300px;">
                <table class="table-one" style="text-align: center;margin: auto; border-collapse: collapse; width: 100%;">
                    <tr>
                        <th style="font-size: 12px; font-weight: bold;">
                            <h3 style="font-weight: bold; margin: 0; font-size: 16px;text-align: center; color: #000;"><b>INSURED</b></h3>
                        </th>
                        <th style="font-size: 12px; font-weight: bold;">
                            <h3 style="font-weight: bold; margin: 0; font-size: 16px;text-align: center; color: #000;"><b>DOB</b></h3>
                        </th>
                        <th style="font-size: 12px; font-weight: bold;">
                            <h3 style="font-weight: bold; margin: 0; font-size: 16px;text-align: center; color: #000;"><b>AGE</b></h3>
                        </th>
                        <th style="font-size: 12px; font-weight: bold;">
                            <h3 style="font-weight: bold; margin: 0; font-size: 16px;text-align: center; color: #000;"><b>EFFECTIVE DATE</b></h3>
                        </th>
                        <th style="font-size: 12px; font-weight: bold;">
                            <h3 style="font-weight: bold; margin: 0; font-size: 16px;text-align: center; color: #000;"><b>ANNUAL PREMIUM</b>
                        </th>
                    </tr>
                    <?php $insuredCount = 1; foreach($insuredLists as $inLists){?>
                    <tr>
                        <td style="font-size: 12px;"><?php echo $inLists['first_name'].' '.$inLists['last_name'];?></td>
                        <td style="font-size: 12px;"><?php echo dateFormFormat($inLists['dob']);?></td>
                        <td style="font-size: 12px;"><?php echo $inLists['age'];?></td>
                        <td style="font-size: 12px;"><?php echo dateFormFormat($inLists['effectivedate']);?></td>
                        <td style="font-size: 12px;">$ <?php echo $inLists['premium'];?></td>
                    </tr>
                    <?php $insuredCount++; }?>

                </table>
            </div>


            <div style="text-align: right; margin-right: 50px; padding-top: 50px; position: relative;">
                <div class="sign" style="position: absolute; top: 0; left: 0;">
                    <img src="http://bdmonster.com/module-insurance-system/images/sign.png" alt="">
                </div>
                <ul style="list-style-type: none; padding: 0; text-align: right; float: right;">
                    <li><span style="font-weight: bold; text-align: right;"><h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Annual Medical Premium:</h3></span> <p style="display: inline-block;vertical-align: middle; margin: 0; color: #232b2b; font-size: 11px;">$ <?php echo $totalPremium;?></p></li>
                    <li><span style="font-weight: bold; text-align: right;"><h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Policy Fee:</h3></span> <p style="display: inline-block;vertical-align: middle; margin: 0; color: #232b2b; font-size: 11px;">$ <?php echo $policyInfo['fee'];?></p></li>
                    <li><span style="font-weight: bold; text-align: right;"><h3 style="font-weight: bold; display: inline-block; margin: 0; font-size: 16px;vertical-align: middle; color: #000;">Annual Premium:</h3></span> <p style="display: inline-block;vertical-align: middle; margin: 0; color: #232b2b; font-size: 11px;">$ <?php echo $totalPremium+$policyInfo['fee'];?></p></li>

                </ul>

            </div>
            <div class="my-clearfix" style="clear: both;"></div>
            <div class="bottom-para" style="padding-top: 40px; padding-bottom: 10px; display: inline-block;">
                <p style="text-align: justify; color: #fff; font-size: 12px;">This policy pays Eligible Medical Expenses based on the declarations in your Application; Riders issued at the time of underwriting if any, Policy, Schedule of Benefits, Policy Provisions, Definitions, Limitations and Exclusions. This Policy has a clause for Pre-Existing Conditions. Please Read your policy carefully.</p>
            </div>

        </div>

    </div>

    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;">
        <div class="common-page common-blank-page" style="padding-top: 180px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; opacity: 0;">

            <div>

                <p><strong>Cl&aacute;usula de Cobertura</strong></p>

                <p>
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compa��a" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compa��a, y cuyo nombre se identifica en la tarjeta de identificaci�n y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compa��a. La cobertura se brinda s�lo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los l�mites especificados en este documento y como se se�ala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta p�liza se emite basada en la informaci�n suministrada en la solicitud. Si alguna informaci�n en la solicitud no es correcta o est� incompleta, o cualquier otra informaci�n se ha omitido, la Compa��a a su discreci�n, revocara, cancelara o modificara los beneficios de la p�liza del Asegurado que omiti� informaci�n, as� como el Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no.
                </p>

                <p><strong>SECCI�N 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El t�rmino <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El t�rmino <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la p�rdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El t�rmino <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o c�nyuge debido a la p�rdida de vidas causada �nicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, as� como la p�rdida de las partes del cuerpo que se detallan en la Tabla de P�rdidas.
                </p>

                <p>
                    El t�rmino <b>"Addendum ":</b> se refiere a un documento a�adido a la p�liza por la Compa��a y ser� una parte de la p�liza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El t�rmino <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organizaci�n contratada con la Compa��a para proporcionar servicios de suscripci�n, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>


        </div>
    </div>

    <?php $strContent = ' 

 <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 180px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; position: relative;">
       
            <div>
            <p class="page_no">Page 5 of 52</p>
                
                <ul style="list-style-type: none; padding: 0; margin-bottom: 20px;">
                    <li style="font-size: 13px; font-weight: bold;"><h3 style="margin: 0; font-size: 18px; font-weight: bold; font-family: Montserrat, sans-serif;"><b>Plan Mundial</b></h3></li>
                    <li style="font-weight: bold; font-size: 12px;"><h3 style="margin: 0;">Certificado de Cobertura</h3></li>
                    <li style="font-weight: bold; font-size: 12px;"><h3 style="margin: 0;">Suscrito Por</h3></li>
                    <li style="font-weight: bold; font-size: 12px;"><h3 style="margin: 0;">Claria Life and Health Insurance Company</h3></li>
                </ul>                
                
                <h3 style="margin: 0; font-weight: bold; font-size: 14px;">Cl&aacute;usula de Cobertura</h3>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compa��a" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compa��a, y cuyo nombre se identifica en la tarjeta de identificaci�n y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compa��a. La cobertura se brinda s�lo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los l�mites especificados en este documento y como se se�ala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    Esta p�liza se emite basada en la informaci�n suministrada en la solicitud. Si alguna informaci�n en la solicitud no es correcta o est� incompleta, o cualquier otra informaci�n se ha omitido, la Compa��a a su discreci�n, revocara, cancelara o modificara los beneficios de la p�liza del Asegurado que omiti� informaci�n, as� como el Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no. 
                </p>
                
                <h3 style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCI�N 1: DEFINICIONES DE CERTIFICADO</h3>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Accidente o Accidental"</span> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Cobertura por Muerte Accidental"</b></span> ser refiere a la cobertura incluida en este Certificado debido a la p�rdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b></span> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o c�nyuge debido a la p�rdida de vidas causada �nicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, as� como la p�rdida de las partes del cuerpo que se detallan en la Tabla de P�rdidas.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Addendum ":</b></span> se refiere a un documento a�adido a la p�liza por la Compa��a y ser� una parte de la p�liza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Administrador"</b></span> se refiere a Global Assurance Group, Inc., la organizaci�n contratada con la Compa��a para proporcionar servicios de suscripci�n, administrativos y pago de reclamos en virtud de este Certificado.
                </p>
                
            </div>
            
            <p class="page-footer" style="opacity: .4; margin-top: 30px; bottom: 20px !important;">
                La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
       
       
        </div>
      </div>
      
      <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 220px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; position: relative;">
       
            <div class="p_6">
            <p class="page_no">Page 6 of 52</p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Admisi�n"</span> se refiere a la aceptaci�n oficial por un hospital u otro establecimiento de atenci�n hospitalaria de un paciente que va a contar con alojamiento, comida y servicio de enfermer�a continua en un �rea del hospital o centro donde los pacientes permanecen al menos durante la noche. Una visita a la sala de emergencia o en una cl�nica sin un servicio de admisi�n de 24 horas con camas y enfermeras no ser� considerada como una Admisi�n. 
                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Agente"</span> se entender� como el agente de seguros, corredor o productor, si hubiese alguno relacionado con la petici�n de la solicitud, que act�a �nicamente como agente legal y representante de los intereses personales del Asegurado y como tal no tiene autoridad para hablar en nombre de la Compa��a, recibir pagos a su nombre o nombre de su empresa y no est� actuando como agente o representante legal de la Compa��a.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Abuso de Alcohol o Drogas"</span>, se refiere a cualquier patr�n de uso patol�gico de alcohol o drogas que causa deterioro en el funcionamiento social o laboral, o que produce la dependencia fisiol�gica y demuestra la tolerancia f�sica o de s�ntomas f�sicos cuando se retira.
                </p>
               
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Anexo"</span> se refiere a un documento a�adido a la p�liza por la Compa��a y que detalla una cobertura opcional.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Solicitud"</span> se refiere al formulario de inscripci�n oficial expedido por el Administrador, que debe ser completado, fechado y firmado por cada solicitante (o tutor legal para solicitantes que son menores de edad) y todos los adjuntos y / o documentos relativos a la informaci�n de suscripci�n de cada solicitante que figuran en la Solicitud.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Aprobado o aprobaci�n"</span> se entender� como la determinaci�n final del Administrador de otorgar cobertura, con o sin cl�usulas de exclusi�n y / o un aumento de la prima de la Persona Asegurada, despu�s que el Administrador ha recibido y revisado la solicitud adem�s de toda la informaci�n de suscripci�n solicitada.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Mamograma de Referencia"</span>, se entender� como una mamograf�a de detecci�n que se utiliza como una comparaci�n para ex�menes futuros.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Certificado o p�liza":</span> se entender� como el resumen de los t�rminos de cobertura, que incluye: este
                    documento, la solicitud de la persona asegurada y los endosos, exclusiones o enmiendas que
                    se conceder�n durante el Per�odo de cobertura de la Persona Asegurada.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Hijo"</span> se entender� como el hijo natural, hijastro o un hijo menor bajo la tutela legal del Asegurado Primario, pero s�lo si ese ni�o depende del apoyo y manutenci�n del Asegurado Primario y vive con el Asegurado Primario en una relaci�n de padre-hijo. 
                </p>
                <p>
                    El t�rmino Hijo no incluye a un hijo adoptivo que es elegible para beneficios proporcionados por un programa gubernamental o la ley, a menos que sea requerido por la ley del Estado.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Clase"</span> se entender� un grupo de personas aseguradas que comparten caracter�sticas comunes a criterio de la Compa��a, incluyendo, pero no limitado al tipo de plan, deducible, grupo demogr�fico, regi�n geogr�fica, empleador o industria de clasificaci�n.
                </p>
            
            
            
           </div>
           
            <p class="page-footer" style="opacity: .4; bottom: 20px !important;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
            
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 220px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; position: relative;">
       
            <div class="p_7">
            
            <p class="page_no">Page 7 of 52</p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>�Coaseguro� </b></span> se refiere al porcentaje de los Beneficios Elegibles, despu�s del Deducible, el cual es responsabilidad de cada Persona Asegurada y debe ser pagado por esta antes que los Beneficios de esta P�liza lleguen a ser pagaderos por la Compa��a. El monto del Coaseguro se declara en la Tabla de Beneficios. 
                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Compa��a"</span> se refiere a Claria Life and Health Insurance Company, la organizaci�n que proporciona la Cobertura bajo los t�rminos de la presente p�liza
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Complicaciones del Embarazo"</span> se refiere a cualquiera o a todas de las siguientes condiciones que puedan empeorar, debido al Embarazo, o que puedan ocurrir durante este o que sean causadas por este: nefritis aguda, nefrosis, descompensaci�n cardiaca, aborto incompleto, hiper�mesis grav�dica, Embarazo ect�pico terminado, ces�rea medicamente necesaria, pre eclampsia, diabetes gestacional, cese espont�neo del Embarazo, que ocurre cuando el nacimiento no es viable, y otros problemas M�dicos de similar severidad.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Consulta"</span>, se refiere a una visita o sesi�n con un M�dico o Proveedor de Servicios M�dicos.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cong�nito"</span> o <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Defecto de Nacimiento"</span>, se refiere a cualquier anomal�a, deformidad, enfermedad, o lesi�n al nacer, ya sea diagnosticada o no. Se incluyen en la definici�n condiciones hereditarias, cualquier anormalidad, deformidad, enfermedad que ha sido transmitida a trav�s de generaciones en cualquier persona de la familia del asegurado que no sea multifactorial o polig�nica.
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Convaleciente"</span> se refiere al Tratamiento, servicios y suministros necesarios para asistir en la recuperaci�n de un paciente para llegar a un cierto grado de funcionamiento corporal que le permita a s� mismo la ejecuci�n de las actividades vitales b�sicas diarias.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Centro de Cuidado para el Convaleciente�</span> se refiere a un establecimiento, o a una parte distintiva de este, que re�na las siguientes caracter�sticas: a) Posee licencia para suministrar y ocuparse de proveer a Pacientes Internos convalecientes como resultado de una Lesi�n o Enfermedad, servicios profesionales de enfermer�a proporcionados por un(a) Enfermero(a) licenciado(a) actuando bajo la supervisi�n de un(a) Enfermero(a) Certificado(a), servicios de fisioterapia para asistir a los pacientes para alcanzar un grado de desempe�o f�sico que les permita actuar con autonom�a durante las actividades vitales cotidianas esenciales. b) Sus servicios son proporcionados a cambio de una remuneraci�n por parte de sus pacientes y para pacientes ingresados por menos de 24 horas (ambulatorios), provee supervisi�n a tiempo completo de un M�dico o un Enfermero(a) Certificado(a). c) Mantiene un registro M�dico completo de cada paciente y muestra un empleo efectivo de un plan de evaluaci�n. El Centro de cuidado para el convaleciente no incluye instalaciones de reposo, tercera edad, uso y abuso indebido de drogas, guarder�a, cuidado de enfermer�a, o para la atenci�n de personas con trastornos mentales o nerviosos o los mentalmente incompetentes.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cobertura"</span> se refiere a los Beneficios Elegibles descritos en esta P�liza, para los cuales la Persona Asegurada es elegible, ya sea para ser reembolsada por la Compa��a o para el pago directo por tratamiento y servicios al Proveedor M�dico.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Per�odo de Cobertura�</span> se refiere al periodo comprendido entre la Fecha Efectiva de Cobertura Individual y la Fecha Efectiva de Terminaci�n de Cobertura de esta p�liza.
                </p>
            
            
            
           </div>
           
            <p class="page-footer" style="opacity: .4; bottom: 20px !important;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
            <p class="page_no">Page 8 of 52</p>
            
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Siniestro Cubierto o Accidente Cubierto"</span>, se refiere a los gastos cubiertos por una enfermedad o un accidente por lesiones corporales que requieran tratamiento m�dico por un proveedor de servicios, tal como se definen en la presente p�liza.
                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Gastos cubiertos"</span> se refiere a los gastos por servicios M�dicamente Necesarios, suministros, cuidados o Tratamiento por causa de una Enfermedad o Lesi�n, de acuerdo a lo definido en esta P�liza, prescritos, realizados u ordenados por un M�dico licenciado y/o un Proveedor de Servicio M�dico; los cargos Razonables y Acostumbrados, en los que la Persona Asegurada hubiese incurrido, dentro del Periodo de Cobertura, los cuales son: 1) aquellos enumerados en la Tabla de Beneficios, 2) aquellos que no forman parte de las Exclusiones y 3) aquellos que no excedan los l�mites m�ximos establecidos en la Tabla de Beneficios.
                <p>
                   No califican para estar cubiertos bajo esta p�liza todos aquellos gastos m�dicos en los que se incurriere como resultado de gastos m�dicos no cubiertos, incluyendo odontolog�a, cirug�a pl�stica, u otros procedimientos y gastos excluidos en las Exclusiones no ser�n elegibles para ser cubiertos bajo esta p�liza
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cuidados de Custodia"</span> se refiere al tipo de cuidado suministrado principalmente con el prop�sito de asistir a la persona en las actividades cotidianas o en satisfacer b�sicamente necesidades personales m�s que m�dicas y que no tiene que ver espec�ficamente con Tratamiento de una Enfermedad o Lesi�n. Es el tipo de cuidado del cual no se puede esperar que mejore sustancialmente una condici�n m�dica y tiene el m�nimo valor terap�utico, sea que est� totalmente incapacitado o no para realizar actividades vitales cotidianas.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">�Citolog�a"</span>, se refiere al examen ginecol�gico (Papanicolaou) realizado para diagnosticar c�ncer cervical, a trav�s del estudio microsc�pico de las c�lulas raspadas de la superficie del cuello uterino.
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Deducible"<span> se refiere a la cantidad de los Beneficios Elegibles que es responsabilidad de cada Persona Asegurada y que debe ser pagada por la misma, antes que los Beneficios de esta P�liza sean pagaderos por la Compa��a.
                </p>
                <p>
                    
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Beneficio Dental"<span> se entender� el tratamiento para arreglar o reemplazar los dientes naturales despu�s de un accidente cubierto.

                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Dentista"</span> se refiere a un m�dico con licencia legal de cirug�a dental, odontolog�a o la ciencia odontol�gica. Un higienista dental que trabaje a trav�s de su licencia, bajo la supervisi�n de un dentista, ser� un proveedor cubierto.

                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Dependiente"</span> se refiere al c�nyuge legalmente casado con la Persona Asegurada Principal o cuando dos personas que est�n aplicando bajo la p�liza viven juntas. Al Hijo(a) natural o legalmente adoptado(a) soltero(a) de la Persona Asegurada Principal, desde los catorce (14) d�as de edad hasta su d�cimo noveno (19�.) cumplea�os; o al Hijo(a) soltero(a) con al menos diecinueve (19) a�os de edad, pero menor de veinticuatro (24) a�os, y matriculado como Estudiante a Tiempo Completo en un Colegio o Universidad acreditada y que no sea empleado(a) a tiempo completo. Los l�mites de edad que se aplican a el (los) Hijo(s) Dependiente(s) no se aplicar�n a ning�n Hijo(s) asegurado de la Persona Asegurada Principal que dependa de esta para su sustento y manutenci�n porque se encuentre imposibilitado de trabajar a consecuencia de un impedimento f�sico o retardo mental, que ocurriese antes de alcanzar la edad l�mite y mientras estuviese asegurado por esta p�liza.
                </p>
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
            
            <p class="page_no">Page 9 of 52</p>
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Afecci�n"</span> se refiere a cualquier condici�n o enfermedad que figuran en la edici�n m�s reciente de la Clasificaci�n Internacional de Enfermedades o una condici�n aceptada y reconocida como una enfermedad o lesi�n reconocida por la Asociaci�n M�dica Americana.
                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">�Terapia Educacional, De Rehabilitaci�n, Vocacional, Ocupacional, F�sica, del Habla, de Recreaci�n�</span> se refiere a los cuidados dados despu�s de una Enfermedad o Lesi�n con el fin de restablecer, sea mediante adiestramiento o bien mediante entrenamiento, la capacidad para desempe�arse de una manera normal o casi normal. Si los l�mites est�n incluidos en la Tabla de beneficios, estas deben ser aprobadas previamente por el Administrador o el siniestro ser� denegado. 
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Fecha Efectiva"</span> se refiere a la fecha en que la Cobertura de esta P�liza comienza. Despu�s de la revisi�n y aprobaci�n de cada Solicitante por parte del Administrador, la Cobertura comenzar� a ser efectiva en la �ltima de las siguientes fechas: (1) la fecha en la cual la Solicitud y la Prima correcta son recibidas por el Administrador, o 2) la fecha en que el Solicitante es Aprobado por el Administrador.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Beneficios Elegibles"</span> se refiere a los gastos por servicios M�dicamente Necesarios, suministros, cuidados o Tratamiento, por causa de una Enfermedad o Lesi�n, prescritos, realizados u ordenados por un M�dico licenciado y/o un Proveedor de Servicio M�dico; los cargos Razonables y Acostumbrados; en los que la Persona Asegurada hubiese incurrido dentro del Periodo de Cobertura, los cuales son: 1) aquellos enumerados en la Tabla de Beneficios, 2) aquellos no excluidos en las Exclusiones y 3) aquellos que no excedan los l�mites m�ximos establecidos en la Tabla de beneficios.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Emergencia"</span> se refiere a una condici�n m�dica manifestada con se�ales o s�ntomas agudos, la cual podr�a resultar en poner en peligro la vida o miembros de la Persona Asegurada, a menos que se proporcione atenci�n m�dica en un lapso de 24 horas.
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Evacuaci�n M�dica de Emergencia / Repatriaci�n�</span> significa que el M�dico Legalmente Calificado local y la empresa de asistencia de viaje autorizada han determinado por escrito que el Asegurado se encuentra en condiciones de ser transportado y que el transporte a un hospital o centro m�dico es m�dicamente necesario para tratar una enfermedad o lesi�n inesperada que pone en peligro la vida y que el tratamiento m�dico adecuado no est� disponible en el �rea inmediata. Los gastos de transporte incurridos ser�n pagados de acuerdo a los cargos usuales, acostumbrados y razonables para el transporte al hospital m�s cercano o centro m�dico capaz de proporcionar ese tratamiento.
                </p>
                <p>
                    
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Experimental / En Investigaci�n y/o de Estudio�</span> se refiere a Tratamiento, medicamento, dispositivo, procedimiento, suministro, servicio o afines (o una parte de ello, incluyendo la clase, administraci�n o dosis) para un diagn�stico o condici�n particular, cuando se d� una de las siguientes situaciones:

                </p>
                
                <ol style="font-size:12px;">
                    <li>El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio est� bajo ensayo cl�nico o en ensayo de Fase I, II o III.</li>
                    <li>El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio no ha sido totalmente Aprobado o reconocido por la agencia gubernamental pertinente o por una organizaci�n profesional tal como la American Medical Association, National Cancer Institute y Food &amp; Drug Administration.</li>
                    <li>Los resultados que no han sido probados en ensayos cl�nicos controlados, ni publicados en reconocidas publicaciones M�dicas revisoras en ingl�s, en el sentido de ser m�s Seguros y eficaces que el Tratamiento convencional, tanto en corto como a largo plazo.</li>
                </ol>
                
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
                <p class="page_no">Page 10 of 52</p>
                
                <ol style="list-style-type: none; font-size:12px;">
                    <li>4.	El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio no es de pr�ctica m�dica aceptada de manera general en el estado o Pa�s de Residencia de la Persona Asegurada o no es aceptada de manera general en toda la comunidad m�dica relevante, seg�n una o m�s de las siguientes referencias: literatura m�dica revisada en Ingl�s, consulta con otros M�dicos, compendio m�dico autorizado, la American Medical Association, u otras organizaciones profesionales o las agencias gubernamentales pertinentes.</li>
                    <li>5.	El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio es descrito como experimental, de car�cter investigativo, un estudio, o destinado a investigaci�n o similar, en cualquier consentimiento, liberaci�n o autorizaci�n que la Persona Asegurada, o alguien actuando en su nombre, deba firmar</li>
                </ol>
            
             
                <p>
                   El hecho que el tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio sea la �nica esperanza de supervivencia de la Persona Asegurada no implica que deje de ser de car�cter experimental, investigativo, o destinado a investigaci�n.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Estudiante a tiempo completo"</span> es la persona matriculada en al menos 12 horas cr�dito de estudio.
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Pa�s de Origen o Pa�s de Residencia"</span> se refiere al pa�s donde la Persona Asegurada ha tenido por m�s de 9 meses de un a�o de p�liza, su residencia fija y permanente. El Asegurado es responsable de notificar al Administrador de cambio de pa�s en los primeros 30 d�as que el cambio se realice o la p�liza ser� cancelada a discreci�n del Administrador.
                </p>
                <p>
                    
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Agencia de Cuidados a Domicilio�</span> se refiere una agencia p�blica o privada, o a una de sus subdivisiones la cual opera de acuerdo a la ley, y que est� dedicada regularmente a proveer Cuidados de Enfermer�a a domicilio bajo la supervisi�n de un(a) Enfermero(a) Certificado(a), y que mantiene un registro diario de cada paciente, con un programa de observaci�n y Tratamiento planificado por un m�dico, de acuerdo con los est�ndares establecidos de pr�ctica m�dica.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">�Cuidados a Domicilio�</span> se refiere a los servicios que ofrece una Agencia de Cuidados a Domicilio, y que son supervisados por un(a) Enfermero(a) Certificado(a), dirigidos al cuidado personal del paciente; siempre que esa atenci�n sea m�dicamente necesaria y deba ser previamente aprobada por el Administrador o el reclamo ser� negado. Cuidados a domicilio no aplican para beneficios de maternidad.


                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Hospicio"</span> se refiere al plan coordinado de cuidados a domicilio, hospitalizaci�n y ambulatorios para dar servicios m�dicos paliativos, sustentadores y otros, a pacientes enfermos terminales- que se define como tener un pron�stico de 6 meses o menos. Un equipo multidisciplinario presta cuidados continuos y planificados, cuyo componente m�dico dirigido por un M�dico. El cuidado estar� disponible 24 horas al d�a, siete d�as a la semana. El Hospicio debe cumplir con los requerimientos legales de la localidad donde opere. 
                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Hospital"</span>, se refiere a un establecimiento que: 1) opera legalmente con el prop�sito de ofrecer cuidado y Tratamiento M�dico a personas Enfermas o Lesionadas, a las cuales se les cobra una suma que la Persona Asegurada est� legalmente obligada a pagar, a falta de un Seguro 2) presta dicho cuidado o Tratamiento M�dico en sus instalaciones m�dicas, quir�rgicas o de diagn�stico, en sus propios locales o en aquellos preparados para tal uso. 3) ofrece 24 horas de servicio de enfermer�a bajo la supervisi�n de un(a) Enfermero(a) Certificado(a) a tiempo completo 4) opera bajo la supervisi�n de un equipo de uno o m�s M�dicos. El Hospital tambi�n se refiere a 
                </p>
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 11 of 52</p>
                 <p>
                 un lugar acreditado como tal por la Joint Commission Accreditation of Hospitals, la American Osteopathic Association, o la Joint Commission on Accreditation of Health Care Organizations (JCAHO.) 
                </p>
                
                <p>
                    No califican como Hospitales:
                </p>
                
                <ol style="font-size:12px;">
                    <li>establecimientos u hogares para Convalecientes, servicios de enfermer�a o reposo, ni un albergue geri�trico.</li>
                    <li>un lugar que preste principalmente cuidados en las �reas de Guarder�a, Adiestramiento o Rehabilitaci�n; o </li>
                    <li>un establecimiento destinado principalmente para el Tratamiento de drogadictos o alcoh�licos.</li>
                </ol>
            
             
              
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermedad"</span> se refiere a una Dolencia o Padecimiento de cualquier �ndole, listada en la edici�n m�s reciente de la International Classification of Diseases.
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Incidente"</span>, se refiere a que todas las Enfermedades que existan simult�neamente y que se deban a la misma causa o a causas relacionadas con ella, son consideradas como un Incidente. Adem�s, si una Enfermedad se debe a causas que son las mismas o se relacionan a causas de una Enfermedad anterior, la Enfermedad se considerar� una continuaci�n de dicha Enfermedad anterior, y no un Incidente separado. Todas las lesiones debidas por el mismo accidente se considerar�n un incidente.
                </p>
                <p>
                    
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Lesi�n"</span> se refiere a una Lesi�n f�sica enumerada en la m�s reciente edici�n de International Classification of Diseases y causada sola y directamente por medios Accidentales, externos y visibles, acaecidos durante la vigencia de la presente P�liza, y resultantes directa e independientemente de todas las otras causas, que produzca un Siniestro Cubierto por esta.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Paciente Hospitalizado"</span> se refiere una persona que sea admitida o confinada en una instituci�n por un per�odo de 24 horas o m�s y a la cual se le cobra por habitaci�n y comida.


                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Seguro"</span>, se refiere a la cobertura descrita y prevista en virtud de la presente p�liza.
                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Persona Asegurada(s) o Asegurado"</span> se refiere a una persona elegible para obtener Cobertura bajo esta P�liza, como se establece en la Credencial de Identificaci�n, quien ha solicitado Cobertura y es nombrada en la Solicitud y para quien la Compa��a ha Aprobado Cobertura y aceptado la Prima correspondiente. Esta puede ser la Persona Asegurada Principal o los Dependientes.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Unidad de Cuidados Intensivos o Coronarios�</span> se refiere a una unidad de cuidados card�acos u otra �rea o unidad de un Hospital la cual re�na los requerimientos est�ndar de la Joint Commission on Accreditation of Hospitals for Special Care.
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">" Error M�dico "</span> se refiere a un error profesional incluyendo, pero no limitado a un error u omisi�n de cualquier m�dico, enfermera, cirujano, dentista, asistente m�dico, t�cnico, farmac�utico u otro profesional de la medicina. Error m�dico comprender� tambi�n, pero no se limitar�, a la prestaci�n o falta de brindar servicio m�dico, profesional o tratamiento y omisi�n por parte de un proveedor de atenci�n de salud en el que el tratamiento cae por debajo de las normas aceptadas de la pr�ctica en la comunidad m�dica y causa lesiones o muerte para el paciente.
                </p>
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 12 of 52</p>
                 <p>
                 El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"M�dicamente Necesario o Necesidad M�dica�</span> se refiere a aquellos servicios, Tratamientos o suministros recibidos por la Persona Asegurada que la Compa��a determine que son: 1) apropiados y necesarios para los s�ntomas, diagn�stico o Tratamiento de cuidado directo de las condiciones m�dicas de la Persona Asegurada; 2) dentro de las normas de la comunidad m�dica organizada considere una buena pr�ctica m�dica para la condici�n de la persona asegurada; 3) no prestados s�lo con fines educativos o principalmente para conveniencia de la Persona Asegurada, de su M�dico o de alguna otra persona o Proveedor de Servicios; 4) no Experimental / En Investigaci�n o de estudio; y 5) no excesivo en alcance, duraci�n o intensidad para proveer un Tratamiento Seguro, adecuado y apropiado.
                </p>
                
                <p>
                    Por Hospitalizaci�n se entiende que la atenci�n aguda de la Persona Asegurada es necesaria debido a los tipos de servicios que la Persona Asegurada recibe o a una gravedad tal de la condici�n de la Persona Asegurada, que no puede administrarse el cuidado adecuado y seguro de manera Ambulatoria o en un establecimiento menos especializado.
                </p>
                
                <p>
                    El hecho que un M�dico en particular pueda prescribir, ordenar, recomendar, o aprobar un servicio, tratamiento, suministro o nivel de cuidado, no hace dicho Tratamiento M�dicamente Necesario ni convierte los cargos en Gastos Cubiertos bajo esta P�liza.
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Medicina o Medicaci�n�</span> se refiere a los f�rmacos y/o anest�sicos prescritos por un M�dico, y dispensados a la Persona Asegurada por un farmaceuta licenciado como resultado de un Gasto Cubierto. Medicina o Medicaci�n se refiere al equivalente gen�rico de un f�rmaco, o si el equivalente gen�rico no est� disponible, el f�rmaco de marca. Medicina o Medicaci�n s�lo significar� f�rmacos prescriptibles.
                </p>
                <p>
                    
                  El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermedad Mental�</span> se refiere a des�rdenes, Enfermedades o condiciones Mentales, emocionales y psiqui�tricas, (sean de origen org�nico o inorg�nico, biol�gico o no-biol�gico, gen�tico, qu�mico o no-qu�mico). Los des�rdenes Mentales o nerviosos incluyen, pero no se limitan a psicosis, trastornos neur�ticos, trastornos bipolares, des�rdenes afectivos; des�rdenes de personalidad, anormalidades sicol�gicas o de conducta, asociados con disfunci�n transitoria o permanente del cerebro o de los sistemas neuro-hormonales; y condiciones, des�rdenes y Enfermedades enumerados en la m�s reciente edici�n de Diagnostic and Statistical Manual of Mental Disorders IV-R o en la edici�n m�s reciente de International Classification of Diseases a la fecha en que el servicio m�dico o el Tratamiento es aplicado a una Persona asegurada.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Paciente Ambulatorio�</span> se refiere una persona que recibe cuidados en un Hospital u otra instituci�n, incluyendo centros de Cirug�a Ambulatoria; instalaciones de enfermer�a para convalecencia o cuidados especializados; o consultorio del M�dico, adonde se acude por Enfermedad o Lesi�n, pero donde no se es internado o recluido por un periodo de 24 horas, y donde no se cobra habitaci�n y comida.

                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Residencia Permanente"</span> se refiere al pa�s donde la Persona Asegurada ha estado m�s de 9 meses durante el periodo de la p�liza anual, o su verdadero, fijo y permanente hogar y establecimiento principal, al cual la Persona Asegurada tiene intenciones de regresar.
                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"M�dico o Doctor"</span> se refiere a un doctor en medicina o a un doctor en osteopat�a, licenciado para prestar servicios m�dicos o realizar cirug�as, de conformidad con las leyes de la jurisdicci�n en la cual tales servicios profesionales son realizados.
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 13 of 52</p>
                 <p>
                El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">�Condici�n Pre-existente�</span> se refiere a cualquiera de las siguientes: 1) Una condici�n que habr�a causado que una persona buscase consejo M�dico, diagn�stico, cuidado o Tratamiento antes de la Fecha Efectiva Individual de Cobertura de esta P�liza, 2) una condici�n por la cual se busc�, recomend� o recibi� consejo m�dico, diagn�stico, cuidado o Tratamiento, incluyendo medicaci�n, antes de la Fecha Efectiva Individual de Cobertura bajo esta P�liza; 3) los s�ntomas manifestados antes de la Fecha Efectiva Individual de Cobertura bajo esta P�liza, le hubieran permitido a una persona entrenada en Medicina hacer un diagn�stico de la condici�n que produjo los s�ntomas; 4) una condici�n que se manifiesta antes de la fecha efectiva en virtud de este Certificado de Cobertura individual. 5) Los gastos de Embarazo incluyendo, antes, despu�s del nacimiento, complicaciones del nacimiento tanto para la madre como para el reci�n nacido dentro de los doce (12) meses desde la Fecha Efectiva Individual de Cobertura bajo esta P�liza. 
                </p>
                
                <p>
                   El Administrador puede emitir Cl�usulas de Exclusi�n para ciertas Condiciones Preexistentes. Las Condiciones Pre-existentes que sean declaradas de manera precisa y completa en la Solicitud, y que sean aprobadas y aceptadas por el Administrador sin una Cl�usula de Exclusi�n u otra restricci�n, estar�n cubiertas autom�ticamente al m�nimo de hasta un m�ximo vitalicio de $50.000 con un l�mite de $5.000 por Periodo de Cobertura, una vez que la Persona Asegurada haya estado continuamente asegurada por 24 meses.
                </p>
                
                <p>
                    En el momento de la solicitud y a discreci�n del Administrador, beneficios inmediatos con aumento de l�mites pueden ser ofrecidos.
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Organizaci�n de Proveedor Preferido (PPO)"</span> se refiere a los hospitales aprobados, m�dicos u otros proveedores de servicios que han entrado en un acuerdo contractual con la Compa��a para prestar servicios hospitalarios y servicios m�dicos a las personas aseguradas a honorarios negociados.
                </p>
                <p>
                    
                 El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Embarazo o la Maternidad"</span>, se refiere a la condici�n f�sica de estar embarazada, incluyendo las complicaciones del embarazo.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Prima"</span> se refiere a la suma de dinero correspondiente, en D�lares Estadounidenses, cargada por la Compa��a, y cobrada por el Administrador, por la Cobertura que ofrece esta P�liza, la cual se aplica a la edad de la Persona Asegurada, seg�n el g�nero, deducible, l�mite m�ximo y cualquier condici�n m�dica de la Persona Asegurada, por los cuales el Administrador cobra peri�dicamente para mantener la Cobertura bajo esta p�liza.

                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Pre-Notificaci�n y Pre-Notificar�</span> significan que la Persona Asegurada notifica al Administrador, por adelantado, sobre cualquier admisi�n hospitalaria en cualquier parte del mundo, o sobre cualquier Cirug�a Ambulatoria o Beneficios Elegibles que vayan a exceder los $1.000. El proceso de Pre-Notificaci�n estar� completo despu�s que la Persona Asegurada reciba Tratamiento o servicios en la Red de Proveedores de su preferencia, a la cual la Persona Asegurada pueda tener acceso, y que confirme que tal ingreso es M�dicamente necesario.
                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Prescripci�n de Medicamentos"</span> se refiere a los medicamentos cuya venta y uso son restringidos a la orden de un m�dico. 
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Persona Principal Asegurada"</span> se refiere a la persona en la solicitud, quien aparece como el Asegurado Principal, y que pueden tener dependientes, quienes son personas aseguradas.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Razonables y Acostumbrados�</span> se refiere a la cantidad m�xima que la Compa��a determina que es Razonable y Acostumbrada para los Beneficios Elegibles que la Persona Asegurada recibe, hasta los cargos 
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 14 of 52</p>
                 <p>
                realmente facturados y sin excederlos. La determinaci�n de la Compa��a considera: 1) los montos cobrados por otros Proveedores de Servicios por el mismo servicio o uno similar; 2) cualquier circunstancia m�dica inusual que requiera tiempo, habilidad o experiencia adicionales; y 3) el costo que para el Proveedor de Servicio representa prestar los servicios o suministros, o realizar el procedimiento; y 4) otros factores que la Compa��a determine son relevantes, incluyendo un recurso basado en la escala relativa de valores, peso sin limitarse a este.
                </p>
                
                <p>
                   Para un Proveedor de Servicio que tenga un acuerdo de reembolso con la Compa��a, el cargo Usual y Acostumbrado es igual al monto que constituya pago total bajo cualquier acuerdo de reembolso con la Compa��a.
                </p>
                
                <p>
                    Si un Proveedor de Servicio acepta como pago total una cantidad menor que la tasa negociada bajo un acuerdo de reembolso, la cantidad menor ser� el m�ximo cargo Razonable y acostumbrado.
                <p>
                   El cargo Razonable y Acostumbrado ser� reducido debido a cualquier sanci�n de la cual un Proveedor de Servicio sea responsable, como resultado de ese acuerdo del Proveedor de Servicio con la Compa��a.
                </p>
                <p>
                    
                 El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermero(a) Certificado(a)�</span> se refiere a un(a) enfermero(a) graduado(a) que ha sido certificado(a) o licenciado(a) para ejercer por un Consejo Estatal de Examinadores de Enfermer�a o de otra autoridad jurisdiccional, y quien est� legalmente autorizado(a) para colocar las iniciales <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">�R.N.�</span> despu�s de su nombre.

                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Familiar�</span> significa c�nyuge, padre, hermanos, Hijo(a), abuelos, nietos, padres adoptivos, Hijos adoptivos, hermanastros, familiares pol�ticos (suegra, nuera, yerno, cu�ado, cu�ada), t�o(a), sobrino(a), representante legal, pupilo o primo de la Persona Asegurada.

                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Repatriaci�n"</span> se refiere al traslado de la Persona Asegurada hasta su Pa�s de Residencia.
                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Rescindir o Rescisi�n de la P�liza�</span> o <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">�Nulo�</span> o <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">�Cancelado�</span> se refiere a la terminaci�n del Asegurado que omiti� informaci�n, as� como el Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no, con efecto retroactivo a la Fecha Efectiva Individual de Cobertura, como resultado de haber sometido informaci�n inexacta u omisi�n de hechos en la Solicitud o adjunta a las declaraciones de salud que no cumplan con los requisitos de elegibilidad. Sin importar que la informaci�n inexacta de la solicitud o declaraci�n est� relacionada con un siniestro cercano, la Compa��a, a su discreci�n, elegir� entre cancelar la p�liza, y devolver al pagador toda la Prima retroactiva a la Fecha Efectiva Individual de Cobertura original, o emitir una exclusi�n permanente para la Condici�n Pre-existente y negar el reclamo. En el caso que una p�liza se anule, cualquier reclamo de pago efectuado en la p�liza a partir de la fecha de entrada en vigor hasta la fecha en que la p�liza es revocada, se aplicar� hacia la devoluci�n de la prima. Si los pagos de reclamaciones exceden la devoluci�n de la prima, el Asegurado es responsable de reembolsar a la Compa��a el exceso de reclamaciones pagadas en un plazo de 30 d�as, o la Compa��a se reserva el derecho de proceder contra el Asegurado con cargos civiles y / o penales. 
                </p>
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cl�usula de Exclusi�n"<span> se refiere a la Aprobaci�n de la Persona Asegurada para obtener Cobertura, pero ser�n excluidos los Gastos Cubiertos para ciertas condiciones m�dicas o Tratamientos, en forma escrita, por parte del Administrador.

                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Mamograf�a�</span> se refiere al estudio radiogr�fico de baja dosis usado para visualizar la estructura interna de los senos.
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 15 of 52</p>
                 <p>
                El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Proveedor de Servicios o Proveedor":</span> se refiere a un Hospital, Hospicio, Convalecientes / centro de enfermer�a especializada, centro quir�rgico ambulatorio, hospital psiqui�trico, centro de salud mental de la comunidad, instalaciones para Tratamiento psiqui�trico, centro para el Tratamiento de la dependencia de drogas y alcohol, centro de maternidad, M�dico, Odont�logo, quiropr�ctico, auxiliar m�dico licenciado, enfermero(a), laboratorio m�dico, Compa��a de servicio auxiliar, firma de ambulancia a�rea o terrestre o cualquier otra instalaci�n af�n que la Compa��a apruebe para proporcionar servicios seg�n la p�liza.
                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Accidente grave"</span> se refiere a un trauma repentino que ocurre sin la intenci�n del asegurado; implica una causa externa e impacto violento en el cuerpo, resultando en una lesi�n grave que requiere atenci�n hospitalaria demostrable e inmediata dentro de las primeras horas despu�s de un traumatismo accidental para evitar la p�rdida de la vida o la integridad f�sica. La existencia de una lesi�n accidental grave ser� determinada de com�n acuerdo entre el m�dico tratante y el consultor m�dico de la Compa��a despu�s de revisar las notas de evaluaci�n inicial, y los res�menes cl�nicos de la sala de urgencias y hospitalizaci�n.
                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermo o Enfermedad"</span> significa Dolencia o Afecci�n de cualquier clase listada en la edici�n m�s reciente de la Clasificaci�n Internacional de Enfermedades.
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Rider Madre Soltera "<span> se refiere al anexo que detalla la cobertura de maternidad prevista, por una prima adicional, a la Asegurada Principal cuando el c�nyuge no est� cubierto bajo este Certificado
                </p>
                <p>
                    
                El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Rider de Estudiante en el EE.UU. "</span> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, a un hijo dependiente que es estudiante a tiempo completo en los Estados Unidos. Esta cl�usula se puede comprar por un m�ximo de cuatro (4) a�os.

                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cirug�a o Procedimiento Quir�rgico"</span> se refiere a un procedimiento de diagn�stico invasivo, o al Tratamiento de una Enfermedad o Lesi�n mediante operaciones manuales o instrumentales realizados por un M�dico, mientras el paciente se encuentra bajo los efectos de anestesia local o general.

                </p>
                
                <p>
                   El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Fecha de Vencimiento�</span> se refiere a que la Cobertura terminar� en la primera de las siguientes fechas: 1.) El final del periodo por el cual se pag� la Prima; 2) la fecha en que la Persona Asegurada falle en cumplir con los requerimientos de Elegibilidad descritos en la SECCI�N 3, A; 3) la fecha en que la Compa��a cese la Cobertura de una Clase de Personas Aseguradas espec�fica, de la cual la Persona Asegurada pueda formar parte.
                </p>
                
                <p>
                    El t�rmino <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Tratamiento"</span> se refiere a manejo quir�rgico o m�dico de un paciente con el prop�sito de resolver o sanar la Enfermedad o Lesi�n, basado en pr�cticas m�dicas est�ndares y aceptadas. Para los prop�sitos de esta P�liza, el curso de acci�n s�lo incluir� aquellos Beneficios planificados y Aprobados, para los cuales la Persona Asegurada sea elegible.
                </p>
           
               

            <h3 style="font-size:14px;font-weight: bold;">SECCION 2: TABLA DE BENEFICIOS</h3>
            <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">A. Objetivo del Seguro:</span></p>   
                
                <p>
                   La Compa��a se ha comprometido, mediante la recepci�n de la prima estipulada, a cubrir los gastos m�dicos de la p�liza, que incurra el asegurado durante la vigencia de este contrato, hasta la suma asegurada especificada en esta p�liza a 
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 220px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 16 of 52</p>
                 <p>
               consecuencia de una enfermedad cubierta y lesiones que se producen a un Asegurado incluido en la p�liza y de acuerdo a las condiciones y l�mites estipulados en el presente contrato.
                </p>
                <br><br>
                
                <p>
                   <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">B. Tabla de beneficios:</span>
                </p>
                
                <p>
                   La cobertura m�xima para todos los gastos m�dicos y hospitalarios cubiertos durante la vigencia de la p�liza est� sujeta a los t�rminos y condiciones de esta p�liza. A menos que se indique lo contrario, todos los beneficios son por persona, por a�o p�liza. Todos los importes mencionados en el presente documento, en relaci�n con los beneficios y deducibles cubiertos, se detallan en d�lares de los Estados Unidos.
                </p>
                
                <div>
                    
                    <table class="table-page-16">
                     
                     <tr>
                         <th>TABLA DE BENEFICIOS</th>
                         <th>COBERTURA</th>
                     </tr>
                     
                     <tr>
                         <td>Suma Anual Asegurada</td>
                         <td>$2,000,000 m�ximo por asegurado/renovaci�n vitalicia</td>
                     </tr>
                     
                     <tr>
                         <td>Habitaci�n Privada y alimentaci�n</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Unidad de cuidados intensivos</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Honorarios de cirujano y anestesista</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Servicios de diagn�stico (patolog�a, radiograf�a, resonancia magn�tica, tomograf�a computarizada, tomograf�a por emisi�n de positrones, ultrasonido, endoscopia)</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Medicamentos recetados durante una hospitalizaci�n en el extranjero para uso ambulatorio *</td>
                         <td>hasta $4,000 con 20% de coaseguro</td>
                     </tr>
                     
                     <tr>
                         <td>Tratamiento del c�ncer (quimioterapia/radioterapia) </td>
                         <td>100%</td>
                     </tr>
                     



                     <tr>
                         <td>Hospitalizaci�n, Cirug�a Ambulatoria y Emergencias, en el pa�s de residencia.
                            Sin deducible para todas las opciones	</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Indemnizaci�n Hospitalaria</td>
                         <td>$100 por un m�ximo de 5 d�as</td>
                     </tr>
                     
                     <tr>
                         <td>Gastos incurridos en Hospitales No Participantes o fuera de la red. (Por reembolso)</td>
                         <td>Cubiertos al 50%</td>
                     </tr>
                     
                     <tr>
                         <td>Visitas a m�dicos y especialistas*</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Visitas a m�dicos y especialistas en el pa�s de residencia</td>
                         <td>100% hasta un m�ximo de $150 por consulta</td>
                     </tr>
                     
                     <tr>
                         <td>Vacunas hasta la edad de 10 a�os</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Visitas de ni�o sano</td>
                         <td>4 visitas por a�o p�liza hasta la edad de 2 a�os
                            2 visitas por a�o p�liza hasta la edad de 19 a�os
                            </td>
                     </tr>
                     
                     <tr>
                         <td>Cuidado Preventivo o Rutinario � Asegurado Primario y C�nyuge</td>
                         <td>$100 por p�liza, por a�o p�liza</td>
                     </tr>
                     
                     <tr>
                         <td>Medicamentos prescritos en pa�s de residencia
                            Medicamentos prescritos en el extranjero
                            </td>
                         <td>$4,000 con 20% Coaseguro</td>
                     </tr>
                     
                     <tr>
                         <td>Fisioterapia/rehabilitaci�n - (debe ser Pre-aprobada)</td>
                         <td>100% hasta un m�ximo de 40 sesiones por a�o</td>
                     </tr>
                     
                     <tr>
                         <td>Di�lisis *</td>
                         <td>100% hasta un m�ximo de $150,000 por a�o p�liza</td>
                     </tr>
                     
      
                     
                 </table>
                    
                    
                    
                    
                    
                    
                </div>
                 
                 
                  

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 220px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
                  <p class="page_no" style="margin-bottom: 20px;">Page 17 of 52</p>
                
                <div>
                    
                    <table class="table-page-17">
                     
                     <tr>
                         <td>Atenci�n m�dica en el hogar- (debe ser pre-aprobada)</td>
                         <td>100% hasta un m�ximo de $10,000.00 por a�o p�liza</td>
                     </tr>
                     
                     <tr>
                         <td>Ambulancia a�rea y terrestre -debe ser pre-aprobada</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Segunda opini�n medica</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Medicina alternativa</td>
                         <td>Max 12 visitas por a�o, hasta $150 por visita</td>
                     </tr>
                     
                     <tr>
                         <td>Ambulancia a�rea en territorio nacional</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>
                             <p>
                                 Cuidado de la Maternidad
                             </p>
                             <p>
                                � Per�odo de espera de 10 meses <br>
                                � Sin deducible<br>
                                Aplica para opciones 1,2 y 3 <br><br>
                                Habitaci�n Suite<br><br><br>
                                Almacenamiento de c�lulas madres<br><br>
                                
                                Cobertura especial por complicaciones<br>
                                Aplica para opciones 1,2 y 3<br><br>
                                
                                Cobertura de reci�n nacido los primeros<br>
                                90 d�as para opciones 1,2 y 3


                             </p>
                             


                             
                         </td>
  
                         <td>
                            
                            <p>
                               $8,000 (por embarazo) dentro y fuera del pa�s <br>
                               de residencia<br><br><br><br>

                                Incluida, en pa�s de residencia, dentro del l�mite de $8,000 <br>
                                de cobertura<br><br>
                                
                                
                                Hasta $1,500, dentro del l�mite de $8,000 de cobertura<br><br>
                                
                                $500,000<br><br><br>
                                $50,000
                                
                            </p>
                             
         
                         </td>
                     </tr>
                     
                     <tr>
                         <td>Condiciones Cong�nitas y Hereditarias **</td>
                         <td>100% hasta un m�ximo de $500,000</td>
                     </tr>
                     
                     <tr>
                         <td>Trasplantes (Vitalicio) * </td>
                         <td>$750,000 m�ximo para uno o la combinaci�n de varios trasplantes de �rganos y/o tejidos.</td>
                     </tr>
                     



                     <tr>
                         <td>S�ndrome de Inmunodeficiencia Adquirida **	</td>
                         <td>$20,000</td>
                     </tr>
                     
                     <tr>
                         <td>Virus del papiloma humano (VPH)</td>
                         <td>$3,000 vitalicio</td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura temporal durante periodo de emisi�n (con pago sometido)</td>
                         <td>$10,000</td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura para dependientes elegibles debido al fallecimiento del Asegurado Primario</td>
                         <td>Tres (3) a�os</td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura dental de emergencia</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Repatriaci�n de restos mortales</td>
                         <td>100%- hasta $1,500 en pa�s de residencia para gastos funerarios</td>
                     </tr>
                     
                     <tr>
                         <td>Hospicio/ Cuidado Terminal (debe ser pre- aprobado)</td>
                         <td>100% hasta un m�ximo de $10,000 por a�o p�liza
                            </td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura de viaje</td>
                         <td>Incluida</td>
                     </tr>

                     
                 </table>   
                    
                </div>
                
               <ul style="font-size:12px;">
                   <li>* Cobertura despu�s de aplicado el deducible</li>
                   <li>** Cobertura vitalicia</li>
               </ul>
               
                  <p>
                      <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Opciones de Deducible</span>
                  </p>
                  
                  
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
            
            <div>
                    
                    <table class="table-page-18">
                     
                     <tr>
                         <th>Opci�n</th>
                         <th>Deducible en pa�s de residencia</th>
                         <th>Deducible fuera del pa�s de residencia</th>
                     </tr>
                     
                     <tr>
                         <td>1</td>
                         <td>$0.00</td>
                         <td>$1,000</td>
                     </tr>
                </table>
          </div>
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                  <p class="page_no">Page 18 of 52</p>
                
                <div>
                    
                    <table class="table-page-18" style="width: 100%;">
       
                     <tr>
                         <td>2</td>
                         <td>$2,000</td>
                         <td>1</td>
                     </tr>
                     
                     <tr>
                         <td>3</td>
                         <td>$3,000</td>
                         <td>1</td>
                     </tr>
                     
                     <tr>
                         <td>4</td>
                         <td>$5,000</td>
                         <td>1</td>
                     </tr>
                     
                     
                     <tr>
                         <td>5</td>
                         <td>$10,000</td>
                         <td>$10,000</td>
                     </tr>
          
                 </table>   
                    
                </div>
                
                <p>
                    <span style="font-size:12px;">C. BENEFICIOS ELEGIBLES</span>
                </p>
                
               
                  <span style="font-size:12px;">1. Honorarios del Anestesista:</span> 
                  <p>La cobertura de los honorarios del anestesi�logo debe ser aprobada previamente por la Compa��a y se limita a la menor de:</p>
                   
                       <ol style="font-size:12px;">
                           <li>el 100% (cien por ciento) de las tarifas usuales, acostumbradas y razonables para el anestesi�logo, o</li>
                           <li>35% (treinta y cinco por ciento) de las tarifas usuales, acostumbradas y razonables del cirujano principal para el procedimiento quir�rgico, o </li>
                           <li>35% (treinta y cinco por ciento) de los honorarios aprobados para el cirujano principal para el procedimiento quir�rgico, o</li>
                           <li>Tarifas especiales establecidas por la Compa��a para un �rea o pa�s.</li>
                       </ol>
    
                   
                   <span style="font-size:12px;">2. Honorarios del Cirujano Asistente:</span>
                   <p>
                        Los honorarios del m�dico / cirujano asistente estar�n cubiertos s�lo cuando es m�dicamente necesario para una operaci�n la asistencia del m�dico / cirujano, y cuando la Compa��a ha pre aprobados los honorarios.
                        Los honorarios del m�dico / cirujano asistente est�n limitados al menor de:</p>
                        
                        <ol style="font-size:12px;">
                           <li>el 100% (cien por ciento) de las tarifas usuales, acostumbradas y razonables para el procedimiento, o</li>
                           <li>20% (veinte por ciento) de los honorarios aprobados para el cirujano principal de este procedimiento, o</li>
                           <li>Si m�s de un m�dico o cirujano asistente es necesario, la cobertura m�xima de todos los m�dicos o cirujanos asistentes en conjunto no exceda del 20% (veinte por ciento) de los honorarios del cirujano principal para el procedimiento quir�rgico, o</li>
                           <li>Tarifas especiales establecidas por la Compa��a para un �rea o pa�s.</li>
                       </ol>
                 
                 
                       <span style="font-size:12px;">3. Alojamiento y Comida</span><p>
                       Los cargos por alojamiento y comida ser�n cubiertos al 100 % en el caso de una habitaci�n privada en el extranjero. Para <br>las admisiones en el pa�s de residencia, el reembolso de habitaci�n privada est� cubierto hasta $200.00 por d�a.<br><br>
                        Unidad de cuidados intensivos y otras unidades de atenci�n especializada ser�n cubiertas al 100%.<br><br>
                        Otros servicios hospitalarios y suministros (excepto para cuidado personal cuidados de hospicio), incluyendo, pero no limitado a: atenci�n de enfermer�a, terapia de inhalaci�n, f�sica u ocupacional (mientras el asegurado se encuentra hospitalizado), quir�fano, sala de recuperaci�n, suministros m�dicos, pruebas de laboratorio y quir�rgicos rayos X, electrocardiogramas, electroencefalogramas, administraci�n de ox�geno, fluidos e inyecciones intravenosas.</p>
 
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 
               
      <p class="page_no">Page 19 of 52</p>
      
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">4. Cirug�a Ambulatoria</span></p>
                  <p>
                     Cuando una persona asegurada se somete un procedimiento quir�rgico que no requiere hospitalizaci�n, los honorarios quir�rgicos y otros servicios relacionados con la cirug�a ser�n reembolsados al mismo nivel que si el asegurado hubiese sido hospitalizado.
                  </p>
                 
          
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">5.	Indemnizaci�n Hospitalaria</span></p>
                       <p>
                         Beneficio en efectivo de $100 por noche cuando se elige recibir Tratamiento de Hospitalizaci�n de Beneficios Elegibles en un hospital en su pa�s de residencia. M�ximo de cinco (5) noches por persona asegurada por a�o p�liza. Este beneficio no es aplicable para maternidad y/o complicaciones de maternidad. Esto beneficia s�lo se aplica para el Asegurado Primario y el c�nyuge asegurado en la p�liza. Este beneficio no se aplica a otros dependientes.
                       </p>
                        
                
                 
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">6. Proveedores fuera de la red</span></p>
                        <p>
                        Los gastos incurridos fuera de la red de proveedores ser�n cubiertos a trav�s de reembolso al 50% de acuerdo con los costes habituales, razonables y acostumbrados para el procedimiento. En Venezuela, los reclamos sometidos a reembolso no ser�n elegibles para beneficios. Para que un reclamo sea elegible para beneficios bajo el contrato de esta p�liza, el Administrador debe coordinar directamente con el proveedor.
                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">7. Condiciones cong�nitas y hereditarias</span></p>
                        <p>
                        La cobertura para condiciones cong�nitas y hereditarias bajo de este contrato es igual al l�mite m�ximo de $500,000 despu�s de alcanzar el deducible.
                       </p>
                       
                       <p style="margin-bottom:0;"><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">8. Deducible</span></p>
                       
                       <ol style="font-size:11px;">
                           <li style="margin-bottom:5px;">Un (1) deducible por Asegurado, por a�o p�liza hasta el deducible m�ximo fuera del pa�s de residencia.</li>
                           <li style="margin-bottom:5px;">Un (1) deducible por Asegurado, por a�o p�liza hasta el deducible m�ximo dentro del pa�s de residencia.</li>
                           <li style="margin-bottom:5px;">Un m�ximo de dos (2) deducibles por p�liza, por a�o p�liza para cumplir con un m�ximo de dos (2) deducibles fuera del pa�s de residencia.</li>
                           <li style="margin-bottom:5px;">En caso de un accidente grave, no se aplicar� deducible durante la primera hospitalizaci�n.
                                Los gastos incurridos en el pa�s de residencia est�n sujetos al deducible en el pa�s de residencia. Los gastos incurridos fuera del pa�s de residencia est�n sujetos al deducible fuera del pa�s de residencia.
                           </li>
                       </ol>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">9. Evacuaci�n de Emergencia</span></p>
                        <p>
                        La Compa��a pagar� los Beneficios Elegibles incurridos hasta el m�ximo indicado en la Tabla de Beneficios, en caso de cualquier enfermedad o lesi�n cubierta que comience durante el Periodo de cobertura de la persona asegurada resulte en una emergencia m�dicamente necesaria de evacuaci�n m�dica de emergencia o la repatriaci�n de la persona asegurada. La decisi�n de una evacuaci�n m�dica de emergencia o la repatriaci�n debe ser ordenada por el Administrador de la Compa��a en consulta con el m�dico tratante de la persona asegurada.<br>

                        Evacuaci�n m�dica de emergencia o de repatriaci�n se entiende: que el M�dico Legalmente Calificado local y la empresa de asistencia de viaje autorizada han determinado por escrito que el Asegurado se encuentra en condiciones de ser transportado y que el transporte a un hospital o centro m�dico es m�dicamente necesario para tratar una enfermedad o lesi�n inesperada que pone en peligro la vida y que el tratamiento m�dico adecuado no est� disponible en el �rea inmediata. Los gastos de transporte incurridos ser�n pagados de acuerdo a los cargos 
                       </p>
                       

   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
         <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 
               <p class="page_no">Page 20 of 52</p>
      
                  <p>usuales, acostumbrados y razonables para el transporte al hospital m�s cercano o centro m�dico capaz de proporcionar ese tratamiento.</p>
                  <p>
                    El transporte en ambulancia a�rea:
                  </p>
                  
                  <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Todo el transporte por ambulancia a�rea debe ser coordinado y aprobado previamente por la Compa��a. En el caso que la Compa��a no puede dar su aprobaci�n a este beneficio, el gasto estar� sujeto a ser procesado por reembolso previa evaluaci�n y aprobaci�n de la Compa��a.</li>
                           <li style="margin-bottom: 5px;">El Asegurado se compromete a liberar a la Compa��a de responsabilidad por cualquier retraso o la restricci�n en los vuelos debido a problemas mec�nicos causados por las restricciones del gobierno o por el piloto, o debido a cualquier negligencia o condiciones de funcionamiento resultantes de tales servicios.
                            </li>
                       
                 </ol>
                 
          
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">10. Cobertura Temporal durante Emisi�n</span></p>
                       <p>
                         Cobertura m�dica temporal por accidentes de hasta un m�ximo de $10,000 mientras que la solicitud de seguro es evaluada para suscripci�n y antes que la p�liza se ha realizado y aprobado a un plazo m�ximo de 30 d�as a partir de la fecha de recepci�n de la solicitud por el Administrador condicional que el pago se ha enviado y recibido por la Compa��a, junto con la solicitud antes del accidente. Todos los beneficios pagados son sujetos a los t�rminos de esta p�liza, los l�mites deducibles y exclusiones que hubieran sido aplicados, si hubiese sido la p�liza aprobada antes del accidente.
                       </p>
                        
                
                 
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">11. Cobertura extendida para dependientes elegibles al deceso del asegurado principal</span></p>
                        <p>
                       En caso de fallecimiento del asegurado principal, se pagar� hasta tres a�os de prima para los asegurados que est�n inscritos en la p�liza cuando se otorgue este beneficio.
                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">12. Fisioterapia / Rehabilitaci�n</span></p>
                        <p>
                        La fisioterapia / rehabilitaci�n ser� cubierta cuando sea recomendada por un m�dico para el tratamiento de un evento cubierto espec�fico y es administrada por un fisioterapeuta con licencia.<br><br>
                        Cubre un per�odo inicial de 30 d�as, con la condici�n que debe ser aprobada previamente por la Compa��a a un precio m�ximo de $200 por sesi�n. Cualquier extensi�n en incrementos de hasta 30 d�as deber� ser aprobado con antelaci�n, o la reclamaci�n ser� denegada. Para cada aprobaci�n el Asegurado deber� presentar un informe m�dico actualizado que demuestren la necesidad y plan de tratamiento. Terapias m�ximas autorizados son 40 sesiones por a�o p�liza.

                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">13. Maternidad</span></p>
                           
                    <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">El beneficio m�ximo es de $8,000 por embarazo dentro y fuera del pa�s de residencia, sin deducible. En el pa�s de residencia la cobertura incluir� en el l�mite m�ximo de $8,000, los cargos por una suite privada en el hospital. En el pa�s de residencia la cobertura incluir� en el l�mite m�ximo de $ 8,000, los gastos de conservaci�n del cord�n umbilical y el almacenamiento de hasta un m�ximo de $1,500. Esta cobertura s�lo se aplica a las opciones de deducible 1, 2 y 3.</li>
                           <li style="margin-bottom: 5px;">El cuidado pre y post-natal, parto normal, parto por ces�rea, complicaciones de la maternidad y el cuidado del reci�n nacido saludable est�n incluidos dentro del beneficio m�ximo para el embarazo estipulado en esta p�liza.
                            </li>
                            <li style="margin-bottom: 5px;">Este beneficio aplica para embarazos cubiertos. Los embarazos cubiertos son aqu�llos para los que la fecha de parto es por lo menos 10 meses despu�s de la fecha de vigencia de la cobertura para el Asegurado Primario y su C�nyuge.
                            </li>
         
                 </ol>
                       
          
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
            <p class="page_no">Page 21 of 52</p>
                <ol start="4" style="font-size:11px;">
                      <li style="margin-bottom: 5px;">
                                No hay cobertura de maternidad bajo esta p�liza para las hijas dependientes.
                            </li>
                            <li style="margin-bottom: 5px;">
                                El per�odo de espera de la cobertura de los 10 meses de la maternidad aplica en todo momento, incluso cuando se ha eliminado el per�odo de espera de 90 d�as para esta p�liza.
                            </li>
                            
                            <li style="margin-bottom: 5px;">
                              El padre y la madre del ni�o deben estar en la misma p�liza y estar continuamente cubiertos durante 10 meses antes del parto.
                                
                            </li>
                </ol>
                 
      
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">14. Complicaciones del embarazo y parto: (Aplica para las opciones de deducible 1, 2 y 3)</span></p>
                       <p>
                         Las complicaciones del embarazo y / o el reci�n nacido durante el parto (salvo condiciones cong�nitas y hereditarias), incluyendo, pero no limitado a prematuridad, bajo peso al nacer, hiperbilirrubinemia, hipoglucemia, problemas respiratorios y trauma durante el parto ser�n cubiertos de la siguiente manera:
                       </p>
                       
                        <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Una cobertura m�xima vitalicia de $500,000 por p�liza, m�ximo 1 maternidad por a�o p�liza.
                           </li>
                           
                           <li style="margin-bottom: 5px;">Este beneficio s�lo se aplica como se describe en la cobertura de Maternidad de esta p�liza.
                            </li>
                            
                            <li style="margin-bottom: 5px;">Este beneficio no se aplica a las complicaciones relacionadas con cualquier condici�n excluida bajo el contrato de esta p�liza, incluyendo, pero no limitado a las complicaciones de la maternidad o del reci�n nacido durante el parto que surjan de un embarazo resultado de cualquier tipo de tratamiento de fertilidad o cualquier tipo de procedimiento de fertilidad asistida o embarazos que no est�n cubiertos.
                            </li>
                            <li style="margin-bottom: 5px;">Las complicaciones causadas por una enfermedad que se diagnostic� antes del embarazo, y / o cualquiera de sus consecuencias ser�n cubiertas bajo los t�rminos de esta p�liza.
                            </li>
                       
                 </ol>
                        
                
                 
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">15. Cobertura del reci�n nacido:</span></p>
                        <p>
                       I.	Si nace de una maternidad cubierta:
                       </p>
                       
                         <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Cobertura provisional: El reci�n nacido tendr� cobertura por cualquier lesi�n o enfermedad durante los primeros 90 d�as despu�s del nacimiento, hasta un m�ximo de $50,000 sin deducible.
                           </li>
                           
                           <li style="margin-bottom: 5px;">Para incluir a un reci�n nacido a la p�liza por favor, consulte la secci�n 6, Cl�usula 12.
                            </li>
  
                 </ol>
                       
                       <p>
                           II.	Si nace de una maternidad que no est� cubierta, el reci�n nacido no gozar� de la cobertura provisional. Para incluir al reci�n nacido a la p�liza, la solicitud debe ser presentada junto con el pago de la prima.  La solicitud estar� sujeta a evaluaci�n m�dica por la Compa��a.
                       </p>
                       
                       
                       
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">16. Vacunas</span></p>
                        <p>
                        Este beneficio se aplica a los hijos Dependientes, que han sido suscritos y aprobados por el Administrador como persona Asegurada. En ning�n caso la responsabilidad m�xima de la Compa��a superar� el m�ximo que se indica en la Tabla de Beneficios como Beneficios Elegibles durante un per�odo de cobertura. El beneficio incluye: vacunas para dependientes hasta 10 a�os de edad. Deducible se aplica. 

                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">17. Beneficios para cuidados de ni�o sano</span></p>
                           
                   <p>
                       Este beneficio se aplica a los hijos Dependientes, que han sido suscritos y aprobados por el Administrador como persona Asegurada. En ning�n caso la responsabilidad m�xima de la Compa��a superar� el m�ximo que se indica en la Tabla de Beneficios como Beneficios Elegibles durante un per�odo de cobertura. El beneficio incluye: la atenci�n y tratamiento necesario por defectos cong�nitos y anomal�as de nacimiento m�dicamente diagnosticados, y por prematuridad. Adem�s, incluye la cobertura de servicios preventivos y de atenci�n primaria, incluyendo los ex�menes f�sicos, 
                   </p>
                       
          
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 <p class="page_no">Page 22 of 52</p>
                <p>
                mediciones, detecci�n sensorial, evaluaci�n neuro-psiqui�trica, evaluaci�n del desarrollo, que incluir� para dependientes hasta 2 a�os de edad: 4 visitas por a�o con un m�ximo de $50 por visita sin deducible. Para dependientes mayores de 2 a�os de edad: 2 visitas por a�o con un m�ximo de $50 por visita sin deducible. Adicionalmente la cobertura de un m�ximo de 5 visitas al a�o por hijos dependientes menores de 19 a�os de edad. Deducible y coaseguro se aplica. Cualquier servicio preventivo y de atenci�n primaria aplicados, incluyen tambi�n, seg�n lo recomendado por el m�dico, detecci�n metab�lico y hereditario en el momento del nacimiento, vacunas, an�lisis de orina, pruebas de la tuberculina, y hematocrito, hemoglobina, y otros an�lisis de sangre, incluyendo pruebas para la detecci�n de hemoglobinopat�a.
                </p>
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">18. Beneficios Preventivos para Adultos</span></p>
                       <p>
                         La Compa��a pagar� los gastos, hasta los l�mites indicados en la Tabla de Beneficios, por los siguientes Beneficios Elegibles. En ning�n caso la responsabilidad m�xima de la Compa��a exceder� el m�ximo establecido en la Tabla de Beneficios, respecto a los Beneficios Elegibles, durante cualquier Periodo de Cobertura dado.
                        La Cobertura se limita a los siguientes gastos, sujetos a las Exclusiones listadas. Estos Beneficios Preventivos no est�n sujetos al Deducible o al Coaseguro. 

                       </p>
                       
                       <p>
                           Beneficios Preventivos Cubiertos incluyen:<br>
                          1. Ex�menes f�sicos rutinarios:

                       </p>
                       
                        <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Mujeres mayores de 18 a�os que hayan estado cubiertas por la P�liza por 12 meses consecutivos antes de recibir tratamiento.
                           </li>
                           
                           <li style="margin-bottom: 5px;">Hombres mayores de 18 a�os que hayan estado cubiertos por la P�liza por 12 meses consecutivos antes de recibir tratamiento.
                            </li>
                          
                 </ol>
                       <p>2. Ex�menes femeninos preventivos. Mujeres mayores de 18 a�os que hayan estado cubiertas por la P�liza por 12 meses consecutivos antes de recibir tratamiento.</p>
                       
                       <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Mamograf�a: <br>
                           <p style="padding-left: 10px; margin-bottom: 0;">i. Mamograf�a de base</p>
                           <p style="padding-left: 10px; margin-bottom: 0;">ii. Mamograf�a anual de rutina.</p>
                           </li>
                           
                           <li style="margin-bottom: 5px;">
                               Citolog�a:<br>
                           <p style="padding-left: 10px; margin-bottom: 5px;">i. Un examen citol�gico cervical para mujeres.</p>
                           </li>
                       </ol>
                        
                
                 
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">19.	Medicamentos con receta:</span></p>
                        <p>
                       <i>Ambulatorios:</i>
                       </p>
                       <p>
                           En el caso de las recetas de pacientes ambulatorios, los beneficios se limitan a los gastos ocasionados por medicamentos que:
                       </p>
                       
                         <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Requieran de una receta para ser dispensados;
                           </li>
                           
                           <li style="margin-bottom: 5px;">Deben ser dispensados por un m�dico o un farmac�utico con credenciales apropiadas y
                            </li>
                            <li style="margin-bottom: 5px;">Deben estar aprobados por la Administraci�n de Alimentos y Drogas de los Estados Unidos de Am�rica (United States Food and Drug Administration)</li>
  
                 </ol>
                       
                       <p>
                           Los medicamentos recetados de forma ambulatoria se pagar�n hasta $4,000 tanto en el pa�s como fuera del pa�s de residencia. Este beneficio est� sujeto a cualquier deducible aplicable y luego el plan cubrir� el 80 % de la m�xima indicada.
                       </p>
  
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
            <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 200px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 
      <p class="page_no">Page 23 of 52</p>
                  <p><i>Hospitalizaci�n:</i></p>
                  <p>Los medicamentos con receta que se prescriben por primera vez durante una hospitalizaci�n o despu�s de una cirug�a ambulatoria se cubrir�n hasta un m�ximo de $4,000 por asegurado por a�o p�liza, durante un per�odo m�ximo de 6 meses continuos. Este beneficio es v�lido fuera del pa�s de residencia.
                  </p>
                  <p>En todos los casos, el reclamo debe tener una copia de receta firmada y sellada por el m�dico.</p>
                  
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">20. Procedimientos Especiales</span></p>
                       <p>
                         Pr�tesis, aparatos ortop�dicos, equipo m�dico durable, los implantes, la di�lisis, radioterapia, quimioterapia y medicamentos altamente especializados ser�n cubiertos de acuerdo a los l�mites y subl�mites establecidos en la tabla de beneficios, pero deben ser aprobadas y coordinadas previamente por la Compa��a. Procedimientos especiales ser�n cubiertos por la Compa��a o reembolsados hasta el m�ximo que la Compa��a habr�a pagado si se hubiera comprado a uno de sus proveedores.

                       </p>

                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">21. Procedimientos de trasplante:</span></p>
                        <p>
                      Los Beneficios elegibles para gastos por trasplantes de �rganos y tejidos humanos se limitan a cantidades y procedimientos enumerados de la siguiente manera:
                       </p>
                       
                       <p>
                           � La decisi�n de un trasplante de �rgano o tejido humano de debe ser aprobada previamente por el administrador designado por la Compa��a.
                       </p>
                       <p>
                           � La cobertura de beneficios de trasplante de �rganos comienza a partir de la fecha en que fue determinada por un m�dico la necesidad de un trasplante de �rganos, ha sido certificada por una segunda opini�n m�dica o quir�rgica, y ha sido aprobado por la Compa��a. Est� sujeta a todos los t�rminos, los gastos cubiertos y exclusiones de la p�liza. El beneficio y los l�mites de Trasplante de �rganos incluyen la cobertura de la fecha en que se determin� la exigencia de un trasplante de �rgano, toda la atenci�n m�dica de proceder al trasplante, el trasplante real y todo el seguimiento de la asistencia m�dica despu�s del trasplante se incluyen en el beneficio y los l�mites, y est� sujeto a todos los t�rminos, los gastos y exclusiones de la p�liza en cuesti�n;
                       </p>
                       <p>
                           � Si se trata de un trasplante de �rgano �nico o m�ltiples trasplantes de �rganos, en ning�n caso la Compa��a paga m�s que el beneficio elegible m�ximo permitido de $750,000 de por vida.
                       </p>
                       <p>
                           A.Servicios de Trasplantes Cubiertos:
                       </p>
                       
                       <ul style="list-style-type: lower-roman; font-size:11px;">
                       
                       <li style="padding-left: 10px; margin-bottom:5px">Servicios cl�nicos de Hospitalizaci�n y Ambulatorios.</li>
                       <li style="padding-left: 10px; margin-bottom:5px">Servicios de un M�dico para diagn�stico, tratamiento y cirug�a para un Procedimiento de Trasplante Cubierto.</li>
                       <li style="padding-left: 10px; margin-bottom:5px">	Servicios de diagn�stico.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Obtenci�n de un �rgano o tejido, incluidos los servicios prestados a un donante vivo de un �rgano o tejido para la obtenci�n de un �rgano o tejido est� cubierto hasta un m�ximo de $50,000 vitalicio, incluido dentro del l�mite m�ximo de beneficio de Trasplante de �rgano. Los servicios prove�dos al donante vivo para obtener el �rgano o tejido estar�n limitados al costo de la obtenci�n del �rgano o tejido hasta el monto m�ximo descrito en la Secci�n �Montos M�ximos�</li>
                        
                        <li style="padding-left: 10px; margin-bottom:5px">Costos de traslado M�dicamente Necesario, por viajes relacionados con el Procedimiento de Trasplante Cubierto, para el receptor del Trasplante y un acompa�ante, durante un Per�odo de Beneficios. Los Beneficios Elegibles por Traslado est�n sujetos a las cantidades indicadas en la secci�n de Montos M�ximos.</li>
                            
                        </ul>
                             

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 0;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
     
            <div class="ol_list_con">
              <p class="page_no">Page 24 of 52</p>
                 <ul style="list-style-type: lower-roman; font-size:11px;" start="6">
                  <li style="padding-left: 10px; margin-bottom:5px">Si el receptor es un menor de edad, pueden estar cubiertos los costos de traslado de dos acompa�antes. Los Beneficios Elegibles por Traslado est�n sujetos a los montos indicados en la secci�n de Montos M�ximos.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Gastos razonables y necesarios de alojamiento y comidas incurridos por el receptor y su(s) acompa�ante(s), relacionados con el Procedimiento de Trasplante cubierto durante el Periodo de Beneficios. Los Beneficios Elegibles por alojamiento y comidas est�n sujetos a los montos indicados en la secci�n de M�ximos.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	El alquiler de equipo m�dico duradero para uso fuera del Hospital. Los Beneficios Elegibles est�n limitados al precio de compra del mismo equipo.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Medicamentos por receta, incluyendo medicamentos inmunosupresores</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Ox�geno.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Terapia del Habla, Terapia Ocupacional, Terapia F�sica y Quimioterapia.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Vendas e implementos quir�rgicos.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Servicios y suministros por Quimioterapia de Alta Dosis o relacionados con ella y por Trasplante de Tejido de M�dula �sea, cuando se suministren como parte de un plan de Tratamiento que incluya Trasplante de M�dula �sea y Quimioterapia de Altas Dosis</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Cuidado de salud a domicilio.</li>
                 
                 </ul>
      
                
                  <p>B.	Montos M�ximos por Trasplantes en Centros de Trasplantes que no est�n en la Red de son el menor del 80% de los cargos elegibles facturados o el 80% del monto indicado a continuaci�n:
                  </p>
                  <div>
                      <table style="margin: auto; border-collapse: collapse; width: 60%;">
                          <tr>
                              <td style="border-bottom: 1px solid #000; padding-right: 50px;">Procedimiento de Trasplante Cubierto 	</td>
                              <td style="border-bottom: 1px solid #000; padding-right: 0px;">Dentro de EE. UU</td>
                          </tr>
                          
                          <tr>
                              <td>Medula �sea Autologa incluyendo <br> Quimioterapia de Alta dosis </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>M�dula �sea Alog�nica incluyendo <br> Quimioterapia de Alta dosis 	</td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Quimioterapia de Alta dosis </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Quimioterapia de Alta dosis </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Coraz�n </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Coraz�n/Pulm�n </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Pulm�n</td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>H�gado </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>P�ncreas </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Ri��n y P�ncreas </td>
                              <td>$100.000</td>
                          </tr>
             
                      </table>
                  </div>
                  
             
                       <p>
                       C.	Transporte/alojamiento/comidas: Un m�ximo de $200 por d�a, para alojamiento y comidas, por Procedimiento de Trasplante Cubierto. $10,000 por todos los gastos de transporte, alojamiento y comidas, por Procedimiento de Trasplante Cubierto. Los recibos, detallados a satisfacci�n de la Compa��a, deben ser sometidos por la Persona Asegurada cuando complete los formularios de Reclamo.

                       </p>

                       
                        <p>
                    D.	Obtenci�n del �rgano: Los pagos de la Compa��a por los gastos de Obtenci�n, para un donante de �rgano o Tejido, no exceder�n las siguientes cantidades m�ximas, por cada Procedimiento de Trasplante Cubierto:
                       </p>
                       
                <div>
                      <table style="margin: auto; border-collapse: collapse; width: 60%;">
                          <tr>
                              <td style="border-bottom: 1px solid #000;  padding-right: 50px;">Procedimiento</td>
                              <td style="border-bottom: 1px solid #000;  padding-right: 0px;">Monto M�ximo</td>
                          </tr>
                          
                          <tr>
                              <td>BMT Alog�nico </td>
                              <td>$50.000</td>
                          </tr>
                          
                          <tr>
                              <td>Coraz�n 	</td>
                              <td>$50.000</td>
                          </tr>
                          
                          <tr>
                              <td>Coraz�n/Pulm�n </td>
                              <td>$50.000</td>
                          </tr>
                          
                    </table>     
                        
                 </div>        

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 200px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
               <p class="page_no">Page 25 of 52</p>
                <div>
                    <table style="margin: auto; border-collapse: collapse; width: 60%;">
                        <tr>
                              <td>Pulm�n  </td>
                              <td>$45.000</td>
                          </tr>
                          
                          <tr>
                              <td>H�gado 	 </td>
                              <td>$45.000</td>
                          </tr>
                          
                          <tr>
                              <td>P�ncreas  </td>
                              <td>$45.000</td>
                          </tr>
                          
                          <tr>
                              <td>Ri��n/P�ncreas </td>
                              <td>$45.000</td>
                          </tr>
       
                      </table>
                  </div>
                     <p>
                         a)	Cuidado antes del trasplante, que incluye todos los servicios directamente relacionados con la evaluaci�n de la necesidad del trasplante, evaluaci�n del asegurado para el procedimiento de trasplante, y preparaci�n y estabilizaci�n del asegurado para el procedimiento de trasplante.
                     </p>
                     <p>
                         b)	El cuidado post-operatorio, incluyendo pero no limitado a cualquier tratamiento de seguimiento m�dicamente necesario despu�s del trasplante y cualquier complicaci�n que surja despu�s del procedimiento de trasplante, ya sea consecuencia directa o indirecta de los mismos.
                     </p>
                      <p>
                          c) Cualquier f�rmaco o medidas terap�uticas que se utilizan para asegurar la viabilidad y la retenci�n del �rgano, c�lula o tejido humano.
                      </p>
            
            
            
                    <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 22.	S�ndrome de Inmunodeficiencia Adquirida (SIDA): </span></p>
                       <p>
                        Los gastos incurridos Cuando el S�ndrome de Inmunodeficiencia Adquirida (SIDA ) se ha manifestado cl�nicamente , incluyendo los costos de diagn�stico para el virus, despu�s que el asegurado haya estado continuamente cubierto para cuatro (4 ) a�os en la pol�tica , siempre que los anticuerpos del VIH (VIH) o el virus del SIDA no se hab�a detectado o no se hab�an manifestado durante o antes del periodo de cobertura y el tratamiento se lleva a cabo en el pa�s de residencia. El beneficio m�ximo de por vida por Asegurado elegible para esta cobertura es de $20,000.
                       </p>
                      
                      <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 23.	Atenci�n Medica en el hogar</span></p>
                       <p>
                        Los Beneficios Elegibles son aplicables por un per�odo inicial de 30 d�as, siempre y cuando sea aprobado previamente por la Compa��a. Cualquier extensi�n en incrementos de hasta 30 d�as deber� ser aprobado con antelaci�n, o la reclamaci�n ser� denegada. <br> <br>
                        Para cada aprobaci�n se requiere que el Asegurado presente el plan de tratamiento actualizado y evidenciar que el tratamiento es m�dicamente necesario. El beneficio m�ximo es el 100% hasta $10,000 por a�o p�liza.

                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 24.	Hospicio / Paliativo / Cuidado Terminal</span></p>
                       <p>
                       Los Beneficios Elegibles son aplicables por un per�odo inicial de 30 d�as, siempre y cuando exista la aprobaci�n de la Compa��a con antelaci�n. Cualquier extensi�n en incrementos de hasta 30 d�as deber� ser aprobado por adelantado o la reclamaci�n ser� denegada. <br> <br>
                    Para cada aprobaci�n se requiere el Asegurado que presente el tratamiento actualizada. El beneficio m�ximo es de 100% hasta $10.000 por a�o p�liza.


                       </p>
                       
                          <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 25.	Segunda opini�n m�dica</span></p>
                       <p>
                       Las segundas y terceras opiniones medicas est�n cubiertas bajo los siguientes criterios:

                       </p>
                       <p>a. las segundas opiniones se cubren si la opini�n se proporciona a petici�n del Asegurado para determinar la prudencia de proceder a una cirug�a o un procedimiento de diagn�stico o terap�utico no quir�rgico de importancia.
                       </p>
                       
                      
       
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
             <p class="page_no">Page 26 of 52</p>
            
             <p>b. las terceras opiniones se cubren si las recomendaciones del primer y segundo m�dico difieren en cuanto a la necesidad de cirug�a u otro procedimiento importante.</p>
                       <p>
                           c. las opiniones segunda o tercera pueden incluir, pero no se limitan a: 1) una historia y un examen f�sico del Asegurado 2) cualquier prueba diagn�stica requerida para determinar la necesidad de cirug�a o un procedimiento.
                       </p>
                        <p>
                            Una vez que se proporcione la segunda opini�n, independientemente de d�nde se haya realizado, todas las pruebas diagn�sticas, el tratamiento y/o la intervenci�n quir�rgica deben cumplir la elegibilidad en virtud del contrato de p�liza para aplicar a cobertura.
                        </p>
                        <p>
                            No hay cobertura para el proveedor o para los cargos de hospitalizaci�n si la cirug�a o procedimiento propuesto no est� cubierto por el contrato de p�liza.
                        </p>
     
                   
                   
                    <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">26.	Medicina Alternativa</span></p>
                       <p>
                    Los Beneficios Elegibles para un m�dico de medicina alternativa, homeop�tico, acupuntura o quiropr�ctico. M�ximo de 12 visitas por a�o p�liza y un m�ximo de $150 por visita.



                       </p>
                       
                        <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 27.	Eliminaci�n del Per�odo de Espera</span></p>
                       <p>
                      La Compa��a considerar� eliminar el per�odo s�lo si:

                       </p>
                       
                       <ol style="font-size: 11px;">
                           <li style="margin-bottom: 5px;">El asegurado tuvo cobertura continua bajo un seguro de salud de otra compa��a durante por lo menos un (1) a�o con otro Plan de Salud Internacional y</li>
                           <li style="margin-bottom: 5px;">	La fecha de vigencia de la p�liza est� dentro de los sesenta (60) d�as despu�s que haya expirado la cobertura anterior, y</li>
                           <li style="margin-bottom: 5px;">	El Asegurado ha informado de la cobertura anterior en la solicitud de seguro, y</li>
                           <li style="margin-bottom: 5px;">	La Compa��a recibe copia del certificado la p�liza anterior y copia del recibo de la prima pagada el a�o anterior, junto con la solicitud de seguro.</li>
                       </ol>
        
                       
                <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 28.	Cambio de plan:</span></p>
                       <p>
                      El Asegurado principal puede solicitar un cambio de plan o incremento/reducci�n de deducible hasta 90 d�as antes de la fecha de renovaci�n de la p�liza. Esto debe ser notificado por escrito con una solicitud debidamente firmada y completada para todos los miembros de la familia,  y debe ser recibido antes de la fecha de aniversario. Todas las solicitudes de cambio de plan y/o deducible est�n sujetas a evaluaci�n de riesgo. No hay ninguna garant�a de aprobaci�n para las solicitudes en proceso de suscripci�n para cambio de plan y/o deducible.

                       </p>
                       <p>
                           Dentro de los 90 d�as siguientes a la fecha efectiva del cambio, los beneficios pagaderos por cualquier enfermedad o lesi�n no causada por un accidente o enfermedad de origen infeccioso, est�n limitados al menor de los beneficios bajo el nuevo plan o el plan anterior.
                       </p>
                       <p>
                           Durante los doce (12) meses a doce siguientes a la fecha efectiva del cambio, los beneficios de maternidad, reci�n nacido, alteraciones cong�nitas y el trasplante estar�n limitados al menor de los beneficios bajo el nuevo plan o el plan anterior.
                       </p>
                       
                       
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 29.	Cambio de pa�s de residencia:</span></p>
                       <p>
                      El Asegurado principal deber� notificar por escrito a la Compa��a de cualquier cambio en su pa�s de residencia, incluyendo la de cualquier Asegurado en la p�liza dentro de los primeros treinta (30) d�as del cambio. La Compa��a se

                       </p>
                       
                       
                
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 27 of 52</p>
            
                    <p>
                     reserva el derecho a modificar o cancelar la cobertura de la p�liza al cambiar el pa�s de residencia de cualquier Asegurado.
                    </p>
            
                        <p>
                           La falta de notificaci�n a la Compa��a cualquier cambio de pa�s de residencia del asegurado le da el derecho a La Compa��a a rescindir la p�liza a partir de la fecha en que se debe haber dado el aviso.
                       </p>
                       
                       <p>
                           El asegurado no puede residir o trabajar en forma permanente o temporal en los Estados Unidos de Norteam�rica (incluyendo Puerto Rico) y Canad�. El asegurado debe tener residencia legal y la residencia por lo menos tres (3) meses del a�o fuera de los Estados Unidos de Norteam�rica (incluyendo Puerto Rico) y Canad�.
                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">   30.	Moneda y tipo de cambio</span></p>
                       <p>
                           Este seguro se puede contratar en la moneda de curso legal de los Estados Unidos de Am�rica, que es el d�lar. Los pagos a realizar en virtud de esta p�liza se har�n en d�lares de Estados Unidos. Cualquier factura elegible presentada en moneda diferente a d�lares, ser� pagada utilizando el promedio de la tasa de cambio en vigor durante el mes en que los servicios fueron prestados o los suministros fueron adquiridos.
                       </p>
                     
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 31.	Ex�menes f�sicos</span></p>
                       <p>
                           Durante el proceso de una reclamaci�n, la Compa��a se reserva el derecho de solicitar ex�menes m�dicos de cualquier Asegurado cuya enfermedad o lesi�n es la base de la reclamaci�n, cuando y cuantas veces lo considere necesario. Los gastos ser�n cubiertos por la Compa��a.
                       </p>
            
            
        
                 
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCI�N 3: DISPOSICIONES DEL SEGURO</h3>     
                  
                <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">A. Requisitos de Elegibilidad</span></p>
                      
                       <p>
                     Solicitud: La solicitud no puede ser firmada dentro de los Estados Unidos, sus territorios o Canad�. Cualquier solicitud firmada, mientras que el solicitante se encuentra en los Estados Unidos, sus territorios o Canad� ser� considerada nula y sin efecto.

                       </p>
                       <p>
                         Para todos los Solicitantes / Personas Aseguradas: Las Personas Aseguradas Principal y los Dependientes nombrados deben tener al menos 14 d�as de edad y no haber llegado a su cumplea�os n�mero 79. Los Dependientes son el c�nyuge del Asegurado Principal y los hijos solteros naturales o adoptados legalmente de m�s de 14 d�as de edad y menos de 19 a�os de edad, y no mayores de 23 a�os de edad si est�n matriculados como Estudiantes de Tiempo Completo en una universidad o colegio universitario reconocidos y no est�n empleados a tiempo completo.
                       </p>
                       <p>
                           Para Ciudadanos de los Estados Unidos: Los Solicitantes / Personas Aseguradas deben estar fuera de los Estados Unidos o Canad� al momento de la Solicitud / Renovaci�n. Aplicar para este seguro mientras en los Estados Unidos o Canad� y o renovar este seguro mientras que este en los Estados Unidos o Canad� ser� causa para la cancelaci�n de la p�liza a partir de la fecha de la aplicaci�n original y/o de la renovaci�n, y todas las primas ser�n reembolsadas. Adem�s, la Persona Asegurada debe residir fuera de los Estados Unidos o Canad� al menos durante 9 de los 12 meses del Periodo de Vigencia de la P�liza para cumplir los Requisitos de Elegibilidad de una Persona Asegurada. Si una Persona Asegurada reside en los Estados Unidos o Canad� m�s de 9 de los 12 meses del Periodo de Vigencia de la P�liza su cobertura ser� inmediatamente anulada de manera retroactiva, desde la fecha en que los Requisitos de Elegibilidad dejaron de cumplirse, sin importar el motivo. El periodo de 3 meses se calcula de dos maneras: Asegurado no puede permanecer 3 meses consecutivos o 3 meses acumulados en los Estados Unidos. El 
                       </p>
                       
                      
                       
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 28 of 52</p>
             <p>
                           Administrador reembolsar� la prima, si hubiese alguna, prorrateada a la fecha en que los Requisitos de Elegibilidad fueron incumplidos. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad ser� negado.
                       </p>
                       <p>
                           Para Ciudadanos No-estadounidenses: Los Solicitantes / Personas Aseguradas deben estar fuera de los Estados Unidos o Canad� al momento de la Solicitud / Renovaci�n. Aplicar para este seguro mientras en los Estados Unidos o Canad� y o renovar este seguro mientras que este en los Estados Unidos o Canad� ser� causa para la cancelaci�n de la p�liza a partir de la fecha de la aplicaci�n original y/o de la renovaci�n, y todas las primas ser�n reembolsadas. Adem�s, la Persona Asegurada debe residir fuera de los Estados Unidos o Canad� al menos durante 9 de los 12 meses del Periodo de Vigencia de la P�liza para cumplir los Requisitos de Elegibilidad de una Persona Asegurada. Si una Persona Asegurada reside en los Estados Unidos o Canad� m�s de 9 de los 12 meses del Periodo de Vigencia de la P�liza su cobertura ser� inmediatamente anulada de manera retroactiva, desde la fecha en que los Requisitos de Elegibilidad dejaron de cumplirse, sin importar el motivo. El periodo de 3 meses se calcula de dos maneras: Asegurado no puede permanecer 3 meses consecutivos o 3 meses acumulados en los Estados Unidos. El Administrador reembolsar� la prima, si hubiese alguna, prorrateada a la fecha en que los Requisitos de Elegibilidad fueron incumplidos. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad ser� negado.
                       </p>
                       <p>
                           Para Estudiantes en Estados Unidos: Los Solicitantes/ Asegurados deben estar fuera de los Estados Unidos o Canad�, en el momento de la solicitud y la renovaci�n. Se puede agregar Cobertura de Estudiante en Estados Unidos por una prima adicional anual para un hijo dependiente. Esta cobertura permite al Dependiente residir continuamente en los Estados Unidos por un m�ximo de 4 a�os si est� inscrito como estudiante de tiempo completo en una escuela o colegio acreditado y no es empleado a tiempo completo. Se debe enviar comprobante de estudiante en el momento de la solicitud y la renovaci�n anual. El deducible de la p�liza aplica para todos los servicios recibidos en Estados Unidos para el Estudiante Dependiente. El Administrador reembolsar� la prima, si hubiese alguna, prorrateada a la fecha en que los Requisitos de Elegibilidad fueron incumplidos. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad ser� negado.


                       </p>
                       <p>
                           Es responsabilidad de la Persona Asegurada conservar todos los registros, y proporcionarlos al Administrador a solicitud de este para todos los Requisitos de Elegibilidad, incluyendo, pero sin limitarse a estatus de residencia, historial de viajes, copia de todas las p�ginas del pasaporte, formulario de Homeland Security, formularios autorizando liberar historiales de siniestros de seguros, estatus estudiantil, as� como participar al Administrador toda la informaci�n relevante que hubiese cambiado, en la fecha en que el cambio ocurriese, y proporcionar cualquier documento al Administrador, quien verificar�a los Requisitos de Elegibilidad. Si el asegurado en cualquier momento incumple los Requisitos de Elegibilidad, y no participa al Administrador sobre tales importantes cambios, entonces la p�liza ser� cancelada con car�cter retroactivo a la fecha del incumplimiento de los Requisitos de Elegibilidad. El Administrador reembolsar� la prima, si la hubiere, prorrateada a la fecha del incumplimiento de los Requisitos de Elegibilidad. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad ser� negado. La omisi�n en la entrega de documentos con los requisitos de elegibilidad, dentro de los 30 d�as contados desde la fecha en que fuesen solicitados por el Administrador, resultar� en la cancelaci�n autom�tica de la p�liza y negaci�n de cualquier reclamo.


                       </p>
 
                <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">B.	Fecha Efectiva Individual de Cobertura</span></p>
                      
                       <p>
                    Luego de la evaluaci�n y Aprobaci�n de cada Solicitante por el Administrador, la Cobertura comenzar� a ser efectiva en la �ltima de las siguientes fechas: (1) La fecha en la cual la Prima correcta y la Solicitud sean recibidas por el Administrador, o (2) La fecha en la que el Solicitante sea Aprobado por el Administrador.

                       </p>
                       
                      
                       
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 29 of 52</p>
            
             <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">C. Fecha de Terminaci�n Individual de la Cobertura</span></p>
                   
                       <p>
                        La Cobertura terminar� en la m�s temprana de las fechas siguientes: (1) La fecha hasta la cual la Prima ha sido pagada; (2) la fecha en que la Persona Asegurada deje de cumplir con los Requisitos de Elegibilidad descritos en la SECCION 3, A; (3) la fecha en que la Compa��a cancele la Cobertura para una Clase espec�fica de Personas Aseguradas, y en la cual la Persona Asegurada individual pueda estar incluida.

                       </p>
                       
                       
                        <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">D. Comienzo de los Beneficios</span></p>   
                       <p>
                           <b>No se pagar� ning�n Beneficio por gastos de cualquier condici�n m�dica o s�ntoma que se manifieste dentro de los primeros 90 d�as desde la Fecha Efectiva Individual de la P�liza, ni complicaciones futuras y/o gastos futuros derivados de ella o relacionados de ella, con la excepci�n de condiciones m�dicas causadas por Accidentes y/o Enfermedades infectocontagiosas.</b> La Compa��a puede elegir exonerar esta disposici�n si una P�liza internacional de salud hubiese estado vigente con otra Compa��a aseguradora durante los doce (12) meses consecutivos previos a Fecha Efectiva de la presente P�liza. La cl�usula de Exoneraci�n del Comienzo de los Beneficios est� sujeta a la recepci�n de una copia del Certificado de Cobertura, Tabla de Beneficios y fechas de Cobertura de la Compa��a aseguradora anterior, solo al momento de la Solicitud, con un anexo de exoneraci�n del tiempo de espera de 90 d�as cual ser� emitido simult�neamente con la p�liza. El tener una p�liza m�dica internacional vigente al momento de la Solicitud no garantiza la exoneraci�n de esta cl�usula. La solicitud de periodo de espera no se aplica a la maternidad y beneficios de cuidados de rutina.
                       </p>
                       
                       
                       
                       
                       
                        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCI�N 4: ALCANCE DE LA COBERTURA</h3>     
                       
                         <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">A. Descripci�n de la Cobertura</span></p>   
                       
                    
                       <p>
                          Los Gastos Cubiertos derivados de reclamos v�lidos ser�n pagados de acuerdo con los Beneficios Elegibles.
                       </p>
                       
                       <p>
                          Los Beneficios Elegibles ser�n pagaderos, al proveedor de servicio, o si no es posible a la Persona Asegurada por los Beneficios Elegibles incurridos por la Persona Asegurada en cualquier parte del mundo. <b>Para las admisiones Hospitalarias, sea en pa�s de residencia, Estados Unidos o a nivel mundial, deber� utilizarse el programa de pre-notificaci�n. Si no se utiliza el programa de Pre-notificaci�n, resultar� en un coaseguro de 50% de los Beneficios Elegibles detallados en la Tabla de beneficios.</b> 
                       </p>
                       <p>
                           Los cargos que aqu� se mencionan no incluir�n en ning�n caso cantidad alguna que exceda los cargos Razonables y Acostumbrados. Un gasto hecho por un Persona Asegurada se considerar� como Razonable y Acostumbrado, por concepto de los servicios y suministros recibidos a cambio, si no excede el cargo promedio por dichos servicios y suministros en la localidad donde fueron recibidos, considerando la naturaleza y severidad de la Lesi�n f�sica o Enfermedad en conexi�n con la cual tales servicios y suministros fueron recibidos. Si el cargo sobrepasa dicho monto promedio, el excedente no ser� reconocido como Gasto Cubierto. Todos los cargos ser�n considerados como incurridos en la fecha de tales servicios y suministros, los cuales hubiesen dado lugar al gasto cargado, prestado u obtenido.


                       </p>
                       
                         <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">B. Beneficios M�dicos</span></p> 
                       <p>
                           La Compa��a pagar� los Beneficios Elegibles hasta los l�mites indicado en la Tabla de Beneficios. La Cobertura est� limitada a los Beneficios Elegibles incurridos, sujetos a las Exclusiones, Limitaciones y Disposiciones de esta P�liza. Todos los trastornos f�sicos simult�neos, debidos a una misma causa, o relacionados con ella, ser�n considerados 

                       </p>
                       
              
           
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 30 of 52</p>
            <p>
                como un Evento Cubierto. Si un Evento Cubierto se debe a la misma causa de un Evento Cubierto anterior, o est� relacionado con ella (incluyendo las complicaciones resultado de esta), el Evento Cubierto se considerar� una continuaci�n del Evento Cubierto anterior y no uno independiente.
            
            </p>
            
                    <p>
                           Cuando la Persona Asegurada incurra en un gasto cubierto, la Compa��a pagar� los gastos m�dicos Razonables y Acostumbrados, en exceso del Deducible y Coaseguro, como se estipula en la Tabla de Beneficios. En ning�n caso la responsabilidad m�xima de la Compa��a exceder� el m�ximo establecido en la Tabla de Beneficios.
                            A efectos de esta secci�n, s�lo aquellos gastos, en los que se incurra como resultado de un Evento Cubierto, los cuales est�n espec�ficamente enumerados en la siguiente lista, y que no figuren en las Exclusiones, ser�n considerados como Beneficios Elegibles.

                       </p>
            
            <ol style="font-size: 11px;">
               <li style="margin-bottom: 5px;">	Cargos de un Hospital, por habitaci�n, comida, enfermeras en piso durante la Hospitalizaci�n, y otros servicios, inclusive cargos por servicios profesionales, con la excepci�n de servicios personales de naturaleza no m�dica, siempre y cuando esos gastos no excedan el cargo promedio del Hospital por ocupaci�n con habitaci�n privada y comida.
               </li>
               
               
               <li style="margin-bottom: 5px;">
                  Cargos por Cuidados Intensivos o Card�acos y servicios de enfermer�a por Hospitalizaci�n. 
               </li>
               <li style="margin-bottom: 5px;">Cargos por concepto de diagn�stico, Tratamiento o Cirug�a por parte de un M�dico. Los cargos por un segundo cirujano se pagar�n hasta un m�ximo del 30% de los honorarios del cirujano primario. Los cargos por un tercer o sucesivo cirujano no ser�n un beneficio m�dico elegible.</li>
               <li style="margin-bottom: 5px;">Cargos por el uso de la sala de operaciones.</li>
               <li style="margin-bottom: 5px;">Cargos por Tratamiento ambulatorio, al igual que por cualquier otro Tratamiento Cubierto durante una Hospitalizaci�n. Estos incluyen centros de Cirug�a ambulatorios, visitas o ex�menes m�dicos, cuidado cl�nico y consultas de opini�n sobre Cirug�a. </li>
               <li style="margin-bottom: 5px;">Cargos por el costo y administraci�n de anestesia. Los cargos por el anestesi�logo se pagar�n hasta un m�ximo del 30% de los honorarios de los cirujanos.</li>
               <li style="margin-bottom: 5px;">Cargos por Medicamentos, servicios de rayos x, ex�menes y servicios de laboratorio, uso de radio e is�topos radiactivos, quimioterapia, ox�geno, sangre, transfusiones y respiradores.</li>
               <li style="margin-bottom: 5px;">Cargos por fisioterapia, si es recomendada por un M�dico para el Tratamiento de un Siniestro Cubierto espec�fico, y es administrado por un fisioterapeuta licenciado.</li>
               <li style="margin-bottom: 5px;">Pago por Habitaci�n en un hotel, cuando la persona asegurada estar�a de otra manera confinada en un hospital, ser� bajo el cuidado de un m�dico debidamente calificado en una habitaci�n de hotel debido a la falta de disponibilidad de una sala de hospital por razones de capacidad, distancia o por cualquier otra circunstancia fuera del control de la persona asegurada.</li>
               <li style="margin-bottom: 5px;">Vendajes, medicamentos y medicinas que puedan ser obtenidas solamente por medio de una prescripci�n escrita del M�dico o Cirujano.</li>
               <li style="margin-bottom: 5px;">Transporte local, al Hospital m�s cercano, o a la Cl�nica m�s cercana con las instalaciones para el Tratamiento requerido. Dicho transporte debe ser realizado s�lo por una ambulancia terrestre autorizada, dentro del �rea metropolitana donde la Persona Asegurada se encuentre en el momento en que se haga uso del servicio. Si la Persona Asegurada se encuentra en un �rea rural, el transporte en una ambulancia terrestre autorizada hasta el �rea metropolitana m�s cercana, ser� considerado un Gasto Cubierto.</li>
               <li>Las condiciones m�dicas agudas est�n cubiertas de acuerdo con la Tabla de beneficios.</li>
                
            </ol>
            
               <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">C.	Beneficios de Embarazo</span></p> 
                       <p>
                           Cuando una persona asegurada, quien no es un hijo dependiente, queda en estado de embarazo y el mismo est� cubierto bajo los beneficios de la P�liza, la Compa��a pagar� razonables y habituales gastos m�dicos, en exceso de los deducibles y coaseguros como se indica en la Tabla de Beneficios. Los gastos por Embarazo incurridos durante los primeros 12 meses del Per�odo de Cobertura no se consideran Beneficios Elegibles. En ning�n caso la 

                       </p>
          
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 31 of 52</p>
                <p>
                           responsabilidad m�xima de la Compa��a superar� el m�ximo que se indica en la Tabla de Beneficios, como Beneficios Elegibles durante un embarazo. 
                       </p>
                         <p>
                             La persona asegurada o su representante deber� notificar previamente al Administrador de un embarazo dentro de los primeros ciento ochenta (180) d�as del Embarazo.
                         </p>
                         <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                 FALTA DE PRE-NOTIFICAR AL ADMINISTRADOR DE UN EMBARAZO DENTRO DE LOS PRIMEROS 180 D�AS, RESULTAR� EN UNA REDUCCI�N DEL 50% DE LOS BENEFICIOS ELEGIBLES ESTABLECIDO EN LA SECCI�N 2.B DE LA TABLA DE BENEFICIOS. ADEM�S, EL PROGRAMA DE PRE-NOTIFICACI�N DEBE SEGUIR LO ENUNCIADOEN EL PUNTO 4 K. PROGRAMA DE PRE-NOTIFICACI�N.
                             </span>
                         </p>
                         
                         <p>
                           Los beneficios ser�n pagables para los Beneficios Elegibles incurridos antes, durante y despu�s del parto de un ni�o, incluyendo el m�dico, hospital, laboratorio, y servicios de ultrasonido. Para la cobertura de Hospitalizaci�n posparto para la persona asegurada y su hijo reci�n nacido en un Hospital, como m�nimo ser� por duraci�n de la estancia recomendada por la Academia Americana de Pediatr�a y el Colegio Americano de Obstetras y Ginec�logos en sus directrices para Cuidado Prenatal, pero no superior a un m�ximo de 31 d�as.
                         </p>
                         
                         <p>
                             La cobertura de una duraci�n de estancia m�s corta que el per�odo m�nimo mencionado anteriormente puede ser permitida si el M�dico de la persona asegurada determina que los cuidados de hospitalizaci�n por posparto no son necesarios para la persona asegurada o su hijo reci�n nacido siempre que conste como sigue:
                         </p>
                         
                         <ol style="font-size: 12px;">
                             
                             <li>
                                	En opini�n del M�dico de la persona asegurada, el reci�n nacido cumple con los criterios de estabilidad m�dica en la gu�a para cuidados prenatales, preparado por la Academia de Pediatr�a y el Colegio Americano de Obstetras y Ginec�logos que determinan la duraci�n apropiada de la estancia sobre la base de la evaluaci�n de: (a) transcurso del ante parto, intraparto, posparto de la madre y el ni�o, (b) la etapa gestacional, peso al nacer, y la condici�n cl�nica del ni�o, (c) la capacidad demostrada por la madre para cuidar al ni�o una vez dada de alta, y (d) la disponibilidad de seguimiento despu�s del alta para verificar el estado del ni�o despu�s del alta, y
                             </li>
                             
                             <li>
                                 Se provee a la persona Asegurada una (1) visita en casa por cuidados despu�s del parto por un m�dico o enfermera. Dicha visita ser� realizada no m�s de cuarenta y ocho (48) horas despu�s del alta de la persona Asegurada y su hijo reci�n nacido del Hospital. La cobertura de esta visita incluye, pero no se limita a: (a) la educaci�n de los padres, (b) asistencia en entrenamiento para alimentaci�n por el seno materno o por el biber�n, y (c) la ejecuci�n de cualquier prueba de rutina materna o neonatal realizado durante el curso normal de atenci�n hospitalaria para la persona asegurada o del ni�o reci�n nacido, incluida la recolecci�n de una muestra adecuada para los an�lisis metab�licos y hereditarios del reci�n nacido. A discreci�n de la persona asegurada, esta visita puede ocurrir en el consultorio del m�dico.
                             </li>
                             
                         </ol>
                         
                         <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">D.	Beneficio Dental</span></p>
                         <p>
                             Cuando los gastos dentales cubiertos son incurridos por el Asegurado, la Compa��a pagar� los gastos razonables y habituales en exceso del Deducible como se indica en la Tabla de Beneficios. En ning�n caso la responsabilidad m�xima de la Compa��a superara el m�ximo que se indica en la Tabla de Beneficios, como Beneficios Elegibles durante cualquier per�odo de cobertura.

                         </p>
            
    
                      
                       
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 32 of 52</p>
                    <p>
                         A los efectos de esta secci�n, s�lo los gastos incurridos como resultado de una condici�n elegible Odontol�gica, en el cual los servicios o medicamentos que se prescriben, realizado, u ordenado por un dentista y se enumeran a continuaci�n, y que no figuran en las exclusiones, ser�n considerados como Beneficios Elegibles.
                       </p>
                       
                       <ol style="list-style-type: lower-roman; font-size: 11px;">
                           <li>Una condici�n dental elegible se refiere a una emergencia de reparaci�n o sustituci�n de dientes naturales, los dientes naturales da�ados como resultado de un accidente cubierto.</li>
                           <li>El tratamiento debe ser completado dentro de los 3 meses siguientes del accidente.</li>
                       </ol>
                       
                       <p>No se pagar�n beneficios bajo esta cobertura dental por cargos de Ortodoncista, Soportes de Ortodoncia (Brackets), Invisalign o Retenedores.
                       </p>
                     
                         <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                E.	Beneficio por Evacuaci�n / Repatriaci�n M�dica de Emergencia
                             </span>
                         </p>
                         
                         <p>
                          La Compa��a pagara los Beneficios Elegibles incurridos hasta el m�ximo indicado en la Tabla de Beneficios, en caso de cualquier enfermedad o lesi�n cubierta que comience durante el Periodo de cobertura de la persona asegurada resulta una emergencia m�dicamente necesaria de evacuaci�n m�dica de emergencia o la repatriaci�n de la persona asegurada. La decisi�n de una evacuaci�n m�dica de emergencia o la repatriaci�n debe ser ordenada por el Administrador de la Compa��a en consulta con el m�dico tratante de la persona asegurada.
                         </p>
                         
                         <p>
                           Evacuaci�n m�dica de emergencia o de repatriaci�n se entiende: a) la condici�n m�dica de la persona asegurada requiere transporte inmediato desde el lugar donde la persona Asegurada est� enferma o herida, hacia al centro m�dico adecuado m�s cercano, donde el tratamiento m�dico se pueden obtener, o b) despu�s de haber sido tratado a nivel local en un centro m�dico como consecuencia de una evacuaci�n m�dica de emergencia, la condici�n m�dica de la persona asegurada es tal que necesita transportaci�n con un m�dico calificado a su actual pa�s de origen para obtener tratamiento m�dico o para recuperarse, o ambos a) y b).
                         </p>
                         
                        <p>
                            A los efectos de esta secci�n, s�lo esos gastos, incurridos como resultado de un evento cubierto, que est�n espec�ficamente enumerados en la siguiente lista, y que no figuren en las exclusiones, se considerar�n como Beneficios Elegibles:
                        </p>
                         
                       <ol style="font-size: 12px;">
                           <li>	Los Beneficios Elegibles son los gastos hasta el m�ximo indicado en la Tabla de Beneficios para el transporte, los servicios m�dicos y suministros m�dicos necesarios efectuados en el marco de una evacuaci�n m�dica de emergencia o repatriaci�n del asegurado. Todos los arreglos de transporte deben ser por la ruta m�s directa y econ�mica.</li>
                           <li>	Los gastos de transporte especial, suministros m�dicos y servicios deben ser: (a) pre-aprobados y ordenados por el Administrador designado por la Compa��a y (b) el requerido por las regulaciones normales de transporte de la persona asegurada. Medios de transporte se refiere ya sea por tierra, agua o aire necesario para el transporte de la persona asegurada. Transporte especial incluye, pero no se limita a, ambulancias terrestres y a�reas, las l�neas a�reas comerciales, privadas y los veh�culos de motor.</li>
                           <li>	Todos los medios de transporte en conexi�n de una evacuaci�n m�dica de emergencia o repatriaci�n deben ser pre-aprobada y organizada por un Administrador designado por la Compa��a.</li>
                           <li> La decisi�n de que hospital y a qu� ciudad o pa�s transportar al Asegurado es completamente la decisi�n del Administrador o el representante designado por el Administrador de la Compa��a.</li>
                       </ol>
              
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 33 of 52</p>
                        <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                              F.	Beneficio por Repatriaci�n de Restos Mortales
                             </span>
                         </p>
                         
                         <p>
                         El Beneficio por Repatriaci�n de Restos Mortales se aplicar� solamente cuando la Persona Asegurada se encuentre viajando fuera de su Pa�s de Residencia actual. La Compa��a pagar� beneficios por los Beneficios Elegibles en los que se incurra hasta el m�ximo estipulado en la Tabla de Beneficios, ya sea cualquier Enfermedad o Lesi�n que hubiese comenzado durante el Periodo de Cobertura de la Persona Asegurada, diera como resultado la Repatriaci�n de Restos Mortales de la Persona Asegurada. La Compa��a pagar� los Beneficios Elegibles razonables en los que se incurra para el regreso de los restos de la Persona Asegurada a su Pa�s de Residencia actual, si fallece.
                         </p>
                         
                         <p>
                          A efectos de esta secci�n s�lo aquellos gastos en los que se incurra como resultado de un Evento Cubierto, que se encuentren espec�ficamente enumerados a continuaci�n y que no formen parte de las Exclusiones, ser�n considerados Beneficios Elegibles.
                         </p>
                         
                     
                         
                       <ol style="font-size: 12px;">
                           <li>Los Beneficios Elegibles incluyen, pero no se limitan a, gastos por embalsamar el cuerpo, un contenedor apropiado para el traslado, costos de env�o y las autorizaciones gubernamentales pertinentes.</li>
                           <li>	Todos los gastos Cubiertos realizados en conexi�n con un Traslado de Restos Mortales   deben ser pre-Aprobados y ordenados por la Compa��a de asistencia que representa a la Compa��a. </li>
                           <li>	Todos los medios de transporte en conexi�n de una evacuaci�n m�dica de emergencia o repatriaci�n deben ser pre-aprobada y organizada por un Administrador designado por la Compa��a.</li>
                           <li> Beneficios elegibles hasta $1500 para gastos funerarios en pa�s de residencia.</li>
                       </ol>
            
                      
                          <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                              G.	Beneficio de Reuni�n M�dica de Emergencia
                             </span>
                         </p>
                         
                         <p>
                       El Beneficio de Reuni�n M�dica de Emergencia se aplicar� solo cuando la Persona Asegurada se encuentre viajando fuera de su Pa�s de Residencia actual. En ning�n caso la responsabilidad m�xima de la Compa��a superar� el m�ximo establecido en la Tabla de Beneficios, respecto a los Beneficios Elegibles, durante cualquier Periodo de Cobertura dado. Cuando una Persona Asegurada es elegible para el Beneficio de Evacuaci�n o Repatriaci�n M�dica de Emergencia, bajo esta P�liza, y el Administrador conjuntamente con el M�dico tratante determinen que la Evacuaci�n o Repatriaci�n M�dica de Emergencia es necesaria y prudente para la Persona Asegurada, corresponder� un Beneficio de Reuni�n M�dica de Emergencia.
                         </p>
                         
                         <p>
                         A efectos de esta secci�n s�lo aquellos gastos en los que se incurra como resultado de un Siniestro Cubierto, que se encuentren espec�ficamente enumerados a continuaci�n y que no formen parte de las Exclusiones, ser�n considerados Beneficios Elegibles:
                         </p>
                         
                     
                         
                       <ol style="font-size: 12px;">
                           <li>El costo de un boleto a�reo de ida y vuelta en clase econ�mica para una persona seleccionada por la Persona Asegurada, desde el Pa�s de Residencia de la Persona Asegurada hasta la localidad donde esta se encuentre hospitalizada, y regreso al Pa�s de Residencia actual.</li>
                           <li>Gastos razonables de viaje y alojamiento, en los que se incurra en relaci�n con la Reuni�n M�dica de Emergencia, hasta el m�ximo establecido en la Tabla de Beneficios, los cuales no exceder�n de $200 por d�a. </li>
                           <li>La duraci�n de la Reuni�n M�dica de Emergencia no exceder� los 10 d�as incluyendo el viaje.</li>
                           <li>Todo traslado relacionado con una Reuni�n M�dica de emergencia, debe ser pre aprobado y ordenado por un representante del Administrador designado por la Compa��a.</li>
                       </ol>
    
                    
                     
                         <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                             H.	Muerte Accidental y Desmembramiento
                             </span>
                         </p>
   
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 34 of 52</p>
                    <p>
                       La p�liza ofrece un Suma M�xima Principal de $10,000 en caso de muerte accidental del Asegurado Principal, $5000 para el C�nyuge y $2,500 por Dependiente. 
                         </p>
                         
                         <p>
                         Cobertura opcional adicional se puede adquirir en el momento de la solicitud o renovaci�n de hasta $100.000 por muerte accidental y desmembramiento (AD &amp; D)
                         </p>
                         
                         <p style="border-bottom: 1px solid #000; display: inline-block;">Tabla de P�rdidas</p>
                         
                         <table style="margin: auto; border-collapse: collapse;">
                             <tr>
                                 <td style="border-bottom: 1px solid #000;">Descripci�n de la P�rdida (Por perdida de:)	</td>
                                 <td style="border-bottom: 1px solid #000;">Suma Principal</td>
                             </tr>
                             
                             <tr>
                                 <td>Vida</td>
                                 <td>100%</td>
                             </tr>
                             
                             <tr>
                                 <td>Ambas Manos, Ambos Pies o Vista en Ambos Ojos</td>
                                 <td>100%</td>
                             </tr>
                             
                             <tr>
                                 <td>Una Mano y Un Pie</td>
                                 <td>100%</td>
                             </tr>
                             
                             <tr>
                                 <td>Una Mano o Un Pie y la Vista de Un Ojo </td>
                                 <td>100%</td>
                             </tr>
                             
                             <tr>
                                 <td>Una Mano o Un Pie</td>
                                 <td>50%</td>
                             </tr>
                             
                             <tr>
                                 <td>Vista de Un Ojo	</td>
                                 <td>50%</td>
                             </tr>
                             
                             <tr>
                                 <td>Cuadriplejia</td>
                                 <td>100%</td>
                             </tr>
                             
                             <tr>
                                 <td>Paraplejia (par�lisis total de ambos miembros inferiores)	</td>
                                 <td>75%</td>
                             </tr>
                             
                             <tr>
                                 <td>Hemiplejia (par�lisis total de las extremidades superior e inferior de un lado del cuerpo) 	50%
                                    Uniplejia (par�lisis total de una extremidad)	
                                </td>
                                 <td>25%</td>
                             </tr>

                         </table>
                         
         
                         
                         <p>
                      L�mite Global de Indemnizaci�n por Accidentes por familia asegurada: cinco veces la suma principal a un total m�ximo de $100,000.
                         </p>
                         
                         <p>
                         ALa Compa��a deber� pagar una indemnizaci�n determinada por el Plan de Beneficios y la Tabla de Perdidas, si la persona asegurada sufra una P�rdida como resultado de lesiones, siempre que:
                         </p>
                         
                     
                         
                       <ol style="font-size: 12px;">
                           <li>P�rdida se produce dentro de 90 d�as despu�s de la fecha del accidente que caus� la p�rdida causando dicha Perdida, y</li>
                           <li>el pago de Indemnizaci�n por dicha P�rdida ser� la suma principal indicada en la Tabla de Beneficios y Tabla de p�rdidas, seg�n corresponda a dicha Persona Asegurada y este Seguros, y </li>
                           <li>si m�s de una P�rdida indicada en la Tabla de Perdidas se produce como el resultado de un accidente, s�lo una de las cantidades que figuran en dicha tabla, el m�s grande, se pagar�.</li>
                    
                       </ol>
                       
                        <p>   <span style="border-bottom: 1px solid #000;">Exposici�n</span>   <br>      
                        Si por causa de un accidente cubierto por la P�liza, una persona Asegurada est� inevitablemente expuesta a los elementos y, como resultado de dicha exposici�n sufre una p�rdida para el cual la Suma Principal es de otro modo cubierta, ser� cubierta por los t�rminos de la P�liza.
                        </p>


                         <p>   <span style="border-bottom: 1px solid #000;">Desaparici�n</span>   <br>      
                        Si el cuerpo de una persona asegurada no se ha encontrado dentro de un a�o posterior la desaparici�n de un avi�n que aterrice forzado, el hundimiento o naufragio de un medio de transporte en el que el Asegurado era uno de los ocupantes, entonces se considerar�, sujeto a todas las los dem�s t�rminos y disposiciones de la P�liza, que el asegurado ha sufrido la P�rdida de la Vida seg�n el significado de la P�liza.
                        </p>
            
            

                         <p>   <span style="border-bottom: 1px solid #000;">Designaci�n del beneficiario y el cambio</span>  </p>   
                     
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
                    <p class="page_no">Page 35 of 52</p>
                      <p>El beneficiario o beneficiarios de una persona Asegurada deber� ser el c�nyuge o los hijos mencionados en esta P�liza o el pariente m�s cercano en el siguiente orden: esposa, hijos, padre, madre, hermano o hermana o siguiente pariente m�s cercano.
                        </p>
                        
                        <p>   <span style="border-bottom: 1px solid #000;">Muerte en Transporte P�blico y Desmembramiento Accidental - Descripci�n Adicional</span>   <br>      
                     Muerte Accidental y Desmembramiento se brinda a una persona asegurada y se aplicar� s�lo a las lesiones, sostenidas por la persona Asegurada en el transcurso de la cobertura. Dicho seguro incluye lesiones tales sufridas durante un viaje en el cual el Asegurado est� viajando como pasajero. No se aplicar� cobertura cuando un piloto, operador o miembro de la tripulaci�n en o sobre, subiendo o bajando de �l:
                        </p>
                        
                        <p>
                            1.	cualquier aeronave civil que posea un Certificado de Aeronavegabilidad vigente y v�lido, y pilotado por una persona que posee un certificado v�lido y vigente de competencia que lo autoriza a pilotar las aeronaves, o
                        </p>
                        
                        <p>
                            2.	cualquier tipo de aeronave de transporte operados por el Comando de Transporte A�reo Militar (MAC) de los Estados Unidos, o por el servicio de transporte a�reo similar de cualquier autoridad gubernamental debidamente constituido de cualquier otro pa�s reconocido, este seguro no se aplicar� mientras el Asegurado viaje en cualquier aeronave civil o militar que no sea expresamente descrito anteriormente, a menos que sea previamente aceptadas por escrito por la Compa��a.
                        </p>
                        
                        <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                I.	Programa de Pre-Notificaci�n
                            </span>
                        </p>
                        <p>
                            El Programa de Pre-Notificaci�n requiere que la persona asegurada (o alguien en su nombre) obtenga la pre-notificaci�n poni�ndose en contacto con el Administrador tan pronto como sea posible, pero no menos de 7 a 10 d�as laborables antes de la fecha de un ingreso hospitalario programado dentro o fuera de pa�s de residencia, dentro de 72 horas despu�s de un ingreso en el hospital de emergencia en cualquier parte del mundo. Adem�s, los servicios ambulatorios que excedan $1.000 deben ser previamente notificados de la misma manera como un ingreso en el hospital. El Programa de Pre-Notificaci�n tambi�n requiere que la persona asegurada utilice la Red aprobada de Proveedores Preferidos (PPO) para los servicios y los tratamientos recibidos en los Estados Unidos.
                        </p>
                        <p>
                            El programa de Pre-Notificaci�n requiere que la Persona Asegurada cumpla con el siguiente procedimiento:
                        </p>
                        
                        <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                1.	Contactar a El Administrador
                            </span>
                        </p>
                        <p>
                            Los m�todos aceptables para contactar al Administrador incluyen tel�fono, fax y correo electr�nico. Con el fin de completar la Pre-Notificaci�n, el Administrador necesitar� obtener de la Persona Asegurada lo siguiente: N�mero de P�liza, nombre del paciente, tel�fono del paciente (y/o direcci�n de correo electr�nico), nombre y tel�fono del Hospital, nombre y tel�fono del M�dico tratante, diagn�stico y n�mero de d�as de hospitalizaci�n.
                        </p>
                        <p>El Administrador puede ser contactado en:</p>
                        
                        <ul style="list-style-type: none; padding: 0px;">
                            <li>Global Assurance Group</li>
                            <li>801 NE 167 St</li>
                            <li>2nd Floor</li>
                            <li>North Miami Beach, FL 33162</li>
                            <li>Tel�fono: 305-493-3071</li>
                            <li>Fax: 305-493-3078</li>
                            <li>Correo electr�nico:<a href="claims@claria.us/medical@claria.us">claims@claria.us/medical@claria.us</a></li>
                        </ul>

                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
       <p class="page_no">Page 36 of 52</p>
                    <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                2.- Contactar a la Compa��a de Asistencia
                            </span>
                        </p>
                        <p>
                           GMMI/Europ Assistance puede ser contactado al 1 888.803.3287 dentro de los Estados Unidos o para llamar fuera de los Estados Unidos al 954.308.3914. Llamadas por cobrar son aceptadas.
                        </p>
                        
                        <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                               3.- Utilice la Red de Hospitales (PPO) dentro de los Estados Unidos
                            </span>
                        </p>
                        <p>
                           Los servicios y Tratamientos en los Estados Unidos deber�n ser recibidos en un establecimiento aprobado de la Red de Hospitales (PPO), si uno existiese a 75 millas de donde la persona asegurada se encuentra. Para obtener una lista de servicios de proveedores aprobados, contactar al Administrador.
                        </p>
                 
                       <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                               La omisi�n en seguir el procedimiento, descrito en los p�rrafos 1 y 3 del programa de Pre-Notificaci�n, resultar� en un coaseguro del 50% en los Beneficios Elegibles estipulados en la Tabla de Beneficios.
                            </span>
                        </p>
                        
                        <p>
                            Los Beneficios pagaderos de acuerdo a esta P�liza est�n todav�a sujetos a elegibilidad al momento en que realmente se incurra en los cargos, y a todos los otros t�rminos, limitaciones y Exclusiones de la P�liza. La Pre-Notificaci�n no garantiza ni confirma los beneficios bajo esta P�liza.
                        </p>
                        
                        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCI�N 5: EXCLUSIONES</h3>
                        
                        <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                A.	Exclusiones de los Beneficios M�dicos
                            </span>
                        </p>
                        <p>
                            Este seguro no cubre ning�n tipo de tratamiento, medicaci�n, los cargos o sus consecuencias, en relaci�n con las siguientes exclusiones, al menos que sean espec�ficamente incluidas o modificadas en la Lista de Beneficios del n�mero 1 al 27 de esta P�liza. En cuanto a las prestaciones m�dicas de este seguro no cubre los gastos en relaci�n a o en conexi�n con:
                        </p>
                        
                        <ol style="padding: 0px; font-size: 11px;">
                            <li>Condiciones Pre-Existentes que consistan en cualquier Enfermedad o Lesi�n que cumpla con cualquiera de los siguientes criterios: 1) Una condici�n que habr�a causado que una persona buscase consejo, diagn�stico, cuidado o Tratamiento m�dico antes de la Fecha Efectiva Individual de Cobertura de esta P�liza; 2) Una condici�n por la cual se busc�, recomend� o recibi� consejo, diagn�stico cuidados o Tratamiento m�dico antes de la Fecha Efectiva Individual de Cobertura de esta P�liza; 3) los s�ntomas que se produjeron antes de la fecha efectiva de la cobertura individual en virtud de este Certificado que han permitido a una persona entrenada en medicina realizar un diagn�stico de la condici�n que produce los s�ntomas; 4) una condici�n que se manifieste antes de la Fecha Efectiva Individual de Cobertura bajo esta P�liza; 5) gastos por Embarazo incluido antes y despu�s del nacimiento, complicaciones de la madre al momento del parto o el reci�n nacido durante los primeros doce (12) meses desde la Fecha Efectiva Individual de Cobertura bajo esta P�liza. El Administrador puede emitir Cl�usulas de Exclusi�n para ciertas condiciones Pre-Existentes que est�n completa y exactamente descritas en la Solicitud y sean Aprobadas y aceptadas por el Administrador, sin una Cl�usula de Exclusi�n ni otra restricci�n, estar�n autom�ticamente cubiertas al m�nimo vitalicio de $50.000 y de$5.000 l�mite por Periodo de Cobertura, despu�s que la Persona Asegurada haya estado asegurada continuamente durante 24 meses. En el tiempo de suscripci�n y a discreci�n del Administrador se ofrecer�n l�mites m�s altos de beneficios.</li>
                            <li>Lesi�n o Enfermedad que no sean presentados a la Compa��a para su pago dentro de los noventa (90) d�as siguientes al Incidente que caus� los gastos.</li>
                        </ol>
                      
    
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 37 of 52</p>
       
                       <ol style="padding: 0px;font-size: 11px;" start="3">
                            <li style="margin-bottom: 8px;">Tratamientos que no sean M�dicamente Necesarios. Servicios, tratamiento o suministros incluyendo cualquier periodo de permanencia en el hospital, el cual no sea recomendado, aprobado y certificado como m�dicamente necesario y razonable por un doctor.
                            </li>
                            <li style="margin-bottom: 8px;">Servicios proporcionados sin costo a la Persona Asegurada.</li>
                            
                            <li style="margin-bottom: 8px;">Tratamiento que exceda los cargos Razonables y Acostumbrados.</li>
                            <li style="margin-bottom: 8px;">Cirug�as, Medicaci�n o Tratamientos que sean Experimentales, de Investigaci�n o destinados a Investigaci�n.</li>
                            <li style="margin-bottom: 8px;">Suicidio o cualquier intento de ello estando cuerdo, o da�o auto-infligido o cualquier intento de ello, estando demente. </li>
                            <li style="margin-bottom: 8px;">Guerra, hostilidades u operaciones b�licas (ya sea guerra declarada o no), invasi�n, la Ley de un enemigo extranjero a la nacionalidad de la persona asegurada o del pa�s, o m�s, que se produce el hecho, la guerra civil, de represi�n de disturbios, rebeli�n, insurrecci�n , Revoluci�n, el derrocamiento del gobierno legalmente constituido, conmoci�n civil asumiendo la proporci�n de, o que asciende a un levantamiento, militar o usurpaci�n de poder, explosiones de armas de guerra, la utilizaci�n de armas nucleares, qu�micas o biol�gicas de destrucci�n masiva quien sea haya o pueda haber distribuido o combinado, Asalto Asesinato posteriormente fuera de toda duda razonable que ha sido el acto de los agentes de un Estado extranjero a la nacionalidad de la persona asegurada si se declara la guerra con ese Estado o no, actividad terrorista o la contaminaci�n radiactiva. Pandemias y / o epidemias para las cuales la OMS (Organizaci�n Mundial de la Salud) ha declarado una emergencia sanitaria mundial, ha declarado la fase 5 y / o han sido colocados bajo la direcci�n de las autoridades p�blicas.
                            A los efectos de la exclusi�n # 8
                                    <ol style="list-style-type: lower-alpha; font-size: 11px; margin-top: 20px;">
                                        <li style="margin-bottom: 5px;">Actividad terrorista significa un acto o acto(s) de cualquier persona(s) o grupo(s) de personas, cometidos con fines pol�ticos, religiosos, ideol�gicos o afines, con la intenci�n de influir sobre cualquier gobierno y/o atemorizar al p�blico o a cualquier sector de este. La Actividad terrorista puede incluir, aunque no est� limitada a, el uso real de fuerza o violencia y/o la amenaza de tal uso. Adem�s, los perpetradores de actividad terrorista pueden actuar solos, ya sea en nombre de o en conexi�n con cualquier organizaci�n(es) y/o gobierno(s).</li>
                                        <li style="margin-bottom: 5px;">Uso de Armas Nucleares de destrucci�n masiva significa el uso de cualquier dispositivo o arma explosiva nuclear, o la emisi�n, descarga, dispersi�n, liberaci�n o escape de material fisionable, que emita un nivel de radiactividad capaz de causar incapacidad o muerte en la poblaci�n.</li>
                                        <li style="margin-bottom: 5px;">Uso de armas Qu�micas de destrucci�n masiva significa la emisi�n, descarga, dispersi�n, liberaci�n o escape de cualquier compuesto qu�mico s�lido, l�quido o gaseoso, que, al ser esparcido de cierta manera, es capaz de causar incapacidad o muerte en la poblaci�n.</li>
                                        <li style="margin-bottom: 5px;">Uso de armas Biol�gicas de destrucci�n masiva significa la emisi�n, descarga, dispersi�n, liberaci�n o escape de cualquier microorganismo pat�geno (que produce Enfermedades) y/o toxinas producidas biol�gicamente (incluyendo organismos modificados gen�ticamente y toxinas sintetizadas qu�micamente), que sean capaces de causar incapacidad o muerte entre la poblaci�n.</li>
                                        <li style="margin-bottom: 5px;">Tambi�n se excluye a este respecto toda P�rdida o gasto de cualquier �ndole que, directa o indirectamente, surja de, contribuya a, sea causado por, resulte de, o est� asociado con cualquier acci�n ejecutada en el control, prevenci�n o supresi�n de alguna o todas las situaciones descritas anteriormente. En el caso que cualquier parte de esta Exclusi�n se halle como inv�lida o inejecutable, el resto permanecer� �ntegramente en vigor y con efecto.</li>
                                    </ol>
                            
                            
                            
                            
                            </li>
                            <li style="margin-bottom: 8px;">Lesiones sufridas durante la participaci�n de eventos organizados, profesional, o deportivo para principiantes.</li>
                            <li style="margin-bottom: 8px;">Condici�n (es), o s�ntomas que se manifiesten dentro de los 90 d�as siguientes a la fecha efectiva del certificado y complicaciones futuras y / o todos los gastos m�dicos futuros derivados del mismo o relacionados con el mismo, con excepci�n de las condiciones m�dicas causadas por accidentes y / o enfermedades infectocontagiosas o si el per�odo de espera de 90 d�as es eliminado por escrito por el Administrador en el momento de emisi�n de la p�liza.
                            </li>
                        </ol>
                        
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
       <p class="page_no">Page 38 of 52</p>
            <ol style="padding: 0px; font-size: 11px" start="11">
                        
                                <li style="margin-bottom: 8px;">A no ser que el plan prevea otra cosa, Vacunas, inoculaciones, reconocimientos de rutina, ex�menes m�dicos preventivos, pruebas gen�ticas, chequeos o ex�menes integrales, u otros ex�menes donde no existan indicaciones objetivas de perjuicio de la salud, y ex�menes de laboratorio o radiol�gicos para diagn�stico, excepto en el curso de un Evento Cubierto establecido por una consulta previa o la atenci�n de un M�dico.</li>
                                <li style="margin-bottom: 8px;">Tratamiento de la articulaci�n temporo-mandibular (ATM).</li>
                                <li style="margin-bottom: 8px;">Terapia Vocacional, laboral, rehabilitante, f�sica, recreacional, del lenguaje o m�sico-terapia, sea ambulatoria o durante una hospitalizaci�n, al menos que est� incluida en la lista de beneficios.</li>
                                <li style="margin-bottom: 8px;">Tratamiento dado por un m�dico, m�dico general, doctor, especialista o consultor que se encuentra de modo alguno relacionado con la persona asegurada o quien no es reconocido por las autoridades del pa�s en el que el tratamiento se lleva a cabo con conocimientos especializados o, experiencia en el tratamiento de la enfermedad, o lesi�n que se est� tratando.</li>
                                <li style="margin-bottom: 8px;">Cirug�a cosm�tica o pl�stica, ya sea por razones psicol�gicas o de otro tipo, y las posibles consecuencias y / o los gastos m�dicos relacionados con �l, salvo como consecuencia de un accidente cubierto como se indica en la Tabla de beneficios. Para efectos de este seguro, el tratamiento de un tabique nasal desviado, se considerar� una condici�n cosm�tica. </li>
                                <li style="margin-bottom: 8px;">El tratamiento, la adquisici�n e instalaci�n de falsos dientes o pr�tesis dentales. Los reclamos por ex�menes auditivos, aud�fonos, perforaci�n oreja y del cuerpo. Reclamos por el suministro o la instalaci�n de los dispositivos f�sicos o que no forman de una parte permanente del cuerpo.</li>
                                <li style="margin-bottom: 8px;">Refracciones oculares o ex�menes de la vista a los efectos de la prescripci�n de lentes correctores o gafas o para su instalaci�n y ceratotom�a radial, a menos que sean causados por lesiones corporales accidentales mientras est� asegurado, el tratamiento para corregir la vista corta o larga, incluyendo lentes, gafas, y lentes de contacto.</li>
                                <li style="margin-bottom: 8px;">Los costos del tratamiento que hayan incurrido como consecuencia de complicaciones directamente causadas por una enfermedad, lesi�n o tratamiento para que la cobertura se limita o excluya.</li>
                                <li style="margin-bottom: 8px;">Consultas telef�nicas o la inasistencia a una cita programada.</li>
                                <li style="margin-bottom: 8px;">Mientras que el tratamiento se limite principalmente a recibir cuidados no m�dicos para servicios y asistencia personal, educaci�n o rehabilitaci�n y los servicios de enfermer�a en una instalaci�n de cuidados a largo plazo, spa, hidrocl�nicas, cl�nica de p�rdida de peso, sanatorio, hogar de ancianos o instalaciones similares.</li>
                                <li style="margin-bottom: 8px;">Enfermedades cong�nitas, nacimientos prematuros, defectos cong�nitos y las condiciones que surjan como resultado de los mismos.</li>
                                <li style="margin-bottom: 8px;">Servicios o suministros que no sean de �ndole m�dica.</li>
                                <li style="margin-bottom: 8px;">El valor del boleto a�reo de regreso al Pa�s de Residencia, no usado por la Persona Asegurada, en el caso que se presten los servicios de una Evacuaci�n o Repatriaci�n M�dica de Emergencia y/o la Repatriaci�n de los Restos Mortales. </li>
                                <li style="margin-bottom: 8px;">Lesiones o Enfermedades intencionales o auto infligidas.</li>
                                <li style="margin-bottom: 8px;">Comisi�n de un delito grave.</li>
                                <li style="margin-bottom: 8px;">Lesi�n sufrida durante la pr�ctica de: alpinismo donde normalmente se usen sogas o gu�as, paracaidismo, parapente, salto con Bunge, carreras de caballos, autos, o motociclismo, submarinismo con aparatos de respiraci�n bajo el agua, salvo por certificaci�n PADI o NAUI.</li>
                                <li style="margin-bottom: 8px;">
                                   Tratamiento pagado por o proporcionado bajo cualquier otra P�liza individual o colectiva u otro servicio o plan m�dico pre-pagado contratado a trav�s del empleador, al grado de ser suministrado o pagado, o bajo cualquier programa gubernamental obligatorio, o instalaci�n establecida para Tratamiento sin costo para ninguna persona; sin importar que la fecha de emisi�n de la otra p�liza sea previa o posterior a la emisi�n de la presente p�liza; en todos los casos la presente p�liza pagar� los gastos m�dicos s�lo de manera posterior y en exceso, una vez que todos los beneficios de las p�lizas v�lidas y existentes hayan sido completamente pagados y agotados.
                                </li>
                     
                        </ol>
                      
                        
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 39 of 52</p>
       
                      <ol style="padding: 0px; font-size: 11px" start="28">
                           <li style="margin-bottom: 8px;">
                              Lesiones por la cuales los beneficios sean pagaderos por una P�liza de responsabilidad civil de autom�viles.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Tratamiento de Virus del Papiloma Humano, Enfermedades ven�reas, Enfermedades de transmisi�n sexual o gastos por cambio de sexo.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Salvo que se haya dispuesto otra cosa bajo el plan de Tratamiento Dental Rutinario: ex�menes odontol�gicos preventivos, tratamiento profil�ctico, chequeos, raspado, limpieza o pulido de dientes, servicios para el cuidado odontol�gico de los dientes o del periodonto, o del tejido o estructura circundante, excepto los derivados de una Lesi�n de los dientes sanos, naturales, causada por un Accidente. No ser�n Beneficios Elegibles ninguno de los gastos m�dicos derivados de ello y/o relacionados con los tratamientos incursos en esta exclusi�n, incluyendo, pero sin limitarse a infecciones.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Gastos por el Embarazo / maternidad incurridos por un hijo dependiente.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                              Tratamientos, medicamentos o procedimientos que, ya sea que promuevan o sea que prevengan, la concepci�n o eviten el nacimiento de un ni�o, incluyendo, aunque no limitado a: Reclamos por cualquier tipo de contracepci�n o fertilizaci�n, tratamiento para problemas sexuales, (incluyendo impotencia, cualquiera sea la causa), reproducci�n asistida (por ejemplo, tratamiento IVF), interrupci�n del embarazo, inseminaci�n artificial, fertilizaci�n in vitro, transferencia intra falopiana de gameto (GIFT), Tratamiento por infertilidad o impotencia, esterilizaci�n o reversi�n de ella, o aborto. Maternidad, el parto, las complicaciones y la cobertura de los ni�os que son el resultado de cualquier forma de reproducci�n asistida y los defectos de nacimiento, cong�nita o hereditaria, que las condiciones est�n presentes en el nacimiento ya sean o no diagnosticadas no ser�n cubiertas.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Beneficios relacionados con condiciones o trastornos de adicci�n, alcoholismo y drogadicci�n, o abuso de sustancias o solventes, ya sea que est�n relacionados o no con drogas o tratamientos prescritos, muerte o tratamiento por alguna lesi�n sufrida bajo la influencia total o parcial de los efectos del abuso de drogas, alcohol, sustancia o solventes. 
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                              Cualquier desorden mental o nervioso o curas de sue�o, salvo que est� cubierto de otra manera en esta P�liza 
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Tratamiento por S�ndrome de Fatiga Cr�nica, incluyendo, aunque no limitado a, estudio de diagn�stico.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                             Servicio o tratamiento de cualquier forma de suplemento alimenticio o el aumento o para cualquier programa de control de peso, ya sea para la obesidad o cualquier diagn�stico, por dieta, inyecci�n de cualquier fluido, o el uso de los medicamentos o cirug�a de cualquier tipo, incluyendo los programas para dejar de fumar.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Atenci�n quiropr�ctica, salvo incluidos en esta p�liza.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Alquiler o compra de equipos m�dicos no desechables fuera de un Hospital, sillas de rueda, tanques de ox�geno y andaderas, aunque sin limitarse a ellas.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Operaciones de rescate por agua o tierra.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Tratamiento para enfermedades o lesiones resultantes de o en el curso de cualquier empleo para el cual el Asegurado ha recibido un salario o beneficio.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                             Tratamiento, servicios y suministros para el Tratamiento de pie plano, arcos ca�dos, callos, juanetes, y cuidado de las u�as de los Pies.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                              Tratamiento, servicios y suministros por Convalecencia, Hospicio o Cuidados a Domicilio. Atenci�n para pacientes terminales y/o cuidados paliativos. Tratamiento y los costos de una m�quina para soporte vital artificial o un dispositivo similar y los costos de la atenci�n y tratamiento asociados con el uso de la m�quina como soporte de vida artificial o un dispositivo similar m�s all� de los primeros 7 d�as de uso.
                           </li>
                           
                           <li style="margin-bottom: 8px;">Los costos de transporte que no sean de emergencia, excepto el transporte de ambulancia del Hospital y, en particular, los costos derivados de los viajes realizados espec�ficamente con el fin de obtener tratamiento m�dico est�n excluidos.
                               
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Todo Reclamo que surja de tareas realizadas contrariando el consejo de un M�dico, cuando la Persona Asegurada ha recibido un pron�stico terminal o est� sufriendo una condici�n cr�nica.
                           </li>
                           <li style="margin-bottom: 8px;">Terapia de reemplazo hormonal (HRT), a menos que se realice como parte de, o inmediatamente despu�s, de un procedimiento quir�rgico que est� cubierto bajo la Tabla de Beneficios de este Plan.</li>
                     
                        </ol>
                        
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 200px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 40 of 52</p>
            <ol style="padding: 0px; font-size: 11px" start="46">
                                <li>Tratamiento de la apnea del sue�o (paro temporal de la respiraci�n durante el sue�o), ronquidos o cualquier otro trastorno respiratorio asociado al sue�o.</li>
                                <li>Tratamiento de una condici�n al�rgica o cualquier trastorno que el Asegurado conoc�a al momento de la solicitud y que no fue declarado.</li>
                                <li>Tratamiento por dificultades de aprendizaje, problemas mentales y problemas f�sicos del desarrollo.</li>
                                <li>Tratamiento por un estimulador de crecimiento �seo, estimulaci�n del crecimiento �seo, o tratamiento relacionado con la hormona del crecimiento, independientemente de la raz�n por la cual se receta.</li>
                                <li>Esta p�liza no pagar� por gastos causados directa o indirectamente por error en tratamiento quir�rgico, error u omisi�n de cualquier m�dico, enfermera, m�dico, cirujano, dentista, asistente m�dico, t�cnico, farmac�utico u otro profesional de la medicina. Esto incluye, pero no se limita a la prestaci�n o falta de proporcionar servicio o tratamiento m�dico o profesional, La omisi�n por un profesional de la salud en los que el tratamiento siempre cae por debajo de las normas aceptadas de la pr�ctica en la comunidad m�dica y causa lesiones o la muerte del paciente.</li>
                                <li>Cargos por atenci�n hospitalaria si el Asegurado abandona un hospital en contra de las indicaciones del m�dico, cargos de hospitalizaci�n y cargos ambulatorios como resultado directo del no cumplimiento voluntario de la atenci�n m�dicamente necesaria y del tratamiento m�dico prescrito cuando el Asegurado tiene conocimiento de dichas indicaciones.</li>
                                <li>Tratamiento que se realicen a los asegurados para las pruebas de lo siguiente: el VIH, la seropositividad para el virus del SIDA, las enfermedades relacionadas con el SIDA, S�ndrome de ARCO, o con SIDA. Tratamientos contra el virus del Sida, Enfermedades relacionadas con el SIDA, S�ndrome de ARC, Sida, y/o cualquier Enfermedad surgida como complicaciones de estas condiciones salvo que est� cubierto de otra manera en esta P�liza.</li>
                             
                     
                        </ol>
                        
                        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCI�N 6: DISPOSICIONES DE LA P�LIZA</h3>
                        
                        <ol style="font-size: 12px;">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Contrato Integro; Cambios: </span>Esta P�liza, incluyendo la, Solicitud, la Tabla de Beneficios, Cl�usulas de Exclusi�n, enmiendas y documentos anexos, si los hubiere, constituye el contrato �ntegro de Seguro. Ning�n cambio en la P�liza ser� v�lido hasta que sea Aprobado por un funcionario ejecutivo del Administrador, o a menos que dicha Aprobaci�n al respecto sea endosada. Ning�n agente tiene la autoridad para cambiar esta P�liza o para exonerar de cualquiera de sus disposiciones.</li>
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Prueba de P�rdida: </span>La carga de la prueba radica en el reclamante. Se debe proporcionar al Administrador la Prueba de P�rdida, por escrito, debidamente firmado en la forma de un formulario para reclamos en los Estados Unidos, un formulario de autorizaci�n de reclamos HIPAA, en sus oficinas, dentro de los noventa (90) d�as siguientes a la fecha del Siniestro Cubierto. El incumplimiento en la entrega de dichas pruebas invalidar� el reclamo. No obstante, el incumplimiento en la entrega de dichas pruebas dentro de tal lapso no invalidar� ni rebajar� ning�n Reclamo, si no hubiese sido razonablemente posible presentar la prueba dentro de dicho plazo, siempre y cuando las pruebas sean entregadas tan pronto como sea razonablemente posible. Donde la Compa��a considere que una consecuencia no queda cubierta por la p�liza debido a una exclusi�n, al contrario, la carga de la prueba estar� en la persona asegurada.<br>
                            Cuando una reclamaci�n por un accidente se presenta informaci�n detallada y explicaci�n de las circunstancias del accidente deben presentarse incluidos los informes de la polic�a o cualquier otro documento que la Compa��a puede solicitar apoyo a la prueba de la p�rdida. <br><br>
                            Presentar una reclamaci�n fraudulenta ser� causa para que La Compa��a cancele la p�liza sin declaraci�n judicial
                            </li>
    
                        </ol>
                 
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 41 of 52</p>
            <ol style="font-size: 12px;" start="3">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Pago de los Reclamos:  </span>Pago por Beneficios Elegibles ser�n realizados de forma directa al hospital, m�dico o proveedor. Una vez que una Persona Asegurada haya recibido la pre-autorizaci�n y Aprobaci�n para un Tratamiento elegible con Hospitalizaci�n, debido a Accidente, Lesi�n, Enfermedad, afecci�n o dolencia, los costos elegibles ser�n arreglados directamente con el(los) Proveedor(es) del Tratamiento. En caso que el asegurado pague directamente al proveedor, ser� la responsabilidad del asegurado para obtener un reembolso del proveedor. En Venezuela, los reclamos sometidos v�a reembolso no ser�n elegibles para beneficios. Para que un reclamo sea elegible para beneficios bajo el contrato de la p�liza, el Administrador debe coordinar directamente con el proveedor.
                            <br> <br>
                            Para que una reclamaci�n sea v�lida y pagadera, el cheque de la reclamaci�n debe ser depositado para ser cobrado dentro de los 90 d�as de la emisi�n. No depositar un cheque para ser cobrado dentro de 90 d�as de emisi�n anular� la validez de la reclamaci�n desde el principio. Cheques de reemplazo no ser�n emitidos y el reclamo ser� anulado y negado.
                            
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Ex�menes F�sicos y Autopsia: </span>
                            La Compa��a a expensas propias, tendr� el derecho y la oportunidad de examinar a la persona o cualquier individuo cuya lesi�n o enfermedad es la base del reclamo y, en la ocasi�n y con la frecuencia que razonablemente pueda requerirse durante la disputa de un Reclamo y el presente para hacer una autopsia en caso de muerte.  <br> <br>

                            Para todos los beneficios de esta p�liza, incluidos los beneficios m�dicos y los beneficios por Muerte Accidental y Desmembramiento: cuando se produce una enfermedad, accidente o muerte, la Compa��a solicitar� al asegurado o beneficiario todos los informes, incluidos, entre otros, el informe completo de la autopsia y / o resultados de sangre. y / o resultados de orina desde la fecha inicial de la enfermedad, accidente o muerte. Cuando la ley exige informes de drogas y alcohol durante una autopsia, los informes de los resultados de alcohol y drogas deben presentarse dentro de los 30 d�as siguientes a la solicitud.  <br> <br>

                            Todos los informes deben ser recibidos por la Compa��a dentro de los 30 d�as siguientes a la solicitud. La falta de entrega de todos los informes solicitados dentro de los 30 d�as ser� motivo de rechazo de la reclamaci�n. 
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Acciones Legales:  </span>
                           Cualquier y todas las disputas, reclamos, controversias que surjan de o en relaci�n con esta p�liza, o de su presunta violaci�n, debe ser sometida a arbitraje en Barbados. El asegurado y la Compa��a someter�n sus disputas a tres (3) �rbitros. Cada una de las partes elegir� un �rbitro y el tercer �rbitro ser� elegido por los dos �rbitros designados por las partes. Cualquiera de las partes puede iniciar el arbitraje mediante notificaci�n escrita a la otra parte, nombrar a un �rbitro y exigir arbitraje. La otra parte tendr� 30 d�as una vez recibida dicha notificaci�n para nombrar a su �rbitro. Los dos �rbitros elegidos escoger�n dentro de los 15 d�as el tercer �rbitro para el arbitraje que tendr� lugar dentro de los 15 d�as. Si falla cualquiera de las partes para nombrar un segundo �rbitro dentro de los 30 d�as a partir de cu�ndo se les notifica, la otra parte que no elija el �rbitro estar� de acuerdo en que la otra parte elige el segundo �rbitro y el arbitraje continuar�. El Arbitraje tendr� lugar en Barbados, a menos que ambas partes decidan que debe ser en otro lugar. Los gastos del arbitraje ser�n cancelados en partes iguales entre el asegurado y la Compa��a.  <br> <br>

                            El asegurado y la Compa��a acuerdan que la jurisdicci�n exclusiva ser� en Barbados para la determinaci�n de cualquier derecho legal en virtud de esta p�liza. El asegurado y la Compa��a acuerdan que cada parte pagar� sus propios gastos legales y costo del abogado. Estar de acuerdo con la jurisdicci�n exclusiva en Barbados y estar de.
                            </li>
                            
                            
                            
                        </ol>
                 
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            
             <p class="page_no">Page 42 of 52</p>
            
           <p> acuerdo en que cada parte pague sus honorarios no entra en conflicto con el acuerdo al arbitraje indicado anteriormente. </p>
                            
                    <p>        Notificaciones pueden ser enviadas por entrega personal o correo certificado a la Compa��a en Claria Life and Health Insurance Company CGI Tower 2nd Floor, Warrens St. Michael, Barbados BB22026 y de la persona asegurada a la direcci�n actual que figura en los registros de la Compa��a, con el mismo efecto como si fuera entrega personalizada en dicha ciudad. En ning�n caso la Compa��a ser� responsable por cualquier da�o extra-contractual, ya sea caracterizado sin limitaci�n, como consecuencia, ejemplar, punitivo o da�os extracontractuales, por cualquier supuesta violaci�n de esta p�liza.</p>
                            
                        <p>      Ninguna acci�n legal podr� ser intentada por una persona asegurada, recuperar en el marco de la p�liza, antes de sesenta (60) d�as despu�s que la Compa��a o el m�dico coordinador hubiesen recibido la prueba de p�rdida de acuerdo con los requisitos. Ni se intentar� en absoluto acci�n legal alguna a menos que se comience dentro de los seis (6 meses) posteriores a la fecha del reclamo original.</p>
                            
                           <p>   El asegurado y la Compa��a de seguros acuerdan que esta p�liza de seguro no fue ofrecida en los Estados Unidos (EE.UU.), que esta p�liza de seguro no fue comprada en los Estados Unidos (EE.UU.), que esta p�liza de seguro no se vendi� sujeta a ninguna ley Estados Unidos (EE.UU.). Adem�s, se acuerda que ninguna acci�n legal ser� presentada en los Estados Unidos (EE. UU.) en corte federal o estatal bajo esta p�liza de seguro por cualquiera de las partes.</p>
            
            
            
            <ol style="font-size: 12px;" start="6">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Per�odo de gracia:  </span>Un per�odo de gracia de 31 d�as ser� concedido para el pago de cada Prima que corresponda despu�s de la primera Prima y del periodo de renovaci�n, per�odo de gracia durante el cual el certificado continuar� en vigencia, condicional a que la prima sea recibida por la Compa��a antes de la expiraci�n del periodo de gracia. Para las modalidades de pago mensual y trimestral, se conceder� un per�odo de gracia de 14 d�as para el pago de las primas que se reciba despu�s de la fecha de la fecha de vencimiento y renovaci�n. Todas las p�lizas cuyas primas no sean pagadas dentro del per�odo de gracia permitido ser�n canceladas.
                            <br> <br>
                            La p�liza no puede ser renovada mientras que el asegurado se encuentre en los Estados Unidos, sus territorios o Canad�. Si la prima es pagada mientras el asegurado se encuentra en cualquiera de estos territorios, la renovaci�n ser� considerada nula y sin efecto y todas las primas pagadas por la renovaci�n ser�n devueltas.
                            <br> <br>
                            Las primas se pueden pagar con cheque en d�lares estadounidenses a cobrar en un banco de EE.UU. o a trav�s de transferencia bancaria en d�lares estadounidenses. No se aceptan pagos en efectivo para el pago de las primas. El pago de las primas debe ser recibido f�sicamente en la oficina del Administrador. Hacer un pago al agente no constituye prima pagada a la Compa��a y no se aceptar� como prima valida recibida para la p�liza. Cualquier pago hecho al agente en efectivo, cheque o transferencia a nombre del agente o a nombre de la compa��a del Agente no es responsabilidad de la Compa��a y no constituye pago de la prima a la Compa��a.


                            
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Rehabilitaci�n:  </span>
                            Si la Compa��a determina la terminaci�n de la Cobertura, debido a la falta de pago de la Prima o a que la prima no llega a la oficina del Administrador dentro del periodo permitido, la Compa��a a su discreci�n, 
     
                            </li>
                            
                            
                            
                            
                            
                        </ol>
                 
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 43 of 52</p>
            <p>
            puede elegir considerar la rehabilitaci�n de la Cobertura solamente despu�s de recibir una solicitud o un formulario de rehabilitaci�n para nueva revisi�n de suscripci�n y el pago de la Prima.
             </p>               
                       
<p>
            La rehabilitaci�n no est� garantizada y la Compa��a no est� bajo obligaci�n alguna de aceptar la rehabilitaci�n. Al ser rehabilitada, la P�liza cubrir� solamente los Eventos Cubiertos que resulten de Lesiones sufridas despu�s de la fecha de rehabilitaci�n y aquellos que resulten de Enfermedades que se manifiesten no menos de 10 d�as despu�s de la fecha de rehabilitaci�n. Enfermedades, lesiones u otro resultado de las mismas que sea manifestado durante el periodo de 10 d�as inmediatamente despu�s de la fecha de rehabilitaci�n no ser�n elegibles para cobertura bajo esta p�liza. Ninguna rehabilitaci�n ser� considerada por la Compa��a 60 d�as despu�s que la p�liza ha caducado por falta de pago.
            </p>
            
             <ol style="font-size: 12px;" start="8">
                        
                        <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Fecha Efectiva del Seguro Individual:  </span>
                           Despu�s de la evaluaci�n y Aprobaci�n de cada Solicitante por el Administrador, la Cobertura se har� efectiva en la m�s cercana de las siguientes fechas (1.) La cobertura se har� efectiva en la fecha en que el solicitante es aprobado por el Administrador; (2.) la fecha en que la Prima y la Solicitud apropiadas sean recibidas por el Administrador. La Compa��a se reserva el derecho de negar la inscripci�n sobre la base de una solicitud individual o una aplicaci�n, para incluir dependientes a cargo sin dar ninguna raz�n, o para aceptar el solicitante y / o personas dependientes en condiciones especiales.   
                            </li>
                            
                            
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Fecha de Vencimiento del Seguro Individual:   </span>
                          La Cobertura terminar� en la primera de las siguientes fechas: (1.) El t�rmino del periodo para el cual la Prima ha sido pagada; (2) la fecha en la cual la Persona Asegurada no cumpla con los Requisitos de Elegibilidad descritos en la secci�n 2 A; (3) la fecha en que la Compa��a cancele la cobertura para una Clase espec�fica de Personas Aseguradas, y en la cual la Persona Asegurada pueda estar incluida.
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">No sustituci�n de Compensaci�n laboral   </span>
                          Este Seguro no sustituye ni afecta ning�n requerimiento de Cobertura de P�lizas de compensaci�n laboral.
                            </li>
                            
                            
                               <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Certificado de Seguro:   </span>
                         La Compa��a emitir� para cada Persona Asegurada un certificado individual de Seguro, el cual contendr� las caracter�sticas esenciales del Seguro de cada persona y a quien se le pagan los Beneficios.
                            </li>
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Informaci�n proporcionada por el (los) Persona(s) Asegurada(s):   </span>
                            La Persona Asegurada debe proporcionar toda la informaci�n requerida en la Solicitud y cualquier informaci�n adicional solicitada por la Compa��a como resultado de un reclamo incluido pero no se limita a firmar el formulario de reclamo, el formulario HIPPA y cualquier otra forma de formulario de autorizaci�n, o los expedientes m�dicos, las facturas originales detalladas, reporte policial relacionado con el reclamo y/o declaraci�n jurada describiendo el accidente relacionado con el reclamo. El hecho de no proporcionar la informaci�n solicitada por el Administrador ser� causa de negaci�n de un siniestro o puede anular la p�liza. Todos los Hijos reci�n nacidos de una Persona Asegurada Principal, que no sean reportados en la Solicitud inicial y no est�n actualmente cubiertos bajo este Seguro, ser�n evaluados por el Administrador, no antes de los 14 d�as de nacido.
                            
                            
                            </li>                        
                                     
          
                        </ol>
            
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 44 of 52</p>
            
            <p>
            Esta p�liza se emite en base �nicamente a la informaci�n recibida por escrito en la solicitud original firmada. La Compa��a y el Administrador se basar�n exclusivamente en la informaci�n en la solicitud para revisar y emitir la p�liza y las condiciones del contrato. Cualquier informaci�n adicional o historia cl�nica presentada en el momento de la solicitud deber� recibir la confirmaci�n de recibido por escrito del Administrador en el momento de la solicitud con el fin de formar parte de la solicitud y que se considere parte de la revisi�n de la misma. <br> <br>
                            La negaci�n u omisi�n del asegurado o del M�dico o del Hospital en suministrar a la Compa��a todos los informes y registros m�dicos dentro de los treinta (30) d�as de nacido, no constituir� como un seguro v�lido bajo este contrato para los reci�n nacidos. Un ni�o dependiente no puede ser incluido en esta p�liza de seguro sin una solicitud completa y aprobaci�n del Administrador. <br> <br>
                            La negaci�n o fallo del M�dico del asegurado o del Hospital para realizar todos los reportes y registros m�dicos disponibles para la Compa��a dentro de 60 d�as de haber sido solicitado por la Compa��a puede causar que un Reclamo v�lido o Solicitud en otras circunstancias, sea negado y el caso cerrado debido a la carencia o respuesta limitada por parte de la Persona Asegurada y de sus proveedores M�dicos.
            </p>
            
            
                 
                        <ol style="font-size: 12px;" start="13">
                        
                        <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Cancelaci�n:   </span>Esta P�liza es renovable anualmente por la vida de la Persona Asegurada o hasta la Fecha de Vencimiento del Seguro Individual. Las renovaciones estar�n sujetas a las definiciones, t�rminos y condiciones vigentes al momento de cada renovaci�n. La Compa��a se reserva el derecho de alterar y/o enmendar por Categor�a los t�rminos, condiciones, tarifas, descuentos y/o recargos en cada fecha de renovaci�n de la p�liza y de aplicar dichas alteraciones y/o enmiendas a todas las p�lizas nuevas y de renovaci�n. La Compa��a puede cancelar una Clase entera de Personas aseguradas, incluyendo, aunque no limitado a, una Clase comprendida en una regi�n espec�fica, g�nero, edad o categor�a.
                            <br> <br>
                            El asegurado podr� cancelar la p�liza de la Compa��a, comunicando con 30 d�as de anticipaci�n por escrito, en cuyo momento la Compa��a har� un c�lculo de la Prima restante (si la hubiere) para reembolsarla a la Persona Asegurada.
       
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Renovaci�n del Seguro Individual: </span>
                           La P�liza ser� renovada cada a�o en el aniversario de la Fecha Efectiva de la P�liza, sujeto a las provisiones de la P�liza en vigor para la fecha de la renovaci�n. El per�odo inicial de Cobertura no puede exceder de 12 meses. La Persona Asegurada, sin embargo, puede aplicar por renovaci�n de la Cobertura. El per�odo de renovaci�n no puede ser de m�s de 12 meses. Renovaci�n(es) de la(s) prima(s) ser�n cobradas a los costos aplicables a las distintas clases seg�n el plan que el asegurado tenga en cada renovaci�n. La(s) Renovaci�n(es) depender�(n) de que la Persona Asegurada entregue la aplicaci�n en el tiempo estimado y el Administrador reciba en su oficina la aplicaci�n para renovaci�n de la prima dependiendo la clase como lo determina la Compa��a. La Compa��a no podr� cancelar a una Persona Asegurada, a menos que el asegurado sea incluido en una clase que es cancelada en su totalidad por la Compa��a.
          
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Beneficios en Exceso:  </span>
                          Toda la Cobertura ser� en exceso de todo otro seguro v�lido y reembolsable y se aplicar� solamente cuando dichos beneficios sean agotados, sea cual fuere la fecha de emisi�n de cualquier otra p�liza, </li>
                         </ol> 
                         
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
                <div>
 <p class="page_no">Page 45 of 52</p>
                            <p>
                                anterior o posterior a la emisi�n de la presente p�liza. En todos los casos esta p�liza pagar� los gastos m�dicos con posterioridad y en exceso, s�lo despu�s que todos los beneficios de p�lizas v�lidas y existentes hayan sido pagados y agotados. <br>
                          Otros Seguros v�lidos y reembolsables, por los cuales pueden ser beneficios pagaderos son programas de seguros dados por:
                          
                          </p>
                            
                            <ol style="font-size: 11px;" style="padding-left:30px;">
                                <li>Seguro o cobertura individual, colectiva o general;</li>
                                <li>Otra cobertura pre-pagada, individual o colectiva;</li>
                                <li>Cualquier cobertura bajo planes de fideicomiso laboral, planes de seguridad sindical, planes organizados por el empleador, planes organizados en beneficio de los empleados, u otros convenios de beneficios para individuos de un grupo;</li>
                                <li>Cualquier cobertura requerida o subministrada por cualquier estado o programa social de seguro;</li>
                                <li>Cualquier seguro de autom�vil.</li>
                                <li>Plan social del gobierno</li>
                                <li>Cualquier seguro de responsabilidad civil;</li>
                            </ol>
                            
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                Cuando la coordinaci�n de beneficios con otra p�liza de seguro se utilice el Asegurado debe notificar al Administrador cuando los l�mites de la otra compa��a de seguros se han cumplido para que el Administrador coordine el pago directo de los Beneficios Elegibles en el futuro. Si no lo hace dentro de 48 horas dar� lugar a un co aseguro adicional de 50% de todos los Beneficios Elegibles.
                            </span>

                            
                            
                        <ol style="font-size: 12px;" start="16">        
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Subrogaci�n:  </span>
                          La Compa��a tiene el derecho de subrogaci�n y reembolso por cualquier suma pagada por la Compa��a a una Persona Asegurada o en su nombre, si esta recibe alguna cantidad de dinero de otra persona, plan o entidad legal la cual est� legalmente obligada a hacer pagos derivados de acciones u omisiones de cualquier persona, sea un tercero u otra persona cubierta bajo la presente p�liza, la cual hubiese causado directa o indirectamente una condici�n f�sica o mental, en relaci�n con la cual se hubiesen hecho pagos de cualquiera de los beneficios bajo la p�liza a dicha persona asegurada o a su nombre. La Compa��a tendr� un cargo en contra de dicha suma de dinero recibida de terceras partes u otras personas arriba descritas, o sus aseguradores, o el asegurador de la Persona Asegurada, y ser� reembolsada de ello. La Persona Asegurada adem�s conviene en notificar, por escrito, a las personas o entidades antes mencionadas, sobre los derechos de subrogaci�n y cargos de la Compa��a, antes de recibir cualquier pago por parte de dichas personas. <br> <br>
                           
                           La Persona Asegurada ser� responsable por todos los gastos de recuperaci�n de dichos terceros u otras personas, incluyendo, pero no limitado a, costos de abogados, en los que se incurra en la cobranza de dichos pagos, cuyos honorarios y gastos no reducir�n el monto del reintegro a la Compa��a requerido de la Persona Asegurada. La Persona Asegurada acepta reembolsar a la Compa��a por cualquier Beneficio pagado de acuerdo con esta p�liza, aparte de cualquier dinero recuperado de dichos tercero u otras personas como resultado de un juicio, arreglo o similar, incluso aunque dichos dineros no sean definidos como montos pagados por gastos m�dicos o reclamos. La Persona Asegurada acuerda suministrar dicha informaci�n y asistencia, as� como ejecutar y entregar todos los instrumentos necesarios, seg�n la Compa��a o su designado pueda solicitar, con el fin de facilitar la aplicaci�n de esos derechos de subrogaci�n, incluyendo, pero sin limitarse a, la ejecuci�n de un arreglo de subrogaci�n previo a los pagos de los beneficios bajo la p�liza, a la Persona Asegurada o en su nombre.
                      
                            </li>
            
                            
                        </ol>
           
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
    
    
    
     <p class="page_no">Page 46 of 52</p>
    
     <p>
             La Persona Asegurada no ceder� ni se exonerar� de ninguna parte de sus obligaciones a la Persona Asegurada o a la Compa��a, ni tomar� acci�n alguna que pueda perjudicar los derechos de subrogaci�n de la Compa��a. El ejercicio de la Compa��a de sus derechos de tomar cualquier acci�n que considere adecuada, en contra de terceras partes o personas, no afectar� el derecho de la Persona Asegurada de procurar otras formas de recuperaci�n.
                            <br> <br>
                           Si la Persona Asegurada o cualquiera actuando en su nombre no ha tomado acci�n sobre sus derechos ante terceras partes o personas para lograr un juicio, arreglo u otra restituci�n, la Compa��a o sus representantes, con 30 d�as de aviso a la Persona Asegurada, tendr� derecho de tomar acciones en nombre de la Persona Asegurada, para recuperar el monto de los Beneficios pagados bajo esta P�liza. Con tal de que, no obstante, dicha acci�n, tomada sin el consentimiento de la Persona Asegurada, no cause perjuicio alguno a dicha Persona Asegurada.
            </p>
            
            
            
                        <p>
                        El derecho de la Compa��a al reembolso tal como se establece aqu� ser� pagadero primero de las sumas recibidas de terceras partes u otras personas y dicho reembolso continuar� hasta que las obligaciones de la Persona Asegurada bajo esta p�liza sean saldadas por completo, incluso aunque la Persona Asegurada no reciba la indemnizaci�n completa o restituci�n por sus lesiones, da�os, p�rdidas o deudas. El derecho a Subrogaci�n existir� por lo tanto en todos los casos.
                        <br /><br />
                        Si la Persona Asegurada falla en cumplir con estos requerimientos, no ser� elegible de recibir ning�n beneficio, servicio o pago bajo esta P�liza, hasta que haya conformidad, sin importar que los Beneficios est�n relacionados con la acci�n u dichas terceras partes o personas u otras personas.
                        </p>
                        <ol style="font-size: 12px;" start="17">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Cambio de Residencia:   </span>La P�liza se har� nula e inv�lida a menos que la Compa��a reciba notificaci�n del cambio de Pa�s de Residencia de la Persona Asegurada, dentro de los 30 d�as siguientes a dicho cambio. Todos los t�rminos y condiciones de la P�liza quedan sujetos a revisi�n y aprobaci�n ante un cambio en el Pa�s de Residencia de la Persona Asegurada.
       
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">L�mites monetarios:  </span>
                          Los l�mites monetarios establecidos en esta P�liza y la Prima ser�n expresadas en d�lares de los Estados Unidos. Para servicios fuera de los l�mites territoriales de los Estados Unidos., la tasa de cambio usada para determinar el monto de d�lares de los Estados Unidos a ser pagados, es la tasa de cambio efectiva a la fecha en que se incurre en los gastos objeto del reclamo.
          
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Cesi�n: </span>
                         El Seguro provisto en esta P�liza no puede ser cedido, pero los Beneficios pueden ser pagados de acuerdo a lo establecido en el #3 Pago de Reclamos.
                            </li>
                            

                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Modificaci�n de Condiciones M�dicas previas a la emisi�n del certificado:   </span>
                         Cualquier condici�n que se manifieste entre la fecha de la firma de la Solicitud y la fecha en la cual la Cobertura es emitida, ser� considerada pre-existente y no ser� cubierta durante el periodo entero de la P�liza. Adicionalmente algunas condiciones que se manifiesten entre la fecha de la firma de la Solicitud y la fecha en la cual la Cobertura es emitida pueden afectar su elegibilidad para la Cobertura. 

                            </li>
       
                        </ol>
       
    
    
    <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
       
       
       
       
       
         <div class="">
          <p class="page_no">Page 47 of 52</p>
                 <ol style="font-size: 12px;" start="21">
                 
                 <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Planes colectivos:    </span>
                         Cuando esta p�liza sea parte de un plan colectivo o plan de beneficios de empleados, que reciba tarifas especiales de grupo, los individuos retirados y sus dependientes estar�n cubiertos en t�rminos a ser acordados por la Compa��a en escrito.
                            </li>
                            
                              <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">El Prop�sito de este plan:    </span>
                        Es cubrir individuos y grupos de trabajadores no manuales y sus dependientes (si corresponde) como personas aseguradas durante un periodo de seguro por concepto de gastos m�dicos incurridos por tratamientos de condiciones m�dicas, quir�rgicas y agudas, por parte de m�dicos, especialistas y hospitales.

                            </li>
                            
                            
                              <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Declaraciones en la Solicitud:  </span>
                         Cualquier declaraci�n o descripci�n hecha por la Persona Asegurada, o en su nombre, en la Solicitud es una declaraci�n y no una garant�a. Declaraciones falsas, omisiones, ocultamiento de hecho o declaraciones incorrectas pueden privarlo del Beneficio de pago bajo esta P�liza si uno de los siguientes aplica: a) las declaraciones falsas, omisiones, ocultamiento o afirmaci�n es falsa y/o fraudulenta, sea importante o no, a efectos de la Aprobaci�n de la Cobertura para la persona asegurada; b) si los hechos hubiesen sido conocidos por el Administrador o la Compa��a, previo a la emisi�n de la Cobertura, entonces el Administrador o la Compa��a no hubiesen emitido la Cobertura a la misma Prima, o hubiesen emitido un Endoso de Exclusi�n a la Cobertura bajo esta P�liza. <br> <br>
                        Cuando una declaraci�n falsa, omisi�n, ocultamiento de hecho, o declaraci�n incorrecta, tenga lugar en la solicitud, o en sus documentos m�dicos adjuntos, sin importar si la declaraci�n falsa, omisi�n, ocultamiento de hecho, o declaraci�n incorrecta se relacione con un inminente reclamo o no, la Compa��a puede escoger sea rescindir y anular la cobertura del Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no, y devolver toda la prima a su pagador, retroactivo a la Fecha Efectiva de Cobertura Individual original, o emitir una exclusi�n permanente para la condici�n particular pre-existente y negar el reclamo. En el caso que la cobertura sea rescindida al Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no , cualquier pago de reclamos realizados bajo la p�liza, desde la fecha efectiva, hasta la fecha de la rescisi�n, ser� aplicado a la devoluci�n de la prima que sea retroactiva a la Fecha efectiva. Si los pagos de reclamaciones exceden la devoluci�n de la prima, el Asegurado es responsable de reembolsar a la Compa��a el exceso de reclamaciones pagadas en un plazo de 30 d�as, o la Compa��a se reserva el derecho de proceder contra el Asegurado con cargos civiles y / o penales.

                            </li>
                            
                            
                      
                            
                            
                            
                              <li>Cl�usula de Limitaci�n y Exclusi�n de Sanciones: La Compa��a no ser� considerada para dar cobertura y la Compa��a no ser� responsable de pagar reclamaci�n alguna o proporcionar beneficios en la medida en que la prestaci�n de dicha cobertura, el pago de dicha reclamaci�n o la prestaci�n de dicho beneficio expondr�a a la Compa��a a una sanci�n, prohibici�n o restricci�n en virtud de las resoluciones de las Naciones Unidas o sanciones econ�micas, leyes o reglamentos de la Uni�n Europea, Reino Unido o Estados Unidos de Am�rica.

                            </li>
                 
                 
                    <li>Este seguro no est� sujeto a, y no proporciona algunos de los beneficios de seguro exigidos por La Ley de Protecci�n al Paciente de los Estados Unidos y la Ley de Asistencia Asequible ("ACA"). Este seguro no ofrece, y las aseguradoras no tienen la intenci�n de proporcionar, la cobertura m�nima esencial bajo ACA. En ning�n caso, los beneficios se proporcionar�n por encima de los especificados en el contrato de p�liza. Este seguro no est� sujeto a  
                    </li>
                    
                    
                 </ol>
 
       
       </div>
       
       
       
           <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    

    
    
         <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
       
       <div>
        <p class="page_no">Page 48 of 52</p>
       <p>
       condiciones de emisi�n o renovaci�n distinta a la prevista en el contrato de p�liza. ACA requiere que ciertos ciudadanos estadounidenses y residentes de Estados Unidos obtengan una cobertura de seguro de salud compatible al ACA. En algunas circunstancias, existen penas impuestas a tal persona o personas que no mantienen la cobertura conforme ACA. Cada persona asegurada debe consultar a su abogado o profesional de impuestos para determinar si los requisitos de ACA son aplicables a �l / ella.
       </p>
       
       
        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">Secci�n 7: Beneficios de viaje</h3>
                
                <p>
                    Todas las secciones de esta p�liza incluidas, pero no limitadas a aplicaci�n de definiciones, beneficios, exclusiones y provisiones, al menos que sean especificadas en la secci�n de beneficios de viaje como se muestra m�s abajo.
                </p>
                
                <p>
                    Beneficios de viaje se aplican mientras se encuentra viajando internacionalmente fuera del pa�s de residencia por m�s un m�ximo 60 d�as cada vez que se viaja.
                </p>
                
                <p>
                    24 horas, 7 d�as a la semana, 365 d�as al a�o.
                </p>
                
                <p>
                    Costos de Emergencia por enfermedad o accidente y gastos de hospital tienen un beneficio de $10,000. No deducibles o coaseguros se aplican. Para beneficios sobre los $10,000 se aplica el beneficio deducible y el coaseguro se aplicar� primero y luego los beneficios de la p�liza ser�n pagados como reclamo regular. Emergencia por enfermedad o receta m�dica por accidente de $300 no se aplicar�n deducibles o coaseguro por persona asegurada por el periodo de la p�liza.
                </p>
                
                <p>
                    Costos de Viajes ida y vuelta por miembro de familia quien asistir� al asegurado cuando sea ingresado en un hospital por m�s de 48 horas, ser�n de hasta $ 1,000 por persona asegurada por el periodo de la p�liza.
                </p>
                
                <p>
                    Costos por cuarto de hotel por miembro de la familia quien asistir� al asegurado cuando sea ingresado en un hospital por m�s de 48 horas ser�n de $ 100 por d�a con 10 d�as m�ximo por asegurado por periodo de p�liza el cual no incluir� servicio de comida u otro gasto de hotel adicional al costo normal por habitaci�n.
                </p>
                
                <p>
                    La repatriaci�n de un menor cuando el asegurado sea ingresado en el Hospital por m�s de 48 horas y no estuviere otro miembro de la familia para acompa�ar al menor es de hasta $ 2,500 por persona asegurada por el periodo de la p�liza.
                </p>
                
                <p>
                    Asistencia legal de $1,500 por asegurado por periodo de p�liza cuando el asegurado es arrestado, detenido o parte de un accidente de tr�nsito mientras viaja fuera del pa�s.
                </p>
                
                <p>
                    Beneficio de la completa y total p�rdida de equipaje es de un m�ximo de $1,200 por persona asegurada por periodo de p�liza se calculan como sigue: Pagados a $60 por KG a un m�ximo de 20 KG. No habr� reembolsos o beneficios pagados por art�culos con valores espec�ficos. Maletas deben ser chequeadas con una aerol�nea internacional que viaje de un pa�s a otro por personal autorizado de la aerol�nea. El asegurado debe viajar como 
  
                </p>
               
    
       
       </div>
       
       
       
       
       
       
       
       
       
           <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    
    
         <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
       
       <div>
       
        <p class="page_no">Page 49 of 52</p>
    
                <p>
                    pasajero en el mismo vuelo que las maletas. Para poder recibir los beneficios, la aerol�nea quien recibi� las maletas debe aprobar y pagar por la p�rdida completa del equipaje con pruebas de documentos de pago y pruebas de peso de la documentaci�n llenada en original a la Compa��a. P�rdida parcial o da�o parcial de las maletas no califican para ning�n beneficio bajo este beneficio de viaje.
                
                </p>
    
                <p>
                    Transmisi�n ilimitada de mensajes urgentes
                </p>
                <p>
                    Consulta m�dica ilimitada, informaci�n y referidos.
                </p>
                <p>
                   Emergencia por enfermedad se refiere a una condici�n m�dica que sea manifestada despu�s de haber dejado el pa�s de residencia, cualquier otra enfermedad o condici�n m�dica que sea manifestada antes de dejar el pa�s de residencia o <span style="border-bottom: 1px solid #000;">viaje en contra de las �rdenes del m�dico, </span>  recibir� la revisi�n del reclamo regular basado en el plan de la p�liza y no en los beneficios de viaje.
                </p>
                <p>
                    Emergencia por accidente se refiere a una causa externa por una condici�n m�dica que ocurri� despu�s de dejar el pa�s de residencia. Cualquier otro accidente que haya ocurrido antes de dejar el pa�s de residencia, recibir� la revisi�n del reclamo regular basado en el plan de la p�liza y no en los beneficios de viaje.   
                </p>
    

     </div>

           <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    
  








    
    
    ';
      
        //$strContent = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $strContent);
        //$strContent = htmlentities($strContent, 0, 'UTF-8');
        $output = htmlentities($strContent, 0, "UTF-8");
        if ($output == "") {
            $output = htmlentities(utf8_encode($strContent), 0, "UTF-8");
            $output = html_entity_decode($output);;
        }
        echo $output; ?>

    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;">
        <div class="common-page common-blank-page" style="padding-top: 180px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; opacity: 0;">

            <div>

                <p><strong>Cl&aacute;usula de Cobertura</strong></p>

                <p>
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compa��a" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compa��a, y cuyo nombre se identifica en la tarjeta de identificaci�n y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compa��a. La cobertura se brinda s�lo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los l�mites especificados en este documento y como se se�ala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta p�liza se emite basada en la informaci�n suministrada en la solicitud. Si alguna informaci�n en la solicitud no es correcta o est� incompleta, o cualquier otra informaci�n se ha omitido, la Compa��a a su discreci�n, revocara, cancelara o modificara los beneficios de la p�liza del Asegurado que omiti� informaci�n, as� como el Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no.
                </p>

                <p><strong>SECCI�N 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El t�rmino <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El t�rmino <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la p�rdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El t�rmino <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o c�nyuge debido a la p�rdida de vidas causada �nicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, as� como la p�rdida de las partes del cuerpo que se detallan en la Tabla de P�rdidas.
                </p>

                <p>
                    El t�rmino <b>"Addendum ":</b> se refiere a un documento a�adido a la p�liza por la Compa��a y ser� una parte de la p�liza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El t�rmino <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organizaci�n contratada con la Compa��a para proporcionar servicios de suscripci�n, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>


        </div>
    </div>

    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;">
        <div class="common-page common-blank-page" style="padding-top: 180px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; opacity: 0;">

            <div>

                <p><strong>Cl&aacute;usula de Cobertura</strong></p>

                <p>
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compa��a" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compa��a, y cuyo nombre se identifica en la tarjeta de identificaci�n y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compa��a. La cobertura se brinda s�lo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los l�mites especificados en este documento y como se se�ala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta p�liza se emite basada en la informaci�n suministrada en la solicitud. Si alguna informaci�n en la solicitud no es correcta o est� incompleta, o cualquier otra informaci�n se ha omitido, la Compa��a a su discreci�n, revocara, cancelara o modificara los beneficios de la p�liza del Asegurado que omiti� informaci�n, as� como el Asegurado Primario, C�nyuge y Dependientes, independiente que los otros Asegurados hayan omitido informaci�n o no.
                </p>

                <p><strong>SECCI�N 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El t�rmino <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El t�rmino <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la p�rdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El t�rmino <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o c�nyuge debido a la p�rdida de vidas causada �nicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, as� como la p�rdida de las partes del cuerpo que se detallan en la Tabla de P�rdidas.
                </p>

                <p>
                    El t�rmino <b>"Addendum ":</b> se refiere a un documento a�adido a la p�liza por la Compa��a y ser� una parte de la p�liza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El t�rmino <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organizaci�n contratada con la Compa��a para proporcionar servicios de suscripci�n, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versi�n en Ingl�s de la P�liza de Seguro ser� el documento oficial, esta es una traducci�n con car�cter informativo. �ltima revisi�n 6/26/2019.
            </p>


        </div>
    </div>

    <div class="wrapper footer" style="height: 1100px; max-width: 816px;margin: 0 auto; background-image: url('http://bdmonster.com/module-insurance-system/images/footer-pic.jpg'); background-repeat: no-repeat; background-size: cover;">
        <div class="banner-con footer" style="position: relative">
            <div class="last_cont">

                <ul>
                    <li>
                        <h2><?php echo $insuredName;?></h2>
                    </li>
                    <li>
                        <h3><?php echo $policyInfo['addressl1'];?></h3>
                    </li>
                    <li>
                        <h3><?php echo $policyInfo['addressl2'];?></h3>
                    </li>
                    <li>
                        <h3><?php echo $policyInfo['city'];?>, <?php echo $insuredCountry;?></h3>
                    </li>
                    <li>
                        <h3><strong>Policy # :</strong><?php echo $policyInfo['policynumber'];?></h3>
                    </li>
                    <li>
                        <h3><strong>Payment Period :</strong><?php echo dateFormFormat($policyInfo['paymentstart']);?> to <?php echo dateFormFormat($policyInfo['paymentend']);?></h3>
                    </li>
                    <li>
                        <h3><strong>Annual Major Medical Limit :</strong>$<?php echo $totalCoverage;?></h3>
                    </li>
                    <li>
                        <h3><strong>Annual Major Medical Deductible ICR :</strong>$0</h3>
                    </li>
                    <li>
                        <h3><strong>Annual Major Medical Deductible OCR : </strong> <?php echo $totalDeductible;?></h3>
                    </li>
                    <li>
                        <h3 style="margin-bottom: 10px;"><strong>Policy Mode : </strong> <?php echo $policyType;?></h3>
                    </li>
                </ul>
            </div>
        </div>
    </div>



</body>


<style>  
    
    
    
    .ol_list_con ol {
        list-style-type: lower-alpha;
    }


    th {
        padding: 15px 59px;
        border-bottom: 1px solid #000;

    }



    .table-one td {
        padding: 8px 10px;
    }

    .common-page p {
        text-align: justify;
    }

    .table-page-16,
    .table-page-17,
    .table-page-18 {
        border-collapse: collapse;
    }

    .table-page-18 {
        margin: auto;
    }

    .table-page-16 td,
    .table-page-17 td,
    .table-page-18 td {
        border: 3px solid #000;
        padding-left: 10px;
    }

    .table-page-18 th {
        border: 3px solid #000;
        padding: 5px 59px;

    }

    .table-page-16 th {
        padding-bottom: 28px;
        text-align: left;
    }

    .last_cont ul {
        color: #fff;
        list-style-type: none;
        padding: 20px 10px 0;
        border: 1px dashed #fff;
        margin: 20px 200px;
    }

    .last_cont {
        padding-bottom: 0;
        padding-top: 655px;
    }

    .last_cont ul li h3 {
        margin: 0;
        margin-bottom: 18px;
    }

    .last_cont ul li h2 {
        display: inline-block;
        margin: 0 0 20px;
    }

    .last_cont ul li {
        line-height: 1px;
        color: #fff;
    }

    .table-one th {
        padding: 10px 6px;
        /* width: 8px; */
    }


    @page {
        margin: 0;
    }

    .common-page {
        background-image: url('http://bdmonster.com/module-insurance-system/images/water-mark-common.jpg');
        background-repeat: no-repeat;
        background-size: contain;
        padding-left: 50px !important;
        padding-right: 50px !important;
        padding-top: 200px !important;
    }

    ol li {
        margin-bottom: 10px;
        font-family: 'courier';
    }
    
    ul li {
        font-family: 'courier';
    }
    
    h3{
        font-family: 'courier';
    }

    .wrapper-common {
        height: 1056px;
        position: relative;
        max-width: 816px !important;
    }


    .page-footer {
        position: absolute;
        bottom: 10px;
        margin: 0 !important;
        font-family: 'courier';
    }

    .common-blank-page p {
        opacity: 0;
        color: #fff;
        font-size: 0 !important;
    }

    .wrapper-common p {
        font-size: 12px;
        font-family: 'courier';
    }

    /*
    ol li{font-size: 11px}
    ul li{font-size: 11px}
*/

    .page_no {
        opacity: .4;
        margin: 0px;

        text-align: right !important;
        font-size: 10px;
        margin-right: 2px;
        margin-bottom: 20px;
        font-family: 'Calibri';



    }

    .p_6 p {
        margin-bottom: 10px;

    }

    .p_7 p {
        margin-bottom: 10px;

    }
</style>

</html>