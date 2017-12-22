<?php
//phpinfo();

// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $helpers = array('Html', 'Form');
    //Flashメソッドを使えるようにそのメソッドを格納したComponentプロパティの使えるように宣言する。
    public $component = array('Session','Flash');

    //どのアクションが呼ばれてもはじめに実行される関数
     public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout','login','auth', 'edit');
    }

    public function login() {
      if ($this->request->is('post')) {
        print_r($this->data);
//        print_r("hogehoge");
        print_r("hogehoge");
        if ($this->Auth->login()) {
            print_r("sucess");
//            $this->redirect($this->Auth->redirect());
        } else {
            $this->Flash->error(__('Invalid username or password, try again'));
        }
      }
    }

#    public function index() {
#        $this->User->recursive = 0;
#        $this->set('users', $this->paginate());
#    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function auth() {
        $sql = 'SELECT * FROM mst_users_authority';
        $this->set('users', $this->User->find('all'));
        #print_r($sql);
        $data = $this->User->query($sql);
        $this->set('auths', $data);
        if($this->request->is('post')){
            $this->User->create();
            print_r($this->request->data);

            if($this->User->save($this->request->data)){
              //users_authoritiesテーブルに権限データをセーブ
              //先程新規登録したid情報を取得
              if($this->request->data['auth_id']){
                  $user_id = $this->User->find('first', array(
                    'fields' => 'User.id',
                    'order' => array('User.id' => 'desc')))['User']['id'];
                  var_dump($user_id);
                  $data_auth = array();
                  var_dump($this->request->data['auth_id']);
                  //users_authoritiesテーブルに適した配列に変更
                  foreach ($this->request->data['auth_id'] as $key => $value) {
                    $data_auth[] = array('user_id' => $user_id, 'auth_id' => $value);
                  }
                  var_dump($data_auth);
                  unset($key, $value);
                  $this->loadModel('UsersAuthority');
                  $this->UsersAuthority->create();
                  $auth_count_check = 0;
                  foreach ($data_auth as $key => $value){
                    print_r($value);
                    $this->UsersAuthority->save($value);
                    $auth_count_check += 1;
                  }
                  unset($key, $value);
                  $auth_count = $this->UsersAuthority->find('count', array(
                    'conditions' => array('UsersAuthority.user_id' => $user_id)));
                  var_dump($auth_count);
                  //新規登録したデータの数をチェックし記録できているか確認
                  if($auth_count == $auth_count_check){
                    $this->Flash->set('ユーザー情報・権限の更新・作成成功しました');
                    //return $this->redirect(array('action' => 'auth'));
                    }else{
                    $this->Flash->set('権限登録に失敗しました。下段編集ボタンからやり直してください。');
                  }
              }
              $this->Flash->set('ユーザー情報の更新・作成成功しました');
            }else{
                $this->Flash->set('失敗しました。やり直してください。');
            }
        }
    }

    public function edit(){
        //編集するページのidをURLから取得
        $id = preg_replace('/[^0-9]/', '', $_SERVER["REQUEST_URI"]);
        //$id = $_GET['id'];
        //$id = $_SESSION['id']
        //print_r($id);
        if($id){
          //元の画面表示用
          $sql1 = 'SELECT * FROM mst_users_authority';
          $data1 = $this->User->query($sql1);
          $this->set('auths', $data1);
          $this->set('users', $this->User->find('all'));
          //edit用データの抽出
          //$sql2 = "SELECT * FROM users_authority AS auth inner join mst_users_authority AS mst ON auth.auth_id = mst.auth_id WHERE auth.user_id = $id";
          $this->set('users_edit', $this->User->find('first', array('conditions' => array('User.id' => $id))));
          $sql2 = "SELECT * FROM users_authorities WHERE user_id = $id";
          $data2 = $this->User->query($sql2);
          //編集時チェックリストのチェック判定のためリスト化
          $list = array();
          if(!(count($data2) === 0)){
              foreach ($data2 as $a) {
                $list[] = $a['users_authorities']['auth_id'];
              }
              var_dump($list);
          }
          $this->set('auths_edit', $list);
        }//if($id)終わり


        if($this->request->is('post')){
          $this->User->create();
          print_r($this->request->data);
          print_r($this->request->data['id']);
          $user_id = $this->request->data['id'];
          $this->User->id= $user_id;
          print_r(count($this->request->data));
          //更新データに反映
          if($this->User->save($this->request->data)){
            //users_authoritiesテーブルに権限データをセーブ
            //処理方法として過去のデータを全部削除して、今回チェックに残った分を新規挿入登録する。下段（１）と（２）
                //(1)過去のデータを全部削除
                $this->loadModel('UsersAuthority');
                $this->UsersAuthority->deleteAll(array('UsersAuthority.user_id' => $user_id), false);
                //(2)編集でチェックされた権限を新規に挿入
                //権限のチェックの有無確認。からなら権限すべてなしということなしなので下段処理とめる。count=4は権限のチェックが一切ない場合。
                if(count($this->request->data) === 4){
                    $auth_count_check = 0;
                }else{
                    $data_auth = array();
                    var_dump($this->request->data['auth_id']);
                    //users_authoritiesテーブルに適した配列に変更
                    foreach ($this->request->data['auth_id'] as $key => $value) {
                        $data_auth[] = array('user_id' => $user_id, 'auth_id' => $value);
                    }
                    var_dump($data_auth);
                    unset($key, $value);
                    $this->UsersAuthority->create();
                    $auth_count_check = 0;
                    foreach ($data_auth as $key => $value){
                      print_r($value);
                      $this->UsersAuthority->save($value);
                      $auth_count_check += 1;
                    }
                    unset($key, $value);
                }//権限のチェック有無時の処理分岐終わり
                $auth_count = $this->UsersAuthority->find('count', array(
                      'conditions' => array('UsersAuthority.user_id' => $user_id)
                    ));
                var_dump($auth_count);
                var_dump($auth_count_check);
                //新規登録したデータの数をチェックし記録できているか確認
                if($auth_count == $auth_count_check){
                    $this->Flash->set('ユーザー情報・権限の更新・作成成功しました');
                    //Viewのテキストボックスに表示内容リセット
                    $this->set('users_edit', "0");
                    return $this->redirect(array('action' => 'auth'));
                }else{
                    $this->Flash->set('権限登録に失敗しました。下段編集ボタンからやり直してください。');
                }
            }
        }//is('post')
    }//function edit


    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

/*
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }
*/
    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}
