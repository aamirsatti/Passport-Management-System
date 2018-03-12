<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property integer $user_role
 * @property string $user_name
 * @property string $user_password
 * @property string $full_name
 * @property string $email
 * @property string $contact_no
 * @property string $createdDate
 * @property integer $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_role', 'user_name', 'user_password', 'email', 'full_name'], 'required'],
            [['user_role', 'status'], 'integer'],
            [['createdDate'], 'safe'],
			[['user_name', 'email', 'user_password'], 'trim'],
            [['user_name', 'user_password'], 'string', 'max' => 50],
            [['full_name', 'email', 'contact_no'], 'string', 'max' => 255],
			[['email'], 'email'],
			[['email'], 'unique'],
			[['user_name'], 'check_username'],
			[['user_name'], 'unique'],  
			
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_role' => 'User Role',
            'user_name' => 'User Name',
            'user_password' => 'User Password',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'contact_no' => 'Contact No',
            'createdDate' => 'Created Date',
            'status' => 'Status',
        ];
    }
	
	// Check user_name validation
	// validation for username
	public function check_username($username)
	{  
		if ( preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $this->user_name) ){
			 return true;
		}
		else
			$this->addError($username, 'Invalid username. (i.e no space, Minimum 6 characters, Only Alpha Numeric char allowed )');
	}
	
	
	
}
