<h2>Typelist一覧管理</h2>

<br><br>

<table style="font-size:9px;">

    <?php echo $this->Html->tableHeaders(array('id', 'method', '重量（g）', 'price')); ?>
    
    <?php $ct=0; foreach ($Typelist as $typelist) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $typelist['Typelist']['id']
        
    )); ?>
    <?php $ct++;} ?>
</table>
<?php echo $this->Form->end(); ?><!-- forminsert -->
