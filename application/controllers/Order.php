<?php

class Order extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Account_Model');
        $this->load->model('Order_Model');
    }
    public function allorder()
    {
        $result = array();
        $info = $this->Order_Model->allorder();
        foreach($info as $order){
            $result[] = array(
               'order' => $order,
               'items' => $this->Order_Model->allorderItems($order['id'])
            );
            // $result[] = $this->Order_Model->allorderItems($order['id']);
        }
      
        $data['orders'] = $result;

        $data['pages'] = 'account/order/allorder';
        $this->load->view('inc/template',$data);
    }


    public function ready(){
        $result = array();
        $info = $this->Order_Model->allready(2);
        foreach($info as $order){
            $result[] = array(
               'order' => $order,
               'items' => $this->Order_Model->allreadyItems($order['id'])
            );
            // $result[] = $this->Order_Model->allorderItems($order['id']);
        }
        // var_dump($result);
        $data['orders'] = $result;

        $data['pages'] = 'account/order/ready';
        $this->load->view('inc/template',$data);
    }
    public function completed(){
        $result = array();
        $info = $this->Order_Model->allCompleted(3);
        foreach($info as $order){
            $result[] = array(
               'order' => $order,
               'items' => $this->Order_Model->allCompletedItems($order['id'])
            );
            // $result[] = $this->Order_Model->allorderItems($order['id']);
        }
        // var_dump($result);
        $data['orders'] = $result;
        $data['pages'] = 'account/order/completed';
        $this->load->view('inc/template',$data);
    }
    public function cancelled(){
        $result = array();
        $info = $this->Order_Model->allCancelled(4);
        foreach($info as $order){
            $result[] = array(
               'order' => $order,
               'items' => $this->Order_Model->allCancelledItems($order['id'])
            );
            // $result[] = $this->Order_Model->allorderItems($order['id']);
        }
        // var_dump($result);
        $data['orders'] = $result;
        $data['pages'] = 'account/order/cancelled';
        $this->load->view('inc/template',$data);
    }
}