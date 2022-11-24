<script>
    datos = $('#frmCategorias').serialize();
    $.ajax({
        type: "POST",
        data: datos,
        url: "../procesos/",
        success: function(r) {}
    });
</script>


<script>
    $('').click(function() {
        var formData = new FormData(document.getElementById("frm"));
        $.ajax({
            url: "../procesos/articulos/insertarArchivo.php",
            type: "POST",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function(data) {}
        });
    });
</script>

<script>
    $('').click(function() {
        datos = $('#').serialize();
        $.ajax({
            type: "POST",
            data: datos,
            url: "../procesos/",

            success: function(r) {}
        });
    });
</script>