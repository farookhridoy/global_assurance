<?php
function scriptHealthNew(){  
global $policyInfo,$policyNotes,$insuredLists,$checkPermissionRole,$db;
    $paymentsList=getPaymentsLists($policyInfo['id']);
?>
<script type="text/javascript">
    var admin_ajax_url = '<?php echo SCRIPT_URL ?>ajax/admin_ajax_code.php';
    var file_upload_ajax_url = '<?php echo SCRIPT_URL ?>ajax/file_upload_ajax.php';
    var health_new_success_url = '<?php echo SCRIPT_URL ?>main/health';
    var health_edit_success_url = '<?php echo SCRIPT_URL ?>main/health-edit/<?php echo $policyInfo['id'];?>';
    var premium_success_url = '<?php echo SCRIPT_URL ?>main/calculate-premium/<?php echo $policyInfo['id'];?>';
    var curr_policy_id = <?php echo $policyInfo['id'] ? $policyInfo['id']:"0"; ?>;
    var note_added_index = <?php if($policyNotes){echo count($policyNotes);}else{echo "1";} ?>;
    var file_added_index = 1;
    var insured_added_index = <?php if($insuredLists){echo count($insuredLists);}else{echo "1";} ?>;
    var payment_added_index = <?php if($paymentsList){echo count($paymentsList);}else{echo "1";} ?>;
    var insured_processing = 0;
    var edit_permission = <?php if($checkPermissionRole){echo 'true';}else{echo 'false';} ?>;
    function loadAgents(curr_ae_id,curr_ae_data_id,curr_val)
    {
        
        var next_level = parseInt(curr_ae_data_id) + 1;
        var curr_val_data = parseInt(curr_val);

        if(curr_val_data){
        $.post(admin_ajax_url,{action:'load_agent', agent_type:'health', agent_num: curr_val,agent_level: curr_ae_data_id},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                 //alert(data.agent_data.name);
                 if(data.agent_data.name)
                 $("#agent_level"+curr_ae_data_id+"_f_name").val(data.agent_data.name);
                 
                 if(data.agent_data.lastname)
                 $("#agent_level"+curr_ae_data_id+"_l_name").val(data.agent_data.lastname);
                 
                 if(data.agent_sub){
                     $("#agent_level"+next_level).empty();
                     $("#agent_level"+next_level).append($("<option></option>").attr("value", "0").text(''));
                     $.each(data.agent_sub, function(k, v) {
                        $("#agent_level"+next_level).append($("<option></option>").attr("value", v.id).text(v.name));
                     //alert(v.name);
                     });
                 }
                  
                }
                else
                {
                 //alert("Failed");
                }
            },'json');
            
            }else{
               $("#agent_level"+curr_ae_data_id+"_f_name").val("");
               $("#agent_level"+curr_ae_data_id+"_l_name").val("");
               $("#agent_level"+next_level).empty(); 
               $("#agent_level"+next_level).append($("<option></option>").attr("value", "0").text(''));
            }
            return false;
    }
    
    
