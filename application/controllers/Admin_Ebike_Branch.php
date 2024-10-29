<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Ebike_Branch extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Model_Model');
        $this->load->model('Admin_Ebike_Model');
        $this->load->model('Admin_Ebike_Branch_Model');
        $this->load->model('Admin_Color_Model');
        $this->load->model('Admin_Store_Model');
    }

    public function index()
    {
        $data['pages'] = 'ebikebranch/index';
        $this->load->view('admin/layout/templates', $data);
    }

    public function getEbikeById()
    {

        $id = $this->input->post('id');
        if ($id) {
            $data['units'] = $this->Admin_Ebike_Model->getEbikeData($id);
            $data['color'] = $this->Admin_Color_Model->getColorData($data['units']['color_id']);
            // $data['store'] = $this->Admin_Store_Model->getStoreData($data['units']['store_id']);
            $data['ebike'] = $this->Admin_Ebike_Model->getEbikeData($id);
            $data['specs'] = $this->Admin_Ebike_Model->getEbikeSpecsData($id);
            echo json_encode($data);
        }
        return false;
    }

    public function fetchAllEbikeBranchData()
    {

        $result = array('data' => array());

        $data = $this->Admin_Ebike_Branch_Model->getEbikeBranchData();

        foreach ($data as $key => $value) {

            $unit = $this->Admin_Ebike_Model->getEbikeData($value['unit_id']);
            $color = $this->Admin_Color_Model->getColorData($unit['color_id']);
            $store = $this->Admin_Store_Model->getStoreData($value['store_id']);


            $buttons = '';
            $buttons .= '<a href="' . base_url('Admin_Ebike/edit/' . $value['id']) . '" class="btn btn-outline-dark"><i class="fa fa-pencil"></i></a>';

            $status = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="label badge badge-danger">Inactive</span>';


            $qty_status = '';
            if ($value['quantity'] <= $value['stock_critical']) {
                $qty_status = '<span class="badge" style="background: orange; " >Critical Level</span>';
            }
            if ($value['quantity'] == 0) {
                $qty_status = '<span class="badge" style="background: red; " >Out of stock</span>';
            }



            $result['data'][$key] = array(
                $value['id'],
                $unit['name'],
                $value['quantity'] . ' ' . $qty_status,
                $value['stock_critical'],
                $color['color_name'],
                $store['store_name'],
                $status,
                $buttons
            );
        }
        echo json_encode($result);
    }

    public function create()
    {
        $this->form_validation->set_rules('unit_id', 'Unit', 'trim|required');
        $this->form_validation->set_rules('store_id', 'store', 'trim|required');
        $this->form_validation->set_rules('stock_critical', 'Critical level', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'unit_id' => $this->input->post('unit_id'),
                'store_id' => $this->input->post('store_id'),
                'stock_critical' => $this->input->post('stock_critical'),
                'active' => $this->input->post('active')
            );
            $insert = $this->Admin_Ebike_Branch_Model->insertEbike($data);
            if ($insert) {
                redirect(base_url('Admin_Ebike_Branch'));
            }
        } else {
        }

        $data['units'] = $this->Admin_Ebike_Model->getEbikeData();
        $data['stores'] = $this->Admin_Store_Model->getStoreData();
        $data['pages'] = 'ebikebranch/create';
        $this->load->view('admin/layout/templates', $data);
    }
    public function edit($id)
    {
        if ($id) {
            $data['specs'] = $this->Admin_Ebike_Model->getEbikeSpecsData($id);
            $data['units'] = $this->Admin_Ebike_Model->getEbikeData($id);
            $data['models'] = $this->Admin_Model_Model->getModelData();
            $data['pages'] = 'ebike/edit';
            $this->load->view('admin/layout/templates', $data);
        }
    }
}
