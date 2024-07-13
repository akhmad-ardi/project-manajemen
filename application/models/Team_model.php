<?php

class Team_model extends CI_Model
{
	private $table = 'team';

	public function create_data($data)
	{
		try {
			$team_already_exist = $this->db->get_where($this->table, [
				'project_id' => $data['project_id'],
			])->row_array();
			if ($team_already_exist)
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

	public function get_all_data($data = [])
	{
		try {
			$teams = $this->db->get_where($this->table, $data)->result();
			if (!count($teams))
				throw new Exception('Nothing team', 404);

			return array(
				"is_success" => TRUE,
				"data" => $teams
			);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function get_data($data = [])
	{
		try {
			$team = $this->db->get_where($this->table, $data)->row();
			if (!$team)
				throw new Exception("Team Not Found", 404);

			return array(
				"is_success" => TRUE,
				"data" => $team
			);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function delete_data($data)
	{
		try {
			$this->db->delete($this->table, $data);
			return array("is_success" => TRUE);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}
}
