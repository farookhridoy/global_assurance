</div> <!-- end roots -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>pagescript.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>select2.min.js"></script>

<script type="text/javascript">
              $(document).ready(function () {
                function permute(input, permArr, usedChars) {
                  var i, ch;
                  for (i = 0; i < input.length; i++) {
                    ch = input.splice(i, 1)[0];
                    usedChars.push(ch);
                    if (input.length === 0) {
                      permArr.push(usedChars.slice());
                  }
                  permute(input, permArr, usedChars);
                  input.splice(i, 0, ch);
                  usedChars.pop();
              }
              return permArr;
            }

          $('.mySelect2').select2({
            width: "100%",

            matcher: function(term, text) {

                if (term.length === 0) return true;
                texts = text.split(" ");

                allCombinations = permute(texts, [], []);

                for (i in allCombinations) {
                  if (allCombinations[i].join(" ").toUpperCase().indexOf(term.toUpperCase()) === 0) {
                    return true;
                }
            }
            return false;
        }
        });
    });

  

  $(document).click(function() {
    $(".mySelect2").select2('close');
});

  
</script>
<?php global $datePicker, $footerFunctions; if(!empty($datePicker) && is_array($datePicker)){ ?>
<link rel="stylesheet" href="<?php echo CSS_URL ?>datepicker/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo CSS_URL ?>datepicker/style.css"/>
<script src="<?php echo JS_URL ?>datepicker/jquery-ui.js"></script>
<script>

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