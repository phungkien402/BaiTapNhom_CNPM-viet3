function add_to_cart() {
    var id;
    var name = "";
    var productId = document.getElementById('product_Id').value;
    data = {
        product_id: productId,
        quantity: 1,
    }

    $.ajax({
        url: BASE_URL + '/home/requestHome?url=homeRequest/add_to_cart',
        type: 'POST',
        data: data,
        success: function (response) {
            console.log(response);
            alert("Đã thêm sản phẩm vào giỏ hàng")
        },
        error: function (error) {
            console.error('Lỗi khi gửi dữ liệu:', error);
        }
    });
}