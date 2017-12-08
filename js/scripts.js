$(document).ready(function() {

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
				}, 4000);
				setTimeout(function() {
					location.reload();
				}, 5000);
			},
			error: function(text) {
				alert("Error occurred");
			}
		}); // end ajax
	}); // end if confirm delete button is pressed
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
	////////////////End Update Record Script ///////////////////////

	//////////// Generic Modal Script //////////////
	function msgModalView(header, body) {
		$("#msg-modal").modal('toggle');
		$("#msg-header").html(header);
		$("#msg-body").html(body);
	}
	///////////End Generic Modal Script/////////////

	//////////////// Excel Export Script ///////////////////
	function fnExcelReport()
	{
	    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
	    var textRange; var j=0;
	    tab = document.getElementById('directory-table'); // id of table

	    for(j = 0 ; j < tab.rows.length ; j++) 
	    {     
	        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
	        //tab_text=tab_text+"</tr>";
	    }

	    tab_text=tab_text+"</table>";
	    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
	    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
	    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

	    var ua = window.navigator.userAgent;
	    var msie = ua.indexOf("MSIE "); 

	    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
	    {
	        txtArea1.document.open("txt/html","replace");
	        txtArea1.document.write(tab_text);
	        txtArea1.document.close();
	        txtArea1.focus(); 
	        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
	    }  
	    else                 //other browser not tested on IE 11
	        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

	    return (sa);
	}
	////////////////End Excel Export Script////////////////////

});
