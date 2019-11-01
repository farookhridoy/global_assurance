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
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compañía" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compañía, y cuyo nombre se identifica en la tarjeta de identificación y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compañía. La cobertura se brinda sólo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los límites especificados en este documento y como se señala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta póliza se emite basada en la información suministrada en la solicitud. Si alguna información en la solicitud no es correcta o está incompleta, o cualquier otra información se ha omitido, la Compañía a su discreción, revocara, cancelara o modificara los beneficios de la póliza del Asegurado que omitió información, así como el Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no.
                </p>

                <p><strong>SECCIÓN 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El término <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El término <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la pérdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El término <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o cónyuge debido a la pérdida de vidas causada únicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, así como la pérdida de las partes del cuerpo que se detallan en la Tabla de Pérdidas.
                </p>

                <p>
                    El término <b>"Addendum ":</b> se refiere a un documento añadido a la póliza por la Compañía y será una parte de la póliza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El término <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organización contratada con la Compañía para proporcionar servicios de suscripción, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
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
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compañía" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compañía, y cuyo nombre se identifica en la tarjeta de identificación y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compañía. La cobertura se brinda sólo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los límites especificados en este documento y como se señala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta póliza se emite basada en la información suministrada en la solicitud. Si alguna información en la solicitud no es correcta o está incompleta, o cualquier otra información se ha omitido, la Compañía a su discreción, revocara, cancelara o modificara los beneficios de la póliza del Asegurado que omitió información, así como el Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no.
                </p>

                <p><strong>SECCIÓN 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El término <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El término <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la pérdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El término <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o cónyuge debido a la pérdida de vidas causada únicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, así como la pérdida de las partes del cuerpo que se detallan en la Tabla de Pérdidas.
                </p>

                <p>
                    El término <b>"Addendum ":</b> se refiere a un documento añadido a la póliza por la Compañía y será una parte de la póliza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El término <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organización contratada con la Compañía para proporcionar servicios de suscripción, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
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
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compañía" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compañía, y cuyo nombre se identifica en la tarjeta de identificación y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compañía. La cobertura se brinda sólo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los límites especificados en este documento y como se señala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    Esta póliza se emite basada en la información suministrada en la solicitud. Si alguna información en la solicitud no es correcta o está incompleta, o cualquier otra información se ha omitido, la Compañía a su discreción, revocara, cancelara o modificara los beneficios de la póliza del Asegurado que omitió información, así como el Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no. 
                </p>
                
                <h3 style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCIÓN 1: DEFINICIONES DE CERTIFICADO</h3>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Accidente o Accidental"</span> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Cobertura por Muerte Accidental"</b></span> ser refiere a la cobertura incluida en este Certificado debido a la pérdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b></span> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o cónyuge debido a la pérdida de vidas causada únicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, así como la pérdida de las partes del cuerpo que se detallan en la Tabla de Pérdidas.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Addendum ":</b></span> se refiere a un documento añadido a la póliza por la Compañía y será una parte de la póliza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>
                
                <p style="margin-bottom: 20px; font-size: 12px;">
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>"Administrador"</b></span> se refiere a Global Assurance Group, Inc., la organización contratada con la Compañía para proporcionar servicios de suscripción, administrativos y pago de reclamos en virtud de este Certificado.
                </p>
                
            </div>
            
            <p class="page-footer" style="opacity: .4; margin-top: 30px; bottom: 20px !important;">
                La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
       
       
        </div>
      </div>
      
      <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 220px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; position: relative;">
       
            <div class="p_6">
            <p class="page_no">Page 6 of 52</p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Admisión"</span> se refiere a la aceptación oficial por un hospital u otro establecimiento de atención hospitalaria de un paciente que va a contar con alojamiento, comida y servicio de enfermería continua en un área del hospital o centro donde los pacientes permanecen al menos durante la noche. Una visita a la sala de emergencia o en una clínica sin un servicio de admisión de 24 horas con camas y enfermeras no será considerada como una Admisión. 
                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Agente"</span> se entenderá como el agente de seguros, corredor o productor, si hubiese alguno relacionado con la petición de la solicitud, que actúa únicamente como agente legal y representante de los intereses personales del Asegurado y como tal no tiene autoridad para hablar en nombre de la Compañía, recibir pagos a su nombre o nombre de su empresa y no está actuando como agente o representante legal de la Compañía.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Abuso de Alcohol o Drogas"</span>, se refiere a cualquier patrón de uso patológico de alcohol o drogas que causa deterioro en el funcionamiento social o laboral, o que produce la dependencia fisiológica y demuestra la tolerancia física o de síntomas físicos cuando se retira.
                </p>
               
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Anexo"</span> se refiere a un documento añadido a la póliza por la Compañía y que detalla una cobertura opcional.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Solicitud"</span> se refiere al formulario de inscripción oficial expedido por el Administrador, que debe ser completado, fechado y firmado por cada solicitante (o tutor legal para solicitantes que son menores de edad) y todos los adjuntos y / o documentos relativos a la información de suscripción de cada solicitante que figuran en la Solicitud.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Aprobado o aprobación"</span> se entenderá como la determinación final del Administrador de otorgar cobertura, con o sin cláusulas de exclusión y / o un aumento de la prima de la Persona Asegurada, después que el Administrador ha recibido y revisado la solicitud además de toda la información de suscripción solicitada.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Mamograma de Referencia"</span>, se entenderá como una mamografía de detección que se utiliza como una comparación para exámenes futuros.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Certificado o póliza":</span> se entenderá como el resumen de los términos de cobertura, que incluye: este
                    documento, la solicitud de la persona asegurada y los endosos, exclusiones o enmiendas que
                    se concederán durante el Período de cobertura de la Persona Asegurada.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Hijo"</span> se entenderá como el hijo natural, hijastro o un hijo menor bajo la tutela legal del Asegurado Primario, pero sólo si ese niño depende del apoyo y manutención del Asegurado Primario y vive con el Asegurado Primario en una relación de padre-hijo. 
                </p>
                <p>
                    El término Hijo no incluye a un hijo adoptivo que es elegible para beneficios proporcionados por un programa gubernamental o la ley, a menos que sea requerido por la ley del Estado.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Clase"</span> se entenderá un grupo de personas aseguradas que comparten características comunes a criterio de la Compañía, incluyendo, pero no limitado al tipo de plan, deducible, grupo demográfico, región geográfica, empleador o industria de clasificación.
                </p>
            
            
            
           </div>
           
            <p class="page-footer" style="opacity: .4; bottom: 20px !important;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
            
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 220px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; position: relative;">
       
            <div class="p_7">
            
            <p class="page_no">Page 7 of 52</p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"><b>“Coaseguro” </b></span> se refiere al porcentaje de los Beneficios Elegibles, después del Deducible, el cual es responsabilidad de cada Persona Asegurada y debe ser pagado por esta antes que los Beneficios de esta Póliza lleguen a ser pagaderos por la Compañía. El monto del Coaseguro se declara en la Tabla de Beneficios. 
                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Compañía"</span> se refiere a Claria Life and Health Insurance Company, la organización que proporciona la Cobertura bajo los términos de la presente póliza
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Complicaciones del Embarazo"</span> se refiere a cualquiera o a todas de las siguientes condiciones que puedan empeorar, debido al Embarazo, o que puedan ocurrir durante este o que sean causadas por este: nefritis aguda, nefrosis, descompensación cardiaca, aborto incompleto, hiperémesis gravídica, Embarazo ectópico terminado, cesárea medicamente necesaria, pre eclampsia, diabetes gestacional, cese espontáneo del Embarazo, que ocurre cuando el nacimiento no es viable, y otros problemas Médicos de similar severidad.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Consulta"</span>, se refiere a una visita o sesión con un Médico o Proveedor de Servicios Médicos.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Congénito"</span> o <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Defecto de Nacimiento"</span>, se refiere a cualquier anomalía, deformidad, enfermedad, o lesión al nacer, ya sea diagnosticada o no. Se incluyen en la definición condiciones hereditarias, cualquier anormalidad, deformidad, enfermedad que ha sido transmitida a través de generaciones en cualquier persona de la familia del asegurado que no sea multifactorial o poligénica.
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Convaleciente"</span> se refiere al Tratamiento, servicios y suministros necesarios para asistir en la recuperación de un paciente para llegar a un cierto grado de funcionamiento corporal que le permita a sí mismo la ejecución de las actividades vitales básicas diarias.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Centro de Cuidado para el Convaleciente”</span> se refiere a un establecimiento, o a una parte distintiva de este, que reúna las siguientes características: a) Posee licencia para suministrar y ocuparse de proveer a Pacientes Internos convalecientes como resultado de una Lesión o Enfermedad, servicios profesionales de enfermería proporcionados por un(a) Enfermero(a) licenciado(a) actuando bajo la supervisión de un(a) Enfermero(a) Certificado(a), servicios de fisioterapia para asistir a los pacientes para alcanzar un grado de desempeño físico que les permita actuar con autonomía durante las actividades vitales cotidianas esenciales. b) Sus servicios son proporcionados a cambio de una remuneración por parte de sus pacientes y para pacientes ingresados por menos de 24 horas (ambulatorios), provee supervisión a tiempo completo de un Médico o un Enfermero(a) Certificado(a). c) Mantiene un registro Médico completo de cada paciente y muestra un empleo efectivo de un plan de evaluación. El Centro de cuidado para el convaleciente no incluye instalaciones de reposo, tercera edad, uso y abuso indebido de drogas, guardería, cuidado de enfermería, o para la atención de personas con trastornos mentales o nerviosos o los mentalmente incompetentes.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cobertura"</span> se refiere a los Beneficios Elegibles descritos en esta Póliza, para los cuales la Persona Asegurada es elegible, ya sea para ser reembolsada por la Compañía o para el pago directo por tratamiento y servicios al Proveedor Médico.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Período de Cobertura”</span> se refiere al periodo comprendido entre la Fecha Efectiva de Cobertura Individual y la Fecha Efectiva de Terminación de Cobertura de esta póliza.
                </p>
            
            
            
           </div>
           
            <p class="page-footer" style="opacity: .4; bottom: 20px !important;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
            <p class="page_no">Page 8 of 52</p>
            
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Siniestro Cubierto o Accidente Cubierto"</span>, se refiere a los gastos cubiertos por una enfermedad o un accidente por lesiones corporales que requieran tratamiento médico por un proveedor de servicios, tal como se definen en la presente póliza.
                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Gastos cubiertos"</span> se refiere a los gastos por servicios Médicamente Necesarios, suministros, cuidados o Tratamiento por causa de una Enfermedad o Lesión, de acuerdo a lo definido en esta Póliza, prescritos, realizados u ordenados por un Médico licenciado y/o un Proveedor de Servicio Médico; los cargos Razonables y Acostumbrados, en los que la Persona Asegurada hubiese incurrido, dentro del Periodo de Cobertura, los cuales son: 1) aquellos enumerados en la Tabla de Beneficios, 2) aquellos que no forman parte de las Exclusiones y 3) aquellos que no excedan los límites máximos establecidos en la Tabla de Beneficios.
                <p>
                   No califican para estar cubiertos bajo esta póliza todos aquellos gastos médicos en los que se incurriere como resultado de gastos médicos no cubiertos, incluyendo odontología, cirugía plástica, u otros procedimientos y gastos excluidos en las Exclusiones no serán elegibles para ser cubiertos bajo esta póliza
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cuidados de Custodia"</span> se refiere al tipo de cuidado suministrado principalmente con el propósito de asistir a la persona en las actividades cotidianas o en satisfacer básicamente necesidades personales más que médicas y que no tiene que ver específicamente con Tratamiento de una Enfermedad o Lesión. Es el tipo de cuidado del cual no se puede esperar que mejore sustancialmente una condición médica y tiene el mínimo valor terapéutico, sea que esté totalmente incapacitado o no para realizar actividades vitales cotidianas.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">“Citología"</span>, se refiere al examen ginecológico (Papanicolaou) realizado para diagnosticar cáncer cervical, a través del estudio microscópico de las células raspadas de la superficie del cuello uterino.
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Deducible"<span> se refiere a la cantidad de los Beneficios Elegibles que es responsabilidad de cada Persona Asegurada y que debe ser pagada por la misma, antes que los Beneficios de esta Póliza sean pagaderos por la Compañía.
                </p>
                <p>
                    
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Beneficio Dental"<span> se entenderá el tratamiento para arreglar o reemplazar los dientes naturales después de un accidente cubierto.

                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Dentista"</span> se refiere a un médico con licencia legal de cirugía dental, odontología o la ciencia odontológica. Un higienista dental que trabaje a través de su licencia, bajo la supervisión de un dentista, será un proveedor cubierto.

                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Dependiente"</span> se refiere al cónyuge legalmente casado con la Persona Asegurada Principal o cuando dos personas que están aplicando bajo la póliza viven juntas. Al Hijo(a) natural o legalmente adoptado(a) soltero(a) de la Persona Asegurada Principal, desde los catorce (14) días de edad hasta su décimo noveno (19º.) cumpleaños; o al Hijo(a) soltero(a) con al menos diecinueve (19) años de edad, pero menor de veinticuatro (24) años, y matriculado como Estudiante a Tiempo Completo en un Colegio o Universidad acreditada y que no sea empleado(a) a tiempo completo. Los límites de edad que se aplican a el (los) Hijo(s) Dependiente(s) no se aplicarán a ningún Hijo(s) asegurado de la Persona Asegurada Principal que dependa de esta para su sustento y manutención porque se encuentre imposibilitado de trabajar a consecuencia de un impedimento físico o retardo mental, que ocurriese antes de alcanzar la edad límite y mientras estuviese asegurado por esta póliza.
                </p>
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
            
            <p class="page_no">Page 9 of 52</p>
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Afección"</span> se refiere a cualquier condición o enfermedad que figuran en la edición más reciente de la Clasificación Internacional de Enfermedades o una condición aceptada y reconocida como una enfermedad o lesión reconocida por la Asociación Médica Americana.
                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">“Terapia Educacional, De Rehabilitación, Vocacional, Ocupacional, Física, del Habla, de Recreación”</span> se refiere a los cuidados dados después de una Enfermedad o Lesión con el fin de restablecer, sea mediante adiestramiento o bien mediante entrenamiento, la capacidad para desempeñarse de una manera normal o casi normal. Si los límites están incluidos en la Tabla de beneficios, estas deben ser aprobadas previamente por el Administrador o el siniestro será denegado. 
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Fecha Efectiva"</span> se refiere a la fecha en que la Cobertura de esta Póliza comienza. Después de la revisión y aprobación de cada Solicitante por parte del Administrador, la Cobertura comenzará a ser efectiva en la última de las siguientes fechas: (1) la fecha en la cual la Solicitud y la Prima correcta son recibidas por el Administrador, o 2) la fecha en que el Solicitante es Aprobado por el Administrador.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Beneficios Elegibles"</span> se refiere a los gastos por servicios Médicamente Necesarios, suministros, cuidados o Tratamiento, por causa de una Enfermedad o Lesión, prescritos, realizados u ordenados por un Médico licenciado y/o un Proveedor de Servicio Médico; los cargos Razonables y Acostumbrados; en los que la Persona Asegurada hubiese incurrido dentro del Periodo de Cobertura, los cuales son: 1) aquellos enumerados en la Tabla de Beneficios, 2) aquellos no excluidos en las Exclusiones y 3) aquellos que no excedan los límites máximos establecidos en la Tabla de beneficios.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Emergencia"</span> se refiere a una condición médica manifestada con señales o síntomas agudos, la cual podría resultar en poner en peligro la vida o miembros de la Persona Asegurada, a menos que se proporcione atención médica en un lapso de 24 horas.
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Evacuación Médica de Emergencia / Repatriación”</span> significa que el Médico Legalmente Calificado local y la empresa de asistencia de viaje autorizada han determinado por escrito que el Asegurado se encuentra en condiciones de ser transportado y que el transporte a un hospital o centro médico es médicamente necesario para tratar una enfermedad o lesión inesperada que pone en peligro la vida y que el tratamiento médico adecuado no está disponible en el área inmediata. Los gastos de transporte incurridos serán pagados de acuerdo a los cargos usuales, acostumbrados y razonables para el transporte al hospital más cercano o centro médico capaz de proporcionar ese tratamiento.
                </p>
                <p>
                    
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Experimental / En Investigación y/o de Estudio”</span> se refiere a Tratamiento, medicamento, dispositivo, procedimiento, suministro, servicio o afines (o una parte de ello, incluyendo la clase, administración o dosis) para un diagnóstico o condición particular, cuando se dé una de las siguientes situaciones:

                </p>
                
                <ol style="font-size:12px;">
                    <li>El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio esté bajo ensayo clínico o en ensayo de Fase I, II o III.</li>
                    <li>El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio no ha sido totalmente Aprobado o reconocido por la agencia gubernamental pertinente o por una organización profesional tal como la American Medical Association, National Cancer Institute y Food &amp; Drug Administration.</li>
                    <li>Los resultados que no han sido probados en ensayos clínicos controlados, ni publicados en reconocidas publicaciones Médicas revisoras en inglés, en el sentido de ser más Seguros y eficaces que el Tratamiento convencional, tanto en corto como a largo plazo.</li>
                </ol>
                
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
                <p class="page_no">Page 10 of 52</p>
                
                <ol style="list-style-type: none; font-size:12px;">
                    <li>4.	El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio no es de práctica médica aceptada de manera general en el estado o País de Residencia de la Persona Asegurada o no es aceptada de manera general en toda la comunidad médica relevante, según una o más de las siguientes referencias: literatura médica revisada en Inglés, consulta con otros Médicos, compendio médico autorizado, la American Medical Association, u otras organizaciones profesionales o las agencias gubernamentales pertinentes.</li>
                    <li>5.	El Tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio es descrito como experimental, de carácter investigativo, un estudio, o destinado a investigación o similar, en cualquier consentimiento, liberación o autorización que la Persona Asegurada, o alguien actuando en su nombre, deba firmar</li>
                </ol>
            
             
                <p>
                   El hecho que el tratamiento, medicamento, dispositivo, procedimiento, suministro o servicio sea la única esperanza de supervivencia de la Persona Asegurada no implica que deje de ser de carácter experimental, investigativo, o destinado a investigación.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Estudiante a tiempo completo"</span> es la persona matriculada en al menos 12 horas crédito de estudio.
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"País de Origen o País de Residencia"</span> se refiere al país donde la Persona Asegurada ha tenido por más de 9 meses de un año de póliza, su residencia fija y permanente. El Asegurado es responsable de notificar al Administrador de cambio de país en los primeros 30 días que el cambio se realice o la póliza será cancelada a discreción del Administrador.
                </p>
                <p>
                    
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Agencia de Cuidados a Domicilio”</span> se refiere una agencia pública o privada, o a una de sus subdivisiones la cual opera de acuerdo a la ley, y que está dedicada regularmente a proveer Cuidados de Enfermería a domicilio bajo la supervisión de un(a) Enfermero(a) Certificado(a), y que mantiene un registro diario de cada paciente, con un programa de observación y Tratamiento planificado por un médico, de acuerdo con los estándares establecidos de práctica médica.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">“Cuidados a Domicilio”</span> se refiere a los servicios que ofrece una Agencia de Cuidados a Domicilio, y que son supervisados por un(a) Enfermero(a) Certificado(a), dirigidos al cuidado personal del paciente; siempre que esa atención sea médicamente necesaria y deba ser previamente aprobada por el Administrador o el reclamo será negado. Cuidados a domicilio no aplican para beneficios de maternidad.


                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Hospicio"</span> se refiere al plan coordinado de cuidados a domicilio, hospitalización y ambulatorios para dar servicios médicos paliativos, sustentadores y otros, a pacientes enfermos terminales- que se define como tener un pronóstico de 6 meses o menos. Un equipo multidisciplinario presta cuidados continuos y planificados, cuyo componente médico dirigido por un Médico. El cuidado estará disponible 24 horas al día, siete días a la semana. El Hospicio debe cumplir con los requerimientos legales de la localidad donde opere. 
                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Hospital"</span>, se refiere a un establecimiento que: 1) opera legalmente con el propósito de ofrecer cuidado y Tratamiento Médico a personas Enfermas o Lesionadas, a las cuales se les cobra una suma que la Persona Asegurada está legalmente obligada a pagar, a falta de un Seguro 2) presta dicho cuidado o Tratamiento Médico en sus instalaciones médicas, quirúrgicas o de diagnóstico, en sus propios locales o en aquellos preparados para tal uso. 3) ofrece 24 horas de servicio de enfermería bajo la supervisión de un(a) Enfermero(a) Certificado(a) a tiempo completo 4) opera bajo la supervisión de un equipo de uno o más Médicos. El Hospital también se refiere a 
                </p>
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
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
                    <li>establecimientos u hogares para Convalecientes, servicios de enfermería o reposo, ni un albergue geriátrico.</li>
                    <li>un lugar que preste principalmente cuidados en las áreas de Guardería, Adiestramiento o Rehabilitación; o </li>
                    <li>un establecimiento destinado principalmente para el Tratamiento de drogadictos o alcohólicos.</li>
                </ol>
            
             
              
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermedad"</span> se refiere a una Dolencia o Padecimiento de cualquier índole, listada en la edición más reciente de la International Classification of Diseases.
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Incidente"</span>, se refiere a que todas las Enfermedades que existan simultáneamente y que se deban a la misma causa o a causas relacionadas con ella, son consideradas como un Incidente. Además, si una Enfermedad se debe a causas que son las mismas o se relacionan a causas de una Enfermedad anterior, la Enfermedad se considerará una continuación de dicha Enfermedad anterior, y no un Incidente separado. Todas las lesiones debidas por el mismo accidente se considerarán un incidente.
                </p>
                <p>
                    
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Lesión"</span> se refiere a una Lesión física enumerada en la más reciente edición de International Classification of Diseases y causada sola y directamente por medios Accidentales, externos y visibles, acaecidos durante la vigencia de la presente Póliza, y resultantes directa e independientemente de todas las otras causas, que produzca un Siniestro Cubierto por esta.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Paciente Hospitalizado"</span> se refiere una persona que sea admitida o confinada en una institución por un período de 24 horas o más y a la cual se le cobra por habitación y comida.


                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Seguro"</span>, se refiere a la cobertura descrita y prevista en virtud de la presente póliza.
                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Persona Asegurada(s) o Asegurado"</span> se refiere a una persona elegible para obtener Cobertura bajo esta Póliza, como se establece en la Credencial de Identificación, quien ha solicitado Cobertura y es nombrada en la Solicitud y para quien la Compañía ha Aprobado Cobertura y aceptado la Prima correspondiente. Esta puede ser la Persona Asegurada Principal o los Dependientes.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Unidad de Cuidados Intensivos o Coronarios”</span> se refiere a una unidad de cuidados cardíacos u otra área o unidad de un Hospital la cual reúna los requerimientos estándar de la Joint Commission on Accreditation of Hospitals for Special Care.
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">" Error Médico "</span> se refiere a un error profesional incluyendo, pero no limitado a un error u omisión de cualquier médico, enfermera, cirujano, dentista, asistente médico, técnico, farmacéutico u otro profesional de la medicina. Error médico comprenderá también, pero no se limitará, a la prestación o falta de brindar servicio médico, profesional o tratamiento y omisión por parte de un proveedor de atención de salud en el que el tratamiento cae por debajo de las normas aceptadas de la práctica en la comunidad médica y causa lesiones o muerte para el paciente.
                </p>
        
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 12 of 52</p>
                 <p>
                 El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Médicamente Necesario o Necesidad Médica”</span> se refiere a aquellos servicios, Tratamientos o suministros recibidos por la Persona Asegurada que la Compañía determine que son: 1) apropiados y necesarios para los síntomas, diagnóstico o Tratamiento de cuidado directo de las condiciones médicas de la Persona Asegurada; 2) dentro de las normas de la comunidad médica organizada considere una buena práctica médica para la condición de la persona asegurada; 3) no prestados sólo con fines educativos o principalmente para conveniencia de la Persona Asegurada, de su Médico o de alguna otra persona o Proveedor de Servicios; 4) no Experimental / En Investigación o de estudio; y 5) no excesivo en alcance, duración o intensidad para proveer un Tratamiento Seguro, adecuado y apropiado.
                </p>
                
                <p>
                    Por Hospitalización se entiende que la atención aguda de la Persona Asegurada es necesaria debido a los tipos de servicios que la Persona Asegurada recibe o a una gravedad tal de la condición de la Persona Asegurada, que no puede administrarse el cuidado adecuado y seguro de manera Ambulatoria o en un establecimiento menos especializado.
                </p>
                
                <p>
                    El hecho que un Médico en particular pueda prescribir, ordenar, recomendar, o aprobar un servicio, tratamiento, suministro o nivel de cuidado, no hace dicho Tratamiento Médicamente Necesario ni convierte los cargos en Gastos Cubiertos bajo esta Póliza.
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Medicina o Medicación”</span> se refiere a los fármacos y/o anestésicos prescritos por un Médico, y dispensados a la Persona Asegurada por un farmaceuta licenciado como resultado de un Gasto Cubierto. Medicina o Medicación se refiere al equivalente genérico de un fármaco, o si el equivalente genérico no está disponible, el fármaco de marca. Medicina o Medicación sólo significará fármacos prescriptibles.
                </p>
                <p>
                    
                  El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermedad Mental”</span> se refiere a desórdenes, Enfermedades o condiciones Mentales, emocionales y psiquiátricas, (sean de origen orgánico o inorgánico, biológico o no-biológico, genético, químico o no-químico). Los desórdenes Mentales o nerviosos incluyen, pero no se limitan a psicosis, trastornos neuróticos, trastornos bipolares, desórdenes afectivos; desórdenes de personalidad, anormalidades sicológicas o de conducta, asociados con disfunción transitoria o permanente del cerebro o de los sistemas neuro-hormonales; y condiciones, desórdenes y Enfermedades enumerados en la más reciente edición de Diagnostic and Statistical Manual of Mental Disorders IV-R o en la edición más reciente de International Classification of Diseases a la fecha en que el servicio médico o el Tratamiento es aplicado a una Persona asegurada.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Paciente Ambulatorio”</span> se refiere una persona que recibe cuidados en un Hospital u otra institución, incluyendo centros de Cirugía Ambulatoria; instalaciones de enfermería para convalecencia o cuidados especializados; o consultorio del Médico, adonde se acude por Enfermedad o Lesión, pero donde no se es internado o recluido por un periodo de 24 horas, y donde no se cobra habitación y comida.

                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Residencia Permanente"</span> se refiere al país donde la Persona Asegurada ha estado más de 9 meses durante el periodo de la póliza anual, o su verdadero, fijo y permanente hogar y establecimiento principal, al cual la Persona Asegurada tiene intenciones de regresar.
                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Médico o Doctor"</span> se refiere a un doctor en medicina o a un doctor en osteopatía, licenciado para prestar servicios médicos o realizar cirugías, de conformidad con las leyes de la jurisdicción en la cual tales servicios profesionales son realizados.
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 13 of 52</p>
                 <p>
                El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">“Condición Pre-existente”</span> se refiere a cualquiera de las siguientes: 1) Una condición que habría causado que una persona buscase consejo Médico, diagnóstico, cuidado o Tratamiento antes de la Fecha Efectiva Individual de Cobertura de esta Póliza, 2) una condición por la cual se buscó, recomendó o recibió consejo médico, diagnóstico, cuidado o Tratamiento, incluyendo medicación, antes de la Fecha Efectiva Individual de Cobertura bajo esta Póliza; 3) los síntomas manifestados antes de la Fecha Efectiva Individual de Cobertura bajo esta Póliza, le hubieran permitido a una persona entrenada en Medicina hacer un diagnóstico de la condición que produjo los síntomas; 4) una condición que se manifiesta antes de la fecha efectiva en virtud de este Certificado de Cobertura individual. 5) Los gastos de Embarazo incluyendo, antes, después del nacimiento, complicaciones del nacimiento tanto para la madre como para el recién nacido dentro de los doce (12) meses desde la Fecha Efectiva Individual de Cobertura bajo esta Póliza. 
                </p>
                
                <p>
                   El Administrador puede emitir Cláusulas de Exclusión para ciertas Condiciones Preexistentes. Las Condiciones Pre-existentes que sean declaradas de manera precisa y completa en la Solicitud, y que sean aprobadas y aceptadas por el Administrador sin una Cláusula de Exclusión u otra restricción, estarán cubiertas automáticamente al mínimo de hasta un máximo vitalicio de $50.000 con un límite de $5.000 por Periodo de Cobertura, una vez que la Persona Asegurada haya estado continuamente asegurada por 24 meses.
                </p>
                
                <p>
                    En el momento de la solicitud y a discreción del Administrador, beneficios inmediatos con aumento de límites pueden ser ofrecidos.
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Organización de Proveedor Preferido (PPO)"</span> se refiere a los hospitales aprobados, médicos u otros proveedores de servicios que han entrado en un acuerdo contractual con la Compañía para prestar servicios hospitalarios y servicios médicos a las personas aseguradas a honorarios negociados.
                </p>
                <p>
                    
                 El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Embarazo o la Maternidad"</span>, se refiere a la condición física de estar embarazada, incluyendo las complicaciones del embarazo.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Prima"</span> se refiere a la suma de dinero correspondiente, en Dólares Estadounidenses, cargada por la Compañía, y cobrada por el Administrador, por la Cobertura que ofrece esta Póliza, la cual se aplica a la edad de la Persona Asegurada, según el género, deducible, límite máximo y cualquier condición médica de la Persona Asegurada, por los cuales el Administrador cobra periódicamente para mantener la Cobertura bajo esta póliza.

                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Pre-Notificación y Pre-Notificar”</span> significan que la Persona Asegurada notifica al Administrador, por adelantado, sobre cualquier admisión hospitalaria en cualquier parte del mundo, o sobre cualquier Cirugía Ambulatoria o Beneficios Elegibles que vayan a exceder los $1.000. El proceso de Pre-Notificación estará completo después que la Persona Asegurada reciba Tratamiento o servicios en la Red de Proveedores de su preferencia, a la cual la Persona Asegurada pueda tener acceso, y que confirme que tal ingreso es Médicamente necesario.
                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Prescripción de Medicamentos"</span> se refiere a los medicamentos cuya venta y uso son restringidos a la orden de un médico. 
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Persona Principal Asegurada"</span> se refiere a la persona en la solicitud, quien aparece como el Asegurado Principal, y que pueden tener dependientes, quienes son personas aseguradas.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Razonables y Acostumbrados”</span> se refiere a la cantidad máxima que la Compañía determina que es Razonable y Acostumbrada para los Beneficios Elegibles que la Persona Asegurada recibe, hasta los cargos 
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 14 of 52</p>
                 <p>
                realmente facturados y sin excederlos. La determinación de la Compañía considera: 1) los montos cobrados por otros Proveedores de Servicios por el mismo servicio o uno similar; 2) cualquier circunstancia médica inusual que requiera tiempo, habilidad o experiencia adicionales; y 3) el costo que para el Proveedor de Servicio representa prestar los servicios o suministros, o realizar el procedimiento; y 4) otros factores que la Compañía determine son relevantes, incluyendo un recurso basado en la escala relativa de valores, peso sin limitarse a este.
                </p>
                
                <p>
                   Para un Proveedor de Servicio que tenga un acuerdo de reembolso con la Compañía, el cargo Usual y Acostumbrado es igual al monto que constituya pago total bajo cualquier acuerdo de reembolso con la Compañía.
                </p>
                
                <p>
                    Si un Proveedor de Servicio acepta como pago total una cantidad menor que la tasa negociada bajo un acuerdo de reembolso, la cantidad menor será el máximo cargo Razonable y acostumbrado.
                <p>
                   El cargo Razonable y Acostumbrado será reducido debido a cualquier sanción de la cual un Proveedor de Servicio sea responsable, como resultado de ese acuerdo del Proveedor de Servicio con la Compañía.
                </p>
                <p>
                    
                 El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermero(a) Certificado(a)”</span> se refiere a un(a) enfermero(a) graduado(a) que ha sido certificado(a) o licenciado(a) para ejercer por un Consejo Estatal de Examinadores de Enfermería o de otra autoridad jurisdiccional, y quien está legalmente autorizado(a) para colocar las iniciales <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">“R.N.”</span> después de su nombre.

                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Familiar”</span> significa cónyuge, padre, hermanos, Hijo(a), abuelos, nietos, padres adoptivos, Hijos adoptivos, hermanastros, familiares políticos (suegra, nuera, yerno, cuñado, cuñada), tío(a), sobrino(a), representante legal, pupilo o primo de la Persona Asegurada.

                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Repatriación"</span> se refiere al traslado de la Persona Asegurada hasta su País de Residencia.
                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Rescindir o Rescisión de la Póliza”</span> o <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">“Nulo”</span> o <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">“Cancelado”</span> se refiere a la terminación del Asegurado que omitió información, así como el Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no, con efecto retroactivo a la Fecha Efectiva Individual de Cobertura, como resultado de haber sometido información inexacta u omisión de hechos en la Solicitud o adjunta a las declaraciones de salud que no cumplan con los requisitos de elegibilidad. Sin importar que la información inexacta de la solicitud o declaración esté relacionada con un siniestro cercano, la Compañía, a su discreción, elegirá entre cancelar la póliza, y devolver al pagador toda la Prima retroactiva a la Fecha Efectiva Individual de Cobertura original, o emitir una exclusión permanente para la Condición Pre-existente y negar el reclamo. En el caso que una póliza se anule, cualquier reclamo de pago efectuado en la póliza a partir de la fecha de entrada en vigor hasta la fecha en que la póliza es revocada, se aplicará hacia la devolución de la prima. Si los pagos de reclamaciones exceden la devolución de la prima, el Asegurado es responsable de reembolsar a la Compañía el exceso de reclamaciones pagadas en un plazo de 30 días, o la Compañía se reserva el derecho de proceder contra el Asegurado con cargos civiles y / o penales. 
                </p>
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cláusula de Exclusión"<span> se refiere a la Aprobación de la Persona Asegurada para obtener Cobertura, pero serán excluidos los Gastos Cubiertos para ciertas condiciones médicas o Tratamientos, en forma escrita, por parte del Administrador.

                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Mamografía”</span> se refiere al estudio radiográfico de baja dosis usado para visualizar la estructura interna de los senos.
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 15 of 52</p>
                 <p>
                El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Proveedor de Servicios o Proveedor":</span> se refiere a un Hospital, Hospicio, Convalecientes / centro de enfermería especializada, centro quirúrgico ambulatorio, hospital psiquiátrico, centro de salud mental de la comunidad, instalaciones para Tratamiento psiquiátrico, centro para el Tratamiento de la dependencia de drogas y alcohol, centro de maternidad, Médico, Odontólogo, quiropráctico, auxiliar médico licenciado, enfermero(a), laboratorio médico, Compañía de servicio auxiliar, firma de ambulancia aérea o terrestre o cualquier otra instalación afín que la Compañía apruebe para proporcionar servicios según la póliza.
                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Accidente grave"</span> se refiere a un trauma repentino que ocurre sin la intención del asegurado; implica una causa externa e impacto violento en el cuerpo, resultando en una lesión grave que requiere atención hospitalaria demostrable e inmediata dentro de las primeras horas después de un traumatismo accidental para evitar la pérdida de la vida o la integridad física. La existencia de una lesión accidental grave será determinada de común acuerdo entre el médico tratante y el consultor médico de la Compañía después de revisar las notas de evaluación inicial, y los resúmenes clínicos de la sala de urgencias y hospitalización.
                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Enfermo o Enfermedad"</span> significa Dolencia o Afección de cualquier clase listada en la edición más reciente de la Clasificación Internacional de Enfermedades.
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Rider Madre Soltera "<span> se refiere al anexo que detalla la cobertura de maternidad prevista, por una prima adicional, a la Asegurada Principal cuando el cónyuge no está cubierto bajo este Certificado
                </p>
                <p>
                    
                El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Rider de Estudiante en el EE.UU. "</span> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, a un hijo dependiente que es estudiante a tiempo completo en los Estados Unidos. Esta cláusula se puede comprar por un máximo de cuatro (4) años.

                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Cirugía o Procedimiento Quirúrgico"</span> se refiere a un procedimiento de diagnóstico invasivo, o al Tratamiento de una Enfermedad o Lesión mediante operaciones manuales o instrumentales realizados por un Médico, mientras el paciente se encuentra bajo los efectos de anestesia local o general.

                </p>
                
                <p>
                   El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Fecha de Vencimiento”</span> se refiere a que la Cobertura terminará en la primera de las siguientes fechas: 1.) El final del periodo por el cual se pagó la Prima; 2) la fecha en que la Persona Asegurada falle en cumplir con los requerimientos de Elegibilidad descritos en la SECCIÓN 3, A; 3) la fecha en que la Compañía cese la Cobertura de una Clase de Personas Aseguradas específica, de la cual la Persona Asegurada pueda formar parte.
                </p>
                
                <p>
                    El término <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">"Tratamiento"</span> se refiere a manejo quirúrgico o médico de un paciente con el propósito de resolver o sanar la Enfermedad o Lesión, basado en prácticas médicas estándares y aceptadas. Para los propósitos de esta Póliza, el curso de acción sólo incluirá aquellos Beneficios planificados y Aprobados, para los cuales la Persona Asegurada sea elegible.
                </p>
           
               

            <h3 style="font-size:14px;font-weight: bold;">SECCION 2: TABLA DE BENEFICIOS</h3>
            <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">A. Objetivo del Seguro:</span></p>   
                
                <p>
                   La Compañía se ha comprometido, mediante la recepción de la prima estipulada, a cubrir los gastos médicos de la póliza, que incurra el asegurado durante la vigencia de este contrato, hasta la suma asegurada especificada en esta póliza a 
                </p>

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 220px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div>
               <p class="page_no">Page 16 of 52</p>
                 <p>
               consecuencia de una enfermedad cubierta y lesiones que se producen a un Asegurado incluido en la póliza y de acuerdo a las condiciones y límites estipulados en el presente contrato.
                </p>
                <br><br>
                
                <p>
                   <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">B. Tabla de beneficios:</span>
                </p>
                
                <p>
                   La cobertura máxima para todos los gastos médicos y hospitalarios cubiertos durante la vigencia de la póliza está sujeta a los términos y condiciones de esta póliza. A menos que se indique lo contrario, todos los beneficios son por persona, por año póliza. Todos los importes mencionados en el presente documento, en relación con los beneficios y deducibles cubiertos, se detallan en dólares de los Estados Unidos.
                </p>
                
                <div>
                    
                    <table class="table-page-16">
                     
                     <tr>
                         <th>TABLA DE BENEFICIOS</th>
                         <th>COBERTURA</th>
                     </tr>
                     
                     <tr>
                         <td>Suma Anual Asegurada</td>
                         <td>$2,000,000 máximo por asegurado/renovación vitalicia</td>
                     </tr>
                     
                     <tr>
                         <td>Habitación Privada y alimentación</td>
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
                         <td>Servicios de diagnóstico (patología, radiografía, resonancia magnética, tomografía computarizada, tomografía por emisión de positrones, ultrasonido, endoscopia)</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Medicamentos recetados durante una hospitalización en el extranjero para uso ambulatorio *</td>
                         <td>hasta $4,000 con 20% de coaseguro</td>
                     </tr>
                     
                     <tr>
                         <td>Tratamiento del cáncer (quimioterapia/radioterapia) </td>
                         <td>100%</td>
                     </tr>
                     



                     <tr>
                         <td>Hospitalización, Cirugía Ambulatoria y Emergencias, en el país de residencia.
                            Sin deducible para todas las opciones	</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Indemnización Hospitalaria</td>
                         <td>$100 por un máximo de 5 días</td>
                     </tr>
                     
                     <tr>
                         <td>Gastos incurridos en Hospitales No Participantes o fuera de la red. (Por reembolso)</td>
                         <td>Cubiertos al 50%</td>
                     </tr>
                     
                     <tr>
                         <td>Visitas a médicos y especialistas*</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Visitas a médicos y especialistas en el país de residencia</td>
                         <td>100% hasta un máximo de $150 por consulta</td>
                     </tr>
                     
                     <tr>
                         <td>Vacunas hasta la edad de 10 años</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Visitas de niño sano</td>
                         <td>4 visitas por año póliza hasta la edad de 2 años
                            2 visitas por año póliza hasta la edad de 19 años
                            </td>
                     </tr>
                     
                     <tr>
                         <td>Cuidado Preventivo o Rutinario – Asegurado Primario y Cónyuge</td>
                         <td>$100 por póliza, por año póliza</td>
                     </tr>
                     
                     <tr>
                         <td>Medicamentos prescritos en país de residencia
                            Medicamentos prescritos en el extranjero
                            </td>
                         <td>$4,000 con 20% Coaseguro</td>
                     </tr>
                     
                     <tr>
                         <td>Fisioterapia/rehabilitación - (debe ser Pre-aprobada)</td>
                         <td>100% hasta un máximo de 40 sesiones por año</td>
                     </tr>
                     
                     <tr>
                         <td>Diálisis *</td>
                         <td>100% hasta un máximo de $150,000 por año póliza</td>
                     </tr>
                     
      
                     
                 </table>
                    
                    
                    
                    
                    
                    
                </div>
                 
                 
                  

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
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
                         <td>Atención médica en el hogar- (debe ser pre-aprobada)</td>
                         <td>100% hasta un máximo de $10,000.00 por año póliza</td>
                     </tr>
                     
                     <tr>
                         <td>Ambulancia aérea y terrestre -debe ser pre-aprobada</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Segunda opinión medica</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Medicina alternativa</td>
                         <td>Max 12 visitas por año, hasta $150 por visita</td>
                     </tr>
                     
                     <tr>
                         <td>Ambulancia aérea en territorio nacional</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>
                             <p>
                                 Cuidado de la Maternidad
                             </p>
                             <p>
                                • Período de espera de 10 meses <br>
                                • Sin deducible<br>
                                Aplica para opciones 1,2 y 3 <br><br>
                                Habitación Suite<br><br><br>
                                Almacenamiento de células madres<br><br>
                                
                                Cobertura especial por complicaciones<br>
                                Aplica para opciones 1,2 y 3<br><br>
                                
                                Cobertura de recién nacido los primeros<br>
                                90 días para opciones 1,2 y 3


                             </p>
                             


                             
                         </td>
  
                         <td>
                            
                            <p>
                               $8,000 (por embarazo) dentro y fuera del país <br>
                               de residencia<br><br><br><br>

                                Incluida, en país de residencia, dentro del límite de $8,000 <br>
                                de cobertura<br><br>
                                
                                
                                Hasta $1,500, dentro del límite de $8,000 de cobertura<br><br>
                                
                                $500,000<br><br><br>
                                $50,000
                                
                            </p>
                             
         
                         </td>
                     </tr>
                     
                     <tr>
                         <td>Condiciones Congénitas y Hereditarias **</td>
                         <td>100% hasta un máximo de $500,000</td>
                     </tr>
                     
                     <tr>
                         <td>Trasplantes (Vitalicio) * </td>
                         <td>$750,000 máximo para uno o la combinación de varios trasplantes de órganos y/o tejidos.</td>
                     </tr>
                     



                     <tr>
                         <td>Síndrome de Inmunodeficiencia Adquirida **	</td>
                         <td>$20,000</td>
                     </tr>
                     
                     <tr>
                         <td>Virus del papiloma humano (VPH)</td>
                         <td>$3,000 vitalicio</td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura temporal durante periodo de emisión (con pago sometido)</td>
                         <td>$10,000</td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura para dependientes elegibles debido al fallecimiento del Asegurado Primario</td>
                         <td>Tres (3) años</td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura dental de emergencia</td>
                         <td>100%</td>
                     </tr>
                     
                     <tr>
                         <td>Repatriación de restos mortales</td>
                         <td>100%- hasta $1,500 en país de residencia para gastos funerarios</td>
                     </tr>
                     
                     <tr>
                         <td>Hospicio/ Cuidado Terminal (debe ser pre- aprobado)</td>
                         <td>100% hasta un máximo de $10,000 por año póliza
                            </td>
                     </tr>
                     
                     <tr>
                         <td>Cobertura de viaje</td>
                         <td>Incluida</td>
                     </tr>

                     
                 </table>   
                    
                </div>
                
               <ul style="font-size:12px;">
                   <li>* Cobertura después de aplicado el deducible</li>
                   <li>** Cobertura vitalicia</li>
               </ul>
               
                  <p>
                      <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Opciones de Deducible</span>
                  </p>
                  
                  
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
            
            <div>
                    
                    <table class="table-page-18">
                     
                     <tr>
                         <th>Opción</th>
                         <th>Deducible en país de residencia</th>
                         <th>Deducible fuera del país de residencia</th>
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
                  <p>La cobertura de los honorarios del anestesiólogo debe ser aprobada previamente por la Compañía y se limita a la menor de:</p>
                   
                       <ol style="font-size:12px;">
                           <li>el 100% (cien por ciento) de las tarifas usuales, acostumbradas y razonables para el anestesiólogo, o</li>
                           <li>35% (treinta y cinco por ciento) de las tarifas usuales, acostumbradas y razonables del cirujano principal para el procedimiento quirúrgico, o </li>
                           <li>35% (treinta y cinco por ciento) de los honorarios aprobados para el cirujano principal para el procedimiento quirúrgico, o</li>
                           <li>Tarifas especiales establecidas por la Compañía para un área o país.</li>
                       </ol>
    
                   
                   <span style="font-size:12px;">2. Honorarios del Cirujano Asistente:</span>
                   <p>
                        Los honorarios del médico / cirujano asistente estarán cubiertos sólo cuando es médicamente necesario para una operación la asistencia del médico / cirujano, y cuando la Compañía ha pre aprobados los honorarios.
                        Los honorarios del médico / cirujano asistente están limitados al menor de:</p>
                        
                        <ol style="font-size:12px;">
                           <li>el 100% (cien por ciento) de las tarifas usuales, acostumbradas y razonables para el procedimiento, o</li>
                           <li>20% (veinte por ciento) de los honorarios aprobados para el cirujano principal de este procedimiento, o</li>
                           <li>Si más de un médico o cirujano asistente es necesario, la cobertura máxima de todos los médicos o cirujanos asistentes en conjunto no exceda del 20% (veinte por ciento) de los honorarios del cirujano principal para el procedimiento quirúrgico, o</li>
                           <li>Tarifas especiales establecidas por la Compañía para un área o país.</li>
                       </ol>
                 
                 
                       <span style="font-size:12px;">3. Alojamiento y Comida</span><p>
                       Los cargos por alojamiento y comida serán cubiertos al 100 % en el caso de una habitación privada en el extranjero. Para <br>las admisiones en el país de residencia, el reembolso de habitación privada está cubierto hasta $200.00 por día.<br><br>
                        Unidad de cuidados intensivos y otras unidades de atención especializada serán cubiertas al 100%.<br><br>
                        Otros servicios hospitalarios y suministros (excepto para cuidado personal cuidados de hospicio), incluyendo, pero no limitado a: atención de enfermería, terapia de inhalación, física u ocupacional (mientras el asegurado se encuentra hospitalizado), quirófano, sala de recuperación, suministros médicos, pruebas de laboratorio y quirúrgicos rayos X, electrocardiogramas, electroencefalogramas, administración de oxígeno, fluidos e inyecciones intravenosas.</p>
 
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 
               
      <p class="page_no">Page 19 of 52</p>
      
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">4. Cirugía Ambulatoria</span></p>
                  <p>
                     Cuando una persona asegurada se somete un procedimiento quirúrgico que no requiere hospitalización, los honorarios quirúrgicos y otros servicios relacionados con la cirugía serán reembolsados al mismo nivel que si el asegurado hubiese sido hospitalizado.
                  </p>
                 
          
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">5.	Indemnización Hospitalaria</span></p>
                       <p>
                         Beneficio en efectivo de $100 por noche cuando se elige recibir Tratamiento de Hospitalización de Beneficios Elegibles en un hospital en su país de residencia. Máximo de cinco (5) noches por persona asegurada por año póliza. Este beneficio no es aplicable para maternidad y/o complicaciones de maternidad. Esto beneficia sólo se aplica para el Asegurado Primario y el cónyuge asegurado en la póliza. Este beneficio no se aplica a otros dependientes.
                       </p>
                        
                
                 
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">6. Proveedores fuera de la red</span></p>
                        <p>
                        Los gastos incurridos fuera de la red de proveedores serán cubiertos a través de reembolso al 50% de acuerdo con los costes habituales, razonables y acostumbrados para el procedimiento. En Venezuela, los reclamos sometidos a reembolso no serán elegibles para beneficios. Para que un reclamo sea elegible para beneficios bajo el contrato de esta póliza, el Administrador debe coordinar directamente con el proveedor.
                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">7. Condiciones congénitas y hereditarias</span></p>
                        <p>
                        La cobertura para condiciones congénitas y hereditarias bajo de este contrato es igual al límite máximo de $500,000 después de alcanzar el deducible.
                       </p>
                       
                       <p style="margin-bottom:0;"><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">8. Deducible</span></p>
                       
                       <ol style="font-size:11px;">
                           <li style="margin-bottom:5px;">Un (1) deducible por Asegurado, por año póliza hasta el deducible máximo fuera del país de residencia.</li>
                           <li style="margin-bottom:5px;">Un (1) deducible por Asegurado, por año póliza hasta el deducible máximo dentro del país de residencia.</li>
                           <li style="margin-bottom:5px;">Un máximo de dos (2) deducibles por póliza, por año póliza para cumplir con un máximo de dos (2) deducibles fuera del país de residencia.</li>
                           <li style="margin-bottom:5px;">En caso de un accidente grave, no se aplicará deducible durante la primera hospitalización.
                                Los gastos incurridos en el país de residencia están sujetos al deducible en el país de residencia. Los gastos incurridos fuera del país de residencia están sujetos al deducible fuera del país de residencia.
                           </li>
                       </ol>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">9. Evacuación de Emergencia</span></p>
                        <p>
                        La Compañía pagará los Beneficios Elegibles incurridos hasta el máximo indicado en la Tabla de Beneficios, en caso de cualquier enfermedad o lesión cubierta que comience durante el Periodo de cobertura de la persona asegurada resulte en una emergencia médicamente necesaria de evacuación médica de emergencia o la repatriación de la persona asegurada. La decisión de una evacuación médica de emergencia o la repatriación debe ser ordenada por el Administrador de la Compañía en consulta con el médico tratante de la persona asegurada.<br>

                        Evacuación médica de emergencia o de repatriación se entiende: que el Médico Legalmente Calificado local y la empresa de asistencia de viaje autorizada han determinado por escrito que el Asegurado se encuentra en condiciones de ser transportado y que el transporte a un hospital o centro médico es médicamente necesario para tratar una enfermedad o lesión inesperada que pone en peligro la vida y que el tratamiento médico adecuado no está disponible en el área inmediata. Los gastos de transporte incurridos serán pagados de acuerdo a los cargos 
                       </p>
                       

   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
         <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 
               <p class="page_no">Page 20 of 52</p>
      
                  <p>usuales, acostumbrados y razonables para el transporte al hospital más cercano o centro médico capaz de proporcionar ese tratamiento.</p>
                  <p>
                    El transporte en ambulancia aérea:
                  </p>
                  
                  <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Todo el transporte por ambulancia aérea debe ser coordinado y aprobado previamente por la Compañía. En el caso que la Compañía no puede dar su aprobación a este beneficio, el gasto estará sujeto a ser procesado por reembolso previa evaluación y aprobación de la Compañía.</li>
                           <li style="margin-bottom: 5px;">El Asegurado se compromete a liberar a la Compañía de responsabilidad por cualquier retraso o la restricción en los vuelos debido a problemas mecánicos causados por las restricciones del gobierno o por el piloto, o debido a cualquier negligencia o condiciones de funcionamiento resultantes de tales servicios.
                            </li>
                       
                 </ol>
                 
          
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">10. Cobertura Temporal durante Emisión</span></p>
                       <p>
                         Cobertura médica temporal por accidentes de hasta un máximo de $10,000 mientras que la solicitud de seguro es evaluada para suscripción y antes que la póliza se ha realizado y aprobado a un plazo máximo de 30 días a partir de la fecha de recepción de la solicitud por el Administrador condicional que el pago se ha enviado y recibido por la Compañía, junto con la solicitud antes del accidente. Todos los beneficios pagados son sujetos a los términos de esta póliza, los límites deducibles y exclusiones que hubieran sido aplicados, si hubiese sido la póliza aprobada antes del accidente.
                       </p>
                        
                
                 
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">11. Cobertura extendida para dependientes elegibles al deceso del asegurado principal</span></p>
                        <p>
                       En caso de fallecimiento del asegurado principal, se pagará hasta tres años de prima para los asegurados que están inscritos en la póliza cuando se otorgue este beneficio.
                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">12. Fisioterapia / Rehabilitación</span></p>
                        <p>
                        La fisioterapia / rehabilitación será cubierta cuando sea recomendada por un médico para el tratamiento de un evento cubierto específico y es administrada por un fisioterapeuta con licencia.<br><br>
                        Cubre un período inicial de 30 días, con la condición que debe ser aprobada previamente por la Compañía a un precio máximo de $200 por sesión. Cualquier extensión en incrementos de hasta 30 días deberá ser aprobado con antelación, o la reclamación será denegada. Para cada aprobación el Asegurado deberá presentar un informe médico actualizado que demuestren la necesidad y plan de tratamiento. Terapias máximas autorizados son 40 sesiones por año póliza.

                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">13. Maternidad</span></p>
                           
                    <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">El beneficio máximo es de $8,000 por embarazo dentro y fuera del país de residencia, sin deducible. En el país de residencia la cobertura incluirá en el límite máximo de $8,000, los cargos por una suite privada en el hospital. En el país de residencia la cobertura incluirá en el límite máximo de $ 8,000, los gastos de conservación del cordón umbilical y el almacenamiento de hasta un máximo de $1,500. Esta cobertura sólo se aplica a las opciones de deducible 1, 2 y 3.</li>
                           <li style="margin-bottom: 5px;">El cuidado pre y post-natal, parto normal, parto por cesárea, complicaciones de la maternidad y el cuidado del recién nacido saludable están incluidos dentro del beneficio máximo para el embarazo estipulado en esta póliza.
                            </li>
                            <li style="margin-bottom: 5px;">Este beneficio aplica para embarazos cubiertos. Los embarazos cubiertos son aquéllos para los que la fecha de parto es por lo menos 10 meses después de la fecha de vigencia de la cobertura para el Asegurado Primario y su Cónyuge.
                            </li>
         
                 </ol>
                       
          
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
            <p class="page_no">Page 21 of 52</p>
                <ol start="4" style="font-size:11px;">
                      <li style="margin-bottom: 5px;">
                                No hay cobertura de maternidad bajo esta póliza para las hijas dependientes.
                            </li>
                            <li style="margin-bottom: 5px;">
                                El período de espera de la cobertura de los 10 meses de la maternidad aplica en todo momento, incluso cuando se ha eliminado el período de espera de 90 días para esta póliza.
                            </li>
                            
                            <li style="margin-bottom: 5px;">
                              El padre y la madre del niño deben estar en la misma póliza y estar continuamente cubiertos durante 10 meses antes del parto.
                                
                            </li>
                </ol>
                 
      
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">14. Complicaciones del embarazo y parto: (Aplica para las opciones de deducible 1, 2 y 3)</span></p>
                       <p>
                         Las complicaciones del embarazo y / o el recién nacido durante el parto (salvo condiciones congénitas y hereditarias), incluyendo, pero no limitado a prematuridad, bajo peso al nacer, hiperbilirrubinemia, hipoglucemia, problemas respiratorios y trauma durante el parto serán cubiertos de la siguiente manera:
                       </p>
                       
                        <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Una cobertura máxima vitalicia de $500,000 por póliza, máximo 1 maternidad por año póliza.
                           </li>
                           
                           <li style="margin-bottom: 5px;">Este beneficio sólo se aplica como se describe en la cobertura de Maternidad de esta póliza.
                            </li>
                            
                            <li style="margin-bottom: 5px;">Este beneficio no se aplica a las complicaciones relacionadas con cualquier condición excluida bajo el contrato de esta póliza, incluyendo, pero no limitado a las complicaciones de la maternidad o del recién nacido durante el parto que surjan de un embarazo resultado de cualquier tipo de tratamiento de fertilidad o cualquier tipo de procedimiento de fertilidad asistida o embarazos que no estén cubiertos.
                            </li>
                            <li style="margin-bottom: 5px;">Las complicaciones causadas por una enfermedad que se diagnosticó antes del embarazo, y / o cualquiera de sus consecuencias serán cubiertas bajo los términos de esta póliza.
                            </li>
                       
                 </ol>
                        
                
                 
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">15. Cobertura del recién nacido:</span></p>
                        <p>
                       I.	Si nace de una maternidad cubierta:
                       </p>
                       
                         <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Cobertura provisional: El recién nacido tendrá cobertura por cualquier lesión o enfermedad durante los primeros 90 días después del nacimiento, hasta un máximo de $50,000 sin deducible.
                           </li>
                           
                           <li style="margin-bottom: 5px;">Para incluir a un recién nacido a la póliza por favor, consulte la sección 6, Cláusula 12.
                            </li>
  
                 </ol>
                       
                       <p>
                           II.	Si nace de una maternidad que no está cubierta, el recién nacido no gozará de la cobertura provisional. Para incluir al recién nacido a la póliza, la solicitud debe ser presentada junto con el pago de la prima.  La solicitud estará sujeta a evaluación médica por la Compañía.
                       </p>
                       
                       
                       
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">16. Vacunas</span></p>
                        <p>
                        Este beneficio se aplica a los hijos Dependientes, que han sido suscritos y aprobados por el Administrador como persona Asegurada. En ningún caso la responsabilidad máxima de la Compañía superará el máximo que se indica en la Tabla de Beneficios como Beneficios Elegibles durante un período de cobertura. El beneficio incluye: vacunas para dependientes hasta 10 años de edad. Deducible se aplica. 

                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">17. Beneficios para cuidados de niño sano</span></p>
                           
                   <p>
                       Este beneficio se aplica a los hijos Dependientes, que han sido suscritos y aprobados por el Administrador como persona Asegurada. En ningún caso la responsabilidad máxima de la Compañía superará el máximo que se indica en la Tabla de Beneficios como Beneficios Elegibles durante un período de cobertura. El beneficio incluye: la atención y tratamiento necesario por defectos congénitos y anomalías de nacimiento médicamente diagnosticados, y por prematuridad. Además, incluye la cobertura de servicios preventivos y de atención primaria, incluyendo los exámenes físicos, 
                   </p>
                       
          
   
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 <p class="page_no">Page 22 of 52</p>
                <p>
                mediciones, detección sensorial, evaluación neuro-psiquiátrica, evaluación del desarrollo, que incluirá para dependientes hasta 2 años de edad: 4 visitas por año con un máximo de $50 por visita sin deducible. Para dependientes mayores de 2 años de edad: 2 visitas por año con un máximo de $50 por visita sin deducible. Adicionalmente la cobertura de un máximo de 5 visitas al año por hijos dependientes menores de 19 años de edad. Deducible y coaseguro se aplica. Cualquier servicio preventivo y de atención primaria aplicados, incluyen también, según lo recomendado por el médico, detección metabólico y hereditario en el momento del nacimiento, vacunas, análisis de orina, pruebas de la tuberculina, y hematocrito, hemoglobina, y otros análisis de sangre, incluyendo pruebas para la detección de hemoglobinopatía.
                </p>
                   
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">18. Beneficios Preventivos para Adultos</span></p>
                       <p>
                         La Compañía pagará los gastos, hasta los límites indicados en la Tabla de Beneficios, por los siguientes Beneficios Elegibles. En ningún caso la responsabilidad máxima de la Compañía excederá el máximo establecido en la Tabla de Beneficios, respecto a los Beneficios Elegibles, durante cualquier Periodo de Cobertura dado.
                        La Cobertura se limita a los siguientes gastos, sujetos a las Exclusiones listadas. Estos Beneficios Preventivos no están sujetos al Deducible o al Coaseguro. 

                       </p>
                       
                       <p>
                           Beneficios Preventivos Cubiertos incluyen:<br>
                          1. Exámenes físicos rutinarios:

                       </p>
                       
                        <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Mujeres mayores de 18 años que hayan estado cubiertas por la Póliza por 12 meses consecutivos antes de recibir tratamiento.
                           </li>
                           
                           <li style="margin-bottom: 5px;">Hombres mayores de 18 años que hayan estado cubiertos por la Póliza por 12 meses consecutivos antes de recibir tratamiento.
                            </li>
                          
                 </ol>
                       <p>2. Exámenes femeninos preventivos. Mujeres mayores de 18 años que hayan estado cubiertas por la Póliza por 12 meses consecutivos antes de recibir tratamiento.</p>
                       
                       <ol style="font-size:11px;">
                           <li style="margin-bottom: 5px;">Mamografía: <br>
                           <p style="padding-left: 10px; margin-bottom: 0;">i. Mamografía de base</p>
                           <p style="padding-left: 10px; margin-bottom: 0;">ii. Mamografía anual de rutina.</p>
                           </li>
                           
                           <li style="margin-bottom: 5px;">
                               Citología:<br>
                           <p style="padding-left: 10px; margin-bottom: 5px;">i. Un examen citológico cervical para mujeres.</p>
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
                           
                           <li style="margin-bottom: 5px;">Deben ser dispensados por un médico o un farmacéutico con credenciales apropiadas y
                            </li>
                            <li style="margin-bottom: 5px;">Deben estar aprobados por la Administración de Alimentos y Drogas de los Estados Unidos de América (United States Food and Drug Administration)</li>
  
                 </ol>
                       
                       <p>
                           Los medicamentos recetados de forma ambulatoria se pagarán hasta $4,000 tanto en el país como fuera del país de residencia. Este beneficio está sujeto a cualquier deducible aplicable y luego el plan cubrirá el 80 % de la máxima indicada.
                       </p>
  
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
            <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 200px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
                 
      <p class="page_no">Page 23 of 52</p>
                  <p><i>Hospitalización:</i></p>
                  <p>Los medicamentos con receta que se prescriben por primera vez durante una hospitalización o después de una cirugía ambulatoria se cubrirán hasta un máximo de $4,000 por asegurado por año póliza, durante un período máximo de 6 meses continuos. Este beneficio es válido fuera del país de residencia.
                  </p>
                  <p>En todos los casos, el reclamo debe tener una copia de receta firmada y sellada por el médico.</p>
                  
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">20. Procedimientos Especiales</span></p>
                       <p>
                         Prótesis, aparatos ortopédicos, equipo médico durable, los implantes, la diálisis, radioterapia, quimioterapia y medicamentos altamente especializados serán cubiertos de acuerdo a los límites y sublímites establecidos en la tabla de beneficios, pero deben ser aprobadas y coordinadas previamente por la Compañía. Procedimientos especiales serán cubiertos por la Compañía o reembolsados hasta el máximo que la Compañía habría pagado si se hubiera comprado a uno de sus proveedores.

                       </p>

                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">21. Procedimientos de trasplante:</span></p>
                        <p>
                      Los Beneficios elegibles para gastos por trasplantes de órganos y tejidos humanos se limitan a cantidades y procedimientos enumerados de la siguiente manera:
                       </p>
                       
                       <p>
                           • La decisión de un trasplante de órgano o tejido humano de debe ser aprobada previamente por el administrador designado por la Compañía.
                       </p>
                       <p>
                           • La cobertura de beneficios de trasplante de órganos comienza a partir de la fecha en que fue determinada por un médico la necesidad de un trasplante de órganos, ha sido certificada por una segunda opinión médica o quirúrgica, y ha sido aprobado por la Compañía. Está sujeta a todos los términos, los gastos cubiertos y exclusiones de la póliza. El beneficio y los límites de Trasplante de Órganos incluyen la cobertura de la fecha en que se determinó la exigencia de un trasplante de órgano, toda la atención médica de proceder al trasplante, el trasplante real y todo el seguimiento de la asistencia médica después del trasplante se incluyen en el beneficio y los límites, y está sujeto a todos los términos, los gastos y exclusiones de la póliza en cuestión;
                       </p>
                       <p>
                           • Si se trata de un trasplante de órgano único o múltiples trasplantes de órganos, en ningún caso la Compañía paga más que el beneficio elegible máximo permitido de $750,000 de por vida.
                       </p>
                       <p>
                           A.Servicios de Trasplantes Cubiertos:
                       </p>
                       
                       <ul style="list-style-type: lower-roman; font-size:11px;">
                       
                       <li style="padding-left: 10px; margin-bottom:5px">Servicios clínicos de Hospitalización y Ambulatorios.</li>
                       <li style="padding-left: 10px; margin-bottom:5px">Servicios de un Médico para diagnóstico, tratamiento y cirugía para un Procedimiento de Trasplante Cubierto.</li>
                       <li style="padding-left: 10px; margin-bottom:5px">	Servicios de diagnóstico.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Obtención de un órgano o tejido, incluidos los servicios prestados a un donante vivo de un órgano o tejido para la obtención de un órgano o tejido está cubierto hasta un máximo de $50,000 vitalicio, incluido dentro del límite máximo de beneficio de Trasplante de Órgano. Los servicios proveídos al donante vivo para obtener el órgano o tejido estarán limitados al costo de la obtención del órgano o tejido hasta el monto máximo descrito en la Sección “Montos Máximos”</li>
                        
                        <li style="padding-left: 10px; margin-bottom:5px">Costos de traslado Médicamente Necesario, por viajes relacionados con el Procedimiento de Trasplante Cubierto, para el receptor del Trasplante y un acompañante, durante un Período de Beneficios. Los Beneficios Elegibles por Traslado están sujetos a las cantidades indicadas en la sección de Montos Máximos.</li>
                            
                        </ul>
                             

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 0;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
     
            <div class="ol_list_con">
              <p class="page_no">Page 24 of 52</p>
                 <ul style="list-style-type: lower-roman; font-size:11px;" start="6">
                  <li style="padding-left: 10px; margin-bottom:5px">Si el receptor es un menor de edad, pueden estar cubiertos los costos de traslado de dos acompañantes. Los Beneficios Elegibles por Traslado están sujetos a los montos indicados en la sección de Montos Máximos.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Gastos razonables y necesarios de alojamiento y comidas incurridos por el receptor y su(s) acompañante(s), relacionados con el Procedimiento de Trasplante cubierto durante el Periodo de Beneficios. Los Beneficios Elegibles por alojamiento y comidas están sujetos a los montos indicados en la sección de Máximos.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	El alquiler de equipo médico duradero para uso fuera del Hospital. Los Beneficios Elegibles están limitados al precio de compra del mismo equipo.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Medicamentos por receta, incluyendo medicamentos inmunosupresores</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Oxígeno.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">	Terapia del Habla, Terapia Ocupacional, Terapia Física y Quimioterapia.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Vendas e implementos quirúrgicos.</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Servicios y suministros por Quimioterapia de Alta Dosis o relacionados con ella y por Trasplante de Tejido de Médula Ósea, cuando se suministren como parte de un plan de Tratamiento que incluya Trasplante de Médula Ósea y Quimioterapia de Altas Dosis</li>
                        <li style="padding-left: 10px; margin-bottom:5px">Cuidado de salud a domicilio.</li>
                 
                 </ul>
      
                
                  <p>B.	Montos Máximos por Trasplantes en Centros de Trasplantes que no están en la Red de son el menor del 80% de los cargos elegibles facturados o el 80% del monto indicado a continuación:
                  </p>
                  <div>
                      <table style="margin: auto; border-collapse: collapse; width: 60%;">
                          <tr>
                              <td style="border-bottom: 1px solid #000; padding-right: 50px;">Procedimiento de Trasplante Cubierto 	</td>
                              <td style="border-bottom: 1px solid #000; padding-right: 0px;">Dentro de EE. UU</td>
                          </tr>
                          
                          <tr>
                              <td>Medula Ósea Autologa incluyendo <br> Quimioterapia de Alta dosis </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Médula Ósea Alogénica incluyendo <br> Quimioterapia de Alta dosis 	</td>
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
                              <td>Corazón </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Corazón/Pulmón </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Pulmón</td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Hígado </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Páncreas </td>
                              <td>$100.000</td>
                          </tr>
                          
                          <tr>
                              <td>Riñón y Páncreas </td>
                              <td>$100.000</td>
                          </tr>
             
                      </table>
                  </div>
                  
             
                       <p>
                       C.	Transporte/alojamiento/comidas: Un máximo de $200 por día, para alojamiento y comidas, por Procedimiento de Trasplante Cubierto. $10,000 por todos los gastos de transporte, alojamiento y comidas, por Procedimiento de Trasplante Cubierto. Los recibos, detallados a satisfacción de la Compañía, deben ser sometidos por la Persona Asegurada cuando complete los formularios de Reclamo.

                       </p>

                       
                        <p>
                    D.	Obtención del Órgano: Los pagos de la Compañía por los gastos de Obtención, para un donante de Órgano o Tejido, no excederán las siguientes cantidades máximas, por cada Procedimiento de Trasplante Cubierto:
                       </p>
                       
                <div>
                      <table style="margin: auto; border-collapse: collapse; width: 60%;">
                          <tr>
                              <td style="border-bottom: 1px solid #000;  padding-right: 50px;">Procedimiento</td>
                              <td style="border-bottom: 1px solid #000;  padding-right: 0px;">Monto Máximo</td>
                          </tr>
                          
                          <tr>
                              <td>BMT Alogénico </td>
                              <td>$50.000</td>
                          </tr>
                          
                          <tr>
                              <td>Corazón 	</td>
                              <td>$50.000</td>
                          </tr>
                          
                          <tr>
                              <td>Corazón/Pulmón </td>
                              <td>$50.000</td>
                          </tr>
                          
                    </table>     
                        
                 </div>        

           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
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
                              <td>Pulmón  </td>
                              <td>$45.000</td>
                          </tr>
                          
                          <tr>
                              <td>Hígado 	 </td>
                              <td>$45.000</td>
                          </tr>
                          
                          <tr>
                              <td>Páncreas  </td>
                              <td>$45.000</td>
                          </tr>
                          
                          <tr>
                              <td>Riñón/Páncreas </td>
                              <td>$45.000</td>
                          </tr>
       
                      </table>
                  </div>
                     <p>
                         a)	Cuidado antes del trasplante, que incluye todos los servicios directamente relacionados con la evaluación de la necesidad del trasplante, evaluación del asegurado para el procedimiento de trasplante, y preparación y estabilización del asegurado para el procedimiento de trasplante.
                     </p>
                     <p>
                         b)	El cuidado post-operatorio, incluyendo pero no limitado a cualquier tratamiento de seguimiento médicamente necesario después del trasplante y cualquier complicación que surja después del procedimiento de trasplante, ya sea consecuencia directa o indirecta de los mismos.
                     </p>
                      <p>
                          c) Cualquier fármaco o medidas terapéuticas que se utilizan para asegurar la viabilidad y la retención del órgano, célula o tejido humano.
                      </p>
            
            
            
                    <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 22.	Síndrome de Inmunodeficiencia Adquirida (SIDA): </span></p>
                       <p>
                        Los gastos incurridos Cuando el Síndrome de Inmunodeficiencia Adquirida (SIDA ) se ha manifestado clínicamente , incluyendo los costos de diagnóstico para el virus, después que el asegurado haya estado continuamente cubierto para cuatro (4 ) años en la política , siempre que los anticuerpos del VIH (VIH) o el virus del SIDA no se había detectado o no se habían manifestado durante o antes del periodo de cobertura y el tratamiento se lleva a cabo en el país de residencia. El beneficio máximo de por vida por Asegurado elegible para esta cobertura es de $20,000.
                       </p>
                      
                      <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 23.	Atención Medica en el hogar</span></p>
                       <p>
                        Los Beneficios Elegibles son aplicables por un período inicial de 30 días, siempre y cuando sea aprobado previamente por la Compañía. Cualquier extensión en incrementos de hasta 30 días deberá ser aprobado con antelación, o la reclamación será denegada. <br> <br>
                        Para cada aprobación se requiere que el Asegurado presente el plan de tratamiento actualizado y evidenciar que el tratamiento es médicamente necesario. El beneficio máximo es el 100% hasta $10,000 por año póliza.

                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 24.	Hospicio / Paliativo / Cuidado Terminal</span></p>
                       <p>
                       Los Beneficios Elegibles son aplicables por un período inicial de 30 días, siempre y cuando exista la aprobación de la Compañía con antelación. Cualquier extensión en incrementos de hasta 30 días deberá ser aprobado por adelantado o la reclamación será denegada. <br> <br>
                    Para cada aprobación se requiere el Asegurado que presente el tratamiento actualizada. El beneficio máximo es de 100% hasta $10.000 por año póliza.


                       </p>
                       
                          <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 25.	Segunda opinión médica</span></p>
                       <p>
                       Las segundas y terceras opiniones medicas están cubiertas bajo los siguientes criterios:

                       </p>
                       <p>a. las segundas opiniones se cubren si la opinión se proporciona a petición del Asegurado para determinar la prudencia de proceder a una cirugía o un procedimiento de diagnóstico o terapéutico no quirúrgico de importancia.
                       </p>
                       
                      
       
           </div>
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="ol_list_con">
             <p class="page_no">Page 26 of 52</p>
            
             <p>b. las terceras opiniones se cubren si las recomendaciones del primer y segundo médico difieren en cuanto a la necesidad de cirugía u otro procedimiento importante.</p>
                       <p>
                           c. las opiniones segunda o tercera pueden incluir, pero no se limitan a: 1) una historia y un examen físico del Asegurado 2) cualquier prueba diagnóstica requerida para determinar la necesidad de cirugía o un procedimiento.
                       </p>
                        <p>
                            Una vez que se proporcione la segunda opinión, independientemente de dónde se haya realizado, todas las pruebas diagnósticas, el tratamiento y/o la intervención quirúrgica deben cumplir la elegibilidad en virtud del contrato de póliza para aplicar a cobertura.
                        </p>
                        <p>
                            No hay cobertura para el proveedor o para los cargos de hospitalización si la cirugía o procedimiento propuesto no está cubierto por el contrato de póliza.
                        </p>
     
                   
                   
                    <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">26.	Medicina Alternativa</span></p>
                       <p>
                    Los Beneficios Elegibles para un médico de medicina alternativa, homeopático, acupuntura o quiropráctico. Máximo de 12 visitas por año póliza y un máximo de $150 por visita.



                       </p>
                       
                        <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 27.	Eliminación del Período de Espera</span></p>
                       <p>
                      La Compañía considerará eliminar el período sólo si:

                       </p>
                       
                       <ol style="font-size: 11px;">
                           <li style="margin-bottom: 5px;">El asegurado tuvo cobertura continua bajo un seguro de salud de otra compañía durante por lo menos un (1) año con otro Plan de Salud Internacional y</li>
                           <li style="margin-bottom: 5px;">	La fecha de vigencia de la póliza está dentro de los sesenta (60) días después que haya expirado la cobertura anterior, y</li>
                           <li style="margin-bottom: 5px;">	El Asegurado ha informado de la cobertura anterior en la solicitud de seguro, y</li>
                           <li style="margin-bottom: 5px;">	La Compañía recibe copia del certificado la póliza anterior y copia del recibo de la prima pagada el año anterior, junto con la solicitud de seguro.</li>
                       </ol>
        
                       
                <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 28.	Cambio de plan:</span></p>
                       <p>
                      El Asegurado principal puede solicitar un cambio de plan o incremento/reducción de deducible hasta 90 días antes de la fecha de renovación de la póliza. Esto debe ser notificado por escrito con una solicitud debidamente firmada y completada para todos los miembros de la familia,  y debe ser recibido antes de la fecha de aniversario. Todas las solicitudes de cambio de plan y/o deducible están sujetas a evaluación de riesgo. No hay ninguna garantía de aprobación para las solicitudes en proceso de suscripción para cambio de plan y/o deducible.

                       </p>
                       <p>
                           Dentro de los 90 días siguientes a la fecha efectiva del cambio, los beneficios pagaderos por cualquier enfermedad o lesión no causada por un accidente o enfermedad de origen infeccioso, están limitados al menor de los beneficios bajo el nuevo plan o el plan anterior.
                       </p>
                       <p>
                           Durante los doce (12) meses a doce siguientes a la fecha efectiva del cambio, los beneficios de maternidad, recién nacido, alteraciones congénitas y el trasplante estarán limitados al menor de los beneficios bajo el nuevo plan o el plan anterior.
                       </p>
                       
                       
                  <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 29.	Cambio de país de residencia:</span></p>
                       <p>
                      El Asegurado principal deberá notificar por escrito a la Compañía de cualquier cambio en su país de residencia, incluyendo la de cualquier Asegurado en la póliza dentro de los primeros treinta (30) días del cambio. La Compañía se

                       </p>
                       
                       
                
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 27 of 52</p>
            
                    <p>
                     reserva el derecho a modificar o cancelar la cobertura de la póliza al cambiar el país de residencia de cualquier Asegurado.
                    </p>
            
                        <p>
                           La falta de notificación a la Compañía cualquier cambio de país de residencia del asegurado le da el derecho a La Compañía a rescindir la póliza a partir de la fecha en que se debe haber dado el aviso.
                       </p>
                       
                       <p>
                           El asegurado no puede residir o trabajar en forma permanente o temporal en los Estados Unidos de Norteamérica (incluyendo Puerto Rico) y Canadá. El asegurado debe tener residencia legal y la residencia por lo menos tres (3) meses del año fuera de los Estados Unidos de Norteamérica (incluyendo Puerto Rico) y Canadá.
                       </p>
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">   30.	Moneda y tipo de cambio</span></p>
                       <p>
                           Este seguro se puede contratar en la moneda de curso legal de los Estados Unidos de América, que es el dólar. Los pagos a realizar en virtud de esta póliza se harán en dólares de Estados Unidos. Cualquier factura elegible presentada en moneda diferente a dólares, será pagada utilizando el promedio de la tasa de cambio en vigor durante el mes en que los servicios fueron prestados o los suministros fueron adquiridos.
                       </p>
                     
                       
                       <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;"> 31.	Exámenes físicos</span></p>
                       <p>
                           Durante el proceso de una reclamación, la Compañía se reserva el derecho de solicitar exámenes médicos de cualquier Asegurado cuya enfermedad o lesión es la base de la reclamación, cuando y cuantas veces lo considere necesario. Los gastos serán cubiertos por la Compañía.
                       </p>
            
            
        
                 
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCIÓN 3: DISPOSICIONES DEL SEGURO</h3>     
                  
                <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">A. Requisitos de Elegibilidad</span></p>
                      
                       <p>
                     Solicitud: La solicitud no puede ser firmada dentro de los Estados Unidos, sus territorios o Canadá. Cualquier solicitud firmada, mientras que el solicitante se encuentra en los Estados Unidos, sus territorios o Canadá será considerada nula y sin efecto.

                       </p>
                       <p>
                         Para todos los Solicitantes / Personas Aseguradas: Las Personas Aseguradas Principal y los Dependientes nombrados deben tener al menos 14 días de edad y no haber llegado a su cumpleaños número 79. Los Dependientes son el cónyuge del Asegurado Principal y los hijos solteros naturales o adoptados legalmente de más de 14 días de edad y menos de 19 años de edad, y no mayores de 23 años de edad si están matriculados como Estudiantes de Tiempo Completo en una universidad o colegio universitario reconocidos y no están empleados a tiempo completo.
                       </p>
                       <p>
                           Para Ciudadanos de los Estados Unidos: Los Solicitantes / Personas Aseguradas deben estar fuera de los Estados Unidos o Canadá al momento de la Solicitud / Renovación. Aplicar para este seguro mientras en los Estados Unidos o Canadá y o renovar este seguro mientras que este en los Estados Unidos o Canadá será causa para la cancelación de la póliza a partir de la fecha de la aplicación original y/o de la renovación, y todas las primas serán reembolsadas. Además, la Persona Asegurada debe residir fuera de los Estados Unidos o Canadá al menos durante 9 de los 12 meses del Periodo de Vigencia de la Póliza para cumplir los Requisitos de Elegibilidad de una Persona Asegurada. Si una Persona Asegurada reside en los Estados Unidos o Canadá más de 9 de los 12 meses del Periodo de Vigencia de la Póliza su cobertura será inmediatamente anulada de manera retroactiva, desde la fecha en que los Requisitos de Elegibilidad dejaron de cumplirse, sin importar el motivo. El periodo de 3 meses se calcula de dos maneras: Asegurado no puede permanecer 3 meses consecutivos o 3 meses acumulados en los Estados Unidos. El 
                       </p>
                       
                      
                       
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 28 of 52</p>
             <p>
                           Administrador reembolsará la prima, si hubiese alguna, prorrateada a la fecha en que los Requisitos de Elegibilidad fueron incumplidos. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad será negado.
                       </p>
                       <p>
                           Para Ciudadanos No-estadounidenses: Los Solicitantes / Personas Aseguradas deben estar fuera de los Estados Unidos o Canadá al momento de la Solicitud / Renovación. Aplicar para este seguro mientras en los Estados Unidos o Canadá y o renovar este seguro mientras que este en los Estados Unidos o Canadá será causa para la cancelación de la póliza a partir de la fecha de la aplicación original y/o de la renovación, y todas las primas serán reembolsadas. Además, la Persona Asegurada debe residir fuera de los Estados Unidos o Canadá al menos durante 9 de los 12 meses del Periodo de Vigencia de la Póliza para cumplir los Requisitos de Elegibilidad de una Persona Asegurada. Si una Persona Asegurada reside en los Estados Unidos o Canadá más de 9 de los 12 meses del Periodo de Vigencia de la Póliza su cobertura será inmediatamente anulada de manera retroactiva, desde la fecha en que los Requisitos de Elegibilidad dejaron de cumplirse, sin importar el motivo. El periodo de 3 meses se calcula de dos maneras: Asegurado no puede permanecer 3 meses consecutivos o 3 meses acumulados en los Estados Unidos. El Administrador reembolsará la prima, si hubiese alguna, prorrateada a la fecha en que los Requisitos de Elegibilidad fueron incumplidos. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad será negado.
                       </p>
                       <p>
                           Para Estudiantes en Estados Unidos: Los Solicitantes/ Asegurados deben estar fuera de los Estados Unidos o Canadá, en el momento de la solicitud y la renovación. Se puede agregar Cobertura de Estudiante en Estados Unidos por una prima adicional anual para un hijo dependiente. Esta cobertura permite al Dependiente residir continuamente en los Estados Unidos por un máximo de 4 años si está inscrito como estudiante de tiempo completo en una escuela o colegio acreditado y no es empleado a tiempo completo. Se debe enviar comprobante de estudiante en el momento de la solicitud y la renovación anual. El deducible de la póliza aplica para todos los servicios recibidos en Estados Unidos para el Estudiante Dependiente. El Administrador reembolsará la prima, si hubiese alguna, prorrateada a la fecha en que los Requisitos de Elegibilidad fueron incumplidos. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad será negado.


                       </p>
                       <p>
                           Es responsabilidad de la Persona Asegurada conservar todos los registros, y proporcionarlos al Administrador a solicitud de este para todos los Requisitos de Elegibilidad, incluyendo, pero sin limitarse a estatus de residencia, historial de viajes, copia de todas las páginas del pasaporte, formulario de Homeland Security, formularios autorizando liberar historiales de siniestros de seguros, estatus estudiantil, así como participar al Administrador toda la información relevante que hubiese cambiado, en la fecha en que el cambio ocurriese, y proporcionar cualquier documento al Administrador, quien verificaría los Requisitos de Elegibilidad. Si el asegurado en cualquier momento incumple los Requisitos de Elegibilidad, y no participa al Administrador sobre tales importantes cambios, entonces la póliza será cancelada con carácter retroactivo a la fecha del incumplimiento de los Requisitos de Elegibilidad. El Administrador reembolsará la prima, si la hubiere, prorrateada a la fecha del incumplimiento de los Requisitos de Elegibilidad. Cualquier reclamo que ocurriese a partir de la fecha del incumplimiento de los Requisitos de Elegibilidad será negado. La omisión en la entrega de documentos con los requisitos de elegibilidad, dentro de los 30 días contados desde la fecha en que fuesen solicitados por el Administrador, resultará en la cancelación automática de la póliza y negación de cualquier reclamo.


                       </p>
 
                <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">B.	Fecha Efectiva Individual de Cobertura</span></p>
                      
                       <p>
                    Luego de la evaluación y Aprobación de cada Solicitante por el Administrador, la Cobertura comenzará a ser efectiva en la última de las siguientes fechas: (1) La fecha en la cual la Prima correcta y la Solicitud sean recibidas por el Administrador, o (2) La fecha en la que el Solicitante sea Aprobado por el Administrador.

                       </p>
                       
                      
                       
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 29 of 52</p>
            
             <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">C. Fecha de Terminación Individual de la Cobertura</span></p>
                   
                       <p>
                        La Cobertura terminará en la más temprana de las fechas siguientes: (1) La fecha hasta la cual la Prima ha sido pagada; (2) la fecha en que la Persona Asegurada deje de cumplir con los Requisitos de Elegibilidad descritos en la SECCION 3, A; (3) la fecha en que la Compañía cancele la Cobertura para una Clase específica de Personas Aseguradas, y en la cual la Persona Asegurada individual pueda estar incluida.

                       </p>
                       
                       
                        <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">D. Comienzo de los Beneficios</span></p>   
                       <p>
                           <b>No se pagará ningún Beneficio por gastos de cualquier condición médica o síntoma que se manifieste dentro de los primeros 90 días desde la Fecha Efectiva Individual de la Póliza, ni complicaciones futuras y/o gastos futuros derivados de ella o relacionados de ella, con la excepción de condiciones médicas causadas por Accidentes y/o Enfermedades infectocontagiosas.</b> La Compañía puede elegir exonerar esta disposición si una Póliza internacional de salud hubiese estado vigente con otra Compañía aseguradora durante los doce (12) meses consecutivos previos a Fecha Efectiva de la presente Póliza. La cláusula de Exoneración del Comienzo de los Beneficios está sujeta a la recepción de una copia del Certificado de Cobertura, Tabla de Beneficios y fechas de Cobertura de la Compañía aseguradora anterior, solo al momento de la Solicitud, con un anexo de exoneración del tiempo de espera de 90 días cual será emitido simultáneamente con la póliza. El tener una póliza médica internacional vigente al momento de la Solicitud no garantiza la exoneración de esta cláusula. La solicitud de periodo de espera no se aplica a la maternidad y beneficios de cuidados de rutina.
                       </p>
                       
                       
                       
                       
                       
                        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCIÓN 4: ALCANCE DE LA COBERTURA</h3>     
                       
                         <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">A. Descripción de la Cobertura</span></p>   
                       
                    
                       <p>
                          Los Gastos Cubiertos derivados de reclamos válidos serán pagados de acuerdo con los Beneficios Elegibles.
                       </p>
                       
                       <p>
                          Los Beneficios Elegibles serán pagaderos, al proveedor de servicio, o si no es posible a la Persona Asegurada por los Beneficios Elegibles incurridos por la Persona Asegurada en cualquier parte del mundo. <b>Para las admisiones Hospitalarias, sea en país de residencia, Estados Unidos o a nivel mundial, deberá utilizarse el programa de pre-notificación. Si no se utiliza el programa de Pre-notificación, resultará en un coaseguro de 50% de los Beneficios Elegibles detallados en la Tabla de beneficios.</b> 
                       </p>
                       <p>
                           Los cargos que aquí se mencionan no incluirán en ningún caso cantidad alguna que exceda los cargos Razonables y Acostumbrados. Un gasto hecho por un Persona Asegurada se considerará como Razonable y Acostumbrado, por concepto de los servicios y suministros recibidos a cambio, si no excede el cargo promedio por dichos servicios y suministros en la localidad donde fueron recibidos, considerando la naturaleza y severidad de la Lesión física o Enfermedad en conexión con la cual tales servicios y suministros fueron recibidos. Si el cargo sobrepasa dicho monto promedio, el excedente no será reconocido como Gasto Cubierto. Todos los cargos serán considerados como incurridos en la fecha de tales servicios y suministros, los cuales hubiesen dado lugar al gasto cargado, prestado u obtenido.


                       </p>
                       
                         <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">B. Beneficios Médicos</span></p> 
                       <p>
                           La Compañía pagará los Beneficios Elegibles hasta los límites indicado en la Tabla de Beneficios. La Cobertura está limitada a los Beneficios Elegibles incurridos, sujetos a las Exclusiones, Limitaciones y Disposiciones de esta Póliza. Todos los trastornos físicos simultáneos, debidos a una misma causa, o relacionados con ella, serán considerados 

                       </p>
                       
              
           
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 30 of 52</p>
            <p>
                como un Evento Cubierto. Si un Evento Cubierto se debe a la misma causa de un Evento Cubierto anterior, o está relacionado con ella (incluyendo las complicaciones resultado de esta), el Evento Cubierto se considerará una continuación del Evento Cubierto anterior y no uno independiente.
            
            </p>
            
                    <p>
                           Cuando la Persona Asegurada incurra en un gasto cubierto, la Compañía pagará los gastos médicos Razonables y Acostumbrados, en exceso del Deducible y Coaseguro, como se estipula en la Tabla de Beneficios. En ningún caso la responsabilidad máxima de la Compañía excederá el máximo establecido en la Tabla de Beneficios.
                            A efectos de esta sección, sólo aquellos gastos, en los que se incurra como resultado de un Evento Cubierto, los cuales estén específicamente enumerados en la siguiente lista, y que no figuren en las Exclusiones, serán considerados como Beneficios Elegibles.

                       </p>
            
            <ol style="font-size: 11px;">
               <li style="margin-bottom: 5px;">	Cargos de un Hospital, por habitación, comida, enfermeras en piso durante la Hospitalización, y otros servicios, inclusive cargos por servicios profesionales, con la excepción de servicios personales de naturaleza no médica, siempre y cuando esos gastos no excedan el cargo promedio del Hospital por ocupación con habitación privada y comida.
               </li>
               
               
               <li style="margin-bottom: 5px;">
                  Cargos por Cuidados Intensivos o Cardíacos y servicios de enfermería por Hospitalización. 
               </li>
               <li style="margin-bottom: 5px;">Cargos por concepto de diagnóstico, Tratamiento o Cirugía por parte de un Médico. Los cargos por un segundo cirujano se pagarán hasta un máximo del 30% de los honorarios del cirujano primario. Los cargos por un tercer o sucesivo cirujano no serán un beneficio médico elegible.</li>
               <li style="margin-bottom: 5px;">Cargos por el uso de la sala de operaciones.</li>
               <li style="margin-bottom: 5px;">Cargos por Tratamiento ambulatorio, al igual que por cualquier otro Tratamiento Cubierto durante una Hospitalización. Estos incluyen centros de Cirugía ambulatorios, visitas o exámenes médicos, cuidado clínico y consultas de opinión sobre Cirugía. </li>
               <li style="margin-bottom: 5px;">Cargos por el costo y administración de anestesia. Los cargos por el anestesiólogo se pagarán hasta un máximo del 30% de los honorarios de los cirujanos.</li>
               <li style="margin-bottom: 5px;">Cargos por Medicamentos, servicios de rayos x, exámenes y servicios de laboratorio, uso de radio e isótopos radiactivos, quimioterapia, oxígeno, sangre, transfusiones y respiradores.</li>
               <li style="margin-bottom: 5px;">Cargos por fisioterapia, si es recomendada por un Médico para el Tratamiento de un Siniestro Cubierto específico, y es administrado por un fisioterapeuta licenciado.</li>
               <li style="margin-bottom: 5px;">Pago por Habitación en un hotel, cuando la persona asegurada estaría de otra manera confinada en un hospital, será bajo el cuidado de un médico debidamente calificado en una habitación de hotel debido a la falta de disponibilidad de una sala de hospital por razones de capacidad, distancia o por cualquier otra circunstancia fuera del control de la persona asegurada.</li>
               <li style="margin-bottom: 5px;">Vendajes, medicamentos y medicinas que puedan ser obtenidas solamente por medio de una prescripción escrita del Médico o Cirujano.</li>
               <li style="margin-bottom: 5px;">Transporte local, al Hospital más cercano, o a la Clínica más cercana con las instalaciones para el Tratamiento requerido. Dicho transporte debe ser realizado sólo por una ambulancia terrestre autorizada, dentro del área metropolitana donde la Persona Asegurada se encuentre en el momento en que se haga uso del servicio. Si la Persona Asegurada se encuentra en un área rural, el transporte en una ambulancia terrestre autorizada hasta el área metropolitana más cercana, será considerado un Gasto Cubierto.</li>
               <li>Las condiciones médicas agudas están cubiertas de acuerdo con la Tabla de beneficios.</li>
                
            </ol>
            
               <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">C.	Beneficios de Embarazo</span></p> 
                       <p>
                           Cuando una persona asegurada, quien no es un hijo dependiente, queda en estado de embarazo y el mismo está cubierto bajo los beneficios de la Póliza, la Compañía pagará razonables y habituales gastos médicos, en exceso de los deducibles y coaseguros como se indica en la Tabla de Beneficios. Los gastos por Embarazo incurridos durante los primeros 12 meses del Período de Cobertura no se consideran Beneficios Elegibles. En ningún caso la 

                       </p>
          
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 31 of 52</p>
                <p>
                           responsabilidad máxima de la Compañía superará el máximo que se indica en la Tabla de Beneficios, como Beneficios Elegibles durante un embarazo. 
                       </p>
                         <p>
                             La persona asegurada o su representante deberá notificar previamente al Administrador de un embarazo dentro de los primeros ciento ochenta (180) días del Embarazo.
                         </p>
                         <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                 FALTA DE PRE-NOTIFICAR AL ADMINISTRADOR DE UN EMBARAZO DENTRO DE LOS PRIMEROS 180 DÍAS, RESULTARÁ EN UNA REDUCCIÓN DEL 50% DE LOS BENEFICIOS ELEGIBLES ESTABLECIDO EN LA SECCIÓN 2.B DE LA TABLA DE BENEFICIOS. ADEMÁS, EL PROGRAMA DE PRE-NOTIFICACIÓN DEBE SEGUIR LO ENUNCIADOEN EL PUNTO 4 K. PROGRAMA DE PRE-NOTIFICACIÓN.
                             </span>
                         </p>
                         
                         <p>
                           Los beneficios serán pagables para los Beneficios Elegibles incurridos antes, durante y después del parto de un niño, incluyendo el médico, hospital, laboratorio, y servicios de ultrasonido. Para la cobertura de Hospitalización posparto para la persona asegurada y su hijo recién nacido en un Hospital, como mínimo será por duración de la estancia recomendada por la Academia Americana de Pediatría y el Colegio Americano de Obstetras y Ginecólogos en sus directrices para Cuidado Prenatal, pero no superior a un máximo de 31 días.
                         </p>
                         
                         <p>
                             La cobertura de una duración de estancia más corta que el período mínimo mencionado anteriormente puede ser permitida si el Médico de la persona asegurada determina que los cuidados de hospitalización por posparto no son necesarios para la persona asegurada o su hijo recién nacido siempre que conste como sigue:
                         </p>
                         
                         <ol style="font-size: 12px;">
                             
                             <li>
                                	En opinión del Médico de la persona asegurada, el recién nacido cumple con los criterios de estabilidad médica en la guía para cuidados prenatales, preparado por la Academia de Pediatría y el Colegio Americano de Obstetras y Ginecólogos que determinan la duración apropiada de la estancia sobre la base de la evaluación de: (a) transcurso del ante parto, intraparto, posparto de la madre y el niño, (b) la etapa gestacional, peso al nacer, y la condición clínica del niño, (c) la capacidad demostrada por la madre para cuidar al niño una vez dada de alta, y (d) la disponibilidad de seguimiento después del alta para verificar el estado del niño después del alta, y
                             </li>
                             
                             <li>
                                 Se provee a la persona Asegurada una (1) visita en casa por cuidados después del parto por un médico o enfermera. Dicha visita será realizada no más de cuarenta y ocho (48) horas después del alta de la persona Asegurada y su hijo recién nacido del Hospital. La cobertura de esta visita incluye, pero no se limita a: (a) la educación de los padres, (b) asistencia en entrenamiento para alimentación por el seno materno o por el biberón, y (c) la ejecución de cualquier prueba de rutina materna o neonatal realizado durante el curso normal de atención hospitalaria para la persona asegurada o del niño recién nacido, incluida la recolección de una muestra adecuada para los análisis metabólicos y hereditarios del recién nacido. A discreción de la persona asegurada, esta visita puede ocurrir en el consultorio del médico.
                             </li>
                             
                         </ol>
                         
                         <p><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">D.	Beneficio Dental</span></p>
                         <p>
                             Cuando los gastos dentales cubiertos son incurridos por el Asegurado, la Compañía pagará los gastos razonables y habituales en exceso del Deducible como se indica en la Tabla de Beneficios. En ningún caso la responsabilidad máxima de la Compañía superara el máximo que se indica en la Tabla de Beneficios, como Beneficios Elegibles durante cualquier período de cobertura.

                         </p>
            
    
                      
                       
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 32 of 52</p>
                    <p>
                         A los efectos de esta sección, sólo los gastos incurridos como resultado de una condición elegible Odontológica, en el cual los servicios o medicamentos que se prescriben, realizado, u ordenado por un dentista y se enumeran a continuación, y que no figuran en las exclusiones, serán considerados como Beneficios Elegibles.
                       </p>
                       
                       <ol style="list-style-type: lower-roman; font-size: 11px;">
                           <li>Una condición dental elegible se refiere a una emergencia de reparación o sustitución de dientes naturales, los dientes naturales dañados como resultado de un accidente cubierto.</li>
                           <li>El tratamiento debe ser completado dentro de los 3 meses siguientes del accidente.</li>
                       </ol>
                       
                       <p>No se pagarán beneficios bajo esta cobertura dental por cargos de Ortodoncista, Soportes de Ortodoncia (Brackets), Invisalign o Retenedores.
                       </p>
                     
                         <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                E.	Beneficio por Evacuación / Repatriación Médica de Emergencia
                             </span>
                         </p>
                         
                         <p>
                          La Compañía pagara los Beneficios Elegibles incurridos hasta el máximo indicado en la Tabla de Beneficios, en caso de cualquier enfermedad o lesión cubierta que comience durante el Periodo de cobertura de la persona asegurada resulta una emergencia médicamente necesaria de evacuación médica de emergencia o la repatriación de la persona asegurada. La decisión de una evacuación médica de emergencia o la repatriación debe ser ordenada por el Administrador de la Compañía en consulta con el médico tratante de la persona asegurada.
                         </p>
                         
                         <p>
                           Evacuación médica de emergencia o de repatriación se entiende: a) la condición médica de la persona asegurada requiere transporte inmediato desde el lugar donde la persona Asegurada está enferma o herida, hacia al centro médico adecuado más cercano, donde el tratamiento médico se pueden obtener, o b) después de haber sido tratado a nivel local en un centro médico como consecuencia de una evacuación médica de emergencia, la condición médica de la persona asegurada es tal que necesita transportación con un médico calificado a su actual país de origen para obtener tratamiento médico o para recuperarse, o ambos a) y b).
                         </p>
                         
                        <p>
                            A los efectos de esta sección, sólo esos gastos, incurridos como resultado de un evento cubierto, que estén específicamente enumerados en la siguiente lista, y que no figuren en las exclusiones, se considerarán como Beneficios Elegibles:
                        </p>
                         
                       <ol style="font-size: 12px;">
                           <li>	Los Beneficios Elegibles son los gastos hasta el máximo indicado en la Tabla de Beneficios para el transporte, los servicios médicos y suministros médicos necesarios efectuados en el marco de una evacuación médica de emergencia o repatriación del asegurado. Todos los arreglos de transporte deben ser por la ruta más directa y económica.</li>
                           <li>	Los gastos de transporte especial, suministros médicos y servicios deben ser: (a) pre-aprobados y ordenados por el Administrador designado por la Compañía y (b) el requerido por las regulaciones normales de transporte de la persona asegurada. Medios de transporte se refiere ya sea por tierra, agua o aire necesario para el transporte de la persona asegurada. Transporte especial incluye, pero no se limita a, ambulancias terrestres y aéreas, las líneas aéreas comerciales, privadas y los vehículos de motor.</li>
                           <li>	Todos los medios de transporte en conexión de una evacuación médica de emergencia o repatriación deben ser pre-aprobada y organizada por un Administrador designado por la Compañía.</li>
                           <li> La decisión de que hospital y a qué ciudad o país transportar al Asegurado es completamente la decisión del Administrador o el representante designado por el Administrador de la Compañía.</li>
                       </ol>
              
                  
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 33 of 52</p>
                        <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                              F.	Beneficio por Repatriación de Restos Mortales
                             </span>
                         </p>
                         
                         <p>
                         El Beneficio por Repatriación de Restos Mortales se aplicará solamente cuando la Persona Asegurada se encuentre viajando fuera de su País de Residencia actual. La Compañía pagará beneficios por los Beneficios Elegibles en los que se incurra hasta el máximo estipulado en la Tabla de Beneficios, ya sea cualquier Enfermedad o Lesión que hubiese comenzado durante el Periodo de Cobertura de la Persona Asegurada, diera como resultado la Repatriación de Restos Mortales de la Persona Asegurada. La Compañía pagará los Beneficios Elegibles razonables en los que se incurra para el regreso de los restos de la Persona Asegurada a su País de Residencia actual, si fallece.
                         </p>
                         
                         <p>
                          A efectos de esta sección sólo aquellos gastos en los que se incurra como resultado de un Evento Cubierto, que se encuentren específicamente enumerados a continuación y que no formen parte de las Exclusiones, serán considerados Beneficios Elegibles.
                         </p>
                         
                     
                         
                       <ol style="font-size: 12px;">
                           <li>Los Beneficios Elegibles incluyen, pero no se limitan a, gastos por embalsamar el cuerpo, un contenedor apropiado para el traslado, costos de envío y las autorizaciones gubernamentales pertinentes.</li>
                           <li>	Todos los gastos Cubiertos realizados en conexión con un Traslado de Restos Mortales   deben ser pre-Aprobados y ordenados por la Compañía de asistencia que representa a la Compañía. </li>
                           <li>	Todos los medios de transporte en conexión de una evacuación médica de emergencia o repatriación deben ser pre-aprobada y organizada por un Administrador designado por la Compañía.</li>
                           <li> Beneficios elegibles hasta $1500 para gastos funerarios en país de residencia.</li>
                       </ol>
            
                      
                          <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                              G.	Beneficio de Reunión Médica de Emergencia
                             </span>
                         </p>
                         
                         <p>
                       El Beneficio de Reunión Médica de Emergencia se aplicará solo cuando la Persona Asegurada se encuentre viajando fuera de su País de Residencia actual. En ningún caso la responsabilidad máxima de la Compañía superará el máximo establecido en la Tabla de Beneficios, respecto a los Beneficios Elegibles, durante cualquier Periodo de Cobertura dado. Cuando una Persona Asegurada es elegible para el Beneficio de Evacuación o Repatriación Médica de Emergencia, bajo esta Póliza, y el Administrador conjuntamente con el Médico tratante determinen que la Evacuación o Repatriación Médica de Emergencia es necesaria y prudente para la Persona Asegurada, corresponderá un Beneficio de Reunión Médica de Emergencia.
                         </p>
                         
                         <p>
                         A efectos de esta sección sólo aquellos gastos en los que se incurra como resultado de un Siniestro Cubierto, que se encuentren específicamente enumerados a continuación y que no formen parte de las Exclusiones, serán considerados Beneficios Elegibles:
                         </p>
                         
                     
                         
                       <ol style="font-size: 12px;">
                           <li>El costo de un boleto aéreo de ida y vuelta en clase económica para una persona seleccionada por la Persona Asegurada, desde el País de Residencia de la Persona Asegurada hasta la localidad donde esta se encuentre hospitalizada, y regreso al País de Residencia actual.</li>
                           <li>Gastos razonables de viaje y alojamiento, en los que se incurra en relación con la Reunión Médica de Emergencia, hasta el máximo establecido en la Tabla de Beneficios, los cuales no excederán de $200 por día. </li>
                           <li>La duración de la Reunión Médica de Emergencia no excederá los 10 días incluyendo el viaje.</li>
                           <li>Todo traslado relacionado con una Reunión Médica de emergencia, debe ser pre aprobado y ordenado por un representante del Administrador designado por la Compañía.</li>
                       </ol>
    
                    
                     
                         <p>
                             <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                             H.	Muerte Accidental y Desmembramiento
                             </span>
                         </p>
   
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 34 of 52</p>
                    <p>
                       La póliza ofrece un Suma Máxima Principal de $10,000 en caso de muerte accidental del Asegurado Principal, $5000 para el Cónyuge y $2,500 por Dependiente. 
                         </p>
                         
                         <p>
                         Cobertura opcional adicional se puede adquirir en el momento de la solicitud o renovación de hasta $100.000 por muerte accidental y desmembramiento (AD &amp; D)
                         </p>
                         
                         <p style="border-bottom: 1px solid #000; display: inline-block;">Tabla de Pérdidas</p>
                         
                         <table style="margin: auto; border-collapse: collapse;">
                             <tr>
                                 <td style="border-bottom: 1px solid #000;">Descripción de la Pérdida (Por perdida de:)	</td>
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
                                 <td>Paraplejia (parálisis total de ambos miembros inferiores)	</td>
                                 <td>75%</td>
                             </tr>
                             
                             <tr>
                                 <td>Hemiplejia (parálisis total de las extremidades superior e inferior de un lado del cuerpo) 	50%
                                    Uniplejia (parálisis total de una extremidad)	
                                </td>
                                 <td>25%</td>
                             </tr>

                         </table>
                         
         
                         
                         <p>
                      Límite Global de Indemnización por Accidentes por familia asegurada: cinco veces la suma principal a un total máximo de $100,000.
                         </p>
                         
                         <p>
                         ALa Compañía deberá pagar una indemnización determinada por el Plan de Beneficios y la Tabla de Perdidas, si la persona asegurada sufra una Pérdida como resultado de lesiones, siempre que:
                         </p>
                         
                     
                         
                       <ol style="font-size: 12px;">
                           <li>Pérdida se produce dentro de 90 días después de la fecha del accidente que causó la pérdida causando dicha Perdida, y</li>
                           <li>el pago de Indemnización por dicha Pérdida será la suma principal indicada en la Tabla de Beneficios y Tabla de pérdidas, según corresponda a dicha Persona Asegurada y este Seguros, y </li>
                           <li>si más de una Pérdida indicada en la Tabla de Perdidas se produce como el resultado de un accidente, sólo una de las cantidades que figuran en dicha tabla, el más grande, se pagará.</li>
                    
                       </ol>
                       
                        <p>   <span style="border-bottom: 1px solid #000;">Exposición</span>   <br>      
                        Si por causa de un accidente cubierto por la Póliza, una persona Asegurada está inevitablemente expuesta a los elementos y, como resultado de dicha exposición sufre una pérdida para el cual la Suma Principal es de otro modo cubierta, será cubierta por los términos de la Póliza.
                        </p>


                         <p>   <span style="border-bottom: 1px solid #000;">Desaparición</span>   <br>      
                        Si el cuerpo de una persona asegurada no se ha encontrado dentro de un año posterior la desaparición de un avión que aterrice forzado, el hundimiento o naufragio de un medio de transporte en el que el Asegurado era uno de los ocupantes, entonces se considerará, sujeto a todas las los demás términos y disposiciones de la Póliza, que el asegurado ha sufrido la Pérdida de la Vida según el significado de la Póliza.
                        </p>
            
            

                         <p>   <span style="border-bottom: 1px solid #000;">Designación del beneficiario y el cambio</span>  </p>   
                     
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
                    <p class="page_no">Page 35 of 52</p>
                      <p>El beneficiario o beneficiarios de una persona Asegurada deberá ser el cónyuge o los hijos mencionados en esta Póliza o el pariente más cercano en el siguiente orden: esposa, hijos, padre, madre, hermano o hermana o siguiente pariente más cercano.
                        </p>
                        
                        <p>   <span style="border-bottom: 1px solid #000;">Muerte en Transporte Público y Desmembramiento Accidental - Descripción Adicional</span>   <br>      
                     Muerte Accidental y Desmembramiento se brinda a una persona asegurada y se aplicará sólo a las lesiones, sostenidas por la persona Asegurada en el transcurso de la cobertura. Dicho seguro incluye lesiones tales sufridas durante un viaje en el cual el Asegurado está viajando como pasajero. No se aplicará cobertura cuando un piloto, operador o miembro de la tripulación en o sobre, subiendo o bajando de él:
                        </p>
                        
                        <p>
                            1.	cualquier aeronave civil que posea un Certificado de Aeronavegabilidad vigente y válido, y pilotado por una persona que posee un certificado válido y vigente de competencia que lo autoriza a pilotar las aeronaves, o
                        </p>
                        
                        <p>
                            2.	cualquier tipo de aeronave de transporte operados por el Comando de Transporte Aéreo Militar (MAC) de los Estados Unidos, o por el servicio de transporte aéreo similar de cualquier autoridad gubernamental debidamente constituido de cualquier otro país reconocido, este seguro no se aplicará mientras el Asegurado viaje en cualquier aeronave civil o militar que no sea expresamente descrito anteriormente, a menos que sea previamente aceptadas por escrito por la Compañía.
                        </p>
                        
                        <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                I.	Programa de Pre-Notificación
                            </span>
                        </p>
                        <p>
                            El Programa de Pre-Notificación requiere que la persona asegurada (o alguien en su nombre) obtenga la pre-notificación poniéndose en contacto con el Administrador tan pronto como sea posible, pero no menos de 7 a 10 días laborables antes de la fecha de un ingreso hospitalario programado dentro o fuera de país de residencia, dentro de 72 horas después de un ingreso en el hospital de emergencia en cualquier parte del mundo. Además, los servicios ambulatorios que excedan $1.000 deben ser previamente notificados de la misma manera como un ingreso en el hospital. El Programa de Pre-Notificación también requiere que la persona asegurada utilice la Red aprobada de Proveedores Preferidos (PPO) para los servicios y los tratamientos recibidos en los Estados Unidos.
                        </p>
                        <p>
                            El programa de Pre-Notificación requiere que la Persona Asegurada cumpla con el siguiente procedimiento:
                        </p>
                        
                        <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                1.	Contactar a El Administrador
                            </span>
                        </p>
                        <p>
                            Los métodos aceptables para contactar al Administrador incluyen teléfono, fax y correo electrónico. Con el fin de completar la Pre-Notificación, el Administrador necesitará obtener de la Persona Asegurada lo siguiente: Número de Póliza, nombre del paciente, teléfono del paciente (y/o dirección de correo electrónico), nombre y teléfono del Hospital, nombre y teléfono del Médico tratante, diagnóstico y número de días de hospitalización.
                        </p>
                        <p>El Administrador puede ser contactado en:</p>
                        
                        <ul style="list-style-type: none; padding: 0px;">
                            <li>Global Assurance Group</li>
                            <li>801 NE 167 St</li>
                            <li>2nd Floor</li>
                            <li>North Miami Beach, FL 33162</li>
                            <li>Teléfono: 305-493-3071</li>
                            <li>Fax: 305-493-3078</li>
                            <li>Correo electrónico:<a href="claims@claria.us/medical@claria.us">claims@claria.us/medical@claria.us</a></li>
                        </ul>

                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
       <p class="page_no">Page 36 of 52</p>
                    <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                2.- Contactar a la Compañía de Asistencia
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
                           Los servicios y Tratamientos en los Estados Unidos deberán ser recibidos en un establecimiento aprobado de la Red de Hospitales (PPO), si uno existiese a 75 millas de donde la persona asegurada se encuentra. Para obtener una lista de servicios de proveedores aprobados, contactar al Administrador.
                        </p>
                 
                       <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                               La omisión en seguir el procedimiento, descrito en los párrafos 1 y 3 del programa de Pre-Notificación, resultará en un coaseguro del 50% en los Beneficios Elegibles estipulados en la Tabla de Beneficios.
                            </span>
                        </p>
                        
                        <p>
                            Los Beneficios pagaderos de acuerdo a esta Póliza están todavía sujetos a elegibilidad al momento en que realmente se incurra en los cargos, y a todos los otros términos, limitaciones y Exclusiones de la Póliza. La Pre-Notificación no garantiza ni confirma los beneficios bajo esta Póliza.
                        </p>
                        
                        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCIÓN 5: EXCLUSIONES</h3>
                        
                        <p>
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                A.	Exclusiones de los Beneficios Médicos
                            </span>
                        </p>
                        <p>
                            Este seguro no cubre ningún tipo de tratamiento, medicación, los cargos o sus consecuencias, en relación con las siguientes exclusiones, al menos que sean específicamente incluidas o modificadas en la Lista de Beneficios del número 1 al 27 de esta Póliza. En cuanto a las prestaciones médicas de este seguro no cubre los gastos en relación a o en conexión con:
                        </p>
                        
                        <ol style="padding: 0px; font-size: 11px;">
                            <li>Condiciones Pre-Existentes que consistan en cualquier Enfermedad o Lesión que cumpla con cualquiera de los siguientes criterios: 1) Una condición que habría causado que una persona buscase consejo, diagnóstico, cuidado o Tratamiento médico antes de la Fecha Efectiva Individual de Cobertura de esta Póliza; 2) Una condición por la cual se buscó, recomendó o recibió consejo, diagnóstico cuidados o Tratamiento médico antes de la Fecha Efectiva Individual de Cobertura de esta Póliza; 3) los síntomas que se produjeron antes de la fecha efectiva de la cobertura individual en virtud de este Certificado que han permitido a una persona entrenada en medicina realizar un diagnóstico de la condición que produce los síntomas; 4) una condición que se manifieste antes de la Fecha Efectiva Individual de Cobertura bajo esta Póliza; 5) gastos por Embarazo incluido antes y después del nacimiento, complicaciones de la madre al momento del parto o el recién nacido durante los primeros doce (12) meses desde la Fecha Efectiva Individual de Cobertura bajo esta Póliza. El Administrador puede emitir Cláusulas de Exclusión para ciertas condiciones Pre-Existentes que estén completa y exactamente descritas en la Solicitud y sean Aprobadas y aceptadas por el Administrador, sin una Cláusula de Exclusión ni otra restricción, estarán automáticamente cubiertas al mínimo vitalicio de $50.000 y de$5.000 límite por Periodo de Cobertura, después que la Persona Asegurada haya estado asegurada continuamente durante 24 meses. En el tiempo de suscripción y a discreción del Administrador se ofrecerán límites más altos de beneficios.</li>
                            <li>Lesión o Enfermedad que no sean presentados a la Compañía para su pago dentro de los noventa (90) días siguientes al Incidente que causó los gastos.</li>
                        </ol>
                      
    
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 37 of 52</p>
       
                       <ol style="padding: 0px;font-size: 11px;" start="3">
                            <li style="margin-bottom: 8px;">Tratamientos que no sean Médicamente Necesarios. Servicios, tratamiento o suministros incluyendo cualquier periodo de permanencia en el hospital, el cual no sea recomendado, aprobado y certificado como médicamente necesario y razonable por un doctor.
                            </li>
                            <li style="margin-bottom: 8px;">Servicios proporcionados sin costo a la Persona Asegurada.</li>
                            
                            <li style="margin-bottom: 8px;">Tratamiento que exceda los cargos Razonables y Acostumbrados.</li>
                            <li style="margin-bottom: 8px;">Cirugías, Medicación o Tratamientos que sean Experimentales, de Investigación o destinados a Investigación.</li>
                            <li style="margin-bottom: 8px;">Suicidio o cualquier intento de ello estando cuerdo, o daño auto-infligido o cualquier intento de ello, estando demente. </li>
                            <li style="margin-bottom: 8px;">Guerra, hostilidades u operaciones bélicas (ya sea guerra declarada o no), invasión, la Ley de un enemigo extranjero a la nacionalidad de la persona asegurada o del país, o más, que se produce el hecho, la guerra civil, de represión de disturbios, rebelión, insurrección , Revolución, el derrocamiento del gobierno legalmente constituido, conmoción civil asumiendo la proporción de, o que asciende a un levantamiento, militar o usurpación de poder, explosiones de armas de guerra, la utilización de armas nucleares, químicas o biológicas de destrucción masiva quien sea haya o pueda haber distribuido o combinado, Asalto Asesinato posteriormente fuera de toda duda razonable que ha sido el acto de los agentes de un Estado extranjero a la nacionalidad de la persona asegurada si se declara la guerra con ese Estado o no, actividad terrorista o la contaminación radiactiva. Pandemias y / o epidemias para las cuales la OMS (Organización Mundial de la Salud) ha declarado una emergencia sanitaria mundial, ha declarado la fase 5 y / o han sido colocados bajo la dirección de las autoridades públicas.
                            A los efectos de la exclusión # 8
                                    <ol style="list-style-type: lower-alpha; font-size: 11px; margin-top: 20px;">
                                        <li style="margin-bottom: 5px;">Actividad terrorista significa un acto o acto(s) de cualquier persona(s) o grupo(s) de personas, cometidos con fines políticos, religiosos, ideológicos o afines, con la intención de influir sobre cualquier gobierno y/o atemorizar al público o a cualquier sector de este. La Actividad terrorista puede incluir, aunque no está limitada a, el uso real de fuerza o violencia y/o la amenaza de tal uso. Además, los perpetradores de actividad terrorista pueden actuar solos, ya sea en nombre de o en conexión con cualquier organización(es) y/o gobierno(s).</li>
                                        <li style="margin-bottom: 5px;">Uso de Armas Nucleares de destrucción masiva significa el uso de cualquier dispositivo o arma explosiva nuclear, o la emisión, descarga, dispersión, liberación o escape de material fisionable, que emita un nivel de radiactividad capaz de causar incapacidad o muerte en la población.</li>
                                        <li style="margin-bottom: 5px;">Uso de armas Químicas de destrucción masiva significa la emisión, descarga, dispersión, liberación o escape de cualquier compuesto químico sólido, líquido o gaseoso, que, al ser esparcido de cierta manera, es capaz de causar incapacidad o muerte en la población.</li>
                                        <li style="margin-bottom: 5px;">Uso de armas Biológicas de destrucción masiva significa la emisión, descarga, dispersión, liberación o escape de cualquier microorganismo patógeno (que produce Enfermedades) y/o toxinas producidas biológicamente (incluyendo organismos modificados genéticamente y toxinas sintetizadas químicamente), que sean capaces de causar incapacidad o muerte entre la población.</li>
                                        <li style="margin-bottom: 5px;">También se excluye a este respecto toda Pérdida o gasto de cualquier índole que, directa o indirectamente, surja de, contribuya a, sea causado por, resulte de, o esté asociado con cualquier acción ejecutada en el control, prevención o supresión de alguna o todas las situaciones descritas anteriormente. En el caso que cualquier parte de esta Exclusión se halle como inválida o inejecutable, el resto permanecerá íntegramente en vigor y con efecto.</li>
                                    </ol>
                            
                            
                            
                            
                            </li>
                            <li style="margin-bottom: 8px;">Lesiones sufridas durante la participación de eventos organizados, profesional, o deportivo para principiantes.</li>
                            <li style="margin-bottom: 8px;">Condición (es), o síntomas que se manifiesten dentro de los 90 días siguientes a la fecha efectiva del certificado y complicaciones futuras y / o todos los gastos médicos futuros derivados del mismo o relacionados con el mismo, con excepción de las condiciones médicas causadas por accidentes y / o enfermedades infectocontagiosas o si el período de espera de 90 días es eliminado por escrito por el Administrador en el momento de emisión de la póliza.
                            </li>
                        </ol>
                        
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
       <p class="page_no">Page 38 of 52</p>
            <ol style="padding: 0px; font-size: 11px" start="11">
                        
                                <li style="margin-bottom: 8px;">A no ser que el plan prevea otra cosa, Vacunas, inoculaciones, reconocimientos de rutina, exámenes médicos preventivos, pruebas genéticas, chequeos o exámenes integrales, u otros exámenes donde no existan indicaciones objetivas de perjuicio de la salud, y exámenes de laboratorio o radiológicos para diagnóstico, excepto en el curso de un Evento Cubierto establecido por una consulta previa o la atención de un Médico.</li>
                                <li style="margin-bottom: 8px;">Tratamiento de la articulación temporo-mandibular (ATM).</li>
                                <li style="margin-bottom: 8px;">Terapia Vocacional, laboral, rehabilitante, física, recreacional, del lenguaje o músico-terapia, sea ambulatoria o durante una hospitalización, al menos que esté incluida en la lista de beneficios.</li>
                                <li style="margin-bottom: 8px;">Tratamiento dado por un médico, médico general, doctor, especialista o consultor que se encuentra de modo alguno relacionado con la persona asegurada o quien no es reconocido por las autoridades del país en el que el tratamiento se lleva a cabo con conocimientos especializados o, experiencia en el tratamiento de la enfermedad, o lesión que se está tratando.</li>
                                <li style="margin-bottom: 8px;">Cirugía cosmética o plástica, ya sea por razones psicológicas o de otro tipo, y las posibles consecuencias y / o los gastos médicos relacionados con él, salvo como consecuencia de un accidente cubierto como se indica en la Tabla de beneficios. Para efectos de este seguro, el tratamiento de un tabique nasal desviado, se considerará una condición cosmética. </li>
                                <li style="margin-bottom: 8px;">El tratamiento, la adquisición e instalación de falsos dientes o prótesis dentales. Los reclamos por exámenes auditivos, audífonos, perforación oreja y del cuerpo. Reclamos por el suministro o la instalación de los dispositivos físicos o que no forman de una parte permanente del cuerpo.</li>
                                <li style="margin-bottom: 8px;">Refracciones oculares o exámenes de la vista a los efectos de la prescripción de lentes correctores o gafas o para su instalación y ceratotomía radial, a menos que sean causados por lesiones corporales accidentales mientras esté asegurado, el tratamiento para corregir la vista corta o larga, incluyendo lentes, gafas, y lentes de contacto.</li>
                                <li style="margin-bottom: 8px;">Los costos del tratamiento que hayan incurrido como consecuencia de complicaciones directamente causadas por una enfermedad, lesión o tratamiento para que la cobertura se limita o excluya.</li>
                                <li style="margin-bottom: 8px;">Consultas telefónicas o la inasistencia a una cita programada.</li>
                                <li style="margin-bottom: 8px;">Mientras que el tratamiento se limite principalmente a recibir cuidados no médicos para servicios y asistencia personal, educación o rehabilitación y los servicios de enfermería en una instalación de cuidados a largo plazo, spa, hidroclínicas, clínica de pérdida de peso, sanatorio, hogar de ancianos o instalaciones similares.</li>
                                <li style="margin-bottom: 8px;">Enfermedades congénitas, nacimientos prematuros, defectos congénitos y las condiciones que surjan como resultado de los mismos.</li>
                                <li style="margin-bottom: 8px;">Servicios o suministros que no sean de índole médica.</li>
                                <li style="margin-bottom: 8px;">El valor del boleto aéreo de regreso al País de Residencia, no usado por la Persona Asegurada, en el caso que se presten los servicios de una Evacuación o Repatriación Médica de Emergencia y/o la Repatriación de los Restos Mortales. </li>
                                <li style="margin-bottom: 8px;">Lesiones o Enfermedades intencionales o auto infligidas.</li>
                                <li style="margin-bottom: 8px;">Comisión de un delito grave.</li>
                                <li style="margin-bottom: 8px;">Lesión sufrida durante la práctica de: alpinismo donde normalmente se usen sogas o guías, paracaidismo, parapente, salto con Bunge, carreras de caballos, autos, o motociclismo, submarinismo con aparatos de respiración bajo el agua, salvo por certificación PADI o NAUI.</li>
                                <li style="margin-bottom: 8px;">
                                   Tratamiento pagado por o proporcionado bajo cualquier otra Póliza individual o colectiva u otro servicio o plan médico pre-pagado contratado a través del empleador, al grado de ser suministrado o pagado, o bajo cualquier programa gubernamental obligatorio, o instalación establecida para Tratamiento sin costo para ninguna persona; sin importar que la fecha de emisión de la otra póliza sea previa o posterior a la emisión de la presente póliza; en todos los casos la presente póliza pagará los gastos médicos sólo de manera posterior y en exceso, una vez que todos los beneficios de las pólizas válidas y existentes hayan sido completamente pagados y agotados.
                                </li>
                     
                        </ol>
                      
                        
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 39 of 52</p>
       
                      <ol style="padding: 0px; font-size: 11px" start="28">
                           <li style="margin-bottom: 8px;">
                              Lesiones por la cuales los beneficios sean pagaderos por una Póliza de responsabilidad civil de automóviles.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Tratamiento de Virus del Papiloma Humano, Enfermedades venéreas, Enfermedades de transmisión sexual o gastos por cambio de sexo.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Salvo que se haya dispuesto otra cosa bajo el plan de Tratamiento Dental Rutinario: exámenes odontológicos preventivos, tratamiento profiláctico, chequeos, raspado, limpieza o pulido de dientes, servicios para el cuidado odontológico de los dientes o del periodonto, o del tejido o estructura circundante, excepto los derivados de una Lesión de los dientes sanos, naturales, causada por un Accidente. No serán Beneficios Elegibles ninguno de los gastos médicos derivados de ello y/o relacionados con los tratamientos incursos en esta exclusión, incluyendo, pero sin limitarse a infecciones.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Gastos por el Embarazo / maternidad incurridos por un hijo dependiente.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                              Tratamientos, medicamentos o procedimientos que, ya sea que promuevan o sea que prevengan, la concepción o eviten el nacimiento de un niño, incluyendo, aunque no limitado a: Reclamos por cualquier tipo de contracepción o fertilización, tratamiento para problemas sexuales, (incluyendo impotencia, cualquiera sea la causa), reproducción asistida (por ejemplo, tratamiento IVF), interrupción del embarazo, inseminación artificial, fertilización in vitro, transferencia intra falopiana de gameto (GIFT), Tratamiento por infertilidad o impotencia, esterilización o reversión de ella, o aborto. Maternidad, el parto, las complicaciones y la cobertura de los niños que son el resultado de cualquier forma de reproducción asistida y los defectos de nacimiento, congénita o hereditaria, que las condiciones están presentes en el nacimiento ya sean o no diagnosticadas no serán cubiertas.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Beneficios relacionados con condiciones o trastornos de adicción, alcoholismo y drogadicción, o abuso de sustancias o solventes, ya sea que estén relacionados o no con drogas o tratamientos prescritos, muerte o tratamiento por alguna lesión sufrida bajo la influencia total o parcial de los efectos del abuso de drogas, alcohol, sustancia o solventes. 
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                              Cualquier desorden mental o nervioso o curas de sueño, salvo que esté cubierto de otra manera en esta Póliza 
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Tratamiento por Síndrome de Fatiga Crónica, incluyendo, aunque no limitado a, estudio de diagnóstico.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                             Servicio o tratamiento de cualquier forma de suplemento alimenticio o el aumento o para cualquier programa de control de peso, ya sea para la obesidad o cualquier diagnóstico, por dieta, inyección de cualquier fluido, o el uso de los medicamentos o cirugía de cualquier tipo, incluyendo los programas para dejar de fumar.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Atención quiropráctica, salvo incluidos en esta póliza.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Alquiler o compra de equipos médicos no desechables fuera de un Hospital, sillas de rueda, tanques de oxígeno y andaderas, aunque sin limitarse a ellas.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Operaciones de rescate por agua o tierra.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Tratamiento para enfermedades o lesiones resultantes de o en el curso de cualquier empleo para el cual el Asegurado ha recibido un salario o beneficio.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                             Tratamiento, servicios y suministros para el Tratamiento de pie plano, arcos caídos, callos, juanetes, y cuidado de las uñas de los Pies.
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                              Tratamiento, servicios y suministros por Convalecencia, Hospicio o Cuidados a Domicilio. Atención para pacientes terminales y/o cuidados paliativos. Tratamiento y los costos de una máquina para soporte vital artificial o un dispositivo similar y los costos de la atención y tratamiento asociados con el uso de la máquina como soporte de vida artificial o un dispositivo similar más allá de los primeros 7 días de uso.
                           </li>
                           
                           <li style="margin-bottom: 8px;">Los costos de transporte que no sean de emergencia, excepto el transporte de ambulancia del Hospital y, en particular, los costos derivados de los viajes realizados específicamente con el fin de obtener tratamiento médico están excluidos.
                               
                           </li>
                           
                           <li style="margin-bottom: 8px;">
                               Todo Reclamo que surja de tareas realizadas contrariando el consejo de un Médico, cuando la Persona Asegurada ha recibido un pronóstico terminal o está sufriendo una condición crónica.
                           </li>
                           <li style="margin-bottom: 8px;">Terapia de reemplazo hormonal (HRT), a menos que se realice como parte de, o inmediatamente después, de un procedimiento quirúrgico que esté cubierto bajo la Tabla de Beneficios de este Plan.</li>
                     
                        </ol>
                        
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 200px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            <p class="page_no">Page 40 of 52</p>
            <ol style="padding: 0px; font-size: 11px" start="46">
                                <li>Tratamiento de la apnea del sueño (paro temporal de la respiración durante el sueño), ronquidos o cualquier otro trastorno respiratorio asociado al sueño.</li>
                                <li>Tratamiento de una condición alérgica o cualquier trastorno que el Asegurado conocía al momento de la solicitud y que no fue declarado.</li>
                                <li>Tratamiento por dificultades de aprendizaje, problemas mentales y problemas físicos del desarrollo.</li>
                                <li>Tratamiento por un estimulador de crecimiento óseo, estimulación del crecimiento óseo, o tratamiento relacionado con la hormona del crecimiento, independientemente de la razón por la cual se receta.</li>
                                <li>Esta póliza no pagará por gastos causados directa o indirectamente por error en tratamiento quirúrgico, error u omisión de cualquier médico, enfermera, médico, cirujano, dentista, asistente médico, técnico, farmacéutico u otro profesional de la medicina. Esto incluye, pero no se limita a la prestación o falta de proporcionar servicio o tratamiento médico o profesional, La omisión por un profesional de la salud en los que el tratamiento siempre cae por debajo de las normas aceptadas de la práctica en la comunidad médica y causa lesiones o la muerte del paciente.</li>
                                <li>Cargos por atención hospitalaria si el Asegurado abandona un hospital en contra de las indicaciones del médico, cargos de hospitalización y cargos ambulatorios como resultado directo del no cumplimiento voluntario de la atención médicamente necesaria y del tratamiento médico prescrito cuando el Asegurado tiene conocimiento de dichas indicaciones.</li>
                                <li>Tratamiento que se realicen a los asegurados para las pruebas de lo siguiente: el VIH, la seropositividad para el virus del SIDA, las enfermedades relacionadas con el SIDA, Síndrome de ARCO, o con SIDA. Tratamientos contra el virus del Sida, Enfermedades relacionadas con el SIDA, Síndrome de ARC, Sida, y/o cualquier Enfermedad surgida como complicaciones de estas condiciones salvo que esté cubierto de otra manera en esta Póliza.</li>
                             
                     
                        </ol>
                        
                        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">SECCIÓN 6: DISPOSICIONES DE LA PÓLIZA</h3>
                        
                        <ol style="font-size: 12px;">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Contrato Integro; Cambios: </span>Esta Póliza, incluyendo la, Solicitud, la Tabla de Beneficios, Cláusulas de Exclusión, enmiendas y documentos anexos, si los hubiere, constituye el contrato íntegro de Seguro. Ningún cambio en la Póliza será válido hasta que sea Aprobado por un funcionario ejecutivo del Administrador, o a menos que dicha Aprobación al respecto sea endosada. Ningún agente tiene la autoridad para cambiar esta Póliza o para exonerar de cualquiera de sus disposiciones.</li>
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Prueba de Pérdida: </span>La carga de la prueba radica en el reclamante. Se debe proporcionar al Administrador la Prueba de Pérdida, por escrito, debidamente firmado en la forma de un formulario para reclamos en los Estados Unidos, un formulario de autorización de reclamos HIPAA, en sus oficinas, dentro de los noventa (90) días siguientes a la fecha del Siniestro Cubierto. El incumplimiento en la entrega de dichas pruebas invalidará el reclamo. No obstante, el incumplimiento en la entrega de dichas pruebas dentro de tal lapso no invalidará ni rebajará ningún Reclamo, si no hubiese sido razonablemente posible presentar la prueba dentro de dicho plazo, siempre y cuando las pruebas sean entregadas tan pronto como sea razonablemente posible. Donde la Compañía considere que una consecuencia no queda cubierta por la póliza debido a una exclusión, al contrario, la carga de la prueba estará en la persona asegurada.<br>
                            Cuando una reclamación por un accidente se presenta información detallada y explicación de las circunstancias del accidente deben presentarse incluidos los informes de la policía o cualquier otro documento que la Compañía puede solicitar apoyo a la prueba de la pérdida. <br><br>
                            Presentar una reclamación fraudulenta será causa para que La Compañía cancele la póliza sin declaración judicial
                            </li>
    
                        </ol>
                 
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
        <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 41 of 52</p>
            <ol style="font-size: 12px;" start="3">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Pago de los Reclamos:  </span>Pago por Beneficios Elegibles serán realizados de forma directa al hospital, médico o proveedor. Una vez que una Persona Asegurada haya recibido la pre-autorización y Aprobación para un Tratamiento elegible con Hospitalización, debido a Accidente, Lesión, Enfermedad, afección o dolencia, los costos elegibles serán arreglados directamente con el(los) Proveedor(es) del Tratamiento. En caso que el asegurado pague directamente al proveedor, será la responsabilidad del asegurado para obtener un reembolso del proveedor. En Venezuela, los reclamos sometidos vía reembolso no serán elegibles para beneficios. Para que un reclamo sea elegible para beneficios bajo el contrato de la póliza, el Administrador debe coordinar directamente con el proveedor.
                            <br> <br>
                            Para que una reclamación sea válida y pagadera, el cheque de la reclamación debe ser depositado para ser cobrado dentro de los 90 días de la emisión. No depositar un cheque para ser cobrado dentro de 90 días de emisión anulará la validez de la reclamación desde el principio. Cheques de reemplazo no serán emitidos y el reclamo será anulado y negado.
                            
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Exámenes Físicos y Autopsia: </span>
                            La Compañía a expensas propias, tendrá el derecho y la oportunidad de examinar a la persona o cualquier individuo cuya lesión o enfermedad es la base del reclamo y, en la ocasión y con la frecuencia que razonablemente pueda requerirse durante la disputa de un Reclamo y el presente para hacer una autopsia en caso de muerte.  <br> <br>

                            Para todos los beneficios de esta póliza, incluidos los beneficios médicos y los beneficios por Muerte Accidental y Desmembramiento: cuando se produce una enfermedad, accidente o muerte, la Compañía solicitará al asegurado o beneficiario todos los informes, incluidos, entre otros, el informe completo de la autopsia y / o resultados de sangre. y / o resultados de orina desde la fecha inicial de la enfermedad, accidente o muerte. Cuando la ley exige informes de drogas y alcohol durante una autopsia, los informes de los resultados de alcohol y drogas deben presentarse dentro de los 30 días siguientes a la solicitud.  <br> <br>

                            Todos los informes deben ser recibidos por la Compañía dentro de los 30 días siguientes a la solicitud. La falta de entrega de todos los informes solicitados dentro de los 30 días será motivo de rechazo de la reclamación. 
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Acciones Legales:  </span>
                           Cualquier y todas las disputas, reclamos, controversias que surjan de o en relación con esta póliza, o de su presunta violación, debe ser sometida a arbitraje en Barbados. El asegurado y la Compañía someterán sus disputas a tres (3) árbitros. Cada una de las partes elegirá un árbitro y el tercer árbitro será elegido por los dos árbitros designados por las partes. Cualquiera de las partes puede iniciar el arbitraje mediante notificación escrita a la otra parte, nombrar a un árbitro y exigir arbitraje. La otra parte tendrá 30 días una vez recibida dicha notificación para nombrar a su árbitro. Los dos árbitros elegidos escogerán dentro de los 15 días el tercer árbitro para el arbitraje que tendrá lugar dentro de los 15 días. Si falla cualquiera de las partes para nombrar un segundo árbitro dentro de los 30 días a partir de cuándo se les notifica, la otra parte que no elija el árbitro estará de acuerdo en que la otra parte elige el segundo árbitro y el arbitraje continuará. El Arbitraje tendrá lugar en Barbados, a menos que ambas partes decidan que debe ser en otro lugar. Los gastos del arbitraje serán cancelados en partes iguales entre el asegurado y la Compañía.  <br> <br>

                            El asegurado y la Compañía acuerdan que la jurisdicción exclusiva será en Barbados para la determinación de cualquier derecho legal en virtud de esta póliza. El asegurado y la Compañía acuerdan que cada parte pagará sus propios gastos legales y costo del abogado. Estar de acuerdo con la jurisdicción exclusiva en Barbados y estar de.
                            </li>
                            
                            
                            
                        </ol>
                 
                        
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
            
             <p class="page_no">Page 42 of 52</p>
            
           <p> acuerdo en que cada parte pague sus honorarios no entra en conflicto con el acuerdo al arbitraje indicado anteriormente. </p>
                            
                    <p>        Notificaciones pueden ser enviadas por entrega personal o correo certificado a la Compañía en Claria Life and Health Insurance Company CGI Tower 2nd Floor, Warrens St. Michael, Barbados BB22026 y de la persona asegurada a la dirección actual que figura en los registros de la Compañía, con el mismo efecto como si fuera entrega personalizada en dicha ciudad. En ningún caso la Compañía será responsable por cualquier daño extra-contractual, ya sea caracterizado sin limitación, como consecuencia, ejemplar, punitivo o daños extracontractuales, por cualquier supuesta violación de esta póliza.</p>
                            
                        <p>      Ninguna acción legal podrá ser intentada por una persona asegurada, recuperar en el marco de la póliza, antes de sesenta (60) días después que la Compañía o el médico coordinador hubiesen recibido la prueba de pérdida de acuerdo con los requisitos. Ni se intentará en absoluto acción legal alguna a menos que se comience dentro de los seis (6 meses) posteriores a la fecha del reclamo original.</p>
                            
                           <p>   El asegurado y la Compañía de seguros acuerdan que esta póliza de seguro no fue ofrecida en los Estados Unidos (EE.UU.), que esta póliza de seguro no fue comprada en los Estados Unidos (EE.UU.), que esta póliza de seguro no se vendió sujeta a ninguna ley Estados Unidos (EE.UU.). Además, se acuerda que ninguna acción legal será presentada en los Estados Unidos (EE. UU.) en corte federal o estatal bajo esta póliza de seguro por cualquiera de las partes.</p>
            
            
            
            <ol style="font-size: 12px;" start="6">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Período de gracia:  </span>Un período de gracia de 31 días será concedido para el pago de cada Prima que corresponda después de la primera Prima y del periodo de renovación, período de gracia durante el cual el certificado continuará en vigencia, condicional a que la prima sea recibida por la Compañía antes de la expiración del periodo de gracia. Para las modalidades de pago mensual y trimestral, se concederá un período de gracia de 14 días para el pago de las primas que se reciba después de la fecha de la fecha de vencimiento y renovación. Todas las pólizas cuyas primas no sean pagadas dentro del período de gracia permitido serán canceladas.
                            <br> <br>
                            La póliza no puede ser renovada mientras que el asegurado se encuentre en los Estados Unidos, sus territorios o Canadá. Si la prima es pagada mientras el asegurado se encuentra en cualquiera de estos territorios, la renovación será considerada nula y sin efecto y todas las primas pagadas por la renovación serán devueltas.
                            <br> <br>
                            Las primas se pueden pagar con cheque en dólares estadounidenses a cobrar en un banco de EE.UU. o a través de transferencia bancaria en dólares estadounidenses. No se aceptan pagos en efectivo para el pago de las primas. El pago de las primas debe ser recibido físicamente en la oficina del Administrador. Hacer un pago al agente no constituye prima pagada a la Compañía y no se aceptará como prima valida recibida para la póliza. Cualquier pago hecho al agente en efectivo, cheque o transferencia a nombre del agente o a nombre de la compañía del Agente no es responsabilidad de la Compañía y no constituye pago de la prima a la Compañía.


                            
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Rehabilitación:  </span>
                            Si la Compañía determina la terminación de la Cobertura, debido a la falta de pago de la Prima o a que la prima no llega a la oficina del Administrador dentro del periodo permitido, la Compañía a su discreción, 
     
                            </li>
                            
                            
                            
                            
                            
                        </ol>
                 
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 43 of 52</p>
            <p>
            puede elegir considerar la rehabilitación de la Cobertura solamente después de recibir una solicitud o un formulario de rehabilitación para nueva revisión de suscripción y el pago de la Prima.
             </p>               
                       
