<?php
include 'db_connection.php';

// Kiểm tra ID có tồn tại và là số hợp lệ
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // Chuẩn bị câu lệnh SQL để tránh SQL injection
    $stmt = $conn->prepare("DELETE FROM loai WHERE id = "$id");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Danh mục đã được xóa thành công.";
        header("Location: http://localhost/cnpm/BaiTapNhom_CNPM/admin/index?action=1");
    } else {
        echo "Lỗi khi xóa danh mục: " . $conn->error;
    }

    // Đóng câu lệnh và kết nối
    $stmt->close();
    $conn->close();
} else {
    echo "Dữ liệu không hợp lệ.";
}
?>