<?php
include 'db_connection.php';

// Kiểm tra xem có phải là yêu cầu POST để cập nhật danh mục không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_category']) && isset($_POST['ten'])) {
    $new_id = $_POST['id_category'];
    $ten = $_POST['ten'];
    $old_id = $_GET['id']; // Giả sử rằng ID cũ được truyền qua URL

    // Chuẩn bị câu lệnh SQL để tránh SQL injection
    $stmt = $conn->prepare("UPDATE loai SET id_category = ?, ten = ? WHERE id_category = ?");
    $stmt->bind_param("isi", $new_id, $ten, $old_id);
    // Thực thi câu lệnh và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Danh mục đã được cập nhật thành công.";
        // Chuyển hướng về trang danh sách danh mục sau khi cập nhật
        header("Location: http://localhost/cnpm/BaiTapNhom_CNPM/admin/index?action=1");
        exit();
    } else {
        echo "Lỗi khi cập nhật danh mục: " . $stmt->error;
    }

    // Đóng câu lệnh và kết nối
    $stmt->close();
    $conn->close();
} else {
    // Lấy thông tin danh mục cần chỉnh sửa
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT id_category, ten FROM loai WHERE id_category =
    
    ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $current_id = $row['id_category'];
        $current_name = $row['ten'];
    } else {
        echo "Không tìm thấy danh mục với ID: $id";
        $stmt->close();
        $conn->close();
        exit();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Danh Mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(238, 75, 43);
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            border-radius: 10px;
            max-width: 700px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            outline-color: rgb(238, 75, 43);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            outline-color: rgb(238, 75, 43);
            padding: 10px 15px;
            background: rgb(238, 75, 43);
            border: 0;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background: rgb(255, 75, 43);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Chỉnh Sửa Danh Mục</h2>
    <form action="edit.php?id=<?php echo $current_id; ?>" method="post">
        <label for="id_category">ID Danh Mục:</label>
        <input type="text" name="id_category" id="id_category" value="<?php echo htmlspecialchars($current_id); ?>"
            required>
        <label for="ten">Tên Danh Mục:</label>
        <input type="text" name="ten" id="ten" value="<?php echo htmlspecialchars($current_name); ?>" required>

        <input type="submit" value="Cập nhật">
    </form>
    </div>
</body>

</html>