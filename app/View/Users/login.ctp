
<!--app/View/Users/login.ctp -->
<!--
<div>
  <p>商品管理ツール</p>
<form action="login" method="post">
  <dl>
    <dt>ID:</dt>
    <dd>
      <input type="text" name="username" size="30" maxlength="50" />
    </dd>
    <dt>PW:</dt>
    <dd>
      <input type="text" name="password" size="30" maxlength="50" />
    </dd>
  </dl>
  <div><input type="submit" valjue="ログイン" /></div>
</form>
</div>
-->

<div>
<h1>商品管理ツール</h1>
  <?php print($this->Form->create('User')); ?>
  <p>ID:</p><?php print($this->Form->input('username') );?>
  <p>PW:</p><?php print($this->Form->input('password').
  $this->Form->end('Submit'));?>
</div>
