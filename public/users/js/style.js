// Hàm xử lý kết quả trả về từ AJAX
function handleResponse(response) {
  // In dữ liệu ra màn hình
  console.log(response);
  console.log('\n');
  document.write(response);
  var user = JSON.parse(response);
  document.write("user = " + user);
  // for
}

var data = {
  name: 'John Doe',
  email: 'johndoe@example.com',
  age: 30,
};

// Tạo một yêu cầu AJAX
fetch('home/detail', {
  method: 'GET', // Phương thức HTTP
})
  .then(function (response) {
    return response.text();
  })
  .then(handleResponse)
  .catch(function (error) {
    console.log('Request failed', error);
  });