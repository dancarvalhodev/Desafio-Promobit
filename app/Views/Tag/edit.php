<hr class="separator">
<?php if(isset($_SESSION['msg'])): ?>
    <div class="text-center alert alert-warning alert-dismissible fade show">
        <strong><?= $_SESSION['msg'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php unset($_SESSION['msg']) ?>

<div class="card p-4" style="width: 100%;">
  <div class="card-body">
    <h5 class="card-title text-center">Edição da Tag</h5>

    <div class="row">
        <div class="col-sm-12">
            <form action="/edit-tag" method="post">
                <?= csrf_field() ?>
                <input style="display: none;" type="text" value="<?= $data[0]['id'] ?>" required class="form-control" name="id" id="id">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-12 p-2">
                            <label for="name" class="form-label">Digite o nome da tag</label>
                            <input type="text" value="<?= $data[0]['name'] ?>" required class="form-control" name="name" id="name">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-size">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 text-center">
            <a href="/home" class="btn btn-primary btn-size">Voltar</a>
        </div>
    </div>
  </div>
</div>