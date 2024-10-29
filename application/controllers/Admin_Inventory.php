<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Inventory extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Helper_Model');
        $this->load->model('Admin_Color_Model');
        $this->load->model('Admin_Store_Model');
        $this->load->model('Admin_Model_Model');
        $this->load->model('Admin_Ebike_Model');
        $this->load->model('Admin_Spareparts_Model');
    }
    public function index()
    {
          $data['stock_models'] = count($this->Admin_Ebike_Model->getStockData());
          $data['stock_parts'] = count($this->Admin_Spareparts_Model->getStockData());

          $data['pages'] = 'inventory/index';
          $this->load->view('admin/layout/templates',$data);
    }
//  inventory parts
public function spareparts()
{
      $data['stores'] = $this->Admin_Store_Model->getStoreData();
      $data['models'] = $this->Admin_Model_Model->getModelData();
      $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsData();
      $data['colors'] = $this->Admin_Color_Model->getColorData();
      $data['pages'] = 'inventory/inventory_parts';
      $this->load->view('admin/layout/templates',$data);
}

public function spareparts_with_serial()
{
      $data['stores'] = $this->Admin_Store_Model->getStoreData();
      $data['models'] = $this->Admin_Model_Model->getModelData();
      $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsData();
      $data['colors'] = $this->Admin_Color_Model->getColorData();
      $data['pages'] = 'inventory/spareparts_with_serial';
      $this->load->view('admin/layout/templates',$data);
}
  
