<?php
session_start();

if(!$_SESSION['usuario']) {
    header('Location: ../../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>HPG - Equipamentos</title>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/412/412858.png">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/bulma.min.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
        <script src="js/app.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/19778fe837.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
<?php

    $mysqli = new mysqli('localhost', 'root', '', 'bombeirospg');

    if(isset($_GET['search'])){

        $filterValues = $_GET['search'];
        $consulta = "SELECT * FROM equipamentos WHERE situacao LIKE '%$filterValues%'";
        $con = $mysqli->query($consulta) or die($mysqli->error);

    }else{

        $consulta = "SELECT * FROM equipamentos";
        $con = $mysqli->query($consulta) or die($mysqli->error);

    }
?>
    <body style="background-color: #F5F5F8;">
        <h2 style="color: #eb3131f5; margin-left: 10px; padding-top:15px"><i class="fa-solid fa-clipboard-list"></i> Estoque de equipamentos</h2>

        <div class="col-md-12">
            <div style="margin-top: 20px; padding-left: 10px;">
                <a href="../viatura/estoque-viatura.php"><button style="padding:5px" type="button" class="btn btn-danger"><i class="fa-solid fa-truck-medical"></i> Viatura</button></a>
                <a href="../equipamento/estoque-equipamento.php"><button style="padding:5px" type="button" class="btn btn-danger"><i class="fa-solid fa-toolbox"></i> Equipamento</button></a>
                <a href="../hidrante/estoque-hidrante.php"><button style="padding:5px" type="button" class="btn btn-danger"><i class="iconify" data-icon="mdi:fire-hydrant" style="font-size: 22px; vertical-align:top;"></i>Hidrante</button></a>
                <a href="../../home.php"><button type="button" style="color:#F5F5F8; padding:5px" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i> Voltar</button></a>
            </div>
        </div>
        <hr style="color: #ff6600;">
        <div class="row">
            <div class="col-md-6">
                <div style="margin-top: 20px; padding-left: 10px;">
                    <h4><a href="../../equipamento/cadastrar-equipamento.php"><button id="btn-addEstoque" style="font-size: 14px;" type="button" class="btn btn-sm btn-success"><b>+</b> Adicionar</button></a> Todos os equipamentos:</h4>
                </div>
            </div>
            <div class="col-md-6">
                <div style="margin-top: 20px; padding-left: 10px; text-align: right;">
                    <a href="/estoque/equipamento/estoque-equipamento.php"><button style="padding:5px" id="btnTodos" type="button" class="btn btn-sm"> Todos</button></a>
                    <a href="/estoque/equipamento/em-estoque-equipamento.php"><button style="padding:5px" id="btnEstoque" type="button" class="btn btn-sm "><i class="fa-solid fa-box"></i> Em estoque</button></a>
                    <a href="/estoque/equipamento/uso-equipamento.php"><button style="padding:5px" id="btnUso" type="button" class="btn btn-sm "><i class="fa-solid fa-box-open"></i> Em uso</button></a>
                    <a href="/estoque/equipamento/manutencao-equipamento.php"><button style="padding:5px" id="btnManutenção" type="button" class="btn btn-sm "><i class="fa-solid fa-screwdriver-wrench"></i> Em manutenção</button></a>
                    <a href="/estoque/equipamento/exportar-equip-geral.php"><button style="padding:5px" id="btnExportar" type="button" class="btn btn-sm btn-success"><i class="fa-solid fa-download"></i> Exportar dados</button></a>
                </div>
            </div>
            <form action="" method="GET">
                <div class="input-group mb-3" style="margin-left:10px; margin-top:10px; width:350px;">
                    <h6 style="margin-right:10px;">Situação:</h6>
                    <select class="form-select form-select-sm" type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>">
                        <option value="">Selecione...</option>
                        <option value="Em estoque">Em estoque</option>
                        <option value="Em uso">Em uso</option>
                        <option value="Em manutenção">Em manutenção</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-secondary">Buscar</button>
                </div>
            </form>
            <?php
                if(isset($_SESSION['sucesso_edit'])):
                ?>
                <div class="notification is-success" style="align-items:center; width: 300px; height: 60px; margin-left: 20px;">
                    <button class="delete"></button>
                    <p>Equipamento editado com sucesso!</p>
                </div>
                <?php
                endif;
                unset($_SESSION['sucesso_edit']);
            ?>
            <?php
                if(isset($_SESSION['sucesso_edit_modal'])):
                ?>
                <div class="notification is-success" style="align-items:center; width: 300px; height: 80px; margin-left: 20px;">
                    <button class="delete"></button>
                    <p>Situação do equipamento alterada com sucesso!</p>
                </div>
                <?php
                endif;
                unset($_SESSION['sucesso_edit_modal']);
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                        (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                            const $notification = $delete.parentNode;

                            $delete.addEventListener('click', () => {
                            $notification.parentNode.removeChild($notification);
                            });
                        });
                    });
            </script>
        </div>

        <div class="container-fluid mt-3" style="padding-bottom: 50px;">
            <table id="tabelaEquip" class="table table-hover table-bordered" style="overflow-x: auto; border-color: #444444; margin-top:20px; margin-bottom:40px; color:#000000;" border="2">
                <thead>
                    <tr>
                        <th class="th-sm" style="color: #000000; width: 10%; font-size:13px; background-color:#ff8533"><b>Nº Patrimônio</b></th>
                        <th class="th-sm" style="color: #000000; width: 30%; font-size:13px; background-color:#ff8533"><b>Equipamento</b></th>
                        <th class="th-sm" style="color: #000000; width: 10%; font-size:13px; background-color:#ff8533"><b>Condição</b></th>
                        <th class="th-sm" style="color: #000000; width: 10%; font-size:13px; background-color:#ff8533"><b>Imagem</b></th>
                        <th class="th-sm" style="color: #000000; width: 10%; font-size:13px; background-color:#ff8533"><b>Situação</b></th>
                        <th class="th-sm" style="color: #000000; width: 10%; font-size:13px; background-color:#ff8533"><b>Usuário</b></th>
                        <th class="th-sm" style="color: #000000; width: 5%; font-size:13px; background-color:#ff8533"><b>Data</b></th>
                        <th class="th-sm" style="color: #000000; width: 15%; font-size:13px; text-align:center; background-color:#ff8533"><b>Ação</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dado = $con->fetch_array()){ ?>
                    <tr>
                        <td style="font-size:12px; background-color:#fff"><?php echo $dado["patrimonio"]; ?></td>
                        <td style="font-size:12px; background-color:#fff; text-transform:capitalize;"><?php echo $dado["nome"]; ?></td>
                        <td style="font-size:12px; background-color:#fff; text-transform:capitalize;"><?php echo $dado["condicao"]; ?></td>
                        <td style="font-size:12px;">
                        <?php if($dado["imagem"] != ''): ?>
                            <?php echo '<img id="myImg" width="60" height="60" src="../../equipamento/imagens/'.$dado['imagem'].'" onclick="clique(\'../../equipamento/imagens/'.$dado['imagem'].'\')" alt="Image">';?></td>
                        <?php endif;?>
                        <td style="font-size:12px; background-color:#fff;">
                            <?php
                                if($dado["situacao"] == 'Em estoque'):
                                ?>
                                    <button type="button" class="btn btn-sm btn-success"><?php echo $dado["situacao"]; ?></button>
                                <?php
                                endif;
                            ?>
                            <?php
                                if($dado["situacao"] == 'Em uso'):
                                ?>
                                    <button type="button" class="btn btn-sm btn-danger"><?php echo $dado["situacao"]; ?></button>
                                <?php
                                endif;
                            ?>
                            <?php
                                if($dado["situacao"] == 'Em manutenção'):
                                ?>
                                    <button type="button" class="btn btn-sm btn-warning"><?php echo $dado["situacao"]; ?></button>
                                <?php
                                endif;
                            ?>
                        </td>
                        <td style="font-size:12px; background-color:#fff"><b><?php echo $dado["usuarioInsert"]; ?></b></td>
                        <td style="font-size:12px; background-color:#fff"><?php echo date("d/m/Y", strtotime($dado["created_at"])); ?></td>
                        <td class="text-center" style="font-size:12px; background-color:#fff">
                            <div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:12px;" type="button">Operação</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalMove" data-equipid="<?php echo $dado["id_equip"]; ?>" data-equipnome="<?php echo $dado["nome"]; ?>" data-equipobs="<?php echo $dado["descricao"]; ?>" data-equisit="<?php echo $dado["situacao"]; ?>">Alterar situação</a>
                                        <!-- <a class="dropdown-item" href="#">Ver histórico</a> -->
                                        <a class="dropdown-item" data-toggle="modal" data-target="#deletemodal" data-equipid="<?php echo $dado["id_equip"]; ?>">Dar baixa</a>
                                    </div>
                                </div>
                                <a style="margin-left:5px" href="<?php echo "editar-equipamento.php?id=".$dado['id_equip']?>"><button style="font-size:12px;" type="button" class="btn btn-sm btn-primary"><i style="" class="fa-solid fa-pen-to-square"></i> Editar</button></a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modal movimentar equipamento -->
        <div class="modal fade" id="modalMove" tabindex="-1" role="dialog" aria-labelledby="modalUsoLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modalUsoLabel">Alterar situação do equipamento</h3>
                        <i style="font-size: 30px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </i>
                    </div>
                    <form action="edit-equip-modal.php" method="POST">
                        <div class="modal-body">
                            <h5 style="padding-bottom: 10px; padding-top: 10px; font-size:20px">Logado como: <b><?php echo $_SESSION['usuario'];?></b></h5>
                            <input type="hidden" name="id_equip" id="id_equip">
                            <div class="form-group">
                                <label for="nome" class="col-form-label">Equipamento:</label>
                                <input type="text" class="form-control" name="nome" id="nome" disabled>
                            </div>
                            <div style="padding-top: 15px;">
                                <label for="situacao" class="col-form-label">Situação:</label>
                                <select class="form-select" name="situacao" id="situacao">
                                    <option value="Em uso">Em uso</option>
                                    <option value="Em estoque">Em estoque</option>
                                    <option value="Em manutenção">Em manutenção</option>
                                </select>
                            </div>
                            <div class="form-group" style="padding-top: 15px; padding-bottom: 15px;">
                                <label for="descricao" class="col-form-label">Observação:</label>
                                <textarea class="form-control" name="descricao" id="descricao"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="moveEquip" id="moveEquip" class="btn btn-warning">Salvar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal excluir equip -->
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                        <h3 class="modal-title" id="modalUsoLabel">Dar baixa em um equipamento</h3>
                        <i style="font-size: 30px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </i>
                    </div>
                    <h5 style="color:grey; margin-left:15px; padding-bottom: 10px; padding-top: 15px; font-size:17px">Logado como: <b><?php echo $_SESSION['usuario'];?></b></h5>
                    <form action="delete-equip-modal.php" method="POST">

                        <div class="modal-body">

                            <input type="hidden" name="id_equip" id="id_equip">

                            <h5>Tem certeza que deseja remover esse equipamento do estoque?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="darBaixa" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Remover </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $('#tabelaEquip').DataTable({
                        "scrollX": true,
                        "pageLength": 20,
                        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Todos"]],
                        "language": {
                            "lengthMenu": "Mostrando _MENU_ registros por página",
                            "zeroRecords": "Nada encontrado",
                            "info": "Mostrando página _PAGE_ de _PAGES_",
                            "infoEmpty": "Nenhum registro disponível",
                            "infoFiltered": "(filtrado de _MAX_ registros no total)",
                            "search": "Pesquisar",
                            "paginate": {
                                "next": "Próximo",
                                "previous": "Anterior",
                                "first": "Primeiro",
                                "last": "Último"
                            },
                        }
                    });
            });
        </script>

        <script>
            $('#modalMove').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)

                var id_equip = button.data('equipid')
                var nome = button.data('equipnome')
                var descricao = button.data('equipobs')
                var situacao = button.data('equisit')

                var modal = $(this)
                modal.find('.modal-body #id_equip').val(id_equip);
                modal.find('.modal-body #nome').val(nome);
                modal.find('.modal-body #descricao').val(descricao);
                modal.find('.modal-body #situacao').val(situacao);

            })
        </script>

        <script>
            $('#deletemodal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)

                var id_equip = button.data('equipid')
                var nome = button.data('equipnome')
                var descricao = button.data('equipobs')
                var situacao = button.data('equisit')

                var modal = $(this)
                modal.find('.modal-body #id_equip').val(id_equip);
                modal.find('.modal-body #nome').val(nome);
                modal.find('.modal-body #descricao').val(descricao);
                modal.find('.modal-body #situacao').val(situacao);

            })
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

        <script>

        function onlynumber(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            //var regex = /^[0-9.,]+$/;
            var regex = /^[0-9.]+$/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        // 42988288611
        document.getElementById('telefone').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });
        </script>
    </body>
</html>