var rows = [];
var count = 0;
var values_paciente = [];

function nuevo_turno(fecha,hora,minutos) {
    location.href = base_url+'/nuevo_turno/'+fecha+'/'+hora+'/'+minutos;
}

function borrar_turno(id) {
    url = base_url+"/borrar_turno/"+id;
    $('#borrar_turno').find('#aceptar').attr("href", url);
    $('#borrar_turno').modal('show');
}

function get_os_pr(sel_obra, sel_practica, medico, depto, callback) {

	$.ajax({
        url: base_url+"/get_all_os/"+medico+"/"+depto,
        dataType: 'json',
	 	success: function(response) {

            sel_obra.empty();
            sel_practica.empty();

	 		if (response['os'] != null && sel_obra != null){
	 			
		 		$.each(response['os'],function(key, value) 
				{   
				   sel_obra.append('<option value=' + value['id'] + '>' + value['obra'] + '</option>');
				});
			}	

			if (response['pr'] != null) {

		 		$.each(response['pr'],function(key, value)
				{
			    	sel_practica.append('<option value=' + value['id'] + '>' + value['practica'] + '</option>');
				});
			}	

		 	callback();
	  	}	
	});

}

$(document).on("change",".get_data",function(){

    var obj = $(this).closest('.practica');

    sel_obra = $(obj).find('#turno_obra');
    sel_practica = $(obj).find('#turno_practica');
    medico = $(this).val();
    depto = $("#datos_facturacion").find('#turno_localidad').val();

	get_os_pr(sel_obra, sel_practica, medico, depto, function () { return false; });

});

$(document).on("change","#turno_localidad",function(){

    depto = $(this).val();

    $.each(rows,function(key, value) 
    {   
        var obj = $("#datos_facturacion").find("#"+value);

        sel_obra = $(obj).find('#turno_obra');
        sel_practica = $(obj).find('#turno_practica');
        medico = $(obj).find('#turno_data').val();

        get_os_pr(sel_obra, sel_practica, medico, depto, function () { return false; });
    });    

});

$(document).on("click",".cerrar",function(){
	$(this).closest('.practica').remove();

	removeItem = $(this).closest('.practica').attr('id');
	rows.splice( $.inArray(removeItem,rows) ,1 );

});


$(document).on("click",".orden",function(){
	if ($(this).prop("checked") == true)
		$(this).closest('.practica').find('#turno_debe_orden').val("SI");
	else
		$(this).closest('.practica').find('#turno_debe_orden').val("NO");
});

$(document).on("click",".factura",function(){
	if ($(this).prop("checked") == true)
		$(this).closest('.practica').find('#turno_factura').val("SI");
	else
		$(this).closest('.practica').find('#turno_factura').val("NO");
});

$(document).on("click",".add",function(event){

	event.preventDefault();
	make_row(count,null);
});

