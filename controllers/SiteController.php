<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\PassportDetails;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [''],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {  
	    /*if($this->get_adr() == Yii::$app->params['pad'] && Yii::$app->params['pad'] != '')
		{
			echo 'same';
			//fopen('../config.params.php');
			$myfile = fopen("../config/params.php", "w") or die("Unable to open file!");
			$txt = "<?php return [
					   'pad' => 'E4-11-5B-39-A1-DB',
					];?>";
			fwrite($myfile, $txt);
			fclose($myfile);
		}
		else
		{
			return $this->redirect(['site/notallowed']);	
		}*/
		if(Yii::$app->session['logged_in'] == true)
		{
		    // Get all agent data
			$agent = PassportDetails::find()->all();
			$agent_name = array();
			if(!empty($agent))
			{
				foreach($agent as $rec)
				{
					if($rec->agency_name != '' && !in_array($rec->agency_name,$agent_name))
						$agent_name[] = $rec->agency_name;
					if($rec->agent_name != '' && !in_array($rec->agent_name,$agent_name))
						$agent_name[] = $rec->agent_name;
					if($rec->delivered_agent_name != '' && !in_array($rec->delivered_agent_name,$agent_name))
						$agent_name[] = $rec->delivered_agent_name;		
				}
				Yii::$app->session['Agents'] = $agent_name;
				
			}
			$today_Pass = PassportDetails :: find()->where('DATE(date_time) = :sDate',['sDate' => date('Y-m-d')])->all();
			$passports =PassportDetails :: find()->all();
			$inbound = 0;$outbound = 0;
			foreach($passports as $rec)
			{
				if($rec->status == 1)
					$inbound++;
				if($rec->status == 2)
					$outbound++;
			}
			$users = Users::find()->all();
			return $this->render('index', ['alldata' => $passports, 'users' => $users, 'today_Pass' =>$today_Pass, 'outbound' => $outbound, 'inbound'=>$inbound]);
		}
		else
			return $this->actionLogin();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if(Yii::$app->session['logged_in']==true)
            return $this->goHome();
        
		if(Yii::$app->request->post())
		{ 
            if(Yii::$app->request->post('name') != '' && Yii::$app->request->post('password') != '')
			{
				$users = Users::findOne(['user_name' => Yii::$app->request->post('name'),
						'user_password' => Yii::$app->request->post('password')]);
				//$loggedin_status = false;
				if(count($users)>0)
				{
					Yii::$app->session['user_name'] = $users->user_name;
					Yii::$app->session['user_id'] = $users->user_id;
					Yii::$app->session['user_role'] = $users->user_role;        
					Yii::$app->session['logged_in'] = true;    
					return $this->actionIndex();    
				}
				else
				{
					Yii::$app->session['loginerror'] = "Invalid username or password.";
					return $this->render('login');
				}
			}
			else
			{
				Yii::$app->session['loginerror'] = "Please enter username and password.";
				return $this->render('login');
			}
        }
		else 
        	return $this->render('login');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    { 
	   Yii::$app->session['logged_in'] = false;
	   $session = Yii::$app->session;
	   $session->destroy();
	   //echo Yii::$app->session['logged_in']; exit;
	   return $this->goHome();
    }
    //
	public function actionNotallowed()
	{
		Yii::$app->session['logged_in'] = false;
	   $session = Yii::$app->session;
	   $session->destroy();
		return $this->render('Not_allow');
	}
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	//
	private function get_adr()
	{
		$mac_address_array = explode("\\" , exec('getmac'));
		$mac_addres = $mac_address_array[0];
		//echo $mac_addres;
		// Turn on output buffering
		ob_start();
		//Get the ipconfig details using system commond
		system('ipconfig /all');
		 
		// Capture the output into a variable
		$mycom=ob_get_contents();
		// Clean (erase) the output buffer
		ob_clean();
		 
		$findme = "Physical";
		//Search the "Physical" | Find the position of Physical text
		$pmac = strpos($mycom, $findme);
		 
		// Get Physical Address
		$mac=substr($mycom,($pmac+36),17);
		//Display Mac Address
		//echo '<br/>';
		return $mac;
	}
}
