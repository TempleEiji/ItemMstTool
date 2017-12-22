<?php


//require_once('/var/www/teracreators/workspace/app/ebayapi/trading/sandbox03-add-auction-item.php');
//require_once('/var/www/teracreators/workspace/app/ebayapi/finding/03-find-items-by-product.php');
//include "aws_signed_request.php";

App::uses('AppController', 'Controller', 'ShippinglistController');


class MandaraController extends AppController {


public $uses = array('Mandara', 'Scrapeset', 'Cataloglist', 'Categolylist', 'Makerlist', 'Shippinglist', 'Typelist');

public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {

    $data = $this->paginate('Mandara');
    // $this->Mandara->find('all')
    $this->set('Mandara', $data);
}



public function rlist() {
$data = $this->paginate('Mandara');
// $this->Mandara->find('all')
$this->set('Mandara', $data);
//リクエストがPOSTの場合
    if(empty($this->request->data['catalogselect']['catalogselect'])){

        $data = array(
            'Mandara' => array(
            'listno' => $this->request->data['catalogselect']['catalogselect'],
            )
        );
        var_dump($this->request->data['catalogselect']['catalogselect']);

        //Formの値を取得
        // $title=$this->request->data['Search']['title'];
        //POSTされたデータを曖昧検索
        // $data=$this->Cataloglist->find('all',array(
        // 'conditions'=>array('Cataloglist.userid'=>'rlist')));
        // $this->set('Collections',$data);

        $data=$this->Cataloglist->find('all');
        //$data=$this->Cataloglist->find('all',array(
        // 'conditions'=>array('Cataloglist.userid'=>'rlist')));
        $this->set('Cataloglist',$data);
        $this->set('Collections',$data);
        $this->set('catalogselect',  $this->Cataloglist->find('list',array('fields'=>array('listno','listname'))));
        $this->set('categolyselect',  $this->Categolylist->find('list',array('fields'=>array('categolyno','categolyname'))));
        $this->set('makerselect',  $this->Makerlist->find('list',array('fields'=>array('makerno','makername'))));
        $this->set('typeselect',  $this->Typelist->find('list',array('fields'=>array('typeno','typename'))));


    }else{ //POST以外の場合

        $data=$this->Cataloglist->find('all');
        //$data=$this->Cataloglist->find('all',array(
        // 'conditions'=>array('Cataloglist.userid'=>'rlist')));
        $this->set('Cataloglist',$data);
        $this->set('Collections',$data);
        $this->set('catalogselect',  $this->Cataloglist->find('list',array('fields'=>array('listno','listname'))));
        $this->set('categolyselect',  $this->Categolylist->find('list',array('fields'=>array('categolyno','categolyname'))));
        $this->set('makerselect',  $this->Makerlist->find('list',array('fields'=>array('makerno','makername'))));
        $this->set('typeselect',  $this->Typelist->find('list',array('fields'=>array('typeno','typename'))));
    }
}

public function listselect(){

    $data = $this->paginate('Mandara');
    $data = array(
    'Mandara' => array(
        'listno' => $this->request->data['catalogselect']['catalogselect'],
        )
    );
    $this->set('Mandara', $data);
}


public function shippinglist(){
    $this->render('../shippinglist/index');
}
// public function　makerlist()　{
//     $this->render('../makerlist/index');
// }
// public function typelist(){
//     $this->render('../typelist/index');
// }
public function cronschedule(){
    $this->render('../cronschedule/index');
}

// public function ebaysellerinfo()　{
//     $this->render('../ebaysellerinfo/index';
// }




public function ebaynewaddlist(){

    $data=$this->Mandara->find('all');
    $updateidarry = ebayshuppin($data);
    for($ct=0; $ct< count($updateidarry);$ct++){
        $data = array(
        'Mandara' => array(
            'id' => $updateidarry['id'][$ct],
            'ebayitemid' => $updateidarry['ebayitemid'][$ct],
            )
        );
        $this->Mandara->save($data,false);
    }
    $this->redirect(array('action' => 'rlist'));
}


public function catalogupdate() {

    $data = array(
            'Cataloglist' => array(
                'id' => $this->request->data['cataloglist']['id'],
                'listno' => $this->request->data['cataloglist']['listno'],
                'riekiritsu' => $this->request->data['cataloglist']['riekiritsu'],
                'tesuryo' => $this->request->data['cataloglist']['tesuryo'],
                'listname' => $this->request->data['cataloglist']['listname'],
                'frontword' => $this->request->data['cataloglist']['frontword'],
                'backword' => $this->request->data['cataloglist']['backword'],
                )
            );
    $this->Cataloglist->save($data,false);
    $this->redirect(array('action' => 'rlist'));
}
public function jyuryouupdate() {

    $data = array(
        'Mandara.jyuryou' => $this->request->data['mandara']['jyuryou'],
    );
    $conditions = array(
        'Mandara.jyuryou' => '',
        'Mandara.listno' => $this->request->data['cataloglist']['listno'],
    );

    var_dump($this->request->data['mandara']['jyuryou']);
    var_dump($this->request->data['cataloglist']['listno']);

    $this->Mandara->updateAll($data, $conditions);
    $this->redirect(array('action' => 'rlist'));
}


public function makerupdate() {

    $data = array(
        'Mandara.makername' => '"' .$this->request->data['mandara']['makername'] . '"',
    );
    $conditions = array(
        'Mandara.makername' => '',
        'Mandara.listno' => $this->request->data['cataloglist']['listno'],
    );

    var_dump($this->request->data['mandara']['makername']);
    var_dump($this->request->data['cataloglist']['listno']);

    $this->Mandara->updateAll($data, $conditions);
    $this->redirect(array('action' => 'rlist'));
}


public function shippingallupdate() {


    $findarry = $this->Mandara->find('all',array(
        'conditions'=>array('Mandara.listno'=>'"' . $this->request->data['cataloglist']['listno'] . '"')));


    for($i=0;$i<count($findarry);$i++){
    
        $this->Shippinglist->find('all');

        $getshippingdata = $this->Shippinglist->find('all',array(
        'conditions'=>array('Shippinglist.jyuryou'=>'"' . $findarry[$i]['Mandara']['jyuryou'] . '"')));


        $data = array(
            'Mandara.jyuryou' => '"' . $findarry[$i]['Mandara']['jyuryou']  . '"',
        );
        $conditions = array(
            'Mandara.id' => $findarry[$i]['Mandara']['id'],
        );


    }

    var_dump($this->request->data['mandara']['makername']);
    var_dump($this->request->data['cataloglist']['listno']);

    $this->Mandara->updateAll($data, $conditions);
    $this->redirect(array('action' => 'rlist'));
}

public function upadate() {
    
    // ポストデータがあれば保存をする（保存ボタンが押された場合）
    if ($this->request->is('post')) {
        //保存する
        //echo $this->request->$data['Mandara'][0];
        // $this->Mandara->id = $this->request->data['mandara']['id'][0];
        
        for($ct=0; $ct< count($this->request->data['mandara']['id']);$ct++){
            $data = array(
            'Mandara' => array(
                'id' => $this->request->data['mandara']['id'][$ct],
                'jptitle' => $this->request->data['mandara']['jptitle'][$ct],
                'entitle' => $this->request->data['mandara']['entitle'][$ct],
                'price' => $this->request->data['mandara']['price'][$ct],
                'endes' => $this->request->data['mandara']['endes'][$ct],
                )
            );
            $this->Mandara->save($data,false);
        }
        
        // $fields = array('jptitle');
        // $this->Mandara->save($this->request->data['mandara']['jptitle'][0],false);
        // $this->log($this->request->data['mandara'],LOG_DEBUG);
        //$this->Mandara->save($this->request->data['mandara']['jptitle'],false,$fields);
        $this->log(count($this->request->data['mandara']['id']),LOG_DEBUG);
        // $this->log($this->request->data['mandara']['jptitle'][0],LOG_DEBUG);
        
        // $this->Mandara->save($this->request->$data['Mandara'],false);
        // $this->Mandara->save($this->request->$data['Mandara'],false);
        //if ($this->Mandara->update($this->request->$data['Mandara'][0],false)) {
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


public function scrapeset() {

   $data = array(
    'Scrapeset' => array(
    'userid' => $this->request->data['scrapeset']['userid'],
    'listname' => $this->request->data['scrapeset']['listname'],
    'getshopname' => $this->request->data['scrapeset']['getshopname'],
    'url' => $this->request->data['scrapeset']['url'],
    'delword1' => $this->request->data['scrapeset']['delword1'],
    'delword2' => $this->request->data['scrapeset']['delword2'],
    'delword3' => $this->request->data['scrapeset']['delword3'],
    'delword4' => $this->request->data['scrapeset']['delword4'],
    'delword5' => $this->request->data['scrapeset']['delword5'],
    )
   );
  $this->Scrapeset->save($data,false);
  $this->redirect(array('action' => $this->request->data['scrapeset']['userid']));
}


public function mandarascrap() {

  exec('source ~/.nvm/nvm.sh');
  exec('/var/www/teracreators/workspace');
  exec('node mandarake');

  $this->redirect(array('action' => $this->request->data['scrapeset']['userid']));
}


public function delete($id=null) {
   $this->Mandara->id=$id;
    if($this->Mandara->delete()) //データの削除、addと同じ
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



public function ebaydownloadcsv() {
//Configure::write('debug', 0);
$this->layout = false;
//$posts = $this->Mandara->find('all'); //記事一覧データを取得
$this->set('posts', $posts);
}

public function imgcheck() {

	$imgurlArr = $this->Mandara->find('all');
	
	for($ct=0; $ct< count($imgurlArr); $ct++){
	
		$img01="";
		$header1 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mandara']['itemurl'] . '_1' . '.jpg');
		if(strstr($header1[0], '200')){
		     $img01="1";
		}
		$img02="";
		$header2 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mandara']['itemurl'] . '_2' .'.jpg');
		if(strstr($header2[0], '200')){
		     $img02="2";
		}
		$img03="";
		$header3 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mandara']['itemurl'] . '_3' .'.jpg');
		if(strstr($header3[0], '200')){
		     $img03="3";
		}
		$img04="";
		$header4 = get_headers('https://static-mercari-jp-imgtr2.akamaized.net/photos/'. $imgurlArr[$ct]['Mandara']['itemurl'] . '_4' .'.jpg');
		if(strstr($header4[0], '200')){
		     $img04="4";
		}
	    
	    $data = array(
	    	'id' => $imgurlArr[$ct]['Mandara']['id'],
		    'img01' => $img01,
	        'img02' => $img02,
	        'img03' => $img03,
	        'img04' => $img04,
		);
		
		$this->Mandara->save($data, false);
	}
	$this->redirect(array('action' => 'index'));
}


public function ebayshuppintest() {

}

public function csvimport() {
    $csv = $_FILES["csv"]["tmp_name"];
    $listname = str_replace(" ","",$this->request->data['mandara']['listname']);
    $listno = rand();
    $buffer = mb_convert_encoding(file_get_contents($csv), "UTF-8", "UTF-8");
    $fp = tmpfile();
    fwrite($fp, $buffer);
    rewind($fp);
    
    // メルカリCSV取り込み
    $list = array();
    $ct=1;
    $i=0;
    while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
        if($i == 0){
			$i++;
			continue;
		}

        if(empty($data[13])){ $img02 = "";}else { $img02 = $data[13];}
        if(empty($data[14])){ $img03 = "";}else { $img03 = $data[14];}
        if(empty($data[15])){ $img04 = "";}else { $img04 = $data[15];}
		
        $list = array('Mandara' => array(
            'id' => $ct++,
            'itemurl'=>$data[0], // itemurl
            'jptitle'=>$data[1], // jptitle
            'entitle'=>$data[2], // entitle
            'price'=>str_replace(",","",str_replace(" ","",$data[4])), // price
            'condition'=>$data[8], // condition
            'size'=>str_replace(" ","",$data[9]), // size
            'jyuryou'=>str_replace(" ","",$data[10]),// jyuryou
            'img01'=>$data[12], // img01
            'img02'=>$img02, // img02
            'img03'=>$img03, // img03
            'img04'=>$img04, // img04
            'listno'=>$listno,
            'endes'=> $data[2] . '<br>'. $data[8] .'<br>'  . str_replace(" ","",$data[9]),
            'userid'=>'rlist',
            'delflg'=>'nondel'
            )
        );
        $i++;
        $fields = array(
                        'id',
                        'itemurl',
                        'jptitle',
                        'entitle',
                        'price',
                        'condition',
                        'size',
                        'jyuryou',
                        'img01',
                        'img02',
                        'img03',
                        'img04',
                        'listno',
                        'endes',
                        'userid',
                        'delflg'
                    );
        $this->Mandara->create();
        $this->Mandara->save($list, false,$fields);
    }


    $clist = array('Cataloglist' => array(
            'listno'=> $listno,
            'userid'=>'rlist',
            'listname'=> $listname
            )
        );

    $cfields = array(
                        'listno',
                        'userid',
                        'listname'
                    );

    $this->Cataloglist->create();
    $this->Cataloglist->save($clist, false,$cfields);

    fclose($fp);
	
	$this->redirect(array('action' => 'rlist'));
}


}
