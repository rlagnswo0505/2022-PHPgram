<?php
  $a = "aaaaa";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  

<script>
  const b = "bbb";
  const a = "<?=$a?>";
  console.log(a);
</script>
  <?php 
    $b = "console.log(b)";
    print $b;
  ?>
</body>
</html>
