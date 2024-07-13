// format date local
function format_date_local(date) {
	return new Date(date).toLocaleString("id-ID", {
		year: "numeric",
		month: "numeric",
		day: "numeric",
	});
}

// get all tasks from endpoint tasks
async function get_all_tasks(url, team_detail) {
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
							<td class="text-center text-nowrap">${index + 1}</td>
							<td class="text-nowrap ${
								task.status === "selesai" ? "text-decoration-line-through" : ""
							}">${task.name}</td>
							<td class="text-center text-nowrap ${
								task.status === "selesai" ? "text-decoration-line-through" : ""
							}">${format_date_local(task.start_date)}</td>
							<td class="text-center text-nowrap ${
								task.status === "selesai" ? "text-decoration-line-through" : ""
							}">${format_date_local(task.finish_date)}</td>
							<td class="text-center text-nowrap text-capitalize fw-bold">${task.status}</td>
							<td class="d-flex justify-content-center gap-1">			
								<!-- Finish -->
								<button type="button" class="btn ${
									task.status === "selesai"
										? "btn-danger btnUnfinishTask"
										: "btn-primary btnFinishTask"
								}" value="${task.id}">
									${
										task.status === "selesai"
											? `<i class="bi bi-x-lg"></i>`
											: `<i class="bi bi-check-lg"></i>`
									}
								</button>
								
								<!-- Proses -->
								<button class="btn ${
									task.status === "proses"
										? "btn-outline-info btnUnprocessTask"
										: "btn-info text-white btnProcessTask"
								}" ${task.status === "selesai" ? "disabled" : ""} value="${task.id}">
									<i class="bi bi-arrow-repeat"></i>
								</button>
										
								<!-- Edit -->
								<a href="/dashboard/task/${
									task.project_id
								}?id=${task.id}${team_detail ? `&team_id=${task.team_id}` : ""}" class="btn btn-outline-secondary ${task.status === "selesai" || task.status === "proses" ? "link-disabled" : ""}">
									<i class="bi bi-pencil-square"></i>
								</a>
								
								<!-- Delete -->
								<button type="button" class="btn btn-outline-danger btnDeleteTask" value="${
									task.id
								}">
									<i class="bi bi-trash"></i>
								</button>
							</td>
						</tr>
					`);
				});
			}
		},
	});
}
