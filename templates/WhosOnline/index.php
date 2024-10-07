<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $whosOnline
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>

<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('ip') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_agent') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created', 'First Accessed') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified', 'Last Accessed') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($whosOnline as $whosOnline) : ?>
            <tr>
                <td><?= h($whosOnline->ip) ?></td>
                <td><?= $whosOnline->hasValue('user') ? $this->Html->link(
                        $whosOnline->user->username,
                        [
                            'plugin' => null,
                            'controller' => 'Users',
                            'action' => 'view',
                            $whosOnline->user->id
                        ],
                        ['class' => 'view']
                    ) : ''; ?></td>
                <td><?= $this->Html->link($whosOnline->url, $whosOnline->url) ?></td>
                <td><?= h($whosOnline->user_agent) ?></td>
                <td><?= h($whosOnline->created) ?></td>
                <td><?= h($whosOnline->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        __('View'),
                        ['action' => 'view', $whosOnline->id],
                        ['title' => __('View'), 'class' => 'btn btn-secondary view']
                    ) ?>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $whosOnline->id],
                        [
                            'confirm' => __('Are you sure you want to delete # {0}?', $whosOnline->id),
                            'title' => __('Delete'),
                            'class' => 'btn btn-danger delete'
                        ]
                    ) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
        <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
        <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>