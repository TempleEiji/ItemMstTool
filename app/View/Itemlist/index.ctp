<h5>商品取得</h5>

<form action="scrapeset" method="post">
<table style="font-size:11px;">

<?php 
echo $this->Html->tableCells(
    array(
    'リスト名（英語明記）<input type="text" name="data[scrapeset][listname]" value="" size="4"/>
    <input type="hidden" name="data[scrapeset][userid]" value="rlist" size="4"/>
    <input type="hidden" name="data[scrapeset][getshopname]" value="mandara" size="4"/>',
    'URL入力<input type="text" name="data[scrapeset][url]" value="" size="4"/>',
    '除外ワード1<input type="text" name="data[scrapeset][delword1]" value="" size="4"/>',
    '除外ワード２<input type="text" name="data[scrapeset][delword2]" value="" size="4"/>',
    '除外ワード３<input type="text" name="data[scrapeset][delword3]" value="" size="4"/>',
    '除外ワード４<input type="text" name="data[scrapeset][delword4]" value="" size="4"/>',
    '除外ワード５<input type="text" name="data[scrapeset][delword5]" value="" size="4"/>',
    ''
));
 ?>

</table>
<center>
<input type="submit" name="formsubmit" value="取得情報セット"　size="12">　｜　<a href="mandara/mandarascrap"><button>取得開始</button></a>
</center>
</form>

<br>
<hr>
<br>

<table style="font-size:11px;">

<tr>

<td varlign="middle" width="300px" align="center">



<h5>CSV新規登録</h5><br>

<?php echo $this->Form->create('mandara', array('type' => 'file', 'url' => 'csvimport', 'name' => 'csvimport')); ?>

<form action="mandara/csvimport" method="post" enctype="multipart/form-data">
<input type="file" name="csv" id="csv">
リストネーム：<input type="text" name="data[mandara][listname]" id="listname" size="4">
<input type="submit" name="CSV入力" >

<?php echo $this->Form->end(); ?><!-- forminsert -->



</td>
<td varlign="middle" align="right">


<h5>商品リスト表示</h5><br>
<?php echo $this->Form->create('catalogselect', array('type' => 'post', 'url' => 'rlist', 'name' => 'catalogselect')); ?>
<?php 
echo $this->Form->input('catalogselect', array(
    'type' => 'select', 
    'options' => $catalogselect,
//  'selected' => $selected  // 規定値をvalueで指定
    'div' => false,          // div親要素の有無(true/false)
    'label' => false           // div親要素の有無(true/false)
//  'size' => 5              // 高さ設定(リストボックスとして表示)
//  'empty' => true          // 空白を許可
));
 ?>
 <input type="submit" name="リスト表示" >
 <?php echo $this->Form->end(); ?><!-- forminsert -->

  

</td>

<td>

<h5>リスト登録</h5><br>
<a href="makerlist">メーカー(Brand)登録</a><br><br>
<a href="mandara/asintoean">ebaystoreカテゴリー番号登録</a><br><br>
<a href="typelist">タイプ登録</a><br><br>
<a href="#">英語名紐づけ登録</a>

</td>

<td>

<h5>在庫チェック管理</h5><br>
<a href="cronschedule">ebayリスト別在庫チェック＆取り下げスケジュール設定</a>

</td>

<td>

<h5>基本設定</h5><br>

<a href="shippinglist">送料一覧</a><br><br>
<a href="ebaysellerinfo">ebay出品者情報</a>

</td>


</tr>

</table>

<br>
<hr>


<br>

<?php echo $this->Form->create('cataloglist', array('type' => 'post', 'url' => 'catalogupdate', 'name' => 'catalogupdate')); ?>
<table style="font-size:11px;">



