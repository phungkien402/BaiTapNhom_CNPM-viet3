const searchInput = document.getElementById('search');
const searchBtn = document.getElementById('searchBtn');

searchBtn.addEventListener('click', function() {
  const searchTerm = searchInput.value.trim(); // Lấy giá trị từ ô tìm kiếm

  // Gửi giá trị tìm kiếm lên request.php
  sendSearchRequest(searchTerm);
});

function sendSearchRequest(searchTerm) {
  // Sử dụng Fetch API hoặc XMLHttpRequest để gửi request lên server
  // Đây là một ví dụ sử dụng Fetch API
  fetch('request.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ searchTerm: searchTerm }) // Gửi giá trị tìm kiếm dưới dạng JSON
  })
  .then(response => {
    // Xử lý kết quả từ server nếu cần
  })
  .catch(error => {
    console.error('Có lỗi xảy ra:', error);
  });
}
