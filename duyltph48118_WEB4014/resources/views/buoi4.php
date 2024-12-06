<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buoi hoc 4</title>
</head>
<body>
    <!-- 
     - File view (hiển thị) là file bắt buộc phải đặt trong thư mục resoures/víews
     - Có thể sử dụng file view = 2 cách
       + Trỏ trực tiếp từ Route
       + Gọi qua hàm trong Controller
    -->
    <h1>Chào mừng đến với bình nguyên vô tận</h1>
    <p>Hôm nay là ngày <?= date('d/m/Y')?> </p>
    <p> <?=$title?></p>
    <p> <?=$des?></p>
    <p><?=$tong?></p>
</body>
</html>