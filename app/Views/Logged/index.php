<hr class="separator">
<?php if(isset($_SESSION['msg'])): ?>
    <div class="text-center alert alert-warning alert-dismissible fade show">
        <strong><?= $_SESSION['msg'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php unset($_SESSION['msg']) ?>

<div class="text-center p-4">
    <h1>Bem-Vindo</h1>
    <hr class="separator">
    
    <div class="p-2">
        <div class="card" style="height: 220px;">
            <div class="card-body">
                <h5 class="card-title">Produtos</h5>
                <div class="row">
                    <div class="col-lg-4 p-1">
                        <a class="btn btn-primary btn-size" href="/newProductForm">Novo Produto</a>
                    </div>
                    <div class="col-lg-4 p-1">
                        <a class="btn btn-primary btn-size" href="/listProducts">Listar Produtos</a>
                    </div>
                    <div class="col-lg-4 p-1">
                        <a class="btn btn-primary btn-size" href="/report">Relatório</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-2">
        <div class="card p-1" style="height: 220px;">
            <div class="card-body">
                <h5 class="card-title">Tags</h5>
                <hr class="separator">
                <div class="row">
                    <div class="col-lg-6 p-1">
                        <a class="btn btn-primary btn-size" href="/newTagForm">Nova Tag</a>
                    </div>
                    <div class="col-lg-6 p-1">
                        <a class="btn btn-primary btn-size" href="/listTags">Listar Tags</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-2">
        <div class="card p-1" style="height: 220px;">
            <div class="card-body">
                <h5 class="card-title">Usuário</h5>
                <hr class="separator">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-primary btn-size" href="/logout">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>