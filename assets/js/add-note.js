$(document).ready(function () {
	$("#title").focus(function () {
		$(this).removeClass("is-invalid");
	});

	$("#content").focus(function () {
		$(this).removeClass("is-invalid");
	});
});
