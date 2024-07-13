<div class="table-responsive">
	<table class="table table-striped table-primary align-middle mb-0">
		<thead>
			<tr>
				<th class="text-center text-nowrap" style="width: 5%;">No</th>
				<th class="text-center text-nowrap" style="width: 40%;">Task</th>
				<th class="text-center text-nowrap" style="width: 10%;">Start Date</th>
				<th class="text-center text-nowrap" style="width: 10%;">Finish Date</th>
				<th class="text-center text-nowrap" style="width: 15%;">Status</th>
				<th class="text-center text-nowrap" style="width: 20%;">Action</th>
			</tr>
		</thead>

		<tbody id="body_table_task">
			<tr>
				<td colspan="6" class="">
					<div class="d-flex justify-content-center">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(async function () {
		await get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project->id) ?>', <?= isset($_GET['team']) ? "'true'" : "'false'" ?> === 'true' ? true : false)

		setInterval(async function () {
			await get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project->id) ?>', <?= isset($_GET['team']) ? "'true'" : "'false'" ?> === 'true' ? true : false)
		}, 3000);

		// finish task
		$("#body_table_task").on('click', '.btnFinishTask', async function () {
			const idTask = $(this).val()

			await $.ajax({
				url: '<?= base_url() . '__actions__/task/finish_unfinish?project=' . $project->slug ?>',
				type: 'POST',
				contentType: 'application/json',
				data: JSON.stringify({ id_task: idTask })
			})

			await get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project->id) ?>', <?= isset($_GET['team']) ? "'true'" : "'false'" ?> === 'true' ? true : false)
		})

		// unfinish task
		$("#body_table_task").on('click', '.btnUnfinishTask', async function () {
			const idTask = $(this).val()

			await $.ajax({
				url: '<?= base_url() . '__actions__/task/finish_unfinish?project=' . $project->slug ?>',
				type: 'POST',
				contentType: 'application/json',
				data: JSON.stringify({ id_task: idTask })
			})

			await get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project->id) ?>', <?= isset($_GET['team']) ? "'true'" : "'false'" ?> === 'true' ? true : false)
		})

		// process task
		$("#body_table_task").on('click', '.btnProcessTask', async function () {
			const idTask = $(this).val()

			await $.ajax({
				url: '<?= base_url() . '__actions__/task/process?project=' . $project->slug ?>',
				type: 'POST',
				contentType: 'application/json',
				data: JSON.stringify({ id_task: idTask })
			})

			await get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project->id) ?>', <?= isset($_GET['team']) ? "'true'" : "'false'" ?> === 'true' ? true : false)
		})

		// uprocess task
		$("#body_table_task").on('click', '.btnUnprocessTask', async function () {
			const idTask = $(this).val()

			await $.ajax({
				url: '<?= base_url() . '__actions__/task/process?project=' . $project->slug ?>',
				type: 'POST',
				contentType: 'application/json',
				data: JSON.stringify({ id_task: idTask })
			})

			await get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project->id) ?>', <?= isset($_GET['team']) ? "'true'" : "'false'" ?> === 'true' ? true : false)
		})

		// delete task
		$("#body_table_task").on('click', '.btnDeleteTask', async function () {
			const idTask = $(this).val()

			await $.ajax({
				url: '<?= base_url() . '__actions__/task/delete?project=' . $project->slug ?>',
				type: 'POST',
				contentType: 'application/json',
				data: JSON.stringify({ id_task: idTask })
			})
			$(`#deleteTaskModal${idTask}`).modal('hide');

			await get_all_tasks('<?= base_url('__actions__/task/get_all?project_id=' . $project->id) ?>', <?= isset($_GET['team']) ? "'true'" : "'false'" ?> === 'true' ? true : false)
		})
	})
</script>