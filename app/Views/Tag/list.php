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
    <h5 class="card-title">Listagem de Tags</h5>

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
                        <?php if(!empty($data)): ?>
                            <?php foreach($data as $tag): ?>
                                <tr>
                                    <td><?= $tag['name'] ?></td>
                                    <td>
                                        <a href="/editTag/<?= $tag['id']?>" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                                        <a href="/deleteTag/<?= $tag['id']?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                                <tr>
                                    <td colspan=2><p>Nenhuma Tag Encontrada</p></td>
                                </tr>
                        <?php endif; ?>
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