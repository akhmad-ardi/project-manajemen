// format date
function format_date(date) {
	return new Date(date).toLocaleString("id-ID", {
		year: "numeric",
		month: "numeric",
		day: "numeric",
	});
}

// get all tasks from endpoint tasks
async function get_all_tasks(url) {
	await $.ajax({
		url: url,
		type: "GET",
		success: function (response) {
			$("#body_table_task").empty();
			const tasks = response.data;

			if (!response.data) {
				$("#body_table_task").append(`
					<tr>
						<td colspan="6" class="text-center fs-4">Nothing Task</td>
					</tr>	
				`);
			} else {
				$.each(tasks, function (index, task) {
					$("#body_table_task").append(`
						<tr>
							<td class="text-center">${index + 1}</td>
							<td class="${
								task.status === "selesai" ? "text-decoration-line-through" : ""
							}">${task.name}</td>
							<td class="text-center ${
								task.status === "selesai" ? "text-decoration-line-through" : ""
							}">${format_date(task.start_date)}</td>
							<td class="text-center ${
								task.status === "selesai" ? "text-decoration-line-through" : ""
							}">${format_date(task.finish_date)}</td>
							<td class="text-center text-capitalize fw-bold">${task.status}</td>
							<td class="d-flex justify-content-center gap-1">
								${
									task.status === "selesai"
										? `
										<!-- Unfinish -->
										<button type="button" class="btn btn-danger btnUnfinishTask" value="${task.id}">
											<i class="bi bi-x-lg"></i>
										</button>`
										: `
										<!-- Finish -->
										<button type="button" class="btn btn-primary btnFinishTask" value="${task.id}">
											<i class="bi bi-check-lg"></i>
										</button>`
								}	
								
								${
									task.status === "proses"
										? `
										<!-- Unproses -->
										<button class="btn btn-outline-info btnUnprocessTask" ${
											task.status === "selesai" ? "disabled" : ""
										} value="${task.id}">
											<i class="bi bi-slash-circle-fill"></i>
										</button>
										`
										: `
										<!-- Proses -->
										<button class="btn btn-info text-white btnProcessTask" ${
											task.status === "selesai" ? "disabled" : ""
										} value="${task.id}">
											<i class="bi bi-arrow-repeat"></i>
										</button>
										`
								}
								
								<!-- Edit -->
								<button class="btn btn-outline-secondary">
									<i class="bi bi-pencil-square"></i>
								</button>

								<!-- Delete -->
								<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTaskModal${
									task.id
								}">
									<i class="bi bi-trash"></i>
								</button>
								<!-- Modal -->
								<div class="modal fade" id="deleteTaskModal${
									task.id
								}" tabindex="-1" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h1 class="modal-title fs-5" id="deleteTaskModalLabel">Delete Task</h1>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												Are you sure delete "${task.name}"?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
												<button type="button" class="btn btn-danger btnDeleteTask" value="${
													task.id
												}">Yes</button>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					`);
				});
			}
		},
	});
}
