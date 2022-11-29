/**
 * !-------------edit page
 */

$("#form").submit((event) => {
  if (
    $("#searchByEmail").val().length == 0 ||
    $("#searchByEmail").val() == ""
  ) {
    console.log("ta entrando no if");
    toastr.warning(
      '<label style="background-color:red">Preencha o email para pesquisar</label>'
    );
    event.preventDefault();
  } else {
    $("#form").submit();
  }
});

$("#form-edit").submit((evet) => {
  if (
    $("#first_name").val().length == 0 ||
    $("#first_name").val() == "" ||
    $("#last_name").val().length == 0 ||
    $("#last_name").val() == "" ||
    $("#email").val() == 0 ||
    $("#email").val() == ""
  ) {
    toastr.warning(
      '<label style="background-color:red">Preencha todos campos para editar</label>'
    );
    event.preventDefault();
  } else {
    $("#form-edit").submit();
  }
});
/**
 * !-----------------------------------------
 */

/**
 * !-------------delete page
 */
$("#delete-form").submit((event) => {
  event.preventDefault();
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    color: "#fff",
    background: "#000000",
    icon: "question",
    iconColor: "#e84c3d",
    showCancelButton: true,
    confirmButtonColor: "#365c7c",
    cancelButtonColor: "#e84c3d",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) $("#delete-form").submit();
  });
});
/**
 * !-----------------------------------------
 */

/**
 * !-------------add page
 */
 $('#form-add').submit((evet) => {
    if ($('#first_name').val().length == 0 || $('#first_name').val() == '' ||
        $('#last_name').val().length == 0 || $('#last_name').val() == '' ||
        $('#email').val().length == 0 || $('#email').val() == '' ||
        $('#pass').val().length == 0 || $('#pass').val() == '' ) {
        toastr.warning('<label style="background-color:red">Preencha todos campos para adionar</label>');
        event.preventDefault();
    } else {
        $('#form-edit').submit();
    }
})
/**
 * !-----------------------------------------
 */

