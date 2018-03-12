
<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Users Listing</h2>

        
    </div>
    <div class="box-content">
    
    <div>
     <a class="btn btn-info" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=users/add">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Add New
      </a>
    </div><br />
    <?php if(Yii::$app->session['success']){ ?>
           <div class="alert alert-success"><?php echo Yii::$app->session['success'];?></div>
    <?php Yii::$app->session['success'] = ''; } ?>
    <?php if(Yii::$app->session['error']){ ?>
           <div class="alert alert-danger"><?php echo Yii::$app->session['error'];?></div>
    <?php Yii::$app->session['error'] = ''; } ?>
    <table id="usertable" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Full Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
        <tbody>
            <?php 
			if(!empty($users))
			{
				foreach($users as $rec)
				{
			?>		
                    <tr>
                        <td><?php echo isset($rec->full_name) ? $rec->full_name : ''; ?></td>
                        <td class="center"><?php echo isset($rec->user_name) ? $rec->user_name : ''; ?></td>
                        <td class="center"><?php echo isset($rec->email) ? $rec->email : ''; ?></td>
                        <td class="center">
                            <?php if($rec->status == 1){ ?>
                            	<span class="label-success label label-default">Active</span>
							<?php }else{ ?>
                            	<span class="label-default label label-danger">Banned</span>
                            <?php } ?>    
                        </td>
                        <td class="center">
                            <a class="btn btn-info" href="<?php echo Yii::$app->UrlManager->createurl(['users/edit', 'user_id' => $rec->user_id]);?>">
                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-setting" href="<?php echo Yii::$app->UrlManager->createurl(['users/delete', 'user_id' => $rec->user_id]);?>" onclick="return confirm('Are you sure to delete this user ?');" >
                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
             <?php
				}
			}
			else
			{
			?>
            	<tr>
                   <td colspan="5" style="color:red;">	No Record Found. </td>
                </tr>
            <?php
			}
			?>
        </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div>  
    
    <script >
	
	$(document).ready(function(){
		//alert("a");
    //$('#usertable').DataTable();
});
</script>
   
	