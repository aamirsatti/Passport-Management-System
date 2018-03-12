<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header" style="margin-bottom: 10%;">
            <img src="<?php echo Yii::$app->request->baseurl;?>/img/way_to_arfa.png" width="200px" />
            <h2>Passport Management System</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Please login with your Username and Password.
            </div>
            
           <?php if(Yii::$app->session['loginerror']){ ?>
                   <div class="alert alert-danger"><?php echo Yii::$app->session['loginerror'];?></div>
		   <?php Yii::$app->session['loginerror'] = ''; } ?>
                        
            <form class="form-horizontal" action="index.php?r=site/login" method="post">
             <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" placeholder="Username" name="name">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="Password"  name="password">
                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->
