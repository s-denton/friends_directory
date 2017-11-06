// fix for Bootstrap collapse where all records are expanded
$('.collapse').on('show.bs.collapse', function() {
	$('.collapse.in').collapse('hide');
});