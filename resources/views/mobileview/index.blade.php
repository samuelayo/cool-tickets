<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coolfm - Nigeria</title>
  
  
<link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i" rel="stylesheet">
  
      <link rel="stylesheet" href="/mobile/css/style.css">
      <link href="/fonts/ionicons/css/ionicons.css" rel="stylesheet">
	<link rel="stylesheet" href="/mobile/dist/static/fonts/MaterialDesign-Webfont-master/css/materialdesignicons.css">
       <link href="/mobile/dist/static/css/app.168f324bfc92ada06a4d853d3458af5f.css" rel="stylesheet">

  
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

<script type="text/javascript" src="/mobile/dist/static/js/manifest.96e822b729aa482d8f0c.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/vendor.875afc491451e1b702fb.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/app.4838de1003059b21f9df.js"></script>

   <!-- <script src="http://localhost:8080/app.js"></script> -->




</body>

</html>
