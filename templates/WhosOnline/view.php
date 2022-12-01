<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $whosOnline
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('Delete Whos Online'), ['action' => 'delete', $whosOnline->id], [
        'confirm' => __('Are you sure you want to delete # {0}?', $whosOnline->id),
        'class' => 'delete nav-link'
    ]) ?></li>
<li><?= $this->Html->link(__('List Whos Online'), ['action' => 'index'], ['class' => 'list nav-link']) ?> </li>
<li><?= $this->Html->link(__('List Users'), [
        'plugin' => null,
        'controller' => 'Users', 'action' => 'index'
    ], ['class' => 'list nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="whosOnline view large-9 medium-8 columns content">
    <h3><?= h($whosOnline->ip) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Client IP') ?></th>
                <td><?= h($whosOnline->ip) ?></td>
            </tr>

            <tr>
                <th scope="row"><?= __('IP / User Agent Hash') ?></th>
                <td><?= h($whosOnline->ip_agent_hash) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('URL') ?></th>
                <td><?= h($whosOnline->url) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('PHP Session ID') ?></th>
                <td><?= h($whosOnline->php_session_id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Username') ?></th>
                <td><?= $whosOnline->has('user') ? $whosOnline->user->username : ''; ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('User Agent') ?></th>
                <td><?= $whosOnline->user_agent; ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('First connected') ?></th>
                <td><?= h($whosOnline->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Last access') ?></th>
                <td><?= h($whosOnline->modified) ?></td>
            </tr>
        </table>
    </div>
</div>