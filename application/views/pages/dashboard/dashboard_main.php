<div class="row row-cols-1 row-cols-md-3">
	<!-- total projects -->
	<div class="col mb-3 mb-md-0">
		<div class="card shadow-sm w-100">
			<div class="card-body pt-4 pb-3">
				<h3 class="card-title fw-bold mb-4">
					<i class="bi bi-file-text p-2 rounded-3 bg-primary bg-opacity-50 me-2"></i>
					Total Projects
				</h3>
				<div class="d-flex justify-content-between align-items-center">
					<p class="card-text fs-4 m-0"><?= $total_projects ?></p>
					<span>
						<a href="<?= base_url() . 'dashboard/projects' ?>"
							class="badge badge text-bg-primary stretched-link">View
							all projects</a>
					</span>
				</div>
			</div>
		</div>
	</div>

	<!-- total teams -->
	<div class="col mb-3 mb-md-0">
		<div class="card shadow-sm w-100">
			<div class="card-body pt-4 pb-3">
				<h3 class="card-title fw-bold mb-4">
					<i class="bi bi-person p-2 rounded-3 bg-primary bg-opacity-50 me-2"></i>
					Total Teams
				</h3>
				<div class="d-flex justify-content-between align-items-center">
					<p class="card-text fs-4 m-0"><?= $total_teams ?></p>
					<span>
						<a href="<?= base_url() . 'dashboard/projects' ?>"
							class="badge badge text-bg-primary stretched-link">View
							all teams</a>
					</span>
				</div>
			</div>
		</div>
	</div>

	<!-- profile -->
	<div class="col">
		<div class="card shadow-sm w-100">
			<div class="card-body pt-4 pb-3">
				<h3 class="card-title fw-bold mb-4">
					<i class="bi bi-person p-2 rounded-3 bg-primary bg-opacity-50 me-2"></i>
					Profile
				</h3>
				<div class="d-flex justify-content-between align-items-center">
					<p class="card-text fs-4 m-0"><?= $user->name ?></p>
					<span class="d-flex">
						<a href="<?= base_url() . 'dashboard/bio' ?>" class="badge badge text-bg-primary me-1">Bio</a>
						<a href="<?= base_url() . 'dashboard/account' ?>" class="badge badge text-bg-primary">Account</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<h3 class="text-center text-decoration-underline fw-bold mt-5 mb-4">Project</h3>

<?php if (isset($projects_limit)): ?>
	<div class="row row-cols-1 row-cols-md-3 mb-4">
		<?php foreach ($projects_limit as $project): ?>
			<?php $this->load->view('components/dashboard/project/dashboard_card', ["project" => $project, "team_project" => null]) ?>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<h4 class="text-center mb-4">Nothing Project</h4>
<?php endif; ?>

<h3 class="text-center text-decoration-underline fw-bold mt-5 mb-4">Teams</h3>

<?php if (isset($teams_limit)): ?>
	<div class="row row-cols-1 row-cols-md-3">
		<?php foreach ($teams_limit as $team): ?>
			<?php $this->load->view('components/dashboard/project/dashboard_card', ["project" => null, "team_project" => $team]) ?>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<h4 class="text-center mb-4">Nothing Teams</h4>
<?php endif; ?>

<div class="row justify-content-center">
	<div class="col-md-3">
		<a href="<?= base_url() . 'dashboard/projects' ?>" class="btn btn-primary mx-auto mt-3 w-100">Lihat Lebih
			Banyak</a>
	</div>
</div>