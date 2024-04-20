<p class="category_header" >thêm danh mục sản phẩm</p>
<table class="category_table" border="1" style="border-collapse: collapse;">
        <tr class="row_category_header">
            <td class="list_header" ><span>mã danh mục</span></td>
            <td><input class="input" type="text" id="madanhmuc" name="madanhmuc" autocomplete="off" placeholder="mã danh mục sản phẩm"></td>
            <div id='error_id_category'></div>
        </tr>
        <tr class="row_category_header">
            <td class="list_header" ><span>tên danh mục</span></td>
            <td><input class="input" width="100%" type="text" id="tendanhmuc" name="tendanhmuc" autocomplete="off" placeholder="tên danh mục sản phẩm" ></td>
            <div id='error_ten'></div>
        </tr>
        <tr>
            <td colspan="2" class="submit_btn" >
                <button id="submit" type="submit" class="btn btn_danhmuc" onclick="insertForm()">thêm danh mục</button>
            </td>
        </tr>
</table>