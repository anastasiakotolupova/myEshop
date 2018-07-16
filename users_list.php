<?php

    require_once('inc/header.php');

    $result = $pdo->query("SELECT * FROM user");
    $users = $result->fetchAll();

    $content .= "<table class='table table-striped'>";
    $content .= "<thead class='thead-dark'><tr>";

 
    for ($i = 0; $i < $result->columnCount(); $i++) 
    {
        $columns = $result->getColumnMeta($i);
        $content .= "<th scope='col'>" . ucfirst(str_replace('_', ' ', $columns['name'])) . "</th>";
    }
    $content .= '<th colspan="2">Actions</th>';
    $content .= "</tr></thead><tbody>";
    foreach ($users as $user) 
    {
        $content .= "<tr>";
        foreach ($user as $key => $value) {
            if ($key == 'picture') {
                $content .= '<td><img height="100" src="' . URL . 'users/img/' . $value . '" alt="' . $user['id_user'] . '"/></td>';
            } else {
                $content .= "<td>" . $value . "</td>";
            }
            
        }
        
        $content .= "<td><a href='" . URL . "admin/users_form.php?id=" . $user['id_user'] . "'><i class='fas fa-pen'></i></a></td>";
        $content .= "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash'></i></button></td>";

        $content .=    "<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Delete the user</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        <div class='modal-body'>
                            Are you sure you want to Delete the User?
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            <a href='?id=" . $user['id_user'] . "'><button type='button' class='btn btn-primary'>Confirm</button></a>
                        </div>
                    </div>
                </div>
            </div></td>";
    }
    $content .= "</tbody></table>";

    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
        $req = "SELECT * FROM user WHERE id_user = :id_user";

        $result = $pdo->prepare($req);

        $result->bindValue(':id_user', $_GET['id'], PDO::PARAM_INT);

        $result->execute();

        if($result->rowCount() == 1)
        {
            $user = $result->fetch();

            $delete_req = "DELETE FROM user WHERE id_user = $user[id_user]";

            $delete_result = $pdo->exec($delete_req);

            if($delete_result) {
                $user_picture_path = ROOT_TREE . 'users/img/' . $user['picture'];

                if(file_exists($user_picture_path) && $user['picture'] != 'default.jpg') // function file_exists() allows us to be sure that we got this picture registered on the server
                {
                    unlink($user_picture_path); // function unlink() allows us to delete a file from the server
                }

                header('location:users_list.php?m=success');
            } else {
                header('location:users_list.php?m=fail');
            }
        } else {
            header('location:users_list.php?m=fail');
        }
    }

    if(isset($_GET['m']) && !empty($_GET['m']))
    {

        switch($_GET['m'])
        {
            case 'success':
                $msg_success .= "<div class='alert alert-success'>The user is deleted.</div>";
            break;
            case 'fail':
                $msg_error .= "<div class='alert alert-danger'>Error during the operation. If you still have this mistake after few tries, please call the dev' team.</div>";
            break;
            case 'update':
                $msg_error .= "<div class='alert alert-success'>The update is successful !</div>";
            break;
            default:
                $msg_success .= "<div class='alert alert-secondary'>Don't understand, please try again.</div>";
            break;
        }
    }


?>

<h1>List of users</h1>


<?= $msg_error ?>
<?= $msg_success ?>
<?= $content ?>

<?php

require_once('inc/footer.php');

?>