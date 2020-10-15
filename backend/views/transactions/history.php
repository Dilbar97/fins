<?php

/**
 * @var array $histories
 */

use common\services\UserTransactionsService;
use common\models\User;
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Пользователь</th>
            <th scope="col">Автор</th>
            <th scope="col">Тип</th>
            <th scope="col">Сумма</th>
            <th scope="col">Дата транзакции</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($histories)) { ?>
        <?php foreach ($histories as $history) { ?>
            <tr>
                <th scope="row"><?= $history['id'] ?></th>
                <td><?= User::getUsernameById($history['userId']) ?></td>
                <td><?= User::getUsernameById($history['authorId']) ?></td>
                <td><?= UserTransactionsService::getType($history['type']) ?></td>
                <td><?= $history['type'] == UserTransactionsService::TRANSACTION_TYPE_INCOME ? '+' . $history['sum'] : '-' .  $history['sum'] ?></td>
                <td><?= $history['date'] ?></td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
