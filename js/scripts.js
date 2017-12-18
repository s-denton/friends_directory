$(document).ready(function() {
	/////////////// Admin Functions ////////////////
	$('.button').click(function(){
		var username = $('#username').val();
		var password = $('#password').val();
		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var email = $('#email').val();
		var role = $('#role').val();
		var clickBtnValue = $(this).val();
		var ajaxurl = 'includes/adminFunction.php',
		data = {username:username,password:password,firstname:firstname,lastname:lastname,email:email,role:role,action:clickBtnValue};
		$.post(ajaxurl, data, function(response){
			$('#alert').show();
 				$('#result').html(response);
		});
	});

	//show email text boxes
	$('#emailUser').click(function(){
		$('#adminEmail').show();
		$('#emailUser').hide();
	});

	//when send email clicked
	$('#sendemail').click(function(){
		var uemail = $('#useremail').val();
		var subject = $('#subject').val();
		var msg = $('#comment').val();
		var clickBtnValue = $(this).val();
		var ajaxurl = 'includes/adminEmail.php',
		data = {uemail:useremail,subject:subject,msg:comment,action:clickBtnValue};
		$.post(ajaxurl, data, function(response){
			$('#alert1').show();
 				$('#result1').html(response);
		});
	});

	$(".button").click(function () { 
    return false; 
	});	
	///////////// End Admin Functions //////////////

	////////// Delete Record Script //////////////
	$(".delete-record-btn").click(function() {
		var pass_record_id = $(this).val();
		$("#confirm-delete-btn").val(pass_record_id);

		$("#confirm-delete-modal").modal('toggle');
		$("#confirm-delete-modal-body").html("Are you sure you want to delete this record from the database?");
	});

	$("#confirm-delete-btn").click(function() {
		$("#confirm-delete-modal").modal('hide');
		var record_id = $(this).val();

		$.ajax({
			type: "POST",
			url: "includes/delete_record.php",
			data: "record_id=" + record_id,
			success: function(text) {
				msgModalView("Success", "The record was deleted successfully!");
				setTimeout(function() {
					$("#msg-modal").modal('hide');
				}, 3000);
				setTimeout(function() {
					location.reload();
				}, 3500);
			},
			error: function(text) {
				alert("Error occurred");
			}
		}); // end ajax
	}); // end if confirm delete button is clicked
	///////// End Delete Record Script //////////////

	//////////////// Update Record Script ////////////////////
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
				}, 3000);
				setTimeout(function() {
					location.reload();
				}, 3500);
			}, 
			error: function(text) {
				alert("Error occurred");
			}
		});
	}
	////////////////End Update Record Script ///////////////////////

	//////////// Generic Modal Script //////////////
	function msgModalView(header, body) {
		$("#msg-modal").modal('toggle');
		$("#msg-header").html(header);
		$("#msg-body").html(body);
	}
	///////////End Generic Modal Script/////////////

});
