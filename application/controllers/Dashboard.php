<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	private $user;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('middlewares/AuthMiddleware');

		$this->authmiddleware->is_signin($this->session);

		$this->user = $this->user_model->get_data(["id" => $this->session->userdata("id")])["data"];
	}

	public function index()
	{
		$user = $this->user_model->get_data(["id" => $this->session->userdata("id")]);

		$get_projects_limit = $this->project_model->get_all_data(["user_id" => $this->session->userdata("id")], 3);
		$get_projects = $this->project_model->get_all_data(["user_id" => $this->session->userdata("id")]);

		$teams_project_limit = array();
		$get_teams_member_limit = $this->teammembers_model->get_all_data(["user_id" => $this->session->userdata("id")], 3);
		if ($get_teams_member_limit['is_success']) {
			foreach ($get_teams_member_limit['data'] as $team_member) {
				$team = $this->team_model->get_data(["id" => $team_member->team_id]);
				$project = $this->project_model->get_data(["id" => $team['data']->project_id])["data"];
				$project->team = $team["data"];
				array_unshift($teams_project_limit, $project);
			}
		}

		$total_teams_project = 0;
		$get_teams_member = $this->teammembers_model->get_all_data(["user_id" => $this->session->userdata("id")]);
		if ($get_teams_member['is_success']) {
			foreach ($get_teams_member['data'] as $team_member) {
				$team = $this->team_model->get_data(["id" => $team_member->team_id]);
				if ($team['is_success'])
					$total_teams_project += 1;
			}
		}

		return $this->load->view("layouts/dashboard/dashboard_layout", [
			"page_info" => [
				"page" => "dashboard_main",
				"title" => "Dashboard"
			],
			"breadcrumb" => [
				"label_home" => "Dashboard",
				"url_home" => "dashboard"
			],
			"projects_limit" => $get_projects_limit['is_success'] ? $get_projects_limit['data'] : null,
			"total_projects" => $get_projects['is_success'] ? count($get_projects['data']) : 0,
			"teams_limit" => count($teams_project_limit) ? $teams_project_limit : null,
			"total_teams" => $total_teams_project,
			"user" => $user['data']
		]);
	}

	public function projects($param = "")
	{
		// detail project
		if (isset($_GET['project']) && !$param) {
			$project = $this->project_model->get_data([
				"user_id" => $this->session->userdata('id'),
				"slug" => $_GET['project']
			]);
			if (!$project['is_success'])
				return redirect(base_url() . 'dashboard/projects');

			$owner_project = $this->user_model->get_data(["id" => $project['data']->user_id]);

			$note = $this->note_model->get_data(["project_id" => $project['data']->id]);

			$team = $this->team_model->get_data([
				"project_id" => $project['data']->id
			]);

			$team_members = array();
			$get_team_members = $this->teammembers_model->get_all_data([
				"team_id" => $team['is_success'] ? $team['data']->id : null
			]);

			if ($get_team_members['is_success']) {
				foreach ($get_team_members['data'] as $member) {
					$user = $this->user_model->get_data(["id" => $member->user_id]);
					array_unshift($team_members, $user['data']->name);
				}
			}

			return $this->load->view("layouts/dashboard/dashboard_layout", [
				"page_info" => array(
					'page' => 'dashboard_project',
					"title" => $project['data']->name
				),
				"breadcrumb" => [
					"label_home" => "Projects",
					"url_home" => "dashboard/projects"
				],
				// data of the currently logged in user
				"user" => $this->user,

				// validation edit project
				"validation_edit_project_errors" => $this->session->flashdata("validation_edit_project_errors"),
				"set_edit_project_value" => $this->session->flashdata("set_edit_project_value"),

				// validation create team
				"validation_create_team_errors" => $this->session->flashdata("validation_create_team_errors"),
				"set_create_team_value" => $this->session->flashdata("set_create_team_value"),

				// validation add note
				"validation_add_note_errors" => $this->session->flashdata("validation_add_note_errors"),
				"set_add_note_value" => $this->session->flashdata("set_add_note_value"),

				// toast
				"toast_success" => $this->session->flashdata("toast_success"),
				"toast_error" => $this->session->flashdata("toast_error"),

				// data detail project
				"project" => $project['data'],
				"note" => $note['is_success'] ? $note['data'] : null,
				"owner_project" => $owner_project['is_success'] ? $owner_project['data']->name : null,
				"team_info" => $team['is_success'] ? array(
					'team' => $team['data'],
					'team_members' => count($team_members) ? $team_members : null
				) : null,

				// this 'users' is form create team
				"users" => $this->user_model->get_all_data(["id " . "!=" => $this->session->userdata('id')])['data'],
			]);
		}

		// detail team project	
		if (isset($_GET['team']) && !$param) {
			$team = $this->team_model->get_data(["id" => $_GET['team']]);
			if (!$team["is_success"])
				return redirect(base_url() . 'dashboard/projects');

			$project = $this->project_model->get_data(["id" => $team['data']->project_id]);
			if (!$project["is_success"])
				return redirect(base_url() . 'dashboard/projects');

			$note = $this->note_model->get_data(["project_id" => $project['data']->id]);

			$owner_project = $this->user_model->get_data(["id" => $project['data']->user_id]);

			$team_members = array();
			$get_team_members = $this->teammembers_model->get_all_data(["team_id" => $team['data']->id]);
			if (!$get_team_members['is_success'])
				return redirect(base_url() . 'dashboard/projects');

			foreach ($get_team_members['data'] as $team_member) {
				$user = $this->user_model->get_data(["id" => $team_member->user_id]);
				array_unshift($team_members, $user['data']->name);
			}

			return $this->load->view("layouts/dashboard/dashboard_layout", [
				"page_info" => [
					"page" => "dashboard_team",
					"title" => $project['data']->name
				],
				"breadcrumb" => [
					"label_home" => "Projects",
					"url_home" => "dashboard/projects"
				],
				"project" => $project['data'],
				"note" => $note['is_success'] ? $note['data'] : null,
				"owner_project" => $owner_project['data']->name,
				"team_info" => $team['is_success'] ? array(
					'team' => $team['data'],
					'team_members' => count($team_members) ? $team_members : null
				) : null,
				// data of the currently logged in user
				"user" => $this->user,
			]);
		}

		// add project
		if ($param) {
			return $this->load->view("layouts/dashboard/dashboard_layout", [
				"page_info" => array(
					'page' => 'dashboard_add_project',
					"title" => "Add Project"
				),
				"breadcrumb" => [
					"label_home" => "Projects",
					"url_home" => "dashboard/projects"
				],
				// validation
				"validation_add_project_errors" => $this->session->flashdata("validation_add_project_errors"),
				"set_add_project_value" => $this->session->flashdata("set_add_project_value"),

				// data of the currently logged in user
				"user" => $this->user,
			]);
		}

		// projects
		$get_projects = $this->project_model->get_all_data(
			['user_id' => $this->session->userdata('id')]
		);

		$teams_project = array();
		$get_teams_member = $this->teammembers_model->get_all_data(["user_id" => $this->session->userdata('id')]);
		if ($get_teams_member['is_success']) {
			foreach ($get_teams_member['data'] as $team_member) {
				$team = $this->team_model->get_data(["id" => $team_member->team_id]);
				$project = $this->project_model->get_data(["id" => $team['data']->project_id])["data"];
				$project->team = $team["data"];
				array_unshift($teams_project, $project);
			}
		}

		return $this->load->view("layouts/dashboard/dashboard_layout", [
			"page_info" => [
				"page" => "dashboard_projects",
				"title" => "Projects"
			],
			"breadcrumb" => [
				"label_home" => "Dashboard",
				"url_home" => "dashboard"
			],
			"projects" => $get_projects['is_success'] ? $get_projects['data'] : [],
			"teams_project" => count($teams_project) ? $teams_project : [],
			// data of the currently logged in user
			"user" => $this->user,
		]);
	}

	public function task($param = "")
	{
		$project_id = $param;
		$project = $this->project_model->get_data(["id" => $project_id]);
		$task = $this->task_model->get_data(["id" => $_GET['id']]);

		$task['data']->start_date = format_date($task['data']->start_date, "Y-m-d H:i:s", "Y-m-d");
		$task['data']->finish_date = format_date($task['data']->finish_date, "Y-m-d H:i:s", "Y-m-d");

		return $this->load->view("layouts/dashboard/dashboard_layout", [
			"page_info" => array(
				"page" => "dashboard_edit_task",
				"title" => $task['data']->name
			),
			"breadcrumb" => array(
				"label_home" => "Projects",
				"url_home" => "projects"
			),
			"user" => $this->user,

			"project" => $project['data'],
			"task" => $task['data'],
			"team_id" => isset($_GET['team_id']) ? $_GET['team_id'] : null,

			// validation
			"validation_task_edit_errors" => $this->session->flashdata("validation_task_edit_errors"),
			"set_task_edit_errors" => $this->session->flashdata("set_task_edit_errors"),

			"toast_success" => $this->session->flashdata("toast_success"),
			"toast_error" => $this->session->flashdata("toast_error"),
		]);
	}

	public function bio()
	{
		if (isset($this->user))
			return redirect(base_url() . "auth/signin");

		return $this->load->view("layouts/dashboard/dashboard_layout", [
			"page_info" => array(
				"page" => "dashboard_bio",
				"title" => "Bio"
			),
			"breadcrumb" => array(
				"label_home" => "Dashboard",
				"url_home" => "dashboard"
			),
			"user" => $this->user,

			"validation_bio_edit_errors" => $this->session->flashdata('validation_bio_edit_errors'),
			"set_bio_edit_value" => $this->session->flashdata('set_bio_edit_value'),

			// toast
			"toast_success" => $this->session->flashdata("toast_success"),
			"toast_error" => $this->session->flashdata("toast_error"),
		]);
	}

	public function account()
	{
		return $this->load->view("layouts/dashboard/dashboard_layout", [
			"page_info" => array(
				"page" => "dashboard_account",
				"title" => "Account"
			),
			"breadcrumb" => array(
				"label_home" => "Dashboard",
				"url_home" => "dashboard"
			),

			// validation
			"validation_update_account_errors" => $this->session->flashdata("validation_update_account_errors"),
			"alert_password" => $this->session->flashdata("alert_password"),
			"set_update_account_value" => $this->session->flashdata("set_update_account_value"),

			// toast
			"toast_success" => $this->session->flashdata("toast_success"),
			"toast_error" => $this->session->flashdata("toast_error"),

			// data of the currently logged in user
			"user" => $this->user,
		]);
	}
}
