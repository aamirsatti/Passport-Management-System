<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Reports</h2>

    </div>
    <div class="box-content" style="overflow:auto;">
        <div class=" col-md-12">
     
          <div id="alert_messages"></div>
    
          <div >
                        
               <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                 <div class="col-md-6">
                    <label for="Issuedate">Start Date</label>
                    <input type="text" readonly="readonly" class="form-control" id="start_date"  placeholder="Select Start Date" name="i_date" >
                    
                </div>
                 <div class="col-md-6">
                    <label for="Issuedate">End Date</label>
                    <input type="text" readonly="readonly" class="form-control" id="end_date"  placeholder="Select End Date" name="i_date" >
                </div>
                <br/>
                <div class="col-md-12"><br/></div> 
                <div class="col-md-6">
                    <label for="SurName">Passport Types</label>
                    <select name="p_types" id="p_types"  class="form-control">
                        <option value="0">Both (inbound / outbound)</option>
                        <option value="1">Inbound</option>
                        <option value="2">Outbound</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="SurName">Agents</label>
                    <select name="agent" id="agent"  class="form-control">
                        <option value=""> All </option>
                        <?php $data  = Yii::$app->session['Agents'];
						if(!empty($data))
						{
							foreach($data as $r)
							{
						?>		
                        		<option value="<?php echo isset($r) ? $r : ''; ?>"><?php echo isset($r) ? $r : ''; ?></option>
                        <?php }
						}
						?>
                    </select>
                </div>
                <div class="col-md-12"><br/></div>
                
                <div class="col-md-6 col-md-offset-4">
                   		<button type="button" onclick="get_reports()" class="btn btn-primary" style="width:50%;">Get Reports</button>
                </div>
                <div class="col-md-6 col-md-offset-4" id="report_download_btn">
                
                </div>
                
            </div>
        </div>
        <div id="report_data" style="display:none;">
          
        </div>                
    </div>
    </div>
    </div>
    <!--/span-->

    </div>
    
  <style >
  .ui-datepicker-trigger{display:none;}
  </style> 
 <script>
 jQuery.noConflict();
	(function( $ ) {
  		$(function() { 
 			//$( "#start_date" ).datepicker();
			$( "#start_date" ).datepicker({
						dateFormat: 'dd-mm-yy',
						changeMonth: true,
						changeYear: true,
						showOn: "both",
						//buttonImage: '<?php echo Yii::$app->request->baseurl;?>/theme/calendar/calimg.png',
						//buttonImageOnly: true
						 });
			$( "#end_date" ).datepicker({
						dateFormat: 'dd-mm-yy',
						changeMonth: true,
						changeYear: true,
						showOn: "both",
						//buttonImage: '<?php echo Yii::$app->request->baseurl;?>/theme/calendar/calimg.png',
						//buttonImageOnly: true
						 });			 
				  
  		});
})(jQuery);	
function get_reports()
{ 
	var s_date = $('#start_date').val(); 
	var e_date = $('#end_date').val();
	var pass_type = $('#p_types').val();
	var agent = $('#agent').val();
	if(s_date != '' && e_date != '' )   
	{
		
		$.ajax({
			url: '<?php echo Yii::$app->request->baseurl;?>/index.php?r=reports/report',
			type:'POST',
			data: 's_date='+s_date+'&e_date='+e_date+'&pass_type='+pass_type+'&agent='+agent,
			beforeSend: function(){
				$('#alert_messages').html('<div class="alert alert-info">Loading date, Please wait...</div>');
			},
			success:function(result){
				var data = $.parseJSON(result);
				if(data.status == 'yes')
				{
					//$('#report_data').html(data.result);
					$('#alert_messages').html('<div class="alert alert-success">Report is ready, please click on Print report button.</div>');
					$('#report_download_btn').html('<br/><a href="<?php echo Yii::$app->request->baseurl.'/theme/tcpdf/examples/form_pdf.php';?>" class="btn btn-primary" style="width:50%;" target="_blank"> Print Report </a>');
				}
				else
				{
					$('#alert_messages').html('<div class="alert alert-danger">Error! Something wrong please try again.</div>');
				}
			}
		});
		
		
	}
	else
	{
		$('#alert_messages').html('<div class="alert alert-danger">Please Start and End Date.</div>');
	}
}
function PrintReports(elem)
{   
	Popup($(elem).html());
}

function Popup(data)
{  //alert(data);
	var mywindow = window.open('', 'Report', 'height=600,width=600');
	mywindow.document.write('<html><head>');
	/*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
	mywindow.document.write('</head><body >');
	mywindow.document.write(data);
	mywindow.document.write('</body></html>');

	mywindow.document.close(); // necessary for IE >= 10
	mywindow.focus(); // necessary for IE >= 10

	mywindow.print();
	mywindow.close();

	return true;
}
</script>
	