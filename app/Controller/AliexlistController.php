<?php

App::uses('AppController', 'Controller');


class AliexlistController extends AppController {


    public $uses = array('Aliexlist','Alikeywordset');
    public $helper = array('Csv');
    public $paginate = array (
            'limit' => 100,
            'sort' => 'id',
        );

    public function index() {
        
        if($this->request->is('post') && $this->request->data['keyword'] != ""){
            $data = $this->paginate('Aliexlist');
            $data=$this->Aliexlist->find(
                'all',array('conditions' => array('Aliexlist.jptitle LIKE ' =>  '%'.  $this->request->data['keyword'] . '%')));
            $this->set('Aliexlist',$data);
            $this->set('startflg', 1);
            $data2=$this->Alikeywordset->find('all');
            $this->set('Alikeywordset',$data2);

        }else {

            $data = $this->paginate('Aliexlist');
            $this->set('Aliexlist', $data);
            $this->set('startflg', 0);

            $data2=$this->Alikeywordset->find('all');
            $this->set('Alikeywordset',$data2);
        }
    }

    public function keywordset2() {
        $data = array(
        'Alikeywordset.keywordset' => '"' .$this->request->data['description']. '"',
        );
        $conditions = array(
            'Alikeywordset.id' => 2,
        );

        $this->Alikeywordset->updateAll($data, $conditions);
        $this->redirect(array('action' => 'index'));
    }

    public function keywordset3() {
        $data = array(
        'Alikeywordset.keywordset' => '"' .$this->request->data['description']. '"',
        );
        $conditions = array(
            'Alikeywordset.id' => 3,
        );

        $this->Alikeywordset->updateAll($data, $conditions);
        $this->redirect(array('action' => 'index'));
    }

    public function keywordset() {
        $data = array(
        'Alikeywordset.keywordset' => '"' .$this->request->data['keywordname']. '"',
        );
        $conditions = array(
            'Alikeywordset.id' => 1,
        );

        $this->Alikeywordset->updateAll($data, $conditions);
        $this->redirect(array('action' => 'index'));
    }


    public function urlcheck() {

        $AliexlistArr = $this->Aliexlist->find('all');
        for($ct=0; $ct< count($AliexlistArr); $ct++){
        
            $delflg="";
            $header1 = get_headers($AliexlistArr[$ct]['Aliexlist']['itemurl']);
            if(!strstr($header1[0], '200')){ $delflg="del";}
            
            $data = array(
                'id' => $AliexlistArr[$ct]['Aliexlist']['id'],
                'delflg' => $delflg,
            );
            
            $this->Aliexlist->save($data, false);
        }
        $this->redirect(array('action' => 'index'));
    }


public function csvimport() {
    $csv = $_FILES["csv"]["tmp_name"];
    $listname = str_replace(" ","",$this->request->data['aliexlist']['listname']);
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
        
        if(empty($data[0]) || $data[0] == ''){
        }else {
            $itemurl = $data[0];
        }
        
        $list = array('Aliexlist' => array(

            'itemurl'=>$itemurl,    // itemurl
            'categoly'=>$data[1],   // categoly
            'jptitle'=>$data[2],    // jptitle
            'price'=>$data[3],      // price
            'dir'=>$data[4],        // dir
            'img01'=>$data[5] . '.jpg',      // img01
            'img02'=>$data[6] . '.jpg',      // img02
            'img03'=>$data[7] . '.jpg',      // img03
            'listno'=>$listno,      // listno
            'listname'=>$listname,      // listname
            'stockstate'=>'Active'      // stockstate
            )
        );
        $i++;
        $fields = array(
                        'itemurl',    // itemurl
                        'categoly',   // categoly
                        'jptitle',    // jptitle
                        'price',      // price
                        'dir',        // dir
                        'img01',      // img01
                        'img02',      // img02
                        'img03',      // img03
                        'listno',      // listno
                        'listname',      // listname
                        'stockstate'      // stockstate
                    );
        $this->Aliexlist->create();
        $this->Aliexlist->save($list, false,$fields);
    }
    fclose($fp);
    
    $this->redirect(array('action' => 'index'));
    }


}
