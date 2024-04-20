<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/base.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/main.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/cart.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/icons/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="<?php echo _WEB_ROOT ?>/public/assets/icons/favicon.png" type="image/x-icon">

</head>

<body>
    <div class="shop">
        <header class="shop__header">
            <div class="grid">
            <?php $this->render('blocks/headerMain.php'); ?>
            </div>
            <div class="shop__cart__header-cart-page">
                <div class="cart__container">
                    <div style="display: flex; align-items: center;">
                        <div class="cart__page-header">
                            <a style="text-decoration: none;" href="<?php echo _WEB_ROOT ?>">
                                <h1 class="header-name">
                                    Giỏ Hàng
                                </h1>
                            </a>
                        </div>
                        <div class="cart__page-searchbar">
                            <div class="search-bar">
                                <div class="search-bar-main">
                                    <form role="search" class="searchbar-input" autocomplete="off">
                                        <input type="text" class="searchbar-input-input" placeholder="SEARCH">
                                    </form>
                                </div>
                                <button type="button" class="search-bar-search-btn">
                                    <i class="search-bar-btn-icon ti-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <div class="shop__cart-container">
            <div class="cart__header">
                <div class="product_checkbox">
                    <lable class="checkbox_box">
                        <input type="checkbox" class="checkbox-box-input" id="checkAll">
                    </lable>
                </div>
                <div class="product_name">Sản phẩm</div>
                <div class="product_price">Đơn giá</div>
                <div class="product_quantity">Số lượng</div>
                <div class="product_sum-price">Tổng giá</div>
                <div class="product_action">Thao tác</div>
            </div>
            <div class="cart__body">
                <div class="cart__item">
                    
                    <div data-product-id="3" class="product_item product_item-checked">
                        <div class="product-checkbox">
                            <lable class="checkbox-box">
                                <input type="checkbox" class="checkbox-box-input">
                            </lable>
                        </div>
                        <div class="product-detail">
                            <img src="https://down-vn.img.susercontent.com/file/b3251135eedb4507c26f3c29555422ff"
                                alt="">
                            <div class="product-detail-name">
                                2.
                            </div>
                        </div>
                        <div class="product-price">
                            ₫1.900
                        </div>
                        <div class="product-quantity">
                            <div class="product-input-quantity">
                                <span class="Increase">+</span>
                                <span class="num">1</span>
                                <span class="Decrease">-</span>

                            </div>
                        </div>
                        <div class="product-sum-price">
                            ₫0
                        </div>
                        <div class="product-action">
                            <button class="action-delete">
                                Xóa
                            </button>
                        </div>
                    </div>
                    <script>
                        const checkAll = document.getElementById('checkAll');
                        const productCheckboxes = document.querySelectorAll('.checkbox-box-input');

                        // Thêm sự kiện khi checkbox "Chọn tất cả" thay đổi trạng thái
                        checkAll.addEventListener('change', function () {
                            productCheckboxes.forEach(function (checkbox) {
                                checkbox.checked = checkAll.checked; // Thiết lập trạng thái checkbox dựa trên checkbox "Chọn tất cả"
                            });
                        });

                        // Lấy danh sách các nút "Xoá"
                        const deleteButtons = document.querySelectorAll('.action-delete');

                        // Duyệt qua từng nút "Xoá" và gắn sự kiện click
                        deleteButtons.forEach((button) => {
                            button.addEventListener('click', (event) => {
                                // Lấy đối tượng sản phẩm cha của nút "Xoá" được click
                                const productToDelete = event.target.closest('.product_item');

                                // Lấy ID của sản phẩm cần xoá
                                const productId = productToDelete.dataset.productId;

                                // Xoá sản phẩm đó khỏi DOM
                                if (productToDelete) {
                                    productToDelete.remove();
                                    // Ở đây bạn có thể thực hiện các thao tác xoá sản phẩm trong cơ sở dữ liệu của bạn
                                    // thông qua việc gửi request đến server hoặc xử lý ở phía server, sử dụng `productId`.
                                }
                            });
                        });

                    </script>
                </div>
                <div class="body_footer">
                    <div class="payment-summary">
                        <div class="summary-item total">
                            <span>Tổng thanh toán:</span>
                            <span>₫0</span>
                        </div>
                    </div>
                    <button class="checkout-button">Mua hàng</button>
                </div>
            </div>
        
        </div>
        <script src="<?php echo _WEB_ROOT ?>/public/assets/js/quantity.js"></script>
        <script src="<?php echo _WEB_ROOT ?>/public/js/cart/detail.js"></script>
</body>
</html>