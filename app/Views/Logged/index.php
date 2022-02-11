<hr>
<?php if(isset($_SESSION['msg'])): ?>
    <div class="text-center alert alert-warning alert-dismissible fade show">
        <strong><?= $_SESSION['msg'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php unset($_SESSION['msg']) ?>

<div class="text-center p-4">
    <h1>Bem-Vindo</h1>
    <a class="btn btn-primary" href="/logout">Sair</a>
    
    <div class="p-5">
        <h2>Produtos</h2>
        <div class="row">
            <div class="col-sm-4 p-1">
                <a class="btn btn-primary" href="/newProductForm">Novo Produto</a>
            </div>
            <div class="col-sm-4 p-1">
                <a class="btn btn-primary" href="/listProducts">Listar Produtos</a>
            </div>
            <div class="col-sm-4 p-1">
                <a class="btn btn-primary" href="/report">Relatório de Releavância de Produtos</a>
            </div>
        </div>
    </div>
 
    <div class="p-5">
        <h2>Tags</h2>
        <div class="row">
            <div class="col-sm-6 p-1">
                <a class="btn btn-primary" href="/newTagForm">Nova Tag</a>
            </div>
            <div class="col-sm-6 p-1">
                <a class="btn btn-primary" href="/listTags">Listar Tags</a>
            </div>
        </div>
    </div>
</div>