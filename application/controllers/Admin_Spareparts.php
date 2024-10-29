<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Spareparts extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Helper_Model');
        $this->load->model('Admin_Color_Model');
        $this->load->model('Admin_Model_Model');
        $this->load->model('Admin_Spareparts_Model');
    }

public function index()
{
        $data['models'] = $this->Admin_Model_Model->getModelData();
        $data['pages'] = 'spareparts/index';
        $this->load->view('admin/layout/templates',$data);
}
  
public function fetchAllSparepartsData(){

        $result = array('data' => array());

		$data = $this->Admin_Spareparts_Model->getSparepartsData();

		foreach ($data as $key => $value) {

            $buttons = '';
                $buttons .= '<a href="'.base_url('Admin_Spareparts/edit/'.$value['id']).'" class="btn btn-outline-dark"><i class="fa fa-pencil"></i></a>';	
                $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deleteSpareparts('.$value['id'].')" data-toggle="modal" data-target="#deleteSparepartsModal"><i class="fa fa-trash"></i></button>';
                     
                $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';
             
                $availability = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="label badge badge-danger">Inactive</span>';

                if(!$value['model_id'] == 0){
                $model = $this->Admin_Model_Model->getModelData($value['model_id']);
                $model = $model['name'];
                }
                if($value['model_id'] == 0){
                   $model = 'Generic';
                }

                // if(!$value['color_id'] == 0){
                //   $color = $this->Admin_Color_Model->getColorData($value['color_id']);
                //   $color = $color['color_name'];
                //   }
                //   if($value['color_id'] == 0){
                //      $color = 'Generic';
                //   }
  
            // $qty_status = '';
            // if($value['qty'] <= $value['stock_critical']) 
            // {
            //     $qty_status ='<span class="badge" style="background: orange; " >Critical Level</span>';
            // }
            // if($value['qty'] == 0) 
            // {
            //     $qty_status = '<span class="badge" style="background: red; " >Out of stock</span>';
            // }
            
			$result['data'][$key] = array(
				// $img,
				$value['name'],
        $value['price'],
        $value['supplier_price'],
        $value['markup'],
        $model,
        // $color,
				$availability,
				$buttons
			);
		} 
		echo json_encode($result); 
}

public function fetchAllSparepartsById(){
      $id = $this->input->post('id');
      $response = array();
    
      $result = $this->Admin_Spareparts_Model->getSparepartsData($id);
      if($result){
        $response = $result;
      }

      echo json_encode($response);
    
}

public function fetchAllSparepartsByColorModel(){
  $color_id = $this->input->post('color_id');
  $model_id = $this->input->post('model_id');
  $response = array();

  $results = $this->Admin_Spareparts_Model->getPartsByColorModel($color_id, $model_id);

    $response['stock'] = $results;
    $response['parts'] = array();
    foreach($results as $result ){
      $parts = $this->Admin_Spareparts_Model->getSparepartsData($result['parts_id']);
      array_push($response['parts'], $parts );
    }
    if(!$results == null){
      $response['success'] = true;

    }
    else
    {
        $response['success'] = false;
    }

  echo json_encode($response);

}

public function fetchAllSparepartsByModel(){
    $response = array();
    
    $id = $this->input->post('id');
    $response = $this->Admin_Spareparts_Model->getSparepartsByModel($id);
   
    echo json_encode($response);
}

