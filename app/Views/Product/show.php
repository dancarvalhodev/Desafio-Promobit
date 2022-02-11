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
    <h5 class="card-title">Detalhe do Produto (<?= $data[0]['name']?>)</h5>

    <div class="row">
        <div class="col-sm-12">
            <h2>Tags</h2>
            <?php if(isset($data[0]['tag']) && !empty($data[0]['tag'])): ?>
                <?php foreach($data[0]['tag'] as $tag): ?>
                    <p><?= $tag ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhuma Tag para Exibir</p>
            <?php endif; ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4 text-center">
            <a href="/editProduct/<?= $data[0]['id']?>" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
        </div>
        <div class="col-sm-4 text-center">
            <a href="/deleteProduct/<?= $data[0]['id']?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
        </div>
        <div class="col-sm-4 text-center">
            <a href="/listProducts" class="btn btn-primary">Voltar</a>
        </div>
    </div>
  </div>
</div>