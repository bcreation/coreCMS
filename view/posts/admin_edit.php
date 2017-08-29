<div class="page-header">
    <h1>Edit</h1>
</div>
<form method="POST" action="<?= Router::url('admin/posts/edit') ?>">
    <?= $this->Form->input('name', 'Titre'); ?>
    <?= $this->Form->input('id', 'hidden'); ?>
    <?= $this->Form->input('slug', 'Slug'); ?>
    <?= $this->Form->input('content', 'Contenu', array('type'=>'textarea', 'col' => 5, 'rows' =>5) ); ?>
    <?= $this->Form->input('online', 'En ligne', array('type'=>'checkbox')); ?>
    <?= $this->Form->input('type', 'Type', array('type'=>'checkbox')); ?>
    <?= $this->Form->button('Editer', 'submit', array('class' => 'success')); ?>
</form> 
<?php debug($this->request->data); ?>