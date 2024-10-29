<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Production extends CI_Controller{

public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Model_Model');
        $this->load->model('Admin_Ebike_Model');
        $this->load->model('Admin_Color_Model');
        $this->load->model('Admin_Store_Model');
}

public function index()
{
    $data['pages'] = 'production/index';
    $this->load->view('admin/layout/templates',$data);
}

public function fetchAllProductionData(){

    $result = array('data' => array());

    $data = $this->Admin_Ebike_Model->getProductionData();

    foreach ($data as $key => $value) {
        
        $button_name = '';
        $button_color = '';
            if($value['status']== 1){
                $button_name = 'pending';
                $button_color = 'lightgray';

            }
            else if($value['status']== 2){
                $button_name = 'completed';
                $button_color = 'lightgreen';
            }
            else
            {
                $button_name = 'cancelled';
                $button_color = '#ff1a1a';
            }
        $buttons = '';
        $buttons .= '<div class="dropdown float-right mx-1">
                        <button class="btn btn-outline-dark dropdown-toggle" style="background: '.$button_color.'; "
                            type="button" id="dropdownMenu1" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        '.$button_name.'
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="'.base_url('admin_production/production_completed/'.$value['id']).'">Completed</a>
                            <a class="dropdown-item" href="'.base_url('admin_production/production_cancelled/'.$value['id']).'">Cancelled</a>
                        </div>
                        </div>';
            $buttons .= '<a href="'.base_url('admin_production/production_edit/'.$value['id']).'" class="btn btn-outline-dark float-right">Edit</a>';	
            
                
            $status = ($value['status'] == 1) ? '<span class="badge badge-success">Pending</span>' : '<span class="label badge badge-danger">Inactive</span>';

            $color = $this->Admin_Color_Model->getColorData($value['color_id']);
            if($color){
                $color = $color['color_name'];
            }

            $model = $this->Admin_Model_Model->getModelData($value['model_id']);
            if($model){
                $model = $model['model_name'];
            }


        $result['data'][$key] = array(
            $model,
            $color,
            $value['quantity'],
            $value['technician'],
            $value['stored_at'],
            $value['start_date'],
            $value['date_finished'],
            $buttons
        );
    } 
    echo json_encode($result); 
}

public function addProduction(){

        $response = array();

                $data = array(
                'ebike_id' => $this->input->post('ebike_id'),	
                'start_date' => date('M d, Y'),
                'technician' => $this->input->post('technician'),	
                'quantity' => $this->input->post('qty'),	
                'stored_at' => 'warehouse',	
                'model_id' => $this->input->post('model'),
                'color_id' => $this->input->post('color'),
                'status' => 1,	
                ); 

                $insert = $this->Admin_Ebike_Model->Production($data);
                if($insert == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Production Added';
                }
                else
                {
                    $response['success'] = false;
                    $response['messages'] = 'Something went Wrong!';			
                }
    
        echo json_encode($response);
        
}
    
public function production_completed($id = null){
    if($id){
        $data = array(
            'date_finished' =>  date('M d, Y'),
            'status' => 2,
        );
        $productionData =  $this->Admin_Ebike_Model->getProductionData($id);
        $ebikeUnitData =  $this->Admin_Ebike_Model->getEbikeData($productionData['ebike_id']);
        
        if($productionData['status'] == 1){
            $update = $this->Admin_Ebike_Model->productionCompleted($data, $id);
            if($update){
                $ebike_id = $ebikeUnitData['id'];
                $total = $ebikeUnitData['quantity'] + $productionData['quantity'];
                $data = array(
                    'quantity' => $total,
            );
            $updateEbike = $this->Admin_Ebike_Model->updateUnit($data, $ebike_id);
            $this->session->set_flashdata('completed','Production Completed');
            redirect('admin_production/production');
            }
        }
        if($productionData['status'] == 2)
        {
            $this->session->set_flashdata('completed','This already completed');
            redirect('admin_production/production','refresh');
        } 
        if($productionData['status'] == 3){
            $this->session->set_flashdata('completed','This already cancelled');
            redirect('admin_production/production','refresh');
        }
    }
    else
    {
        redirect(base_url('admin_dashboard','refresh'));
    }
}
    
public function production_cancelled($id){
    if($id){
        $productionData =  $this->Admin_Ebike_Model->getProductionData($id);
        if($productionData['status'] == 1){
            $this->session->set_flashdata('completed','Production cancelled');
            redirect('admin_production/production','refresh');
        }
        if($productionData['status'] == 2){
            $this->session->set_flashdata('completed','This already completed');
            redirect('admin_production/production','refresh');
        }
        if($productionData['status'] == 3){
            $this->session->set_flashdata('completed','This already cancelled');
            redirect('admin_production/production','refresh');
        }

    }
}

}