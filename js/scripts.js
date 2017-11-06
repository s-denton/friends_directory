var row = document.getElementById("accordian-row");
row.className = "Hidden";

// fix for Bootstrap collapse where all records are expanded
$('.collapse').on('show.bs.collapse', function() {
	var row = document.getElementById("accordian-row");
	row.className = "";
	$('.collapse.in').collapse('hide');
});

$('')
