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
    <h5 class="card-title">Listagem de Produtos</h5>

    <div class="row">
        <div class="col-sm-12">
            <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php foreach($data as $produto): ?>
                            <tr>
                                <td><?= $produto['name'] ?></td>
                                <td>
                                    <a href="/showProduct/<?= $produto['id']?>" class="btn btn-info"><i class="fa-solid fa-info"></i></a>
                                    <a href="/editProduct/<?= $produto['id']?>" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                                    <a href="/deleteProduct/<?= $produto['id']?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
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