function loadCoverages(curr_plan)
    { 
        var curr_plan_data = parseInt(curr_plan);
        $("#policy_deductible").empty();
        if(curr_plan_data){
        $.post(admin_ajax_url,{action:'load_coverage', plan_num: curr_plan},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                 if(data.coverage_data){
                     $("#policy_coverage").empty();
                     $("#policy_coverage").append($("<option></option>").attr("value", "0").text(''));
                     $.each(data.coverage_data, function(k, v) {
                     $("#policy_coverage").append($("<option></option>").attr("value", k).text(v));
                     });
                 }
                }
                else
                {
                 //alert("Failed");
                }
            },'json');
            
            }else{
              $("#policy_coverage").empty();
              $("#policy_coverage").append($("<option></option>").attr("value", "0").text(''));
            }
            return false;
  }
  
  function loadDeductibles(curr_cov)
    { 
        var curr_cov_data = parseInt(curr_cov);
        if(curr_cov_data){
        $.post(admin_ajax_url,{action:'load_deductible', cov_num: curr_cov},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                 if(data.deductible_data){
                     $("#policy_deductible").empty();
                     $("#policy_deductible").append($("<option></option>").attr("value", "0").text(''));
                     $.each(data.deductible_data, function(k, v) {
                     $("#policy_deductible").append($("<option></option>").attr("value", v.id).text(v.deductible));
                     });
                 }
                }
                else
                {
                 //alert(data.message);
                }
            },'json');
            
            }else{
              $("#policy_deductible").empty();
              $("#policy_deductible").append($("<option></option>").attr("value", "0").text(''));
            }
            return false;
    }
    
    
    
    function generatePolicyID(plan,year)
    { 
        if(plan && year){
        $.post(admin_ajax_url,{action:'create_policy_number', plan_fval: plan, year_fval: year,policy_num: curr_policy_id },
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                 if(data.policy_number){
                     $("#policy_number").val(data.policy_number);
                     if(data.policy_nu)
                     curr_policy_id = parseInt(data.policy_nu);
                 }
                }
                else
                {
                 //alert(data.message);
                }
            },'json');
            
            }else{
              $("#policy_number").val("");
            }
            return false;
    }
    
     
  $( ".policy_agents" ).change(function(e) {
       var ae_id = $(this).attr("id");
       var ae_data_id = $(this).attr("data-id");
       var selected_val = $(this).val();
       loadAgents(ae_id,ae_data_id,selected_val);
   });

    //function write by omar farook//
    $( ".payment_policy_agents" ).change(function(e) {
       var ae_id = $(this).attr("id");
       var ae_data_id = $(this).attr("data-id");
       var selected_val = $(this).val();
       var policy_id = $('#policy_id').val();
       if (policy_id) {
            loadAgentsDataForPayment(ae_id,ae_data_id,selected_val,policy_id);
       }else{

            loadAgentsForPayment(ae_id,ae_data_id,selected_val);
       }
   });

    //end call loadagentsforpayment//

    function loadAgentsDataForPayment(curr_ae_id,curr_ae_data_id,curr_val,policy_id)
    {
        
        var next_level = parseInt(curr_ae_data_id) + 1;
        var curr_val_data = parseInt(curr_val);

        if(curr_val_data){
        $.post(admin_ajax_url,{action:'load_agent_data', agent_type:'health', agent_num: curr_val,agent_level: curr_ae_data_id,policy_id:policy_id},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                    $("#agent_level"+curr_ae_data_id+"_active").removeClass('hiddenbtn');

                   if(data.agent_data.name)
                       $("#agent_level"+curr_ae_data_id+"_f_name").val(data.agent_data.name);
                       

                   if(data.agent_data.lastname)
                       $("#agent_level"+curr_ae_data_id+"_l_name").val(data.agent_data.lastname);

                   if(data.agent_data.commission)
                       $("#agent_level"+curr_ae_data_id+"_commission").val(data.agent_data.commission); 

                   if(data.agent_data.sys_nb)
                       $("#agent_level"+curr_ae_data_id+"_sys_nb").val(data.agent_data.sys_nb); 

                   if(data.agent_data.nb)
                       $("#agent_level"+curr_ae_data_id+"_nb").val(data.agent_data.nb);

                   if(data.agent_data.sys_rn)
                       $("#agent_level"+curr_ae_data_id+"_sys_rn").val(data.agent_data.sys_rn);

                   if(data.agent_data.rn)
                       $("#agent_level"+curr_ae_data_id+"_rn").val(data.agent_data.rn);

                   if(data.agent_data.pay_by)
                       $("#agent_level"+curr_ae_data_id+"_pay_by").val(data.agent_data.pay_by);

                   if(data.agent_data.notes)
                       $("#agent_level"+curr_ae_data_id+"_notes").val(data.agent_data.notes);
                 
                
                  
                }
                else
                {
                 //alert("Failed");
                }
            },'json');
            
            }else{
               $("#agent_level"+curr_ae_data_id+"_f_name").val("");
               $("#agent_level"+curr_ae_data_id+"_l_name").val("");
               $("#agent_level"+curr_ae_data_id+"_commission").val("");
               $("#agent_level"+curr_ae_data_id+"_sys_nb").val("");
               $("#agent_level"+curr_ae_data_id+"_nb").val("");
               $("#agent_level"+curr_ae_data_id+"_sys_rn").val("");
               $("#agent_level"+curr_ae_data_id+"_rn").val("");
               $("#agent_level"+curr_ae_data_id+"_pay_by").val("");
               $("#agent_level"+curr_ae_data_id+"_notes").val("");

              
               
            }
            return false;
    }

    function loadAgentsForPayment(curr_ae_id,curr_ae_data_id,curr_val)
    {
        
        var next_level = parseInt(curr_ae_data_id) + 1;
        var curr_val_data = parseInt(curr_val);

        if(curr_val_data){
        $.post(admin_ajax_url,{action:'load_agent', agent_type:'health', agent_num: curr_val,agent_level: curr_ae_data_id},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                    $("#agent_level"+curr_ae_data_id+"_active").removeClass('hiddenbtn');

                   if(data.agent_data.name)
                       $("#agent_level"+curr_ae_data_id+"_f_name").val(data.agent_data.name);
                       

                   if(data.agent_data.lastname)
                       $("#agent_level"+curr_ae_data_id+"_l_name").val(data.agent_data.lastname);

                   if(data.agent_data.commission)
                       $("#agent_level"+curr_ae_data_id+"_commission").val(data.agent_data.commission); 

                   if(data.agent_data.sys_nb)
                       $("#agent_level"+curr_ae_data_id+"_sys_nb").val(data.agent_data.sys_nb); 

                   if(data.agent_data.nb)
                       $("#agent_level"+curr_ae_data_id+"_nb").val(data.agent_data.nb);

                   if(data.agent_data.sys_rn)
                       $("#agent_level"+curr_ae_data_id+"_sys_rn").val(data.agent_data.sys_rn);

                   if(data.agent_data.rn)
                       $("#agent_level"+curr_ae_data_id+"_rn").val(data.agent_data.rn);

                   if(data.agent_data.pay_by)
                       $("#agent_level"+curr_ae_data_id+"_pay_by").val(data.agent_data.pay_by);

                   if(data.agent_data.notes)
                       $("#agent_level"+curr_ae_data_id+"_notes").val(data.agent_data.notes);
                 
                
                  
                }
                else
                {
                 //alert("Failed");
                }
            },'json');
            
            }else{
               $("#agent_level"+curr_ae_data_id+"_f_name").val("");
               $("#agent_level"+curr_ae_data_id+"_l_name").val("");
               $("#agent_level"+curr_ae_data_id+"_commission").val("");
               $("#agent_level"+curr_ae_data_id+"_sys_nb").val("");
               $("#agent_level"+curr_ae_data_id+"_nb").val("");
               $("#agent_level"+curr_ae_data_id+"_sys_rn").val("");
               $("#agent_level"+curr_ae_data_id+"_rn").val("");
               $("#agent_level"+curr_ae_data_id+"_pay_by").val("");
               $("#agent_level"+curr_ae_data_id+"_notes").val("");

              
               
            }
            return false;
    }
    //end 
 

    $('.checkuncheckpayment').click(function()
    {
            //If checkbox is checked then disable or enable input
            if ($(this).is(':checked'))
            {
                 
                $("#agent_level1_commission").attr("disabled","disabled");
                $('#agent_level2_commission').attr("disabled","disabled");
                $('#agent_level3_commission').attr("disabled","disabled");
                $('#agent_level4_commission').attr("disabled","disabled");
                $('#agent_level5_commission').attr("disabled","disabled");
            }
            //If checkbox is unchecked then disable or enable input
            else
            {
                $("#to-enable-input").removeAttr("disabled"); 
                $("#agent_level1_commission").removeAttr("disabled");
                $('#agent_level2_commission').removeAttr("disabled");
                $('#agent_level3_commission').removeAttr("disabled");
                $('#agent_level4_commission').removeAttr("disabled");
                $('#agent_level5_commission').removeAttr("disabled");
            }
    });
    //enable and disable
    
   
   $( "#policy_plan" ).change(function(e) {
     var plan_val = $(this).val();
     var date_val =  $( "#effective_date" ).val().trim();
     var curr_plan_text = $(this).find("option:selected").text();
     
     if(parseInt(plan_val) == 2)   /* If plan is sky   */
     $('#addLabel').removeAttr('hidden');
     else
     $('#addLabel').attr('hidden',"");
     
        
     
     
     loadCoverages(plan_val); 
     if(date_val){
     var dateObj = new Date(date_val);
     var year = dateObj.getFullYear();
     if(year){
        generatePolicyID(curr_plan_text,year);
     }
     }  
   });
   
   $( "#policy_coverage" ).change(function(e) {
     var cov_val = $(this).val(); 
     loadDeductibles(cov_val); 
   });
   
   
   
   
