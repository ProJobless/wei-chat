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
 * FileName application/controllers/merchant.php
 * Created by CIscaffolding.
 * User: qujiakang
 * QQ:myqq_postor@qq.com
 * Email: qujiakang@gmail.com  
 * Date: Thu Apr 25 21:40:09 CST 2013
 *    
 */

class Merchant extends MY_Controller {
     
    public  function __construct(){
        parent::__construct("Merchant_model");
        $this->load->model("Couponcatalog_model",'cpcdao');
    }

    public function index($id=FALSE){

        $merc = $this->dao->get($id);
        $beans = $this->cpcdao->find_by_merchant($id);
        $data['beans'] = $beans;
        $data['bean'] = $merc;
        $this->load->view("front/header");
        $this->load->view("merchant/index",$data);
        $this->load->view("front/footer");
    }
    
     /**
      * 新增编辑
      */
    public function editNew($id=FALSE){

        $id=$this->userid;
        $data = $this->dao->get($id);
        //$this->load->view("admin/header-pure");
        $this->load->view($this->dao->table()."/editNew",$data);
        //$this->load->view("admin/footer-pure");
    }
    
    
}   