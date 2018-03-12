<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\PassportDetails;
use yii\data\Pagination ;
use app\components\LinkPager;
use yii\data\ActiveDataProvider;
class PassportController extends \yii\web\Controller
{
    public function actionIndex()
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
		if(Yii::$app->request->post('search_passport'))
		{
			$alldata = PassportDetails::find()->where(['like', 'pass_number', Yii::$app->request->post('search_passport')])->all();
			$pagination = '';
			
		}
		else
		{
			$per_page = 10;
			$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 1); //echo $page; exit;
			$startpoint = ($page * $per_page) - $per_page;
			$alldata = PassportDetails::find()->limit($per_page)->offset($startpoint)->all();	
			$url = Yii::$app->request->baseurl.'/index.php?r=passport/index&';
			$pagination = $this->pagination($per_page,$page,$url);
			
		}
	    return $this->render('index', ['alldata' => $alldata, 'pagination' => $pagination]);
    }
	public function actionAdd()
    { 
		
		if(Yii::$app->request->post() )
		{  
			$model = new PassportDetails();
			$model->scenario = 'add';
			$model->attributes = array(
								'sur_name' => Yii::$app->request->post('s_name'),
								'given_name' => Yii::$app->request->post('g_name'),
								'dob' => Yii::$app->request->post('dob'),
								'pass_number' => Yii::$app->request->post('p_no'),
								'issue_date' => Yii::$app->request->post('i_date'),
								'expiray_date' => Yii::$app->request->post('edate'),
								'received_by' => Yii::$app->request->post('recived_by'),
								'gender' => Yii::$app->request->post('gender')
								 );
			$model->load(Yii::$app->request->post());
			if ($model->validate())    // all inputs are valid
			{    
			          
				$passport = Yii::$app->db->createCommand()->insert('passport_details', [
						'sur_name' => Yii::$app->request->post('s_name'),
						'given_name' => Yii::$app->request->post('g_name'),
						'dob' => date('Y-m-d', strtotime(Yii::$app->request->post('dob'))),
						'pass_number' => Yii::$app->request->post('p_no'),
						'issue_date' => Yii::$app->request->post('i_date'),
						'gender' => Yii::$app->request->post('gender'),
						'expiray_date' => date('Y-m-d', strtotime(Yii::$app->request->post('edate'))),
						'country' => Yii::$app->request->post('country'),
						'nic' => Yii::$app->request->post('nic'),
						'received_by' => Yii::$app->request->post('recived_by'),
						'courier' => Yii::$app->request->post('courier_slip_no'),
						'agent_name' => Yii::$app->request->post('agent_name'),
						'user_id' => Yii::$app->session['user_id'],
						'mahrem' => Yii::$app->request->post('mahrem'),
						'relation' => Yii::$app->request->post('relation'),
					])->execute(); 
				Yii::$app->session['success'] = "New Recard Has Been Added Sucessfully";
				return $this->redirect(['passport/index']);
			}
			else 
			{
				// validation failed: $errors is an array containing error messages
				$errors = $model->errors;
				//echo '<pre>'; print_r($errors); exit;
				return $this->render('add_rec', ['model' => $model->errors, 'values' => $model->attributes]);
			}
		}
		else
	      return $this->render('add_rec');
	}  
	public function actionEdit($pass_id)
    {  
	 	if(isset($pass_id) && $pass_id != '')
		{ 
			if(Yii::$app->request->post() )
			{
				 $model = new PassportDetails();
				//echo '<pre>'; print_r(Yii::$app->request->post()); exit;
				$model->scenario = 'update';
				$model->attributes = array(
									'sur_name' => Yii::$app->request->post('s_name'),
									'given_name' => Yii::$app->request->post('g_name'),
									'dob' => Yii::$app->request->post('dob'),
									'issue_date' => Yii::$app->request->post('i_date'),
									'expiray_date' => Yii::$app->request->post('edate'),
									'received_by' => Yii::$app->request->post('recived_by'),
									'recived_from' => Yii::$app->request->post('received_from'),
									'gender' => Yii::$app->request->post('gender')
									 );
				$model->load(Yii::$app->request->post());
				if ($model->validate())    // all inputs are valid
				{
				    $passport = Yii::$app->db->createCommand()->update('passport_details', [
						'sur_name' => Yii::$app->request->post('s_name'),
						'given_name' => Yii::$app->request->post('g_name'),
						'dob' => date('Y-m-d', strtotime(Yii::$app->request->post('dob'))),
						'pass_number' => Yii::$app->request->post('p_no'),
						'issue_date' => Yii::$app->request->post('i_date'),
						'expiray_date' => date('Y-m-d', strtotime(Yii::$app->request->post('edate'))),
						'received_by' => Yii::$app->request->post('recived_by'),
						'mahrem' => Yii::$app->request->post('mahrem'),
						'relation' => Yii::$app->request->post('relation'),
					], 'pass_id = :pass_id', [':pass_id' => $pass_id] )->execute(); 
					Yii::$app->session['success'] = "Record has been updated successfully.";
					return $this->redirect(['passport/index']);
				}
				else 
				{
					// validation failed: $errors is an array containing error messages
					$errors = $model->errors;
					$PassportDetail = PassportDetails::findOne(['pass_id' => $pass_id]);
					return $this->render('edit_rec', ['model' => $model->errors, 'PassportDetail' => $PassportDetail]);
				}
				
			}
			else
			{
				$PassportDetail = PassportDetails::findOne(['pass_id' => $pass_id]);
				return $this->render ('edit_rec', ['PassportDetail' => $PassportDetail]); 
			}
			
		}
		else
		{
			Yii::$app->session['error'] = "Error! Something wrong, please try again.";
			return $this->redirect(['passport/index']);
		}
    }
	// update visa status
	public function actionUpdatestatus() 
	{
	   	if(Yii::$app->request->post() && Yii::$app->request->post('request') == 'visa_status' )
		{
				$passport = Yii::$app->db->createCommand()->update('passport_details', [
				   'visa_status' => Yii::$app->request->post('status'),
				], 'pass_id = :pass_id', [':pass_id' => Yii::$app->request->post('pass_id')] )->execute(); 
				echo json_encode(array('status' => 'yes',
							   'msg' => '<div class="alert alert-success">Passport Status has been changed</div>'	
								));
		}
		else if(Yii::$app->request->post() && Yii::$app->request->post('request') == 'passport_status' )
		{
				$passport = Yii::$app->db->createCommand()->update('passport_details', [
					'pass_status' => Yii::$app->request->post('status'),
					'agency_name' => Yii::$app->request->post('agency'),
				], 'pass_id = :pass_id', [':pass_id' => Yii::$app->request->post('pass_id')] )->execute(); 
				echo json_encode(array('status' => 'yes',
							   'msg' => '<div class="alert alert-success">Passport Status has been changed</div>'	
								));
		}
		else 
		{
			echo json_encode(array('status' => 'no',
							   'msg' => '<div class="alert alert-danger">Error! Something got wrong, please try again.</div>'	
								));
		}
				
		
	}
	// Delete user
	public function actionDelete($pass_id)
	{
		if(isset($pass_id) && $pass_id != '')
		{
			PassportDetails::deleteAll('pass_id = '.$pass_id.'');
			Yii::$app->session['success'] = "Record has been deleted.";
			return $this->redirect(['passport/index']);
		}
		else
		{
			Yii::$app->session['error'] = "Error! Something wrong, please try again.";
			return $this->redirect(['passport/index']);
		}
		   
	}

	// view user

	public function actionView($pass_id)
	{
		if(isset($pass_id) && $pass_id != '')
		{ 
			$PassportDetail = PassportDetails::findOne(['pass_id' => $pass_id]);
			return $this->render ('view', ['PassportDetail' => $PassportDetail]); 
		}
	}
		
	// Out Bound
	public function actionOutbound()
    {  
  		if(Yii::$app->request->post() && Yii::$app->request->post('swipe_passport') != '')
		{
			$passport_string = trim(preg_replace('/\s+/', ' ', Yii::$app->request->post('swipe_passport')));
			$passport_string = str_replace("<","|",trim($passport_string));
			//echo $passport_string;
			$passport_number = substr($passport_string,45,9);
			
			$PassportDetail = PassportDetails::findOne(['pass_number' => $passport_number]);
			if(count($PassportDetail) == 1)
				return $this->render('outbound', ['PassportDetail' => $PassportDetail]);
			else
			    return $this->render('outbound', ['swipe_error' => 'Error! This passport has not been entered, please go to inbound section.']);	
		}
		else if(Yii::$app->request->post('outbound_passport') )
		{  
			if (Yii::$app->request->post('pass_id'))    // all inputs are valid
			{    
			    $PassportDetail = PassportDetails::findOne(['pass_id' => Yii::$app->request->post('pass_id')]);             
				if($PassportDetail->status == 1)
				{
					$passport = Yii::$app->db->createCommand()->update('passport_details', [
							'delivered_by' => Yii::$app->request->post('deliver_by'),
							'delivered_courier' => Yii::$app->request->post('deliver_courier_slip_no'),
							'delivered_agent_name' => Yii::$app->request->post('deliver_agent_name'),
							'pass_status' => 'Returned',
							'visa_status' => 'Issued',
							'delivered_date' => date('Y-m-d'),
							'status' => 2,
						], 'pass_id = :pass_id', [':pass_id' => Yii::$app->request->post('pass_id')] )->execute(); 
					Yii::$app->session['success'] = "Recard Has Been Updated Sucessfully";
					return $this->redirect(['passport/index']);
				}
				else
				{
					return $this->render('outbound', ['swipe_error' => 'Error! This passport is already delivered.']);
				}
			}
			else 
			{
				//echo '<pre>'; print_r($errors); exit;
				return $this->render('outbound', ['swipe_error' => 'Error! Something wrong, Please try again']);
			}
		}
     	else
			return $this->render('outbound', []);
    }
	
	// Swipe passport string
	public function actionSwipe()
	{
		//echo '<pre>'; print_r(Yii::$app->request->post()); exit;
		if(Yii::$app->request->post() && Yii::$app->request->post('swipe_passport') != '')
		{
			$passport_string = trim(preg_replace('/\s+/', ' ', Yii::$app->request->post('swipe_passport')));
			$passport_string = str_replace("<","|",trim($passport_string));
			//echo $passport_string;
			$country = substr($passport_string,2,3);
			
			$surname_given_name = substr($passport_string,5,39);
			//echo $surname_given_name;
			$name = explode("||", $surname_given_name);
			//echo '<pre>'; print_r($name);  echo '</pre>';
			$surname = isset($name[0]) ? $name[0] : '';
			$given_name = isset($name[1]) ? str_replace("|", " ",$name[1]) : '';
			$passport_number = substr($passport_string,45,9);
			$date_of_birth_raw = substr($passport_string,58,6);
			// modify date 0f birth
			$dob_year = $this->get_full_year(substr($date_of_birth_raw,0,2));
			$dob_month = substr($date_of_birth_raw,2,2);
			$dob_date = substr($date_of_birth_raw,4,2);
			$date_of_birth = $dob_year.'-'.$dob_month.'-'.$dob_date;
			
			$gender = substr($passport_string,65,1);
			$expire_date_raw = substr($passport_string,66,6);
			// modify expire date
			$exp_year = '20'.substr($expire_date_raw,0,2);
			$exp_month = substr($expire_date_raw,2,2);
			$exp_date = substr($expire_date_raw,4,2);
			$expire_date = $exp_year.'-'.$exp_month.'-'.$exp_date;
			
			$nic = substr($passport_string,73,13);
			$data = array('country' => isset($country) ? $country : '',
						  'sur_name' => isset($surname) ? $surname : '',
						  'given_name' => isset($given_name) ? $given_name : '',
						  'pass_number' => isset($passport_number) ? $passport_number : '',
						  'dob' => isset($date_of_birth) ? date('d M, Y', strtotime($date_of_birth)) : '',
						  'gender' => isset($gender) ? $gender : '',
						  'expiray_date' => isset($expire_date) ? date('d M, Y',strtotime($expire_date)) : '',
						  'nic' => isset($nic) ? $nic : ''
						  );
			return $this->render('add_rec', ['values' => $data]);
		}
		else
		  return $this->render('add_rec', ['swipe_error' => 'Error! Something wrong, Please try again.']);
	}
	
	
	// Get full year 
	private function get_full_year($value)
	{
		$year = '20'.$value;
		if($year > date('Y')) 
		{
		   $year = $year - 100;
		}
		return $year;
	}
	// Pagination
	public function pagination($per_page=10,$page=1,$url='?')
	{   
		  
		$total_rec = PassportDetails::find()->count();
		//echo '<pre>'; print_r($query); exit;
		//$row = mysqli_fetch_array(mysqli_query($conDB,$query));
		$total = $total_rec;
		$adjacents = "2"; 
		  
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$lastlabel = "Last &rsaquo;&rsaquo;";
		  
		$page = ($page == 0 ? 1 : $page);  
		$start = ($page - 1) * $per_page;                               
		  
		$prev = $page - 1;                          
		$next = $page + 1;
		  
		$lastpage = ceil($total/$per_page);
		  
		$lpm1 = $lastpage - 1; // //last page minus 1
		  
		$pagination = "";
		if($lastpage > 1){   
			$pagination .= "<ul class='pagination'>";
			$pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
				  
				if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
				  
			if ($lastpage < 7 + ($adjacents * 2)){   
				for ($counter = 1; $counter <= $lastpage; $counter++){
					if ($counter == $page)
						$pagination.= "<li><a class='current'>{$counter}</a></li>";
					else
						$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
				}
			  
			} elseif($lastpage > 5 + ($adjacents * 2)){
				  
				if($page < 1 + ($adjacents * 2)) {
					  
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
						if ($counter == $page)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
					}
					$pagination.= "<li class='dot'>...</li>";
					$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
					$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
						  
				} elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					  
					$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
					$pagination.= "<li class='dot'>...</li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
					}
					$pagination.= "<li class='dot'>..</li>";
					$pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
					$pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
					  
				} else {
					  
					$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
					$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
					$pagination.= "<li class='dot'>..</li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination.= "<li><a class='current'>{$counter}</a></li>";
						else
							$pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
					}
				}
			}
			  
				if ($page < $counter - 1) {
					$pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
					$pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
				}
			  
			$pagination.= "</ul>";        
		}
		  
		return $pagination;
	}	
}