function savePolicyInsureds(){
  if(insured_added_index>0){
    for (i = insured_added_index; i > 0; i--) {
     if($('tr#row_insured'+i).length)
     processHelathInsured(i,true);
    } 
  } 
  return 1; 
}
   
  function health_form_submit(){
    var policy_number = $('#policy_number').val();
    
    //var file_data = $('#adfile').prop('files')[0];   
    //var form_data = new FormData();                  
    //form_data.append('file', file_data);
    //alert(form_data);  
    //return 1;                
    if(policy_number){
        
    $("#ajax_progress").find('label').text('Policy saving please wait...');
    $("#ajax_progress").show();
    $.ajax({
        type: 'POST',
        url: admin_ajax_url+"?action=save_health_policy",
        data: $('form').serialize()+"&policy_num="+curr_policy_id, 
        success: function(response) {
            //alert(response); 
            //return 1;
            var response_json = $.parseJSON(response);
            if(parseInt(response_json.sucess) == 1){
                //window.location.href = health_new_success_url;
                savePolicyInsureds();
                $("#ajax_progress").find('label').text('Policy data saved now file uploading please wait...');
                policy_files_upload(curr_policy_id);
            }else{
             if(parseInt(response_json.pr) == 1)
             alert('Permission error! You are not allowed to perform this action.');
             else
             alert("Failed to  save policy"); 
            }
            //alert(response);
        },
    });

    }else{
        alert("Policy Number can't be empty!!!");
    }
    return false;
  }
  
  function health_form_submit_exit(){
    var policy_number = $('#policy_number').val();
    
    //var file_data = $('#adfile').prop('files')[0];   
    //var form_data = new FormData();                  
    //form_data.append('file', file_data);
    //alert(form_data);  
    //return 1;                
   
    if(policy_number){
        
    $("#ajax_progress").find('label').text('Policy saving please wait...');
    $("#ajax_progress").show();
    $.ajax({
        type: 'POST',
        url: admin_ajax_url+"?action=save_health_policy",
        data: $('form').serialize()+"&policy_num="+curr_policy_id, 
        success: function(response) {
            //alert(response); 
            //return 1;
            var response_json = $.parseJSON(response);
            if(parseInt(response_json.sucess) == 1){
                //window.location.href = health_new_success_url;
                savePolicyInsureds();
                $("#ajax_progress").find('label').text('Policy data saved now file uploading please wait...');
                policy_files_upload_exit(curr_policy_id);
            }else{
             if(parseInt(response_json.pr) == 1)
             alert('Permission error! You are not allowed to perform this action.');
             else
             alert("Failed to  save policy"); 
            }
            //alert(response);
        },
    });

    }else{
        alert("Policy Number can't be empty!!!");
    }
    return false;
  }
  
  function policy_files_upload_exit(policy_number){
    //var policy_number = 1;
    if(policy_number){
        
        
        
        //alert($('.filestoremove').val());
        //return 1;
            //for(file_added_index)
            var file_data = null;
            var form_data = new FormData();
            for (i = file_added_index; i >= 1; i--) {
              if($('#adfile'+i).length){
                file_data = $('#adfile'+i).prop('files')[0];
                if(file_data != undefined) {
                  form_data.append('file[]', file_data);
                  form_data.append('descriptions[]', $('#file_description'+i).val());
                }
              }
            } 
            
            if(form_data) {

                form_data.append("action", "upload_policy_files");
                form_data.append("policy_num",policy_number);
                
                if($( ".filestoremove" ).length){
                 $( ".filestoremove" ).each(function( e ) {
                   form_data.append('remove_lists[]', $(this).val());
                 });
                }
                
                $.ajax({
                    type: 'POST',
                    url: file_upload_ajax_url,
                    contentType: false,
                    processData: false,
                    //async: false,
                    data: form_data,
                    success:function(response) {
                        //alert(response);
                        if(response == 'success') {
                            window.location.href = health_new_success_url;
                        } else if(response == 'false') {
                            alert('Failed to upload files.');
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
 
                        //$('.image').val('');
                    }
                });
            }

    }else{
        alert("Policy Number can't be empty!!!");
    }
    return false;
  }
  





//payment table save start//
   function payment_form_submit(){
    var policy_id = $('#policy_id').val();
    var paymenType = $('#paymenType').val();
    var id_pay_cycle = $('#id_pay_cycle').val();
    var paymentpaid = $('#paymentpaid').val();
  
    var receipt_note = $('#receipt_note').val();
    var receipt_type = $('#receipt_type').val();
    var receipt_pay = $('#receipt_pay').val();
    var policy_status = $('#policy_status').val();

    var notes = $('#notes').val();
    var notesids = $('#notesids').val();

    ///alert(notes+'/'+notesids);

                  
    if(policy_id){
        if ( paymenType !="" && id_pay_cycle !="" && paymentpaid !="" ) {

        var rowData = $('#content_section_payments .row_payment').last().find('#payments_id').val();
        //alert(rowData);
        if(!rowData){
            var rowCurrentData = $('#content_section_payments .row_payment').last().attr('id');
            //alert(rowCurrentData);
            $("#ajax_progress").find('label').text('Pyament form saving please wait...');
            $("#ajax_progress").show();
            $.ajax({
                type: 'POST',
                url: admin_ajax_url+"?action=save_payments",
                data: $('#'+rowCurrentData+' :input').serialize()+"&receipt_pay="+receipt_pay+"&receipt_type="+receipt_type+"&policy_status="+policy_status+"&receipt_note="+receipt_note+"&notes="+notes+"&notesids="+notesids,
                success: function(response) {
                    //alert(response); 
                    //return 1;
                    var response_json = $.parseJSON(response);
                    if(parseInt(response_json.sucess) ==1){
                        window.location.reload();
                        
                    }else{
                     
                     alert("Failed to  save payments data"); 
                    }
                    //alert(response);
                },
            });
        }


        }else{
            alert("Fill Type, Paymod & Payment date required field");
        }
    }else{
        alert("Policy id not found!!!");
    }
    return false;
  }

//agents-note end//

//agent-commission-add stert

 $( ".submit_btn_agent" ).click(function(e) {

     var data_id = parseInt($(this).attr('data-id'));
     var policy_id = $('#policy_id').val();
     var agent_id = parseInt($('#agent_level'+data_id).children("option:selected").val());
     var notes = $('#agent_level'+data_id+'_notes').val();

     //alert(data_id+'/'+policy_id+'/'+agent_id);

     if(data_id && policy_id && agent_id){
        
            $("#ajax_progress").find('label').text('Agent label form saving please wait...');
            $("#ajax_progress").show();
            $.ajax({
                type: 'POST',
                url: admin_ajax_url+"?action=save_agent_label",
                data: $('#agent_frm'+data_id+' :input').serialize()+"&policy_id="+policy_id+"&data_id="+data_id+"&agent_id="+agent_id+"&notes="+notes, 
                success: function(response) {
                    var response_json = $.parseJSON(response);
                    if(parseInt(response_json.sucess) ==1){
                        window.location.reload();
                    }else{
                     alert("Failed to  save agent label data"); 
                    }
                },
            });
        

    }else{
        alert("Policy id not found!!!");
    }
    return false;

   });

//agent-commission-add end


  
  
    function policy_files_upload(policy_number){
    //var policy_number = 1;
    if(policy_number){
        
        
        
        //alert($('.filestoremove').val());
        //return 1;
            //for(file_added_index)
            var file_data = null;
            var form_data = new FormData();
            for (i = file_added_index; i >= 1; i--) {
              if($('#adfile'+i).length){
                file_data = $('#adfile'+i).prop('files')[0];
                if(file_data != undefined) {
                  form_data.append('file[]', file_data);
                  form_data.append('descriptions[]', $('#file_description'+i).val());
                }
              }
            } 
            
            if(form_data) {

                form_data.append("action", "upload_policy_files");
                form_data.append("policy_num",policy_number);
                
                if($( ".filestoremove" ).length){
                 $( ".filestoremove" ).each(function( e ) {
                   form_data.append('remove_lists[]', $(this).val());
                 });
                }
                
                $.ajax({
                    type: 'POST',
                    url: file_upload_ajax_url,
                    contentType: false,
                    processData: false,
                    //async: false,
                    data: form_data,
                    success:function(response) {
                        //alert(response);
                        if(response == 'success') {
                            //window.location.href = health_edit_success_url;
                            //alert(policy_number + health_edit_success_url);
                            var n = health_edit_success_url.indexOf(policy_number);
                            if(n<1)
                            health_edit_success_url = health_edit_success_url+policy_number;
                            
                            window.location.href = health_edit_success_url;
                            
                        } else if(response == 'false') {
                            alert('Failed to upload files.');
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
 
                        //$('.image').val('');
                    }
                });
            }

    }else{
        alert("Policy Number can't be empty!!!");
    }
    return false;
  }
  
  function processHelathInsured(row_data_id, processFilter=false){
    //curr_policy_id = 8;
    if(row_data_id){  
    if(curr_policy_id){
      var form_data = new FormData();
      var interview = $('tr#row_insured'+row_data_id).find('input[name="interview[]"]').is(":checked")? 1: 0;
      var f_name = $('tr#row_insured'+row_data_id).find('input[name="first_name[]"]').val();
      var l_name = $('tr#row_insured'+row_data_id).find('input[name="last_name[]"]').val();
      var order = $('tr#row_insured'+row_data_id).find('input[name="order[]"]').val();
      var dob = $('tr#row_insured'+row_data_id).find('input[name="dob[]"]').val();
      //alert(dob);
      //return 1;
      var relation = $('tr#row_insured'+row_data_id).find('select[name="relation[]"]').val();
      var effective = $('tr#row_insured'+row_data_id).find('input[name="effective[]"]').val();
      var age = $('tr#row_insured'+row_data_id).find('input[name="age[]"]').val();
      var gender = $('tr#row_insured'+row_data_id).find('select[name="gender[]"]').val();
      var ninety_day_waiver = $('tr#row_insured'+row_data_id).find('input[name="ninety_day_waiver[]"]').is(":checked")? 1: 0;
      var effective_ninety_day = $('tr#row_insured'+row_data_id).find('input[name="effective_ninety_day[]"]').val();
      var ridermater = $('tr#row_insured'+row_data_id).find('input[name="ridermater[]"]').is(":checked")? 1: 0;
      var ridercomp = $('tr#row_insured'+row_data_id).find('input[name="ridercomp[]"]').is(":checked")? 1: 0;
      var activelab = $('tr#row_insured'+row_data_id).find('input[name="activelab[]"]').is(":checked")? 1: 0;
      var ins_inactivate_date = $('tr#row_insured'+row_data_id).find('input[name="ins_inactivate_date[]"]').val();
      var ins_email = $('tr#row_insured'+row_data_id).find('input[name="ins_email[]"]').val();
      var insured_num = $('tr#row_insured'+row_data_id).find('input[name="insured[]"]').val();
      insured_num = insured_num ? insured_num : 0;
      
      if(f_name && l_name && relation){
      
      form_data.append('interview', interview);  
      form_data.append('first_name', f_name); 
      form_data.append('last_name', l_name);
      form_data.append('order', order); 
      form_data.append('dob', dob); 
      form_data.append('relation', relation); 
      form_data.append('effective', effective); 
      form_data.append('age', age);
      form_data.append('gender', gender);
      form_data.append('ninety_day_waiver', ninety_day_waiver);
      form_data.append('effective_ninety_day', effective_ninety_day);
      form_data.append('ridermater', ridermater);
      form_data.append('ridercomp', ridercomp);
      form_data.append('activelab', activelab);
      form_data.append('ins_inactivate_date', ins_inactivate_date);
      form_data.append('ins_email', ins_email);
      form_data.append('insured_num', insured_num);
      form_data.append('policy_num', curr_policy_id);
      form_data.append('data_row_id', row_data_id);
      form_data.append('action', 'save_insured');
      
      if(processFilter)
      form_data.append('process_filter', '1');
      
      if(!insured_processing){
      //insured_processing = 1;
      $.ajax({
            type: 'POST',
            url: admin_ajax_url,
            contentType: false,
            processData: false,
            //async: false,
            data: form_data,
            success:function(response) {
                //alert(response);
                var response_json = $.parseJSON(response);
                if(response_json.sucess == 1) {
                  if(response_json.insured_number){
                  var update_row = response_json.data_row;
                  $('tr#row_insured'+update_row).find('input[name="insured[]"]').val(response_json.insured_number); 
                  }
                }else {
                    //alert('Try later');
                    //if(parseInt(response_json.pr) == 1)
                    //alert('Permission error! You are not allowed to perform this action.');
                }
                insured_processing = 0;
                //$('.image').val('');
            }
        });
       }
     } 
    }else{
      alert('Policy number not found...');  
    }
      //alert('interview:'+interview+',first_name:'+f_name+ ',last_name:'+ l_name+',order:'+ order+ ',dob:'+ dob+ ',relation:'+ relation+ ',effective:'+ effective+ ',age:'+ age+',gender:'+ gender+',ninety_day_waiver:'+ ninety_day_waiver+',effective_ninety_day:'+ effective_ninety_day+',ridermater:'+ ridermater+',ridercomp:'+ ridercomp+',activelab:'+ activelab+',ins_inactivate_date:'+ ins_inactivate_date+',ins_email:'+ ins_email);    
      //return 1;
      //form_data.append('order', order);  
    }
  }

  
  $( ".addNotes" ).click(function(e) {
     var data_id = parseInt($(this).attr('data-id'));
     if(data_id>1){
       $('.noteBlock'+data_id).remove(); 
     }else{
     var new_note = $('.noteBlock').clone(true);
     new_note.find('a.addNotes').attr('data-id',note_added_index+1);
     new_note.find('a.addNotes').attr('id','addNotes'+(note_added_index+1));
     new_note.find('.inputNotes').val('');
     new_note.find('.notesids').val('NEW');
     new_note.attr('class','row noteBlock'+(note_added_index+1));
     new_note.find('a.addNotes').text('X');
     $('#content_section_note h3').after(new_note);
     note_added_index++;
     }
   });
   
   $( ".addFiles" ).click(function(e) {
     var data_id = parseInt($(this).attr('data-id'));
     if(data_id>1){
       $('.fileBlock'+data_id).remove(); 
     }else{
     var new_file = $('.fileBlock').clone(true);
     new_file.find('a.addFiles').attr('data-id',file_added_index+1);
     new_file.find('input.hideaddinput').attr('data-id',file_added_index+1);
     new_file.find('input.hideaddinput').attr('id','adfile'+(file_added_index+1));
     new_file.find('label.bgorange').attr('for','adfile'+(file_added_index+1));
     new_file.find('input.file_path').attr('id','file_path'+(file_added_index+1)).val('');
     new_file.find('input.file_description').attr('id','file_description'+(file_added_index+1)).val('');
     new_file.find('a.addFiles').attr('id','addFiles'+(file_added_index+1));
     new_file.attr('class','row fileBlock'+(file_added_index+1));
     new_file.find('a.addFiles').text('X');
     $('#content_section_file').prepend(new_file);
     file_added_index++;
     }
   });
   
$( ".removeFiles" ).click(function(e) {
     var data_id = parseInt($(this).attr('data-id'));
     if(data_id){
       $('#content_section_file').prepend('<input type="hidden" name="remove_files[]" class="filestoremove" value="'+data_id+'"/>');
       $('#currFile'+data_id).hide();
     }
   });   

$('input[type="file"]').change(function(e){
var fileName = e.target.files[0].name;
var data_id = $(this).attr('data-id');
$('#file_path'+data_id).val(fileName);
});

$( "#addInsuredRow a" ).click(function(e) {
     var new_row_insured = $('#row_insured_base').clone(true);
     insured_added_index++;
     new_row_insured.attr('id','row_insured'+insured_added_index);
     new_row_insured.attr('data-id',insured_added_index);
     new_row_insured.find('.useDatePicker').removeClass('hasDatepicker').attr('id','').datepicker({changeYear: true});
     
     new_row_insured.find('#waiverday').attr('id','waiverday'+insured_added_index);
     new_row_insured.find('label[for="waiverday"]').attr('for','waiverday'+insured_added_index);
     new_row_insured.find('#ridermater').attr('id','ridermater'+insured_added_index);
     new_row_insured.find('label[for="ridermater"]').attr('for','ridermater'+insured_added_index);
     new_row_insured.find('#ridercomp').attr('id','ridercomp'+insured_added_index);
     new_row_insured.find('label[for="ridercomp"]').attr('for','ridercomp'+insured_added_index);
     new_row_insured.find('#activelab').attr('id','activelab'+insured_added_index);
     new_row_insured.find('label[for="activelab"]').attr('for','activelab'+insured_added_index);
     new_row_insured.find('.order_column').val(insured_added_index);
     new_row_insured.find('input[name="first_name[]"]').val('');
     new_row_insured.find('input[name="first_name[]"]').attr('autocomplete', 'false');
     
     $('#content_section_insured table tr:last').before(new_row_insured);
     new_row_insured.show();
     //alert($('tr#row_insured1').find('input[name="first_name[]"]').val());
                //var itemcode = $(tr > 'input[name="code"]').val();
                ///window.location = "/search?p="+itemcode;
   });

$( "#addPaymentRow a" ).click(function(e) {
     var new_row_payment = $('#row_payments_base').clone(true);
     payment_added_index++;
     new_row_payment.attr('id','row_payment'+payment_added_index);
     new_row_payment.attr('data-id',payment_added_index);
     new_row_payment.find('.order_column').html(payment_added_index);
     new_row_payment.find('#lockedlabel').attr('id','lockedlabel'+payment_added_index);
     new_row_payment.find('label[for="lockedlabel"]').attr('for','lockedlabel'+payment_added_index);

     new_row_payment.find('#paidlabel').attr('id','paidlabel'+payment_added_index);
     new_row_payment.find('label[for="paidlabel"]').attr('for','paidlabel'+payment_added_index);

     new_row_payment.find('input[name="amount[]"]').val('');
     new_row_payment.find('input[name="amount[]"]').attr('autocomplete', 'false');
     new_row_payment.find('.useDatePicker').removeClass('hasDatepicker').attr('id','').datepicker({changeYear: true});
     $('#content_section_payments table tr:last').before(new_row_payment);
     new_row_payment.show();
     
   });
   
$( ".insuredProcess" ).focusout(function(e) {
  var data_id = $(this).closest("tr").attr("data-id");
  if(data_id)
  processHelathInsured(data_id, true);
}); 

$( ".deleteInsured" ).click(function(e) {
    var data_id = $(this).closest("tr").attr("data-id");
    if(data_id){
       var insured_num = $('tr#row_insured'+data_id).find('input[name="insured[]"]').val();
       if(insured_num){
          var form_data = new FormData();
          form_data.append('insured_num', insured_num);
          form_data.append('data_row_id', data_id);
          form_data.append('action', 'remove_insured');
          
          $.ajax({
            type: 'POST',
            url: admin_ajax_url,
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                
                var response_json = $.parseJSON(response);
                if(response_json.sucess == 1) {
                  if(response_json.insured_number){
                  var remove_row = response_json.data_row;
                  $('tr#row_insured'+remove_row).remove(); 
                  }
                }else {
                    //alert('Try later');
                    if(parseInt(response_json.pr) == 1)
                    alert('Permission error! You are not allowed to perform this action.');
                }
            }
        });
          
       }else{
        $('tr#row_insured'+data_id).remove();
       }
    }  
});

$( ".deleteRateup" ).click(function(e) {
    var data_id = $(this).siblings(".rateupID").html();
    //alert(data_id);
    //return false;
    if(data_id){          
          $.ajax({
            type: 'POST',
            url: admin_ajax_url+"?action=delete_rateup",
            data: "rateup_id="+data_id, 
            success: function(response) {
                //alert(response); 
                //return 1;
                var response_json = $.parseJSON(response);
                if(parseInt(response_json.sucess) == 1){
                    window.location.href = window.location.href;
                }else{
                 if(parseInt(response_json.pr) == 1)
                 alert('Permission error! You are not allowed to perform this action.');
                 else
                 alert("Failed to delete rateup!"); 
                }
                //alert(response);
            },
          });
        
    } 
});



$( ".addRateUps" ).click(function(e) {
 var data_id = $(this).closest("tr").attr("data-id");
 //alert(data_id);
 var insured_num = $('tr#row_insured'+data_id).find('input[name="insured[]"]').val();
 if(insured_num){
    var rate_up_url = '<?php echo SCRIPT_URL ?>main/rate-up/'+insured_num+'/insured';
    window.open(rate_up_url);
 }else{
    alert('Insured number not found!!!');
 }
});

///////// faroque's //////////////////////////
$( ".riderController" ).click(function(e) {    
    
 var data_id = $(this).closest("tr").attr("data-id");
 //alert(data_id);
 var insured_num = $('tr#row_insured'+data_id).find('input[name="insured[]"]').val();
 if(insured_num){
    var rate_up_url = '<?php echo SCRIPT_URL ?>main/rider/'+insured_num+'/insured';
    window.open(rate_up_url);
 }else{
    alert('Insured number not found!!!');
 }
});

$( ".manualRate" ).click(function(e) {    
    
 var data_id = $(this).closest("tr").attr("data-id");
 //alert(data_id);
 var insured_num = $('tr#row_insured'+data_id).find('input[name="insured[]"]').val();
 if(insured_num){
    var rate_up_url = '<?php echo SCRIPT_URL ?>main/manual_rate/'+insured_num;
    window.open(rate_up_url);
 }else{
    alert('Insured number not found!!!');
 }
});
//////////////////////////////////////////////

var selectedYear,selectedMonth;
$(document).ready(function(){
    $(".hasDatepicker.datepicker-dob").on("change",function(){
        //var currentDate = new Date();
        //console.log(currentDate);
        var parentID = $(this).parents('tr').attr('id');
        //console.log(parentID);
        
        var date_dob = $('#'+parentID).find('input[name="dob[]"]').val();
        var date_effective = $('#'+parentID).find('input[name="effective[]"]').val();
        
        
       
        
        
        
        if(date_dob && date_effective){
        
        var selected = new Date(date_dob);
        var effective = new Date(date_effective);
        //console.log(selected);
        var age = effective.getFullYear() - selected.getFullYear();
        var m = effective.getMonth() - selected.getMonth();
        if (m < 0 || (m === 0 && effective.getDate() < selected.getDate())) {
            age = age - 1;
        }
        //console.log(age);
        
        $('#'+parentID).find('.insured-age').val(age); 
        if(age < 11){
            $('#'+parentID).find('.insuredRelation option').each(function(){
                $(this).removeAttr('selected');
                var selectedOption = $(this).text();
                if(selectedOption == 'Dependent U11'){
                    $(this).attr('selected','selected');
                }
            });
        }
        else if(age > 10 && age < 19){
            $('#'+parentID).find('.insuredRelation option').each(function(){
                $(this).removeAttr('selected');
                var selectedOption = $(this).text();
                if(selectedOption == 'Dependent'){
                    $(this).attr('selected','selected');
                }
            });
        }
        else if(age > 18 && age < 23){
            $('#'+parentID).find('.insuredRelation option').each(function(){
                $(this).removeAttr('selected');
                var selectedOption = $(this).text();
                if(selectedOption == 'Dependent ST'){
                    $(this).attr('selected','selected');
                }
            });
          }
        }else{
            return 1;
        }
    });
    
    $("#effective_date").on("change",function(){
        var selected = $(this).val(); 
        
         if(selected){
         $('tr#row_insured_base').find('input[name="effective[]"]').val(selected);
         var effective_date_ins1 = $('tr#row_insured1').find('input[name="effective[]"]').val();
         var insured_data_ins1 =  $('tr#row_insured1').find('input[name="insured[]"]').val();
         if(!effective_date_ins1 || !insured_data_ins1)
         $('tr#row_insured1').find('input[name="effective[]"]').val(selected);
         }
        
        selected = new Date(selected);
        selectedYear = selected.getFullYear();
        selectedMonth = selected.getMonth()+1;
        
        if(selectedMonth > 3){
            selectedYear = selectedYear;
            console.log(selectedMonth);
            console.log(selectedYear);
            //alert();
        }else{
            selectedYear = parseInt(selectedYear)-1;
            console.log(selectedMonth);
            console.log(selectedYear);
        }
        $('#paymentperiod select option').each(function(){
            $(this).removeAttr('selected');
            var selectedOption = $(this).text();
            //console.log(selectedOption);
            if(selectedOption == selectedYear){
                $(this).attr('selected','selected');
            }
        });
    });
    
    /*$('.print-add a').click(function(){
        $('#addSaveRateUp').trigger('click');
    });*/
});


function updateRateUpChanges(insured_num){
  var data_id = $('.tableContent').find('input[name="insured[]"][value="'+insured_num+'"]').closest("tr").attr("data-id");
  //alert(insured_num);
  if(data_id){
          var form_data = new FormData();
          form_data.append('insured_num', insured_num);
          form_data.append('data_row_id', data_id);
          form_data.append('action', 'rate_up_changes_insured');
          
          $.ajax({
            type: 'POST',
            url: admin_ajax_url,
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                
                var response_json = $.parseJSON(response);
                if(response_json.sucess == 1) {
                 var row_data_id = response_json.data_row;
                 $('tr#row_insured'+row_data_id).find('span.frmRateUPPercent').text(response_json.rateuppercent); 
                 $('tr#row_insured'+row_data_id).find('span.frmRateUPAmount').text(response_json.rateupamount);
                }else {
                    //alert('Try later');
                }
            }
        });
          
       }
   
}

