<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/Dashboard
     *	- or -
     * 		http://example.com/index.php/Dashboard/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/Dashboard/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('record_model');
    }

    public function index($query)
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('search', 'Search', 'required');

        $data['query'] = $query;
        $data['results'] = $this->record_model->searchRecords($query);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('searched_records', $data);
        } else {
            $this->searchRecords();
        }
    }

    public function searchRecords()
    {
        $query = $this->input->post('search');
        redirect('index.php/search/' . $query);
    }
}
