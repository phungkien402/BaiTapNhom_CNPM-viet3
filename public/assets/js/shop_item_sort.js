let currentPage = 0;
const itemsPerRow = 5;
const totalRows = 5;
const products = document.querySelectorAll('.grid__column-2-4');

function showPage(page) {
    const start = page * totalRows * itemsPerRow;
    const end = start + totalRows * itemsPerRow;

    for (let i = 0; i < products.length; i++) {
        if (i >= start && i < end) {
            products[i].style.display = 'block';
        } else {
            products[i].style.display = 'none';
        }
    }
}

function prevPage(event) {
    event.preventDefault();
    if (currentPage > 0) {
        currentPage--;
        showPage(currentPage);
        updatePageNumber();
    }
}

function nextPage(event) {
    event.preventDefault();
    const totalPages = Math.ceil(products.length / (totalRows * itemsPerRow));
    if (currentPage < totalPages - 1) {
        currentPage++;
        showPage(currentPage);
        updatePageNumber();
    }
}

function updatePageNumber() {
    const totalPages = Math.ceil(products.length / (totalRows * itemsPerRow));
    const pageNumberElement = document.querySelector('.home-filter__page-current');
    pageNumberElement.textContent = currentPage + 1 + '/' + totalPages;

    const prevButton = document.querySelector('.home-filter__page-btn--disabled');
    const nextButton = document.querySelector('.home-filter__page-btn');

    if (currentPage === 0) {
        prevButton.classList.add('home-filter__page-btn--disabled');
    } else {
        prevButton.classList.remove('home-filter__page-btn--disabled');
    }

    if (currentPage === totalPages - 1) {
        nextButton.classList.add('home-filter__page-btn--disabled');
    } else {
        nextButton.classList.remove('home-filter__page-btn--disabled');
    }
}
// Hiển thị trang đầu tiên khi tải trang
function sortByPrice(order) {
    const productList = Array.from(products);

    const sortedProductList = productList.sort((a, b) => {
        const priceA = parseFloat(a.querySelector('.home-sanpham-item-gia-hientai').innerText.replace('đ', '').replace('.', ''));
        const priceB = parseFloat(b.querySelector('.home-sanpham-item-gia-hientai').innerText.replace('đ', '').replace('.', ''));

        return order === 'asc' ? priceA - priceB : priceB - priceA;
    });

    const appContent = document.querySelector('.app__content');
    const gridRow = appContent.querySelector('.grid__row');

    const productContainer = document.createElement('div');
    productContainer.classList.add('grid__row'); // Tạo một div mới để chứa sản phẩm

    sortedProductList.forEach(product => {
        productContainer.appendChild(product);
    });

    gridRow.innerHTML = ''; // Xóa chỉ các sản phẩm trong grid__row cũ
    gridRow.appendChild(productContainer); // Thêm sản phẩm mới đã sắp xếp vào grid__row

    currentPage = 0;
    showPage(currentPage);
    updatePageNumber();
}

const priceSortLinks = document.querySelectorAll('.select--input__link');
priceSortLinks.forEach(link => {
    link.addEventListener('click', function (event) {
        event.preventDefault();
        const sortType = this.innerText === 'Thấp đến Cao' ? 'asc' : 'desc';
        sortByPrice(sortType);
    });
});

showPage(currentPage);
updatePageNumber();