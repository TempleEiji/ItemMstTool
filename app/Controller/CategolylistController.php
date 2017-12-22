<?php


App::uses('AppController', 'Controller');


class CategolylistController extends AppController {


public $uses = array('Shippinglist');
public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {

    $data=$this->Categolylist->find('all');
    $this->set('Categolylist', $data);
}
}