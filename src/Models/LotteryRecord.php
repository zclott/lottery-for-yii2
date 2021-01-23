<?php
namespace lotteryyii\lottery\Models;
use yii\db\ActiveRecord;
use yii\data\Pagination;
use lotteryyii\lottery\Models\LotteryPrize;

class LotteryRecord extends ActiveRecord
{	

	/**
	* @func 数据库表名，注意配置文件表前缀
	*/   
	public static function tableName() {
		return '{{%lott_record}}';
	}
	/**
	* 获取某个活动所有获奖记录
	* @param $activityId int 活动id
	* @param $limit 分页限制
	*/ 
    public function getPrizeList($activityId,$page,$limit){
		/*state为1代表中奖 0代表未中奖*/
    	$query = LotteryRecord::find()->where(['activityId'=>$activityId,'state'=>1]);
		$count = $query->count();
		$pagination = new Pagination(['totalCount' => $count]);
		return $query->offset(($page-1)*$limit)
		    ->limit($limit)
		    ->all();
    }
	/**
	* 获取某个活动某个用户所有获奖记录
	* @param $activityId int 活动id
	* @param $uid 用户标识
	* @param $limit 分页限制
	*/ 
	public function userRecord($activityId,$uid,$page,$limit){
		
    	$query = LotteryRecord::find()->where(['activityId'=>$activityId,'uid'=>$uid,'state'=>1]);
		$count = $query->count();
		$pagination = new Pagination(['totalCount' => $count]);
		return $query->offset(($page-1)*$limit)
		    ->limit($limit)
		    ->all();
    }
	/**
	* 获取某个活动某个奖品的已抽中数量
	* @param $pid 奖品标识id
	*/ 
	public function prizeCount($pid){

    	return LotteryRecord::find()->where(['prizeId'=>$pid])->count();
    }
	/**
	* 增加用户抽奖记录（中与不中都记录）
	* @param $data array 增加字段值
	*/ 
    public function addonly($data){
		$recordModel = new LotteryRecord();
		foreach($data as $key=>$value){
			$recordModel->$key = $value;
		}
		return $recordModel->save();
    }
	/**
	* 增加用户抽奖记录到记录表（中与不中都记录），并且将已中奖奖品数量在奖品表中+1
	* @param $data array 增加字段值
	* @param $lott_num int 奖品已中奖数量
	*/ 
    public function addwith($data,$lott_num){
		
		$transaction = LotteryRecord::getDb()->beginTransaction();
		try{ 
			$recordModel = new LotteryRecord();
			foreach($data as $key=>$value){
				$recordModel->$key = $value;
			}
			$recordModel->save();
			$Prize = LotteryPrize::find()->where(['id'=>$data['prizeId']])->one();
			$Prize->lott_num = $lott_num;
			$Prize->save();
			$transaction->commit(); 
			return true;
		}catch (\Exception $e) { 
			$transaction->rollBack();
			return false;
		}
 
    }	

}