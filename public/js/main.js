$(document).ready(function(){
	if(window.jQuery){
		if($.fn.DataTable){
			$('.dts').DataTable({
				language: {
					url: '/libs/datatables/spanish.json'
				}
			});
		}
	}	
})

$(function(){
	$('#carnetfrontal-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#carnetfrontal").removeClass('bg-filledInputs');
		  $("#carnetfrontal").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#carnetfrontal").addClass('bg-success');
			$("#carnetfrontal").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });
	  $('#carnetfrontalempresa-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#carnetfrontalempresa").removeClass('bg-filledInputs');
		  $("#carnetfrontalempresa").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#carnetfrontalempresa").addClass('bg-success');
			$("#carnetfrontalempresa").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });
	  $('#primerainscripcion-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#primerainscripcion").removeClass('bg-filledInputs');
		  $("#primerainscripcion").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#primerainscripcion").addClass('bg-success');
			$("#primerainscripcion").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });
	  $('#compranotarial-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#compranotarial").removeClass('bg-filledInputs');
		  $("#compranotarial").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#compranotarial").addClass('bg-success');
			$("#compranotarial").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });	  
	  $('#padron-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#padron").removeClass('bg-filledInputs');
		  $("#padron").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#padron").addClass('bg-success');
			$("#padron").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });	
	  $('#cav-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#cav").removeClass('bg-filledInputs');
		  $("#cav").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#cav").addClass('bg-success');
			$("#cav").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });	
	  
	  
	  $('#tagentregado-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#tagentregado").removeClass('bg-filledInputs');
		  $("#tagentregado").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#tagentregado").addClass('bg-success');
			$("#tagentregado").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });

	  $('#tag-form :input').change(function(){
		var $input = $(this);
		if ($input.val() === '')
		{
		  $("#tag").removeClass('bg-filledInputs');
		  $("#tag").append('<span>  - <i class="fa-solid fa-xmark"></i></span>');
		}else{
			$("#tag").addClass('bg-success');
			$("#tag").append('<span>  - <i class="fa-solid fa-circle-check"></i></span>');  
		}
	  });
  });

function checkRut(rut) {
	// Despejar Puntos
	var valor = rut.value.replace('.','');
	// Despejar Gui??n
	valor = valor.replace('-','');
	
	// Aislar Cuerpo y D??gito Verificador
	cuerpo = valor.slice(0,-1);
	dv = valor.slice(-1).toUpperCase();
	
	// Formatear RUN
	rut.value = cuerpo + '-'+ dv
	
	// Si no cumple con el m??nimo ej. (n.nnn.nnn)
	if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
	
	// Calcular D??gito Verificador
	suma = 0;
	multiplo = 2;
	
	// Para cada d??gito del Cuerpo
	for(i=1;i<=cuerpo.length;i++) {
	
		// Obtener su Producto con el M??ltiplo Correspondiente
		index = multiplo * valor.charAt(cuerpo.length - i);
		
		// Sumar al Contador General
		suma = suma + index;
		
		// Consolidar M??ltiplo dentro del rango [2,7]
		if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
	}
	
	// Calcular D??gito Verificador en base al M??dulo 11
	dvEsperado = 11 - (suma % 11);
	
	// Casos Especiales (0 y K)
	dv = (dv == 'K')?10:dv;
	dv = (dv == 0)?11:dv;
	
	// Validar que el Cuerpo coincide con su D??gito Verificador
	if(dvEsperado != dv) { rut.setCustomValidity("RUT Inv??lido"); return false; }
	
	// Si todo sale bien, eliminar errores (decretar que es v??lido)
	rut.setCustomValidity('');
};


