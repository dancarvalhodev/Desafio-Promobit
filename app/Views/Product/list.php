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
    <h5 class="card-title text-center">Listagem de Produtos</h5>
    <hr class="separator">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Nome</th>
                            <th scope="col" class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if(!empty($data)): ?>
                            <?php foreach($data as $produto): ?>
                                <tr>
                                    <td><?= $produto['name'] ?></td>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-sm-4 p-1"><a href="/showProduct/<?= $produto['id']?>" class="btn btn-info btn-action"><i class="fa-solid fa-info"></i></a></div>
                                            <div class="col-sm-4 p-1"><a href="/editProduct/<?= $produto['id']?>" class="btn btn-success btn-action"><i class="fa-solid fa-pen"></i></a></div>
                                            <div class="col-sm-4 p-1"><a href="/deleteProduct/<?= $produto['id']?>" class="btn btn-danger btn-action"><i class="fa-solid fa-trash-can"></i></a></div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                                <tr>
                                    <td colspan=2><p>Nenhum Produto Encontrado</p></td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="/home" class="btn btn-primary btn-size">Voltar</a>
        </div>
    </div>
  </div>
</div>