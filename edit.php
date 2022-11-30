<?php
if(!isset($_SESSION['username'])){
    echo '<h3>É preciso estar logado para acessar essa página!</h3>';
    die();
}

$conn = new mysqli(HOST, USER, PASS, BASE);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_errno;
} else {
    if (!empty($_REQUEST['id']) && !isset($_REQUEST['editing'])) {
        $sqlQuery = $conn->query('SELECT * FROM user WHERE id=' . $_REQUEST['id']);
        $user = $sqlQuery->fetch_all();
        $user = $user[0];
    } else {
        $sqlQuery = $conn->query('SELECT * FROM user');
        $data = $sqlQuery->fetch_all();
    }

    if(isset($_REQUEST['editing']) && isset($_REQUEST['editing'])){
        echo 'entrou no edditing';
        $firstName = $_REQUEST['first_name'];
        $lastName = $_REQUEST['last_name'];
        $email = $_REQUEST['email'];
        $updateDate = date('y-m-d');
        $id = $_REQUEST['id'];
        $sqlUpdateQuery = "UPDATE user SET first_name = '{$firstName}', last_name = '{$lastName}',
        email = '{$email}', update_date = '{$updateDate}' WHERE id = '{$id}'";
        $update = $conn->query($sqlUpdateQuery);

        if($update == true){
            echo '<script> window.location.replace("' . $_SERVER['PHP_SELF'] . '?page=details&id=' . $id . ' ") </script>';
        }
    }
}

if (empty($_REQUEST['id'])) {
?>
    <main>
        <h1>EDIT</h1>
        <div class="main-content">
            <div>
                <form method="GET" id="form" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div><label>Procura por email:</label></div>
                    <div><input hidden name="page" value="search" /></div>
                    <div><input type="email" name="searchByEmail" id="searchByEmail"></div>
                    <div><button type="submit" class="green-btn">Pesquisar</button></div>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Sobrenome</td>
                        <td>Email</td>
                        <td>Opções</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $userData) {
                    ?>
                        <tr>
                            <td><?php echo $userData[1] ?></td>
                            <td><?php echo $userData[2] ?></td>
                            <td><?php echo $userData[3] ?></td>
                            <td>
                                <a class="edit-table-btn" href="?page=edit&id=<?php echo $userData[0] ?>">EDIT</a>
                                <a class="delete-table-btn" href="?page=delete&id=<?php echo $userData[0] ?>">DELETE</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
<?php
} else {
?>
    <main>
        <h1>EDIT</h1>
        <div class="form-content">
            <form id="form-edit" type="POST">
                <input hidden name="page" value="edit" />
                <input hidden name="editing" value="true"/>
                <input hidden name="id" value="<?php echo $user[0] ?>" />
                <article>
                    <div>
                        <label>Nome</label>
                    </div>
                    <div>
                        <input name="first_name" id="first_name" value="<?php echo $user[1] ?>" />
                    </div>
                </article>
                <article>
                    <div>
                        <label>Sobrenome</label>
                    </div>
                    <div>
                        <input name="last_name" id="last_name" value="<?php echo $user[2] ?>" />
                    </div>
                </article>
                <article>
                    <div>
                        <label>Email</label>
                    </div>
                    <div>
                        <input name="email" id="email" value="<?php echo $user[3] ?>" />
                    </div>
                </article>
                <article>
                    <div>
                        <label>Data de registro</label>
                    </div>
                    <div>
                        <input disabled name="reg_date" id="reg_date" value="<?php echo $user[5] ?>" />
                    </div>
                </article>
                <article>
                    <div>
                        <button formaction="<?php echo $_SERVER['PHP_SELF'] ?>" 
                        class="green-btn">Salvar</button>
                    </div>
                    <div>
                        <button formaction="<?php echo $_SERVER['PHP_SELF'] . '?page=delete&id=' . $user[0]?>" 
                        class="red-btn" id="reset-btn">Excluir</button>
                    </div>
                </article>
            </form>
        </div>
    </main>
<?php
}
?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $('#form').submit((event) => {
        if ($('#searchByEmail').val().length == 0 || $('#searchByEmail').val() == '') {
            console.log('ta entrando no if');
            toastr.warning('<label style="background-color:red">Preencha o email para pesquisar</label>');
            event.preventDefault();
        } else {
            $('#form').submit();
        }
    })

    $('#form-edit').submit((evet) => {
        if ($('#first_name').val().length == 0 || $('#first_name').val() == '' ||
            $('#last_name').val().length == 0 || $('#last_name').val() == '' ||
            $('#email').val() == 0 || $('#email').val() == '') {
            toastr.warning('<label style="background-color:red">Preencha todos campos para editar</label>');
            event.preventDefault();
        } else {
            $('#form-edit').submit();
        }
    })
</script>