<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="shop-container">
    <div class="grid">
        <div class="grid__row app__content">
            <?php
            $this->render("pages/cattegory.php");
            ?>
            <div class="grid__column-10">
                <div class="home-filter">
                    <span class="home-filter__label">Sắp xếp theo</span>
                    <div class="select--input">
                        <span class="select--input__label">Giá</span>

                        <i class="select--input__icon ti-angle-down"></i>
                        <ul class="select--input__list">
                            <li class="select--input__item">
                                <a href="#" class="select--input__link" data-sort="asc">Thấp đến Cao</a>
                            </li>
                            <li class="select--input__item">
                                <a href="#" class="select--input__link" data-sort="desc">Cao đến Thấp</a>
                            </li>
                        </ul>
                    </div>
                    <div class="home-filter__page">
                        <span class="home-filter__page-num">
                            <span class="home-filter__page-current">1</span>
                        </span>
                        <div class="home-filter__page-control">
                            <a href="#" class="home-filter__page-btn home-filter__page-btn--disabled"
                                onclick="prevPage(event)">
                                <i class="home-filter__page-icon fas fa-angle-left"></i>
                            </a>
                            <a href="#" class="home-filter__page-btn" onclick="nextPage(event)">
                                <i class="home-filter__page-icon fas fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="home-sanpham">
                    <div id="div1" class="grid__row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.select--input__link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                var sortType = this.getAttribute('data-sort');
                sapXep(sortType);
            });
        });
    </script>
</div>