$('#clariaexpLabel').click(function(){
    if($(this).is(':checked')){
        //alert('Checked');
        $('input[name="policy_fee"]').val(150);
    }else{
        //alert('Not Checked');
        $('input[name="policy_fee"]').val(100);
    }
});

//$('.insuredProcess').on('blur',processHelathInsured);  
</script>
<?php }

function scriptHealthRateup(){ ?> 
<script type="text/javascript">
var admin_ajax_url = '<?php echo SCRIPT_URL ?>ajax/admin_ajax_code.php';
function processRateUps(ins_num){
  var rateup_val = parseInt($('#rateup_type').val());
  if(ins_num && rateup_val){
          var form_data = new FormData();
          form_data.append('rate_up_type', rateup_val);
          form_data.append('insured_number', ins_num);
          form_data.append('action', 'load_rateups');
          $.ajax({
            type: 'POST',
            url: admin_ajax_url,
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                
                var response_json = $.parseJSON(response);
                if(response_json.sucess == 1) {
                 $('#rate_up_percent').val(response_json.rateuppercent);
                 $('#rate_up_amount').val(response_json.rateupamount);
                }else {
                    //alert('Try later');
                }
            }
        });
  }else{
    $('#rate_up_percent').val('');
    $('#rate_up_amount').val('');
    $('#rate_up_com').val('');
  }
} 

