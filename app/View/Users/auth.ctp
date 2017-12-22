
//View/Users/auth.ctp

<h1>ユーザー権限&作成</h1>


<?php if(!$users_edit){
  $users_edit=0;
}?>

<form method='post'>
  <div>
    <div>
    <input type="hidden" name="id" value="<?php if($users_edit){echo $users_edit['User']['id'];}else{echo "";}?>"/>
    <p>ユーザー名</p>
    <input type="text" name="nametitle" value="<?php if($users_edit){echo $users_edit['User']['usertitle'];}else{echo "";}?>"/>
    </div>
    <div>
    <p>id</p>
    <input type="text" name="username" value=""/>
    </div>
    <div>
    <p>password</p>
    <input type="text" name="password" value="<?php if($users_edit){echo $users_edit['User']['password'];}else{echo "";}?>"/>
    </div>
  </div>

<!--  <?php pr($auths);?> -->
  <div>
    <h2>権限付与</h2>
    <?php foreach ($auths as $auth): ?>
    <label>
      <input type="checkbox" name ="auth_id[<?php echo "{$auth['mst_users_authority']['auth_id']}";?>]" value="<?php echo "{$auth['mst_users_authority']['auth_id']}";?>"><?php echo $auth['mst_users_authority']['auth_title'];?>
    </label>
    <?php endforeach; ?>
 </div>

<Input type="submit" value="更新">
</form>

<h2>ユーザー一覧</h2>
<ul>
 <?php foreach ($users as $user): ?>
   <li><?php echo($user['User']['nametitle']).
        $this->Html->link("編集", array(
          'controller' => 'users',
          'action' => 'edit',
          $user['User']['id']));?></li>
 <?php endforeach; ?>
</ul>
