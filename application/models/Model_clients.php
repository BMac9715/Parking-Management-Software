<?php 

class Model_Clients extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getClientData($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM clients WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM clients";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getClientDataByLicensePlate($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM clients WHERE client_license_plate = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM clients";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = '')
	{
		$create = $this->db->insert('clients', $data);
		return ($create == true) ? true : false;
	}

	public function edit($data, $id)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('clients', $data);
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('clients');
		return ($delete == true) ? true : false;
	}

	public function updateClientAvailability($data, $licensePlate)
	{
		if($licensePlate) {
			$this->db->where('client_license_plate', $licensePlate);
			$update = $this->db->update('clients', $data);
			return ($update == true) ? true : false;
		}
	}

	public function getAvailableClientData()
	{
		$sql = "SELECT * FROM clients WHERE availability_status = ? AND active = ?";
		$query = $this->db->query($sql, array(1, 1));
		return $query->result_array();
	}

	public function getAvailableClientMails()
	{
		$sql = "SELECT client_email FROM clients WHERE availability_status = ? AND active = ?";
		$query = $this->db->query($sql, array(1, 1));
		return $query->result_array();
	}

	public function countTotalClients()
	{
		$sql = "SELECT * FROM clients";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}