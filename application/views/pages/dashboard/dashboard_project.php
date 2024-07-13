<div class="row row-cols-md-2 row-cols-1">
	<!-- Project Info -->
	<div class="col mb-2 mb-md-0">
		<div class="card shadow-sm">
			<div class="card-body">
				<h4 class="card-title"><?= $page_info['title'] ?></h4>
				<h6 class="card-subtitle mb-3">
					<?= format_date($project->start_date) ?> -
					<?= format_date($project->finish_date) ?>
				</h6>
				<p><?= $project->description ?></p>

				<div class="d-flex justify-content-between">
					<div>
						<!-- note project -->
						<?php if ($note): ?>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noteModal">
								<i class="bi bi-card-text fs-5 me-1"></i>
								<span>Note</span>
							</button>

							<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_note', ['note' => $note]) ?>
						<?php else: ?>
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNoteModal">
								<i class="bi bi-plus fs-5 me-1"></i>
								<span>Add Note</span>
							</button>

							<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_add_note', ["project" => $project]) ?>
						<?php endif ?>

						<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
							data-bs-target="#addTaskModal">
							<i class="bi bi-plus fs-5 me-1"></i>
							Add Task
						</button>

						<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_add_task', ['project' => $project]) ?>
					</div>

					<div>
						<!-- dropdown -->
						<div class="dropdown">
							<button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-three-dots-vertical fs-5"></i>
							</button>
							<ul class="dropdown-menu">
								<li>
									<button type="button" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal"
										data-bs-target="#editProjectModal">
										<i class="bi bi-pencil me-1"></i>
										<span>Edit</span>
									</button>
								</li>
								<li>
									<button type="button" class="dropdown-item text-danger fw-bold d-flex align-items-center"
										data-bs-toggle="modal" data-bs-target="#deleteProjectModal">
										<i class="bi bi-trash me-1"></i>
										<span>Delete</span>
									</button>
								</li>
							</ul>
						</div>
						<!-- modal edit project -->
						<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_edit_project', ["project" => $project]) ?>
						<!-- modal delete project -->
						<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_delete_project', ["project" => $project]) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Project Team -->
	<div class="col">
		<?php if (isset($team_info['team'])): ?>
			<div class="card shadow-sm">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="card-title">Team Name: <?= $team_info['team']->name ?></h4>

						<!-- dropdown -->
						<div class="dropdown">
							<button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-three-dots-vertical fs-5"></i>
							</button>
							<ul class="dropdown-menu">
								<li>
									<button type="button" class="dropdown-item text-danger fw-bold d-flex align-items-center"
										data-bs-toggle="modal" data-bs-target="#deleteTeamModal">
										<i class="bi bi-trash me-1"></i>
										<span>Delete</span>
									</button>
								</li>
							</ul>
						</div>
						<!-- modal delete team -->
						<?php $this->load->view("components/dashboard/project/modals/dashboard_modal_delete_team") ?>

					</div>
					<h6 class="card-subtitle mb-3"><?= count($team_info['team_members']) + 1 ?> members</h6>

					<ul class="list-group">
						<li class="list-group-item"><?= $owner_project ?> <span class="badge bg-primary">owner</span></li>
						<?php foreach ($team_info['team_members'] as $member): ?>
							<li class="list-group-item"><?= $member ?></li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
		<?php else: ?>
			<div class="card shadow-sm h-100">
				<div class="card-body d-flex justify-content-center align-items-center">
					<button class="btn btn-primary stretched-link" type="button" data-bs-toggle="modal"
						data-bs-target="#createTeamModal">
						<i class="bi bi-plus me-1 fs"></i>
						Create Team
					</button>

					<!-- Modal Create Team -->
					<?php $this->load->view('components/dashboard/project/modals/dashboard_modal_create_team', ["project" => $project]) ?>
				</div>
			</div>
		<?php endif ?>
	</div>
</div>
<!-- Tasks -->
<div class="row mt-3">
	<div class="col">
		<div class="card shadow-sm">

			<!-- Table Task -->
			<?php $this->load->view('components/dashboard/project/dashboard_table_task', ['project' => $project]) ?>
		</div>
	</div>
</div>