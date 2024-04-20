
<style>
    @media screen and (max-width: 620px) {
    .shop__header {
        display: none;
    }
    .page-product {
        position: relative;
        top: 0;
        width: 100%;
        height: 100vh;
        padding-top: 0;
        margin: auto;
    }

    .product-briefing {
        display: block;
        position: relative;
    }

    .product_img {
        width: auto;
        padding: 0;
    }

    .description-action {
        position: sticky;
        bottom: 0;
        margin-top: 0;
        margin-bottom: 0;
    }

    .product_description {
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        padding: 0;
        margin-top: 15px;
    }

    .description-name {
        margin: auto;
        width: 90%;
    }

    .description-rating {
        margin-left: 20px;
    }

    .description-price {
        margin-bottom: 5px;
    }

    .description-price h3 {
        padding: 0;
        padding-left: 10px;
    }

    .btn {
        width: 100%;
        margin: 0;
        border-radius: 0;
    }
    
    .product_nav {
        margin-top: 8px;
        display: flex;
        width: 100%;
        position: absolute;
        height: 40px;
    }
    
    .nav-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 42px;
        font-size: 22px;
        color: white;
        border-radius: 50%;
        padding: 5px;
        background: rgba(0, 0, 0, 0.2);
    }
    
    .nav_back {
        margin-left: 8px;
    }
    
    .nav_cart {
        margin-right: 8px;
        margin-left: calc(100% - 100px);
    }


}
</style>
<div class="page-product">
    <div class="container">
        <div class="product-briefing flex card">
            <div class="flex product_nav">
                <i class="nav-icon ti-arrow-left nav_back"></i>
                <i class="nav-icon ti-shopping-cart nav_cart"></i>
            </div>
            <div class="product_img">
                <picture>
                    <div class="home-sanpham-item-anh-details" style="Background-image: url('')"></div>
                </picture>
            </div>
            <div><input type="hidden" id="product_Id" value="YOUR_PRODUCT_ID_HERE"></div>
            <div>
                <div class="flex">
                    <div class="product_description flex flex-column">
                        <div class="description-name">
                            <span id="productName">
                            </span>
                        </div>
                        <div class="description-rating">
                            <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                            <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                            <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                            <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="description-price h3">
                            <h3 id="productPrice"></h3>
                        </div>
                        <div class="description-transport">
                            <div class="flex flex-column">
                                <section class="flex">

                                    <h3 class="abc">Vận chuyển</h3>
                                    <div style="margin-right: 1px; margin-top: 6px; margin-left: 15px;" class="">
                                        <i class="ti-truck truck-icon"></i>
                                    </div>
                                    <div class="flex">

                                        <div class="flex flex-column">
                                            <div class="address flex flex-column">
                                                <div class="">
                                                    <label style="margin-right: 12px;" for="tinhThanh">Vận chuyển
                                                        tới:</label>
                                                    <select id="tinhThanh"></select>
                                                </div>
                                                <div>
                                                    <label style="margin-right: 32px;" for="huyen">Chọn huyện:</label>
                                                    <select id="huyen"></select>
                                                </div>
                                                <div>
                                                    <label for="xa">Chọn xã/phường:</label>
                                                    <select id="xa"></select>
                                                </div>
                                                <script src="../assets/js/address.js"></script>
                                            </div>
                                            <div class="flex delivery-fee">
                                                <div class="">phí vận chuyển: </div>
                                                <div>
                                                    <div class="drawer">
                                                        <div class="flex items-center">₫99.000</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="description-action">
                            <div class="flex">
                                <button id="add-to-cart-button" class="btn flex add-to-cart" onclick="add_to_cart()">
                                    <i class="fa-solid fa-cart-plus cart-add-icon"></i>
                                    Thêm vào giỏ hàng
                                </button>
                                <!-- <button class="btn purchase"  -->
                                    <a class="btn purchase" href="<?php echo _WEB_ROOT ?>/home/cart">Mua ngay </a>
                                    <!-- Mua ngay -->
                                <!-- </button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo _WEB_ROOT ?>/public/js/items/add_to_cart.js"></script>
<script src="<?php echo _WEB_ROOT ?>/public/js/items/product.js"></script>
