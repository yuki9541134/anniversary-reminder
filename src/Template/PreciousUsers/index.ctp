<?php echo $this->element('header'); ?>
<h1>大切な人一覧</h1>
<table>
    <tr>
        <th>名前</th>
        <th>性別</th>
        <th>関係</th>
        <th></th>
    </tr>

    <?php foreach ($precious_users as $precious_user): ?>
    <tr>
        <td>
            <?= $precious_user->name ?>
        </td>
        <td>
            <?= $precious_user->gender ?>
        </td>
        <td>
            <?= $precious_user->relation ?>
        </td>
        <td>
            <?= $this->Html->link('編集', ['action' => 'edit', 'id' => $precious_user->id]) ?>
            <?= $this->Form->postLink(
                    '削除',
                    ['action' => 'delete', 'id' => $precious_user->id, '_method' => 'delete'],
                    ['confirm' => '削除してよろしいですか？'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->Html->link('大切な人を追加する', ['action' => 'new']) ?>