public function create()
{
  $this->form_validation->set_rules('name', 'Parts name', 'trim|required');
  $this->form_validation->set_rules('supplier_price', 'Supplier Price', 'trim|required');
  $this->form_validation->set_rules('selling_price', 'Selling Price', 'trim|required');
  $this->form_validation->set_rules('markup', 'Mark up', 'trim|required');
  $this->form_validation->set_rules('model', 'Model', 'trim|required');
  $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');

  $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

      if ($this->form_validation->run() == TRUE)
      {
        $random = round(microtime(true) * 1000);
        $target_directory = "uploads/spareparts/"."parts".$random.'.png';
        move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);

        $model = '';
        if($this->input->post('model')){
            $model = $this->input->post('model');
        }
        $data = array(
        'image' => $target_directory,
        'name' => $this->input->post('name'),
        'serial_number' => $this->input->post('serial_number'),
        'supplier_price' => $this->input->post('supplier_price'),
        'price' => $this->input->post('selling_price'),
        'markup' => $this->input->post('markup'),
        'stock_critical' => $this->input->post('stock_critical'),
        'description' => $this->input->post('description'),
        'model_id' => $model,
        'qty_per_ebike' => $this->input->post('qty_per_ebike'),
        'active' => $this->input->post('active'),

        );
        
        // check existing parts
        $result = $this->Admin_Spareparts_Model->checkParts($data['name'], $data['model_id']); 

        if($result){
              $this->session->set_flashdata('messages_danger', 'Parts existing');
        }
        else 
        {
          $insert = $this->Admin_Spareparts_Model->create($data);
          if($insert){

              $this->session->set_flashdata('messages_success','Parts Added');
              redirect(base_url('Admin_Spareparts'));
          }

        }
      }
      else 
      {
        
      } 

      $data['models']= $this->Admin_Model_Model->getModelData();
      $data['colors'] = $this->Admin_Color_Model->getColorData();

      $data['pages'] = 'spareparts/create';
      $this->load->view('admin/layout/templates',$data);
}

public function edit($id = null)
    {
      if($id){
      $this->form_validation->set_rules('name', 'Parts name', 'trim|required');
      $this->form_validation->set_rules('supplier_price', 'Supplier Price', 'trim|required');
      $this->form_validation->set_rules('selling_price', 'Selling Price', 'trim|required');
      $this->form_validation->set_rules('markup', 'Mark up', 'trim|required');
      $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');

      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

          if ($this->form_validation->run() == TRUE)
          {
            $random = round(microtime(true) * 1000);
            var_dump($_FILES['image']);
            $image_path = '';
              if(!$_FILES['image']['name'] == ''){
        
                $image_path = "uploads/spareparts/"."parts".$random.'.png';
                $target_directory = "uploads/spareparts/"."parts".$random.'.png';
                move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);
    
              }
              else
              {
                $image_path = $this->input->post('image_hidden');
              }
        

          $model = '';
          if($this->input->post('model')){
              $model = $this->input->post('model');
          }
          else
          {
              $model = 0; 
          }

          $color = '';
          if($this->input->post('color')){
             $color = $this->input->post('color');
          }
          else
          {
            $color = 0; 
          }
            $data = array(
            'image' => $image_path,
            'name' => $this->input->post('name'),
            'supplier_price' => $this->input->post('supplier_price'),
            'price' => $this->input->post('selling_price'),
            'markup' => $this->input->post('markup'),
            'stock_critical' => $this->input->post('stock_critical'),
        		'description' => $this->input->post('description'),
        		'active' => $this->input->post('active'),
            );
  
            $update = $this->Admin_Spareparts_Model->updateParts($data , $id);

            if($update){
               $this->session->set_flashdata('messages_success','Successfuly Updated');
               redirect(base_url('Admin_Spareparts'));
            }
          }
          else 
          {
           
          } 

          $data['parts'] =  $this->Admin_Spareparts_Model->getSparepartsData($id);
          $data['models']= $this->Admin_Model_Model->getModelData();
          $data['colors'] = $this->Admin_Color_Model->getColorData();
  
          $data['pages'] = 'spareparts/edit';
          $this->load->view('admin/layout/templates',$data);
    }
    else 
    {
        redirect(base_url('Admin_Spareparts'));
    }
}

    
  public function delete(){
    $id = $this->input->post('id');
    $response = array();

    if($id) 
    {
      // check stock
      $partsStock = $this->Admin_Spareparts_Model->getStockDataByPartsId($id);

      if($partsStock == null || $partsStock == 0 )
      {
            
          $name = $this->Admin_Spareparts_Model->getSparepartsData($id);

          $delete = $this->Admin_Spareparts_Model->remove($id);
      
          if($delete == true) {

          $activity = 'Delete Parts "'. $name['name'].'"';
          $this->Helper_Model->system_logs($activity);

            $response['success'] = true;
            $response['messages'] = "Successfully removed";	
          }
          else 
          {
            $response['success'] = false;
            $response['messages'] = "Error in the database while removing the color information";
          }
      }
      else 
      {
        $response['success'] = false;
        $response['messages'] = "This Spareparts has a stock";
      }


    }
    else 
    {
      $response['success'] = false;
      $response['messages'] = "Refersh the page again!!";
    }
    echo json_encode($response);
}

