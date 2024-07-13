<!-- Modal Delete Project -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="deleteProjectModalLabel">Delete Project</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Are you sure delete <span class="fw-bold"><?= $page_info['title'] ?></span> ?
			</div>
			<?= form_open(
				base_url() . '__actions__/project/delete?project=' . $project->slug,
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