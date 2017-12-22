<h2>Cronschedule一覧管理</h2>

<br><br>


<center>
<?php echo $this->Form->create('croninsert', array('type' => 'post', 'url' => 'croninsert', 'name' => 'croninsert')); ?>
<table style="font-size:11px;">

<?php 
echo $this->Html->tableCells(
    array(
    	'リスト名選択：<br>'.
    	$this->Form->input('catalogselect', array(
	    'type' => 'select', 
	    'options' => $catalogselect,
	    'div' => false,
	    'label' => false
	    )),
    	'実行時間：<br>'.
	    $this->Form->input('trigertimeselect', array(
	     	'type' => 'select', 
	        'options' => $trigertimeselect,
	        'div' => false,
	        'label' => false
	    )),
	    '<input type="submit" name="croninsert" value="自動在庫チェック登録"　size="12">'
    ));
 ?>

</table>
<?php echo $this->Form->end(); ?><!-- croninsert -->
</center>

<br><br>



<table style="font-size:9px;">

    <?php echo $this->Html->tableHeaders(array('id', '実行時間', 'リストno', 'リスト名')); ?>
    <?php $ct=0; foreach ($Cronschedule as $cronschedule) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $cronschedule['Cronschedule']['id'],
        $cronschedule['Cronschedule']['trigertime'],
        $cronschedule['Cronschedule']['listno'],
        $Cronschedule[0]['Cataloglist']['listname']
        
    )); ?>
    <?php $ct++;} ?>

</table>

