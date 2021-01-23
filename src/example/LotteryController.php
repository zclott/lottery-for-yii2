<?php
namespace app\controllers;
use Yii;
use lotteryyii\lottery\Lottery;
use yii\web\Controller;

class LotteryController extends Controller
{
	public $layout = false;
	/**
     * Lottery  index. 抽奖方法
	 * @param $uid int 用户id
	 * @param $activityId int 活动id
	 * @param $lotteryLimit int 抽奖次数
    */
    public function actionIndex()
    {
    	$activityId = Yii::$app->request->get('activityId',1);
    	$uid =Yii::$app->request->get('uid',1);
    	$lotteryLimit = Yii::$app->request->get('lotteryLimit',3);;
		$result = Lottery::lottery($activityId,$uid,$lotteryLimit);
		Yii::$app->response->format =  \yii\web\Response::FORMAT_JSON;
		if($result['result']){
			return ['code'=>0,'data'=>$result['result']];
		}else{
			return ['code'=>0,'message'=>$result['message']];
		}
		
    }
	/**
     * Lottery  activityInfo. 活动详情
	 * @param $activityId int 活动id
    */
	public function actionActivityinfo()
	{
		$activityId =Yii::$app->request->get('activityId');
		$activityObj =  Lottery::activityInfo($activityId);
		Yii::$app->response->format =  \yii\web\Response::FORMAT_JSON;
		if($activityObj){
			return ['code'=>0,'data'=>$activityObj];
		}else{
			return ['code'=>0,'message'=>'无数据'];
		}
		
	}
	/**
     * Lottery  prizeList. 奖品列表
	 * @param $activityId int 活动id
    */
	public function actionPrizelist()
	{
		$activityId =Yii::$app->request->get('activityId');
		$prizeObj =  Lottery::prizeList($activityId);
		Yii::$app->response->format =  \yii\web\Response::FORMAT_JSON;
		if($prizeObj){
			return ['code'=>0,'data'=>$prizeObj];
		}else{
			return ['code'=>0,'message'=>'无数据'];
		}
		
	}
	/**
     * Lottery  getPrizeRecord. 获奖记录
	 * @param $activityId int 活动id
	 * @param $page int 页码
	 * @param $limit int 条数
    */
	public function actionGetprizerecord()
	{
		$activityId =Yii::$app->request->get('activityId');
		$limit =Yii::$app->request->get('limit');
		$page =Yii::$app->request->get('page');
		$getPrizeObj = Lottery::getPrizeRecord($activityId,$page,$limit);
		Yii::$app->response->format =  \yii\web\Response::FORMAT_JSON;
		if( $getPrizeObj){
			return ['code'=>0,'data'=>$getPrizeObj];
		}else{
			return ['code'=>0,'message'=>'无数据'];
		}
	
	}
	/* Lottery  show. html展示
	 * https://100px.net/ 抽奖前端开源项目vue-luck-draw插件
    */
	public function actionShow()
	{
		
		//js版本大转盘 http://xxx.com/lottery/show?activityId=1
		return $this->render('lottery1');
		//vue版本 vue-luck-draw插件 通过script 标签引入 http://xxx.com/lottery/show?activityId=1
		//return $this->render('lottery3');
		
	}
}
