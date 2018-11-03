<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?=base_url()?>assets/images/favicon.ico" type="image/x-icon">

<title>{title}</title>
<!--Fonts-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet">
<link href="<?=base_url()?>assets/css/login.css" rel="stylesheet">
<style type="text/css">
	#geocomplete1, #geocomplete2 { width: 200px}

.map_canvas1, .map_canvas2 { 
  width: 100%; 
  height: 400px; 
  margin: 10px 20px 10px 0;
}
</style>
</head>
<body>
    {content}
<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>



<script src="<?=base_url()?>assets/js/jquery.geocomplete.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAHKjT4AfdZ8p8s_ccUAwWsqUVaAMZ3mVI"></script>

<script type="text/javascript">
	$(document).ready(function() {

	  $("#geocomplete1").geocomplete({
	    map: ".map_canvas1",

	    markerOptions: {
	      draggable: true
	    }
	  });
	  
	  $("#geocomplete1").bind("geocode:dragged", function(event, latLng){
	    $(".lat1").val(latLng.lat());
	    $(".lng1").val(latLng.lng());
	  });
	  
	  
	  $("#find1").click(function(){
	    $("#geocomplete1").trigger("geocode");
	  }).click();


	  // 2
	  $("#geocomplete2").geocomplete({
	    map: ".map_canvas2",

	    markerOptions: {
	      draggable: true
	    }
	  });
	  
	  $("#geocomplete2").bind("geocode:dragged", function(event, latLng){
	    $(".lat2").val(latLng.lat());
	    $(".lng2").val(latLng.lng());
	  });
	  
	  

	  $("#find2").click(function(){
	    $("#geocomplete2").trigger("geocode");
	  }).click();
});
</script>

</body>

</html>