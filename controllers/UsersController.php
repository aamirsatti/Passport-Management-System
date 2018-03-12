<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Users;
class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if(Yii::$app->session['user_role'] != 1)
		{
			return $this->redirect(['site/index']);
		}
		else
		{
			$users = Users::find()->where('user_id != :user_id',['user_id' => 1])->all();
			return $this->render('index', ['users' => $users]);
		}
    }

 	public function actionAdd()
    { 
        if(Yii::$app->request->post() )
		{
			if(Yii::$app->request->post('user_password') != Yii::$app->request->post('confirm_password'))
				$confirm_pass_error = 'Password not matched';
			else
			    $confirm_pass_error = '';	
			$model = new Users();
			//echo '<pre>'; print_r(Yii::$app->request->post()); exit;
			$model->attributes = array(
								 'user_role' => Yii::$app->request->post('user_role'),
								 'user_name' => Yii::$app->request->post('user_name'),
								 'user_password' => Yii::$app->request->post('user_password'),
								 'email' => Yii::$app->request->post('email'),
								 'full_name' => Yii::$app->request->post('Full_Name')
								 );
			$model->load(Yii::$app->request->post());
			if ($model->validate() && $confirm_pass_error == '')    // all inputs are valid
			{
				$users=Yii::$app->db->createCommand()->insert('users', [
					 'user_role' => Yii::$app->request->post('user_role'),
					 'user_name' => Yii::$app->request->post('user_name'),
					 'user_password' => Yii::$app->request->post('user_password'),
					 'email' => Yii::$app->request->post('email'),
					 'full_name' => Yii::$app->request->post('Full_Name')
				])->execute(); 
				Yii::$app->session['success'] = "New recard has been added sucessfully";
				return $this->actionIndex();
			} 
			else 
			{
				// validation failed: $errors is an array containing error messages
				$errors = $model->errors;
				return $this->render('add_rec', ['model' => $model->errors, 'values' => $model->attributes, 'confirm_error' => $confirm_pass_error]);
			}
			
			  
		}
		else
	      return $this->render('add_rec');
    }
	public function actionEdit($user_id)
    { 
        if(isset($user_id) && $user_id != '')
		{
			if(Yii::$app->request->post() )
			{
				if(Yii::$app->request->post('new_password') != Yii::$app->request->post('confirm_password'))
					$confirm_pass_error = 'Password not matched';
				else
					$confirm_pass_error = '';
				if ($confirm_pass_error == '')    // all inputs are valid
				{	
				    $users = Users::findOne($user_id);
					$users->user_password = Yii::$app->request->post('new_password');
					if ($users->update() !== false) 
					{
						// update successful
						Yii::$app->session['success'] = "Record has been updated successfully.";
						return $this->actionIndex();
					}
					else 
					{
						// update failed
						Yii::$app->session['error'] = "Error! Something wrong, please try again.";
						return $this->actionIndex();
					}
				}
				else
				{
					$user_data = Users::findOne(['user_id' => $user_id]);
					return $this->render ('edit_rec', ['values' => $user_data, 'confirm_error' => $confirm_pass_error]);	
				}
			}
			else
			{
				$user_data = Users::findOne(['user_id' => $user_id]);
				return $this->render ('edit_rec', ['values' => $user_data]);
			}
		}
		else
		{
			Yii::$app->session['error'] = "Error! Something wrong, please try again.";
			return $this->actionIndex();
		}
    }
	// Delete user
	public function actionDelete($user_id)
	{
		if(isset($user_id) && $user_id != '')
		{
			Users::deleteAll('user_id = '.$user_id.'');
			Yii::$app->session['success'] = "Record has been deleted.";
			return $this->actionIndex();
		}
		else
		{
			Yii::$app->session['error'] = "Error! Something wrong, please try again.";
			return $this->actionIndex();
		}
		   
	}
}



