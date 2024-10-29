<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Logs extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Logs_Model');
    }

    public function index()
	{
        $data['pages'] = 'logs/index';
        $this->load->view('admin/layout/templates',$data);
    }

    public function fetchLogs(){
        $result = array('data' => array());

        $logs = $this->Admin_Logs_Model->logs();
        foreach($logs as $key=>$value){

        $user = $this->Admin_Logs_Model->getName( $id = $value['user_id']);
        $result['data'][$key] = array(
            $value['id'],
            $value['user'],
            $value['activity'],
            $value['date'],
            $value['time'],
            );
        }
        echo json_encode($result);
    }
}