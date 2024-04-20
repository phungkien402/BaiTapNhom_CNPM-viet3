
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/index_admin.css">
</head>
<body>
    <h1>ADMIaN PAGE</h1>
    <div class="wrapper">
        <p>header</p><ul class="admin_menu-list">
    <li><a href="index.php?action=quanlydanhmucsanpham&query=them">Quản lý danh mục sản phẩm</a></li>
    <li><a href="index.php?action=quanlysanpham&query=them">Quản lý sản phẩm</a></li>
</ul><div class="clear"></div>
<div class="main">
    
<p>thêm sản phẩm</p>
<table width="70%" border="1" style="border-collapse: collapse;">
    <form method="POST" action="modules/quanlysanpham/xuly.php" enctype="multipart/form-data">
        <tr>
            <td>
                tên sản phẩm
            </td>
            <td>
                <input width="100%" type="text" name="tensanpham">
            </td>
        </tr>
        <tr>
            <td>
                mã sản phẩm
            </td>
            <td>
                <input width="100%" type="text" name="masanpham">
            </td>
        </tr>
        <tr>
            <td>
                giá sản phẩm
            </td>
            <td>
                <input width="100%" type="text" name="giasanpham">
            </td>
        </tr>
        <tr>
            <td>
                số lượng
            </td>
            <td>
                <input width="100%" type="text" name="soluong">
            </td>
        </tr>
        <tr>
            <td>
                hình ảnh
            </td>
            <td>
                <input width="100%" type="file" name="hinhanh">
            </td>
        </tr> 
        <tr>
            <td>
                tóm tắt
            </td>
            <td>
                <textarea rows="5" name="tomtat"></textarea>
            </td>
        </tr> 
        <tr>
            <td>
                nội dung
            </td>
            <td>
                <textarea rows="5" name="noidung"></textarea>
            </td>
        </tr>
        <tr>
            <td>danh mục sản phẩm</td>
            <td>
                <select name="danhmuc">
                    <br />
<b>Fatal error</b>:  Uncaught mysqli_sql_exception: Table 'my_database.tbl_danhmuc' doesn't exist in D:\DAI_HOC_CNTT_K21_nam_2022-2026\hoc_phan_ky_4\an_toan_thong_tin\app\XAMPP\htdocs\BaiTapNhom_CNPM-kien\admincp\modules\quanlysanpham\add.php:67
Stack trace:
#0 D:\DAI_HOC_CNTT_K21_nam_2022-2026\hoc_phan_ky_4\an_toan_thong_tin\app\XAMPP\htdocs\BaiTapNhom_CNPM-kien\admincp\modules\quanlysanpham\add.php(67): mysqli_query(Object(mysqli), 'SELECT * FROM t...')
#1 D:\DAI_HOC_CNTT_K21_nam_2022-2026\hoc_phan_ky_4\an_toan_thong_tin\app\XAMPP\htdocs\BaiTapNhom_CNPM-kien\admincp\modules\main.php(16): include('D:\\DAI_HOC_CNTT...')
#2 D:\DAI_HOC_CNTT_K21_nam_2022-2026\hoc_phan_ky_4\an_toan_thong_tin\app\XAMPP\htdocs\BaiTapNhom_CNPM-kien\admincp\index.php(16): include('D:\\DAI_HOC_CNTT...')
#3 {main}
  thrown in <b>D:\DAI_HOC_CNTT_K21_nam_2022-2026\hoc_phan_ky_4\an_toan_thong_tin\app\XAMPP\htdocs\BaiTapNhom_CNPM-kien\admincp\modules\quanlysanpham\add.php</b> on line <b>67</b><br />
