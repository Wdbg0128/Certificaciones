$(document).ready(function(){
    $(".alert").delay(10000).slideUp(1000);
});

var Idioma = {
	            "sProcessing":     "Procesando la Información...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando Datos...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
}

function filaCertificado(){
$("#Certificado tr").on("click", function() {
    var dato = $(this)
      .find("td:eq(0)")
      .html();
     console.log(dato);
    $("#maecertificado_id").val(dato);
    var dato2 = $(this)
    .find("td:eq(2)")
      .html();
    $("#NombreCer").val(dato2);
    $("#NombreCer1").val(dato2);
});

}
function filaPersona(){

    $("#Personas tr").on("click", function() {
        var dato = $(this)
        .find("td:eq(0)")
        .html();
        $("#Num_Sap").val(dato);
    var dato2 = $(this)
    .find("td:eq(1)")
    .html();
    $("#Apellidos_Nombres").val(dato + " | " + dato2);
    $("#Apellidos_Nombres1").val(dato + " | " + dato2);
});
}
