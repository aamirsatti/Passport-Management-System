<div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Passport Listing</h2>

    </div>
    <div class="box-content">
    <div>
     <a class="btn btn-info" href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=passport/add">
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
        <th>Sur Name</th>
        <th>Given Name</th>
        <th>Passport No</th>
        <th>Date</th>
        <th>Record Options</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($alldata as $rec){ ?>
            <tr>
                <td><?php echo $rec->sur_name; ?></td>
                <td class="center"><?php echo $rec->given_name; ?></td>
                <td class="center"><?php echo $rec->pass_number; ?></td>
                <td class="center">
                    <span ><?php echo $rec->date_time != '' ? date('d M, Y', strtotime($rec->date_time)) :'' ; ?></span>
                </td>
                <td class="center">
                    <a class="btn btn-success" href="#">
                        <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                        View
                    </a>
                    <a class="btn btn-info" href="<?php echo Yii::$app->UrlManager->createurl(['passport/edit', 'pass_id' => $rec->pass_id]);?>">
                        <i class="glyphicon glyphicon-edit icon-white"></i>
                        Edit
                    </a>
                    <a class="btn btn-danger" href="<?php echo Yii::$app->UrlManager->createurl(['passport/delete', 'pass_id' => $rec->pass_id]);?>" onclick="return confirm('Are you sure to delete this passport ?');">
                        <i class="glyphicon glyphicon-trash icon-white"></i>
                        Delete
                    </a>
                </td>
            </tr>
      <?php } ?>      
    
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div>
    
   
  <!--  <script >
	
	$(document).ready(function(){
		alert("a");
    $('#usertable').DataTable();
});
</script>
	-->