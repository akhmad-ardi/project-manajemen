<?php

class TeamMembers_model extends CI_Model
{
	private $table = 'team_members';

	public function create_data($data = [])
	{
		try {
			$team_members_already_exist = $this->db->get_where($this->table, [
				'team_id' => $data['team_id'],
				'user_id' => $data['user_id']
			])->row_array();
			if ($team_members_already_exist)
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

	public function get_all_data($data = [], $limit = NULL)
	{
		try {
			$team_members = $this->db->get_where($this->table, $data, $limit)->result();
			if (!count($team_members))
				throw new Exception('Nothing Team Members', 404);

			return array(
				"is_success" => TRUE,
				"data" => $team_members
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
			$team_member = $this->db->get_where($this->table, $data)->row();
			if (!$team_member)
				throw new Exception("Team member not found", 404);

			return array("is_success" => TRUE, "data" => $team_member);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}

	public function delete_data($data = [])
	{
		try {
			$this->db->delete($this->table, $data);
			return array("is_success" => TRUE, "message" => "Deleted team member success");
		} catch (Exception $e) {
			log_message('error', $e->getMessage());

			return array(
				"is_success" => FALSE,
				"message" => $e->getMessage()
			);
		}
	}
}
