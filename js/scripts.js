////////// Delete Record on Trash Icon Click //////////////
$("#deleteRecordBtn").click(function() {
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

$('#collapse-init').click(function () {
    if (active) {
        active = false;
        $('.panel-collapse').collapse('show');
        $('.panel-title').attr('data-toggle', '');
        $(this).text('Enable accordion behavior');
    } else {
        active = true;
        $('.panel-collapse').collapse('hide');
        $('.panel-title').attr('data-toggle', 'collapse');
        $(this).text('Disable accordion behavior');
    }
});