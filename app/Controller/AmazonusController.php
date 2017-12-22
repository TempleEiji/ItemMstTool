<?php


App::uses('AppController', 'Controller');


class AmazonusController extends AppController {


public $uses = array();

public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {
$data = $this->paginate('Amazonus');
// $this->Itemlist->find('all')
$this->set('Amazonus', $data);
}

public function upadate() {
    // ポストデータがあれば保存をする（保存ボタンが押された場合）
    if ($this->request->is('post')) {
        //保存する
        //echo $this->request->$data['Itemlist'][0];
        // $this->Itemlist->id = $this->request->data['itemlist']['id'][0];
        
        for($ct=0; $ct< count($this->request->data['amazonus']['id']);$ct++){
            $data = array(
            'Amazonus' => array(
                'id' => $this->request->data['amazonus']['id'][$ct],
                'jptitle' => $this->request->data['amazonus']['jptitle'][$ct],
                'entitle' => $this->request->data['amazonus']['entitle'][$ct],
                'price' => $this->request->data['amazonus']['price'][$ct],
                'jpdes' => $this->request->data['amazonus']['jpdes'][$ct],
                'endes' => $this->request->data['amazonus']['endes'][$ct],
                )
            );
            $this->Itemlist->save($data,false);
        }
        
        // $fields = array('jptitle');
        // $this->Itemlist->save($this->request->data['itemlist']['jptitle'][0],false);
        // $this->log($this->request->data['itemlist'],LOG_DEBUG);
        //$this->Itemlist->save($this->request->data['itemlist']['jptitle'],false,$fields);
        $this->log(count($this->request->data['amazonus']['id']),LOG_DEBUG);
        // $this->log($this->request->data['itemlist']['jptitle'][0],LOG_DEBUG);
        
        // $this->Itemlist->save($this->request->$data['Itemlist'],false);
        // $this->Itemlist->save($this->request->$data['Itemlist'],false);
        //if ($this->Itemlist->update($this->request->$data['Itemlist'][0],false)) {
        // メッセージをセットしてリダイレクトする
        return $this->redirect(array('action'=>'index'));
        //}
        //else
        //{
            //保存が失敗した場合のメッセージ
        //}
    }
    else{
        //ポストデータがない場合の処理
    }
    $this->redirect(array('action' => 'index'));
}

public function delete($id=null) {
   $this->Itemlist->id=$id;
    if($this->Itemlist->delete()) //データの削除、addと同じ
    {
        // $this->Session->setFlash('削除完了');
        $this->redirect(array('action'=>'index'));
    }
    else
    {
        // $this->Sessin->setFlash('削除失敗');
    } 
    $this->redirect(array('action' => 'index'));
}



public function download_csv() {
//Configure::write('debug', 0);
$this->layout = false;
$posts = $this->Itemlist->find('all'); //記事一覧データを取得
$this->set('posts', $posts);
}





public function csvimport() {
    $csv = $_FILES["csv"]["tmp_name"];
    $buffer = mb_convert_encoding(file_get_contents($csv), "UTF-8", "UTF-8");
    $fp = tmpfile();
    fwrite($fp, $buffer);
    rewind($fp);
    
    // メルカリCSV取り込み
    $list = array();
    $ct=10;
    $i=0;
    
    $catepaldir = "./yahimgdir/" + $this->request->data['cateName'];
    //mkdir($catepaldir,777)；
    
    while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
        if($i == 0){
			$i++;
			continue;
		}
		
		$catechildir="";
		$url1 = $data[0];
		$data1 = file_get_contents($url1);
		$img01= $i +  $catename + "01.jpg";
		file_put_contents('./' + $catechildir  + '/' + $img01 ,$data1);
		
		$img02="";
		$header2 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $data[0]) )  . '_2' .'.jpg');
		if(strstr($header2[0], '200')){
		     $img02="2";
		}
		$img03="";
		$header3 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $data[0]) )  . '_3' .'.jpg');
		if(strstr($header3[0], '200')){
		     $img03="3";
		}
		$img04="";
		$header4 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $data[0]) )  . '_4' .'.jpg');
		if(strstr($header4[0], '200')){
		     $img04="4";
		}
		
        $list = array('Itemlist' => array(
            'id' => $ct++,
            'img01' => $img01,
            'img02' => $img02,
            'img03' => $img03,
            'img04' => $img04,
            'itemurl' => $data[0],
            'jptitle' => $data[1],
            // entitle => 'value2',
            'price' => str_replace(",","",str_replace("¥ ","",$data[2])),
            // addprice => 'value2',
            'jpdes' => $data[3],
            // endes => 'value2',
            // delete => 'value2',
            )
        );
        $i++;
        $fields = array('id','img01','img02','img03','img04','itemurl','jptitle','price','jpdes');
        $this->Itemlist->create();
        $this->Itemlist->save($list, false,$fields);
    }
    
    
    
    
    fclose($fp);
	
	$this->redirect(array('action' => 'index'));
}


}