function addSaveRateUpData(ins_num){
  var rateup_val = parseInt($('#rateup_type').val());
  var rate_up_amount =  $('#rate_up_amount').val();
  if(ins_num && (rateup_val || rate_up_amount)){
      var form_data = new FormData();
      form_data.append('rate_up_type', rateup_val);
      form_data.append('insured_number', ins_num);
      form_data.append('rate_up_amount', rate_up_amount);
      form_data.append('action', 'save_rateups');
      $.ajax({
        type: 'POST',
        url: admin_ajax_url,
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            
            var response_json = $.parseJSON(response);
            if(response_json.sucess == 1) {
             //alert(response_json.insurednumber);
             window.opener.updateRateUpChanges(response_json.insurednumber);
             //window.location.reload();
             window.location.href='<?php echo SCRIPT_URL ?>main/rate-up/'+ins_num;
            }else {
                if(parseInt(response_json.pr) == 1)
                alert('Permission error! You are not allowed to perform this action.');
                //alert('Try later');
            }
        }
     });
  }
}

function addSavePrintRateUpData(ins_num){
  var rateup_val = parseInt($('#rateup_type').val());
  var rate_up_amount =  $('#rate_up_amount').val();
  var flag = 0;
  $('.tableContent tr').each(function(){
    var RateId = $(this).find('.rate-up-id').html();
    if(RateId == 11 || RateId == 12 || RateId == 13 || RateId == 14 || RateId == 15 || RateId == 10 || RateId == 16 || RateId == 17 || RateId == 18 || RateId == 19){
        flag = 1;
        var rateId = $(this).find('.rateupID').html();
        if(rateId){
            window.location.href='<?php echo SCRIPT_URL ?>main/rate-up-add-print/'+rateId;
        }
        
        //alert(rateId);
    }
    if(flag == 0){
        window.location.href='<?php echo SCRIPT_URL ?>main/rate_up_ad_print/'+ins_num;
    }
    
  });
  /*if(ins_num && (rateup_val || rate_up_amount)){
      var form_data = new FormData();
      form_data.append('rate_up_type', rateup_val);
      form_data.append('insured_number', ins_num);
      form_data.append('rate_up_amount', rate_up_amount);
      form_data.append('action', 'save_rateups');
      $.ajax({
        type: 'POST',
        url: admin_ajax_url,
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
            
            var response_json = $.parseJSON(response);
            if(response_json.sucess == 1) {
             //alert(response_json.insurednumber);
             window.opener.updateRateUpChanges(response_json.insurednumber);
             window.location.href='<?php echo SCRIPT_URL ?>main/rate-up-add-print/'+response_json.rate_id;
             //window.close();
            }else {
                if(parseInt(response_json.pr) == 1)
                alert('Permission error! You are not allowed to perform this action.');
                //alert('Try later');
            }
        }
     });
  }else{
    //alert('no rate up');
    $('.tableContent tbody tr:last-child td').each(function(){
        var rateId = $(this).find('.rateupID').html();
        if(rateId){
            //alert(rateId);
            window.location.href='<?php echo SCRIPT_URL ?>main/rate-up-add-print/'+rateId;
        }
    });
  }*/
}


