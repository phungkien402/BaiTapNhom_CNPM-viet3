// Lấy danh sách tất cả các phần tử có class "product_item-checked"
const productItems = document.querySelectorAll('.product_item-checked');

// Duyệt qua từng phần tử và gán giá trị của "product-price" cho "product-sum-price"
productItems.forEach(item => {
    // Lấy giá trị của "product-price"
    const price = item.querySelector('.product-price').textContent.trim();
    
    // Gán giá trị của "product-price" cho "product-sum-price"
    item.querySelector('.product-sum-price').textContent = price;
});

document.addEventListener('DOMContentLoaded', function() {
    const increaseBtns = document.querySelectorAll('.Increase');
    const decreaseBtns = document.querySelectorAll('.Decrease');
    const quantities = document.querySelectorAll('.num');
    const prices = document.querySelectorAll('.product-price');
    const sumPrices = document.querySelectorAll('.product-sum-price');
    const deleteButtons = document.querySelectorAll('.action-delete');
    const totalElement = document.getElementById('total'); // Thẻ hiển thị tổng giá

    function calculateTotal() {
        const productItems = document.querySelectorAll('.product_item');
        let total = 0;
    
        productItems.forEach(item => {
            const checkbox = item.querySelector('.checkbox-box-input');
            const price = item.querySelector('.product-sum-price').textContent.trim().replace('₫', '').replace(/\./g, '');
            
            if (checkbox.checked) {
                total += parseInt(price);
            }
        });
    
        return total;
    }
    const productCheckboxes = document.querySelectorAll('.checkbox-box-input');
    productCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const totalPriceElement = document.querySelector('.payment-summary .summary-item.total span:last-child');
            const totalPrice = calculateTotal();
    
            // Hiển thị tổng giá trị trong phần "payment-summary"
            totalPriceElement.textContent = '₫' + totalPrice.toLocaleString();
        });
    });
    function updateTotalPrice() {
        const totalPrice = calculateTotal();
        totalElement.textContent = formatCurrency(totalPrice); // Hiển thị tổng giá
    }

    
    function formatCurrency(amount) {
        return '₫' + amount.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    }

    increaseBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            let currentQuantity = parseInt(quantities[index].textContent);
            currentQuantity++;
            quantities[index].textContent = currentQuantity;

            const priceText = prices[index].textContent.trim().replace('₫', '').replace(/\./g, '');
            const price = parseFloat(priceText);

            const newSumPrice = price * currentQuantity;
            sumPrices[index].textContent = formatCurrency(newSumPrice);

            updateTotalPrice();
        });
    });

    decreaseBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            let currentQuantity = parseInt(quantities[index].textContent);
            if (currentQuantity > 1) {
                currentQuantity--;
                quantities[index].textContent = currentQuantity;

                const priceText = prices[index].textContent.trim().replace('₫', '').replace(/\./g, '');
                const price = parseFloat(priceText);

                const newSumPrice = price * currentQuantity;
                sumPrices[index].textContent = formatCurrency(newSumPrice);

                updateTotalPrice();
            }
        });
    });

    deleteButtons.forEach((btn) => {
        btn.addEventListener('click', function() {
            const productItem = btn.closest('.product_item');
            productItem.remove();
            updateTotalPrice();
        });
    });

    // Hiển thị tổng giá khi trang web được tải lần đầu
    updateTotalPrice();
});
