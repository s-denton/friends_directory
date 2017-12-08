$(document).ready(function() {

	////////// Delete Record on Trash Icon Click //////////////
	$(".delete-record-btn").click(function() {
		var record_id = $(this).val();

		$.ajax({
			type: "POST",
			url: "includes/delete_record.php",
			data: "record_id=" + record_id,
			success: function(text) {
				msgModalView("Success", "The record was deleted successfully!");
				setTimeout(function() {
					$("#msg-modal").modal('hide');
				}, 4000);
				setTimeout(function() {
					location.reload();
				}, 5000);
			},
			error: function(text) {
				alert("Error occurred");
			}
		});
	});
	////////////////////////////////////////////////////////

	///////// Update Song Modal Toggle ///////////
	var record_id = "";
	$(".edit-record-btn").click(function() {
		record_id = $(this).val();
		$("#update-record-modal").modal('toggle');
	});

	$("#update-record-form").submit(function(event) {
		event.preventDefault();
		submitUpdateRecordForm(record_id);
	});

	function submitUpdateRecordForm(record_id) {
		var first_name = $("#update-record-fname").val();
		var last_name = $("#update-record-lname").val();
		var company = $("#update-record-company").val();
		var street = $("#update-record-street").val();
		var city = $("#update-record-city").val();
		var state = $("#update-record-state").val();
		var zip = $("#update-record-zip").val();
		var email = $("#update-record-email").val();
		var phone = $("#update-record-phone").val();
		var bday = $("#update-record-bday").val();
		var assoc = $(".update-record-assoc:checked").val();

		$.ajax({
			type: "POST", 
			url: "includes/update_record.php", 
			data: "record_id=" + record_id + 
				"&first_name=" + first_name + 
				"&last_name=" + last_name + 
				"&company=" + company +
				"&street=" + street + 
				"&city=" + city + 
				"&state=" + state + 
				"&zip=" + zip + 
				"&email=" + email + 
				"&phone=" + phone + 
				"&bday=" + bday + 
				"&assoc=" + assoc,
			success: function(text) {
				$("#update-record-modal").modal('hide');
				msgModalView("Success", "The record was updated successfully!");
				setTimeout(function() {
					$("#msg-modal").modal('hide');
				}, 4000);
				setTimeout(function() {
					location.reload();
				}, 5000);
			}, 
			error: function(text) {
				alert("Error occurred");
			}
		});
	}
	///////////////////////////////////////////

	//////////// Generic Modal Script //////////////
	function msgModalView(header, body) {
		$("#msg-modal").modal('toggle');
		$("#msg-header").html(header);
		$("#msg-body").html(body);
	}
	////////////////////////////////////////////////

});
