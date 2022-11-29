<?php
$conn = new mysqli(HOST, USER, PASS, BASE);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_errno;
} else {
    if (!empty($_REQUEST['id'])) {
        $sqlQuery = $conn->query('SELECT * FROM user WHERE id=' . $_REQUEST['id']);
        $user = $sqlQuery->fetch_all();
        $user = $user[0];
    }
}
?>
<main>
    <h1>Detalhes do Usuário</h1>
    <div class="form-content">
        <form>
            <article>
                <div>
                    <label>Nome</label>
                </div>
                <div>
                    <input disabled name="first_name" id="first_name" value="<?php echo $user[1] ?>" />
                </div>
            </article>
            <article>
                <div>
                    <label>Sobrenome</label>
                </div>
                <div>
                    <input disabled name="last_name" id="last_name" value="<?php echo $user[2] ?>" />
                </div>
            </article>
            <article>
                <div>
                    <label>Email</label>
                </div>
                <div>
                    <input disabled name="email" id="email" value="<?php echo $user[3] ?>" />
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
        </form>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready( () => {
        console.log('inicio da page');
        toastr.success('<label style="background-color:green">Operação executada com sucesso!</label>');
    })
</script>