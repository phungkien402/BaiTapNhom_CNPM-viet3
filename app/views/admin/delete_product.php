<?php
    include 'db_connection.php';
// Kiểm tra xem ID sản phẩm có được gửi đến qua 'GET' không
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Truy vấn để xóa sản phẩm dựa trên ID
    $sql = "DELETE FROM items WHERE id_item = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $result = $stmt->execute();

    if ($result) {
        echo "Sản phẩm đã được xóa.";
        header("Location: http://localhost/cnpm/BaiTapNhom_CNPM/admin/index?action=2");
    } else {
        echo "Lỗi: Không thể xóa sản phẩm.";
    }
}


$conn->close();
?>