// generic parts are not belong in this function
public function getAllParts(){
  $model_id = $this->input->post('model_id');
  $color_id = $this->input->post('color_id');

  $data['parts'] = array();
  $data['name'] = array();
  $allStock = $this->Admin_Spareparts_Model->getStockData();
  
  foreach($allStock as $stock){

      if($stock['color_id'] == 0 && $stock['model_id'] == $model_id ){
        $a = $this->Admin_Spareparts_Model->getStockData($stock['id']);
        $b = $this->Admin_Spareparts_Model->getSparepartsData($a['parts_id']);
        if(!$a == null){
          if($b['serial_number'] == 1 && strtolower($b['name']) == 'chasis' || strtolower($b['name']) == 'chassis' ){
            $c = count($this->Admin_Spareparts_Model->getChasisNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }

          if($b['serial_number'] == 1 && strtolower($b['name']) == 'motor'){
            $c = count($this->Admin_Spareparts_Model->getMotorNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }

          if($b['serial_number'] == 2){
  
            array_push($data['parts'], $a);
            array_push($data['name'], $b);

          }
        }
      }

      if($stock['color_id'] == $color_id && $stock['model_id'] == 0 ){
        $a = $this->Admin_Spareparts_Model->getStockData($stock['id']);
        $b = $this->Admin_Spareparts_Model->getSparepartsData($a['parts_id']);
        if(!$a == null){
          if($b['serial_number'] == 1 && strtolower($b['name']) == 'chasis' || strtolower($b['name']) == 'chassis' ){
            $c = count($this->Admin_Spareparts_Model->getChasisNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }
          if($b['serial_number'] == 1 && strtolower($b['name']) == 'motor'){
            $c = count($this->Admin_Spareparts_Model->getMotorNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }
          if($b['serial_number'] == 2){
  
            array_push($data['parts'], $a);
            array_push($data['name'], $b);

          }
        }
      }

      if($stock['color_id'] == $color_id && $stock['model_id'] == $model_id ){
        $a = $this->Admin_Spareparts_Model->getStockData($stock['id']);
        $b = $this->Admin_Spareparts_Model->getSparepartsData($a['parts_id']);
        if(!$a == null){
          if($b['serial_number'] == 1 && strtolower($b['name']) == 'chasis' || strtolower($b['name']) == 'chassis' ){
            $c = count($this->Admin_Spareparts_Model->getChasisNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }
          if($b['serial_number'] == 1 && strtolower($b['name']) == 'motor'){
            $c = count($this->Admin_Spareparts_Model->getMotorNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }
          if($b['serial_number'] == 2){
  
            array_push($data['parts'], $a);
            array_push($data['name'], $b);

          }
        }
      }

      if($stock['color_id'] == 0 && $stock['model_id'] == 0 ){
        $a = $this->Admin_Spareparts_Model->getStockData($stock['id']);
        $b = $this->Admin_Spareparts_Model->getSparepartsData($a['parts_id']);
        if(!$a == null){
          if($b['serial_number'] == 1 && strtolower($b['name']) == 'chasis' || strtolower($b['name']) == 'chassis' ){
            $c = count($this->Admin_Spareparts_Model->getChasisNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }
          if($b['serial_number'] == 1 && strtolower($b['name']) == 'motor'){
            $c = count($this->Admin_Spareparts_Model->getMotorNumber($model_id));
            array_push($data['name'], $b);

            $d = array(
               'qty' => $c,
            );

            array_push($data['parts'], $d);
          }
          if($b['serial_number'] == 2){
  
            array_push($data['parts'], $a);
            array_push($data['name'], $b);

          }
        }
      }
      

  }
  echo json_encode($data);
}

}