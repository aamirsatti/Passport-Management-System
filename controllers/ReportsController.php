<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\PassportDetails;
class ReportsController extends \yii\web\Controller
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
		$alldata=PassportDetails :: find()->all();
	    return $this->render('index', ['alldata' => $alldata]);
    }
	// Get repots
	public function actionReport()
	{          
		if(Yii::$app->request->post('pass_type') != 0)
		{
			if(Yii::$app->request->post('agent') == '')
			{
				// for all agents
				$passports = PassportDetails::find()->where('status = :pass_status and (DATE(date_time) >= :sDate and DATE(date_time) <=:eDate OR DATE(delivered_date) >= :sDate and DATE(delivered_date) <=:eDate)',
												['pass_status' => Yii::$app->request->post('pass_type'), 
												'sDate' => date('Y-m-d', strtotime(Yii::$app->request->post('s_date'))), 
												'eDate' => date('Y-m-d', strtotime(Yii::$app->request->post('e_date')))])->all();
			}
			else
			{
				// for single agent
				$agent_where = '(agent_name =:agent_name OR delivered_agent_name =:d_agent OR agency_name =:agency_name)';
				$passports = PassportDetails::find()->where('status = :pass_status and (DATE(date_time) >= :sDate and DATE(date_time) <=:eDate OR DATE(delivered_date) >= :sDate and DATE(delivered_date) <=:eDate) and '.$agent_where.'',
												['pass_status' => Yii::$app->request->post('pass_type'), 
												'sDate' => date('Y-m-d', strtotime(Yii::$app->request->post('s_date'))), 
												'eDate' => date('Y-m-d', strtotime(Yii::$app->request->post('e_date'))),
												'agent_name' => Yii::$app->request->post('agent'),
												'd_agent' => Yii::$app->request->post('agent'),
												'agency_name' => Yii::$app->request->post('agent'),
												])->all();
												
			}
		}
		else
		{
			if(Yii::$app->request->post('agent') == '')
			{
				// for all agents
				$passports = PassportDetails::find()->where(' (DATE(date_time) >= :sDate and DATE(date_time) <=:eDate OR DATE(delivered_date) >= :sDate and DATE(delivered_date) <=:eDate)',
												['sDate' => date('Y-m-d', strtotime(Yii::$app->request->post('s_date'))), 
												'eDate' => date('Y-m-d', strtotime(Yii::$app->request->post('e_date')))])->all();									
				
			}
			else
			{
				// for single agent
				$agent_where = '(agent_name =:agent_name OR delivered_agent_name =:d_agent OR agency_name =:agency_name)';
				$passports = PassportDetails::find()->where(' (DATE(date_time) >= :sDate and DATE(date_time) <=:eDate OR DATE(delivered_date) >= :sDate and DATE(delivered_date) <=:eDate) and '.$agent_where.'',
												['sDate' => date('Y-m-d', strtotime(Yii::$app->request->post('s_date'))), 
												'eDate' => date('Y-m-d', strtotime(Yii::$app->request->post('e_date'))),
												'agent_name' => Yii::$app->request->post('agent'),
												'd_agent' => Yii::$app->request->post('agent'),
												'agency_name' => Yii::$app->request->post('agent'),
												])->all();									
				
			}
		}
		$data = array();
		foreach($passports as $pass)
		{
			$data[] = $pass->attributes;
		}
		// session data
		Yii::$app->session['report_start_date'] = date('d M,Y', strtotime(Yii::$app->request->post('s_date')));
		Yii::$app->session['report_end_date'] = date('d M,Y', strtotime(Yii::$app->request->post('e_date')));
		Yii::$app->session['report_pass_type'] = Yii::$app->request->post('pass_type');
		Yii::$app->session['report_agent'] = Yii::$app->request->post('agent');
		//$this->redirect(Yii::$app->request->baseurl.'/resources/tcpdf/examples/form_pdf.php');
		//die;
		//echo '<pre>'; print_r($data); exit;
		$result = '';
		$counter = 1;
		if(!empty($data))
		{
			foreach($data as $rec)
			{
		         if($rec['status'] == 1)
				 	$date = $rec['date_time'] != '0000-00-00 00:00:00' ? date('d M,Y',strtotime($rec['date_time'])) : '';
				 else if($rec['status'] == 2)
				 	$date = $rec['delivered_date'] != '0000-00-00' ? date('d M,Y',strtotime($rec['delivered_date'])) : '';
				 else
				    $date = '';	
				 $result .='<tr style="height:10px;">
								<td class="center">'.$counter.'</td>
								<td class="center">'.(isset($rec['given_name']) ? $rec['given_name'] : '').'</td>
								<td>'.(isset($rec['sur_name']) ? $rec['sur_name'] : '').'</td>
								<td>'.(($rec['gender'] == 1) ? 'Male' : ($rec['gender'] == 2 ? 'Female' : '')).'</td>
								<td class="center">'.(isset($rec['pass_number']) ? $rec['pass_number'] : '').'</td>
								<td class="center">'.($rec['expiray_date'] != '' ? date('d M, Y' , strtotime($rec['expiray_date'])) : '').'</td>
								<td class="center">'.(isset($rec['mahrem']) ? $rec['mahrem'] : '').'</td>
								<td class="center">'.(isset($rec['relation']) ? stripslashes($rec['relation']) : '').'</td>
								<td class="center">'.(isset($rec['visa_status']) ? $rec['visa_status'] : '').'</td>
                 				<td class="center">'.(isset($rec['pass_status']) ? $rec['pass_status'] : '').'</td>
								<td class="center">'.(isset($date) ? $date : '').'</td>
							</tr>';
				 $counter++;			
			}
		}
		else
		{
			$result .= '<tr>
						 <td colspan="7" style="color:red;"> No passport found </td>
						</tr>';
		}
            
        
		Yii::$app->session['report_data'] = $result;			 
		//echo '<pre>'; print_r($data); exit;
		echo json_encode(array('status' => 'yes',
							   'result' => $result	
								));
	}

}
