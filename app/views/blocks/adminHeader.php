<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/admin_qldanhmuc.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="wrapper">
        <h1>ADMIN PAGE</h1>
        <ul class="admin_menu-list">
            <li><a href="?action=1">Quản lý danh mục sản phẩm</a></li>
            <li><a href="?action=2">Quản lý sản phẩm</a></li>
            <li><a href="<?php echo _WEB_ROOT ?>">Quay về trang chủ</a></li>
            <li><a href="?action=3" id="logout">Đăng Xuất</a></li>
        </ul>
        <div class="clear"></div>
        <div class="main"></div>
    <script>
        $(document).ready(function () {
            $('#logout').click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: BASE_URL+'/Home/requestHome?url=HomeRequest/logout',
                    success: function () {
                        // window.location.href = _WEB_ROOT;
                    }
                });
            });
        });
    </script>
</body>


</html>

<?php
if (isset($_GET['action']) && $_GET['action'] == '3') {
    session_destroy();
    header('Location: ' . _WEB_ROOT);
    exit();
}
?>