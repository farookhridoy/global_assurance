</div> <!-- end roots -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>pagescript.js"></script>


<?php global $datePicker, $footerFunctions; if(!empty($datePicker) && is_array($datePicker)){ ?>
<link rel="stylesheet" href="<?php echo CSS_URL ?>datepicker/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo CSS_URL ?>datepicker/style.css"/>
<script src="<?php echo JS_URL ?>datepicker/jquery-ui.js"></script>
<script>
	
$('input[type=text]').attr('autocomplete','off');
$('input[type=number]').attr('autocomplete','off');

function initFormDatePicker(){
    if($('.useDatePicker').length)
    $('.useDatePicker').datepicker({changeYear: true});
}
  $(function() {
    <?php foreach($datePicker as $dtPicker){ ?>
    $( <?php echo '"#'.$dtPicker.'"'; ?> ).datepicker({changeYear: true});
    <?php } ?>
    initFormDatePicker();
  });
</script>
<?php } 
if(!empty($footerFunctions) && is_array($footerFunctions)){
 foreach($footerFunctions as $ftFunction){
    $ftFunction();
 }
}
?>
</body>
</html>