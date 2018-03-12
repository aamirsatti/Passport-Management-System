<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "passport_details".
 *
 * @property integer $pass_id
 * @property string $pass_number
 * @property string $sur_name
 * @property string $given_name
 * @property string $gender
 * @property string $pass_type
 * @property string $issue_date
 * @property string $expiray_date
 * @property string $received_by
 * @property string $visa_status
 * @property string $send_through
 * @property string $pass_status
 * @property string $date_time
 * @property integer $user_id
 */
class PassportDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passport_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pass_number',  'expiray_date', 'received_by', 'dob'  ], 'required', 'on' => 'add'],  // 'pass_type',
			[[ 'gender',   'expiray_date',  'dob'  ], 'required', 'on' => 'update'],  // 'pass_type',
            [['issue_date', 'expiray_date', 'date_time'], 'safe'],
            [['user_id'], 'integer'],
            [['pass_number', 'visa_status', 'pass_status'], 'string', 'max' => 20],  // , 'send_through'
            [['sur_name', 'given_name', 'received_by'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 10],
            [['pass_type'], 'string', 'max' => 3],
			[['pass_number'], 'unique', 'on' => 'add'], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pass_id' => 'Pass ID',
            'pass_number' => 'Passport Number',
            'sur_name' => 'Sur Name',
            'given_name' => 'Given Name',
            'gender' => 'Gender',
            'pass_type' => 'Passport Type',
            'issue_date' => 'Issue Date',
            'expiray_date' => 'Expiray Date',
            'received_by' => 'Received By',
            'visa_status' => 'Visa Status',
            'send_through' => 'Send Through',
            'pass_status' => 'Pass Status',
            'date_time' => 'Date Time',
            'user_id' => 'User ID',
        ];
    }
	
}
