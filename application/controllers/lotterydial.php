<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Licensed to the Apache Software Foundation (ASF) under one or more
 * contributor license agreements.  See the NOTICE file distributed with
 * this work for additional information regarding copyright ownership.
 * The ASF licenses this file to You under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with
 * the License.  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * FileName application/controllers/lotterydial.php
 * Created by CIscaffolding.
 * User: qujiakang
 * QQ:myqq_postor@qq.com
 * Email: qujiakang@gmail.com  
 * Date: Tue May 14 22:51:04 CST 2013
 *    
 */

class Lotterydial extends MY_Controller {



    public  function __construct(){
        parent::__construct("Lotterydial_model");
        $this->load->model("Lotterywin_model",'winerdao');
    }





    public function index($id=FALSE){


        $member  = $this->_get('member');

        $usercan =  $this->winerdao->user_limition($id,$member);

        if(!$usercan){
            $this->load->view("front/header");
            $this->load->view("lotterydial/cash");
            $this->load->view("front/footer");
            return;
        }


        $pubwx   = $this->_get('pubweixin');


        $lcfg  = $this->dao->getconfig($pubwx);



        $id = $lcfg['id'];




        $prize_arr = array(
            '0' => array('id'=>4,'min'=>1,'max'=>29,'prize'=>'继续努力','v'=>13),
            '1' => array('id'=>2,'min'=>302,'max'=>328,'prize'=>'二等奖','v'=>2),
            '2' => array('id'=>6,'min'=>242,'max'=>268,'prize'=>'继续努力','v'=>15),
            '3' => array('id'=>1,'min'=>182,'max'=>208,'prize'=>'一等奖','v'=>1),
            '4' => array('id'=>5,'min'=>122,'max'=>148,'prize'=>'继续努力','v'=>14),
            '5' => array('id'=>3,'min'=>62,'max'=>88,'prize'=>'三等奖','v'=>5),
            '6' => array('id'=>7,'min'=>array(32,92,152,212,272,332),
                'max'=>array(58,118,178,238,298,358),'prize'=>'继续努力','v'=>50)
        );

        $firsted  = $this->winerdao->get_winers($id,1);
        $seconded = $this->winerdao->get_winers($id,2);
        $thirded  = $this->winerdao->get_winers($id,3);

        $firstodd  = $lcfg['firstodds'];
        $secondodd = $lcfg['secondodds'];
        $thirdodd  = $lcfg['thirdodds'];

        if($firsted>=$lcfg['firstnum']) $firstodd = 0;
        if($seconded>=$lcfg['secondnum']) $secondodd = 0;
        if($thirded>=$lcfg['thirdnum']) $thirdodd= 0;

        //一等奖
        $prize_arr['3']['v'] = $firstodd;
        $prize_arr['3']['prize'] = $lcfg['firstmsg'];


        //二等奖
        $prize_arr['1']['v'] = $secondodd;
        $prize_arr['1']['prize'] = $lcfg['secondmsg'];

        //三等奖
        $prize_arr['5']['v'] = $thirdodd;
        $prize_arr['5']['prize'] = $lcfg['thirdmsg'];


        $ltotal = $firstodd+$secondodd+$thirdodd;


        $prize_arr['6']['prize'] = 8-$ltotal+50;

        $arr = array();

        foreach ($prize_arr as $key => $val) {
            $arr[$val['id']] = $val['v'];
        }

        $rid = $this->getRand($arr); //根据概率获取奖项id

        $res = $prize_arr[$rid-1]; //中奖项
        $min = $res['min'];
        $max = $res['max'];
        if($res['id']>3){ //空奖
            $i = mt_rand(0,5);
            $result['angle'] = mt_rand($min[$i],$max[$i]);
        }else{
            $result['angle'] = mt_rand($min,$max)+180; //随机生成一个角度
        }
        $result['prize'] = $res['prize'];
        $result['id']=$res['id'];
        $result['lotterycode'] = create_random_number(12);
        $result['member'] = $member;
        $result['merchantcode'] = base64_encode($lcfg['code']);
        $result['lotteryid'] = $lcfg['id'];
        $result['pubweixin'] = $pubwx;

        $this->load->view("front/header");
        $this->load->view("lotterydial/index",$result);
        $this->load->view("front/footer");
    }


    public function winit($pubweixin,$lottery,$member,$wingrade,$mcode,$lcode){
         $data = array(
             "pubweixin_id"=>$pubweixin,
             "lotterydial_id"=>$lottery,
             "weixin_id"=>$member,
             'merchant_code'=>$mcode,
             'lottery_code'=>$lcode,
             'wingrade'=>$wingrade
         );
         $again = $this->dao->checklottory($data);


    }


     /**
      * 新增编辑
      */
    public function editNew($id=FALSE){
        
       $data = $this->dao->get($id);
             
     
        
        $this->load->view("admin/header-pure");
        $this->load->view($this->dao->table()."/editNew",$data);
        $this->load->view("admin/footer-pure");
    }


    function getRand($proArr) {
        $result = '';

        //概率数组的总概率精度
        $proSum = array_sum($proArr);

        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);

        return $result;
    }
    
    
}   