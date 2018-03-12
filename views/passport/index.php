<style>
.page_info{display:none !important;}
</style>
<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Passport Listing</h2>

    </div>
    <div class="box-content" style="overflow:auto;">
     <?php if(Yii::$app->session['success']){ ?>
           <div class="alert alert-success"><?php echo Yii::$app->session['success'];?></div>
    <?php Yii::$app->session['success'] = ''; } ?>
    <?php if(Yii::$app->session['error']){ ?>
           <div class="alert alert-danger"><?php echo Yii::$app->session['error'];?></div>
    <?php Yii::$app->session['error'] = ''; } ?>
    <div id="alert_messages"></div>
    <div class="col-md-12 " style="margin-bottom: 2%;margin-top: 3%;">
        <div class="col-md-8">
        <a class="btn btn-info" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/add">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                In Bound
            </a>
             <a class="btn btn-info" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/outbound">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Out Bound
            </a>
       </div>     
       <div class="col-md-4 ">
            <form method="post" action="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/index" >
            	<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            	<input type="text" class="form-control" name="search_passport" placeholder="Search"/>
                <input type="submit" style="display:none;"/>
            </form>    
            
       </div>  

    </div><br />
    
    <!--  -->
    <table id="usertable" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Given Name</th>
        <th>Surname</th>
        <th>Passport Number</th>
        <th>Expire Date</th>
        <th>Visa Status</th>
        <th>Passport Status</th>
        <th>Options </th>
    </tr>
    </thead>
    <tbody>
    <?php 
	if(!empty($alldata))
	{ //echo '<pre>'; print_r($alldata); exit;
		foreach($alldata as $rec){ ?>
				<tr>
					<td><?php echo $rec->given_name; ?></td>
					<td class="center"><?php echo $rec->sur_name; ?></td>
					<td class="center"><?php echo $rec->pass_number; ?></td>
					
					<td class="center"><?php echo date('d M, Y' , strtotime($rec->  expiray_date)); ?></td>
					<td class="center">
						<select name="visa_status" class="form-control" style="height: 25px;padding: 3px 0px;" onchange="change_status($(this).val(),'<?php echo $rec->pass_id; ?>',1);">
                          <option value="Issue" <?php if($rec->visa_status == 'Issue') echo 'selected'; ?>>Issue</option>
                          <option value="Rejected" <?php if($rec->visa_status == 'Rejected') echo 'selected'; ?>>Rejected</option>
                          <option value="In Process" <?php if($rec->visa_status == 'In Process') echo 'selected'; ?>>In Process</option>                                        
                         </select>
                     </td>    
					 <td class="center">
						<select name="visa_status" class="form-control" style="height: 25px;padding: 3px 0px;"  onchange="change_status($(this).val(),'<?php echo $rec->pass_id; ?>',2);">
                          <option value="Office" <?php if($rec->pass_status == 'Office') echo 'selected'; ?>>Office</option>
                          <option value="Embassy" <?php if($rec->pass_status == 'Embassy') echo 'selected'; ?>>Embassy</option>
                          <option value="Agency" <?php if($rec->pass_status == 'Agency') echo 'selected'; ?>>Agency</option>
                          <option value="Returned" <?php if($rec->pass_status == 'Returned') echo 'selected'; ?>>Returned</option>                                        
                         </select>
                     </td> 
					<td class="center">
						<a class="" href="<?php echo Yii::$app->UrlManager->createurl(['passport/view', 'pass_id' => $rec->pass_id]);?>">
							<i class="glyphicon glyphicon-zoom-in icon-white"></i>
						</a>
						
						
						<?php //if(Yii::$app->session['user_role'] == 1) { ?>
						
						<a class="" href="<?php echo Yii::$app->UrlManager->createurl(['passport/edit', 'pass_id' => $rec->pass_id]);?>">
							<i class="glyphicon glyphicon-edit icon-white"></i>
						</a> <?php //} ?>
						
						 <?php if(Yii::$app->session['user_role'] == 1) { ?>
						
						<a class="" href="<?php echo Yii::$app->UrlManager->createurl(['passport/delete', 'pass_id' => $rec->pass_id]);?>" onclick="return confirm('Are you sure to delete this passport ?');">
							<i class="glyphicon glyphicon-trash icon-white"></i>
						</a>  <?php } ?>
                        
					</td>
				</tr>
      <?php }
	}
	else
	{ 
	?>      
     		<tr>
            	<td colspan="6"> No record Found </td>
            </tr>
     <?php } ?>           
    
    </tbody>
    </table>
    <style>
	.page_info{margin-left:10px;}
	</style>
     <div class="col-md-8 col-md-offset-2">
     <?php echo $pagination; ?> 
     </div>
    </div>
	   
    </div>
    </div>
    <!--/span-->

    </div>
    <a data-target="#visa_status" data-toggle="modal"  id="visa_status_btn"></a>
    <div class="modal fade" id="visa_status" tabindex="-1" role="dialog" aria-labelledby="report1Label">
        <div class="modal-dialog reports" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="visa_status_close_btn" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="report1Label">Change Visa Status</h4>
                </div>
                <div class="modal-body">
					<p> Are you sure you want to change Visa Status? </p>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="update_Status()">Yes</button>
                </div>
             </div>
        </div>
    </div>
    <a data-target="#passport_status" data-toggle="modal" onclick="agent_dropdown()" id="passport_status_btn"></a>
    <div class="modal fade" id="passport_status" tabindex="-1" role="dialog" aria-labelledby="report1Label">
        <div class="modal-dialog reports" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="passport_status_close_btn" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="report1Label">Change Passport Status</h4>
                </div>
                <div class="modal-body">
                    <div id="err-msg"></div>
					<p> Are you sure you want to change Passport Status? </p>  
                    <div id="agency_field" style="display:none;">
                        <b> Agency Name: </b>
                        <input class="form-control agent_name" name="agency_name" id="agent_name" type="text" />
                        <div id="alert_pop_messages"></div>
                    </div>   
                </div>
                <div class="modal-footer" id="second_footer" style="display:none;">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
                <div class="modal-footer" id="first_footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="update_pass_Status()">Yes</button>
                </div>
             </div>
        </div>
    </div>
    <style>
	.ui-autocomplete { position: absolute; cursor: default;z-index:99999 !important;}  
	</style>
	
  <!--  <script >
	
	$(document).ready(function(){
		alert("a");
    $('#usertable').DataTable();
});
</script>
	-->
