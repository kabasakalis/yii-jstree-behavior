<?php

/**
 * This is the Nested Set  model class for table "category".
 *
 * The followings are the available columns in table 'categorydemo':
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $name
 * @property string $description
 */
class Category extends CActiveRecord
{


	/**
	 * Returns the static model of the specified AR class.
	 * @return Categorydemo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        /**
	 * @return string the class name
	 */
          public static function className()
	{
		return __CLASS__;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

    public function behaviors()
{
   return array(
       'NestedSetBehavior'=>array(
           'class'=>'application.behaviors.NestedSetBehavior',
           'leftAttribute'=>'lft',
           'rightAttribute'=>'rgt',
           'levelAttribute'=>'level',
           'hasManyRoots'=>true
           ),
   );
}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.

		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('name, description', 'safe'),
			//array('name, description', 'safe', 'on'=>'search'),
		);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'description' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



}