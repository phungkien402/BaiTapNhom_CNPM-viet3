// Đọc dữ liệu của input `file`
var file = document.querySelector("#image")[0].files[0];

// Chuyển dữ liệu của input `file` thành một chuỗi base64
var base64 = await file.arrayBuffer().then(buffer => btoa(new Uint8Array(buffer)));

// Sử dụng phương thức `fetch()` để gửi dữ liệu lên server
fetch(BASE_URL+"/admin/requestAdmin?url=adminRequest/postItem", {
  method: "POST",
  body: `image=${base64}`,
})
  .then(function(response) {
    // Xử lý kết quả trả về từ server
    if (response.ok) {
      console.log("Đã gửi dữ liệu thành công");
    } else {
      console.log("Có lỗi xảy ra");
    }
  })
  .catch(function(error) {
    console.log(error);
  });