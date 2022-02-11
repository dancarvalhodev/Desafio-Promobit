<hr class="separator">
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
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <h6>Tags</h6>
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
            <a href="/editProduct/<?= $data[0]['id']?>" class="btn btn-success btn-size"><i class="fa-solid fa-pen"></i> Editar</a>
        </div>
        <div class="col-sm-4 text-center">
            <a href="/deleteProduct/<?= $data[0]['id']?>" class="btn btn-danger btn-size"><i class="fa-solid fa-trash-can"></i> Excluir</a>
        </div>
        <div class="col-sm-4 text-center">
            <a href="/listProducts" class="btn btn-primary btn-size">Voltar</a>
        </div>
    </div>
  </div>
</div>