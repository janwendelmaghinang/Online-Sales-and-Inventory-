<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spareparts extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Spareparts_Model');
        $this->load->model('Admin_Model_Model');
    }

    public function index()
	{
        $data['models'] = $this->Admin_Model_Model->getModelData();
		$data['pages'] = 'spareparts/index';
		$this->load->view('inc/template',$data); 
    }
    
    public function fetchSpareparts(){
        $response = array();
        $fModel = $this->input->post('fModel');
        $fSort = $this->input->post('fSort');
        $squery = $this->input->post('sQuery');
        
        $mod = array();
        $totals = array();
        $data = $this->Spareparts_Model->getSpareparts($fModel, $squery ,$fSort);
        
        foreach($data as $row){
            $total = 0;
            if($row['model_id'] == 0 || $row['model_id'] == null){
                $mod[] = 'generic';
            }
            else{
                $a = $this->Admin_Model_Model->getModelData($row['model_id']);
                $mod[]=$a['name'];
            }
           
            $res= $this->Spareparts_Model->getPartsStock($row['id']);
            foreach($res as $re){
                $total = $total + $re['qty'];
            }
            $totals[] = $total;
            // $response = $this->Admin_Model_Model->getModelData($i);
        }
    
        $response['qty'] = $totals;
        $response['model'] = $mod;
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function fetchModel(){
        $response = array();
        $id = $this->input->post('id');
        $response = $this->Admin_Model_Model->getModelData($id);
        
        echo json_encode($response);
    }


    public function details($id = null){
        if($id){
            $total = 0;
            $col = '';
            
            $temp_id = '';

            $temp = array();
            $data['parts'] = $this->Spareparts_Model->getSingleParts($id);
            $res = $this->Spareparts_Model->getPartsStock($id);
            foreach($res as $result){
                $temp_id = $result['id'];
                $total = $total + $result['qty'];
                if(!$result['color_id'] == 0){
                    $col = $this->Spareparts_Model->getColorInStock($result['color_id']);
                    array_push($temp,$col);
                }
            }
            $data['temp_id'] = $temp_id;
            $data['color'] = $temp;
            $data['qty'] = $total;
            $data['id'] = $id;
            $data['pages'] = 'spareparts/details';
            $this->load->view('inc/template',$data); 
        }
        else
        {
            redirect(base_url('spareparts'));
        }
    }

    public function fetchSingleParts1(){
        $response = array();
        $id = $this->input->post('id');
        $total=0;

        $response['parts'] = $this->Spareparts_Model->getSingleParts($id);
        $res = $this->Spareparts_Model->getPartsStock($id);
        foreach($res as $result){
            $total = $total + $result['qty'];
        }
        $response['qty'] = $total;
        
        echo json_encode($response);
    }

    public function fetchSingleParts2(){
        $response = array();
        $id = $this->input->post('id');
        $color = $this->input->post('color');

        $response['parts'] = $this->Spareparts_Model->getSingleParts($id);

        $stock = $this->Spareparts_Model->getPartsStockByColor($id,$color);
        if(!$stock == null){
            $response['success'] = true;
            $response['stock'] = $stock;
        }
        else
        {
            $response['success'] = false;
        }

        echo json_encode($response);
    }
    
    public function fetchColorInStock(){
        $response = array();
        $id = $this->input->post('id');
    
        $stock = $this->Spareparts_Model->getPartsStock($id);
        for($i = 0; $i < count($stock); $i++){
            $color = $this->Spareparts_Model->getColorInStock($stock[$i]['color_id']);
            $response[] = $color;
        }
        echo json_encode($response);
    }
}