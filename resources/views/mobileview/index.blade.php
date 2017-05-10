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
       <link href="/mobile/dist/static/css/app.e51378b17eb633dd2a8461f1e0ca9554.css" rel="stylesheet">

  
</head>

<script>
 window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
        'trending' => $trending,
        'newones'=>$newones, 
        'fresh'=>$fresh,
        'categories'=>$categories
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

<script type="text/javascript" src="/mobile/dist/static/js/manifest.e631dda98797830df181.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/vendor.b6dd142b92c4c3b5c129.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/app.a6590a27add9371f7f4b.js"></script> 




</body>

</html>
