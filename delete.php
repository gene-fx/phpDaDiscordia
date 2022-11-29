<?php
$conn = new mysqli(HOST, USER, PASS, BASE);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_errno;
} else {
    if (!empty($_REQUEST['id'])) {
        $sqlQuery = $conn->query('SELECT * FROM user WHERE id=' . $_REQUEST['id']);
        $data = $sqlQuery->fetch_all();
        $user = $data[0];
        if (isset($_REQUEST['x'])) {
            $deleted = $conn->query('DELETE FROM user WHERE id=' . $_REQUEST['id']);
            if ($deleted == true) {
                $response = 'success';
                $response = json_encode($response);
                echo $response;
            }
        }
    }
}
?>
<main>
    <h1>Deletar Usuário</h1>
    <div class="form-content">
        <form type="POST" action='<?php echo $_SERVER['PHP_SELF'] ?>' id="delete-form">
            <input hidden name="page" value="delete" />
            <input hidden name="id" value="<?php echo $user[0] ?>">
            <input hidden name="x" value="true" />
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
                    <button class="red-btn" id="delete-btn" type="submit">Deletar</button>
                </div>
            </article>
        </form>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#delete-form').submit((event) => {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            color: '#fff',
            background: '#000000',
            icon: 'question',
            iconColor: '#e84c3d',
            showCancelButton: true,
            confirmButtonColor: '#365c7c',
            cancelButtonColor: '#e84c3d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed)
                $('#delete-form').submit();
        })
    })
</script>