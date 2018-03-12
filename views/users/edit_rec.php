<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Edit User</h2>

                <div class="box-icon">
                    <a href="<?php echo Yii::$app->request->baseurl;?>/index.php?r=users/index" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-backward"></i></a>
                </div>
            </div>
            <div class="box-content" style="overflow: auto;">
               <div class=" col-md-8">
                <form role="form" method="post" action="<?php echo Yii::$app->UrlManager->createurl(['users/edit', 'user_id' => isset($values['user_id']) ? $values['user_id'] : '']);?>">
                    <div class="form-group">
                        <label for="FullName">Full Name</label>
                        <input type="text" class="form-control" name="Full_Name" id="Full_Name" placeholder="Enter Full Name Here" value="<?php echo isset($values['full_name']) ? $values['full_name'] : ''; ?>">
                            
                    </div>
                    
                     <div class="form-group">
                        <label for="UserName">Username </label></span>
                        <input type="text" class="form-control" readonly placeholder=" Enter Username Here" value="<?php echo isset($values['user_name']) ? $values['user_name'] : ''; ?>">
                        
                    </div>
                    
                     <div class="form-group">
                        <label for="UserRole">User type</label>
                        <select name="user_role" readonly class="form-control">
                               <option value="2">Staff</option>
                        </select>
                    </div>
                    
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" readonly autocomplete="off" placeholder="Enter email Here" value="<?php echo isset($values['email']) ? $values['email'] : ''; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Current Password</label>
                        <input type="text" class="form-control"  readonly autocomplete="off" value="<?php echo isset($values['user_password']) ? $values['user_password'] : ''; ?>">
                        
                    </div>
                    
                     <div class="form-group">
                        <label for="exampleInputPassword1">Change Password</label>
                        <input type="password" class="form-control"  name="new_password" autocomplete="off" placeholder="Enter Password Here">
                        
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