function calculate_premium_form_submit(){
    var length = $('#form_calculate_premium table tr.insured-data').length;
    $('#form_calculate_premium table tr.insured-data').each(function(index, element){
        var insured_number = $(this).find('#insuredId').val();
        var premiumBase = $(this).find('#premiumBase').val();
        var premiumCalculate = $(this).find('#premiumCalculate').val();
        console.log(insured_number);
        
        if(insured_number){
            $.ajax({
                type: 'POST',
                url: admin_ajax_url+"?action=update_insured_premium",
                data: "premiumBase="+premiumBase+"&premiumCalculate="+premiumCalculate+"&insured_number="+insured_number,
                success: function(response) {
                    //alert(response); 
                    //return 1;
                    var response_json = $.parseJSON(response);
                    if(parseInt(response_json.sucess) == 1){
                        if (index === (length - 1)) {
                          window.location.href = window.location.href;
                        }
                        //alert("Primiums Updated Successfully!!!");
                    }else{
                       alert("Failed to  save policy"); 
                    }
                    //alert(response);
                },
            });
    
        }else{
            alert("No Insured to be updated!!!");
        }
    }); 
    
    //window.location.href = window.location.href;              
    return false;
}

function premium_inclusion_form_submit(){
    var length = $('#form_calculate_premium table tr.insured-data').length;
    $('#form_calculate_premium table tr.insured-data').each(function(index, element){
        var insured_number = $(this).find('#insuredId').val();
        var premiumBase = $(this).find('#premiumBase').val();
        var premiumCalculate = $(this).find('#premiumCalculate').val();
        console.log(insured_number);
        
        if(insured_number){
            $.ajax({
                type: 'POST',
                url: admin_ajax_url+"?action=update_insured_premium",
                data: "premiumBase="+premiumBase+"&premiumCalculate="+premiumCalculate+"&insured_number="+insured_number,
                success: function(response) {
                    //alert(response); 
                    //return 1;
                    var response_json = $.parseJSON(response);
                    if(parseInt(response_json.sucess) == 1){
                        if (index === (length - 1)) {
                          window.location.href = window.location.href;
                        }
                        //alert("Primiums Updated Successfully!!!");
                    }else{
                       alert("Failed to  save policy"); 
                    }
                    //alert(response);
                },
            });
    
        }else{
            alert("No Insured to be updated!!!");
        }
    }); 
    
    //window.location.href = window.location.href;              
    return false;
}

