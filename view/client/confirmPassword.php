<main>
    <div class="account">
        <div class="repass">
            <div class="title-repass">
                <h1>Đặt mật khẩu mới</h1>
                <p>Xác nhận mật khẩu mới</p>
            </div>
            <form action="" method="POST" class="frm-repass" onsubmit="return validateSubmit()">
                <div class="ipt-repass">
                    <span>* </span><label for="">Mật khẩu mới</label>
                    <input type="password" name="passwordNew" id="passwordNew" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="ipt-repass">
                    <span>* </span><label for="">Xác nhận mật khẩu</label>
                    <input type="password" name="passwordConfirm" id="" placeholder="Xác nhận mật khẩu">
                </div>
                <button type="submit" name="submit-confirmPassword">Tiếp tục</button>
            </form>
        </div>
        <div class="group-login">
            <div class="item-login">
                <a href="index.php?act=login">Đăng nhập</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=register">Đăng ký</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=forgotPassword">Đã quên mật khẩu</a>
            </div>
            <div class="item-login">
                <a href="index.php?act=myAccount&check=historyOrder">Lịch sử đơn hàng</a>
            </div>
            <div class="item-login">
                <a href="index.php">Quay lại trang chủ</a>
            </div>

        </div>
    </div>
</main>
<script>
    function validateSubmit() {
        var passNew = document.getElementById('passwordNew');
        if (passNew.value.length < 6) {
            alert('Mật khẩu phải từ 6 kí tự trở lên');
            return false;
        }

    }
</script>