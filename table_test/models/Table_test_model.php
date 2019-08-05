<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Table_test_model extends CI_Model
{

    public $table = 'table_test';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,nama,alamat,no_hp');
        $this->datatables->from('table_test');
        //add this line for join
        //$this->datatables->join('table2', 'table_test.field = table2.field');
        $this->datatables->add_column('action', anchor(base_url('table_test/read/$1'),'<button class="btn btn-primary btn-sm"><i class="fa fa-angle-right"></i> Lihat</button>')." 
                                                ".anchor(base_url('table_test/update/$1'),'<button class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Ubah</button>')." 
                                                ".anchor(base_url('table_test/delete/$1'),'<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Table_test_model.php */
/* Location: ./application/models/Table_test_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 10:40:36 */
/* http://harviacode.com */