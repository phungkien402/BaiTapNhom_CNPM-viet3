var currentUrl = new URL(window.location.href);

var productId = currentUrl.searchParams.get('id');
console.log(productId);
data = {
  id: productId
}

$.ajax({
  url: BASE_URL+'/home/requestHome?url=homeRequest/detail',
  type: 'POST',
  data: data,
  success: function (response) {
    // console.log('Dữ liệu:', response);
    var dataSet = JSON.parse(response);
    // console.log(dataSet);
    var productElement = document.getElementById('product_Id');
    productElement.value = productId;
    document.getElementById('productName').innerHTML = dataSet.name_item;
    document.getElementById('productPrice').innerHTML =formatPrice(dataSet.price) + ' VNĐ';
    var imageUrl =dataSet.image;
    document.querySelector('.product_img div').style.backgroundImage = 'url(' + imageUrl + ')';
  },
  error: function (error) {
    console.error('Lỗi khi gửi dữ liệu:', error);
  }
});