<?php

namespace app\modules\super\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Super` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	public function actionAdd()
	{
		if($_REQUEST['config'])
		{
			//fopen('../config.params.php');
			$myfile = fopen("../config/params.php", "w") or die("Unable to open file!");
			$txt = "<?php return [
					   'pad' => '".$_REQUEST['config']."',
					];?>";
			fwrite($myfile, $txt);
			fclose($myfile);
			
		}
		return $this->render('index');
	}
}
