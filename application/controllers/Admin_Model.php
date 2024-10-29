<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Spareparts_Model');
        $this->load->model('Admin_Color_Model');
        $this->load->model('Admin_Model_Model');
        $this->load->model('Helper_Model');

        $image_name = '';
    }

    public function index()
	  {
        $data['colors'] = $this->Admin_Color_Model->getColorData();
        $data['pages'] = 'model/index';
        $this->load->view('admin/layout/templates',$data);
    }
    
    public function create(){

      $this->form_validation->set_rules('model_name', 'Model', 'trim|required');
      // $this->form_validation->set_rules('color', 'Color', 'trim|required');
      $this->form_validation->set_rules('price', 'Price', 'trim|required');
      $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');

      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

          if ($this->form_validation->run() == TRUE)
          {          
            $random = round(microtime(true) * 1000);
            $target_directory = "uploads/ebike/"."model".$random.'.png';
            move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);

            $data = array(
              'name' => $this->input->post('model_name'),
              'price' => $this->input->post('price'),
              'stored_at' => 'warehouse',
              'stock_critical' => $this->input->post('stock_critical'),	
              'active' => $this->input->post('active'),
              'image' => $target_directory
            );

            $model = $data['name'];
    
            $result = $this->Admin_Model_Model->checkModel($model);

            if($result){
                $this->session->set_flashdata('messages_danger','Model is existing!');	
            }
            else
            {
                $insert = $this->Admin_Model_Model->insertModel($data);
                if($insert) {

                $activity = 'Add Model "'. $this->input->post('model_name').'"';
                $this->Helper_Model->system_logs($activity);

                $this->session->set_flashdata('messages_success','Model Added');	
                redirect(base_url('Admin_Model'));
                }
                else
                {
                  $this->session->set_flashdata('messages_danger','Something went wrong!');	
                  redirect(base_url('Admin_Model','refresh'));	
                }
            }
          }
          else 
          {

          }


      $data['colors'] = $this->Admin_Color_Model->getColorData();
      $data['pages'] = 'model/create';
      $this->load->view('admin/layout/templates',$data);
    }

    public function edit($id = null){
        if($id){

          $this->form_validation->set_rules('model_name', 'Model', 'trim|required');
          $this->form_validation->set_rules('price', 'Price', 'trim|required');
          $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');
    
          $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
    
              if ($this->form_validation->run() == TRUE)
              {
                $random = round(microtime(true) * 1000);
    
                $target_directory = "uploads/ebike/"."model".$random.'.png';
                move_uploaded_file($_FILES['image']['tmp_name'],$target_directory);
    
                $data = array(
                  'name' => $this->input->post('model_name'),
                  'price' => $this->input->post('price'),
                  'stock_critical' => $this->input->post('stock_critical'),	
                  'active' => $this->input->post('active'),
                  'image' => $target_directory
                );
    
                    $update = $this->Admin_Model_Model->updateModel($data, $id);
                    if($update) {
    
                    $activity = 'update Model "'. $this->input->post('model_name').'"';
                    $this->Helper_Model->system_logs($activity);
    
                    $this->session->set_flashdata('messages_success','Model Updated');	
                    redirect(base_url('Admin_Model'));
                    }
                    else
                    {
                      $this->session->set_flashdata('messages_danger','Something went wrong!');	
                      redirect(base_url('Admin_Model','refresh'));	
                    }
                
              }
              else 
              {
    
              }
    
           
          $data['model'] = $this->Admin_Model_Model->getModelData($id);
          $data['specs'] = $this->Admin_Model_Model->getEbikeSpecsData($id);
          $data['colors'] = $this->Admin_Color_Model->getColorData();
          $data['id'] = $id;
          $data['pages'] = 'model/edit';
          $this->load->view('admin/layout/templates',$data);
        }
        else 
        {
          redirect(base_url('Admin_Dashboard'));
        }
    }


    public function fetchAllModel(){
        $result = array('data' => array());

        $models = $this->Admin_Model_Model->getModelData();
        foreach($models as $key=>$value){ 

         $buttons = '';
            $buttons .= '<a href="'.base_url('Admin_Model/edit/'.$value['id']).'" class="btn btn-outline-dark"><i class="fa fa-pencil"></i></a>';	
            $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deleteModel('.$value['id'].')" data-toggle="modal" data-target="#deleteModelModal"><i class="fa fa-trash"></i></button>';
            $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
         
            $set = ($value['set_model'] == 1) ? '<a href="'.base_url('Admin_Model/update_set_model/'.$value['id']).'" class="text-success"><strong>Confirmed</strong></a>' : '<a href="'.base_url('Admin_Model/set_model/'.$value['id']).'" class="text-warning"><strong>Unset</strong></a>';
         
        $result['data'][$key] = array(
            $value['id'],
            $value['name'],
            $value['price'],
            $status,
            $set,
            $buttons,
            );
        }
        echo json_encode($result);
    }


    public function addModel()
    {
      $response = array();
      $this->form_validation->set_rules('model_name', 'Model name', 'trim|required');
      $this->form_validation->set_rules('color', 'Color', 'trim|required');
      $this->form_validation->set_rules('active', 'Active', 'trim|required');

      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

          if ($this->form_validation->run() == TRUE)
          {
            $data = array(
              'model_name' => $this->input->post('model_name'),
              'color_id' => $this->input->post('color'),
              'active' => $this->input->post('active'),	
            );

            $result = $this->Admin_Model_Model->checkModel($model = $this->input->post('model_name'));

            if($result){
                $response['success'] = false;
                $response['messages'] = 'Model is Existing!';		
            }
            else
            {
                $insert = $this->Admin_Model_Model->insertModel($data);
                if($insert == true) {

                $activity = 'Add Model "'. $this->input->post('model_name').'"';
                $this->Helper_Model->system_logs($activity);

                $response['success'] = true;
                $response['messages'] = 'Model Added';
                }
                else
                {
                $response['success'] = false;
                $response['messages'] = 'Something went Wrong!';			
                }
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

    public function getModelById(){
          $id = $this->input->post('id');
           if($id){
             $data = $this->Admin_Model_Model->getModelData($id);
             echo json_encode($data);
            }
            return false;
    }

  public function update_Model($id)
	{
		$response = array();
		if($id) {
      $this->form_validation->set_rules('edit_model_name', 'Model name', 'trim|required');
      $this->form_validation->set_rules('edit_color_id', 'Color', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {

	        	$data = array(
                'model_name' => $this->input->post('edit_model_name'),
                'color_id' => $this->input->post('edit_color_id'),
                'active' => $this->input->post('edit_active'),	
                );
                
            $model = $this->Admin_Model_Model->getModelData($id);  

	        	$update = $this->Admin_Model_Model->updateModel($data , $id);
	        	if($update == true) {

                    $activity = 'Update Model "'.$model['model_name'].'" to "'. $this->input->post('edit_model_name').'"';
                    $this->Helper_Model->system_logs($activity);

	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the Model information';			
	        	}
	        }
          else 
           {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		 }
    else
     {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		 }
		echo json_encode($response);
  }
    
  public function deleteModel(){
          $id = $this->input->post('id');
          $response = array();
          if($id) 
          {
            // check stock  
            $partsStock = $this->Admin_Spareparts_Model->getStockByModelData($id);
            $partsModel = $this->Admin_Spareparts_Model->getSparepartsByModel($id);


            if($partsStock == null || $partsStock == 0 && $partsModel == null || $partsModel == 0)
            {
              $model = $this->Admin_Model_Model->getModelData($id);

              $delete = $this->Admin_Model_Model->removeModel($id);
        
              if($delete == true) {

              $activity = 'Delete Model "'. $model['name'].'"';
              $this->Helper_Model->system_logs($activity);
                  
                $response['success'] = true;
                $response['messages'] = "Successfully removed";	
              }
              else 
              {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the Model information";
              }
            }
            else 
            {
              $response['success'] = false;
              $response['messages'] = "This Model has a stock";
            }

          }
          else 
          {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
          }
          echo json_encode($response);
  }

  public function set_model($id = null){
         if($id)
         {
             
            $this->form_validation->set_rules('yes', '', 'trim|required');
              if($this->form_validation->run() == true){
                 $data = array(
                    'set_model' => 1
                 );
                 $update = $this->Admin_Model_Model->updateSetModel($id, $data);
                 if($update){
                    redirect(base_url('Admin_Model'));
                 }
              }
              else
              {

              }
          
            $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsByModel($id);
            $data['model'] = $this->Admin_Model_Model->getModelData($id);
            $data['generic'] = $this->Admin_Spareparts_Model->getSparepartsData();
            $data['pages'] = 'model/set_model';
            $this->load->view('admin/layout/templates',$data);
         }
         else 
         {
           redirect(base_url('Admin_Model'));
         }
  }

    public function update_set_model($id = null){
        
        if($id){
           
        }
        else
        {
          redirect(base_url('Admin_Model'));
        }
        
        $data['parts'] = $this->Admin_Spareparts_Model->getSparepartsByModel($id);
        $data['model'] = $this->Admin_Model_Model->getModelData($id);
        $data['generic'] = $this->Admin_Spareparts_Model->getSparepartsData();
        $data['pages'] = 'model/update_set_model';
        $this->load->view('admin/layout/templates',$data);
    }

}