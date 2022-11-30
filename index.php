<?php
session_start();

if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 1200){
    session_unset();
    session_destroy();
}

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("BASE", "structuredcrudphp");

$conn = new mysqli(HOST, USER, PASS, BASE);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" .
        $conn->connect_errno .
        ") " .
        $conn->connect_errno;
} else {
    $sqlQuery = $conn->query("SELECT * FROM user");
    $data = $sqlQuery->fetch_all();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sono&display=swap" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="./style/mystyle.css" rel="stylesheet">
    <title>Structured Project</title>
</head>

<body>
    <header>
        <div class="nav-bar">
            <ul class="nav-bar">
                <li class="nav-title">
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="?page=edit">Editar</a>
                </li>
                <li>
                    <a href="?page=add">Adicionar</a>
                </li>
                <?php if (isset($_SESSION['username'])) {
                ?>
                    <li>
                        <a href="<?php echo '?page=edit&id=' . $_SESSION['id'] ?> ">
                            <?php echo $_SESSION['username'] ?>
                        </a>
                    </li>
                    <li>
                        <a href="?page=logout">
                            Logout
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </header>
    <?php switch (@$_REQUEST["page"]) {
        case "add":
            include "add.php";
            break;
        case "edit":
            include "edit.php";
            break;
        case "search":
            include "search.php";
            break;
        case "details":
            include "details.php";
            break;
        case "delete":
            include "delete.php";
            break;
        case "logout":
            session_unset();
            session_destroy();
            echo "<script>window.location.replace('index.php')</script>";
            break;
        default:
            if (!isset($_SESSION['username'])) {
                include "login.php";
            } else {
    ?>
                <main>
                    <h1>Lista de Usuários</h1>
                    <div class="main-content">
                        <table>
                            <thead>
                                <tr>
                                    <td>Nome</td>
                                    <td>Sobrenome</td>
                                    <td>Email</td>
                                    <td>Registro</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $userData) { ?>
                                    <tr>
                                        <td><?php echo $userData[1]; ?></td>
                                        <td><?php echo $userData[2]; ?></td>
                                        <td><?php echo $userData[3]; ?></td>
                                        <td><?php echo $userData[5]; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </main>
    <?php
            }
            break;
    } ?>
</body>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</html>