<?php

// Hàm thêm sản phẩm vào giỏ hàng trong cơ sở dữ liệu
function addToCartDatabase($userId, $productId, $quantity) {
    // Kết nối cơ sở dữ liệu
    $conn = new mysqli('localhost', 'phunghuukien', 'nopass123', 'my_database');

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng chưa
    $stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Sản phẩm đã tồn tại, cập nhật số lượng
        $stmt = $conn->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("iii", $quantity, $userId, $productId);
    } else {
        // Sản phẩm chưa tồn tại, thêm mới
        $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $userId, $productId, $quantity);
    }

    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>