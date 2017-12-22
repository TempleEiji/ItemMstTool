<h2>ebaysellerinfo一覧管理</h2>

<br><br>

<table style="font-size:9px;">

    <?php echo $this->Html->tableHeaders(array('id', 'method', '重量（g）', 'price')); ?>
    
    <?php $ct=0; foreach ($Ebaysellerinfo as $ebaysellerinfo) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $ebaysellerinfo['Ebaysellerinfo']['id']
        
    )); ?>
    <?php $ct++;} ?>
</table>
<?php echo $this->Form->end(); ?><!-- forminsert -->