<?php  $data  = Yii::$app->session['Agents']; $ag_values = '';//echo '<pre>'; print_r($data); exit; 
  if(!empty($data)) 
  {
	  foreach( $data as $term )
	  { 
		 $ag_values .=  '{ label: "'.$term.'", value: "'.$term.'" },';
	 
	  } } else $ag_values = '';
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


var pass_status = '';
var passport_id = '';

function change_status(status, pass_id, type)
{
	pass_status = status;
	passport_id = pass_id;
	if(type == 1) // Visa status
	{  
		document.getElementById('visa_status_btn').click();
	}
	else if(type == 2) // passport status
	{
		if(pass_status == 'Agency')
		{   
			$('#agency_field').show();
			$('#err-msg').hide().html('');
			$('#second_footer').hide();
			$('#first_footer').show();
		}
		else if(pass_status == 'Returned')
		{   
			$('#err-msg').show().html('<div class="alert alert-danger"> You can not select Returned status, please go to Outbound section to update Passport status.</div>');
			$('#second_footer').show();
			$('#first_footer').hide();
			$('#agency_field').hide();
		}
		else
		{
			$('#err-msg').hide().html('');
			$('#second_footer').hide();
			$('#first_footer').show();
			$('#agency_field').hide();
		}
		document.getElementById('passport_status_btn').click();
	}  
}
function update_Status()
{ 
	status = pass_status;
	pass_id = passport_id;
	if(status != '' && pass_id != '')
	{
		
		$.ajax({
			url: '<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/updatestatus',
			type:'POST',
			data: 'request=visa_status&status='+status+'&pass_id='+pass_id,
			beforeSend: function(){
				$('#alert_messages').html('<div class="alert alert-info">Please wait...</div>');
				document.getElementById('visa_status_close_btn').click();
			},
			success:function(result){
				var data = $.parseJSON(result);
				if(data.status == 'yes')
				{
					//$('#report_data').html(data.result);
					$('#alert_messages').html(data.msg);
					
				}
				else
				{
					$('#alert_messages').html(data.msg);
				}
			}
		});
		
		
	}
	else
	{
		$('#alert_messages').html('<div class="alert alert-danger">Please Try again.</div>');
	}
}
function update_pass_Status()
{ 
	status = pass_status;
	pass_id = passport_id;
	var agency = '';
	var is_error = 0;
	if(status == 'Agency')
	{
		agency = $('#agency_name').val();
		if(agency == '')
		{
			$('#alert_pop_messages').html('<div class="alert alert-danger">Please enter agency name.</div>');
			is_error = 1;	
		}
		
	}
	if(status != '' && pass_id != '' && is_error == 0)
	{
		
		$.ajax({
			url: '<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/updatestatus',
			type:'POST',
			data: 'request=passport_status&status='+status+'&pass_id='+pass_id+'&agency='+agency,
			beforeSend: function(){
				$('#alert_messages').html('<div class="alert alert-info">Please wait...</div>');
				document.getElementById('passport_status_close_btn').click();
				//$('#passport_status_close_btn').click();
			},
			success:function(result){
				var data = $.parseJSON(result);
				if(data.status == 'yes')
				{
					//$('#report_data').html(data.result);
					$('#alert_messages').html(data.msg);
					
				}
				else
				{
					$('#alert_messages').html(data.msg);
				}
			}
		});
		
		
	}
	else
	{
		$('#alert_messages').html('<div class="alert alert-danger">Please Try again.</div>');
	}

}
</script>  