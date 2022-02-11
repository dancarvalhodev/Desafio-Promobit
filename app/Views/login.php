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
    <h5 class="card-title">Entrar</h5>

    <div class="row">
        <div class="col-sm-12">
            <form action="/read-user" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Você não deve compartilhar seu e-mail com ninguém.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12 text-center">
            <a href="/register" class="btn btn-primary">Não possui cadastro? Clique Aqui</a>
        </div>
    </div>
  </div>
</div>