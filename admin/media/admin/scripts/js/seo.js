var $spreadsheet = $(".spreadsheet");
var $google = $('.google');

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
	onChange: function (change) {
		var width = $('.spreadsheet table').width();
		
		var googlePos = width + 15;
		
		$google.css('left', googlePos);
	},
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

// Google Preview


$spreadsheet.mousedown(function () {
	// Move google to selected positon
	var currentPos = $('.current').position();
	$google.css('top', currentPos.top - 15);
	$google.hide();
});

$spreadsheet.mouseup(function () {
	selected = handsontable.getSelected(); // returns [`topLeftRow`, `topLeftCol`, `bottomRightRow`, `bottomRightCol`]

	if(selected[0] === selected[2]) { // if a single row is selected
		// Show google
		$google.show();

		// Get the data
		x = selected[0];
		y = selected[1];
		var pagename = handsontable.getDataAtCell(x, 0);
		var title = handsontable.getDataAtCell(x, 1)
		var description = handsontable.getDataAtCell(x, 2);
		
		// Truncate if necessary
		if(title.length > 69)
		{
			title = jQuery.trim(title).substring(0, 69)
			    .split(" ").slice(0, -1).join(" ") + "...";
		}
		
		if(description.length > 156)
		{
			description = jQuery.trim(description).substring(0, 156)
			    .split(" ").slice(0, -1).join(" ") + "...";
		}

		// Format the data
		var formatted = '<p class="google_title">' + title + '</p>';
		formatted = formatted + '<p class="google_link">http://www.gilleywebdev.com/' + pagename + '</p>';
		formatted = formatted + '<p class="google_description">' + description + '</p>';

		// Put the data in the div
		$google.html(formatted);
		
		$(this).data('y', y);
	}
});

$('.handsontableInput').keyup(function () {
	// Title
	if ($spreadsheet.data('y') === 1) {
		$('.google_title').text($(this).val());
	}
	
	// Description
	if ($spreadsheet.data('y') === 2) {
		$('.google_description').text($(this).val());		
	}
});