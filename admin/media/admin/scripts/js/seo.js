var $spreadsheet = $(".spreadsheet");

$spreadsheet.handsontable({
    rows: 1,
    cols: 3,
	legend: [
		// Read only row headers, for copy/pasting
		{
			match: function (row, col, data) {
				return (col === 0); // if it is first column
			},
			readOnly: true // make it read-only
		}
	],
    rowHeaders: false,
    colHeaders: ["Page", "Title", "Description"],
	minSpareRows: 1, //always keep at least 1 spare row at the bottom
});

var handsontable = $spreadsheet.data('handsontable');

// Load data from database on pageload
$.ajax({
	url: "/admin/seo/load",
	dataType: 'json',
	type: 'GET',
	success: function (res) {
		handsontable.loadData(res.data);
	}
});

// Save to database
$('.submit').click(function () {
	$.ajax({
		url: "/admin/seo/save",
		data: {"data": handsontable.getData()}, // returns all cells' data
		dataType: 'json',
		type: 'POST',
		success: function () {
			window.location.href = "/admin/seo/index/success/seo_updated";
		}
	});
});