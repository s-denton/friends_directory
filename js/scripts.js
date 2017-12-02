$(document).ready(function() {

	////////// Delete Record on Trash Icon Click //////////////
	$("#directory-table").on('click', '.delete-record-btn', function(e) {
		e.preventDefault();
		e.stopPropagation();
		alert("button clicked");

		var record_id = $(this).val();

		$.ajax({
			type: "POST",
			url: "includes/delete_record.php",
			data: "record_id=" + record_id,
			success: function(text) {
				msgModalView("Success", "The record was deleted successfully!");
				setTimeout(function() {
					$("#msgModal").modal('hide');
				}, 4000);
				setTimeout(function() {
					location.reload();
				}, 5000);
			},
			error: function(text) {
				alert("Error occurred")
			}
		});
	});
	////////////////////////////////////////////////////////

});
