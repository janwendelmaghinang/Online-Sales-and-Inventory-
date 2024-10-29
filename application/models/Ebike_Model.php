<?php

class Ebike_Model extends CI_Model
{
    public function __construct()
    {
        parent:: __construct();
    }
    public function getEbike(){
        $query = $this->db->query("SELECT * FROM ebike_stock_tbl");
        return $query->result_array();
    }

    // model
    public function getModelData($fModel = null, $squery = null, $fSort = null)
    {
        $sql = "SELECT * FROM ebike_model_tbl $fModel $squery $fSort ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

     public function getModelDataById($id){
        $query = $this->db->query("SELECT * FROM ebike_model_tbl WHERE id = $id");
        return $query->row_array();
     }

     public function getModelSpecsById($id){
        $query = $this->db->query("SELECT * FROM ebike_specification_tbl WHERE model_id = $id");
        return $query->row_array(); 
     }

     public function getEbikeStock($id = null ){
        $query = $this->db->query("SELECT * FROM ebike_stock_tbl where model_id = $id");
        return $query->result_array();
    }
    public function getEbikeByColor($id, $color = null ){
        $query = $this->db->query("SELECT * FROM ebike_stock_tbl where model_id = $id AND color_id =  $color ");
        return $query->row_array();
    }
    public function getEbikeStockItems($id = null ){
        $query = $this->db->query("SELECT * FROM ebike_stock_items where ebike_stock_id = $id AND status = 1");
        return $query->result_array();
    }

}