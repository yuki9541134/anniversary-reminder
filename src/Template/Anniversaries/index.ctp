<?php echo $this->element('header'); ?>
<h1>記念日一覧</h1>
<table>
    <tr>
        <th>お相手</th>
        <th>記念日の種類</th>
        <th>記念日の日にち</th>
        <th></th>
    </tr>

    <?php foreach ($anniversaries as $anniversary): ?>
    <tr>
        <td>
            <?= $anniversary->precious_user->name ?>
        </td>
        <td>
            <?= $anniversary->anniversary_type ?>
        </td>
        <td>
            <?= $anniversary->anniversary_date->i18nFormat('yyyy年MM月dd日'); ?>
        </td>

        <td>
            編集 削除
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->Html->link('記念日を追加する', ['action' => 'new']) ?>