public function fetchAllSparepartsData(){

    $result = array('data' => array());

		$data = $this->Admin_Spareparts_Model->getSparepartsData();

		foreach ($data as $key => $value) {

            $buttons = '';
                   $buttons .= ' <a href="'.base_url('Admin_Inventory/update_parts_stock/'.$value['id']).'" class="btn btn-outline-dark"><i class="fa fa-plus"></i></button>';
             
                $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';
             
                $availability = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="label badge badge-danger">Inactive</span>';

                if(!$value['model_id'] == 0){
                $model = $this->Admin_Model_Model->getModelData($value['model_id']);
                $model = $model['name'];
                }
                if($value['model_id'] == 0){
                   $model = 'Generic';
                }

                if(!$value['color_id'] == 0){
                  $color = $this->Admin_Color_Model->getColorData($value['color_id']);
                  $color = $color['color_name'];
                  }
                  if($value['color_id'] == 0){
                     $color = 'Generic';
                  }
  
            $qty_status = '';
            if($value['qty'] <= $value['stock_critical']) 
            {
                $qty_status ='<span class="badge" style="background: orange; " >Critical Level</span>';
            }
            if($value['qty'] == 0) 
            {
                $qty_status = '<span class="badge" style="background: red; " >Out of stock</span>';
            }
            if($value['qty'] > $value['stock_critical'] ) 
            {
                $qty_status = '<span class="badge" style="background: lightgreen ; " >In stock</span>';
            }
             
			$result['data'][$key] = array(
				$value['name'],
				$value['price'],
                $value['qty'],
                $qty_status,
                $model,
                $color,
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

public function fetchAllStockData(){

  $result = array('data' => array());

  $data = $this->Admin_Spareparts_Model->getStockData();

  foreach ($data as $key => $value) {

    $parts = $this->Admin_Spareparts_Model->getSparepartsData($value['parts_id']);  


          $buttons = '';
              $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="uploadImage('.$value['id'].')" data-toggle="modal" data-target="#uploadImageModal"><i class="fas fa-file-upload"></i></button>';
              $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="addStockQty('.$value['id'].')" data-toggle="modal" data-target="#addStockQtyModal"><i class="fa fa-plus"></i></button>';	
      
              if(!$value['image'] == null){
                $img = '<img src="'.base_url($value['image']).'" alt="'.$parts['name'].'" class="img-circle" width="50" height="50" />';
              }
              else
              {
                $img = '<img src="'.base_url($parts['image']).'" alt="'.$parts['name'].'" class="img-circle" width="50" height="50" />';
              }

              $availability = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="label badge badge-danger">Inactive</span>';

              if(!$parts['model_id'] == 0){
              $model = $this->Admin_Model_Model->getModelData($parts['model_id']);
              $model = $model['name'];
              }
              if($parts['model_id'] == 0){
                 $model = 'Generic';
              }

              if(!$value['color_id'] == 0){
                $color = $this->Admin_Color_Model->getColorData($value['color_id']);
                $color = $color['color_name'];
                }
                if($value['color_id'] == 0){
                   $color = 'Generic';
                }

          $qty_status = '';
          $qty = '';
          if($parts['serial_number'] == 2){

            $qty = $value['qty'];

            if($value['qty'] <= $parts['stock_critical']) 
            {
                $qty_status ='<span class="badge" style="background: orange; " >Critical Level</span>';
            }
            if($value['qty'] == 0 || $value['qty'] < 0) 
            {
                $qty_status = '<span class="badge" style="background: red; " >Out of stock</span>';
            }
            if($value['qty'] > $parts['stock_critical'] ) 
            {
                $qty_status = '<span class="badge" style="background: lightgreen ; " >In stock</span>';
            }
           }

           if($parts['serial_number'] == 1){
            
             $qty = count($this->Admin_Spareparts_Model->getSerialCount($value['parts_id'], $parts['model_id'], $parts['name']));
             
            if($qty <= $parts['stock_critical']) 
            {
                $qty_status ='<span class="badge" style="background: orange; " >Critical Level</span>';
            }
            if($qty == 0) 
            {
                $qty_status = '<span class="badge" style="background: red; " >Out of stock</span>';
            }
            if($qty > $parts['stock_critical'] ) 
            {
                $qty_status = '<span class="badge" style="background: lightgreen ; " >In stock</span>';
            }
           }


    $result['data'][$key] = array(
      $img,
      $parts['name'],
      $parts['price'],
              $qty,
              $qty_status,
              $model,
              $color,
              'warehouse',
      $availability,
      $buttons
    );
    
    } 
    
    echo json_encode($result); 
}

public function getStockById(){
  $id = $this->input->post('id');
  $data = array();

    $data['stock'] = $this->Admin_Spareparts_Model->getStockData($id);
    $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsData($data['stock']['parts_id']);
    $data['color'] = $this->Admin_Color_Model->getColorData($data['stock']['color_id']);
    $data['model'] = $this->Admin_Model_Model->getModelData($data['parts']['model_id']);
    if($data['parts']['serial_number'] == 1 && strtolower($data['parts']['name']) == 'chasis' || strtolower($data['parts']['name']) == 'chassis'){
        $c =  count($this->Admin_Spareparts_Model->getSerialCount($data['parts']['id'], $data['parts']['model_id'], $data['parts']['name']));
        $data['stock'] = array(
          'qty' => $c,
          'id' => $data['stock']['id']
      );
    }
    if($data['parts']['serial_number'] == 1 && strtolower($data['parts']['name']) == 'motor'){
        $c =  count($this->Admin_Spareparts_Model->getSerialCount($data['parts']['id'], $data['parts']['model_id'], $data['parts']['name']));
        $data['stock'] = array(
          'qty' => $c,
          'id' => $data['stock']['id']
        );
    }

    if(!$data['stock'] == null ){
         $data['success'] = true;
    }
    else
    {
         $data['success'] = false;
    }

  echo json_encode($data);
}

public function addPartsStock(){
  
      $response = array();

      $this->form_validation->set_rules('parts_id', 'parts', 'trim|required');         
      $this->form_validation->set_rules('color_id', 'color', 'trim|required');         
      $this->form_validation->set_rules('qty', 'quantity', 'trim|required');         

      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
      
      if($this->form_validation->run() == true){
    
        // get model id in spareparts
        $model = $this->Admin_Spareparts_Model->getSparepartsData($this->input->post('parts_id'));
        $model = $model['model_id'];
        // check existing stock
        $parts = $this->Admin_Spareparts_Model->checkStock($this->input->post('parts_id'), $this->input->post('color_id'));
        // $parts = $this->Admin_Spareparts_Model->getSparepartsData($this->input->post('parts_id'));  
        if(!$parts){
    
          $data = array(
            'parts_id' => $this->input->post('parts_id'),
            'color_id' => $this->input->post('color_id'),
            'model_id' => $model,
            'qty' => $this->input->post('qty'),
            'active' => 1
          );
          $insert = $this->Admin_Spareparts_Model->addStock($data);
          if($insert){
            $response['success'] = true;
            $response['messages'] = 'Parts Stock Added';
          }
          else 
          {
            $response['success'] = false;
            $response['messages'] = 'Something Went Wrong!';
          }

        }
        else 
        {
          $response['success'] = false;
          $response['messages'] = 'This parts is Existing!';
        }


      }
      else
      {
        $response['success'] = false;
        foreach ($_POST as $key => $value) {
          $response['messages'][$key] = form_error($key);
        }
      }

      echo json_encode($response);
}

public function searchSerialNumber(){
  $response = array();
     $name = $this->input->post('name');
     $data = $this->input->post('serial_number');
     
     $result = $this->Admin_Spareparts_Model->getSerialNumberByName($data, $name);
     if($result){
         $response['success'] = true;
         $response['messages'] = 'This serial number is existing';
     }
     else 
     {
         $response['success'] = false;
     }
  
  echo json_encode($response);
}
// parts inventory
public function upload_image()
{
  $response = array();

  $id = $this->input->post('stock_id_image');
 
  $this->form_validation->set_rules('image', 'image', 'trim|required');         

  $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
  
  $random = round(microtime(true) * 1000);
  $target_directory = "uploads/spareparts/"."parts".$random.'.png';
  move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);

  $data = array(
    'image' => $target_directory,
  );

  $update = $this->Admin_Spareparts_Model->update_image($data, $id);
  if($update == true){
      $this->session->set_flashdata('messages_success','image uploaded');
      redirect(base_url('Admin_Inventory/spareparts'));
  }
  else
  {
      redirect(base_url('Admin_Inventory/spareparts'));
  }
}
// ebike inventory
public function upload_image1()
{
  $response = array();

  $id = $this->input->post('stock_id_image');
 
  $this->form_validation->set_rules('image', 'image', 'trim|required');         

  $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
  
  $random = round(microtime(true) * 1000);
  $target_directory = "uploads/ebike/"."model".$random.'.png';
  move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);

  $data = array(
    'image' => $target_directory,
  );

  $update = $this->Admin_Spareparts_Model->update_image1($data, $id);
  if($update == true){
      $this->session->set_flashdata('messages_success','image uploaded');
      redirect(base_url('Admin_Inventory/ebike'));
  }
  else
  {
      redirect(base_url('Admin_Inventory/ebike'));
  }
}

        
public function addStockQty($id){
  if($id){
    $response = array();
    
            $this->form_validation->set_rules('qty_1', 'quantity', 'trim|required');         

            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
            
            $result = $this->Admin_Spareparts_Model->getStockData($id);
            
            $total = $this->input->post('qty_1') + $result['qty']; 
            
            if ($this->form_validation->run() == TRUE)
            { 
                $data = array(
                    'qty' => $total,
                    'model_id' => $result['model_id'],
                    'parts_id' => $result['parts_id']
                    
                );
                $update = $this->Admin_Spareparts_Model->update($data , $id);

                if($update){
                   $response['success'] = true;
                   $response['messages'] = 'Stock Added';
                }
                else 
                {
                  $response['success'] = false;
                  $response['messages'] = 'Something Went Wrong';
                }
            }
            else 
            {
              $response['success'] = false;
              foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
              }
            }
        echo json_encode($response);   
    }    
}