<p>
            La rehabilitación no está garantizada y la Compañía no está bajo obligación alguna de aceptar la rehabilitación. Al ser rehabilitada, la Póliza cubrirá solamente los Eventos Cubiertos que resulten de Lesiones sufridas después de la fecha de rehabilitación y aquellos que resulten de Enfermedades que se manifiesten no menos de 10 días después de la fecha de rehabilitación. Enfermedades, lesiones u otro resultado de las mismas que sea manifestado durante el periodo de 10 días inmediatamente después de la fecha de rehabilitación no serán elegibles para cobertura bajo esta póliza. Ninguna rehabilitación será considerada por la Compañía 60 días después que la póliza ha caducado por falta de pago.
            </p>
            
             <ol style="font-size: 12px;" start="8">
                        
                        <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Fecha Efectiva del Seguro Individual:  </span>
                           Después de la evaluación y Aprobación de cada Solicitante por el Administrador, la Cobertura se hará efectiva en la más cercana de las siguientes fechas (1.) La cobertura se hará efectiva en la fecha en que el solicitante es aprobado por el Administrador; (2.) la fecha en que la Prima y la Solicitud apropiadas sean recibidas por el Administrador. La Compañía se reserva el derecho de negar la inscripción sobre la base de una solicitud individual o una aplicación, para incluir dependientes a cargo sin dar ninguna razón, o para aceptar el solicitante y / o personas dependientes en condiciones especiales.   
                            </li>
                            
                            
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Fecha de Vencimiento del Seguro Individual:   </span>
                          La Cobertura terminará en la primera de las siguientes fechas: (1.) El término del periodo para el cual la Prima ha sido pagada; (2) la fecha en la cual la Persona Asegurada no cumpla con los Requisitos de Elegibilidad descritos en la sección 2 A; (3) la fecha en que la Compañía cancele la cobertura para una Clase específica de Personas Aseguradas, y en la cual la Persona Asegurada pueda estar incluida.
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">No sustitución de Compensación laboral   </span>
                          Este Seguro no sustituye ni afecta ningún requerimiento de Cobertura de Pólizas de compensación laboral.
                            </li>
                            
                            
                               <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Certificado de Seguro:   </span>
                         La Compañía emitirá para cada Persona Asegurada un certificado individual de Seguro, el cual contendrá las características esenciales del Seguro de cada persona y a quien se le pagan los Beneficios.
                            </li>
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Información proporcionada por el (los) Persona(s) Asegurada(s):   </span>
                            La Persona Asegurada debe proporcionar toda la información requerida en la Solicitud y cualquier información adicional solicitada por la Compañía como resultado de un reclamo incluido pero no se limita a firmar el formulario de reclamo, el formulario HIPPA y cualquier otra forma de formulario de autorización, o los expedientes médicos, las facturas originales detalladas, reporte policial relacionado con el reclamo y/o declaración jurada describiendo el accidente relacionado con el reclamo. El hecho de no proporcionar la información solicitada por el Administrador será causa de negación de un siniestro o puede anular la póliza. Todos los Hijos recién nacidos de una Persona Asegurada Principal, que no sean reportados en la Solicitud inicial y no estén actualmente cubiertos bajo este Seguro, serán evaluados por el Administrador, no antes de los 14 días de nacido.
                            
                            
                            </li>                        
                                     
          
                        </ol>
            
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
            <div class="">
             <p class="page_no">Page 44 of 52</p>
            
            <p>
            Esta póliza se emite en base únicamente a la información recibida por escrito en la solicitud original firmada. La Compañía y el Administrador se basarán exclusivamente en la información en la solicitud para revisar y emitir la póliza y las condiciones del contrato. Cualquier información adicional o historia clínica presentada en el momento de la solicitud deberá recibir la confirmación de recibido por escrito del Administrador en el momento de la solicitud con el fin de formar parte de la solicitud y que se considere parte de la revisión de la misma. <br> <br>
                            La negación u omisión del asegurado o del Médico o del Hospital en suministrar a la Compañía todos los informes y registros médicos dentro de los treinta (30) días de nacido, no constituirá como un seguro válido bajo este contrato para los recién nacidos. Un niño dependiente no puede ser incluido en esta póliza de seguro sin una solicitud completa y aprobación del Administrador. <br> <br>
                            La negación o fallo del Médico del asegurado o del Hospital para realizar todos los reportes y registros médicos disponibles para la Compañía dentro de 60 días de haber sido solicitado por la Compañía puede causar que un Reclamo válido o Solicitud en otras circunstancias, sea negado y el caso cerrado debido a la carencia o respuesta limitada por parte de la Persona Asegurada y de sus proveedores Médicos.
            </p>
            
            
                 
                        <ol style="font-size: 12px;" start="13">
                        
                        <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Cancelación:   </span>Esta Póliza es renovable anualmente por la vida de la Persona Asegurada o hasta la Fecha de Vencimiento del Seguro Individual. Las renovaciones estarán sujetas a las definiciones, términos y condiciones vigentes al momento de cada renovación. La Compañía se reserva el derecho de alterar y/o enmendar por Categoría los términos, condiciones, tarifas, descuentos y/o recargos en cada fecha de renovación de la póliza y de aplicar dichas alteraciones y/o enmiendas a todas las pólizas nuevas y de renovación. La Compañía puede cancelar una Clase entera de Personas aseguradas, incluyendo, aunque no limitado a, una Clase comprendida en una región específica, género, edad o categoría.
                            <br> <br>
                            El asegurado podrá cancelar la póliza de la Compañía, comunicando con 30 días de anticipación por escrito, en cuyo momento la Compañía hará un cálculo de la Prima restante (si la hubiere) para reembolsarla a la Persona Asegurada.
       
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Renovación del Seguro Individual: </span>
                           La Póliza será renovada cada año en el aniversario de la Fecha Efectiva de la Póliza, sujeto a las provisiones de la Póliza en vigor para la fecha de la renovación. El período inicial de Cobertura no puede exceder de 12 meses. La Persona Asegurada, sin embargo, puede aplicar por renovación de la Cobertura. El período de renovación no puede ser de más de 12 meses. Renovación(es) de la(s) prima(s) serán cobradas a los costos aplicables a las distintas clases según el plan que el asegurado tenga en cada renovación. La(s) Renovación(es) dependerá(n) de que la Persona Asegurada entregue la aplicación en el tiempo estimado y el Administrador reciba en su oficina la aplicación para renovación de la prima dependiendo la clase como lo determina la Compañía. La Compañía no podrá cancelar a una Persona Asegurada, a menos que el asegurado sea incluido en una clase que es cancelada en su totalidad por la Compañía.
          
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Beneficios en Exceso:  </span>
                          Toda la Cobertura será en exceso de todo otro seguro válido y reembolsable y se aplicará solamente cuando dichos beneficios sean agotados, sea cual fuere la fecha de emisión de cualquier otra póliza, </li>
                         </ol> 
                         
                      
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>
        
           
       </div>
    </div>
    
    
    
    
    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
                <div>
 <p class="page_no">Page 45 of 52</p>
                            <p>
                                anterior o posterior a la emisión de la presente póliza. En todos los casos esta póliza pagará los gastos médicos con posterioridad y en exceso, sólo después que todos los beneficios de pólizas válidas y existentes hayan sido pagados y agotados. <br>
                          Otros Seguros válidos y reembolsables, por los cuales pueden ser beneficios pagaderos son programas de seguros dados por:
                          
                          </p>
                            
                            <ol style="font-size: 11px;" style="padding-left:30px;">
                                <li>Seguro o cobertura individual, colectiva o general;</li>
                                <li>Otra cobertura pre-pagada, individual o colectiva;</li>
                                <li>Cualquier cobertura bajo planes de fideicomiso laboral, planes de seguridad sindical, planes organizados por el empleador, planes organizados en beneficio de los empleados, u otros convenios de beneficios para individuos de un grupo;</li>
                                <li>Cualquier cobertura requerida o subministrada por cualquier estado o programa social de seguro;</li>
                                <li>Cualquier seguro de automóvil.</li>
                                <li>Plan social del gobierno</li>
                                <li>Cualquier seguro de responsabilidad civil;</li>
                            </ol>
                            
                            <span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">
                                Cuando la coordinación de beneficios con otra póliza de seguro se utilice el Asegurado debe notificar al Administrador cuando los límites de la otra compañía de seguros se han cumplido para que el Administrador coordine el pago directo de los Beneficios Elegibles en el futuro. Si no lo hace dentro de 48 horas dará lugar a un co aseguro adicional de 50% de todos los Beneficios Elegibles.
                            </span>

                            
                            
                        <ol style="font-size: 12px;" start="16">        
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Subrogación:  </span>
                          La Compañía tiene el derecho de subrogación y reembolso por cualquier suma pagada por la Compañía a una Persona Asegurada o en su nombre, si esta recibe alguna cantidad de dinero de otra persona, plan o entidad legal la cual esté legalmente obligada a hacer pagos derivados de acciones u omisiones de cualquier persona, sea un tercero u otra persona cubierta bajo la presente póliza, la cual hubiese causado directa o indirectamente una condición física o mental, en relación con la cual se hubiesen hecho pagos de cualquiera de los beneficios bajo la póliza a dicha persona asegurada o a su nombre. La Compañía tendrá un cargo en contra de dicha suma de dinero recibida de terceras partes u otras personas arriba descritas, o sus aseguradores, o el asegurador de la Persona Asegurada, y será reembolsada de ello. La Persona Asegurada además conviene en notificar, por escrito, a las personas o entidades antes mencionadas, sobre los derechos de subrogación y cargos de la Compañía, antes de recibir cualquier pago por parte de dichas personas. <br> <br>
                           
                           La Persona Asegurada será responsable por todos los gastos de recuperación de dichos terceros u otras personas, incluyendo, pero no limitado a, costos de abogados, en los que se incurra en la cobranza de dichos pagos, cuyos honorarios y gastos no reducirán el monto del reintegro a la Compañía requerido de la Persona Asegurada. La Persona Asegurada acepta reembolsar a la Compañía por cualquier Beneficio pagado de acuerdo con esta póliza, aparte de cualquier dinero recuperado de dichos tercero u otras personas como resultado de un juicio, arreglo o similar, incluso aunque dichos dineros no sean definidos como montos pagados por gastos médicos o reclamos. La Persona Asegurada acuerda suministrar dicha información y asistencia, así como ejecutar y entregar todos los instrumentos necesarios, según la Compañía o su designado pueda solicitar, con el fin de facilitar la aplicación de esos derechos de subrogación, incluyendo, pero sin limitarse a, la ejecución de un arreglo de subrogación previo a los pagos de los beneficios bajo la póliza, a la Persona Asegurada o en su nombre.
                      
                            </li>
            
                            
                        </ol>
           
        
           </div>
           
           
            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
    
    
    
     <p class="page_no">Page 46 of 52</p>
    
     <p>
             La Persona Asegurada no cederá ni se exonerará de ninguna parte de sus obligaciones a la Persona Asegurada o a la Compañía, ni tomará acción alguna que pueda perjudicar los derechos de subrogación de la Compañía. El ejercicio de la Compañía de sus derechos de tomar cualquier acción que considere adecuada, en contra de terceras partes o personas, no afectará el derecho de la Persona Asegurada de procurar otras formas de recuperación.
                            <br> <br>
                           Si la Persona Asegurada o cualquiera actuando en su nombre no ha tomado acción sobre sus derechos ante terceras partes o personas para lograr un juicio, arreglo u otra restitución, la Compañía o sus representantes, con 30 días de aviso a la Persona Asegurada, tendrá derecho de tomar acciones en nombre de la Persona Asegurada, para recuperar el monto de los Beneficios pagados bajo esta Póliza. Con tal de que, no obstante, dicha acción, tomada sin el consentimiento de la Persona Asegurada, no cause perjuicio alguno a dicha Persona Asegurada.
            </p>
            
            
            
                        <p>
                        El derecho de la Compañía al reembolso tal como se establece aquí será pagadero primero de las sumas recibidas de terceras partes u otras personas y dicho reembolso continuará hasta que las obligaciones de la Persona Asegurada bajo esta póliza sean saldadas por completo, incluso aunque la Persona Asegurada no reciba la indemnización completa o restitución por sus lesiones, daños, pérdidas o deudas. El derecho a Subrogación existirá por lo tanto en todos los casos.
                        <br /><br />
                        Si la Persona Asegurada falla en cumplir con estos requerimientos, no será elegible de recibir ningún beneficio, servicio o pago bajo esta Póliza, hasta que haya conformidad, sin importar que los Beneficios estén relacionados con la acción u dichas terceras partes o personas u otras personas.
                        </p>
                        <ol style="font-size: 12px;" start="17">
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Cambio de Residencia:   </span>La Póliza se hará nula e inválida a menos que la Compañía reciba notificación del cambio de País de Residencia de la Persona Asegurada, dentro de los 30 días siguientes a dicho cambio. Todos los términos y condiciones de la Póliza quedan sujetos a revisión y aprobación ante un cambio en el País de Residencia de la Persona Asegurada.
       
                            </li>
                   
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Límites monetarios:  </span>
                          Los límites monetarios establecidos en esta Póliza y la Prima serán expresadas en dólares de los Estados Unidos. Para servicios fuera de los límites territoriales de los Estados Unidos., la tasa de cambio usada para determinar el monto de dólares de los Estados Unidos a ser pagados, es la tasa de cambio efectiva a la fecha en que se incurre en los gastos objeto del reclamo.
          
                            </li>
                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Cesión: </span>
                         El Seguro provisto en esta Póliza no puede ser cedido, pero los Beneficios pueden ser pagados de acuerdo a lo establecido en el #3 Pago de Reclamos.
                            </li>
                            

                            
                            <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Modificación de Condiciones Médicas previas a la emisión del certificado:   </span>
                         Cualquier condición que se manifieste entre la fecha de la firma de la Solicitud y la fecha en la cual la Cobertura es emitida, será considerada pre-existente y no será cubierta durante el periodo entero de la Póliza. Adicionalmente algunas condiciones que se manifiesten entre la fecha de la firma de la Solicitud y la fecha en la cual la Cobertura es emitida pueden afectar su elegibilidad para la Cobertura. 

                            </li>
       
                        </ol>
       
    
    
    <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    
    
     <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
       
       
       
       
       
         <div class="">
          <p class="page_no">Page 47 of 52</p>
                 <ol style="font-size: 12px;" start="21">
                 
                 <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Planes colectivos:    </span>
                         Cuando esta póliza sea parte de un plan colectivo o plan de beneficios de empleados, que reciba tarifas especiales de grupo, los individuos retirados y sus dependientes estarán cubiertos en términos a ser acordados por la Compañía en escrito.
                            </li>
                            
                              <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">El Propósito de este plan:    </span>
                        Es cubrir individuos y grupos de trabajadores no manuales y sus dependientes (si corresponde) como personas aseguradas durante un periodo de seguro por concepto de gastos médicos incurridos por tratamientos de condiciones médicas, quirúrgicas y agudas, por parte de médicos, especialistas y hospitales.

                            </li>
                            
                            
                              <li><span class="faisal-span" style="margin: 0; font-weight: bold; font-size: 13px;">Declaraciones en la Solicitud:  </span>
                         Cualquier declaración o descripción hecha por la Persona Asegurada, o en su nombre, en la Solicitud es una declaración y no una garantía. Declaraciones falsas, omisiones, ocultamiento de hecho o declaraciones incorrectas pueden privarlo del Beneficio de pago bajo esta Póliza si uno de los siguientes aplica: a) las declaraciones falsas, omisiones, ocultamiento o afirmación es falsa y/o fraudulenta, sea importante o no, a efectos de la Aprobación de la Cobertura para la persona asegurada; b) si los hechos hubiesen sido conocidos por el Administrador o la Compañía, previo a la emisión de la Cobertura, entonces el Administrador o la Compañía no hubiesen emitido la Cobertura a la misma Prima, o hubiesen emitido un Endoso de Exclusión a la Cobertura bajo esta Póliza. <br> <br>
                        Cuando una declaración falsa, omisión, ocultamiento de hecho, o declaración incorrecta, tenga lugar en la solicitud, o en sus documentos médicos adjuntos, sin importar si la declaración falsa, omisión, ocultamiento de hecho, o declaración incorrecta se relacione con un inminente reclamo o no, la Compañía puede escoger sea rescindir y anular la cobertura del Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no, y devolver toda la prima a su pagador, retroactivo a la Fecha Efectiva de Cobertura Individual original, o emitir una exclusión permanente para la condición particular pre-existente y negar el reclamo. En el caso que la cobertura sea rescindida al Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no , cualquier pago de reclamos realizados bajo la póliza, desde la fecha efectiva, hasta la fecha de la rescisión, será aplicado a la devolución de la prima que sea retroactiva a la Fecha efectiva. Si los pagos de reclamaciones exceden la devolución de la prima, el Asegurado es responsable de reembolsar a la Compañía el exceso de reclamaciones pagadas en un plazo de 30 días, o la Compañía se reserva el derecho de proceder contra el Asegurado con cargos civiles y / o penales.

                            </li>
                            
                            
                      
                            
                            
                            
                              <li>Cláusula de Limitación y Exclusión de Sanciones: La Compañía no será considerada para dar cobertura y la Compañía no será responsable de pagar reclamación alguna o proporcionar beneficios en la medida en que la prestación de dicha cobertura, el pago de dicha reclamación o la prestación de dicho beneficio expondría a la Compañía a una sanción, prohibición o restricción en virtud de las resoluciones de las Naciones Unidas o sanciones económicas, leyes o reglamentos de la Unión Europea, Reino Unido o Estados Unidos de América.

                            </li>
                 
                 
                    <li>Este seguro no está sujeto a, y no proporciona algunos de los beneficios de seguro exigidos por La Ley de Protección al Paciente de los Estados Unidos y la Ley de Asistencia Asequible ("ACA"). Este seguro no ofrece, y las aseguradoras no tienen la intención de proporcionar, la cobertura mínima esencial bajo ACA. En ningún caso, los beneficios se proporcionarán por encima de los especificados en el contrato de póliza. Este seguro no está sujeto a  
                    </li>
                    
                    
                 </ol>
 
       
       </div>
       
       
       
           <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    

    
    
         <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
       
       <div>
        <p class="page_no">Page 48 of 52</p>
       <p>
       condiciones de emisión o renovación distinta a la prevista en el contrato de póliza. ACA requiere que ciertos ciudadanos estadounidenses y residentes de Estados Unidos obtengan una cobertura de seguro de salud compatible al ACA. En algunas circunstancias, existen penas impuestas a tal persona o personas que no mantienen la cobertura conforme ACA. Cada persona asegurada debe consultar a su abogado o profesional de impuestos para determinar si los requisitos de ACA son aplicables a él / ella.
       </p>
       
       
        
