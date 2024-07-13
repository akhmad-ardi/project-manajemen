<?php

class Note_model extends CI_Model
{
	private $table = 'note';

	public function create_data($data)
	{
		try {
			$note_already_exist = $this->db->get_where($this->table, [
				'project_id' => $data['project_id'],
			])->row_array();
			if ($note_already_exist)
				throw new Exception($data['title'] . " Already Exist", 400);

			$this->db->insert($this->table, $data);
			return array("is_success" => TRUE);
		} catch (Exception $e) {
			log_message('error', 'create note model: ' . $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function get_data(array $data)
	{
		try {
			$note = $this->db->get_where($this->table, $data)->row();
			if (!$note)
				throw new Exception("Note Not Found", 404);

			return array(
				"is_success" => TRUE,
				"data" => $note
			);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function update_data($id, array $data)
	{

	}

	public function delete_data(array $data = [])
	{
		try {
			$note = $this->get_data($data);
			if (!$note['is_success'])
				throw new Exception($note['message']);

			$this->db->delete($this->table, $data);
			return array(
				"is_success" => TRUE,
				"message" => "Deleted note success"
			);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}
}
