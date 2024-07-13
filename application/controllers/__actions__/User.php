<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('middlewares/AuthMiddleware');

		$this->authmiddleware->is_signin($this->session);
	}

	public function update_bio()
	{
		$this->validate_method("dashboard/account", "post", "patch");

		try {
			$this->form_validation->set_rules("name", "Name", ["required", "min_length[4]"]);
			$this->form_validation->set_rules("email", "Email", ["required", "valid_email"]);

			if (!$this->form_validation->run())
				throw new Exception("validation error");

			$email_already_exist = $this->user_model->get_data(["email" => $this->input->post("email"), "id !=" => $this->session->userdata("id")]);
			if ($email_already_exist['is_success'])
				throw new Exception($email_already_exist['data']->email . " already exist", 400);

			$update_user = $this->user_model->update_data($this->session->userdata("id"), [
				"name" => $this->input->post("name"),
				"email" => $this->input->post("email")
			]);
			if (!$update_user['is_success'])
				throw new Exception($update_user['message'], 404);

			$this->session->set_flashdata("toast_success", "Bio updated");
			return redirect(base_url() . "dashboard/bio");
		} catch (Exception $e) {
			log_message("error", $e->getMessage());
			$validation_errors = $this->form_validation->error_array();
			if (count($validation_errors))
				$this->session->set_flashdata("validation_bio_edit_errors", $validation_errors);

			if ($e->getCode() >= 400)
				$this->session->set_flashdata("validation_bio_edit_errors", ["alert_error" => $e->getMessage()]);

			$this->session->set_flashdata("set_bio_edit_value", [
				"name" => set_value("name"),
				"email" => set_value("email"),
			]);

			return redirect(base_url() . "dashboard/bio");
		}
	}

	public function update_account()
	{
		$this->validate_method('dashboard/account', 'post', 'patch');

		try {
			$this->form_validation->set_rules("old_password", "Old Password", ["required", "min_length[6]"]);
			$this->form_validation->set_rules("new_password", "New Password", ["required", "min_length[6]"]);
			$this->form_validation->set_rules("confirm_password", "Confirm Password", ["required", "min_length[6]", "matches[new_password]"]);

			if (!$this->form_validation->run())
				throw new Exception('validation error');

			$user = $this->user_model->get_data(["id" => $this->session->userdata("id")]);
			if (!$user['is_success'])
				throw new Exception($user['message'], 404);

			if (!password_verify($this->input->post("old_password"), $user['data']->password))
				throw new Exception("Old password is invalid", 400);

			$update_account = $this->user_model->update_data($this->session->userdata("id"), [
				"password" => password_hash($this->input->post("new_password"), PASSWORD_BCRYPT)
			]);
			if (!$update_account['is_success'])
				throw new Exception($update_account['message'], 404);

			$this->session->set_flashdata("toast_success", "Account updated");
			return redirect(base_url() . "dashboard/account");
		} catch (Exception $e) {
			log_message("debug", $e->getMessage());
			$validation_errors = $this->form_validation->error_array();
			if (count($validation_errors))
				$this->session->set_flashdata("validation_update_account_errors", $validation_errors);

			if ($e->getCode() == 400)
				$this->session->set_flashdata("alert_password", $e->getMessage());

			$this->session->set_flashdata("set_update_account_value", [
				"old_password" => set_value("old_password"),
				"new_password" => set_value("new_password"),
				"confirm_password" => set_value("confirm_password"),
			]);

			return redirect(base_url() . "dashboard/account");
		}
	}

	private function validate_method($redirect = "", $method = null, $_method = null)
	{
		if ($this->input->method() != $method || (isset($_method) && $this->input->post("_method") != $_method))
			return redirect(base_url() . $redirect);
	}
}
