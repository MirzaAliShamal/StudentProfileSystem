<head>
 <script src="assets/vendor/jquery/jquery.min.js"></script>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

<script src="assets/vendor/bootstrap//js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<style>
label{margin-left: 20px;}
#datepicker{width:180px; margin: 0 20px 20px 20px;}
#datepicker > span:hover{cursor: pointer;}
</style>
</head>
<body>
<pre>
<b>Note:</b>
using <a href="getbootstrap.com/">bootstrap 3.2.0</a> and <a href="https://github.com/eternicode/bootstrap-datepicker">eternicode bootstrap-datepicker</a>
</pre>



<label>Select Date: </label>
<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
    <input class="form-control" type="text" readonly />
    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
</div>

<script>
$(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});

</script>
	</body>