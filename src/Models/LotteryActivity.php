<?php
namespace lotteryyii\lottery\Models;
use yii\db\ActiveRecord;

class LotteryActivity extends ActiveRecord
{	
	/**
	* @func 数据库表名，注意配置文件表前缀
	*/   
	public static function tableName() {
		return '{{%lott_activity}}';
	}
	/**
	* 获取某个活动列表
	*/ 
    public function getList(){

    	return LotteryActivity::find()->all();
    }
	/**
	* 获取单个活动
	* @param $id int 活动id
	*/ 
	public function getInfo($id){

    	return  LotteryActivity::find()->where(['id'=>$id])->one();
    }
	/**
	* 增加单个活动
	* @param $id int 活动id
	* @param $data array 增加字段值
	*/ 
    public function add($data){
		
    }
	/**
	* 修改单个活动
	* @param $id int 活动id
	* @param $data array 修改的内容
	*/ 
    public function edit($id,$data){
    }
	/**
	* 删除单个活动
	* @param $id int 活动id
	*/ 
    public function del($id){

    }

}