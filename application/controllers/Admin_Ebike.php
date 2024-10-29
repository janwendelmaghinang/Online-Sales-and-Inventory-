<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Ebike extends CI_Controller{

public function __construct()
{
    parent::__construct();
    $this->load->model('Admin_Model_Model');
    $this->load->model('Admin_Ebike_Model');
    $this->load->model('Admin_Ebike_Branch_Model');
    $this->load->model('Admin_Color_Model');
    $this->load->model('Admin_Store_Model');
    $this->load->model('Admin_Spareparts_Model');
    date_default_timezone_set("Asia/Bangkok");
}
public function pending()
{ 
    // disable add jo button
    $data['btn_trigger'] = false;
    $sample = $this->Admin_Ebike_Model->getProductionUnsetSerial(1);
    if(!count($sample) == 0){
        for($i = 0; $i < count($sample); $i++ ){
            if($sample[$i]['set_serial'] == 0){
                $data['btn_trigger'] = true;
            }
        }
    }
    else
    {
        $data['btn_trigger'] = false;
    }


    $data['pending'] =  count($this->Admin_Ebike_Model->getProductionData(1));
    $data['pages'] = 'ebike/index';
    $this->load->view('admin/layout/templates',$data);
}
public function completed()
{   
    // disable add jo button
    $data['btn_trigger'] = false;
    $sample = $this->Admin_Ebike_Model->getProductionUnsetSerial(1);
    if(!count($sample) == 0){
        for($i = 0; $i < count($sample); $i++ ){
            if($sample[$i]['set_serial'] == 0){
                $data['btn_trigger'] = true;
            }
        }
    }
    else
    {
        $data['btn_trigger'] = true;
    }

    $data['pending'] =  count($this->Admin_Ebike_Model->getProductionData(1));
    $data['pages'] = 'ebike/index1';
    $this->load->view('admin/layout/templates',$data);
}
public function cancelled()
{   
    // disable add jo button
    $data['btn_trigger'] = false;
    $sample = $this->Admin_Ebike_Model->getProductionUnsetSerial(1);
    if(!count($sample) == 0){
        for($i = 0; $i < count($sample); $i++ ){
            if($sample[$i]['set_serial'] == 0){
                $data['btn_trigger'] = true;
            }
        }
    }
    else
    {
        $data['btn_trigger'] = true;
    }

    $data['pending'] =  count($this->Admin_Ebike_Model->getProductionData(1));
    $data['pages'] = 'ebike/index2';
    $this->load->view('admin/layout/templates',$data);
}
public function getEbikeById(){

    $id = $this->input->post('id');
        if($id){
        $ebike = $this->Admin_Ebike_Model->getStockData($id);
        $data['model'] = $this->Admin_Model_Model->getModelData($ebike['model_id']);
        $data['color'] = $this->Admin_Color_Model->getColorData($ebike['color_id']);
        $data['specs'] = $this->Admin_Ebike_Model->getEbikeSpecsData($ebike['model_id']);
        echo json_encode($data);
        }
        return false;
}
public function getPartsByModelId(){
    $id = $this->input->post('id');
    $results = array() ;
        if($id){
            echo $id;
        $results = $this->Admin_Spareparts_Model->getSparepartsByModel($id);
        // foreach($data['needqty'] as $parts_id){
        //     $p_id = $parts_id['parts_id'];
        //     $result = $this->Admin_Ebike_Model->getSparepartsByIdArray($p_id);
        //     array_push($results, $result);
        //     $data['parts'] = $results;
        // }
        echo json_encode($results);
        }
        return false;
}

public function fetchAllEbikeData(){

    $result = array('data' => array());

    $data = $this->Admin_Ebike_Model->getStockData();
    
    foreach ($data as $key => $value){
     
        $model = $this->Admin_Model_Model->getModelData($value['model_id']);
        
   
        $buttons = '';
            $buttons = ($model['set_model'] == 1) ? '<button class="btn btn-outline-dark mx-1" onclick="ebikeProduction('.$value['id'].')" data-toggle="modal" data-target="#productionModal-modal-lg" ><i class="fa fa-plus"></i></button>' : '<button disabled class="btn btn-outline-dark mx-1"><i class="fa fa-plus"></i></button>';
            
            $img = '<img src="'.base_url($value['image']).'" alt="'.$model['name'].'" class="img-circle" width="50" height="50" />';
            
            $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="label badge badge-danger">Inactive</span>';

            if(!$value['color_id'] == 0){
                $color = $this->Admin_Color_Model->getColorData($value['color_id']);
                $color = $color['color_name'];
            }
 
        $result['data'][$key] = array(
            $value['model_id'],
            $model['name'],
            $color,
            // $status,
            $buttons
        );
    } 
    echo json_encode($result); 
}

public function create()
{
    $this->form_validation->set_rules('model', 'Model', 'trim|required');
    $this->form_validation->set_rules('price', 'Price', 'trim|required');
    $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');

    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
    
    $model = $this->Admin_Model_Model->getModelData($this->input->post('model'));

        if ($this->form_validation->run() == TRUE)
        {
            $image = $_FILES['image']['name'];
            $target_directory = "uploads/ebike/".basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);
      
            $data = array(
                'image' => 'uploads/ebike/'.$image,
                'name' => $model['model_name'],
                'stock_critical' => $this->input->post('stock_critical'),
                'description' => $this->input->post('description'),
                'model_id' => $this->input->post('model'),
                'color_id' => $model['color_id'],
                'stored_at' => 'warehouse',
                'active' => $this->input->post('active')
            );
            $insert = $this->Admin_Ebike_Model->insertEbike($data);
            if($insert){
                    $this->session->set_flashdata('messages','Succesfully added');
                redirect(base_url('Admin_Ebike'));
            }
        }
        else 
        {

        }

    $data['ebikes'] = $this->Admin_Ebike_Model->getEbikeData();
    $data['models']= $this->Admin_Model_Model->getModelData();
    $data['pages'] = 'ebike/create';
    $this->load->view('admin/layout/templates',$data);
}
public function edit($id)
{
    if($id){        
    $data['specs'] = $this->Admin_Ebike_Model->getEbikeSpecsData($id);
    $data['units'] = $this->Admin_Ebike_Model->getEbikeData($id);
    $data['models']= $this->Admin_Model_Model->getModelData();
    $data['pages'] = 'ebike/edit';
    $this->load->view('admin/layout/templates',$data);
    }
}

