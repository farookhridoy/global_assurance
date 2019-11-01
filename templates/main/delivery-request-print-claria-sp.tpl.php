<?php global $policyInfo; 
$delReq = getDeliveryRequests($policyInfo['id']);
?>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tr style="background-color: #fff;">
    <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">DELIVERY REQUIREMENT
    </th>
  </tr>
  <tr rowspan="3" style="background-color: #fff;">
    <th colspan="6" valign="top" align="left" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="<?php echo MEDIA_IMAGES; ?>claria-logo.png" width="150" /></td>
        </tr>
        
      </table>
    </th>
    <th colspan="4" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;">
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Poliza:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo $policyInfo['policynumber']; ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Asegurado Principal:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo getHealthPrimaryInsuredText($policyInfo['id']); ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Fecha de Efectividad:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo dateFormFormat($policyInfo['effectivedate'],"m/d/y"); ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong><?php echo utf8_encode('Fecha L�mite'); ?>:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php if($policyInfo['datecancel'] && $policyInfo['datecancel'] != '0000-00-00 00:00:00') echo dateFormFormat($policyInfo['datecancel'],"m/d/y"); ?></td>
        </tr>
        
      </table>
    </th>
  </tr>
  

    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="padding: 0;">
              <span style="font-size: 14px;"><?php echo utf8_encode('Global Assurance Group Inc. y  CLARIA Life and Health Insurance ha recibido su solicitu de seguro. La cobertura que aparece bajo este certificado est� supeditada a que Global Assurance Group reciba en sus oficinas la informaci�n solicitada a continuaci�n.'); ?></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr><td colspan="7"><br><br></td></tr>

    <tr>
      <td colspan="10" align="center" style="border-bottom: solid 2px #bbb;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" align="center" style="padding: 0;">
              <span style="font-size: 14px;"><strong>Documentos</strong></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr><td colspan="7"><br></td></tr>
    
    <?php foreach($delReq as $delR){?>
    <tr>
      <td colspan="7" style="padding: 0; text-align: center;"><div style="font-size: 13px;"><?php echo nl2br($delR['detail']);?></div></td>        
    </tr>
    <?php }?>

    <tr><td colspan="7"><br></td></tr>

    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="padding: 0;">
              <span style="font-size: 13px;"><?php echo utf8_encode('En el caso que la informaci�n solicitada en este documento se env�e a Globlal Assurance Group y se descubran nuevas afecciones m�dicas no declaradas en la solicitud, la p�liza de inmediato podr� ser cancelada, anulada, y las primas pagadas ser�n reembolsadas, a excepci�n de los gastos administrativos de la p�liza y cualquier reclamo ocurrido no se considerar� elegible para pago'); ?>.
</span><br><br>

              <span style="font-size: 13px;"><?php echo utf8_encode('Global Assurance Group  puede, a su discreci�n, decidir ofrecer al aplicante una nueva suscripci�n de la solicitud, tomando en cuenta la nueva informaci�n y / o condiciones m�dicas recibidas y hacer una nueva oferta de suscripci�n. Global Assurance Group no garantiza y no est� bajo ninguna obligaci�n de suscribir la solicitud de nuevo o hacer nuevas ofertas'); ?>.</span><br><br>

              <span style="font-size: 13px;"><?php echo utf8_encode('Si Global Assurance Group  no recibe en su oficina  la informaci�n arriba solicitada al Asegurado antes de la fecha limite indicada en este documento , la p�liza ser�  cancelada, anulada, y las primas ser�n reembolsadas a excepci�n de los gastos administrativos de la p�liza  y  cualquier reclamo ocurrido no se considerar� elegible para pago'); ?>.</span><br><br>

              <span style="font-size: 13px;">*<?php echo utf8_encode('La versi�n en Ingles de este documento ser� el contrato oficial; el p�rrafo en el Idioma Espa�ol es una traducci�n con car�cter informativo'); ?>.</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr><td colspan="7"><br><br><br><br><br><br><br></td></tr>
    <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
          <td colspan="4">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                  <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;"><?php echo utf8_encode('Firma del Asegurado o Guardi�n'); ?></span>
                </td>
                <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                  <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">Fecha</span>
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
      </tbody></table>
    </td>
  </tr>
  <tr><td colspan="7"><br><br><br><br></td></tr>
  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
              <td colspan="4">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                      <tr>
                        <td align="left" width="50%" style="padding: 0; font-size: 14px;">
                          <span style="width: 250px; padding-top: 5px; display: block;"><?php echo date("l, F j, Y"); ?></span>
                        </td>
                        <td align="right" width="50%" style="padding: 0; font-size: 14px;">
                          <span style="width: 250px; padding-top: 5px; display: block;">Page 1 of 1</span>
                        </td>
                      </tr>
                </tbody>
                </table>
              </td>
            </tr>
        </tbody>
      </table>
    </td>
  </tr>
  <tr><td colspan="7"><br><br><br><br></td></tr>
</table>