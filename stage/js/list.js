$(document).ready(function() {
				$('#grid-data').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
					//,"grid-data_length": 50
					,"iDisplayLength": 50
				} );
			} );

function del(loc){
	if(confirm('Are you sure you want to delete this record?'))
	{
		document.location.href = loc;
	}
}