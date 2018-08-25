<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php echo form_open('path/to/controller/update/method'); ?>

<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

    <tr>
        <th>QTY</th>
        <th>Item Description</th>
        <th style="text-align:right">Item Price</th>
        <th style="text-align:right">Sub-Total</th>
    </tr>

    <?php $i = 1; ?>

    <?php foreach ($this->cart->contents() as $items): ?>

        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

        <tr>
            <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
            <td>
                <?php echo $items['name']; ?>
            </td>
            <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
            <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
        </tr>

        <?php $i++; ?>

    <?php endforeach; ?>

    <tr>
        <td colspan="2"> </td>
        <td class="right"><strong>Total</strong></td>
        <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
    </tr>

</table>

<p><?php echo form_submit('', 'Update your Cart'); ?></p>
</body>
</html>