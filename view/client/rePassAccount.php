<div class="repass">
    <div class="title-repass">
        <h1>Đổi mật khẩu</h1>
        <p>Mật khẩu của bạn</p>
    </div>
    <form action="" method="POST" class="frm-repass">
        
        
        <div class="ipt-repass">
            <span>* </span><label for="">Mật khẩu cũ</label>
            <input type="password" name="passOld" id="" placeholder="Mật khẩu">
        </div>
        <div class="ipt-repass">
            <span>* </span><label for="">Xác nhân mật khẩu mới</label>
            <input s type="password" name="passNew" id="" placeholder="Mật khẩu">
        </div>
        <?php if (isset($thongbao) && $thongbao != "") { ?>
            <h4 style="color:red; text-align:center;"><?php echo $thongbao ?></h>
        <?php } ?>
        <button type="submit" name="submit-rePass">Tiếp tục</button>
    </form>
</div>