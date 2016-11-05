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
                    $.each(data.menu_padres, function(i, v) {
                        $(".sidebar-menu").append("<li data-menuid='" +v.IdMenuSistema + "' class='treeview'><a href='" + v.Url + "'><i class='" + v.Icono + "'></i> <span>" + v.Titulo + "</span><span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span></a><ul class='treeview-menu'></ul></li>");
                    });
                    $.each(data.menu_hijos, function(i, v) {
                        $(".sidebar-menu li[data-menuid=" + v.IdPadre + "] .treeview-menu").append("<li data-menuid='" +v.IdMenuSistema + "'><a href='" + v.Url + "'><i class='" + v.Icono + "'></i> <span>" + v.Titulo + "</span></a></li>");
                    });
                },
                type: "get",
                url: "{{ url('/menu/get') }}"
            });
        });
    });
</script>