<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Passport Edit</h2>

                <div class="box-icon">
                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-backward"></i></a>
                </div>
            </div>
            <div class="box-content">
              <form role="form" method="post" action="<?php echo Yii::$app->UrlManager->createurl(['passport/edit', 'pass_id' => isset($PassportDetail->pass_id) ? $PassportDetail->pass_id : '']);?>">  <!--  Controller/Method -->
                   <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                 
                     <div class="form-group">
                        <label for="GivenName"> Given Name</label>
                        <input type="text" class="form-control" id="Full_Name" name="g_name" value="<?php echo $PassportDetail->given_name; ?>" placeholder=" Enter Full Name Here" name="f_name">
                        <?php if(isset($model['given_name'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['given_name'][0]; ?></p>
                        <?php } ?>
                    </div>
                    
                     <div class="form-group">
                        <label for="SurName">Sur Name</label>
                        <input type="text" class="form-control" id="User_Name" name="s_name" value="<?php echo $PassportDetail->sur_name; ?>" placeholder=" Enter User Name Here" >
                        <?php if(isset($model['sur_name'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['sur_name'][0]; ?></p>
                        <?php } ?>
                    </div>
                    
                     <div class="form-group">
                        <label for="DOB">Date Of Birth</label>
                        <input type="date" class="form-control" id="DOB" name="dob" value="<?php echo $PassportDetail->dob; ?>" placeholder="Enter User DOB Here" name="dob">
                        <?php if(isset($model['dob'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['dob'][0]; ?></p>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="SurName">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="" ></option>
                            <option value="1" <?php if(isset($PassportDetail->gender) && $PassportDetail->gender == 1) echo 'selected'; ?>>Male</option>
                            <option value="2" <?php if(isset($PassportDetail->gender) && $PassportDetail->gender == 2) echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="passno"> Passport No</label>
                        <input type="text" class="form-control" id="passno" name="p_no" value="<?php echo $PassportDetail->pass_number; ?>" placeholder="Enter Passport No Here" name="p_no">
                        <?php if(isset($model['pass_number'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['pass_number'][0]; ?></p>
                        <?php } ?>
                    </div>
                    
                     <div class="form-group">
                        <label for="expierydate">Expiry Date</label>
                        <input type="date" class="form-control" id="expirydate" name="edate" value="<?php echo $PassportDetail->expiray_date; ?>" placeholder="Enter Your Expiry Date Here "  >
                        <?php if(isset($model['expiray_date'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['expiray_date'][0]; ?></p>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                            <label for="passno"> Mahrem </label>
                            <input type="text" class="form-control" id="mahrem"  placeholder="Enter Mahrem Name" name="mahrem" value="<?php echo isset($PassportDetail->mahrem) ? $PassportDetail->mahrem : ''; ?>">
                            
                    </div> 
                    <div class="form-group">
                        <label for="SurName">Relation</label>
                        <select name="relation"   class="form-control">
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
                    
                    <div class="form-group">
                        <label for="delivered by">Received By</label> 
                        <select name="recived_by" onchange="received_by_fields((this).value);" class="form-control">
                          <option value="1" <?php if($PassportDetail->received_by == 1) echo 'selected'; ?>>By Hand</option>
                          <option value="2" <?php if($PassportDetail->received_by == 2) echo 'selected'; ?>>Courier</option>
                          <option value="3" <?php if($PassportDetail->received_by == 3) echo 'selected'; ?>>Agent</option>
                        </select>
                     </div>
                    <div class="form-group" style="display:none;" id="courier_field">    
                        <label for="recivedfrom">Courier Slip No</label> 
                        <input type="text" class="form-control" id="courier_slip_no" placeholder="Courier Slip No" name="courier_slip_no" value="<?php echo $PassportDetail->courier; ?>">
                        
                    </div>
                    <div class="form-group" style="display:none;" id="agent_field">    
                        <label for="recivedfrom">Agent Name</label> 
                        <input type="text" class="form-control" id="agent_name" placeholder="Agent Name" name="agent_name" value="<?php echo $PassportDetail->agent_name; ?>">
                        
                    </div>
                    <script>
					   $(document).ready(function(e) {
                           received_by_fields('<?php echo $PassportDetail->received_by; ?>'); 
                       });
					</script>
                    <div class="form-group">
                        <label for="Visa status">Visa Status</label><p> </p>
                        <select name="visa_status" class="form-control">
                          <option value="Issue" <?php if($PassportDetail->visa_status == 'Issue') echo 'selected'; ?>>Issue</option>
                          <option value="Rejected" <?php if($PassportDetail->visa_status == 'Rejected') echo 'selected'; ?>>Rejected</option>
                          <option value="In Process" <?php if($PassportDetail->visa_status == 'In Process') echo 'selected'; ?>>In Process</option>                                        
                         </select>
                 </div>
                 
                  <div class="form-group">
                        <label for="Passport status">Passport Status</label><p> </p>
                        <select name="passport_status" class="form-control">
                          <option value="Office" <?php if($PassportDetail->pass_status == 'Office') echo 'selected'; ?>>Office</option>
                          <option value="Returned" <?php if($PassportDetail->pass_status == 'Returned') echo 'selected'; ?>>Returned</option>                                        
                        </select>
                 </div>
                    
                    
                    <button type="submit" class="btn btn-default">Update</button>
                </form>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<script>
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