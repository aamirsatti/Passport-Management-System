<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Passport Details</h2>

                <div class="box-icon">
                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-backward"></i>
                    </a>
                </div>
            </div>
            <div class="box-content" style="overflow:auto;">
               <div class=" col-md-12">
               	   <h3> Basic Info </h3>
               </div>
               
                   <div class="col-md-6">
                    
                       <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                         <div class="form-group">
                            <label for="GivenName"> Given Name:  </label>
                            <?php echo $PassportDetail->given_name ?>
                        </div>
                        
                         
                        <div class="form-group">
                            <label for="SurName">Gender:  </label>
                            <?php echo $PassportDetail->gender == 1 ? 'Male' : ($PassportDetail->gender == 2 ? 'Female' : ''); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="passno"> Passport No:  </label>
                            <?php echo $PassportDetail->pass_number ?>
                        </div>
                        <div class="form-group">
                            <label for="passno"> Country:  </label>
                            <?php echo isset($PassportDetail->country) ? $PassportDetail->country : ''; ?>
                            
                        </div> 
                        <div class="form-group">
                            <label for="passno"> Mahrem:  </label>
                            <?php echo isset($PassportDetail->mahrem) ? $PassportDetail->mahrem : ''; ?>
                            
                        </div>  
                    </div>
                   <div class="col-md-6">
                        <div class="form-group">
                            <label for="SurName">Surname:  </label>
                            <?php echo $PassportDetail->sur_name ?>
                        </div>
                        <div class="form-group">
                            <label for="DOB">Date Of Birth:  </label>
                            <?php echo  date('d M, Y' , strtotime($PassportDetail->  dob)); ?>
                        </div>
                          
                         
                         <div class="form-group">
                            <label for="expierydate">Expiry Date:  </label>
                            <?php echo   date('d M, Y' , strtotime($PassportDetail->  expiray_date)); ?>
                        </div>
                        <div class="form-group">
                            <label for="passno"> NIC:  </label>
                            <?php echo isset($PassportDetail->nic) ? $PassportDetail->nic : ''; ?>
                            
                        </div>
                        <div class="form-group">
                            <label for="passno"> Relation:  </label>
                            <?php echo isset($PassportDetail->relation) ? stripslashes($PassportDetail->relation) : ''; ?>
                            
                        </div>  
                   </div>
                   <div  class="col-md-12">
                      <hr/>
                   </div> 
                   <div class=" col-md-12">
                       <h3> Status </h3>
                   </div>  
                   <div class="col-md-12">
                   		<div class="form-group">
                            <div class="col-md-6">
                              <b>Passport Sttus : </b>
                              <?php echo isset($PassportDetail->pass_status) ? $PassportDetail->pass_status: ''; 
							     if($PassportDetail->pass_status == 'Agency') echo '&nbsp; &nbsp;<b> Agency : </b>'.$PassportDetail->agency_name;
							  ?>
                            </div>
                            <div class="col-md-6"> <b> Visa Status : </b><?php echo isset($PassportDetail->visa_status) ? $PassportDetail->visa_status : ''; ?></div>
                            <div class="col-md-6" style="margin-top:10px;"> <b> Received Date : </b><?php echo isset($PassportDetail->date_time) ? date('d M,Y', strtotime($PassportDetail->date_time)) : ''; ?></div>
                        </div>  
                   </div>
                   <div  class="col-md-12">
                      <hr/>
                   </div>
                   <div class=" col-md-12">
                       <h3> Receiving Info </h3>
                   </div>
                   <div class="col-md-12" style="margin-top:10px;">
                   		<div class="form-group">
                            <div class="col-md-2">
                              <label for="recived by">Received By :  </label>
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
										  $received_from = (isset($PassportDetail->courier) ? ' <b> Courier Slip No : </b>'.$PassportDetail->courier.'' : '');
									  }
									  else if($PassportDetail->received_by == 3)
									  {
									  	  $received_by = 'Agent';
										  $received_from = (isset($PassportDetail->agent_name) ? '<b> Agent Name : </b>'.$PassportDetail->agent_name.'' : ''); 			
									  }
								  }
							?>
                            <div class="col-md-2"> <?php echo isset($received_by) ? $received_by : ''; ?></div>
                            <div class="col-md-4"><?php echo isset($received_from)  ? $received_from : ''; ?></div>
                            <div class="col-md-4"> <b> Received Date : </b><?php echo isset($PassportDetail->date_time) ? date('d M,Y', strtotime($PassportDetail->date_time)) : ''; ?></div>
                             
                        </div>  
                        
                        
                   </div>
                   <?php if($PassportDetail->status == 2){ ?>
				   
                       <div  class="col-md-12">
                          <hr/>
                       </div>
                       <div class=" col-md-12">
                           <h3> Delivery Info </h3>
                       </div>
                       <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-2">
                                  <label for="recived by">Delivered By :  </label>
                                </div>
                                <?php if(isset($PassportDetail->delivered_by))
                                      {
                                          if($PassportDetail->delivered_by == 1)
                                          {
                                              $delivered_by = 'By Hand';
                                              $delivered_from = '';
                                          }
                                          else if($PassportDetail->delivered_by == 2)
                                          {
                                              $delivered_by = 'Courier';  
                                              $delivered_from = (isset($PassportDetail->delivered_courier) ? '<div class="col-md-4"> <b> Courier Slip No : </b>'.$PassportDetail->delivered_courier.'</div>' : '');
                                          }
                                          else if($PassportDetail->delivered_by == 3)
                                          {
                                              $delivered_by = 'Agent';
                                              $delivered_from = (isset($PassportDetail->delivered_agent_name) ? '<div class="col-md-4"> <b> Agent Name : </b>'.$PassportDetail->delivered_agent_name.'</div>' : ''); 			
                                          }
                                      }
                                ?>
                                <div class="col-md-2"> <?php echo isset($delivered_by) ? $delivered_by : ''; ?></div>
                                <?php echo isset($delivered_from)  ? $delivered_from : ''; ?>
                                <div class="col-md-4"> <b> Delivered Date : </b><?php echo isset($PassportDetail->delivered_date) ? date('d M,Y', strtotime($PassportDetail->delivered_date)) : ''; ?></div>
                                 
                            </div>  
                            
                            
                       </div>
                   <?php } ?>    
                  
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
