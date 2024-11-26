<div class="repass">
    <div class="title-repass">
        <h1>Đổi mật khẩu</h1>
        <p>Mật khẩu của bạn</p>
    </div>
    <form action="" method="POST" class="frm-repass" onsubmit="return validateSubmit()">
        <div class="ipt-repass">
            <span>* </span><label for="">Mật khẩu cũ</label>
            <input type="password" required name="passOld" id="" placeholder="Mật khẩu">
        </div>
        <div class="ipt-repass">
            <span>* </span><label for="">Xác nhân mật khẩu mới</label>
            <input type="password" required name="passNew" id="passNew" placeholder="Mật khẩu">
        </div>
        <?php if (isset($thongbao) && $thongbao != "") { ?>
            <h4 style="color:red; text-align:center;"><?php echo $thongbao ?></h>
            <?php } ?>
            <button type="submit" name="submit-rePass">Tiếp tục</button>
    </form>
</div>
<script>
    function validateSubmit() {
        var passNew = document.getElementById('passNew');
        if (passNew.value.length < 6) {
            alert('Mật khẩu phải từ 6 kí tự trở lên');
            return false;
        }
        return confirm("Xác nhận đổi mật khẩu");

    }
</script>