<?php 
echo $this->Html->tableCells(

    array(


    '<!-- <a href="ebaydownloadcsv"><button>ebay出力</button></a> -->'.'<a href="ebaynewaddlist"><button>ebayテスト新規出品</button></a>'.'<br><br>'.'<a href="ebaynewaddlist"><button>ebay本番新規出品</button></a>',


    '<a href="mandara/honyakucmd"><button>一括翻訳</button></a>'.
    '<br><br>'.
    '<a href="mandara/honyakucmd"><button>一括送料計算</button></a>'.
    '<br><br>'.
    '<a href="mandara/honyakucmd"><button>一括Ashin→Jan変換</button></a>',

    'ebayカテゴリ選択<br>'.
    $this->Form->input('categolyselect', array(
        'type' => 'select', 
        'options' => $categolyselect,
        'div' => false,
        'label' => false
    )).
    '<br><br>'.
    'Storeカテゴリ選択<br>'.
    $this->Form->input('categolyselect', array(
        'type' => 'select', 
        'options' => $categolyselect,
        'div' => false,
        'label' => false
    )).
    '<br><br>'.
    'タイプ選択<br>'.
    $this->Form->input('categolyselect', array(
        'type' => 'select', 
        'options' => $categolyselect,
        'div' => false,
        'label' => false
    )),


    '<input type="hidden" name="data[cataloglist][id]" value="' . $Cataloglist[0]['Cataloglist']['id'] .'"/>'.
    '<input type="hidden" name="data[cataloglist][listno]" value="' . $Cataloglist[0]['Cataloglist']['listno'] .'"/>'.
    '利益率<input type="text" name="data[cataloglist][riekiritsu]" value="' . $Cataloglist[0]['Cataloglist']['riekiritsu'] .'" size="4"/>'.
    '<br>'.
    '手数料<input type="text" name="data[cataloglist][tesuryo]" value="' . $Cataloglist[0]['Cataloglist']['tesuryo'] .'" size="4"/>',


    'リスト名（英語明記）<input type="text" name="data[cataloglist][listname]" value="' . $Cataloglist[0]['Cataloglist']['listname'] .'" size="4"/>'.
    '<br>',



    "US前説明文" . $this->Form->textarea('frontword', array('cols' => '12', 'rows' => '6', 'value' => $Cataloglist[0]['Cataloglist']['frontword'], 'name' => 'data[cataloglist][frontword]')),

    "US後説明文" . $this->Form->textarea('backword', array('cols' => '12', 'rows' => '6', 'value' => $Cataloglist[0]['Cataloglist']['backword'], 'name' => 'data[cataloglist][backword]'))
));
    
 ?>
 </table>


<center>

<input type="submit" name="catalogupdate" value="基本情報一括更新"　size="12">

</center>
<?php echo $this->Form->end(); ?><!-- catalogupdate -->

<br>
<hr>
<br>
<br>
<br>

<table align="center">

<tr>

<td width="130px">

<center>
<?php echo $this->Form->create('jyuryouupdate', array('type' => 'post', 'url' => 'jyuryouupdate', 'name' => 'jyuryouupdate')); ?>
<input type="text" name="data[mandara][jyuryou]" value="" size="4"/>一括重量入力※空白のみ
<?php echo '<input type="hidden" name="data[cataloglist][listno]" value="' . $Cataloglist[0]['Cataloglist']['listno'] .'" size="4"/>' ?>
</center>

</td>
<td width="130px">

<input type="submit" name="jyuryouupdate" value="一括重量入力"　size="12">
<?php echo $this->Form->end(); ?><!-- jyuryouupdate -->
</td>

<td width="130px">

<center>
<?php echo $this->Form->create('makerupdate', array('type' => 'post', 'url' => 'makerupdate', 'name' => 'makerupdate')); ?>
<input type="text" name="data[mandara][makername]" value="" size="4"/>一括メーカー入力※空白のみ
<?php echo '<input type="hidden" name="data[cataloglist][listno]" value="' . $Cataloglist[0]['Cataloglist']['listno'] .'" size="4"/>' ?>
</center>

</td>

<td width="130px">

<input type="submit" name="makerupdate" value="一括メーカー(ブランド)入力"　size="12">
<?php echo $this->Form->end(); ?><!-- makerupdate -->
</td>


<td width="130px">

<center>
<?php echo $this->Form->create('shippingallupdate', array('type' => 'post', 'url' => 'shippingallupdate', 'name' => 'shippingallupdate')); ?>
<?php echo '<input type="hidden" name="data[cataloglist][listno]" value="' . $Cataloglist[0]['Cataloglist']['listno'] .'" size="4"/>' ?>
<input type="submit" name="shippingallupdate" value="一括送料入力"　size="12">
<?php echo $this->Form->end(); ?><!-- makerupdate -->
</center>
</td>


<td width="300px" align="right">
<?php echo $this->Form->create('mandara', array('type' => 'post', 'url' => 'upadate', 'name' => 'forminsert')); ?>
<center><input type="submit" name="formsubmit" value="商品リスト一括更新"　size="12"></center>
</td>

</table>




<br><br>
<center>
<?php echo "  (表示：" . $this->Paginator->params()["limit"] . "件）" ?>   
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
</center>

<br>

