<h2>Categoly一覧管理</h2>

<br><br>

<table style="font-size:9px;">

    <?php echo $this->Html->tableHeaders(array('id', 'method', '重量（g）', 'price')); ?>
    
    <?php $ct=0; foreach ($Categolylist as $categolylist) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $categolylist['Categolylist']['id']
        
    )); ?>
    <?php $ct++;} ?>
</table>
<?php echo $this->Form->end(); ?><!-- forminsert -->
