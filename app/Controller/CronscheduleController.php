<?php


App::uses('AppController', 'Controller');


class CronscheduleController extends AppController {

	public $uses = array('Cronschedule','Cataloglist');
	public $helper = array('Csv');

	public $paginate = array (
	        'limit' => 100,
	        'sort' => 'id',
	    );

	public function index() {


		$data=$this->Cronschedule->find('all', [
		  'joins'=>[
		    [
		      'type' => 'inner',
		      'table' => 'cataloglists',
		      'alias' => 'Cataloglist',
		      'conditions' => [
		        'Cataloglist.listno = Cronschedule.listno',
		      ],
		    ],
		  ],
		  'fields' => [
		  		'Cataloglist.listname','Cronschedule.listno','Cronschedule.id','Cronschedule.trigertime'
		  ]
		]);

		$this->set('catalogselect',  $this->Cataloglist->find('list',array('fields'=>array('listno','listname'))));
		$this->set('trigertimeselect', array(
			'0000' => '00:00',
			'0030' => '00:30',
			'0100' => '01:00',
			'0130' => '01:30',
			'0200' => '02:00',
			'0230' => '02:30',
			'0300' => '03:00',
			'0330' => '03:30',
			'0400' => '04:00',
			'0430' => '04:30',
			'0500' => '05:00',
			'0530' => '05:30',
			'0600' => '06:00',
			'0700' => '07:00',
			'0730' => '07:30',
		));

		$this->set('Cronschedule', $data);
	}


	public function croninsert() {

		$data = array(
		    'Cronschedule' => array(
		    'listno' => $this->request->data['croninsert']['catalogselect'],
		    'trigertime' => $this->request->data['croninsert']['trigertimeselect'],
		    )
		);
		$this->Cronschedule->save($data,false);
		$this->redirect(array('action' => 'index'));
	}
	 

}