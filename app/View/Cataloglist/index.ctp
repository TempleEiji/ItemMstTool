<h2>カタログ一覧管理</h2>

<br><br>

<table style="font-size:9px;">

    <?php echo $this->Html->tableHeaders(array('id', 'method', '重量（g）', 'price')); ?>
    
    <?php $ct=0; foreach ($Cataloglist as $cataloglist) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $cataloglist['Cataloglist']['id'],
        
    )); ?>
    <?php $ct++;} ?>
</table>
<?php echo $this->Form->end(); ?><!-- forminsert -->
