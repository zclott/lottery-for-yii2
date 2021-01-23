<?php
namespace lotteryyii\lottery\Models;
use yii\db\ActiveRecord;
class LotteryPrize extends ActiveRecord
{	 
	/**
	* @func 数据库表名，注意配置文件表前缀
	*/   
	public static function tableName() {
		return '{{%lott_prize}}';
	}
	/**
	* 获取某个活动奖品列表(对外展示的奖品字段)
	* @param $activityId int 活动id
	*/ 
    public function getList($activityId){

    	return LotteryPrize::find()->select(['id','name','imgUrl'])->where(['activityId'=>$activityId])->all();
    }
	/**
	* 获取某个活动奖品列表
	* @param $activityId int 活动id
	*/ 
    public function getAllList($activityId){

    	return LotteryPrize::find()->where(['activityId'=>$activityId])->all();
    }
	/**
	* 获取单个活动奖品
	* @param $id int 奖品id
	*/ 
	public function getInfo($id){

    	return  LotteryPrize::find()->where(['id'=>$id])->one();
    }
	/**
	* 增加单个活动奖品
	* @param $data array 增加字段值
	*/ 
    public function add($data){

    	
    }
	/**
	* 修改单个活动奖品
	* @param $id int 奖品id
	* @param $data array 修改的内容
	*/ 
    public function edit($id,$data){


    }
	/**
	* 删除单个活动奖品
	* @param $id int 奖品id
	*/ 
    public function del($id){


    }

}