<h3 class="faisal-title" style="margin-bottom: 20px; font-size: 14px; font-weight: bold; font-family: Montserrat, sans-serif;">Sección 7: Beneficios de viaje</h3>
                
                <p>
                    Todas las secciones de esta póliza incluidas, pero no limitadas a aplicación de definiciones, beneficios, exclusiones y provisiones, al menos que sean especificadas en la sección de beneficios de viaje como se muestra más abajo.
                </p>
                
                <p>
                    Beneficios de viaje se aplican mientras se encuentra viajando internacionalmente fuera del país de residencia por más un máximo 60 días cada vez que se viaja.
                </p>
                
                <p>
                    24 horas, 7 días a la semana, 365 días al año.
                </p>
                
                <p>
                    Costos de Emergencia por enfermedad o accidente y gastos de hospital tienen un beneficio de $10,000. No deducibles o coaseguros se aplican. Para beneficios sobre los $10,000 se aplica el beneficio deducible y el coaseguro se aplicará primero y luego los beneficios de la póliza serán pagados como reclamo regular. Emergencia por enfermedad o receta médica por accidente de $300 no se aplicarán deducibles o coaseguro por persona asegurada por el periodo de la póliza.
                </p>
                
                <p>
                    Costos de Viajes ida y vuelta por miembro de familia quien asistirá al asegurado cuando sea ingresado en un hospital por más de 48 horas, serán de hasta $ 1,000 por persona asegurada por el periodo de la póliza.
                </p>
                
                <p>
                    Costos por cuarto de hotel por miembro de la familia quien asistirá al asegurado cuando sea ingresado en un hospital por más de 48 horas serán de $ 100 por día con 10 días máximo por asegurado por periodo de póliza el cual no incluirá servicio de comida u otro gasto de hotel adicional al costo normal por habitación.
                </p>
                
                <p>
                    La repatriación de un menor cuando el asegurado sea ingresado en el Hospital por más de 48 horas y no estuviere otro miembro de la familia para acompañar al menor es de hasta $ 2,500 por persona asegurada por el periodo de la póliza.
                </p>
                
                <p>
                    Asistencia legal de $1,500 por asegurado por periodo de póliza cuando el asegurado es arrestado, detenido o parte de un accidente de tránsito mientras viaja fuera del país.
                </p>
                
                <p>
                    Beneficio de la completa y total pérdida de equipaje es de un máximo de $1,200 por persona asegurada por periodo de póliza se calculan como sigue: Pagados a $60 por KG a un máximo de 20 KG. No habrá reembolsos o beneficios pagados por artículos con valores específicos. Maletas deben ser chequeadas con una aerolínea internacional que viaje de un país a otro por personal autorizado de la aerolínea. El asegurado debe viajar como 
  
                </p>
               
    
       
       </div>
       
       
       
       
       
       
       
       
       
           <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>        
           
       </div>
    </div>
    
    
    
    
         <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;"> 
       <div class="common-page" style="padding-top: 240px;padding-left: 100px; padding-right: 100px; padding-bottom: 70px;margin-bottom: 20px;position: relative;">
       
       
       <div>
       
        <p class="page_no">Page 49 of 52</p>
    
                <p>
                    pasajero en el mismo vuelo que las maletas. Para poder recibir los beneficios, la aerolínea quien recibió las maletas debe aprobar y pagar por la pérdida completa del equipaje con pruebas de documentos de pago y pruebas de peso de la documentación llenada en original a la Compañía. Pérdida parcial o daño parcial de las maletas no califican para ningún beneficio bajo este beneficio de viaje.
                
                </p>
    
                <p>
                    Transmisión ilimitada de mensajes urgentes
                </p>
                <p>
                    Consulta médica ilimitada, información y referidos.
                </p>
                <p>
                   Emergencia por enfermedad se refiere a una condición médica que sea manifestada después de haber dejado el país de residencia, cualquier otra enfermedad o condición médica que sea manifestada antes de dejar el país de residencia o <span style="border-bottom: 1px solid #000;">viaje en contra de las órdenes del médico, </span>  recibirá la revisión del reclamo regular basado en el plan de la póliza y no en los beneficios de viaje.
                </p>
                <p>
                    Emergencia por accidente se refiere a una causa externa por una condición médica que ocurrió después de dejar el país de residencia. Cualquier otro accidente que haya ocurrido antes de dejar el país de residencia, recibirá la revisión del reclamo regular basado en el plan de la póliza y no en los beneficios de viaje.   
                </p>
    

     </div>

           <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                    La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
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
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compañía" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compañía, y cuyo nombre se identifica en la tarjeta de identificación y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compañía. La cobertura se brinda sólo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los límites especificados en este documento y como se señala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta póliza se emite basada en la información suministrada en la solicitud. Si alguna información en la solicitud no es correcta o está incompleta, o cualquier otra información se ha omitido, la Compañía a su discreción, revocara, cancelara o modificara los beneficios de la póliza del Asegurado que omitió información, así como el Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no.
                </p>

                <p><strong>SECCIÓN 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El término <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El término <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la pérdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El término <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o cónyuge debido a la pérdida de vidas causada únicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, así como la pérdida de las partes del cuerpo que se detallan en la Tabla de Pérdidas.
                </p>

                <p>
                    El término <b>"Addendum ":</b> se refiere a un documento añadido a la póliza por la Compañía y será una parte de la póliza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El término <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organización contratada con la Compañía para proporcionar servicios de suscripción, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
            </p>


        </div>
    </div>

    <div class="wrapper-common" style="max-width: 1019px;margin: 0 auto;">
        <div class="common-page common-blank-page" style="padding-top: 180px;padding-left: 50px; padding-right: 50px; padding-bottom: 1px;margin-bottom: 20px; opacity: 0;">

            <div>

                <p><strong>Cl&aacute;usula de Cobertura</strong></p>

                <p>
                    Claria Life and Health Insurance Company, en lo sucesivo denominada "la Compañía" asegura a todas las personas cuya solicitud haya sido aprobada por Global Assurance Group Inc., en lo sucesivo denominado "El Administrador" en nombre de la Compañía, y cuyo nombre se identifica en la tarjeta de identificación y / o se documenta con el Administrador, sujeto a todas las exclusiones, limitaciones y disposiciones establecidos en este documento y en el certificado de seguro expedido por la Compañía. La cobertura se brinda sólo con respecto a la(s) persona(s) asegurada(s), la cobertura, los importes y los límites especificados en este documento y como se señala en la Lista de Beneficios para el Seguro requerida en la solicitud y para el que la prima mencionada se ha pagado al Administrador.
                </p>

                <p>
                    Esta póliza se emite basada en la información suministrada en la solicitud. Si alguna información en la solicitud no es correcta o está incompleta, o cualquier otra información se ha omitido, la Compañía a su discreción, revocara, cancelara o modificara los beneficios de la póliza del Asegurado que omitió información, así como el Asegurado Primario, Cónyuge y Dependientes, independiente que los otros Asegurados hayan omitido información o no.
                </p>

                <p><strong>SECCIÓN 1: DEFINICIONES DE CERTIFICADO</strong></p>

                <p>
                    El término <b>"Accidente o Accidental"</b> se refiere a un acontecimiento, independiente de una enfermedad o medios auto infligidos, que es la causa directa de lesiones corporales a una persona asegurada.
                </p>

                <p>
                    El término <b>"Cobertura por Muerte Accidental "</b> ser refiere a la cobertura incluida en este Certificado debido a la pérdida de vida causada exclusivamente por medios externos, violentos y accidentales y no producida por cualquier otra causa
                </p>

                <p>
                    El término <b>"Muerte Accidental y Desmembramiento (AD&amp;D)"</b> se refiere al anexo que detalla la cobertura proporcionada, por una prima adicional, al Asegurado y / o cónyuge debido a la pérdida de vidas causada únicamente por medios y externos, violentos y accidentales y no producida por cualquier otra causa, así como la pérdida de las partes del cuerpo que se detallan en la Tabla de Pérdidas.
                </p>

                <p>
                    El término <b>"Addendum ":</b> se refiere a un documento añadido a la póliza por la Compañía y será una parte de la póliza; aclara, explica o modifica sus condiciones. Las disposiciones del Addendum siempre prevalecen sobre las Condiciones Generales en todo lo que se opone.
                </p>

                <p>
                    El término <b>"Administrador"</b> se refiere a Global Assurance Group, Inc., la organización contratada con la Compañía para proporcionar servicios de suscripción, administrativos y pago de reclamos en virtud de este Certificado.
                </p>

            </div>

            <p class="page-footer" style="opacity: .4; margin-top: 30px;">
                La versión en Inglés de la Póliza de Seguro será el documento oficial, esta es una traducción con carácter informativo. Última revisión 6/26/2019.
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