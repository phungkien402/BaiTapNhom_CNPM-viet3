<p class="category_header">thêm sản phẩm</p>
<div class="admin-content">
    <table  class="category_table-qlsp" dwidth="70%" border="1" style="border-collapse: collapse;">
        <div>
            <tr>
                <td class="list_header">
                    tên sản phẩm
                </td>
                <td>
                    <input class="input" id="name_item" width="100%" type="text" name="tensanpham"
                        placeholder="tên sản phẩm" autocomplete="off">
                    <div id='error_name_item'></div>
                </td>
            </tr>
            <tr>
                <td class="list_header">
                    mã sản phẩm
                </td>
                <td>
                    <input class="input" id="id_item" width="100%" type="text" name="masanpham"
                        placeholder="mã sản phẩm" autocomplete="off">
                    <div id='error_id_item'></div>
                </td>
            </tr>
            <tr>
                <td class="list_header">
                    giá sản phẩm
                </td>
                <td>
                    <input class="input" id="price" width="100%" type="text" name="giasanpham"
                        placeholder="giá sản phẩm" autocomplete="off">
                    <div id='error_price'></div>
                </td>
            </tr>
            <tr>
                <td class="list_header">
                    số lượng
                </td>
                <td>
                    <input class="input" id="quantity" width="100%" type="text" name="soluong"
                        placeholder="số lượng sản phẩm" autocomplete="off">
                    <div id='error_quantity'></div>
                </td>
            </tr>
            <tr>
                <td class="list_header">
                    hình ảnh
                </td>
                <td>
                    <input class="input btn btn-image" id="image" width="100%" type="file" name="hinhanh">
                    <div id='error_image'></div>
                </td>
            </tr>
            <tr>
                <td class="list_header">
                    tóm tắt
                </td>
                <td>
                    <textarea class="input" id="tom_tat" rows="5" name="tomtat" placeholder="tóm tắt sản phẩm"
                        autocomplete="off"></textarea>
                    <div id='error_tom_tat'></div>
                </td>
            </tr>
            <tr>
                <td class="list_header">
                    nội dung
                </td>
                <td>
                    <textarea class="input" id="noi_dung" rows="5" name="noidung" placeholder="nội dung sản phẩm"
                        autocomplete="off"></textarea>
                    <div id='error_noi_dung'></div>
                </td>
            </tr>
            <tr>
                <td class="list_header">danh mục sản phẩm</td>
                <td>
                    <select class="custom-select" name="danhmuc" id="danhmucSelect">

                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button id="submit" type="submit" class="btn btn_danhmuc" onclick="insertForm()">Thêm sản phẩm</button>
                </td>
            </tr>

        </div>
    </table>
    <script src="<?php echo _WEB_ROOT ?>/public/js/admin/loai.js"></script>

    <div style="background:url('${item.image}');"></div>
</div>