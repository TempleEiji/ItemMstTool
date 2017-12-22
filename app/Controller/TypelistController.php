<?php


App::uses('AppController', 'Controller');


class TypelistController extends AppController {


public $uses = array('Shippinglist');
public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {

    $data=$this->Typelist->find('all');
    $this->set('Typelist', $data);
}
}