public function create()
{
  $this->form_validation->set_rules('name', 'Parts name', 'trim|required');
  $this->form_validation->set_rules('price', 'Price', 'trim|required');
  $this->form_validation->set_rules('qty', 'quantity', 'trim|required');
  $this->form_validation->set_rules('model', 'Model', 'trim|required');
  $this->form_validation->set_rules('color', 'Color', 'trim|required');
  $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');

  $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

      if ($this->form_validation->run() == TRUE)
      {
          $image = $_FILES['image']['name'];
          $target_directory = "uploads/spareparts/".basename($image);
        
          if(move_uploaded_file($_FILES['image']['tmp_name'],$target_directory))
          {
            // $this->session->set_flashdata('image_uploaded','image uploaded');
          }
          else
          {
            // $this->session->set_flashdata('uploaded_fail','fail to upload');
          }


        $model = '';
        $color = '';
        if($this->input->post('model')){
            $model = $this->input->post('model');
        }

        if($this->input->post('color')){
          $color = $this->input->post('color');
        }

      
      
        $data = array(
        'image' => 'uploads/spareparts/'.$image,
        'name' => $this->input->post('name'),
        'price' => $this->input->post('price'),
        'qty' => $this->input->post('qty'),
        'stock_critical' => $this->input->post('stock_critical'),
        'description' => $this->input->post('description'),
        'model_id' => $model,
        'color_id' => $color,
        'active' => $this->input->post('active'),

        );
        
        // check existing parts
        $result = $this->Admin_Spareparts_Model->checkParts($data['name'], $data['model_id'], $data['color_id']); 

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
    $this->form_validation->set_rules('price', 'Price', 'trim|required');
    $this->form_validation->set_rules('qty', 'quantity', 'trim|required');
    $this->form_validation->set_rules('model', 'Model', 'trim|required');
    // $this->form_validation->set_rules('color', 'Color', 'trim|required');
    $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');

    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE)
        {
            $image = $_FILES['image']['name'];
            $target_directory = "uploads/spareparts/".basename($image);
          
            if(move_uploaded_file($_FILES['image']['tmp_name'],$target_directory))
            {
              $this->session->set_flashdata('messages_success','image uploaded');
            }
            else
            {
              $this->session->set_flashdata('uploaded_fail','fail to upload');
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
          'image' => 'uploads/spareparts/'.$image,
          'name' => $this->input->post('name'),
          'price' => $this->input->post('price'),
          'qty' => $this->input->post('qty'),
          'stock_critical' => $this->input->post('stock_critical'),
          'description' => $this->input->post('description'),
          'model_id' => $model,
          'color_id' => $color,
          'active' => $this->input->post('active'),
          );

          $update = $this->Admin_Spareparts_Model->update($data , $id);

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
      $response['messages'] = "Refersh the page again!!";
    }
    echo json_encode($response);
}


