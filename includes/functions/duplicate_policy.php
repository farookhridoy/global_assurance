<?php
function scriptDuplicatePolicy(){
?>

<script type="text/javascript">
var admin_ajax_url = '<?php echo SCRIPT_URL ?>ajax/admin_ajax_code.php';
var duplicate_policy_success_url = '<?php echo SCRIPT_URL ?>main/health-edit/';
function duplicatePolicy()
    { 
        
        var policy_number = $("#policy_number").val();
        var new_policy_number = $("#new_policy_num").val();
        if(policy_number && new_policy_number){
        $("#ajax_progress_block").show();
        $.post(admin_ajax_url,{action:'duplicate_policy', policy_num: policy_number,policy_new_number :new_policy_number },
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                 if(data.new_policy_number){
                     window.location.href = duplicate_policy_success_url+data.new_policy_number;
                 }else{
                    alert('Duplicate policy failed. Please try again.');
                 }
                }
                else
                {
                 if(parseInt(data.pr) == 1)
                 alert('Permission error! You are not allowed to perform this action.');
                 //alert(data.message);
                }
            },'json');
            
            $("#ajax_progress_block").hide();
            
            }else{
              alert('Policy Number and New Policy Number needed.');
            }
            return false;
  }
  </script>
<?php   }




function duplicateFilesPolicy($old_policy_id,$new_policy_id){
    global $db;

    $newFileLists = array();
    $sql="SELECT * FROM filespolicy WHERE idpolicy ='$old_policy_id'";
    $filesLists = $db->select($sql);
    if($filesLists){
        foreach($filesLists as  $file){
             $sql = 'INSERT INTO filespolicy SET idpolicy="'.$new_policy_id.'"';
             foreach($file as $f_key => $f_value){
               if($f_key != 'id' && $f_key != 'idpolicy'){
                 $sql .= ','.$f_key.'="'.$f_value.'"';
               }
             }
          $new_file_id = $db->insert($sql);
          if($new_file_id)
          $newFileLists[] = $new_file_id;
        }
    }
    
    return $newFileLists;
}


function duplicateNotesPolicy($old_policy_id,$new_policy_id){
    global $db;

    $newNoteLists = array();
    $sql="SELECT * FROM notespolicy WHERE idpolicy ='$old_policy_id'";
    $notesLists = $db->select($sql);
    if($notesLists){
        foreach($notesLists as  $note){
             $sql = 'INSERT INTO notespolicy SET idpolicy="'.$new_policy_id.'"';
             foreach($note as $n_key => $n_value){
               if($n_key != 'id' && $n_key != 'idpolicy'){
                 $sql .= ','.$n_key.'="'.$n_value.'"';
               }
             }
          $new_note_id = $db->insert($sql);
          if($new_note_id)
          $newNoteLists[] = $new_note_id;
        }
    }
    
    return $newNoteLists;
}

function duplicateRateUpInsured($old_insured_id,$new_insured_id){
    global $db;

    $newRateUps = array();
    $sql="SELECT * FROM rateup WHERE idinsured ='$old_insured_id'";
    $rateUpLists = $db->select($sql);
    if($rateUpLists){
        foreach($rateUpLists as  $rateup){
             $sql = 'INSERT INTO rateup SET idinsured="'.$new_insured_id.'"';
             foreach($rateup as $r_key => $r_value){
               if($r_key != 'id' && $r_key != 'idinsured'){
                 $sql .= ','.$r_key.'="'.$r_value.'"';
               }
             }
          $new_rateup_id = $db->insert($sql);
          if($new_rateup_id)
          $newRateUps[] = $new_rateup_id;
        }
    }
    
    return $newRateUps;
}


function duplicateManualRateInsured($old_insured_id,$new_insured_id){
    global $db;

    $newManualRates = array();
    $sql="SELECT * FROM manual_rate WHERE insured_id ='$old_insured_id'";
    $manualRateLists = $db->select($sql);
    if($manualRateLists){
        foreach($manualRateLists as  $manualrate){
             $sql = 'INSERT INTO manual_rate SET insured_id="'.$new_insured_id.'"';
             foreach($manualrate as $r_key => $r_value){
               if($r_key != 'id' && $r_key != 'insured_id'){
                 $sql .= ','.$r_key.'="'.$r_value.'"';
               }
             }
          $new_manualrate_id = $db->insert($sql);
          if($new_manualrate_id)
          $newManualRates[] = $new_manualrate_id;
        }
    }
    
    return $newManualRates;
}


function duplicateRiderInsured($old_insured_id,$new_insured_id){
    global $db;

    $newRiders = array();
    $sql="SELECT * FROM rider WHERE insured_id ='$old_insured_id'";
    $riderLists = $db->select($sql);
    if($riderLists){
        foreach($riderLists as  $rider){
             $sql = 'INSERT INTO rider SET insured_id="'.$new_insured_id.'"';
             foreach($rider as $r_key => $r_value){
               if($r_key != 'id' && $r_key != 'insured_id'){
                 $sql .= ','.$r_key.'="'.$r_value.'"';
               }
             }
          $new_rider_id = $db->insert($sql);
          if($new_rider_id)
          $newRiders[] = $new_rider_id;
        }
    }
    
    return $newRiders;
}