var selected = '';
var selectedEndDate = '';
var loopCount = 1;
$(document).ready(function(){
       $(".datepicker-proratedate").on("change",function(){
            var loopCount = 1;
            var currentDate = new Date();
            //console.log(parentID);
            selected = $(this).val();
            $('#form_premium_inclusion tr.insured-data').each(function(){
                $(this).find('.prorateDate').val(selected);
                var effectiveDate = $(this).find('.insuredEffectiveDate').val();
                var premiumDayI = $(this).find('.premiumDayI').val();
                setTimeout(function(){
                    selected = new Date(selected);
                    effectiveDate = new Date(effectiveDate);
                    var diff = selected - effectiveDate;
                    var diffDays = diff/1000/60/60/24;
                    //console.log(selected);
                    //console.log(effectiveDate);
                    //console.log(diff);
                    //console.log(diffDays);
                    var premiumToPay = (diffDays*premiumDayI).toFixed(2);
                    //console.log(premiumDayI);
                    //console.log(premiumToPay);
                    $('#premiumToPay'+loopCount).val(premiumToPay);
                    $('#DaysP'+loopCount).val(diffDays);
                    loopCount = loopCount+1;
                }, 1000);
                
            });
            
            $('.premium-inclusion-wrapper').hide();
            $('.proratedate-wrapper').hide();
            $('.enddate-wrapper').show();
            
        }); 
        
        $(".datepicker-enddate").on("change",function(){
            var loopCount = 1;
            var currentDate = new Date();
            //console.log(parentID);
            selectedEndDate = $(this).val();
            $('#form_premium_inclusion tr.insured-data').each(function(){
                $(this).find('.endDate').val(selectedEndDate);
                var effectiveDate = $(this).find('.insuredEffectiveDate').val();
                var premiumDayI = $(this).find('.premiumDayI').val();
                var BasepremiumDay = $(this).find('.BasepremiumDay').val();
                setTimeout(function(){
                    selectedEndDate = new Date(selectedEndDate);
                    effectiveDate = new Date(effectiveDate);
                    var diff = selectedEndDate - effectiveDate;
                    var diffDays = diff/1000/60/60/24;
                    //console.log(selectedEndDate);
                    //console.log(effectiveDate);
                    //console.log(diff);
                    //console.log(diffDays);
                    var premiumWI = (diffDays*premiumDayI).toFixed(2);
                    var PremiumCertificate = (diffDays*BasepremiumDay).toFixed(2);
                    //console.log(premiumWI);
                    //console.log(PremiumCertificate);
                    $('#premiumCertificate'+loopCount).val(PremiumCertificate);
                    $('#premiumWI'+loopCount).val(premiumWI);
                    loopCount = loopCount+1;
                }, 1000);
            });
            
            
            setTimeout(function(){
            $('.proratedate-wrapper').hide();
            $('.enddate-wrapper').hide();
            $('.premium-inclusion-wrapper').show();
            }, 2000);
            
        });
        
        var totalHeight = $(window).height();
        totalHeight = totalHeight/2;
        $('.proratedate-wrapper').css('top',totalHeight);
        $('.enddate-wrapper').css('top',totalHeight);
        $('.premium-inclusion-wrapper').css('top',totalHeight/2);
        $('.premium-inclusion-btn').click(function(){
            $('.premium-inclusion-wrapper').hide();
            $('.enddate-wrapper').hide();
            $('.proratedate-wrapper').show();
        });
        $('.close-btn').click(function(){
            $('.premium-inclusion-wrapper').hide();
        });
        
       if(!edit_permission){
        $("#frm_new_health :input").attr("disabled", true);
       }
        
    });

</script>   
<?php }
function scriptUserNew(){ 
?>
<script type="text/javascript">
  function user_add_form_submit(){ 
    var password_data = $('#password').val();
    var password_repeat = $('#password_repeat').val();
    var user_number = $('#user_number').val();
    
    if(user_number && !password_data && !password_repeat){
       return true; 
    }
    
    if(password_data != password_repeat){
        alert("Password & Repeat don't match!!!");
        return false;
    }else{
        return true;
    }
    
  }
  </script>
<?php }
?>