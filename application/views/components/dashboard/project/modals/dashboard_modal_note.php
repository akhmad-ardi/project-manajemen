<!-- Modal Note -->
<div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="noteModalLabel"><?= $note->title ?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?= $note->content ?>
			</div>
			<?= form_open(
				base_url() . '__actions__/note/delete?project=' . $project->slug,
				[],
				["_method" => "delete", "project_id" => $project->id]
			) ?>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<?php if ($this->session->userdata('id') == $project->user_id): ?>
					<button type="submit" class="btn btn-danger d-flex align-items-center" data-bs-dismiss="modal">
						<i class="bi bi-trash me-1"></i>
						<span>Delete</span>
					</button>
				<?php endif; ?>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>