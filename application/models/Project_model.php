<?php

class Project_model extends CI_Model
{
  private $table = 'project';

  public function create_data($data)
  {
    try {
      $project_already_exist = $this->db->get_where($this->table, [
        'user_id' => $data['user_id'],
        'slug' => $data['slug']
      ])->row_array();
      if ($project_already_exist)
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

  public function get_all_data($data = null)
  {
    try {
      $projects = $this->db->get_where($this->table, $data)->result();
      if (!count($projects))
        throw new Exception('Nothing Project', 404);

      return array(
        "is_success" => TRUE,
        "data" => $projects
      );
    } catch (Exception $e) {
      log_message('error', $e->getMessage());

      return array(
        "is_success" => FALSE,
        "message" => $e->getMessage()
      );
    }
  }

  public function get_data(array $data)
  {
    try {
      $project = $this->db->get_where($this->table, $data)->row();
      if (!$project)
        throw new Exception("Project Not Found", 404);

      return array(
        "is_success" => TRUE,
        "data" => $project
      );
    } catch (Exception $e) {
      log_message('error', $e->getMessage());

      return array(
        "is_success" => FALSE,
        "message" => $e->getMessage()
      );
    }
  }

  public function update_date(string $id, array $data)
  {
    try {
      $project = $this->get_data(["id" => intval($id)]);
      if (!$project['is_success'])
        throw new Exception($project['message']);

      $this->db->update($this->table, $data, ["id" => intval($id)]);
      return array('is_success' => TRUE);
    } catch (Exception $e) {
      log_message('error', $e->getMessage());

      return array(
        "is_success" => FALSE,
        "message" => $e->getMessage()
      );
    }
  }
}
