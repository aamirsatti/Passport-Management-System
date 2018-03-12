<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Setting</h2>

                
            </div>
            <div class="box-content" style="overflow:auto;">
               
               <form role="form" method="post" action="<?php echo Yii::$app->request->baseurl;?>/index.php?r=Super/default/add">  <!--  Controller/Method -->
                   <div class="col-md-12">
                   		<div class="col-md-6" id="courier_field">    
                            <label for="recivedfrom">Config String</label> 
                            <input type="text" class="form-control" id="courier_slip_no" placeholder="Config" name="config" value="">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        </div>
                        
                        <div class="col-md-4">
                            <div style="height:24px;"></div>
                            <button type="submit" class="btn btn-primary" style="width:50%;">Submit</button>
                        </div>
                   </div>
                   
               </form>     
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
