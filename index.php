<?php
/*** HEADER PHP ***/
require_once(__DIR__ . '/connection/Connection.php');

try{

    $conn = Connection::getConnection();

    $sql = "SELECT * FROM perfis";
    $query = $conn->query($sql);
    $perfis = $query->fetchAll(PDO::FETCH_OBJ);

    $sql = "SELECT p.descricao as perfil_descricao, u.nome as user_nome, u.id as user_id, p.id as perfil_id 
            FROM perfis_users as pu
            JOIN perfis as p ON p.id = pu.perfil_id
            JOIN users as u ON u.id = pu.user_id
            WHERE pu.user_id = 1
    ";
    $query = $conn->query($sql);
    $perfis_user = $query->fetchAll(PDO::FETCH_OBJ);

} catch(Exception $e){
    echo '<pre>';
    echo $e->getMessage();
    //echo '<br>Linha: '.$e->getLine();
    echo '<br>';print_r($e->getTrace());
    if (strpos($e->getMessage(), 'SQLSTATE[08001]') == true){
        echo '<br>Verifique a porta utilizada para conexão e tente novamente<br>';
    }
    echo '</pre>';
    exit;

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>teste-GL</title>

        <!-- BOOTSTRAP 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container-fluid">
            <br><br>
            <h3>Teste de GroupList para ajudar no desenvolvimento dos sistemas</h3>
            <br><br>

        <!--     <?php
                echo '<pre>';
                print_r($perfis_user);
                echo '</pre>';
            ?> -->
            <h3><?= $perfis_user[0]->user_nome ?></h3>
            <div class="row d-flex justify-content-center">
                <div class="col-4 align-self-center border border-dark p-0">
                    <div class="list-group">
                        <?php foreach($perfis as $perfil){ ?>
                                <button type="button" class="list-group-item list-group-item-action"><?= $perfil->descricao ?></button>
                            
                        <?php } ?>
                    </div>
                </div><!-- ./col -->
                <div class="col-1 align-self-center">
                    <button type="button" class="btn btn-primary"> >> </button>
                    <br>
                    <br>
                    <br>
                    <button type="button" class="btn btn-primary"> << </button>
                </div><!-- ./col -->
                <div class="col-4 align-self-center border border-dark p-0 ">
                    <div class="list-group ">
                        <?php foreach($perfis_user as $perfil_user){ ?>
                                <button type="button" class="list-group-item list-group-item-action"><?= $perfil_user->perfil_descricao ?></button>
                            
                        <?php } ?>
                    </div>
                </div><!-- ./col -->
            </div><!-- ./row -->
        </div>

    </body>
</html>