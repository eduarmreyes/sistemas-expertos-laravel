<script>
    $(function () {
        $(document).on("ready", function() {
            $.ajax({
                dataType: "json",
                error: function(data) {
                    var oNotify = null;
                    if (typeof data.responseText === "undefined") {
                        oNotify = {
                            title: "Error",
                            text: "Error grave, por favor revise la consola.",
                            type: "error"
                        };
                        console.log(data);
                    } else {
                        oNotify = {
                            title: "Acceso Negado",
                            text: data.responseText,
                            type: "error"
                        };
                    }
                    new PNotify(oNotify);
                },
                success: function(data) {
                    $.each(data.menu, function(i, v) {
                        $(".sidebar-menu").append("<li><a href='" + v.Url + "'><i class='" + v.Icono + "'></i> <span>" + v.Titulo + "</span></a></li>");
                    });
                },
                type: "get",
                url: "{{ url('/menu/get') }}"
            });
        });
    });
</script>