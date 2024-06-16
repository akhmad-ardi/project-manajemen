<?php

class User_model extends CI_Model
{
  private $table = 'user';

  public function create_data(array $data)
  {
    try {
      $user_already_exist = $this->db->get_where($this->table, ['email' => $data['email']])->row_array();
      if ($user_already_exist)
        throw new Exception("User Already Exist", 400);

      $this->db->insert($this->table, $data);

      return ["is_success" => TRUE, "message" => "You Are Registered"];
    } catch (Exception $e) {
      log_message('error', $e->getMessage());

      return ["is_success" => FALSE, "message" => $e->getMessage()];
    }
  }

  public function get_data(array $data)
  {
    try {
      $get_user = $this->db->get_where($this->table, $data)->row();
      if (!$get_user)
        throw new Exception("User Not Found", 404);

      return ["is_success" => TRUE, "data" => $get_user];
    } catch (Exception $e) {
      log_message("error", $e->getMessage());

      return ["is_success" => FALSE, "message" => $e->getMessage()];
    }
  }

  public function get_all_data()
  {
    try {
      $get_all_user = $this->db->get($this->table)->result();
      if (!count($get_all_user))
        throw new Exception('Nothing User', 404);

      return ["is_success" => TRUE, "data" => $get_all_user];
    } catch (Exception $e) {
      log_message('error', $e->getMessage());
      return ["is_success" => FALSE, "message" => $e->getMessage()];
    }
  }

  public function update_data(int $id, array $data)
  {
    try {
      $get_user = $this->get_data(["id" => $id]);
      if ($get_user['is_success'] >= 400)
        throw new Exception($get_user['message'], $get_user['is_success']);

      $this->db->update($this->table, $data, ["id" => $id]);

      return ["is_success" => TRUE, "message" => "Updated User"];
    } catch (Exception $e) {
      log_message('error', $e->getMessage());

      return ["is_success" => FALSE, "message" => $e->getMessage()];
    }
  }
}
