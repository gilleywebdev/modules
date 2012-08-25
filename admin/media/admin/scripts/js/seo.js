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
    rowHeaders: false, // Doesn't seem to work
    colHeaders: ["Page", "Title", "Description"]

});

var data = [
	["index", "", ""],
	["contact", "", ""],
	["thank-you", "", ""]
];

container.handsontable("loadData", data);