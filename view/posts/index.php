<div class="page-header">
    <h1>blog</h1>
</div>
<?php foreach( $posts as $k => $v): ?>
    <h2><?= $v->post_name ?></h2>
    <p><?= $v->post_content ?></p>
    <a href="<?= Router::url("posts/view/id:{$v->id}/slug:$v->post_slug"); ?>" title="<?= $v->post_name; ?>" >
        la suite
    </a>
<?php endforeach ?>

<nav aria-label="Page navigation">
  <ul class="pagination">
    <?php for( $c= 1;  $c <= $page; $c++): ?>
         <li><a href="?page=<?= $c; ?>"><?= $c ?></a></li>
    <?php endfor ?>
  </ul>
</nav>