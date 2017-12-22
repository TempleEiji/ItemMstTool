<?php


App::uses('AppController', 'Controller');


class EbaysellerinfoController extends AppController {


public $uses = array('Shippinglist');
public $helper = array('Csv');

public $paginate = array (
        'limit' => 100,
        'sort' => 'id',
    );

public function index() {

    $data=$this->Ebaysellerinfo->find('all');
    $this->set('Ebaysellerinfo', $data);
}
}