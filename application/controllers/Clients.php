<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Clients';
		$this->load->model('model_clients');
	}


	public function index()
	{

		if(!in_array('viewClients', $this->permission)) {
			redirect('dashboard', 'refresh');
		}


		$client_data = $this->model_clients->getClientData();
		$this->data['client_data'] = $client_data;


		$this->render_template('clients/index', $this->data);
	}

	public function create()
	{

		if(!in_array('createClients', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$this->form_validation->set_rules('client_name', 'Client Name', 'required');
		$this->form_validation->set_rules('client_license_plate', 'Client License Plate', 'required');
		$this->form_validation->set_rules('client_email', 'Client License Plate', 'required');
		$this->form_validation->set_rules('billing_date', 'Billing Date', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		
        if ($this->form_validation->run() == TRUE) {
			$date = date_create_from_format('Y/m/d', $this->input->post('billing_date'));

            // true case
        	$data = array(
				'client_name' => $this->input->post('client_name'),
				'client_license_plate' => $this->input->post('client_license_plate'),
				'client_email' => $this->input->post('client_email'),
				'billing_date' => $date->format('Y-m-d'),
        		'active' => $this->input->post('status'),
        		'availability_status' => 1
        	);

        	$create = $this->model_clients->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('clients/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('clients/create', 'refresh');
        	}
        }
        else {
        	$this->render_template('clients/create', $this->data);	
        }
		
	}

	public function edit($id = null)
	{
		if(!in_array('updateClients', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			$this->form_validation->set_rules('client_name', 'Client Name', 'required');
			$this->form_validation->set_rules('client_license_plate', 'Client License Plate', 'required');
			$this->form_validation->set_rules('client_email', 'Client License Plate', 'client_email');
			$this->form_validation->set_rules('status', 'Status', 'required');

	        if ($this->form_validation->run() == TRUE) {
	            // true case
	        	$data = array(
					'client_name' => $this->input->post('client_name'),
					'client_license_plate' => $this->input->post('client_license_plate'),
					'client_email' => $this->input->post('client_email'),
	        		'active' => $this->input->post('status'),
	        		'availability_status' => 1
	        	);

	        	$update = $this->model_clients->edit($data, $id);
	        	if($update == true) {
	        		$this->session->set_flashdata('success', 'Successfully updated');
	        		redirect('clients/', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('clients/edit/'.$id, 'refresh');
	        	}
	        }
	        else {
	            // false case
	            $client_data = $this->model_clients->getClientData($id);
				$this->data['client_data'] = $client_data;
				$this->render_template('clients/edit', $this->data);	
	        }

			
		}
		
	}

	public function delete($id = null)
	{
		if(!in_array('deleteClients', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		if($id) {
			if($this->input->post('confirm')) {

				// $check = $this->model_groups->existInUserGroup($id);
				// if($check == true) {
				// 	$this->session->set_flashdata('error', 'Group exists in the users');
	   //      		redirect('category/', 'refresh');
				// }
				// else {
					$delete = $this->model_clients->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('clients/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('clients/delete/'.$id, 'refresh');
		        	}
				// }	
			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('clients/delete', $this->data);	
			}	
		}
		
	}

}