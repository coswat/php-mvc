<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="<?= asset('style.css') ?>">

</head>
<body>
  
<h1 class="static">
  Welcome Page, Hello!
</h1>
<form method="post" action="<?= route('post') ?>">
<button class="default" >Enter Post Route</button>
</form>
</body>
</html>

