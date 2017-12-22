<h2>送料一覧管理</h2>

<br><br>

<table style="font-size:9px;">

    <?php echo $this->Html->tableHeaders(array('id', 'method', '重量（g）', 'price')); ?>
    
    <?php $ct=0; foreach ($Shippinglist as $shippinglist) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $shippinglist['Shippinglist']['id'],
        $shippinglist['Shippinglist']['method'],
        $shippinglist['Shippinglist']['jyuryou'],
        $shippinglist['Shippinglist']['price']
        
    )); ?>
    <?php $ct++;} ?>
</table>
<?php echo $this->Form->end(); ?><!-- forminsert -->
