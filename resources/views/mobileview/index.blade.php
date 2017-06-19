<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coolfm - Nigeria</title>
      <link rel="stylesheet" href="/mobile/css/style.css">
      <link href="/fonts/circular-font.css" rel="stylesheet">
      <link href="/fonts/ionicons/css/ionicons.css" rel="stylesheet">
	<link rel="stylesheet" href="/mobile/dist/static/fonts/MaterialDesign-Webfont-master/css/materialdesignicons.css">
       <link href="/mobile/dist/static/css/app.50cd431fed598cd056fa083f67bd154d.css" rel="stylesheet">
       <script src="/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="/dist/sweetalert.css">

  
</head>

<script>
 window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
        'trending' => $trending,
        'newones'=>$newones, 
        'fresh'=>$fresh,
        'categories'=>$categories,
        'ads'=>$ads
    ]); ?>
    //localStorage.setItem('username', auth()->user()->name)
</script>
<?php
if(auth()->user()){
?>
<script>
localStorage.setItem('username', '<?php echo auth()->user()->name ?>');
</script>
<?php
}
?>

<?php
if(!auth()->user()){
?>
<script>
if(localStorage.getItem('username')!=undefined){
    localStorage.removeItem('username');
}
</script>
<?php
}
?>
<body>
<div id="app"></div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
<script>
  if( !window.jQuery ) document.write('<script src="/mobile/js/jquery-3.0.0.min.js"><\/script>');
</script>
<!-- Resource jQuery --> 


<script type="text/javascript" src="/mobile/dist/static/js/manifest.144ba7a70446a1589d7c.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/vendor.174a1994a95c2da26a76.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/app.fdddf72ca3f5289ea454.js"></script> 
<!-- <script src="http://localhost:8080/app.js"></script>-->

<script src="https://js.paystack.co/v1/inline.js"></script>


</body>

</html>
