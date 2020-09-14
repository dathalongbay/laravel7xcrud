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

<pre>
    Dùng vòng lặp
    foreach() in ra thẻ select với các tỉnh thành VN
</pre>

<select>
    <?php
    $cities = [];
    $cities["hn"] = "Hà nội";
    $cities["hcm"] = "Hồ chí minh";
    $cities["th"] = "Thanh hóa";
    $cities["na"] = "Nghệ an";
    $cities["dn"] = "Đà nẵng";
    $cities["qb"] = "Quảng bình";
    $cities["qn"] = "Quảng Nam";
    foreach($cities as $keyCity => $city) {
        echo "<option value=\"$keyCity\">$city</option>";
    }
    ?>
</select>

</body>
</html>
