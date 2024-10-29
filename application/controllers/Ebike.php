<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebike extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ebike_Model');
        $this->load->model('Admin_Color_Model');
        $this->load->model('Admin_Model_Model');
    }

    public function index()
	{
        $data['models'] = $this->Admin_Model_Model->getModelData();
		$data['pages'] = 'ebike/index';
		$this->load->view('inc/template',$data); 
    }

    public function fetchEbike(){
        $response = array();
        $fModel = $this->input->post('fModel');
        $fSort = $this->input->post('fSort');
        $squery = $this->input->post('sQuery');

        $response = $this->Ebike_Model->getModelData($fModel, $squery ,$fSort);

        echo json_encode($response);
    }

    public function details($id){
        $count = 0;
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['model'] = $this->Ebike_Model->getModelDataById($id);
        $data['specs'] = $this->Ebike_Model->getModelSpecsById($id);
     
             $stocks = $this->Ebike_Model->getEbikeStock($id);
             foreach($stocks as $stock){
                $items = count($this->Ebike_Model->getEbikeStockItems($stock['id']));
                $count = $count + $items;
             }
        $data['id'] = $id;
        $data['qty'] = $count;
		$data['pages'] = 'ebike/details';
		$this->load->view('inc/template',$data); 
    }

    public function fetchEbike1(){
        $response = array();
        $id = $this->input->post('id');
        $count=0;

        $response['model'] = $this->Ebike_Model->getModelDataById($id);
        $stocks = $this->Ebike_Model->getEbikeStock($id);
             foreach($stocks as $stock){
                $items = count($this->Ebike_Model->getEbikeStockItems($stock['id']));
                $count = $count + $items;
             }
        $response['qty'] = $count;
        
        echo json_encode($response);
    }

    public function fetchEbike2(){
        $response = array();
        $id = $this->input->post('id');
        $color = $this->input->post('color');
  
        $response['ebike'] = $this->Ebike_Model->getEbikeByColor($id, $color);

        if( $response['ebike'] ){
            $response['qty'] =  count($this->Ebike_Model->getEbikeStockItems($response['ebike']['id']));
           $response['success'] = true;
        }
        else
        {
            $response['success'] = false;
            $response['qty'] = 0;
        }

    
        
        echo json_encode($response);
    }


    
}