$(document).ready(function () {
	$("#username").focus(function () {
		$(this).removeClass("is-invalid");
	});

	$("#email").focus(function () {
		$(this).removeClass("is-invalid");
	});

	$("#password").focus(function () {
		$(this).removeClass("is-invalid");
	});

	$("#confirm-password").focus(function () {
		$(this).removeClass("is-invalid");
	});
});
