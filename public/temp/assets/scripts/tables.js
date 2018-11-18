$(function() {

	// datatable column with reorder extension
	$('#datatable-column-reorder').dataTable({
		pagingType: "full_numbers",
		sDom: "RC"+
			"t"+
			"<'row'<'col-sm-6'i><'col-sm-6'p>>",
		colReorder: true,
	});

	// datatable with column filter enabled
	var dtTable = $('#datatable-column-filter').DataTable({ // use DataTable, not dataTable
		sDom: // redefine sDom without lengthChange and default search box
			"t"+
			"<'row'<'col-sm-6'i><'col-sm-6'p>>"
	}); 

	$('#datatable-column-filter thead').append('<tr class="row-filter"><th></th><th></th><th></th><th></th><th></th></tr>');
	$('#datatable-column-filter thead .row-filter th').each( function() {
		$(this).html('<input type="text" class="form-control input-sm" placeholder="Search...">');
	});

	$('#datatable-column-filter .row-filter input').on('keyup change', function() {
		dtTable
			.column($(this).parent().index()+':visible')
			.search(this.value)
			.draw();
	});

	// datatable with paging options and live search
	$('#featured-datatable').dataTable({
		sDom: "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
	});

	// datatable with export feature
	var exportTable = $('#datatable-data-export').DataTable({
		sDom: "T<'clearfix'>" +
			"<'row'<'col-sm-6'l><'col-sm-6'f>r>"+
			"t"+
			"<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"tableTools": {
				"sSwfPath": "assets/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf"
			}
	});

	// datatable with scrolling
	$('#datatable-basic-scrolling').dataTable({
		scrollY: "300px",
		scrollCollapse: true,
		paging: false
	});
});