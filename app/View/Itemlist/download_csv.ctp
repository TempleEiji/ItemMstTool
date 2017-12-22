<?php
//ファイル名設定
$this->Csv->setFilename('ebay.csv');

// ebay 日本語ヘッダー
$header = array(
'サイトID',
'SKU',
'タイトル',
'カテゴリ',
'サブカテゴリ',
'ストアカテゴリ',
'第2ストアカテゴリ',
'テンプレート',
'タグ',
'商品説明',
'商品数',
'状態',
'状態説明',
'配送方法ポリシー',
'決済方法ポリシー',
'返品ポリシー',
'入札制限ポリシー',
'出品形式',
'商品発送元の地域',
'商品発送元の国',
'開始日時',
'期間',
'通貨',
'開始価格',
'即決価格',
'ベストオファー',
'ベストオファー最低額',
'自動ベストオファー受付額',
'プライベート出品',
'画像1',
'画像2',
'画像3',
'画像4',
'画像5',
'画像6',
'画像7',
'画像8',
'画像9',
'画像10',
'画像11',
'画像12',
'アイテムスペック',
'UPC',
'ISBN',
'Brand',
'MPN',
'EAN',
'荷物の幅',
'荷物の奥行き',
'荷物の長さ',
'荷物の重量',
'適合車種');

//ヘッダー行追加
$this->Csv->addRow($header);

foreach ($posts as $data) {
$post = $data['Post'];

//出力するカラムを取り出す
// $row = array(
// $post['id'],
// $post['itemurl'],
// $post['jptitle'],
// $post['entitle'],
// $post['jpdes'],
// $post['endes'],
// );

$row = array(
$post['id'],
$post['itemurl'],
$post['entitle'],
$post['endes'],
);

//データ行追加
$this->Csv->addRow($row);
}

//CSVファイルダウンロード出力
echo $this->Csv->render(true, 'sjis-win', 'utf-8');