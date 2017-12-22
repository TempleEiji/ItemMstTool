<?php


App::uses('AppController', 'Controller');


class ShippinglistController extends AppController {


public $uses = array('Shippinglist');
public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {

    $data=$this->Shippinglist->find('all');
    $this->set('Shippinglist', $data);
}
}