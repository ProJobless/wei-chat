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
 * FileName application/models/coupon.php
 * Created by CIscaffolding.
 * User: qujiakang
 * QQ:myqq_postor@qq.com
 * Email: qujiakang@gmail.com  
 * Date: Thu Apr 25 21:40:08 CST 2013
 *    
 */

class Coupon_model extends MY_Model {
     
    public  function __construct(){
        parent::__construct("Coupon_model");
        $this->load->model("Member_model","mdao");
    }  

    public function save($data){

        $member = $this->mdao->get($data['member_id']);
        if($member['empty']){
            $mdata = array(
                "id"=>$data['member_id'],
                'weixin'=>$data['member_id'],
                'merchant_id'=>$data['merchant_id']
            );
            $this->mdao->save($mdata);
        }
        unset($data['merchant_id']);
        parent::save($data);
    }
    
}   