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
       <link href="/mobile/dist/static/css/app.9ea4f10c142f1c61b33f248dc7e01f9c.css" rel="stylesheet">

  
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
<body>
<div id="app"></div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script>
  if( !window.jQuery ) document.write('<script src="/mobile/js/jquery-3.0.0.min.js"><\/script>');
</script>
<!-- Resource jQuery --> 

<script type="text/javascript" src="/mobile/dist/static/js/manifest.5f764c2a465c6e7c4b63.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/vendor.856aa3b0dacb50393f74.js"></script>
    <script type="text/javascript" src="/mobile/dist/static/js/app.9e3c5a1c7047355cb613.js"></script>


</body>

</html>
