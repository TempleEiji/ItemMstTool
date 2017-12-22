<?php

include "aws_signed_request.php";

App::uses('AppController', 'Controller');


class MercariController extends AppController {


public $uses = array();

public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {
$data = $this->paginate('Mercari');
// $this->Mercari->find('all')
$this->set('Mercari', $data);
}

public function upadate() {
    // ポストデータがあれば保存をする（保存ボタンが押された場合）
    if ($this->request->is('post')) {
        //保存する
        //echo $this->request->$data['Mercari'][0];
        // $this->Mercari->id = $this->request->data['mercari']['id'][0];
        
        for($ct=0; $ct< count($this->request->data['mercari']['id']);$ct++){
            $data = array(
            'Mercari' => array(
                'id' => $this->request->data['mercari']['id'][$ct],
                'jptitle' => $this->request->data['mercari']['jptitle'][$ct],
                'entitle' => $this->request->data['mercari']['entitle'][$ct],
                'price' => $this->request->data['mercari']['price'][$ct],
                'jpdes' => $this->request->data['mercari']['jpdes'][$ct],
                'endes' => $this->request->data['mercari']['endes'][$ct],
                )
            );
            $this->Mercari->save($data,false);
        }
        
        // $fields = array('jptitle');
        // $this->Mercari->save($this->request->data['mercari']['jptitle'][0],false);
        // $this->log($this->request->data['mercari'],LOG_DEBUG);
        //$this->Mercari->save($this->request->data['mercari']['jptitle'],false,$fields);
        $this->log(count($this->request->data['mercari']['id']),LOG_DEBUG);
        // $this->log($this->request->data['mercari']['jptitle'][0],LOG_DEBUG);
        
        // $this->Mercari->save($this->request->$data['Mercari'],false);
        // $this->Mercari->save($this->request->$data['Mercari'],false);
        //if ($this->Mercari->update($this->request->$data['Mercari'][0],false)) {
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


public function asintoean() {

	$asin = "B01M0XNE57";
	$locale="ja";

     //Amazon AWS data
    $AWSAccessKeyId = "AKIAIJVQMJPEHM6FEEEQ";
    $AWSSecretKey = "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";
    $associateTag = "bonamaasoidda-22";
 
 
    $request = array("Operation"=>"ItemLookup", "ItemId"=>$asin, 
              "ResponseGroup"=>"ItemAttributes");
              
    var_dump("request01取得----" . $request);
              
    $signedRequest = aws_signed_request($locale, $request, $AWSAccessKeyId, $AWSSecretKey, $associateTag);
                                 
                                 
    //call curl
    $curl = curl_init($signedRequest);
    
    var_dump("curl取得----" . $curl);
    
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
	var_dump("response取得----" . $response);

 
    //handle response
    if ($response === FALSE){
    	var_dump("responseFALSE----");
    	//$this->redirect(array('action' => 'index'));
    }
    else{
        $xml = simplexml_load_string($response);
        if ($xml === FALSE)
            return null; //no xml
        else{
            if(isset($xml->Items->Request->Errors)) //ASIN was not found or different error
                return null;
            else
            	var_dump("EAN取得成功----" . $xml->Items->Item->ItemAttributes->EAN);
                //return $xml->Items->Item->ItemAttributes->EAN;
                $this->redirect(array('action' => 'index'));
        }
    }
    
    
}



public function delete($id=null) {
   $this->Mercari->id=$id;
    if($this->Mercari->delete()) //データの削除、addと同じ
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
$posts = $this->Mercari->find('all'); //記事一覧データを取得
$this->set('posts', $posts);
}

public function imgcheck() {

	$imgurlArr = $this->Mercari->find('all');
	
	for($ct=0; $ct< count($imgurlArr); $ct++){
	
		$img01="";
		$header1 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mercari']['itemurl'] . '_1' . '.jpg');
		if(strstr($header1[0], '200')){
		     $img01="1";
		}
		$img02="";
		$header2 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mercari']['itemurl'] . '_2' .'.jpg');
		if(strstr($header2[0], '200')){
		     $img02="2";
		}
		$img03="";
		$header3 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mercari']['itemurl'] . '_3' .'.jpg');
		if(strstr($header3[0], '200')){
		     $img03="3";
		}
		$img04="";
		$header4 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mercari']['itemurl'] . '_4' .'.jpg');
		if(strstr($header4[0], '200')){
		     $img04="4";
		}
	    
	    $data = array(
	    	'id' => $imgurlArr[$ct]['Mercari']['id'],
		    'img01' => $img01,
	        'img02' => $img02,
	        'img03' => $img03,
	        'img04' => $img04,
		);
		
		$this->Mercari->save($data, false);
	}
	$this->redirect(array('action' => 'index'));
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
    while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
        if($i == 0){
			$i++;
			continue;
		}
		
		
		$img01="";
		$header1 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. str_replace("/","", str_replace("https://item.mercari.com/jp/", "", $data[0]) )  . '_1' .'.jpg');
		if(strstr($header1[0], '200')){
		     $img01="1";
		}
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
		
        $list = array('Mercari' => array(
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
        $this->Mercari->create();
        $this->Mercari->save($list, false,$fields);
    }
    
    
    
    
    fclose($fp);
	
	$this->redirect(array('action' => 'index'));
}


}
