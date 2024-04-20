<?php
// Kết nối cơ sở dữ liệu
include 'db_connection.php';

$productId = isset($_GET['id']) ? $_GET['id'] : null;
$product = null;

// Truy vấn lấy thông tin sản phẩm
if ($productId) {
    $sql = "SELECT * FROM items WHERE id_item = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Sản phẩm không tìm thấy.";
        exit;
    }
}

// Xử lý dữ liệu form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name_item = $_POST['name_item'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $tom_tat = $_POST['tom_tat'];
    $noi_dung = $_POST['noi_dung'];
    $loai = $_POST['loai'];
    $categories = [];
    $sql = "SELECT id_category, ten FROM loai";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    } else {
        echo "Không có danh mục nào được tìm thấy.";
    }

    // Xử lý upload hình ảnh (nếu có)
    // Đảm bảo rằng $_FILES['image']['name'] không rỗng để biết có file được upload không
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../../../public/items/images/";
        echo $target_dir;
        $new_file = $_FILES['image']['name'];
        $new_path = pathinfo($new_file);
        $new_filename = $new_path['filename'];
        $ext = $new_path['extension'];
        $temp_name = $_FILES['image']['tmp_name'];
        $new_path_filename_ext = $target_dir . $new_filename . "." . $ext;

        // Lấy đường dẫn hình ảnh cũ từ cơ sở dữ liệu
        $sql = "SELECT image FROM items WHERE id_item = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $old_image = $result->fetch_assoc()['image'];

        // Xóa hình ảnh cũ nếu tồn tại
        if (!empty($old_image) && file_exists($target_dir . $old_image)) {
            unlink($target_dir . $old_image);
        }

        // Kiểm tra xem file mới đã tồn tại chưa
        if (file_exists($new_path_filename_ext)) {
            echo "File đã tồn tại.";
        } else {
            // Di chuyển file từ thư mục tạm thời đến thư mục đích
            move_uploaded_file($temp_name, $new_path_filename_ext);
            echo "File hình ảnh được tải lên thành công.";

            // Cập nhật đường dẫn file mới vào cơ sở dữ liệu
            $updateSql = "UPDATE items SET image = ? WHERE id_item = ?";
            $updateStmt = $conn->prepare($updateSql);
            $new_image_path = $new_filename . "." . $ext;
            $updateStmt->bind_param("si", $new_image_path, $productId);
            $updateStmt->execute();
        }
    }


    // Truy vấn cập nhật thông tin sản phẩm
    $updateSql = "UPDATE items SET name_item = ?, price = ?, quantity = ?, tom_tat = ?, noi_dung = ?, loai = ? WHERE id_item = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sdisssi", $name_item, $price, $quantity, $tom_tat, $noi_dung, $loai, $productId);
    if ($updateStmt->execute()) {
        echo "Sản phẩm đã được cập nhật thành công.";
        // Chuyển hướng sau khi cập nhật thành công
        header("Location: http://localhost/BaiTapNhom_CNPM_2/Shopyy/app/views/admin/index?action=2");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa sản phẩm</title>
    <style>
        body {
            background-color: rgb(251, 85, 51);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            background: #fff;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .form-group input[type="submit"] {
            outline-color: rgb(238, 75, 43);
            background: rgb(238, 75, 43);
            width: 100%;
            padding: 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Phong cách cho hình ảnh sản phẩm (nếu cần) */
        .product-image-preview {
            width: 100%;
            height: 200px;
            margin-bottom: 15px;
            background-size: cover;
            background-position: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Chỉnh sửa sản phẩm</h2>
        <form action="edit_product.php?id=<?php echo $productId; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name_item">Tên sản phẩm:</label>
                <input type="text" id="name_item" name="name_item" value="<?php echo $product['name_item']; ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="price">Giá sản phẩm:</label>
                <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>
            </div>

            <div class="form-group">
                <label for="tom_tat">Tóm tắt:</label>
                <textarea id="tom_tat" name="tom_tat"><?php echo $product['tom_tat']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="noi_dung">Nội dung:</label>
                <textarea id="noi_dung" name="noi_dung"><?php echo $product['noi_dung']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="loai">Danh mục:</label>
                <select id="loai" name="loai">
                    <?php
                    foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id_category']; ?>" <?php echo $category['id_category'] == $product['loai'] ? 'selected' : ''; ?>>
                            <?php echo $category['ten']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh sản phẩm:</label>
                <input type="file" id="image" name="image">
            </div>

            <div class="form-group">
                <input type="submit" value="Lưu thay đổi">
            </div>
        </form>
    </div>

</body>

</html>