function make_row(id,data) {

	rows.push(id);

	var html = "";

	$.each( medicos, function( key, value ) {
	    html += '<option value = "'+value['id_medico']+'">'+value['nombre']+'</option>';
	});

	$(".contenido").prepend(
        '<div class = "row practica" id = "'+id+'">'+
            '<div class = "col-xs-10">'+
                '<div class = "row">'+
                    '<div class="col-md-4">'+
                        '<label>Datos</label>'+
                        '<select class="form-control get_data" id = "turno_data" name="turno_data[]" required>'
                        	+html+
                        '</select>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<label>Práctica</label>'+
                        '<select class="form-control" id = "turno_practica" name="turno_practica[]" required>'+
                            
                        '</select>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<label>Obra Social</label>'+
                        '<select class="form-control" id = "turno_obra" name="turno_obra[]" required>'+
                            
                        '</select>'+
                    '</div>'+
                '</div>'+

                '<div class="row" style = "margin-top:10px">'+
                    '<div class="col-md-4">'+
                        '<label>Nro Afiliado</label>'+
                        '<input class="form-control" id = "turno_afiliado" type = "text" name="turno_afiliado[]">'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<label>Paga Plus</label>'+
                        '<input class="form-control" id = "turno_plus" type="number" name = "turno_plus[]">'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<label>Debe Plus</label>'+
                        '<input class="form-control" id = "turno_debe_plus" type="number" name = "turno_debe_plus[]">'+
                    '</div>'+
                    '<div class="col-md-4" style = "margin-top:20px">'+
                        '<label class="checkbox-inline">'+
                            '<input class = "orden" type="checkbox"> <strong> Debe Orden </strong>'+
                            '<input type="hidden" id = "turno_debe_orden" name = "turno_debe_orden[]">'+
                        '</label>'+
                        '<label class="checkbox-inline">'+
                            '<input class = "factura" type="checkbox"> <strong> Factura </strong>'+
                            '<input type="hidden" id = "turno_factura" name = "turno_factura[]">'+
                        '</label>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class = "col-xs-1">'+
                '<a href = "#" type="button" class="close cerrar">&times;</a>'+
            '</div>'+
        '</div>'
	);

    var obj = $("#datos_facturacion").find("#"+id);

    sel_obra = $(obj).find('#turno_obra');
    sel_practica = $(obj).find('#turno_practica');
    // medico = $(obj).find('#turno_data').val();
    depto = $("#datos_facturacion").find('#turno_localidad').val(); // Esta seteado de antemano en make_row con los datos del turno

	if (data != null) {
        
        medico = data['medico_fact'];

		get_os_pr(sel_obra, sel_practica, medico, depto, function() {

			sel_practica.val(data['practica']);
			sel_obra.val(data['obra']);
			$(obj).find('#turno_data').val(medico);
			$(obj).find('#turno_afiliado').val(data['nro_afiliado']);
			$(obj).find('#turno_plus').val(data['plus']);
			$(obj).find('#turno_debe_orden').val(data['debe_plus']);
			$(obj).find('#turno_debe_orden').val(data['debe_ord']);
			$(obj).find('#turno_factura').val(data['factura']);

			if (data['debe_ord'] === "SI")
				$(obj).find(".orden").prop('checked', true);

			if (data['factura'] === "SI")
				$(obj).find(".factura").prop('checked', true);
		});
	}
	else {
		get_os_pr(sel_obra, sel_practica, medico, depto, function() { 
			// $(obj).find('#turno_data').val(values_paciente['medico']);
			// $(obj).find('#turno_obra').val(values_paciente['obra_social']);	
			return false;
		});
	}	

	count = count + 1;
}

function clear_all() {

	$.each( rows, function( i, val ) {
		$("#datos_facturacion").find("#"+val).remove();
		rows = [];
	});
}

function editar_turno(id) {

	clear_all();

    $.ajax({
        url: base_url+"/get_info/"+id,                
        dataType: 'json',
        success:function(response)
        {   
    
            values_turno = response.data_turno;
            values_practicas = response.data_practicas;


            //Completo el formulario los datos del turno

            $('#datos_facturacion').find('#turno_id').val(values_turno.id_turno);
            $('#datos_facturacion').find('#turno_id_paciente').val(values_turno.id_paciente);
            $('#datos_facturacion').find('#turno_fecha').val(values_turno.fecha);

            $('#datos_facturacion').find('#turno_nombre').val(values_turno.paciente.split(',')[1]);
            $('#datos_facturacion').find('#turno_apellido').val(values_turno.paciente.split(',')[0]);
            $('#datos_facturacion').find('#turno_hora').val(values_turno.hora);
            $('#datos_facturacion').find('#turno_citado').val(values_turno.citado);
            $('#datos_facturacion').find('#turno_localidad').val(values_turno.localidad);
            $('#datos_facturacion').find('#turno_tel11').val(values_turno.telefono.split('-')[0]);
            $('#datos_facturacion').find('#turno_tel12').val(values_turno.telefono.split('-')[1]);
            $('#datos_facturacion').find('#turno_tel21').val(values_turno.celular.split('-')[0]);
            $('#datos_facturacion').find('#turno_tel22').val(values_turno.celular.split('-')[1]);

            $('#datos_facturacion').find('#turno_medico').val(values_turno.medico);
            

             $.each( values_practicas, function(key,val) {
				make_row(key, val);
			});

            $('#editar_turno').modal('show');

        }
    });        
}

function actualizar_estado(id,clase) {
    $("#estado_"+id).attr('class', clase);
}