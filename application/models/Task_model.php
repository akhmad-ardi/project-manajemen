<?php

class Task_model extends CI_Model
{
	private $table = 'task';

	public function create_data(array $data = [])
	{
		try {
			$task_already_exist = $this->db->get_where($this->table, [
				'project_id' => $data['project_id'],
				'name' => $data['name']
			])->row_array();
			if ($task_already_exist)
				throw new Exception($data['name'] . " Already Exist", 400);

			$this->db->insert($this->table, $data);
			return array("is_success" => TRUE);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function get_all_data(array $data = [])
	{
		try {
			$tasks = $this->db->get_where($this->table, $data)->result();
			if (!count($tasks))
				throw new Exception('Nothing Task', 404);

			return array(
				"is_success" => TRUE,
				"data" => $tasks
			);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function get_data(array $data = [])
	{
		try {
			$task = $this->db->get_where($this->table, $data)->row();
			if (!$task)
				throw new Exception('Nothing Task', 404);

			return array("is_success" => TRUE, "data" => $task);
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
		try {
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);

			return array("is_success" => TRUE, "message" => "Update task success");
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function delete_data($id)
	{
		try {
			$task = $this->get_data(["id" => $id]);
			if (!$task['is_success'])
				throw new Exception($task['message'], 404);

			$this->db->delete($this->table, ["id" => $task['data']->id]);
			return array(
				"is_success" => TRUE,
				"message" => "Deleted task success"
			);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function finish_unfinish_data($id)
	{
		try {
			$task = $this->get_data(["id" => $id]);
			if (!$task['is_success'])
				throw new Exception($task['message']);

			return $this->update_data($id, ["status" => $task['data']->status == 'selesai' ? 'belum selesai' : 'selesai']);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function process_unprocess_data($id)
	{
		try {
			$task = $this->get_data(["id" => $id]);
			if (!$task['is_success'])
				throw new Exception($task['message']);

			return $this->update_data($id, ["status" => $task['data']->status == "proses" ? "belum selesai" : "proses"]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}
}
