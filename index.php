<?php

$x = false;
$y = false;
$r = false;
$str = false;

if (isset($_GET['x']) && isset($_GET['y']) && isset($_GET['r'])){

    $x = $_GET['x'];
    $y = $_GET['y'];
    $r = $_GET['r'];
    $points = [];
    $point = [];

    for ($i = 0;$i <= 360;$i++){

        $y_coord = round(sin(deg2rad($i)) * $r,2);
        $x_coord = round(sqrt($r**2 - $y_coord**2),2);
        if ($i >= 0 && $i <= 90) $point = [$x + $x_coord,$y + $y_coord];
        if ($i >= 90 && $i <= 180) $point = [$x + $x_coord,$y - $y_coord];
        if ($i >= 180 && $i <= 270) $point = [$x - $x_coord,$y - $y_coord];
        if ($i >= 270 && $i <= 360) $point = [$x - $x_coord,$y + $y_coord];
        $points[$i] = $point;
    }

    $json = json_encode($points);

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script>

var points = <?php echo $json;?>;

function createSign(x,y){
   circle = document.createElement('div');
   circle.style.cssText = 'position:fixed;';
   circle.style.left = x + "px";
   circle.style.top = y + "px";
   circle.innerHTML = 's';
   document.body.appendChild(circle);
}

for (var i = 0;i < points.length;i++){
        createSign(points[i][0],points[i][1]);
}


</script>
</body>
</html>



