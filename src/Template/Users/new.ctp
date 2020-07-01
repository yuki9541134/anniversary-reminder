<h1>ユーザー登録</h1>
<?php
echo $this->Form->create($user, ['url' => '/users/add']);
echo $this->Form->control('email', ['label' => 'メールアドレス']);
echo $this->Form->control('password', ['label' => 'パスワード']);
echo $this->Form->button(__('登録する'));
echo $this->Form->end();
?>
