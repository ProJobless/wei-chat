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
 * FileName application/controllers/coupon.php
 * Created by CIscaffolding.
 * User: qujiakang
 * QQ:myqq_postor@qq.com
 * Email: qujiakang@gmail.com  
 * Date: Thu Apr 25 21:40:08 CST 2013
 *    
 */

class Coupon extends MY_Controller {
     
    public  function __construct(){
        parent::__construct("Coupon_model");
    }

    public function index($id=FALSE){
         $data = $this->dao->get($id);        
        //$this->load->view("admin/header-pure");
        $this->load->view("coupon/index",$data);
        //$this->load->view("admin/footer-pure");
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

    public function validate(){
       $data  =  $this->_xsl_post();

       $code  =  $data['cvcode'];

       $data['merchant_id'] = $this->userid;

       $this->dao->save($data);

       $tdata = array("code"=>"success");
       $this->load->view('common/result',$tdata);
    }
    
    
}   