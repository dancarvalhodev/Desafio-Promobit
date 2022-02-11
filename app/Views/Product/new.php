<hr>
<?php if(isset($_SESSION['msg'])): ?>
    <div class="text-center alert alert-warning alert-dismissible fade show">
        <strong><?= $_SESSION['msg'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php unset($_SESSION['msg']) ?>

<div class="card p-4" style="width: 100%;">
  <div class="card-body">
    <h5 class="card-title">Novo Produto</h5>

    <div class="row">
        <div class="col-sm-12">
            <form action="/create-product" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-12 p-2">
                            <label for="name" class="form-label">Digite o nome do produto</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row tagFieldForm">
                        <div class="col-sm-12 p-2">
                            <label for="tag" class="form-label">Digite a(s) tag(s) do produto</label>
                            <input type="text" class="form-control" name="tag[]" id="tag">
                        </div>
                    </div>
                    <div class="col-sm-12 p-3 text-center">
                        <button class="btn btn-warning addTag">Adicionar Tag</button>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 text-center">
            <a href="/home" class="btn btn-primary">Voltar</a>
        </div>
    </div>
  </div>
</div>