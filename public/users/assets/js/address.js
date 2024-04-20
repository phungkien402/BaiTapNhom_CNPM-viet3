function loadDiaChi() {
    fetch('./assets/json/vietnamid.json') // Thay tên file JSON ở đây
        .then(response => response.json())
        .then(data => {
            const tinhThanhSelect = document.getElementById('tinhThanh');
            const huyenSelect = document.getElementById('huyen');
            const xaSelect = document.getElementById('xa');

            // Hiển thị danh sách tỉnh thành
            data.forEach(tinhThanh => {
                const option = document.createElement('option');
                option.text = tinhThanh.name;
                option.value = tinhThanh.code;
                tinhThanhSelect.add(option);
            });

            // Xử lý sự kiện khi chọn tỉnh thành
            tinhThanhSelect.addEventListener('change', function () {
                const selectedTinhThanhCode = parseInt(tinhThanhSelect.value);
                const selectedTinhThanh = data.find(tinhThanh => tinhThanh.code === selectedTinhThanhCode);

                huyenSelect.innerHTML = ''; // Xóa các lựa chọn cũ
                xaSelect.innerHTML = '';

                // Hiển thị danh sách huyện
                selectedTinhThanh.districts.forEach(huyen => {
                    const option = document.createElement('option');
                    option.text = huyen.name;
                    option.value = huyen.code;
                    huyenSelect.add(option);
                });
            });

            // Xử lý sự kiện khi chọn huyện
            huyenSelect.addEventListener('change', function () {
                const selectedTinhThanhCode = parseInt(tinhThanhSelect.value);
                const selectedTinhThanh = data.find(tinhThanh => tinhThanh.code === selectedTinhThanhCode);

                const selectedHuyenCode = parseInt(huyenSelect.value);
                const selectedHuyen = selectedTinhThanh.districts.find(huyen => huyen.code === selectedHuyenCode);

                xaSelect.innerHTML = ''; // Xóa các lựa chọn cũ

                // Hiển thị danh sách xã
                selectedHuyen.wards.forEach(xa => {
                    const option = document.createElement('option');
                    option.text = xa.name;
                    option.value = xa.code;
                    xaSelect.add(option);
                });
            });
        })
        .catch(error => console.error(error));
}

loadDiaChi();