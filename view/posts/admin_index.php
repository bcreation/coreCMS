<div class="page-header">
Manage 
</div>
<?= debug($post); ?>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($posts as $k=>$v): ?>
        <tr>
            <td><?= $v->id ?></td>
            <td><?= $v->name ?></td>
            <td>
                <a href="<?= Router::url('admin/posts/edit/'.$v->id); ?>" class="btn btn-success">Edit</a> 
                <a href="<?= Router::url('admin/posts/delete/'.$v->id); ?>" class="btn btn-danger">delete</a> 
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>