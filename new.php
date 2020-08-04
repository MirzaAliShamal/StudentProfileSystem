<html>
	<head>
		<?php 
			include"system/fileslink.php";
		?>
<script src="assets/datatable/datatable.js"></script>
<link href="assets/datatable/datatable.css" rel="stylesheet">
	</head>
	
<body>
<div class="md-form md-outline input-with-post-icon datepicker" id="datepicker">
  <input placeholder="Select date" type="text" id="datepicker" class="form-control">
  <label for="Customization">Try me...</label>
  <i class="fas fa-calendar input-prefix" tabindex=0></i>
</div>
<script>
$('.datepicker').datepicker({
weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
showMonthsShort: true
})
</script>


<br><br>
<a href="delete.php?id=22" class="confirmation">Link</a>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    });
</script>
</body>
</html>