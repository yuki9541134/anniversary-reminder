<h1>大切な人を追加する</h1>
<?php
echo $this->Form->create($precious_user, ['url' => '/precious-users/add']);
    // TODO: user_idを入れる
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('name', ['label' => '名前']);
    echo $this->Form->label('性別');
    echo $this->Form->select('gender', $gender_selector);
    echo $this->Form->label('関係');
    echo $this->Form->select('relation', $relation_selector);
    echo $this->Form->button(__('追加する'));
    echo $this->Form->end();
?>
