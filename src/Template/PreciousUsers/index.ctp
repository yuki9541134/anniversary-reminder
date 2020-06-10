<h1>大切な人一覧</h1>
<table>
    <tr>
        <th>名前</th>
        <th>性別</th>
        <th>関係</th>
    </tr>

    <?php foreach ($precious_users as $precious_user): ?>
    <tr>
        <td>
            <?= $precious_user->name ?>
        </td>
        <td>
            <?= $precious_user->getGender() ?>
        </td>
        <td>
            <?= $precious_user->getRelation() ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
