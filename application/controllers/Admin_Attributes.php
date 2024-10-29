<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Attributes extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Color_Model');
        $this->load->model('Admin_Model_Model');
        $this->load->model('Helper_Model');
    }

    public function index()
	{
        $data['pages'] = 'attributes/index';
        $this->load->view('admin/layout/templates',$data);
    }
    // ------------------------
    public function color()
	{
        $data['pages'] = 'attributes/color';
        $this->load->view('admin/layout/templates',$data);
    }
    public function fetchAllColor(){
        $result = array('data' => array());

        $colors = $this->Admin_Color_Model->getColorData();
        foreach($colors as $key=>$value){

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="editColor('.$value['id'].')" data-toggle="modal" data-target="#editColorModal"><i class="fa fa-pencil"></i></button>';	
            $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deleteColor('.$value['id'].')" data-toggle="modal" data-target="#deleteColorModal"><i class="fa fa-trash"></i></button>';
            $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $result['data'][$key] = array(
            $value['id'],
            $value['color_name'],
            // $value['color_description'],
            $status,
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function addColor()
    {
      $response = array();
      $this->form_validation->set_rules('color_name', 'color name', 'trim|required');
      $this->form_validation->set_rules('active', 'Active', 'trim|required');
      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');


          if ($this->form_validation->run() == TRUE)
          {
            $data = array(
              'color_name' => $this->input->post('color_name'),
              'active' => $this->input->post('active'),	
            );
            
            $result = $this->Admin_Color_Model->checkColor($data['color_name']);
            
            if($result){
                $response['success'] = false;
                $response['messages'] = 'Color is Existing';
            }
            else
            {
                $insert = $this->Admin_Color_Model->insertColor($data);
                if($insert == true) {

                $activity = 'Add Color "'. $this->input->post('color_name').'"';
                $this->Helper_Model->system_logs($activity);
                
                $response['success'] = true;
                $response['messages'] = 'Color Added';
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

    public function getColorById(){
        $id = $this->input->post('id');
          if($id){
            $data = $this->Admin_Color_Model->getColorData($id);
            echo json_encode($data);
          }
          return false;
    }

    public function update_Color($id)
	{
		$response = array();
		if($id) {
			$this->form_validation->set_rules('edit_color_name', 'color name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
                'color_name' => $this->input->post('edit_color_name'),
                'active' => $this->input->post('edit_active'),	
                );
                
                $name = $this->Admin_Color_Model->getColorData($id);

	        	$update = $this->Admin_Color_Model->updateColor($data , $id);
	        	if($update == true) {

                    $activity = 'Update Color "'.$name['color_name'].'" to "'. $this->input->post('edit_color_name').'"';
                    $this->Helper_Model->system_logs($activity);

	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
                else
                 {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the color information';			
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
    
    public function deleteColor(){
          $id = $this->input->post('id');
          $response = array();

          if($id) 
          {
            $name = $this->Admin_Color_Model->getColorData($id);
            $delete = $this->Admin_Color_Model->removeColor($id);
         
            if($delete == true) {
 
            
            $activity = 'Delete Color "'. $name['color_name'].'"';
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

    // -------------------------
    public function Model()
	{
        $data['pages'] = 'attributes/Model';
        $this->load->view('admin/layout/templates',$data);
    }
    public function fetchAllModel(){
        $result = array('data' => array());

        $models = $this->Admin_Model_Model->getModelData();
        foreach($models as $key=>$value){

         $buttons = '';
            $buttons .= '<button type="button" class="btn btn-outline-dark" onclick="editModel('.$value['id'].')" data-toggle="modal" data-target="#editModelModal"><i class="fa fa-pencil"></i></button>';	
            $buttons .= ' <button type="button" class="btn btn-outline-dark" onclick="deleteModel('.$value['id'].')" data-toggle="modal" data-target="#deleteModelModal"><i class="fa fa-trash"></i></button>';
            $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
   
        $result['data'][$key] = array(
            $value['id'],
            $value['model_name'],
            // $value['Model_description'],
            $status,
            $buttons,
            );
        }
        echo json_encode($result);
    }

    public function addModel()
    {
      $response = array();
      $this->form_validation->set_rules('Model_name', 'Model name', 'trim|required');
      $this->form_validation->set_rules('active', 'Active', 'trim|required');
      $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

          if ($this->form_validation->run() == TRUE)
          {
            $data = array(
              'Model_name' => $this->input->post('Model_name'),
              'active' => $this->input->post('active'),	
            );

            $result = $this->Admin_Model_Model->checkModel($model = $this->input->post('Model_name'));

            if($result){
                $response['success'] = false;
                $response['messages'] = 'Model is Existing!';		
            }
            else
            {
                $insert = $this->Admin_Model_Model->insertModel($data);
                if($insert == true) {

                $activity = 'Add Model "'. $this->input->post('Model_name').'"';
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
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
                'model_name' => $this->input->post('edit_model_name'),
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
            $model = $this->Admin_Model_Model->getModelData($id);

            $delete = $this->Admin_Model_Model->removeModel($id);
      
            if($delete == true) {

            $activity = 'Delete Model "'. $model['model_name'].'"';
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
            $response['messages'] = "Refersh the page again!!";
          }
          echo json_encode($response);
      }

}