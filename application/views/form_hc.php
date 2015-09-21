<!DOCTYPE html>

<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script type="text/javascript"  src="<?php echo base_url('js/jsPanel-master/jquery-2.1.3.min.js')?>"></script>
		<script type="text/javascript" src="<?php echo base_url('js/jsPanel-master/jquery-ui-1.11.2.min.js')?>"></script>

		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.core.js')?>" type="text/javascript" charset="utf-8"></script>

		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.tags.js')?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.autocomplete.js')?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.suggestions.js')?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.filter.js')?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.focus.js')?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.prompt.js')?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.ajax.js')?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url('js/jquery-textext-master/src/js/textext.plugin.arrow.js')?>" type="text/javascript" charset="utf-8"></script>

		<link rel="stylesheet" href="<?php echo base_url('js/jquery-textext-master/src/css/textext.core.css')?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url('js/jquery-textext-master/src/css/textext.plugin.tags.css')?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url('js/jquery-textext-master/src/css/textext.plugin.autocomplete.css')?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url('js/jquery-textext-master/src/css/textext.plugin.focus.css')?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url('js/jquery-textext-master/src/css/textext.plugin.prompt.css')?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url('js/jquery-textext-master/src/css/textext.plugin.arrow.css')?>" type="text/css" />

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css')?>"/>

		<style type="text/css">
			body {
				//width: 790px;
				//height: 1500px;
				//border: 1px solid;
				font-size: 12pt;
				background-color: #F4F4F4;
				//background-color: #F7F7F7;
			}

			h3 {
				font-family: Oswald;
				font-size: 12pt;
				font-weight: normal;
				float: left;
			}

			.separador {
				float:left;
				width: 98%;
				margin-top: 10px;
				margin-bottom: 20px;
			}

			.panel_izq {
				float: left;
				width: 45%;
				margin-left: 20px;
				//margin-top: 20px;
			}

			.panel_der {
				float: left;
				//margin-left: 100px;
				width: 45%;
				//margin-top: 20px;
			}

			table {
				border-collapse: collapse;
				font-family: Oswald;
				margin-top: 10px;
			}

			table input {
				width: 50px;
				border: none;
				font-size: 12pt;
				background-color: transparent;
				//background-color: #F7F7F7;
			}

			th, td {
				//border: 1px solid;
				border: none;
			}

			.av_tabla td {
				//border:none;
				padding-top: 4px;
			}

			.av_tabla select {
				font-size: 11pt;
				background-color: transparent;
				//background-color: #F7F7F7;
			}

			.solicitud_tabla td {
				width: 120px;
				//border:none;
			}

			.solicitud_tabla input {
				width: 20px;
				//background-color: #F7F7F7;
				background-color: transparent;
			}

			.tabla_esp td {
				width: 100%
			}

			.titulo{
				font-size: 14pt;
				height: 25px;
				padding-left: 5px;
			}

			.tabla_ref input{
				border: 2px solid #4289b8;
			}

			.con_correc input {
				border: 2px solid #97d0d9;
			}

			.subjetiva input {
				border: 2px solid #97afd9;
			}

			button.mod {
				font-size: 14px;
				padding: 5px 10px;
			}

			.boton {
				background-color: #97d0d9;
				font-family: 'OSWALD';
				font-size: 12pt;
				text-decoration: none;
				padding-left: 20px;
				padding-right: 20px;
				padding-top: 5px;
				padding-bottom: 5px;
				color:white;
				border-radius: 4px;
			}

			.boton:hover {
				background-color: #1E91A3;
			}

			.myboton {
				background-repeat:no-repeat;
				border:none;
				background-color: transparent;
				width: 40px;
				height: 40px;
				float: right;
			}

			.myboton:hover {
				cursor: pointer;
			}

		</style>
		<script type="text/javascript">

			function enviar_reg(id) {

				if (id == "reg_guardar")
					formaction = "<?php echo base_url('index.php/main/submit_data/registro')?>";
				else if (id == "reg_borrador")
					formaction="<?php echo base_url('index.php/main/guardar_borrador/registro')?>";
				else
					formaction="<?php echo base_url('index.php/main/eliminar_borrador/registro')?>";

				$('#form_registro').attr('action', formaction);
				$('#form_registro').attr('target', '_parent');
				$("#form_registro").submit();

			}

			$(document).on("keypress", ":input:not(textarea)", function(event) {
			    return event.keyCode != 13;
			});

			$(document).ready( function() {

				$("#od_k1_krt").keyup(function() {
        			val1 = parseFloat($(this).val());
        			val2 = parseFloat($("#od_k2_krt").val());
  
        			if (!$.isNumeric(val1))
        					val1 = 0;

        			if (!$.isNumeric(val2))
        					val2 = 0;

        			if ( ($("#od_k1_krt").val() != "") && ($("#od_k2_krt").val() != ""))
	        			$("#od_ave_krt").val(parseFloat( (val1 + val2)/2 ).toFixed(2));
	        		if ( ($("#od_k1_krt").val() == "") || ($("#od_k2_krt").val() == ""))
	        			$("#od_ave_krt").val(parseFloat(val1 + val2).toFixed(2));
	        		if ( ($("#od_k1_krt").val() == "") && ($("#od_k2_krt").val() == ""))
	        			$("#od_ave_krt").val("");
        			
        		 });

				$("#od_k2_krt").keyup(function() {
        			val1 = parseFloat($(this).val());
        			val2 = parseFloat($("#od_k1_krt").val());

        			if (!$.isNumeric(val1))
        					val1 = 0;

        			if (!$.isNumeric(val2))
        					val2 = 0;

	        		if ( ($("#od_k1_krt").val() != "") && ($("#od_k2_krt").val() != ""))
	        			$("#od_ave_krt").val(parseFloat( (val1 + val2)/2 ).toFixed(2));
	        		if ( ($("#od_k1_krt").val() == "") || ($("#od_k2_krt").val() == ""))
	        			$("#od_ave_krt").val(parseFloat(val1 + val2).toFixed(2));
	        		if ( ($("#od_k1_krt").val() == "") && ($("#od_k2_krt").val() == ""))
	        			$("#od_ave_krt").val("");
        			
        		 });

				$("#os_k1_krt").keyup(function() {
        			val1 = parseFloat($(this).val());
        			val2 = parseFloat($("#os_k2_krt").val());

        			if (!$.isNumeric(val1))
        					val1 = 0;

        			if (!$.isNumeric(val2))
        					val2 = 0;

	        		if ( ($("#os_k1_krt").val() != "") && ($("#os_k2_krt").val() != ""))
	        			$("#os_ave_krt").val(parseFloat( (val1 + val2)/2 ).toFixed(2));
	        		if ( ($("#os_k1_krt").val() == "") || ($("#os_k2_krt").val() == ""))
	        			$("#os_ave_krt").val(parseFloat(val1 + val2).toFixed(2));
	        		if ( ($("#os_k1_krt").val() == "") && ($("#os_k2_krt").val() == ""))
	        			$("#os_ave_krt").val("");
        			
        		 });

				$("#os_k2_krt").keyup(function() {
        			val1 = parseFloat($(this).val());
        			val2 = parseFloat($("#os_k1_krt").val());

        			if (!$.isNumeric(val1))
        					val1 = 0;

        			if (!$.isNumeric(val2))
        					val2 = 0;

	        		if ( ($("#os_k1_krt").val() != "") && ($("#os_k2_krt").val() != ""))
	        			$("#os_ave_krt").val(parseFloat( (val1 + val2)/2 ).toFixed(2));
	        		if ( ($("#os_k1_krt").val() == "") || ($("#os_k2_krt").val() == ""))
	        			$("#os_ave_krt").val(parseFloat(val1 + val2).toFixed(2));
	        		if ( ($("#os_k1_krt").val() == "") && ($("#os_k2_krt").val() == ""))
	        			$("#os_ave_krt").val("");
        			
        		 });

    			$("#adding").keyup(function() {
        			val = parseFloat($(this).val());
        			if (!$.isNumeric(val))
            			val = 0;

            		if ($("#od_esf_subj_lejos").val() == "")
            			od_esf_lejos = 0;
            		else 
            			od_esf_lejos = $("#od_esf_subj_lejos").val();

            	
            		if ($("#os_esf_subj_lejos").val() == "")
            			os_esf_lejos = 0;
            		else 
            			os_esf_lejos = $("#os_esf_subj_lejos").val();

            		val_od = parseFloat(parseFloat(val)+parseFloat(od_esf_lejos)).toFixed(2);
            		val_os = parseFloat(parseFloat(val)+parseFloat(os_esf_lejos)).toFixed(2);

      				//if ($("#od_esf_subj_lejos").val()) {
        				$("#od_esf_subj_cerca").val( val_od );
        				$("#od_cil_subj_cerca").val($("#od_cil_subj_lejos").val());
        				$("#od_eje_subj_cerca").val($("#od_eje_subj_lejos").val());
    				//}

    				//if ($("#os_esf_subj_lejos").val()) {
    					$("#os_esf_subj_cerca").val( val_os );
    					$("#os_cil_subj_cerca").val($("#os_cil_subj_lejos").val());
    					$("#os_eje_subj_cerca").val($("#os_eje_subj_lejos").val());
    				//}	
    			});

    			$("#od_k1_eje_krt").keyup(function() {
        			val = parseFloat($(this).val());
        			if ($.isNumeric(val))
            			$("#od_k2_eje_krt").val(parseFloat((val + 90)%180 ));
            		else
            			$("#od_k2_eje_krt").val("");
    			});

    			$("#od_k2_eje_krt").keyup(function() {
        			val = parseFloat($(this).val());
        			if ($.isNumeric(val))
            			$("#od_k1_eje_krt").val(parseFloat((val + 90)%180 ));
            		else
            			$("#od_k1_eje_krt").val("");
    			});

    			$("#os_k1_eje_krt").keyup(function() {
        			val = parseFloat($(this).val());
        			if ($.isNumeric(val))
            			$("#os_k2_eje_krt").val(parseFloat((val + 90)%180 ));
            		else
            			$("#os_k2_eje_krt").val("");
    			});

    			$("#os_k2_eje_krt").keyup(function() {
        			val = parseFloat($(this).val());
        			if ($.isNumeric(val))
            			$("#os_k1_eje_krt").val(parseFloat((val + 90)%180 ));
            		else
            			$("#os_k1_eje_krt").val("");
    			});

    			var json = $('#varDiag').val();
				var borrador = json.split(',');
				var lista = [];

				$.each(borrador, function( index, value ) {
  					lista.push(value);
				});
				
    			$('#txt_diag')
				.textext({
	            	plugins : 'tags autocomplete prompt',
	            	tagsItems : lista,
	            	prompt : 'Añadir diagnóstico...',
	        	})
	        	.bind('getSuggestions', function(e, data)
	        	{
	            	var list = [
	                    'Quemadura química',
						'Abrasión corneal',
						'Cuerpo extraños corneal',
						'Cuerpo extraño conjuntival',
						'Laceración conjuntival',
						'Iritis traumática',
						'Hipema',
						'Iridodiálisis',
						'Ciclodiálisis',
						'Laceración palpebral',
						'Fractura de orbita',
						'Hemorragia retobulbar traumática',
						'Neuropatía óptica traumática',
						'Cuerpo extraño intraorbitaro',
						'Laceración corneal',
						'Rotura de globo ocular',
						'Cuerpo extraño intraocular',
						'Rotura coroidea traumática',
						'Coriorretinitis escopletaria',
						'Retinopatía de Purtscher',
						'Síndrome del niño maltratado',
						'Queratopatia punteada superficial',
						'Erosión corneal recurrente',
						'Síndrome del ojo seco',
						'Queratopatia filamentosa',
						'Queratopatía por exposición',
						'Queratopatia neurotrófica',
						'Queratopatía térmica',
						'Queratopatia punteada superficial de Thygeson',
						'Pterigion',
						'Pinguécula',
						'Queratopatia en banda',
						'Queratopatia bacteriana',
						'Queratitis fúngica',
						'Queratitis por Acanthamoeba',
						'Queratopatia cristalina',
						'Herpes simple',
						'Herpes zoster',
						'Queratitis intersticial',
						'Flictenulosis',
						'Conjuntivits papilar gigante',
						'Adelgazamiento corneal',
						'Ulcera corneal',
						'Dellen',
						'Queratocono',
						'Queratoglobo',
						'Distofia en Mapa-Punto-Huella',
						'Distrofia de meesmann',
						'Reis-Bücklers',
						'Distrofia reticular',
						'Distrofia granular',
						'Distrofia macular',
						'Distrofia de Schnyder',
						'Distrofia polimorfa posterior',
						'Distrofia endotelial hereditaria congénita',
						'Distrofia endotelial de Fuchs',
						'Distrofia corneal',
						'Queratopatia bullosa afáquica',
						'Queratopatia bullosa pseudofáquica',
						'Rechazo endotelial corneal',
						'Rechazo epitelial corneal',
						'Rechazo de injerto corneal',
						'Cirugía refractiva',
						'LASIK miópico',
						'LASIK hipermetrópico',
						'PRK miópico',
						'PRK hipermetrópico',
						'Conjuntivitis aguda',
						'Conjuntivitis crónica',
						'Conjuntivitis epidémica',
						'Conjuntivis alérgica',
						'Síndrome de Parinaud',
						'Queratoconjuntivitis límbica superior',
						'Hemorragia subconjuntival',
						'Epiescleritis',
						'Escleritis',
						'Blefaritis',
						'Meibomitis',
						'Rosácea ocular',
						'Penfigoide ocular',
						'Dermatitis de contacto',
						'Dermoide',
						'Granuloma piógeno',
						'Linfangioma',
						'Granuloma',
						'Papiloma',
						'Sarcoma de Kaposi',
						'Neoplasia intraepitelial conjuntival',
						'Amiloidosis',
						'Nevus conjuntival',
						'Melanosis primaria adquirida',
						'Melanoma conjuntival',
						'Melanoma de iris',
						'Melanoma de cuerpo ciliar',
						'Ptosis',
						'Chalazión',
						'Orzuelo',
						'Ectropión',
						'Entropión',
						'Triquiasis',
						'Síndrome del parpado flácido',
						'Blefarospasmo',
						'Canaliculitis',
						'Dacriocistitis',
						'Celulitis preseptal',
						'Queratosis seborreica',
						'Queratoacantoma',
						'Xantelasma',
						'Papiloma escamoso',
						'Queratosis actínica',
						'Carcinoma',
						'Traumatismo orbitario',
						'Dacrioadenitis crónica',
						'Pseudotumor inflamatorio idiopático',
						'Enfermedad inflamatoria orbitaria inespecífica',
						'Absceso subperióstico',
						'Quiste dermoide',
						'Hemangioma capilar',
						'Rabdomiosarcoma orbitario',
						'Neuroblastoma metastasico orbitario',
						'Linfangioma',
						'Glioma del nervio óptico',
						'Neurofibroma plexiforme',
						'Teratoma orbitario',
						'Metástasis orbitaria',
						'Hemangioma cavernoso',
						'Histiocitoma fibroso',
						'Hemangiopericitoma',
						'Neurofibroma',
						'Mucocele',
						'Meningioma del nervio óptico',
						'Leucocoria',
						'Retinopatía del prematuro',
						'Vitreorretinopatía exudativa familiar',
						'Esodesviaciones',
						'Exodesviaciones',
						'Estrabismo',
						'Ambliopía',
						'Catarata congénita',
						'Obstrucción congénita del conducto nasolagrimal',
						'Glaucoma congénito',
						'Ptosis congénita',
						'Glaucoma primario de ángulo abierto',
						'Glaucoma primario de ángulo abierto de presión baja',
						'Hipertensión ocular',
						'Glaucoma agudo de ángulo estrecho',
						'Glaucoma crónico de ángulo cerrado',
						'Glaucoma por recesión angular',
						'Glaucoma inflamatorio de ángulo abierto',
						'Síndrome de Posner-Schlossman',
						'Glaucoma inducido por corticoides',
						'Síndrome de dispersión pigmentaria',
						'Síndrome pseudoexfoliativo',
						'Glaucoma facogénico',
						'Iris plateau',
						'Glaucoma neovascular',
						'Síndrome endotelial iridocorneal',
						'Glaucoma postoperatorio',
						'Glaucoma maligno',
						'Blebitis',
						'Anisocoria',
						'Síndrome de Horner',
						'Pupila de Argyll Robertson',
						'Pupila de Adie',
						'Parálisis aislada del tercer par',
						'Parálisis aislada del cuarto par',
						'Parálisis aislada del sexto par',
						'Parálisis aislada del séptimo par',
						'Síndrome del seno cavernoso',
						'Miastenia grave',
						'Optalmoplejía externa progresiva crónica',
						'Oftalmoplejia internuclear',
						'Neuritis óptica',
						'Papiledema',
						'Pseudotumor cerebral',
						'Neuropatía óptica isquémica arterítica',
						'Neuropatía óptica isquémica no arterítica',
						'Neuropatía óptica isquémica postoperatoria',
						'Nistagmo',
						'Amaurosis fugaz',
						'Insuficiencia de la arteria vertebrobasilar',
						'Ceguera cortical',
						'Cefalea',
						'Migraña',
						'Cefalea en racimos',
						'Desprendimiento de vítreo posterior',
						'Desgarro de retina',
						'Desprendimiento de retina',
						'Retinosquisis',
						'Exudados algodonosos',
						'Oclusión de la arteria central de la retina',
						'Oclusión aterial de rama',
						'Oclusión de la vena central de la retina',
						'Oclusión venosa de rama',
						'Retinopatía hipertensiva',
						'Síndrome isquémico ocular',
						'Retinopatía diabética no proliferativa',
						'Retinopatía diabética pre proliferativa',
						'Retinopatía diabética proliferativa',
						'Hemorragia vítrea',
						'Edema macular',
						'Coriorretiopatía central serosa',
						'Degeneración macular asociada a la edad no exudativa',
						'Degeneración macular asociada a la edad exudativa',
						'Vasculopatía coroidea polipoidea idiopática',
						'Macroaneurisma arterial retiniano',
						'Anemia falciforme',
						'Retinopatía de valsalva',
						'Miopía degenerativa',
						'Estrías angiodes',
						'Histoplasmosis ocular',
						'Agujero macular',
						'Membrana epirretiniana',
						'Derrame coroideo',
						'Desprendimiento coroideo',
						'Retinitis pigmentaria',
						'Enfermedad de Best',
						'Enfermedad Stargardt',
						'Distrofia de conos',
						'Toxicidad por cloroquina/hidroxicloroquina',
						'Retinopatía del cristalino',
						'Roseta óptica',
						'Nevus coroideo',
						'Melanoma de coroides',
						'Uveítis anterior',
						'Uveítis intermedia',
						'Uveítis posterior',
						'Uveítis HLA-B27',
						'Toxoplasmosis',
						'Sarcoidosis',
						'Enfermedad de Bechçet',
						'Necrosis retiniana aguda',
						'Retinitis por CMV',
						'Retinopatía por HIV',
						'Síndrome de VKH',
						'Sífilis',
						'Endoftalmitis',
						'Endoftalmitis post operatoria',
						'Uveítis postoperatoria crónica',
						'Endoftalmitis traumática',
						'Endoftalmitis bacteriana endógena',
						'Retinitis por Cándida',
						'Uveítis por Cándida',
						'Endoftalmitis por Cándida',
						'Oftalmia simpática',
						'Catarata',
						'Enfermedad de Lyme',
						'Insuficiencia de convergencia',
						'Espasmo de acomodación',
						'Síndrome de Stevens-Johnson',
						'Déficit de vitamina A',
						'Albinismo',
						'Enfermedad de Wilson',
						'Subluxación de cristalino',
						'Luxación de cristalino',
						'Síndrome de hipotonía',
						'Ojo ciego doloroso',
						'Facomatosis',
						'Ptisis bulbi',
						'Emetropía',
						'Hipermetropía',
						'Miopía',
						'Presbicia',
						'Dermatochalasis',
						'Quemosis'
	                ],
	                textext = $(e.target).textext()[0],
	                query = (data ? data.query : '') || ''
	                ;

		            $(this).trigger(
		                'setSuggestions',
		                { result : textext.itemManager().filter(list, query) }
		            );
	       		});
							
				$('#form_registro').submit(function( event ) {
					//event.preventDefault();

					var txt = "";

					if ( ($('#od_cil_arm_sd').val() != "") && ($('#od_eje_arm_sd').val() == "") )
						txt += "Falta completar eje para cilindro OD en ARM Sin Dilatación\n";

					if ( ($('#os_cil_arm_sd').val() != "") && ($('#os_eje_arm_sd').val() == "") )
						txt += "Falta completar eje para cilindro OS en ARM Sin Dilatación\n";

					if ( ($('#od_cil_arm_cd').val() != "") && ($('#od_eje_arm_cd').val() == "") )
						txt += "Falta completar eje para cilindro OD en ARM Con Dilatación\n";

					if ( ($('#os_cil_arm_cd').val() != "") && ($('#os_eje_arm_cd').val() == "") )
						txt += "Falta completar eje para cilindro OS en ARM Con Dilatación\n";

					if ( ($('#od_k1_krt').val() != "") && ($('#od_k1_eje_krt').val() == "") )
						txt += "Falta completar eje para cilindro OD en KRT\n";

					if ( ($('#os_k1_krt').val() != "") && ($('#os_k1_eje_krt').val() == "") )
						txt += "Falta completar eje para cilindro OS en KRT\n";

					if ( ($('#od_cil_cc_lejos').val() != "") && ($('#od_eje_cc_lejos').val() == "") )
						txt += "Falta completar eje para cilindro OD en A.V. Con Corrección para Lejos\n";

					if ( ($('#os_cil_cc_lejos').val() != "") && ($('#os_eje_cc_lejos').val() == "") )
						txt += "Falta completar eje para cilindro OS en A.V. Con Corrección para Lejos\n";

					if ( ($('#od_cil_cc_cerca').val() != "") && ($('#od_eje_cc_cerca').val() == "") )
						txt += "Falta completar eje para cilindro OD en A.V. Con Corrección para Cerca\n";

					if ( ($('#os_cil_cc_cerca').val() != "") && ($('#os_eje_cc_cerca').val() == "") )
						txt += "Falta completar eje para cilindro OS en A.V. Con Corrección para Cerca\n";

					if ( ($('#od_cil_subj_lejos').val() != "") && ($('#od_eje_subj_lejos').val() == "") )
						txt += "Falta completar eje para cilindro OD en A.V. Con Corrección Subj para Lejos\n";

					if ( ($('#os_cil_subj_lejos').val() != "") && ($('#os_eje_subj_lejos').val() == "") )
						txt += "Falta completar eje para cilindro OS en A.V. Con Corrección Subj para Lejos\n";

					if ( ($('#od_cil_subj_cerca').val() != "") && ($('#od_eje_subj_cerca').val() == "") )
						txt += "Falta completar eje para cilindro OD en A.V. Con Corrección Subj para Cerca\n";

					if ( ($('#os_cil_subj_cerca').val() != "") && ($('#os_eje_subj_cerca').val() == "") )
						txt += "Falta completar eje para cilindro OS en A.V. Con Corrección Subj para Cerca\n";

					if ( ($('#od_cil_subj_media').val() != "") && ($('#od_eje_subj_media').val() == "") )
						txt += "Falta completar eje para cilindro OD en A.V. Con Corrección Subj para Media\n";

					if ( ($('#os_cil_subj_media').val() != "") && ($('#os_eje_subj_media').val() == "") )
						txt += "Falta completar eje para cilindro OS en A.V. Con Corrección Subj para Media\n";

					if (txt != "") {
						alert(txt);
						event.preventDefault();
					}	
					//$('#ladder-meters').removeAttr('required');
  					
				});

			});
			
		</script>
	</head>
	<body>
		<?php $json = json_decode($borrador_registro) ?>
		<form id = "form_registro" method = "post" target = "_parent">
			<div>
				<h3 style = "margin-left:10px"> Motivo de consulta: </h3> <textarea id = "motivo" style ="font-size:12pt;width:620px;height:100px;margin-right:20px;margin-top:20px;float:right" name = "motivo" required><?php echo (isset($json->motivo)) ? $json->motivo:""; ?></textarea>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Refractometría
				</div>
				<div class = "panel_izq">
					<div style = "float:left">
						<table class ="tabla_ref">
		  					<tr>
		  						<th style = "border:none"></th>
		    					<th colspan = "3">ARM Sin Dilatación</th> 
		  					</tr>
		  					<tr>
		  						<td></td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Esf.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Cil.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Eje</td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OD </td>
		    					<td><input name = "od_esf_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_esf_arm_sd)) ? $json->od_esf_arm_sd:""; ?>"/></td>
		    					<td><input name = "od_cil_arm_sd" id = "od_cil_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_cil_arm_sd)) ? $json->od_cil_arm_sd:""; ?>"/></td>
		    					<td><input name = "od_eje_arm_sd" id = "od_eje_arm_sd" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_arm_sd)) ? $json->od_eje_arm_sd:""; ?>"/></td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OS </td>
		    					<td><input name = "os_esf_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_esf_arm_sd)) ? $json->os_esf_arm_sd:""; ?>"/></td>
		    					<td><input name = "os_cil_arm_sd" id = "os_cil_arm_sd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_cil_arm_sd)) ? $json->os_cil_arm_sd:""; ?>"/></td>
		    					<td><input name = "os_eje_arm_sd" id = "os_eje_arm_sd" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_arm_sd)) ? $json->os_eje_arm_sd:""; ?>"/></td>
		  					</tr>
						</table>
					</div>
					<div style ="float:left">
						<div style = "margin-top: 60px; margin-left:10px;font-family: Oswald">
							<?php 
								$status = "";
								if (isset($json->od_chk_arm_sd)) {
									if ($json->od_chk_arm_sd != "")
										$status = "checked";
							}?>
							<input name = "od_chk_arm_sd" type = "checkbox" <?php echo $status ?>/> No medido
						</div>
						<div style = "margin-top: 5px; margin-left:10px;font-family: Oswald">
							<?php 
								$status = "";
								if (isset($json->os_chk_arm_sd)) {
									if ($json->os_chk_arm_sd != "")
										$status = "checked";
							}?>
							<input name = "os_chk_arm_sd" type = "checkbox" <?php echo $status ?>/> No medido
						</div>	
					</div>	
				</div>
				<div class = "panel_der">
					<div style = "float:left">
						<table class ="tabla_ref">
		  					<tr>
		  						<th style = "border:none"></th>
		    					<th colspan = "3">ARM Con Dilatación</th> 
		  					</tr>
		  					<tr>
		  						<td></td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Esf.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Cil.</td>
		    					<td style ="background-color:#4289b8;color:white;border:2px solid #F7F7F7;text-align:center">Eje</td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OD </td>
		    					<td><input name = "od_esf_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_esf_arm_cd)) ? $json->od_esf_arm_cd:""; ?>"/></td>
		    					<td><input name = "od_cil_arm_cd" id = "od_cil_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_cil_arm_cd)) ? $json->od_cil_arm_cd:""; ?>"/></td>
		    					<td><input name = "od_eje_arm_cd" id = "od_eje_arm_cd" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_arm_cd)) ? $json->od_eje_arm_cd:""; ?>"/></td>
		  					</tr>
		  					<tr>
		  						<td style = "width:40px;text-align:left;border:none"> OS </td>
		    					<td><input name = "os_esf_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_esf_arm_cd)) ? $json->os_esf_arm_cd:""; ?>"/></td>
		    					<td><input name = "os_cil_arm_cd" id = "os_cil_arm_cd" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_cil_arm_cd)) ? $json->os_cil_arm_cd:""; ?>"/></td>
		    					<td><input name = "os_eje_arm_cd" id = "os_eje_arm_cd" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_arm_cd)) ? $json->os_eje_arm_cd:""; ?>"/></td>
		  					</tr>
						</table>
					</div>
					<div style ="float:left">
						<div style = "margin-top: 60px; margin-left:10px;font-family: Oswald">
							<?php 
								$status = "";
								if (isset($json->od_chk_arm_cd)) {
									if ($json->od_chk_arm_cd != "")
										$status = "checked";
							}?>
							<input name = "od_chk_arm_cd" type = "checkbox" <?php echo $status ?>/> No medido
						</div>
						<div style = "margin-top: 5px; margin-left:10px;font-family: Oswald">
							<?php 
								$status = "";
								if (isset($json->os_chk_arm_cd)) {
									if ($json->os_chk_arm_cd != "")
										$status = "checked";
							}?>
							<input name = "os_chk_arm_cd" type = "checkbox" <?php echo $status ?>/> No medido
						</div>	
					</div>			
				</div>
				<div class = "panel_izq" style = "margin-left:62px">
					<div style = "float:left">
						<table class = "tabla_ref" style ="width:190px">
		  					<tr>
		    					<th colspan = "4">KRT OD</th> 
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K1</td>
		    					<td><input name = "od_k1_krt" id = "od_k1_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_k1_krt)) ? $json->od_k1_krt:""; ?>"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "od_k1_eje_krt" id = "od_k1_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_k1_eje_krt)) ? $json->od_k1_eje_krt:""; ?>"/></td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K2</td>
		    					<td><input name = "od_k2_krt" id = "od_k2_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_k2_krt)) ? $json->od_k2_krt:""; ?>"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "od_k2_eje_krt" id = "od_k2_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_k2_eje_krt)) ? $json->od_k2_eje_krt:""; ?>"/></td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">Ave.</td>
		    					<td><input id = "od_ave_krt" name = "od_ave_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_ave_krt)) ? $json->od_ave_krt:""; ?>"/></td>
		  					</tr>
						</table>
					</div>
					<div style = "float:left;margin-top: 90px; margin-left:10px;font-family: Oswald">
							<?php 
								$status = "";
								if (isset($json->od_chk_krt)) {
									if ($json->od_chk_krt != "")
										$status = "checked";
							}?>
						<input name = "od_chk_krt" type = "checkbox" <?php echo $status ?>/> No medido
					</div>		
				</div>
				<div class = "panel_der">
					<div style = "float:left">
						<table class = "tabla_ref" style ="width:190px">
		  					<tr>
		    					<th colspan = "4">KRT OS</th> 
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K1</td>
		    					<td><input name = "os_k1_krt" id = "os_k1_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_k1_krt)) ? $json->os_k1_krt:""; ?>"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "os_k1_eje_krt" id = "os_k1_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_k1_krt)) ? $json->os_eje_k1_krt:""; ?>"/></td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">K2</td>
		    					<td><input name = "os_k2_krt" id = "os_k2_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_k2_krt)) ? $json->os_k2_krt:""; ?>"/></td>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7;width:50%">Eje</td>
		    					<td><input name = "os_k2_eje_krt" id = "os_k2_eje_krt" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_k2_krt)) ? $json->od_eje_k2_krt:""; ?>"</td>
		  					</tr>
		  					<tr>
		    					<td style = "background-color:#4289b8;color:white;border:2px solid #F7F7F7">Ave.</td>
		    					<td><input id = "os_ave_krt" name = "os_ave_krt" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_ave_krt)) ? $json->os_ave_krt:""; ?>"/></td>
		  					</tr>
						</table>
					</div>
					<div style = "float:left;margin-top: 90px; margin-left:10px;font-family: Oswald">
							<?php 
								$status = "";
								if (isset($json->os_chk_krt)) {
									if ($json->os_chk_krt != "")
										$status = "checked";
							}?>
						<input name = "os_chk_krt" type = "checkbox" <?php echo $status ?>/> No medido
					</div>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Agudeza Visual
				</div>
				<div id = "labe" style = "float:left;height:120px;width:25px;background-color:#97d9c1">
					<p style ="width: 150px;transform: rotate(-90deg);margin-left: -65px;margin-top: 50px;text-align: center;font-family:Oswald;font-weight:bold;color:white;font-size:14pt"/>Sin Corrección</p>
				</div>
				<div style ="height:120px;margin-bottom:2px">
					<?php
						$list_lejos = array("10/10","9/10","8/10","7/10","6/10","5/10","4/10","3/10","2/10","1/10","CD1","VB","BPL","MPL","AMAU");
						$list_cerca = array("2.00","1.75","1.50","1.25","1.00","0.75","0.50","0.25");
					?>
					<div class = "panel_izq">
						<table class = "av_tabla">
		  					<tr>
		    					<td style = "width:40px">Lejos:</td>
		    					<td style = "width:30px">OD</td>
		    					<td>
		    						<select name = "od_select_sc_lejos">
		    							<option></option>
		    							<?php
		    								foreach ($list_lejos as $value) {
		    									if (isset($json->od_select_sc_lejos))
		    										if ($value == $json->od_select_sc_lejos)
		    											echo "<option selected = 'selected'>".$value."</option>";
		    										else
		    											echo "<option>".$value."</option>";
		    									else
		    										echo "<option>".$value."</option>";	
		    								}
		    							?>
		    						</select>
		    					</td>
		  					</tr>
		  					<tr>
		  						<td  style = "border:none"></td>
		  						<td>OS</td>
		    					<td>
		    						<select name = "os_select_sc_lejos">
		    							<option></option>
		    							<?php 
		    								foreach ($list_lejos as $value) {
		    									if (isset($json->os_select_sc_lejos))
		    										if ($value == $json->os_select_sc_lejos)
		    											echo "<option selected = 'selected'>".$value."</option>";
		    										else
		    											echo "<option>".$value."</option>";
		    									else
		    										echo "<option>".$value."</option>";	
		    								}
		    							?>
		    						</select>
		    					</td>
		  					</tr>
						</table>
					</div>
					<div class = "panel_der">
						<table class = "av_tabla">
		  					<tr>
		    					<td style = "width:40px">Cerca:</td>
		    					<td style = "width:30px">OD</td>
		    					<td>
		    						<select name = "od_select_sc_cerca">
		    							<option></option>
		    							<?php /*
		    								$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
		    								foreach ($list_cerca as $value) {
		    									if (isset($json->od_select_sc_cerca))
		    										if ($value == $json->od_select_sc_cerca)
		    											echo "<option selected = 'selected'>".$value."</option>";
		    										else
		    											echo "<option>".$value."</option>";
		    									else
		    										echo "<option>".$value."</option>";	
		    								}
		    							?>
		    						</select>
		    					</td>
		  					</tr>
		  					<tr>
		  						<td  style = "border:none"></td>
		  						<td>OS</td>
		    					<td>
		    						<select name = "os_select_sc_cerca">
		    							<option></option>
		    							<?php /*
		    								$list_cerca = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
		    								foreach ($list_cerca as $value) {
		    									if (isset($json->os_select_sc_cerca))
		    										if ($value == $json->os_select_sc_cerca)
		    											echo "<option selected = 'selected'>".$value."</option>";
		    										else
		    											echo "<option>".$value."</option>";
		    									else
		    										echo "<option>".$value."</option>";	
		    								}
		    							?>
		    						</select>
		    					</td>
		  					</tr>
						</table>
					</div>
				</div>
				<div id = "label" style = "float:left;height: 140px;width:25px;background-color:#97d0d9">
					<p style ="width: 150px;transform: rotate(-90deg);margin-left: -65px;margin-top: 60px;text-align: center;font-family:Oswald;font-weight:bold;color:white;font-size:14pt"/>Corrección Paciente</p>
				</div>
				<div style ="height:140px;margin-bottom:2px">	
					<div class = "panel_izq">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:40px">Lejos:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_cc_lejos">
			    							<option></option>
											<?php /*
		    									$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_lejos as $value) {
			    									if (isset($json->od_select_cc_lejos))
			    										if ($value == $json->od_select_cc_lejos)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
			    							?>			    							
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_cc_lejos">
			    							<option></option>
			    							<?php /*
		    									$list_lejos = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_lejos as $value) {
			    									if (isset($json->os_select_cc_lejos))
			    										if ($value == $json->os_select_cc_lejos)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>		
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style = "float:left">
							<table class = "con_correc">
			  					<tr style ="background-color: #97d0d9">
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_esf_cc_lejos)) ? $json->od_esf_cc_lejos:""; ?>"/></td>
			    					<td><input name = "od_cil_cc_lejos" id = "od_cil_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_cil_cc_lejos)) ? $json->od_cil_cc_lejos:""; ?>"/></td>
			    					<td><input name = "od_eje_cc_lejos" id = "od_eje_cc_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_cc_lejos)) ? $json->od_eje_cc_lejos:""; ?>"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_esf_cc_lejos)) ? $json->os_esf_cc_lejos:""; ?>"/></td>
			    					<td><input name = "os_cil_cc_lejos" id = "os_cil_cc_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_cil_cc_lejos)) ? $json->od_cil_cc_lejos:""; ?>"/></td>
			    					<td><input name = "os_eje_cc_lejos" id = "os_eje_cc_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_cc_lejos)) ? $json->os_eje_cc_lejos:""; ?>"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
					<div class = "panel_der">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:40px">Cerca:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_cc_cerca">
			    							<option></option>
			    							<?php /*
		    									$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_cerca as $value) {
			    									if (isset($json->od_select_cc_cerca))
			    										if ($value == $json->od_select_cc_cerca)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>	
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_cc_cerca">
			    							<option></option>
			    							<?php /*
		    									$list_cerca = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_cerca as $value) {
			    									if (isset($json->os_select_cc_cerca))
			    										if ($value == $json->os_select_cc_cerca)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>	
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style ="float:left">
							<table class = "con_correc">
			  					<tr style ="background-color: #97d0d9">
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border:2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_esf_cc_cerca)) ? $json->od_esf_cc_cerca:""; ?>"/></td>
			    					<td><input name = "od_cil_cc_cerca" id = "od_cil_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_cil_cc_cerca)) ? $json->od_cil_cc_cerca:""; ?>"/></td>
			    					<td><input name = "od_eje_cc_cerca" id = "od_eje_cc_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_cc_cerca)) ? $json->od_eje_cc_cerca:""; ?>"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_esf_cc_cerca)) ? $json->os_esf_cc_cerca:""; ?>"/></td>
			    					<td><input name = "os_cil_cc_cerca" id = "os_cil_cc_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_cil_cc_cerca)) ? $json->os_cil_cc_cerca:""; ?>"/></td>
			    					<td><input name = "os_eje_cc_cerca" id = "os_eje_cc_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_cc_cerca)) ? $json->os_eje_cc_cerca:""; ?>"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
				</div>
				<div id = "label" style = "float:left;height: 250px;width:25px;background-color:#97afd9">
					<p style ="transform: rotate(-90deg);margin-left: -4px;margin-top: 140px;text-align: center;font-family:Oswald;font-weight:bold;color:white;font-size:14pt"/>Subjetiva</p>
				</div>
				<div style="height:250px;">
					<div class = "panel_izq">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:40px">Lejos:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_subj_lejos">
			    							<option></option>
			    							<?php /*
		    									$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_lejos as $value) {
			    									if (isset($json->od_select_subj_lejos))
			    										if ($value == $json->od_select_subj_lejos)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>	
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_subj_lejos">
			    							<option></option>
			    							<?php /*
		    									$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_lejos as $value) {
			    									if (isset($json->os_select_subj_lejos))
			    										if ($value == $json->os_select_subj_lejos)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>	
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style = "float:left">
							<table class = "subjetiva">
			  					<tr style ="background-color: #97afd9">
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_subj_lejos" id = "od_esf_subj_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_esf_subj_lejos)) ? $json->od_esf_subj_lejos:""; ?>"/></td>
			    					<td><input name = "od_cil_subj_lejos" id = "od_cil_subj_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_cil_subj_lejos)) ? $json->od_cil_subj_lejos:""; ?>"/></td>
			    					<td><input name = "od_eje_subj_lejos" id = "od_eje_subj_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_subj_lejos)) ? $json->od_eje_subj_lejos:""; ?>"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_subj_lejos" id = "os_esf_subj_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_esf_subj_lejos)) ? $json->os_esf_subj_lejos:""; ?>"/></td>
			    					<td><input name = "os_cil_subj_lejos" id = "os_cil_subj_lejos" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_cil_subj_lejos)) ? $json->os_cil_subj_lejos:""; ?>"/></td>
			    					<td><input name = "os_eje_subj_lejos" id = "os_eje_subj_lejos" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_subj_lejos)) ? $json->os_eje_subj_lejos:""; ?>"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
					<div class = "panel_der" style = "width:45%">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<table class = "av_tabla">
			  					<tr>
			  						<td  style = "border:none"></td>
			    					<td style = "width:40px">Cerca:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_subj_cerca">
			    							<option></option>
			    							<?php /*
		    									$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_cerca as $value) {
			    									if (isset($json->od_select_subj_cerca))
			    										if ($value == $json->od_select_subj_cerca)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>	
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td></td>
			  						<td></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_subj_cerca">
			    							<option></option>
			    							<?php /*
		    									$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_cerca as $value) {
			    									if (isset($json->os_select_subj_cerca))
			    										if ($value == $json->os_select_subj_cerca)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td></td>
			  						<td></td>
			  						<td>Add:</td>
			  						<td><input id = "adding" style ="border:3px solid #e0a8bc" pattern ="[0-9-]+.[0-9]{2}"title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off"/></td>
			  					</tr>	
							</table>
						</div>
						<div style ="float:left">
							<table class = "subjetiva">
			  					<tr style ="background-color: #97afd9">
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_subj_cerca" id = "od_esf_subj_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_esf_subj_cerca)) ? $json->od_esf_subj_cerca:""; ?>"/></td>
			    					<td><input name = "od_cil_subj_cerca" id = "od_cil_subj_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_cil_subj_cerca)) ? $json->od_cil_subj_cerca:""; ?>"/></td>
			    					<td><input name = "od_eje_subj_cerca" id = "od_eje_subj_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_subj_cerca)) ? $json->od_eje_subj_cerca:""; ?>"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_subj_cerca" id = "os_esf_subj_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_esf_subj_cerca)) ? $json->os_esf_subj_cerca:""; ?>"/></td>
			    					<td><input name = "os_cil_subj_cerca" id = "os_cil_subj_cerca" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_eje_subj_cerca)) ? $json->os_eje_subj_cerca:""; ?>"/></td>
			    					<td><input name = "os_eje_subj_cerca" id = "os_eje_subj_cerca" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_subj_cerca)) ? $json->os_eje_subj_cerca:""; ?>"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
					<div class = "panel_izq">
						<h3 style = "margin-right:10px;">Observaciones:</h3> <textarea name = "obs_subj" style = "margin-top:25px;width:60%;height:65px;font-size:12pt"><?php echo (isset($json->obs_subj)) ? $json->obs_subj:""; ?></textarea>
					</div>	
					<div class = "panel_der">
						<div style = "float:left;margin-top:25px;margin-right:10px">
							<?php
								$list_media = array("10/10","9/10","8/10","7/10","6/10","5/10","4/10","3/10","2/10","1/10");
							?>
							<table class = "av_tabla">
			  					<tr>
			    					<td style = "width:40px">Media:</td>
			    					<td style = "width:30px">OD</td>
			    					<td>
			    						<select name = "od_select_subj_media">
			    							<option></option>
			    							<?php 
		    									//$list = array("10/10","9/10","8/10","7/10","6/10","5/10","4/10","3/10","2/10","1/10");
			    								foreach ($list_media as $value) {
			    									if (isset($json->od_select_subj_media))
			    										if ($value == $json->od_select_subj_media)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>	
			    						</select>
			    					</td>
			  					</tr>
			  					<tr>
			  						<td  style = "border:none"></td>
			  						<td>OS</td>
			    					<td>
			    						<select name = "os_select_subj_media">
			    							<option></option>
			    							<?php /*
		    									$list = array(
		    												"1/10",
		    												"2/10",
		    												"3/10",
		    												"4/10",
		    												"5/10",
		    												"6/10",
		    												"7/10",
		    												"8/10",
		    												"9/10",
		    												"10/10",
		    											 );*/
			    								foreach ($list_media as $value) {
			    									if (isset($json->os_select_subj_media))
			    										if ($value == $json->os_select_subj_media)
			    											echo "<option selected = 'selected'>".$value."</option>";
			    										else
			    											echo "<option>".$value."</option>";
			    									else
			    										echo "<option>".$value."</option>";	
			    								}
		    								?>	
			    						</select>
			    					</td>
			  					</tr>
							</table>
						</div>
						<div style ="float:left">
							<table class = "subjetiva">
			  					<tr style ="background-color: #97afd9">
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Esf.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Cil.</td>
			    					<td style ="border: 2px solid #F7F7F7; text-align:center;color:white">Eje</td>
			  					</tr>
			  					<tr>
			    					<td><input name = "od_esf_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_esf_subj_media)) ? $json->od_esf_subj_media:""; ?>"/></td>
			    					<td><input name = "od_cil_subj_media" id = "od_cil_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->od_cil_subj_media)) ? $json->od_cil_subj_media:""; ?>"/></td>
			    					<td><input name = "od_eje_subj_media" id = "od_eje_subj_media" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->od_eje_subj_media)) ? $json->od_eje_subj_media:""; ?>"/></td>
			  					</tr>
			  					<tr>
			    					<td><input name = "os_esf_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_esf_subj_media)) ? $json->os_esf_subj_media:""; ?>"/></td>
			    					<td><input name = "os_cil_subj_media" id = "os_cil_subj_media" pattern ="[0-9-]+.[0-9]{2}" title="Se requiere un numero de hasta dos digitos con dos decimales. Ej: 2.00 o -2.00" autocomplete = "off" value = "<?php echo (isset($json->os_cil_subj_media)) ? $json->os_cil_subj_media:""; ?>"/></td>
			    					<td><input name = "os_eje_subj_media" id = "os_eje_subj_media" pattern ="[0-9-]{1,3}" title="Se requiere un numero entre 0 - 180. Ej: 100" autocomplete = "off" value = "<?php echo (isset($json->os_eje_subj_media)) ? $json->os_eje_subj_media:""; ?>"/></td>
			  					</tr>
							</table>
						</div>	
					</div>
				</div>			
			</div>
			<div class = "separador">
				<div class = "titulo" style ="margin-top:-25px">
					Presión Intraocular
				</div>
				<div class = "panel_izq" style ="margin-left:20px">
					<table>
	  					<tr>
	    					<td style = "border:none;width: 30px;">OD</td>
	    					<td style = "border:none;border-bottom:1px solid"><input name = "od_presion" pattern ="[0-9.]{1,}" autocomplete = "off" value = "<?php echo (isset($json->od_presion)) ? $json->od_presion:""; ?>"/></td>
	  					</tr>
					</table>
				</div>
				<div class ="panel_der">
					<table>
	  					<tr>
	    					<td style = "border:none;width: 30px;">OS</td>
	    					<td style = "border:none;border-bottom:1px solid"><input name = "os_presion"pattern ="[0-9.]{1,}" autocomplete = "off" value = "<?php echo (isset($json->os_presion)) ? $json->os_presion:""; ?>"/></td>
	  					</tr>
					</table>
				</div>
				<div class = "panel_izq" style = "width:100%">
					<h3 style = "margin-right:10px">Observaciones:</h3> <textarea name = "obs_presion" style = "margin-top:25px;width:76%;height:100px;font-size:12pt"><?php echo (isset($json->obs_presion)) ? $json->obs_presion:""; ?></textarea>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Biomicroscopía
				</div>
				<div class = "panel_izq" style= "margin-left:20px">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OD</td>
	    					<td style = "border:none"><textarea name = "od_bio" style = "margin-top:25px;height:100px;width:90%;font-size:12pt"><?php echo (isset($json->od_bio)) ? $json->od_bio:""; ?></textarea></td>
	  					</tr>
					</table>
				</div>
				<div class ="panel_der">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OS</td>
	    					<td style = "border:none"><textarea name = "os_bio" style = "margin-top:25px;height:100px;width:90%;font-size:12pt"><?php echo (isset($json->os_bio)) ? $json->os_bio:""; ?></textarea></td>
	  					</tr>
					</table>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Fondo de Ojos
				</div>
				<div class = "panel_izq" style ="margin-left:20px">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OD</td>
	    					<td style = "border:none"><textarea name = "od_fo" style = "margin-top:25px;height:100px;width:90%;font-size:12pt"><?php echo (isset($json->od_fo)) ? $json->od_fo:""; ?></textarea></td>
	  					</tr>
					</table>
				</div>
				<div class ="panel_der">
					<table class="tabla_esp">
	  					<tr>
	    					<td style = "border:none;width: 30px;">OS</td>
	    					<td style = "border:none"><textarea name = "os_fo" style = "margin-top:25px;height:100px;width:90%;font-size:12pt"><?php echo (isset($json->os_fo)) ? $json->os_fo:""; ?></textarea></td>
	  					</tr>
					</table>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Diagnóstico
				</div>
				<div style ="margin-left:20px;padding-top:10px">
	    			<textarea id = "txt_diag" name = "txt_diag" class = "example" style = "width: 700px;height:100px" rows = "1"></textarea>
				</div>
				<input type="hidden" id="varDiag" value="<?php echo (isset(json_decode($borrador_registro)->txt_diag)) ? json_decode($borrador_registro)->txt_diag:"";?>">
			</div>
			<div class = "separador">
				<div class = "titulo">
					Solicitud de Estudios/Análisis
				</div>
				<div class ="panel_izq" style ="margin-left:20px">
					<table class = "solicitud_tabla">
						<tr>
							<td>
								<input name = "chk_sol[]" value = "CVC" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("CVC", $json->chk_sol)) { echo "checked";} }?>/> CVC 			
							</td>
							<td>
								<input name = "chk_sol[]" value = "IOL" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("IOL", $json->chk_sol)) { echo "checked";} }?>/> IOL 			
							</td>
							<td>
								<input name = "chk_sol[]" value = "OCT" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("OCT", $json->chk_sol)) { echo "checked";} }?>/> OCT			
							</td>
						</tr>
						<tr>
							<td>
								<input name = "chk_sol[]" value = "ME" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("ME", $json->chk_sol)) { echo "checked";} }?>/> ME			
							</td>
							<td>
								<input name = "chk_sol[]" value = "RFG" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("RFG", $json->chk_sol)) { echo "checked";} }?>/> RFG 			
							</td>
							<td>
								<input name = "chk_sol[]" value = "RFG Color" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("RFG Color", $json->chk_sol)) { echo "checked";} }?>/> RFG Color 			
							</td>
						</tr>
						<tr>
							<td>
								<input name = "chk_sol[]" value = "HRT" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("HRT", $json->chk_sol)) { echo "checked";} }?>/> HRT			
							</td>
							<td>
								<input name = "chk_sol[]" value = "OBI" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("OBI", $json->chk_sol)) { echo "checked";} }?>/> OBI			
							</td>
							<td>
								<input name = "chk_sol[]" value = "PAQUI" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("PAQUI", $json->chk_sol)) { echo "checked";} }?>/> PAQUI 			
							</td>
						</tr>
						<tr>	
							<td>
								<input name = "chk_sol[]" value = "Laser" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("Laser", $json->chk_sol)) { echo "checked";} }?>/> Laser			
							</td>
							<td>
								<input name = "chk_sol[]" value = "YAG" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("YAG", $json->chk_sol)) { echo "checked";} }?>/> YAG
							</td>
							<td>
								<input name = "chk_sol[]" value = "TOPO" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("TOPO", $json->chk_sol)) { echo "checked";} }?>/> TOPO
							</td>
						</tr>
						<tr>
							<td>
								<input name = "chk_sol[]" value = "Ecografía" type = "checkbox" <?php if (isset($json->chk_sol)) { if (in_array("Ecografía", $json->chk_sol)) { echo "checked";} }?>/> Ecografía
							</td>
						</tr>	
					</table>
				</div>
				<div class ="panel_der">
					<h3 style = "margin-right:10px">Otros:</h3>
	    			<textarea name = "obs_sol" style = "margin-top:25px;height:100px;width:75%;font-size:12pt"><?php echo (isset($json->obs_sol)) ? $json->obs_sol:""; ?></textarea>
				</div>	
			</div>
			<div class = "separador">
				<div class = "titulo">
					Indicaciones
				</div>
				<div style ="margin-left:20px">
	    			<textarea name = "txt_indic" style = "margin-top:25px;width:92%;height:100px;font-size:12pt"><?php echo (isset($json->txt_indic)) ? $json->txt_indic:""; ?></textarea>
	    			<?php echo '<a class = "boton" style = "float:right" target= "_blank" href= "'.base_url("index.php/main/coordinacion/".$paciente).'">Coordinación Quirúrgica</a>'?>
				</div>
			</div>
			<div class = "separador">
				<div class = "titulo">
					Observaciones
				</div>
				<div style ="margin-left:20px">
	    			<textarea name = "txt_obs" style = "margin-top:25px;width:92%;height:100px;font-size:12pt"><?php echo (isset($json->txt_obs)) ? $json->txt_obs:""; ?></textarea>
				</div>
			</div>
			<input type="hidden" name="paciente" value = <?php echo $paciente ?> />
			<div class = "separador" style = "margin-bottom:0px">
				<!--<button id = "reg_guardar" style = "background-image: url(<?php echo base_url('css/images/guardar.png')?>)" class = "myboton" type="submit" title = "Guardar Registro" onclick ="return enviar_reg('reg_guardar')"></button>
				<button id = "reg_borrador" style = "background-image: url(<?php echo base_url('css/images/guardar_borrador.png')?>);margin-right:20px" class = "myboton" type="submit" type="submit" title = "Guardar Borrador" onclick ="return enviar_reg('reg_borrador')"></button>
				<button id = "reg_eliminar" style = "background-image: url(<?php echo base_url('css/images/eliminar_borrador.png')?>)" class = "myboton" type="submit" title = "Eliminar Borrador" onclick ="return enviar_reg('reg_eliminar')"></button>-->
				<button id = "reg_guardar" style = "background-image: url(<?php echo base_url('css/images/guardar.png')?>)" class = "myboton" type="submit" title = "Guardar Registro" formaction="<?php echo base_url('/index.php/main/submit_data/registro')?>"></button>
				<button id = "reg_borrador" style = "background-image: url(<?php echo base_url('css/images/guardar_borrador.png')?>);margin-right:20px" class = "myboton" type="submit" type="submit" title = "Guardar Borrador" formaction="<?php echo base_url('index.php/main/guardar_borrador/registro')?>"></button>
				<button id = "reg_eliminar" style = "background-image: url(<?php echo base_url('css/images/eliminar_borrador.png')?>)" class = "myboton" type="submit" title = "Eliminar Borrador" formaction="<?php echo base_url('index.php/main/eliminar_borrador/registro')?>"></button>
				
			</div>
			<!--formaction = "<?php echo base_url('/index.php/main/submit_data/')?>" target = "_parent"-->
			
		</form>	
	</body>	
</html>		