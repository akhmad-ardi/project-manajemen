<div class="row row-cols-1 row-cols-md-3 g-3">
	<?php foreach ($projects as $project): ?>
		<?php $this->load->view('components/dashboard/project/dashboard_card', ['project' => $project]) ?>
	<?php endforeach; ?>

	<div class="col">
		<div class="card h-100">
			<div class="card-body d-grid align-items-center">
				<div class="text-center">
					<a href="<?= base_url() . "dashboard/projects/add" ?>" class="btn btn-primary stretched-link">
						<i class="bi bi-plus fs-4"></i>
						Add Project
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<h3 class="mt-5 mb-3">Teams</h3>
<?php if (count($teams_project)): ?>
	<div class="row row-cols-1 row-cols-md-3 g-3">
		<?php foreach ($teams_project as $team_project): ?>
			<?php $this->load->view('components/dashboard/project/dashboard_card', ['project' => null, 'team_project' => $team_project]) ?>
		<?php endforeach; ?>
	</div>
<?php else: ?>
	<div class="row row-cols-1 justify-content-center">
		<div class="col-6">
			<div class="card shadow-sm">
				<div class="card-body">
					<h4 class="text-center">Nothing Team</h4>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>