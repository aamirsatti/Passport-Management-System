<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Inbound Passport</h2>

                <div class="box-icon">
                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-backward"></i>
                    </a>
                </div>
            </div>
            <div class="box-content" style="overflow:auto;">
               <div class=" col-md-12">
               	<form role="form" method="post" action="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/swipe">
                    <div style="width: 80%;float: left;">
                        <div id="alert_messages"></div>
                        <div class="form-group">
                           <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                           <textarea class="form-control" id="swipe_passport" placeholder="Swipe Passport" name="swipe_passport" ></textarea>
                           <?php if(isset($swipe_error)){ ?>
                                 <p class="alert alert-danger"> <?php echo $swipe_error; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class=" col-md-2">
                        <button type="submit" class="btn btn-primary" onclick="return check_passport_swipe_date();">Fetch</button>
                    </div>
                 </form>   
               </div>
               <form role="form" method="post" action="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/add">  <!--  Controller/Method -->
                   <div class="col-md-6">
                    
                       <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                         <div class="form-group">
                            <label for="GivenName"> Given Name</label>
                            <input type="text" class="form-control" id="Full_Name" readonly="readonly" placeholder=" Enter Full Name Here" name="g_name" value="<?php echo isset($values['given_name']) ? $values['given_name'] : ''; ?>">
                            <?php if(isset($model['given_name'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['given_name'][0]; ?></p>
                            <?php } ?>
                        </div>
                        
                         
                        <div class="form-group">
                            <label for="SurName">Gender</label>
                            <select name="gender" readonly class="form-control">
                                <option value="" ></option>
                                <option value="1" <?php if(isset($values['gender']) && $values['gender'] == 'M') echo 'selected'; ?>>Male</option>
                                <option value="2" <?php if(isset($values['gender']) && $values['gender'] == 'F') echo 'selected'; ?>>Female</option>
                            </select>
                        </div> 
                        
                        <?php /*?><div class="form-group">
                            <label for="Issuedate">Issue Date</label>
                            <input type="text" class="form-control" id="issuedate" readonly placeholder="Enter Passport Issue date Here" name="i_date" value="<?php echo isset($values['issue_date']) ? $values['issue_date'] : ''; ?>">
                            <?php if(isset($model['issue_date'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['issue_date'][0]; ?></p>
                            <?php } ?>
                        </div><?php */?>
                        <div class="form-group">
                            <label for="passno"> Passport No</label>
                            <input type="text" class="form-control" id="passno" readonly placeholder="Enter Passport No Here" name="p_no" value="<?php echo isset($values['pass_number']) ? $values['pass_number'] : ''; ?>">
                            <?php if(isset($model['pass_number'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['pass_number'][0]; ?></p>
                            <?php } ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="passno"> Country </label>
                            <input type="text" class="form-control" id="country" readonly placeholder="Enter Passport No Here" name="country" value="<?php echo isset($values['country']) ? $values['country'] : ''; ?>">
                            
                        </div> 
                        
                        <div class="form-group">
                            <label for="passno"> Mahrem </label>
                            <input type="text" class="form-control" id="mahrem"  placeholder="Enter Mahrem Name" name="mahrem" value="<?php echo isset($values['mahrem']) ? $values['mahrem'] : ''; ?>">
                            
                        </div> 
                       
                    </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="SurName">Surname</label>
                            <input type="text" class="form-control" readonly id="s_name" placeholder=" Enter User Name Here" name="s_name" value="<?php echo isset($values['sur_name']) ? $values['sur_name'] : ''; ?>">
                            <?php if(isset($model['sur_name'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['sur_name'][0]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="DOB">Date Of Birth</label>
                            <input type="text" class="form-control" readonly id="DOB" placeholder="Enter User DOB Here" name="dob" value="<?php echo isset($values['dob']) ? $values['dob'] : ''; ?>">
                            <?php if(isset($model['dob'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['dob'][0]; ?></p>
                            <?php } ?>
                        </div>
                          
                         
                         <div class="form-group">
                            <label for="expierydate">Expiry Date</label>
                            <input type="text" class="form-control" id="expirydate" readonly placeholder="Enter Expiry Date Here " name="edate" value="<?php echo isset($values['expiray_date']) ? $values['expiray_date'] : ''; ?>">
                            <?php if(isset($model['expiray_date'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['expiray_date'][0]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="passno"> NIC </label>
                            <input type="text" class="form-control" id="nic" readonly placeholder="Enter NIC No Here" name="nic" value="<?php echo isset($values['nic']) ? $values['nic'] : ''; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="SurName">Relation</label>
                            <select name="relation"   class="form-control">
                                <option value="Father" <?php if(isset($values['relation']) && $values['relation'] == 'Father') echo 'selected'; ?>>Father</option>
                                <option value="Mother" <?php if(isset($values['relation']) && $values['relation'] == 'Mother') echo 'selected'; ?>>Mother</option>
                                <option value="Brother" <?php if(isset($values['relation']) && $values['relation'] == 'Brother') echo 'selected'; ?>>Brother</option>
                                <option value="Sister" <?php if(isset($values['relation']) && $values['relation'] == 'Sister') echo 'selected'; ?>>Sister</option>
                                <option value="Husband" <?php if(isset($values['relation']) && $values['relation'] == 'Husband') echo 'selected'; ?>>Husband</option>
                                <option value="Wife" <?php if(isset($values['relation']) && $values['relation'] == 'Wife') echo 'selected'; ?>>Wife</option>
                                <option value="Grand Father" <?php if(isset($values['relation']) && $values['relation'] == 'Grand Father') echo 'selected'; ?>>Grand Father</option>
                                <option value="Grand Mother" <?php if(isset($values['relation']) && $values['relation'] == 'Grand Mother') echo 'selected'; ?>>Grand Mother</option>
                                <option value="Nephew (brother)" <?php if(isset($values['relation']) && $values['relation'] == 'Nephew (brother)') echo 'selected'; ?>>Nephew (brother)</option>
                                <option value="Nephew (sister)" <?php if(isset($values['relation']) && $values['relation'] == 'Nephew (sister)') echo 'selected'; ?>>Nephew (sister)</option>
                                <option value="Wife\'s Brother" <?php if(isset($values['relation']) && $values['relation'] == 'Wife\'s Brother') echo 'selected'; ?>>Wife's Brother</option>
                                <option value="Husband\'s Brother" <?php if(isset($values['relation']) && $values['relation'] == 'Husband\'s Brother') echo 'selected'; ?>>Husband's Brother</option>
                                <option value="Women Group" <?php if(isset($values['relation']) && $values['relation'] == 'Women Group') echo 'selected'; ?>>Women Group</option>
                                <option value="Grand Child" <?php if(isset($values['relation']) && $values['relation'] == 'Grand Child') echo 'selected'; ?>>Grand Child</option>
                                <option value="Father/Mother in law" <?php if(isset($values['relation']) && $values['relation'] == 'Father/Mother in law') echo 'selected'; ?>>Father/Mother in law</option>
                                <option value="Mother\'s Brother" <?php if(isset($values['relation']) && $values['relation'] == 'Mother\'s Brother') echo 'selected'; ?>>Mother's Brother</option>
                                <option value="Mother\'s Sister (Aunt)" <?php if(isset($values['relation']) && $values['relation'] == 'Mother\'s Sister (Aunt)') echo 'selected'; ?>>Mother's Sister (Aunt)</option>
                                <option value="Father\'s Brother" <?php if(isset($values['relation']) && $values['relation'] == 'Father\'s Brother') echo 'selected'; ?>>Father's Brother</option>
                                <option value="Father\'s Sister" <?php if(isset($values['relation']) && $values['relation'] == 'Father\'s Sister') echo 'selected'; ?>>Father's Sister</option>
                                <option value="Daughter in law" <?php if(isset($values['relation']) && $values['relation'] == 'Daughter in law') echo 'selected'; ?>>Daughter in law</option>
                                <option value="Son in law" <?php if(isset($values['relation']) && $values['relation'] == 'Son in law') echo 'selected'; ?>>Son in law</option>
                                <option value="Father\'s wife" <?php if(isset($values['relation']) && $values['relation'] == 'Father\'s wife') echo 'selected'; ?>>Father's wife</option>
                                <option value="Mother\'s Husband" <?php if(isset($values['relation']) && $values['relation'] == 'Mother\'s Husband') echo 'selected'; ?>>Mother's Husband</option>
                                <option value="Other" <?php if(isset($values['relation']) && $values['relation'] == 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                   </div>
                   <div  class="col-md-12">
                      <hr/>
                   </div>   
                   <div class="col-md-12">
                   		<div class="col-md-3">
                            <label for="recived by">Recived By</label>
                            <select name="recived_by" onchange="received_by_fields((this).value);" class="form-control">
                                <option value="1">By Hand</option>
                                <option value="2">Courier</option>
                                <option value="3">Agent</option>
                            </select>  
                        </div>  
                        <div class="col-md-3" style="display:none;" id="courier_field">    
                            <label for="recivedfrom">Courier Slip No</label> 
                            <input type="text" class="form-control" id="courier_slip_no" placeholder="Courier Slip No" name="courier_slip_no" value="">
                            
                        </div>
                        <div class="col-md-3" style="display:none;" id="agent_field">    
                            <label for="recivedfrom">Agent Name</label> 
                            <input type="text" class="form-control" id="agent_name" placeholder="Agent Name" name="agent_name" value="">
                            
                        </div>
                        <div class="col-md-3">
                            <div style="height:24px;"></div>
                            <button type="submit" class="btn btn-primary" style="width:50%;">Submit</button>
                        </div>
                   </div>
                   
               </form>     
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<?php  $data  = Yii::$app->session['Agents']; $ag_values = '';//echo '<pre>'; print_r($data); exit; 
  if(!empty($data)){foreach( $data as $term )
	  { 
		 $ag_values .=  '{ label: "'.$term.'", value: "'.$term.'" },';
	 
	  }}else{$ag_values = '';}
?>
<script>
var availableTags = [
	  <?php
	  echo $ag_values;
	  ?>
	 ];	
	 

//jQuery.noConflict();
jQuery.noConflict();
(function( $ ) {
  $(function() {
    $( "#agent_name" ).autocomplete({
			 minLength: 1,
			 source: availableTags,
			 focus: function( event, ui ) {
				$( "#agent_name" ).val( ui.item.label );
				return false;
			 },
			 select: function( event, ui ) {
			   if(ui.item.value != "Add New" )
			   {
				   $( "#agent_name" ).val( ui.item.label );
				   //$( "#specalty_id_"+i ).val( ui.item.value );
				}
			   else
			   {   
				  
			   }   
			  // search_on_specalty();
			   //$( "#specalty_id" ).val( '' );
			   return false;
			 },
			 response: function( event, ui ) {
					console.log(event,ui,this);
					//ui.content.push({value:"Add New", label:"Add New"});
			 }
			}); 
  });
})(jQuery);
$(document).ready(function(e) { //alert(availableTags);
   // var jq = $.noConflict();
	//j//q(document).ready(function(){
		jQuery( "#agent_name" ).autocomplete({
			 minLength: 1,
			 source: availableTags,
			 focus: function( event, ui ) {
				jQuery( "#agent_name" ).val( ui.item.label );
				return false;
			 },
			 select: function( event, ui ) {
			   if(ui.item.value != "Add New" )
			   {
				   jQuery( "#agent_name" ).val( ui.item.label );
				   //$( "#specalty_id_"+i ).val( ui.item.value );
				}
			   else
			   {   
				  
			   }   
			  // search_on_specalty();
			   //$( "#specalty_id" ).val( '' );
			   return false;
			 },
			 response: function( event, ui ) {
					console.log(event,ui,this);
					//ui.content.push({value:"Add New", label:"Add New"});
			 }
			}); 
	//});
	
});
function check_passport_swipe_date()
{ 
	var swipe_passport = $('#swipe_passport').val(); 
	if(swipe_passport == '')
	{
		$('#alert_messages').html('<div class="alert alert-danger">Please swipe passport.</div>');
		return false;
	}
	else
	{
		return true;
	}
}
function received_by_fields(val)
{
	if(val == 2)
	{
		$('#courier_field').show();
		$('#agent_field').hide();
	}
	else if(val == 3)
	{
		$('#courier_field').hide();
		$('#agent_field').show();
	}
	else
	{
		$('#courier_field').hide();
		$('#agent_field').hide();
	}
}
</script>