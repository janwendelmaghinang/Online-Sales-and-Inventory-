<?php

class Spareparts_Model extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
    }
    // fetch
   
    public function getSpareparts($fModel = null, $squery = null, $fSort = null)
    {
        $sql = "SELECT * FROM ebike_parts_tbl $fModel $squery $fSort ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    // by id
    public function getPartsStock($id = null)
    {
        $sql = "SELECT * FROM parts_stock_tbl WHERE parts_id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getPartsQty($id = null, $parts_id = null)
    {
        $sql = "SELECT * FROM parts_stock_tbl WHERE id = $id AND parts_id = $parts_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    

    // get single
    public function getSingleParts($id){
        $query = $this->db->query("SELECT * FROM ebike_parts_tbl WHERE id = '$id'");
        return $query->row_array();
    }

    public function getPartsStockByColor($id = null, $color)
    {
        $sql = "SELECT * FROM parts_stock_tbl WHERE parts_id = $id AND color_id = $color";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    // extra 
    public function getColorInStock($id = null)
    {
        $sql = "SELECT * FROM ebike_color_tbl WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
}