<div class="page-header">
    <h1>blog</h1>
</div>
<?php foreach( $posts as $k => $v): ?>
    <h2><?= $v->name ?></h2>
    <p><?= $v->content ?></p>
    <a href="/<?= Router::url("posts/view/id:{$v->id}/slug:$v->slug"); ?>" title="<?= $v->name; ?>" >
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