function duplicateInsuredPolicy($old_policy_id,$new_policy_id){
    global $db;

    $newInsuredLists = array();
    $sql="SELECT * FROM insured WHERE idpolicy ='$old_policy_id'";
    $insuredLists = $db->select($sql);
    if($insuredLists){
        foreach($insuredLists as  $insured){
             $sql = 'INSERT INTO insured SET idpolicy="'.$new_policy_id.'"';
             foreach($insured as $i_key => $i_value){
               if($i_key != 'id' && $i_key != 'idpolicy'){
                 $sql .= ','.$i_key.'="'.$i_value.'"';
               }
             }
          $new_insured_id = $db->insert($sql);
          if($new_insured_id){
          $old_insured_id = $insured['id'];
          $newInsuredLists[] = $new_insured_id;
          if($old_insured_id && $new_insured_id){
          $rateUps = duplicateRateUpInsured($old_insured_id,$new_insured_id);
          $manualRates = duplicateManualRateInsured($old_insured_id,$new_insured_id);
          $riders = duplicateRiderInsured($old_insured_id,$new_insured_id);
          }
          }
        }
    }
    
    return $newInsuredLists;
}





function duplicateHealthPolicy($policy_id,$new_policy_number){
    global $db; 
    if($policy_id && $new_policy_number){
      $sql="SELECT * FROM policy WHERE id='$policy_id'";
      $policyData = $db->select_single($sql); 
      if($policyData){
        $sql = 'INSERT INTO policy set policynumber="'.$new_policy_number.'"';
        foreach($policyData as $p_key => $p_value){
          if($p_key != 'id' && $p_key != 'policynumber'){
            $sql .= ','.$p_key.'="'.$p_value.'"';
          }
        }
        $new_policy_id = $db->insert($sql);
        if($new_policy_id){
          $filesLists = duplicateFilesPolicy($policy_id,$new_policy_id); 
          $noteLists = duplicateNotesPolicy($policy_id,$new_policy_id);
          $insuredLists = duplicateInsuredPolicy($policy_id,$new_policy_id);
        }
      }
    }
  return $new_policy_id;  
}


function deleteInsuredRateUps($insuredLists){
    global $db;
    $stats = false;
    if($insuredLists){
        $insuredIds = implode(",",$insuredLists);
        if($insuredIds){
          $sql= "DELETE FROM rateup WHERE idinsured IN($insuredIds)";
          $stats =  $db->delete($sql);
        }
    } 
    return $stats;
}

function deleteInsuredRiders($insuredLists){
    global $db;
    $stats = false;
    if($insuredLists){
        $insuredIds = implode(",",$insuredLists);
        if($insuredIds){
          $sql= "DELETE FROM rider WHERE insured_id IN($insuredIds)";
          $stats =  $db->delete($sql);
        }
    } 
    return $stats;
}

function deleteInsuredManualRates($insuredLists){
    global $db;
    $stats = false;
    if($insuredLists){
        $insuredIds = implode(",",$insuredLists);
        if($insuredIds){
          $sql= "DELETE FROM manual_rate WHERE insured_id IN($insuredIds)";
          $stats =  $db->delete($sql);
        }
    } 
    return $stats;
}

function deleteHealthInsuredLists($insuredLists){
    global $db;
    $stats = false;
    if($insuredLists){
        $insuredIds = implode(",",$insuredLists);
        if($insuredIds){
          $sql= "DELETE FROM insured WHERE id IN($insuredIds)";
          $stats =  $db->delete($sql);
        }
    } 
    return $stats;
}


function deleteHealthPolicyFiles($policy_id){
    global $db;
    $stats = false;
    if($policy_id){
        $sql= "DELETE FROM filespolicy WHERE idpolicy='$policy_id'";
        $stats =  $db->delete($sql);   
    } 
    return $stats;
}


function deleteHealthPolicyNotes($policy_id){
    global $db;
    $stats = false;
    if($policy_id){
        $sql= "DELETE FROM notespolicy WHERE idpolicy='$policy_id'";
        $stats =  $db->delete($sql);   
    } 
    return $stats;
}


function deleteHealthPolicy($policy_id){
   global $db;
    
   $stats = false; 
   $insuredIds = array();
   if($policy_id){
    $sql= "DELETE FROM policy WHERE id='$policy_id'";
    $stats = $db->delete($sql);
    if($stats){
    $stats_note_delete = deleteHealthPolicyNotes($policy_id);
    $stats_file_delete = deleteHealthPolicyFiles($policy_id);
    
    $insured_lists = getHealthInsuredLists($policy_id);
    if($insured_lists){
        foreach($insured_lists as $singleInsured){
           $insuredIds[]  =  $singleInsured['id'];
        }
        if($insuredIds){
           $stats_insured_delete = deleteHealthInsuredLists($insuredIds); 
           $stats_manualrate_delete = deleteInsuredManualRates($insuredIds);
           $stats_rateup_delete = deleteInsuredRateUps($insuredIds);
           $stats_rider_delete = deleteInsuredRiders($insuredIds);
        }
      }
    }
  }
  return $stats; 
}

?>