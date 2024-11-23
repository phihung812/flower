<div class="history-order">
    <div class="title-history-order">
        <p>Lịch sử đơn hàng</p>
    </div>
    <?php if (isset($inforOrder) && $inforOrder) { ?>
        <table border="1">
            <tr class="thead">
                <td>ID đơn hàng</td>
                <td>Khách hàng</td>
                <td>Số lượng</td>
                <td>Tổng cộng</td>
                <td>Trạng thái</td>
                <td>Thời gian</td>
                <td>Thao tác</td>
            </tr>
            <?php foreach ($inforOrder as $order) { ?>
                <tr class="tbody">
                    <td>#<?php echo $order->id ?></td>
                    <td><?php echo $order->name ?></td>
                    <td><?php echo $order->total_items ?></td>
                    <td><?php echo $order->total_price ?></td>
                    <td><?php echo $order->status ?></td>
                    <td><?php echo $order->created_at ?></td>
                    <td class="thaotac" style="text-align:center;">
                        <?php if ($order->status != 'delivered' && $order->status != 'canceled') { ?>
                            <a href="index.php?act=myAccount&check=cancleOrder&order_id=<?php echo $order->id ?>">
                                <button>Hủy đơn</button>
                            </a>
                        <?php } else ?>

                        <a href="index.php?act=myAccount&check=detailOrder&order_id=<?php echo $order->id ?>">
                            <button class="btn-ctdh"><i class="fa-regular fa-eye"></i></button>
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <h2>Bạn chưa có đơn hàng nào</h2>
    <?php } ?>
</div>