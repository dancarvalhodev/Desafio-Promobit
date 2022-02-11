<?php //var_dump($data); ?>


<hr>
<?php if(isset($_SESSION['msg'])): ?>
    <div class="text-center alert alert-warning alert-dismissible fade show">
        <strong><?= $_SESSION['msg'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php unset($_SESSION['msg']) ?>

<div class="card p-4" style="width: 100%;">
  <div class="card-body text-center">
    <h5 class="card-title">Relatório</h5>
    <div class="row">
        <?php foreach($data as $relationship): ?>
            <div class="col-sm-12 p-2">
                <div class="card p-4" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $relationship['name'] ?></h5>
                        <hr>
                        <div class="row">
                            <h6>Tags</h6>
                            <?php foreach($relationship['tag'] as $tag): ?>
                                <p><?= $tag ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 text-center">
            <a href="/home" class="btn btn-primary">Voltar</a>
        </div>
    </div>
  </div>
</div>