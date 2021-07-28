</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>


<!-- https://www.blogson.com.br/como-formatar-campos-de-cpf-cep-telefone-e-moeda-com-jquery-jmask/ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
// JS DELETAR PRODUTO:
    $(document).on('click', '.delete-object', function () {

        var id = $(this).attr('delete-id');

        bootbox.confirm({
            message: "<h4>Certeza?</h4>",
            buttons: {
                confirm: {
                    label: '<span class="glyphicon glyphicon-ok"></span> Sim',
                    className: 'btn-danger'
                },
                cancel: {
                    label: '<span class="glyphicon glyphicon-remove"></span> Não',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {

                if (result == true) {
                    $.post('deletar_paciente.php', {
                        object_id: id
                    }, function (data) {
                        location.reload();
                    }).fail(function () {
                        alert('Não foi possível deletar.');
                    });
                }
            }
        });

        return false;
    });
</script>


</body>
</html>

