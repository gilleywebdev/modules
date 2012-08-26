var $spreadsheet = $(".spreadsheet");

// Load data from database on pageload
$.ajax({
	url: "/admin/seo/load",
	dataType: 'json',
	type: 'GET',
	success: function (res) {
		var numRows = res.length;
		
		$spreadsheet.handsontable({
		    rows: numRows,
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
		    colHeaders: ["Page", "Title", "Description"]
		});

		handsontable = $spreadsheet.data('handsontable');

		handsontable.loadData(res);
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