<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


    class Table_test extends CI_Controller
{
    public $nama_template="template_admin";

    function __construct()
    {
        parent::__construct();
        $this->load->model('Table_test_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load($this->nama_template,'table_test/table_test_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Table_test_model->json();
    }

    public function read($id) 
    {
        $row = $this->Table_test_model->get_by_id($id);
        if ($row) {
            $x = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'no_hp' => $row->no_hp,
	    );
            $data['d_vue']=$x;
            $this->template->load($this->nama_template,'table_test/table_test_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('table_test'));
        }
    }

    public function create() 
    {
        $data = array(
        'button' => 'Create',
        'action' => base_url('table_test/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'no_hp' => set_value('no_hp'),
	);
        
        $this->template->load($this->nama_template,'table_test/table_test_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo('Gagal');
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
	    );

            $this->Table_test_model->insert($data);
            echo('Create Record Success');
            //redirect(base_url('table_test'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Table_test_model->get_by_id($id);

        if ($row) {
            $x = array(
                'button' => 'Update',
                'action' => base_url('table_test/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'no_hp' => set_value('no_hp', $row->no_hp),
	    );
            $data['d_vue']=$x;
            $this->template->load($this->nama_template,'table_test/table_test_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('table_test'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
	    );

            $this->Table_test_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('table_test'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Table_test_model->get_by_id($id);

        if ($row) {
            $this->Table_test_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            //redirect(base_url('table_test'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(base_url('table_test'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "table_test.xls";
        $judul = "table_test";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");

	foreach ($this->Table_test_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->no_hp);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Table_test.php */
/* Location: ./application/controllers/Table_test.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 10:40:36 */
/* http://harviacode.com */