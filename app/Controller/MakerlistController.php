<?php


App::uses('AppController', 'Controller');


class MakerlistController extends AppController {


public $uses = array('Shippinglist');
public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {

    $data=$this->Makerlist->find('all');
    $this->set('Makerlist', $data);
}
}