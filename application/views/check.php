<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="container">
	<div class="row ">
		<table id='employeeList' class="table table-bordered">
			<thead>
			<tr>
				<th>EmpId</th>
				<th>Name</th>
				<th>Age</th>
				<th>Skills</th>
				<th>Designation</th>
				<th>Address</th>
			</tr>
			</thead>
			<tbody></tbody>
		</table>
		<div id='pagination'></div>	
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: "<?php echo base_url('Check/loadData');  ?>",
			type: 'post',
			dataType: 'json',
			success: function(responseData){
				$('#pagination').html(responseData.pagination);
				paginationData(responseData.empData);
			}
		});
	}
	function paginationData(data) {
		$('#employeeList tbody').empty();
		for(emp in data){
			var empRow = "<tr>";
			empRow += "<td>"+ data[emp].id +"</td>";
			empRow += "<td>"+ data[emp].name +"</td>";
			empRow += "<td>"+ data[emp].age +"</td>"
			empRow += "<td>"+ data[emp].skills +"</td>"
			empRow += "<td>"+ data[emp].designation +"</td>"
			empRow += "<td>"+ data[emp].address +"</td>";
			empRow += "</tr>";
			$('#employeeList tbody').append(empRow);					
		}
	}
});
</script>
</body>
</html>