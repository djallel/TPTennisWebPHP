<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Billetterie</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/styles.css">



    </head>
    <body class="sb-nav-fixed">
    <h1 class="text-logo"><span class="bi-shop"></span> Burger Code <span class="bi-shop"></span></h1>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Afficher les billets
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Niveau match</th>
                                            <th>Nom tournoi</th>
                                            <th>Prix Billet</th>
                                            <th>Cat??gorie Billet</th>
                                            <th>Emplacement</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                        require 'database.php';
                                        $db = Database::connect();
                                    //    $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');


                                             $statement = $db->query("SELECT b.id as id,
                                                                                       mt.niveau as NomMatch ,
                                                                                       t.nom_tournoi as NomTournoi ,
                                                                                       b.prix_billet as PrixBillet ,
                                                                                       cb.categorie_billet_enum_string categorieBillet,
                                                                                       e.libelle as Emplacement
                                                                                 FROM billet b
                                                                                         INNER JOIN categorie_billet cb ON b.id = cb.billet_id
                                                                                         INNER JOIN match_tennis as mt on b.id = mt.billet_id
                                                                                         INNER JOIN emplacement e on  e.billet_id= b.id
                                                                                         INNER JOIN tournoi t on b.id = t.billet_id
                                                                                ");


                                                    while($item = $statement->fetch()) {
                                                    echo '<tr>';
                                                        echo '<td>'. $item['NomMatch'] . '</td>';
                                                        echo '<td>'. $item['NomTournoi'] . '</td>';
                                                        echo '<td>'. number_format($item['PrixBillet'], 2, '.', '') . '</td>';
                                                        echo '<td>'. $item['categorieBillet'] . '</td>';
                                                        echo '<td>'. $item['Emplacement'] . '</td>';
                                                        echo '<td width=340>';
                                                            echo '<a class="btn btn-secondary" href="view.php?id='.$item['id'].'"><span class="bi-eye"></span> Voir</a>';
                                                            echo ' ';
                                                            echo ' ';
                                                            echo '</td>';
                                                        echo '</tr>';
                                                    }
                                                    Database::disconnect();
                                                    ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
