<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Cart_Model');   
    }
    public function index()
	{
   //     var_dump($this->cart->contents());
		$data['pages'] = 'cart/index';
		$this->load->view('inc/template',$data); 
    }
    
    public function addtocart(){

  
        $response = array();
        $data = array(
            'id' => $this->input->post('id'),
            'name' =>  $this->input->post('name'),
            'qty' => $this->input->post('quantity'),
            'price' =>  $this->input->post('price'),
            'model_id' => $this->input->post('model'),
            'image' => $this->input->post('image'),
            'options' => array('color'=> $this->input->post('color_id'))
        ); 
        $inserted = $this->cart->insert($data);
        if($inserted){
            $response['success'] = true;
        }
        echo json_encode($response);
    }
    public function cartCount(){
        $response =count($this->cart->contents());
        echo json_encode($response);
    }
    public function remove(){
       
       $response = array();
       
       $remove = $this->cart->remove($_POST['row_id']);
       if($remove == true){
            $response['success'] = true;
            $response['message'] = 'Items Successfully Remove';
       }
       else 
       {
            $response['success'] = false;
            $response['message'] = 'Failed';
       }
       echo json_encode($response);
    }
}