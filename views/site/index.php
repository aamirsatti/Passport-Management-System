
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="6 new members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-book blue"></i>

            <div>Today's Passport</div>
            <div><?php echo isset($today_Pass) ? count($today_Pass) : 0;?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="4 new pro members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-book green"></i>

            <div>Total Passports</div>
            <div><?php echo isset($alldata) ? count($alldata) : 0;?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
            <i class="glyphicon glyphicon-book green"></i>

            <div>Inbound Passports</div>
            <div><?php echo isset($inbound) ? ($inbound) : 0;?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
            <i class="glyphicon glyphicon-book green"></i>

            <div>OutBound Passports</div>
            <div><?php echo isset($outbound) ? ($outbound) : 0;?></div>
        </a>
    </div>
</div>

<div class="row">
   <div class="box col-md-12">
        <div class="box-inner homepage-box" style="overflow: auto;height:auto !important;">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th"></i> Dashboard</h2>
                <div class="row" style="padding-top: 5%;"> 
                     <div class="box col-md-6">
                        <div class="box-inner homepage-box">
                            <div class="box-header well">
                                <h2><i class="glyphicon glyphicon-th"></i>Today's Inbound Passports</h2>
                
                                <div class="box-icon">
                                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index" class="btn btn-setting btn-round btn-default"><i
                                            class="glyphicon glyphicon-list"></i></a>
                                    
                                </div>
                            </div>
                            <div class="box-content" style="font-weight: normal !important;">
                             <table id="usertable" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                <tr>
                                    <th>Sur Name</th>
                                    <th>Given Name</th>
                                    <th>Passport No</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
								if(!empty($today_Pass))
								{
								 foreach($today_Pass as $rec)
								 {     
								       if($rec->status == 1){
								 ?>
                                        <tr>
                                            <td><?php echo $rec->sur_name; ?></td>
                                            <td class="center"><?php echo $rec->given_name; ?></td>
                                            <td class="center"><?php echo $rec->pass_number; ?></td>
                                            <td class="center">
                                                <span ><?php echo $rec->expiray_date != '' ? date('d M, Y', strtotime($rec->expiray_date)) :'' ; ?></span>
                                            </td>
                                            
                                        </tr>
                                  <?php }
								   }
								}else{ ?> 
                                        <tr>
                                           <td colspan="4"> No record found.</td>
                                        </tr>
                                <?php } ?>                
                                
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                
                    <div class="box col-md-6">
                        <div class="box-inner homepage-box">
                            <div class="box-header well">
                                <h2><i class="glyphicon glyphicon-th"></i>Today's Outbound Passports</h2>
                
                                <div class="box-icon">
                                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index" class="btn btn-setting btn-round btn-default"><i
                                            class="glyphicon glyphicon-list"></i></a>
                                    
                                </div>
                            </div>
                            <div class="box-content" style="font-weight: normal !important;">
                             <table id="usertable" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                <tr>
                                    <th>Sur Name</th>
                                    <th>Given Name</th>
                                    <th>Passport No</th>
                                    <th>Expiry Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
								if(!empty($today_Pass))
								{
								 foreach($today_Pass as $rec)
								 {     
								       if($rec->status == 2){
								 ?>
                                        <tr>
                                            <td><?php echo $rec->sur_name; ?></td>
                                            <td class="center"><?php echo $rec->given_name; ?></td>
                                            <td class="center"><?php echo $rec->pass_number; ?></td>
                                            <td class="center">
                                                <span ><?php echo $rec->expiray_date != '' ? date('d M, Y', strtotime($rec->expiray_date)) :'' ; ?></span>
                                            </td>
                                            
                                        </tr>
                                  <?php }
								   }
								}else{ ?> 
                                        <tr>
                                           <td colspan="4"> No record found.</td>
                                        </tr>
                                <?php } ?>                 
                                
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>    
            </div>
        </div>
    </div>            
</div>
