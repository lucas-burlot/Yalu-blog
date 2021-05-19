<?php
require_once('../includes/layouts/header_admin.php');

if(isset($_SESSION['user_id'])) // Si appuie du bouton
{
    if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
        header('Location: index.php');
        exit;
    }
}
    if (isset($_POST['id_utilisateur']))
        {
        if (isset($_POST['button_delete_user']))
        {
            User::deleteUser($_POST['id_utilisateur']);
        }
    }
?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2><i class="fas fa-users"></i> Gestion des utilisateurs</h2>
                <hr>
            </div>

            <div class="col-lg-5">
                <form method="Post" action="">
                <div class="input-group">
                    <input type="text" class="form-control" id="recherche" name="recherche" placeholder="Rechercher un utilisateur">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="input-group">
                    <div class="input-group-append">
                        <a class="button" href="admin_add_user.php">Ajouter un utilisateur</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <table class="table table-hover ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach (User::getUsers() as $user) {
                        echo '<form method="POST"><tr>';
                        echo '<input type="hidden" name="id_utilisateur" id="id_utilisateur" value="'.$user['id_utilisateur'].'">';
                        echo '<th scope="row">'.$user['id_utilisateur'].'</th>';
                        echo '<td>'.$user['nom'].'</td>';
                        echo '<td>'.$user['prenom'].'</td>';
                        echo '<td>'.$user['pseudo'].'</td>';
                        echo '<td>'.$user['email'].'</td>';
                        echo '<td width="250px"><button style="margin-right: 10px" type="button" class="btn btn-outline-warning">Modifier</button> 
                                                <input type="submit" class="btn btn-outline-danger" name="button_delete_user" value="Supprimer"></td>';
                        echo '</form> ';
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                if (isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
