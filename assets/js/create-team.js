$(document).ready(function () {
	$("#team_name").focus(function () {
		$(this).removeClass("is-invalid");
	});

	$("#choose_team_member").focus(function () {
		$(this).removeClass("is-invalid");
	});

	$("#btn_add_member").on("click", function () {
		const alertErrorBadge = $("#alert_error_choose_team_member");
		const inputTextChooseTeamMember = $("#choose_team_member").val();
		if (!inputTextChooseTeamMember)
			alertErrorBadge
				.removeClass("d-none")
				.empty()
				.append("Please choose member");

		const isEmailExist = $("#list_email_user option").filter(function (
			index,
			el
		) {
			return $(el).val() == inputTextChooseTeamMember;
		});
		if (inputTextChooseTeamMember && !isEmailExist.val())
			alertErrorBadge.removeClass("d-none").empty().append("User Not Found");

		const isEmailHasBeenSelected = $("#list_group li div input").filter(
			function (index, el) {
				return $(el).val() == inputTextChooseTeamMember;
			}
		);
		if (isEmailHasBeenSelected.val())
			alertErrorBadge
				.removeClass("d-none")
				.empty()
				.append("User Has Been Selected");

		if (
			inputTextChooseTeamMember &&
			isEmailExist.val() &&
			!isEmailHasBeenSelected.val()
		) {
			alertErrorBadge.addClass("d-none").empty();
			const listItem = `
          <li class="list-group-item">
            <div class="form-check">
              <input 
								class="form-check-input d-none"
							 	type="checkbox" name="list_team_members[]" 
							 	value="${inputTextChooseTeamMember}" 
							 	id="${inputTextChooseTeamMember}" 
								checked>
              <label class="form-check-label" for="${inputTextChooseTeamMember}">
                ${inputTextChooseTeamMember}
              </label>
            </div>
          </li>
        `;

			$("#list_group").append(listItem);
			$("#choose_team_member").val("");
		}
	});
});
