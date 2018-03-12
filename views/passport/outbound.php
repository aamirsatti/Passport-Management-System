<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Outbound Passport</h2>

                <div class="box-icon">
                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-backward"></i>
                    </a>
                </div>
            </div>
            <div class="box-content" style="overflow:auto;">
               <div class=" col-md-12">
               	<form role="form" method="post" action="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/outbound">
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
               <form role="form" method="post" action="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/outbound">  <!--  Controller/Method -->
                   <div class="col-md-6">
                    
                       <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                         <div class="form-group">
                            <label for="GivenName"> Given Name</label>
                            <input type="text" class="form-control" id="Full_Name" readonly="readonly" placeholder=" Enter Full Name Here" name="g_name" value="<?php echo isset($PassportDetail->given_name) ? $PassportDetail->given_name : ''; ?>">
                            <?php if(isset($model['given_name'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['given_name'][0]; ?></p>
                            <?php } ?>
                        </div>
                        
                         
                        <div class="form-group">
                            <label for="SurName">Gender</label>
                            <select name="gender" readonly class="form-control">
                                <option value="" ></option>
                                <option value="1" <?php if(isset($PassportDetail->gender) && $PassportDetail->gender == 1) echo 'selected'; ?>>Male</option>
                                <option value="2" <?php if(isset($PassportDetail->gender) && $PassportDetail->gender == 2) echo 'selected'; ?>>Female</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="passno"> Passport No</label>
                            <input type="text" class="form-control" id="passno" readonly placeholder="Enter Passport No Here" name="p_no" value="<?php echo isset($PassportDetail->pass_number) ? $PassportDetail->pass_number : ''; ?>">
                            <?php if(isset($model['pass_number'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['pass_number'][0]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="passno"> Country </label>
                            <input type="text" class="form-control" id="country" readonly placeholder="Enter Passport No Here" name="country" value="<?php echo isset($PassportDetail->country) ? $PassportDetail->country : ''; ?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="passno"> Mahrem </label>
                            <input type="text" class="form-control" readonly id="mahrem"  placeholder="Enter Mahrem Name" name="mahrem" value="<?php echo isset($PassportDetail->mahrem) ? $PassportDetail->mahrem : ''; ?>">
                            
                    	</div>   
                    </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="SurName">Surname</label>
                            <input type="text" class="form-control" readonly id="s_name" placeholder=" Enter User Name Here" name="s_name" value="<?php echo isset($PassportDetail->sur_name) ? $PassportDetail->sur_name : ''; ?>">
                            <?php if(isset($model['sur_name'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['sur_name'][0]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="DOB">Date Of Birth</label>
                            <input type="text" class="form-control" readonly id="DOB" placeholder="Enter User DOB Here" name="dob" value="<?php echo isset($PassportDetail->dob) ? date('d M, Y', strtotime($PassportDetail->dob)) : ''; ?>">
                            <?php if(isset($model['dob'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['dob'][0]; ?></p>
                            <?php } ?>
                        </div>
                          
                         
                         <div class="form-group">
                            <label for="expierydate">Expiry Date</label>
                            <input type="text" class="form-control" id="expirydate" readonly placeholder="Enter Your Expiry Date Here " name="edate" value="<?php echo isset($PassportDetail->expiray_date) ? date('d M, Y', strtotime($PassportDetail->expiray_date)) : ''; ?>">
                            <?php if(isset($model['expiray_date'][0])){ ?>
                                 <p class="alert alert-danger"> <?php echo $model['expiray_date'][0]; ?></p>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="passno"> NIC </label>
                            <input type="text" class="form-control" id="nic" readonly placeholder="Enter NIC No Here" name="nic" value="<?php echo isset($PassportDetail->nic) ? $PassportDetail->nic : ''; ?>">
                            
                        </div>
                      <div class="form-group">
                        <label for="SurName">Relation</label>
                        <select name="relation"  readonly disabled="disabled"  class="form-control">
                            <option value="Father" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Father') echo 'selected'; ?>>Father</option>
                            <option value="Mother" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Mother') echo 'selected'; ?>>Mother</option>
                            <option value="Brother" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Brother') echo 'selected'; ?>>Brother</option>
                            <option value="Sister" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Sister') echo 'selected'; ?>>Sister</option>
                            <option value="Husband" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Husband') echo 'selected'; ?>>Husband</option>
                            <option value="Wife" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Wife') echo 'selected'; ?>>Wife</option>
                            <option value="Grand Father" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Grand Father') echo 'selected'; ?>>Grand Father</option>
                            <option value="Grand Mother" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Grand Mother') echo 'selected'; ?>>Grand Mother</option>
                            <option value="Nephew (brother)" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Nephew (brother)') echo 'selected'; ?>>Nephew (brother)</option>
                            <option value="Nephew (sister)" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Nephew (sister)') echo 'selected'; ?>>Nephew (sister)</option>
                            <option value="Wife\'s Brother" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Wife\'s Brother')) echo 'selected'; ?>>Wife's Brother</option>
                            <option value="Husband\'s Brother" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Husband\'s Brother')) echo 'selected'; ?>>Husband's Brother</option>
                            <option value="Women Group" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Women Group') echo 'selected'; ?>>Women Group</option>
                            <option value="Grand Child" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Grand Child') echo 'selected'; ?>>Grand Child</option>
                            <option value="Father/Mother in law" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Father/Mother in law') echo 'selected'; ?>>Father/Mother in law</option>
                            <option value="Mother\'s Brother" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Mother\'s Brother')) echo 'selected'; ?>>Mother's Brother</option>
                            <option value="Mother\'s Sister (Aunt)" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Mother\'s Sister (Aunt)')) echo 'selected'; ?>>Mother's Sister (Aunt)</option>
                            <option value="Father\'s Brother" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Father\'s Brother')) echo 'selected'; ?>>Father's Brother</option>
                            <option value="Father\'s Sister" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Father\'s Sister')) echo 'selected'; ?>>Father's Sister</option>
                            <option value="Daughter in law" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Daughter in law') echo 'selected'; ?>>Daughter in law</option>
                            <option value="Son in law" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Son in law') echo 'selected'; ?>>Son in law</option>
                            <option value="Father\'s wife" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Father\'s wife')) echo 'selected'; ?>>Father's wife</option>
                            <option value="Mother\'s Husband" <?php if(isset($PassportDetail->relation) && stripslashes($PassportDetail->relation) == stripslashes('Mother\'s Husband')) echo 'selected'; ?>>Mother's Husband</option>
                            <option value="Other" <?php if(isset($PassportDetail->relation) && $PassportDetail->relation == 'Other') echo 'selected'; ?>>Other</option>
                        </select>
                    </div> 
                   </div>
                   <div  class="col-md-12">
                      <hr/>
                   </div>   
                   <div class="col-md-12">
                   		<div class="form-group">
                            <div class="col-md-2">
                              <label for="recived by">Recived By :  </label>
                            </div>
                            <?php if(isset($PassportDetail->received_by))
								  {
									  if($PassportDetail->received_by == 1)
									  {
										  $received_by = 'By Hand';
										  $received_from = '';
									  }
									  else if($PassportDetail->received_by == 2)
									  {
									  	  $received_by = 'Courier';  
										  $received_from = (isset($PassportDetail->courier) ? '<div class="col-md-4"> <b> Courier Slip No : </b>'.$PassportDetail->courier.'</div>' : '');
									  }
									  else if($PassportDetail->received_by == 3)
									  {
									  	  $received_by = 'Agent';
										  $received_from = (isset($PassportDetail->agent_name) ? '<div class="col-md-4"> <b> Agent Name : </b>'.$PassportDetail->agent_name.'</div>' : ''); 			
									  }
								  }
							?>
                            <div class="col-md-2"> <?php echo isset($received_by) ? $received_by : ''; ?></div>
                            <?php echo isset($received_from)  ? $received_from : ''; ?>
                            <div class="col-md-4"> <b> Received Date : </b><?php echo isset($PassportDetail->date_time) ? date('d M,Y', strtotime($PassportDetail->date_time)) : ''; ?></div>
                             
                        </div>  
                        
                        
                   </div>
                   <div  class="col-md-12">
                      <hr/>
                   </div>
                   <div class="col-md-12">  
                       <div class="col-md-3">
                            <label for="recived by">Delivered By</label>
                            <select name="deliver_by" onchange="received_by_fields((this).value);" class="form-control">
                                <option value="1">By Hand</option>
                                <option value="2">Courier</option>
                                <option value="3">Agent</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="display:none;" id="courier_field">    
                            <label for="recivedfrom">Courier Slip No</label> 
                            <input type="text" class="form-control" id="courier_slip_no" placeholder="Courier Slip No" name="deliver_courier_slip_no" value="">
                            
                        </div>
                        <div class="col-md-3" style="display:none;" id="agent_field">    
                            <label for="recivedfrom">Agent Name</label> 
                            <input type="text" class="form-control" id="agent_name" placeholder="Agent Name" name="deliver_agent_name" value="">
                            
                        </div>
                       <div class="col-md-3"> 
                           <div style="height:24px;"></div>
                            <input type="hidden" name="outbound_passport" value="1" />
                            <input type="hidden" name="pass_id" value="<?php echo (isset($PassportDetail->pass_id) ? $PassportDetail->pass_id : ''); ?>" />
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
	 
	  }}else {$ag_values = '';}
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
