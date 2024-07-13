<!-- Modal Delete Team -->
<div class="modal fade" id="deleteTeamModal" tabindex="-1" aria-labelledby="deleteTeamModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="deleteTeamModalLabel">Delete Team</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Are you sure delete <span class="fw-bold"><?= $team_info['team']->name ?></span> ?
			</div>
			<?= form_open(
				base_url() . '__actions__/team/delete?project=' . $project->slug,
				[],
				["_method" => "delete", "project_id" => $project->id]
			) ?>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
				<button type="submit" class="btn btn-danger">Yes</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>