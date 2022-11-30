<?php
$conn = new mysqli(HOST, USER, PASS, BASE);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_errno;
} else {
    if(isset($_POST['email'])){
        $login = $conn->query('SELECT * FROM user WHERE email = '  . '"' . $_POST['email'] . '"');
        $login = $login->fetch_assoc();
        if(empty($login)){
            echo '<h3>EMAIL NAO ENCONTRADO</h3>';
        }
        else{
            if(password_verify($_POST['pass'], $login['pass'])){
                $_SESSION['username'] = $login['first_name'];
                $_SESSION['lastname'] = $login['last_name'];
                $_SESSION['email'] = $login['email'];
                $_SESSION['id'] = $login['id'];
                $_SESSION['last_activity'] = time();
                echo '<script>window.location.replace("http://localhost/structuredProject/index.php")</script>';
            }
            else{
                echo '<span>SENHA ERRADA</span>';
            }
        }
    }
}
?>
<main>
    <form method="POST" action="">
        <div>
            <label>Usuário (email)</label>
        </div>
        <div>
            <input placeholder="EMAIL" name="email" type="text">
        </div>
        <div>
            <label> Senha </label>
        </div>
        <div>
            <input placeholder="SENHA" name="pass" type="password">
        </div>
        <div class="btn-holder">
            <button class="green-btn">Login</button>
            <button class="blue-btn" formaction="<?php echo $_SERVER['PHP_SELF'] . '?page=add' ?>">Registrar</button>
        </div>
    </form>
</main>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>