<table style="font-size:9px;">

     
    <?php echo $this->Html->tableHeaders(array('削除', 'id', 'img01<br>img02', 'img03<br>img04', 'メーカー(Brand)', '状態<br>タイプ', 'url', 'USタイトル', '円<br>ドル', '重量/サイズ/ASIN/JAN', 'US説明文' )); ?>
    
    <?php $ct=0; foreach ($Mandara as $mandara) { ?>
    
    <?php echo $this->Html->tableCells(array(

        //$this->Html->link('削除',array('action'=>'delete',$mandara['Mandara']['id'])),

        //$this->Form->checkbox('price', array('size' => '5', 'value' => , 'name' => 'data[mandara][id][' . $ct . ']')),

        $this->Form->checkbox('delete', array('hiddenField' => false, 'name' => 'data[mandara][id][' . $ct . ']')),

        array($this->Form->hidden('id', array('value' => $mandara['Mandara']['id'], 'name' => 'data[mandara][id][' . $ct . ']')).$mandara['Mandara']['id'].
        $this->Form->hidden('ct', array('value' => '', 'name' => 'ct')),array('width' => '10px')),

        array(
        '<img src="'. $mandara['Mandara']['img01'] .'" width="100" height="100">'
        . $this->Form->checkbox('delete', array('hiddenField' => false, 'name' => 'data[mandara][id][' . $ct . ']')) 
        .'<img src="'. $mandara['Mandara']['img02'] .'" width="100" height="100">'
        . $this->Form->checkbox('delete', array('hiddenField' => false, 'name' => 'data[mandara][id][' . $ct . ']'))
        ,array('width' => '10px')),

        array(
        '<img src="'. $mandara['Mandara']['img03'] .'" width="100" height="100">'
        . $this->Form->checkbox('delete', array('hiddenField' => false, 'name' => 'data[mandara][id][' . $ct . ']'))
        .'<img src="'. $mandara['Mandara']['img04'] .'" width="100" height="100">'
        . $this->Form->checkbox('delete', array('hiddenField' => false, 'name' => 'data[mandara][id][' . $ct . ']'))
        ,array('width' => '10px')),


        $this->Form->text('makername', array('size' => '5', 'value' => $mandara['Mandara']['makername'], 'name' => 'data[mandara][makername]')),


        array($mandara['Mandara']['condition'],array('width' => '50px')),

        array('<a href="' . $mandara['Mandara']['itemurl'] . '" target="_blank">url</a>',array('width' => '10px')),


        array($this->Form->textarea('entitle', array('cols' => '24', 'rows' => '10', 'value' => $mandara['Mandara']['entitle'], 'id' => 'entitle' . $ct , 'name' => 'data[mandara][entitle][' . $ct . ']')) . "文字数<span class='count" . $ct . "'>0</span>/80",array('width' => '200px')),

        array(
            "円" .
            $this->Form->text('price', array('size' => '5', 'value' => $mandara['Mandara']['price'], 'name' => 'data[mandara][price][' . $ct . ']')).
            "送料ドル" .
            $this->Form->text('souryoudoru', array('size' => '5', 'value' => $mandara['Mandara']['souryoudoru'], 'name' => 'data[mandara][souryoudoru][' . $ct . ']')).
            "利益ドル" .
            "合計ドル" .
            $this->Form->text('goukeidoru', array('size' => '5', 'value' => $mandara['Mandara']['goukeidoru'], 'name' => 'data[mandara][goukeidoru][' . $ct . ']'))
        ,array('width' => '50px')),

        array(
        "重量".
        $this->Form->text('jyuryou', array('size' => '3', 'value' => $mandara['Mandara']['jyuryou'], 'name' => 'data[mandara][jyuryou]')).
        "サイズ".
        $this->Form->text('size', array('size' => '3', 'value' => $mandara['Mandara']['size'], 'name' => 'data[mandara][size]')).
        "ASIN".
        $this->Form->text('asin', array('size' => '3', 'value' => $mandara['Mandara']['asin'], 'name' => 'data[mandara][asin]')).
        "JAN".
        $this->Form->text('jancode', array('size' => '3', 'value' => $mandara['Mandara']['jancode'], 'name' => 'data[mandara][jancode]'))
        ,array('width' => '180px')),
        array($this->Form->textarea('endes', array('cols' => '28', 'rows' => '12', 'value' => $mandara['Mandara']['endes'], 'name' => 'data[mandara][endes][' . $ct . ']')),array('width' => '340px'))
        
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script type="text/javascript">
$(function(){

    $('textarea').bind('keyup',function(){
        for ( num=0; num<101; num++ ) {
            var thisValueLength = $("#entitle" + num).val().replace(/\r?\n/g,'').length; // ←★replace()を追加
            $(".count" + num).html(thisValueLength);
        }
    });
});
</script>