<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Add New User</h2>

                <div class="box-icon">
                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=users/index" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-backward"></i>
                    </a>
                </div>
            </div>
            <div class="box-content" style="overflow: auto;">
               <div class=" col-md-8">
                <form role="form" method="post" action="index.php?r=users/add">
                    <div class="form-group">
                        <label for="FullName">Full Name</label>
                        <input type="text" class="form-control" name="Full_Name" id="Full_Name" placeholder="Enter Full Name Here" value="<?php echo isset($values['full_name']) ? $values['full_name'] : ''; ?>">
                        <?php if(isset($model['full_name'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['full_name'][0]; ?></p>
                        <?php } ?>     
                    </div>
                    
                     <div class="form-group">
                        <label for="UserName">Username </label> <span class="font-size:10px;">(username for login)</span>
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder=" Enter Username Here" value="<?php echo isset($values['user_name']) ? $values['user_name'] : ''; ?>">
                        <?php if(isset($model['user_name'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['user_name'][0]; ?></p>
                        <?php } ?>
                    </div>
                    
                     <div class="form-group">
                        <label for="UserRole">User type</label>
                        <select name="user_role" class="form-control">
                               <option value="2">Staff</option>
                               <option value="1">Admin</option>
                        </select>
                    </div>
                    
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" autocomplete="off" placeholder="Enter email Here" value="<?php echo isset($values['email']) ? $values['email'] : ''; ?>">
                        <?php if(isset($model['email'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['email'][0]; ?></p>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="user_password" id="exampleInputPassword1" autocomplete="off" placeholder="Enter Password Here">
                        <?php if(isset($model['user_password'][0])){ ?>
                             <p class="alert alert-danger"> <?php echo $model['user_password'][0]; ?></p>
                        <?php } ?>
                    </div>
                    
                     <div class="form-group">
                        <label for="exampleInputRetypePassword1">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="exampleInputRetypePassword1" placeholder="Retype Password">
                        <?php if(isset($confirm_error) && $confirm_error != ''){ ?>
                             <p class="alert alert-danger"> <?php echo $confirm_error; ?></p>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
               </div>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->