// inventory ebike
public function ebike()
{
      $data['stores'] = $this->Admin_Store_Model->getStoreData();
      $data['models'] = $this->Admin_Model_Model->getModelData();
      $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsData();
      $data['colors'] = $this->Admin_Color_Model->getColorData();
      $data['pages'] = 'inventory/inventory_ebike';
      $this->load->view('admin/layout/templates',$data);
}

public function fetchAllEbikeStockData(){

  $result = array('data' => array());

 $data = $this->Admin_Ebike_Model->getStockData();

 foreach ($data as $key => $value) {

  $model = $this->Admin_Model_Model->getModelData($value['model_id']);
  $stock_quantity = count($this->Admin_Model_Model->getStockQuantity($value['id']));
      

      $buttons = '';
              $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="uploadImage('.$value['id'].')" data-toggle="modal" data-target="#uploadImageModal"><i class="fas fa-file-upload"></i></button>';
           // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="addStockQty('.$value['id'].')" data-toggle="modal" data-target="#addStockQtyModal"><i class="fa fa-plus"></i></button>';	
    
          $img = '<img src="'.base_url($value['image']).'" alt="'.$value['image'].'" class="img-circle" width="50" height="50" />';
       
          $availability = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="label badge badge-danger">Inactive</span>';

          if(!$value['color_id'] == 0){
            $color = $this->Admin_Color_Model->getColorData($value['color_id']);
            $color = $color['color_name'];
            }
            if($value['color_id'] == 0){
               $color = 'Generic';
            }

      $qty_status = '';
      if($stock_quantity <= $model['stock_critical']) 
      {
          $qty_status ='<span class="badge" style="background: orange; " >Critical Level</span>';
      }
      if($stock_quantity == 0) 
      {
          $qty_status = '<span class="badge" style="background: red; " >Out of stock</span>';
      }
      if($stock_quantity > $model['stock_critical'] ) 
      {
          $qty_status = '<span class="badge" style="background: lightgreen ; " >In stock</span>';
      }

      // store
      $stored_at = '';
      if($value['stored_at'] == 0 || $value['stored_at'] == null ){
        $stored_at = 'warehouse';
      }
      else
      {
        $stored_at = 'Edit this part';
      }

  $result['data'][$key] = array(
    $img,
    $model['name'],
    $model['price'],
            $stock_quantity,
            $qty_status,
            $stored_at,
            $color,
    $availability,
    $buttons
  );
  } 
  echo json_encode($result); 
}