public function selectStore(){
    $response = array();
    $id = $this->input->post('id');
    $data = $this->Admin_Ebike_Branch_Model->getEbikeBranchByUnitId($id); 

    
    if($data){
        $response['data'] = $data;
        foreach($data as $i){
            $store = $this->Admin_Store_Model->getStoreData($i['store_id']);
            $response['store'] = $store;
        }

    }
    echo json_encode($response);
}

public function production()
{
    $data['pages'] = 'ebike/production';
    $this->load->view('admin/layout/templates',$data);
}

public function fetchAllProductionData($status){

    $result = array('data' => array());

    $data = $this->Admin_Ebike_Model->getProductionData($status);



    foreach ($data as $key => $value) {

        $production_quantity =  count($this->Admin_Ebike_Model->getProductionQuantity($value['id']));
        
        $buttons = '';
        $disabled = '';
        $disabled1 = '';
        if($value['set_serial'] == 1){
            $disabled = 'disabled';
        }
        else if($value['set_serial'] == 0)
        {
            $disabled1 = 'disabled';
        }
        $buttons .= '<button '.$disabled.' type="button" onclick="getProductionItems('.$value['id'].')" data-toggle="modal" data-target="#setSerialModal" class="btn btn-outline-dark data-toggle="tooltip"
        data-placement="top" title="Edit "><i class="far fa-pencil"></i></button>';	
        $buttons .= '<button '.$disabled1.' type="button" onclick="complete('.$value['id'].')" data-toggle="modal" data-target="#completeModal" class="btn btn-outline-dark" data-toggle="tooltip"
        data-placement="top" title="Complete"><i class="far fa-check"></i></button>'; 
        $buttons .= '<button type="button" onclick="cancel('.$value['id'].')" data-toggle="modal" data-target="#cancelModal" class="btn btn-outline-dark" data-toggle="tooltip"
        data-placement="top" title="Cancel"><i class="far fa-times"></i></button>'; 
            
                
            $status = ($value['status'] == 1) ? '<span class="badge badge-success">Pending</span>' : '<span class="label badge badge-danger">Inactive</span>';

            $color = $this->Admin_Color_Model->getColorData($value['color_id']);
            if($color){
                $color = $color['color_name'];
            }

            $model = $this->Admin_Model_Model->getModelData($value['model_id']);
            if($model){
                $model = $model['name'];
            }

        $result['data'][$key] = array(
            $model,
            $color,
            $production_quantity,
            $value['technician'],
            $value['stored_at'],
            $value['start_date'],
            $buttons
        );
    } 
    echo json_encode($result); 
 
}
public function fetchAllProductionData1($status){

    $result = array('data' => array());

    $data = $this->Admin_Ebike_Model->getProductionData($status);

    foreach ($data as $key => $value) {
                
            $production_quantity =  count($this->Admin_Ebike_Model->getProductionQuantity($value['id']));
                
            $status = ($value['status'] == 1) ? '<span class="badge badge-success">Pending</span>' : '<span class="label badge badge-danger">Inactive</span>';

            $color = $this->Admin_Color_Model->getColorData($value['color_id']);
            if($color){
                $color = $color['color_name'];
            }

            $model = $this->Admin_Model_Model->getModelData($value['model_id']);
            if($model){
                $model = $model['name'];
            }

        $result['data'][$key] = array(
            $model,
            $color,
            $production_quantity,
            $value['technician'],
            $value['stored_at'],
            $value['start_date'],
            $value['date_finished']
        );
    } 
    echo json_encode($result); 
}
public function fetchAllProductionData2($status){

    $result = array('data' => array());

    $data = $this->Admin_Ebike_Model->getProductionData($status);

    foreach ($data as $key => $value) {

        $production_quantity =  count($this->Admin_Ebike_Model->getProductionQuantity($value['id']));
        
        $buttons = '';
        $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Ebike/production_completed/'.$value['id']).'"><i class="fas fa-trash-restore" data-toggle="tooltip"
        data-placement="top" title="Restore"></i></a>'; 
        $buttons .= '<a class="btn btn-outline-dark" href="'.base_url('Admin_Ebike/production_cancelled/'.$value['id']).'" data-toggle="tooltip"
        data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>'; 
            
                
            $status = ($value['status'] == 1) ? '<span class="badge badge-success">Pending</span>' : '<span class="label badge badge-danger">Inactive</span>';

            $color = $this->Admin_Color_Model->getColorData($value['color_id']);
            if($color){
                $color = $color['color_name'];
            }

            $model = $this->Admin_Model_Model->getModelData($value['model_id']);
            if($model){
                $model = $model['name'];
            }

        $result['data'][$key] = array(
            $model,
            $color,
            $production_quantity,
            $value['technician'],
            $value['stored_at'],
            $value['start_date'],
            $value['date_finished'],
            $buttons
        );
    } 
    echo json_encode($result); 
}

