<h2>Amazonus商品管理</h2>

<br>
<br>


<table>
<tr>
<td>
CSV新規入力
<?php echo $this->Form->create('amazonus', array('type' => 'file', 'url' => 'csvimport', 'name' => 'csvimport')); ?>
<input type="file" name="csv" id="csv">
<select name="categolyno" >
    <option value="">-</option>
    <option value="106921">sinamorall</option>
</select>
<input type="submit" name="CSV入力">
<?php echo $this->Form->end(); ?><!-- forminsert -->
</td>
<td>
CSV追加入力
<?php echo $this->Form->create('amazonus', array('type' => 'file', 'url' => 'csvimport', 'name' => 'csvimport')); ?>
<input type="file" name="csv" id="csv">
<?php echo $this->Form->text('cateName', array('size' => '4', 'value' => '')); ?>

<input type="submit" name="CSV入力">
<?php echo $this->Form->end(); ?><!-- forminsert -->
</td>
<td>
<a href="amazonus/download_csv">csv出力</a>
</td>
<td><button class="button action">amazon.com用CSV出力</button>　最新出力日時：2017/11/15</td>
</tr>
</table>

<br>
<center>
<?php
echo $this->Paginator->prev('前へ' . __(''), array(), null, array('class' => 'prev disabled'));
?>

<?php echo $this->Paginator->numbers(); ?>   

<?php
echo $this->Paginator->next(__('') . ' 次へ', array(), null, array('class' => 'next disabled'));
?>
<?php echo "  (全件：" . $this->Paginator->params()["count"] . "件）" ?> 
<?php
echo $this->Paginator->counter(array(
    'format' => __('({:page}/{:pages}ページを表示）')
));
?>

<?php echo "  (表示：" . $this->Paginator->params()["limit"] . "件）" ?>   


<?php echo $this->Form->create('amazonus', array('type' => 'post', 'url' => 'upadate', 'name' => 'forminsert')); ?>
<br>
※googleChrlome翻訳ボタン押してから　<input type="submit" name="formsubmit" value="一括保存">

</center>
<br>

<table style="font-size:9px;">
    <?php echo $this->Html->tableCells(array('','','','','','','', '<input type="button" value="entitleに一括copy" onclick="entitleIkkatsucopy(this)">', '', '<input type="text" name="addprice" value="" size="4"/>', '<input type="button" value="一括価格入力" onclick="Ikkatsuprice(this)">', '<input type="button" value="endesに一括copy" onclick="endesIkkatsucopy(this)">', '', '' )); ?>
    <?php echo $this->Html->tableHeaders(array('del', 'id', 'img01', 'img02', 'img03', 'img04', 'url', 'jptitle', 'entitle', 'price', 'addprice', 'jpdes', 'endes' )); ?>
    
    <?php $ct=0; foreach ($Amazonus as $amazonus) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $this->Html->link('削除',array('action'=>'delete',$amazonus['Amazonus']['id'])), 
        $this->Form->hidden('id', array('value' => $amazonus['Amazonus']['id'], 'name' => 'data[itemlist][id][' . $ct . ']')).$amazonus['Amazonus']['id'].
        $this->Form->hidden('ct', array('value' => '', 'name' => 'ct')),
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $amazonus['Amazonus']['itemurl']) )  . "_" . $amazonus['Amazonus']['img01'] .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $amazonus['Amazonus']['itemurl']) )  . "_" . $amazonus['Amazonus']['img02']  .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $amazonus['Amazonus']['itemurl']) )  . "_" . $amazonus['Amazonus']['img03']  .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $amazonus['Amazonus']['itemurl']) )  . "_" . $amazonus['Amazonus']['img04']  .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<a href="' . $amazonus['Amazonus']['itemurl'] . '" target="_blank">url</a>',
        $this->Form->textarea('jptitle', array('cols' => '24', 'rows' => '6', 'value' => $amazonus['Amazonus']['jptitle'], 'name' => 'data[amazonus][jptitle][' . $ct . ']')) . "<p style='font-size:1px;' class='jptitledis'>" . $amazonus['Amazonus']['jptitle']. "</p><br><input type='button' value='entitleにcopy' onclick='entitlecopy(" . $ct . ")'>",
        $this->Form->textarea('entitle', array('cols' => '24', 'rows' => '6', 'value' => $amazonus['Amazonus']['entitle'], 'name' => 'data[amazonus][entitle][' . $ct . ']')),
        $this->Form->text('price', array('size' => '3', 'value' => $amazonus['Amazonus']['price'], 'name' => 'data[amazonus][price][' . $ct . ']')),
        $this->Form->text('addprice', array('size' => '3', 'value' => $amazonus['Amazonus']['addprice'], 'name' => 'data[amazonus][addprice]')),
        $this->Form->textarea('jpdes', array('cols' => '28', 'rows' => '12', 'value' => $amazonus['Amazonus']['jpdes'], 'name' => 'data[amazonus][jpdes][' . $ct . ']')) . "<p style='font-size:1px;' class='jpdesdis'>" . $amazonus['Amazonus']['jpdes']."</p><br><input type='button' value='endesにcopy' onclick='endescopy(this)'>",
        $this->Form->textarea('endes', array('cols' => '28', 'rows' => '12', 'value' => $amazonus['Amazonus']['endes'], 'name' => 'data[amazonus][endes][' . $ct . ']')),
        
    )); ?>
    <?php $ct++;} ?>
</table>
<?php echo $this->Form->end(); ?><!-- forminsert -->