public function addEbikeStock(){
  
  $response = array();

  $this->form_validation->set_rules('model_id', 'model', 'trim|required');         
  $this->form_validation->set_rules('color_id', 'color', 'trim|required');         

  $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
  
  if($this->form_validation->run() == true){

    // check existing stock
    $model = $this->Admin_Ebike_Model->checkStock($this->input->post('model_id'), $this->input->post('color_id'));
    // $parts = $this->Admin_Spareparts_Model->getSparepartsData($this->input->post('parts_id'));  
    if(!$model){
      $data = array(
        'model_id' => $this->input->post('model_id'),
        'color_id' => $this->input->post('color_id'),
        'active' => 1
      );
      $insert = $this->Admin_Ebike_Model->addStock($data);
      if($insert){
        $response['success'] = true;
        $response['messages'] = 'Ebike Stock Added';
      }
      else 
      {
        $response['success'] = false;
        $response['messages'] = 'Something Went Wrong!';
      }
    }
    else 
    {
      $response['success'] = false;
      $response['messages'] = 'This Ebike is Existing!';
    }


  }
  else
  {
    $response['success'] = false;
    foreach ($_POST as $key => $value) {
      $response['messages'][$key] = form_error($key);
    }
  }

  echo json_encode($response);
}

public function ebike_serial(){
  $data['pages'] = 'inventory/ebike_serial';
  $this->load->view('admin/layout/templates',$data);
}

public function fetchAllEbikeSerialData(){

 $result = array('data' => array());

 $data = $this->Admin_Model_Model->getStockQuantity();

 foreach ($data as $key => $value) {

  $stock =  $this->Admin_Ebike_Model->getStockData($value['ebike_stock_id']);

  $model = $this->Admin_Model_Model->getModelData($stock['model_id']);
  $color = $this->Admin_Color_Model->getColorData($stock['color_id']);
  
    
      $buttons = '';
          $buttons .= '<a class="btn btn-outline-dark"> <i class="fas fa-trash"></i>  </a>';
          // $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="addStockQty('.$value['id'].')" data-toggle="modal" data-target="#addStockQtyModal"><i class="fa fa-plus"></i></button>';	
    

  $result['data'][$key] = array(
    $value['id'],
    $value['motor_number'],
    $value['chasis_number'],
    $model['name'],
    $color['color_name'],
    $buttons
  );
  } 
  echo json_encode($result); 
}

// serial page

public function serial_motor()
{
      $data['stores'] = $this->Admin_Store_Model->getStoreData();
      $data['models'] = $this->Admin_Model_Model->getModelData();
      $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsData();
      $data['colors'] = $this->Admin_Color_Model->getColorData();
      $data['pages'] = 'inventory/serial_motor';
      $this->load->view('admin/layout/templates',$data);
}

public function fetchAllMotorData(){
  $result = array();

  $data = $this->Admin_Spareparts_Model->getMotorNumber();

  foreach ($data as $key => $value) {
   
  $model = $this->Admin_Model_Model->getModelData($value['model_id']);

  $status = '';
  if($value['status'] == 1){
    $status = '<span class="badge" style="background: lightgreen;; " >Available</span>'; 
  }
  if($value['status'] == 0){
    $status = '<span class="badge" style="background: orange; " >Used</span>'; 
 }
  $action = '';
    
   $result['data'][$key] = array(
     $value['id'],
     $value['motor_number'],
     $model['name'],
     $status,
     $action

   );
   } 

  echo json_encode($result);
}


public function serial_chasis()
{
      $data['stores'] = $this->Admin_Store_Model->getStoreData();
      $data['models'] = $this->Admin_Model_Model->getModelData();
      $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsData();
      $data['colors'] = $this->Admin_Color_Model->getColorData();
      $data['pages'] = 'inventory/serial_chasis';
      $this->load->view('admin/layout/templates',$data);
}
public function fetchAllChasisData(){
     $result = array();

     $data = $this->Admin_Spareparts_Model->getChasisNumber();

     foreach ($data as $key => $value) {
    
     if($value['model_id'] == 0){
       $model = 'Generic';
     }
     else
     {
       $model = $this->Admin_Model_Model->getModelData($value['model_id']);
     }

     $status = '';
     if($value['status'] == 1){
       $status = '<span class="badge" style="background: lightgreen;; " >Available</span>'; 
     }
     if($value['status'] == 0){
       $status = '<span class="badge" style="background: orange; " >Used</span>'; 
    }
     $action = '';
       
      $result['data'][$key] = array(
        $value['id'],
        $value['chasis_number'],
        $model['name'],
        $status,
        $action

      );
      } 

     echo json_encode($result);
}

}



