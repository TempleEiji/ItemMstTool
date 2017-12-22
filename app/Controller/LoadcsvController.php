<?php


App::uses('AppController', 'Controller');


class LoadcsvController extends AppController {


public $uses = array('Loadcsv');


public function index() {

}

// function import() {
// 	$filename = TMP . 'user.csv';
// 	if(file_exists($filename)) {
// 		$db = $this->User->getDataSource();
// 		$db->begin($this->User);
// 		$this->User->deleteAll('1 = 1');
// 		$this->User->importCSV($filename);
// 		if($this->User->getImportErrors()) {
// 			$db->rollback($this->User);
// 			$this->Session->setFlash(__('Incorrect data type. Please, try again.', true));
// 		} else {
// 			$db->commit($this->User);
// 			$this->Session->setFlash(__('The import was successful.', true));
// 		}
// 	} else {
// 		$this->Session->setFlash(__('Failed to import data. Please, try again.', true));
// 	}
// 	$this->redirect(array('action' => 'index'));
// }
public function import() {
    $modelClass = $this->modelClass;
    $this->$modelClass->importCSV( 'hoge.csv' );
    $this->redirect( array('action' => 'index') );
  }

}
