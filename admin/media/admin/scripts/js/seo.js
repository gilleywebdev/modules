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
	["index", "This is an Example of a Title Tag that is Seventy Characters in Length", "Here is an example of what a snippet looks like in Google's SERPs. The content that appears here is usually taken from the Meta Description tag if relevant."],
	["contact", "", ""],
	["thank-you", "", ""]
];

container.handsontable("loadData", data);