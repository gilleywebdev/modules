var container = $(".spreadsheet");

container.handsontable({
    rows: 3,
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

var handsontable = container.data('handsontable');

$.ajax({
	url: "/admin/seo/load",
	dataType: 'json',
	type: 'GET',
	success: function (res) {
		handsontable.loadData(res.data);
	}
});

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