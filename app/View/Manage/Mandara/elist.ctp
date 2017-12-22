<h2>メルカリ商品管理</h2>

<br><br>



<table>
<tr>
<td>
CSV新規入力
<?php echo $this->Form->create('mandara', array('type' => 'file', 'url' => 'csvimport', 'name' => 'csvimport')); ?>
<form action="mandara/csvimport" method="post" enctype="multipart/form-data">
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
<?php echo $this->Form->create('mandara', array('type' => 'file', 'url' => 'csvimport', 'name' => 'csvimport')); ?>
<form action="mandara/csvimport" method="post" enctype="multipart/form-data">
<input type="file" name="csv" id="csv">
<select name="categolyno">
    <option value="">-</option>
    <option value="106921">sinamorall</option>
</select>
<input type="submit" name="CSV入力">
<?php echo $this->Form->end(); ?><!-- forminsert -->
</td>
<td>
<a href="mandara/download_csv">csv出力</a>
<a href="mandara/asintoean">asin→jan</a>
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


<?php echo $this->Form->create('mandara', array('type' => 'post', 'url' => 'upadate', 'name' => 'forminsert')); ?>
<br>
※googleChrlome翻訳ボタン押してから　<input type="submit" name="formsubmit" value="一括保存">

</center>
<br>

<table style="font-size:9px;">

    <?php 
    
    echo $this->Html->tableCells(
    	array(
    	'',
    	'',
    	'<a href="mandara/imgcheck">画像CHK</a>',
    	'',
    	'',
    	'',
    	'',
    	'<input type="button" value="entitleに一括copy" onclick="entitleIkkatsucopy(this)">',
    	'',
    	'<input type="text" name="addprice" value="" size="4"/>',
    	'<input type="button" value="一括価格" onclick="Ikkatsuprice(this)">',
    	'<input type="button" value="endesに一括copy" onclick="endesIkkatsucopy(this)">',
    	'',
    	'' ));
    	
     ?>
     
    <?php echo $this->Html->tableHeaders(array('del', 'id', 'img01', 'img02', 'img03', 'img04', 'url', 'jptitle', 'entitle', 'price', 'addprice', 'jpdes', 'endes' )); ?>
    
    <?php $ct=0; foreach ($Mandara as $mandara) { ?>
    
    <?php echo $this->Html->tableCells(array(
        $this->Html->link('削除',array('action'=>'delete',$mandara['Mandara']['id'])), 
        $this->Form->hidden('id', array('value' => $mandara['Mandara']['id'], 'name' => 'data[mandara][id][' . $ct . ']')).$mandara['Mandara']['id'].
        $this->Form->hidden('ct', array('value' => '', 'name' => 'ct')),
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $mandara['Mandara']['itemurl'] . "_" . $mandara['Mandara']['img01'] .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $mandara['Mandara']['itemurl'] . "_" . $mandara['Mandara']['img02']  .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $mandara['Mandara']['itemurl'] . "_" . "_" . $mandara['Mandara']['img03']  .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<img src="https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $mandara['Mandara']['itemurl'] . "_" . "_" . $mandara['Mandara']['img04']  .'.jpg" width="60" height="60">'
        .'<br><button>削</button>',
        '<a href="https://item.mercari.com/jp/' . $mandara['Mandara']['itemurl'] . '/" target="_blank">url</a>',
        $this->Form->textarea('jptitle', array('cols' => '24', 'rows' => '6', 'value' => $mandara['Mandara']['jptitle'], 'name' => 'data[mandara][jptitle][' . $ct . ']')) . "<p style='font-size:1px;' class='jptitledis'>" . $mandara['Mandara']['jptitle']. "</p><br><input type='button' value='entitleにcopy' onclick='entitlecopy(" . $ct . ")'>",
        array($this->Form->textarea('entitle', array('cols' => '24', 'rows' => '6', 'value' => $mandara['Mandara']['entitle'], 'name' => 'data[mandara][entitle][' . $ct . ']')),array('width' => '140px')),
        array($this->Form->text('price', array('size' => '5', 'value' => $mandara['Mandara']['price'], 'name' => 'data[mandara][price][' . $ct . ']')),array('width' => '40px')),
        $this->Form->text('addprice', array('size' => '3', 'value' => $mandara['Mandara']['addprice'], 'name' => 'data[mandara][addprice]')),
        array($this->Form->textarea('jpdes', array('cols' => '28', 'rows' => '12', 'value' => $mandara['Mandara']['jpdes'], 'name' => 'data[mandara][jpdes][' . $ct . ']')) . "<p style='font-size:1px;' class='jpdesdis'>" . $mandara['Mandara']['jpdes']."</p><br><input type='button' value='endesにcopy' onclick='endescopy(this)'>",array('width' => '100px')),
        array($this->Form->textarea('endes', array('cols' => '28', 'rows' => '12', 'value' => $mandara['Mandara']['endes'], 'name' => 'data[mandara][endes][' . $ct . ']')),array('width' => '100px')),
        
    )); ?>
    <?php $ct++;} ?>
</table>
<?php echo $this->Form->end(); ?><!-- forminsert -->

<script type="text/javascript">

// title 個別コピー
function entitlecopy(idkobetsu) {
    //var entitle="data[mandara][entitle][" + idkobetsu + "]";
    document.getElementsByName("data[mandara][entitle][" + idkobetsu + "]")[0].value = document.getElementsByClassName("jptitledis")[idkobetsu].innerText;
}

// title 一括コピー
var entitleIkkatsucopy = function (button) {
// alert("title 一括コピー");
for(var n=0; n <101;n++){
        //for(var n=0; n <document.getElementsByName("ct").length;n++){
    document.getElementsByName("data[mandara][entitle][" + n + "]")[0].value = document.getElementsByClassName("jptitledis")[n].innerText;
}
// var aaa = document.getElementsByName("data[mandara][jptitle][0]")[0].value;
}

// endes 個別コピー
var endescopy = function (button) {
    
alert("endes 個別コピー");

}

// endes  一括コピー
var endesIkkatsucopy = function (button) {
// alert("title 一括コピー");
for(var n=0; n <101;n++){
        //for(var n=0; n <document.getElementsByName("ct").length;n++){
    document.getElementsByName("data[mandara][endes][" + n + "]")[0].value = document.getElementsByClassName("jpdesdis")[n].innerText;
}
// var aaa = document.getElementsByName("data[mandara][jptitle][0]")[0].value;
}


// 一括価格入力
var Ikkatsuprice = function (button) {
// alert("title 一括コピー");
for(var n=0; n <101;n++){
        //for(var n=0; n <document.getElementsByName("ct").length;n++){
    document.getElementsByName("data[mandara][addprice]")[n].value = document.getElementsByClassName("addprice")[0].value;
}
// var aaa = document.getElementsByName("data[mandara][jptitle][0]")[0].value;
}

</script>