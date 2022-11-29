<?php
if (isset($_REQUEST['searchByEmail'])) {
    $sqlQuery = $conn->query('SELECT * FROM user WHERE email=' . '"' . $_REQUEST['searchByEmail'] . '"');
    $data = $sqlQuery->fetch_all();
}
?>

<main>
    <h1>Search</h1>
    <div class="main-content">
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
                            <a class="delete-table-btn" href="">DELETE</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>