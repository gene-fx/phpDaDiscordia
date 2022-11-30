<?php
if (isset($_POST['pass']) && $_POST['pass'] != '') {
    $conn = new mysqli(HOST, USER, PASS, BASE);

    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" .
            $conn->connect_errno .
            ") " .
            $conn->connect_errno;
    } else {
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_UNSAFE_RAW);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW);
        $pass = password_hash(filter_input(INPUT_POST, 'pass', FILTER_UNSAFE_RAW), PASSWORD_DEFAULT);
        $reg_date = date('y-m-d');

        $sqlAdd = "INSERT INTO user (first_name, last_name, email, pass, reg_date) 
        VALUE ('{$first_name}', '{$last_name}', '{$email}', '{$pass}', '{$reg_date}')";

        $res = $conn->query($sqlAdd);

        if ($res == true) {
            $login = $conn->query('SELECT * FROM user WHERE email=' . '"' . $email . '"');
            $login = $login->fetch_assoc();
            $_SESSION['username'] = $login['first_name'];
            $_SESSION['lastname'] = $login['last_name'];
            $_SESSION['email'] = $login['email'];
            $_SESSION['id'] = $login['id'];
            echo '<script>console.log("veio aqui ->"'. $_POST['pass'] .')</script>';
            echo '<script> window.location.replace("' . $_SERVER['PHP_SELF'] . '?page=details&id=' . $_SESSION['id'] . ' ") </script>';
        }
    }
}
?>

<main>
    <h1>ADD</h1>
    <div class="form-content">
        <form method="POST" id="form-add">
            <input hidden name="page" value="add" />
            <article>
                <div>
                    <label>Nome</label>
                </div>
                <div>
                    <input name="first_name" id="first_name" value="" />
                </div>
            </article>
            <article>
                <div>
                    <label>Sobrenome</label>
                </div>
                <div>
                    <input name="last_name" id="last_name" value="" />
                </div>
            </article>
            <article>
                <div>
                    <label>Email</label>
                </div>
                <div>
                    <input type="email" name="email" id="email" value="" />
                </div>
            </article>
            <article>
                <div>
                    <label>Senha</label>
                </div>
                <div>
                    <input type="password" name="pass" id="pass" value="" />
                </div>
            </article>
            <article>
                <div>
                    <label>Data de registro</label>
                </div>
                <div>
                    <input disabled name="reg_date" value="<?php echo date('y-m-d'); ?>" />
                </div>
            </article>
            <article>
                <div>
                    <button class="green-btn" type="submit">Adicionar</button>
                    <button class="red-btn" type="reset">Limpar</button>
                </div>
            </article>
        </form>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    $('#form-add').submit((evet) => {
        if ($('#first_name').val().length == 0 || $('#first_name').val() == '' ||
            $('#last_name').val().length == 0 || $('#last_name').val() == '' ||
            $('#email').val().length == 0 || $('#email').val() == '' ||
            $('#pass').val().length == 0 || $('#pass').val() == '') {
            toastr.warning('<label style="background-color:red">Preencha todos campos para adionar</label>');
            event.preventDefault();
        } else {
            $('#form-edit').submit();
        }
    })
</script>