public function getProductionData(){
    $id = $this->input->post('id');
    if($id){
        $data['production'] = $this->Admin_Ebike_Model->getProductionByIdData($id);
        $data['production_quantity'] = count($this->Admin_Ebike_Model->getProductionQuantity($id));
        $data['model'] = $this->Admin_Model_Model->getModelData( $data['production']['model_id']);
        $data['color'] = $this->Admin_Color_Model->getColorData($data['production']['color_id']);
        echo json_encode($data);
    }
}

public function addProduction(){
        $response = array();
                $data = array(
                'start_date' => date('M d, Y'),
                'technician' => $this->input->post('technician'),	
                'ebike_stock_id' => $this->input->post('ebike_stock_id'),	
                'set_serial' => 0,
                'stored_at' => 'warehouse',	
                'model_id' => $this->input->post('model'),
                'color_id' => $this->input->post('color'),
                'status' => 1,	
                ); 
    
                $stocks = $this->Admin_Spareparts_Model->getStockDataArray($data['color_id'], $data['model_id']);
                $allStock = $this->Admin_Spareparts_Model->getStockData();
                $insert = $this->Admin_Ebike_Model->Production($data);
                
                if($insert == true) {
                    // no generic parts 
                    foreach($stocks as $stock){
                        $results = $this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                        $totalparts = $results['qty_per_ebike'] * $this->input->post('qty');
                        $total = $stock['qty'] - $totalparts;         
                        $data = array(
                            'id' => $stock['id'],
                            'qty' => $total,
                        );
                        $this->Admin_Spareparts_Model->update_stock($data, $data['id']);                  
                    }

                    foreach($allStock as $stock){
                        // generic color
                        if($stock['color_id'] == 0 && $stock['model_id'] == $this->input->post('model')){
                            $results = $this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                            $totalparts = $results['qty_per_ebike'] * $this->input->post('qty');
                            $total = $stock['qty'] - $totalparts;
                            $data = array(
                                'id' => $stock['id'],
                                'qty' => $total,
                            );
                            $this->Admin_Spareparts_Model->update_stock($data, $data['id']);
                        }
                        // generic model
                        if($stock['color_id'] == $this->input->post('color') && $stock['model_id'] == 0){
                            $results = $this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                            $totalparts = $results['qty_per_ebike'] * $this->input->post('qty');
                            $total = $stock['qty'] - $totalparts;
                            $data = array(
                                'id' => $stock['id'],
                                'qty' => $total,
                            );
                            $this->Admin_Spareparts_Model->update_stock($data, $data['id']);
                        }
                        // both color and model are generic
                        if($stock['color_id'] == 0 && $stock['model_id'] == 0){
                            $results = $this->Admin_Spareparts_Model->getSparepartsData($stock['parts_id']);
                            $totalparts = $results['qty_per_ebike'] * $this->input->post('qty');
                            $total = $stock['qty'] - $totalparts;
                            $data = array(
                                'id' => $stock['id'],
                                'qty' => $total,
                            );
                            $this->Admin_Spareparts_Model->update_stock($data, $data['id']);
                        }
                    }
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

public function getItemsByProductionId(){
    $response = array();
    $id = $this->input->post('id');
    $model = $this->Admin_Ebike_Model->getProductionData1($id);
    $response['model_id'] = $model['model_id'];
    if($id){
        $response['p_items'] = $this->Admin_Ebike_Model->getProductionItems($id);
    }
    echo json_encode($response);
}

public function getMotorNumberByModel(){
    $response = array();
    $model_id = $this->input->post('id');
    if($model_id){
        $response = $this->Admin_Spareparts_Model->getMotorNumber($model_id);
    }
    echo json_encode($response);
}

public function getChasisNumberByModel(){
    $response = array();
    $model_id = $this->input->post('id');
    if($model_id){
        $response = $this->Admin_Spareparts_Model->getChasisNumber($model_id);
    }
    echo json_encode($response);
}

public function set_serial($id = null){
   if($id){
       $response = array();
       $setSerial = $this->Admin_Ebike_Model->setSerialNumber($id);
       if($setSerial){

        $response['success'] = true;
        $response['messages'] = 'Serial Number Set Succesfully';
        }
        else
        {
        $response['success'] = false;
        $response['messages'] = 'Something went Wrong!';
       }

       echo json_encode($response);
   }
}

public function production_completed(){
    $id = $this->input->post('id');
    $response = array();
    if($id){
        $data = array(
            'date_finished' =>  date('M d, Y'),
            'status' => 2,
        );
        $productionData =  $this->Admin_Ebike_Model->getProductionByIdData($id);
        // $ebikeModelData =  $this->Admin_Model_Model->getModelData($productionData['model_id']);
        
        if($productionData['status'] == 1){
            $update = $this->Admin_Ebike_Model->productionCompleted($data, $id);
            if($update){
                
                // add ebike stock items
                $this->Admin_Ebike_Model->addEbikeStockItems($id);
                
                $response['success'] = true;
                $response['messages'] = 'Production Completed';
            }
            else
            {    
                $response['success'] = false;
                $response['messages'] = 'Something Went Wrong!';
            }
        }

    }
    else
    {
        $response['success'] = false;
        $response['messages'] = 'Something Went Wrong!';
    }
    echo json_encode($response);
}

public function production_cancelled(){
    $id = $this->input->post('id');
    $response = array();
    if($id){
        $data = array(
            'date_finished' =>  date('M d, Y'),
            'status' => 3,
        );
        $productionData =  $this->Admin_Ebike_Model->getProductionByIdData($id);
        $ebikeModelData =  $this->Admin_Model_Model->getModelData($productionData['model_id']);
        
        if($productionData['status'] == 1){
            $update = $this->Admin_Ebike_Model->productionCancelled($data, $id);
            if($update){
                $model_id = $ebikeModelData['id'];
                $total = $ebikeModelData['quantity'] + $productionData['quantity'];
                $data = array(
                    'quantity' => $total,
            );
            $updateModel = $this->Admin_Ebike_Model->updateModel($data, $model_id);
                $response['success'] = true;
                $response['messages'] = 'Production Completed';
            }
            else
            {    
                $response['success'] = false;
                $response['messages'] = 'Something Went Wrong!';
            }
        }

    }
    else
    {
        $response['success'] = false;
        $response['messages'] = 'Something Went Wrong!';
    }
    echo json_encode($response);
}

// pos

public function fetchAllEbikeByColorModel(){
    $color = $this->input->post('color_id');
    $model = $this->input->post('model_id');

    $response = array();
      
    $eColor =  $this->Admin_Color_Model->getColorData($color);
    $ebike = $this->Admin_Ebike_Model->getEbikeByColorModel($color, $model);
    $model = $this->Admin_Ebike_Model->getEbikeData($model);
  
    
    if(!$ebike == null ){
         $items = count($this->Admin_Ebike_Model->getEbikeStockItems($ebike['id']));
        $response['ecolor'] = $eColor['color_name'];
        $response['model'] = $model;
        $response['qty'] = array('qty'=> $items);
        $response['stock_id'] = array('id'=> $ebike['id']);
        $response['success'] = true;
    }
    else
    {
        $response['success'] = false;
    }


    echo json_encode($response);
}

public function getStockItems(){
    $stock_id = $this->input->post('stock_id');
    $items = $this->Admin_Ebike_Model->getEbikeStockItems($stock_id);
    $response = array();
    if(!$items == null){
        $response['success'] = true;
        $response['data'] = $items;
    }
    else
    {
        $response['success'] = false;
    }
    echo json_encode($response);
}
}