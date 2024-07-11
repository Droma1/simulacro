function validar_inicio(){
    var nombre = $('#Nombre').val();
    var apellido_p = $('#ap_paterno').val();
    var apellido_m = $('#ap_materno').val();
    var doc_tipo = $('#doc_tipo').val();
    var doc = $('#documento').val();
    var carrera = $('#carrera').val();
    var cel = $('#cel').val();
    var nivel = $('#nivel').val();
  
    var flag = 0;
  
    if(nombre == '' || nombre == ' '){
      $('#Nombre').addClass('is-invalid');
    }else{
      $('#Nombre').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }
  
    if(apellido_p == '' || apellido_p == ' '){
      $('#ap_paterno').addClass('is-invalid');
    }else{
      $('#ap_paterno').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }

    if(doc_tipo == 0 || doc_tipo =='' || doc_tipo == null){
      $('#doc_tipo').addClass('is-invalid');
    }else{
      $('#doc_tipo').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }
  
    if(apellido_m == '' || apellido_m == ' '){
      $('#ap_materno').addClass('is-invalid');
    }else{
      $('#ap_materno').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }
  //console.log(doc);
    if((doc.length == 8 && doc_tipo == 'dni') || (doc.length == 9 && doc_tipo == 'carnet')){
      
      $('#documento').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }else{
      $('#documento').addClass('is-invalid');
    }
  
    if(carrera === 0 || carrera == ' ' || carrera == null){
      $('#carrera').addClass('is-invalid');
    }else{
      $('#carrera').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }
  
    if(cel.length !== 9 ){
      $('#cel').addClass('is-invalid');
      //console.log("cel"+cel.length);
    }else{
        //console.log(cel.length);
      $('#cel').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }
    if(nivel === 0 || nivel == ' ' || nivel == null){
      $('#nivel').addClass('is-invalid');
    }else{
      $('#nivel').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }
    //console.log("flag" + flag);
    return flag;
  }

  function validar_provincia(provincia){
    switch (provincia) {
        case 'Manu':
            $('#Ie_seleccion').html(
                '<option value="0">Elije una opción...</option>'+
                '	<option value="50918 JOSE ABELARDO QUIÑONES">	50918 JOSE ABELARDO QUIÑONES	</option>	'+
                '	<option value="52082 HORACIO ZEBALLOS GAMEZ">	52082 HORACIO ZEBALLOS GAMEZ	</option>	'+
                '	<option value="52143">	52143	</option>	'+
                '	<option value="52161 SANTOS KAWAY KOMORI">	52161 SANTOS KAWAY KOMORI	</option>	'+
                '	<option value="52204">	52204	</option>	'+
                '	<option value="ADVENTISTA HUEPETUHE">	ADVENTISTA HUEPETUHE	</option>	'+
                '	<option value="BOCA MANU">	BOCA MANU	</option>	'+
                '	<option value="CHOQUE">	CHOQUE	</option>	'+
                '	<option value="CIENCIAS DE NUEVA">	CIENCIAS DE NUEVA	</option>	'+
                '	<option value="CRISTO SALVADOR III">	CRISTO SALVADOR III	</option>	'+
                '	<option value="DANIEL ALCIDES CARRION">	DANIEL ALCIDES CARRION	</option>	'+
                '	<option value="DIAMANTE">	DIAMANTE	</option>	'+
                '	<option value="JOSE ANTONIO ENCINAS">	JOSE ANTONIO ENCINAS	</option>	'+
                '	<option value="JOSE CARLOS MARIATEGUI">	JOSE CARLOS MARIATEGUI	</option>	'+
                '	<option value="JUAN JOSE LARRAÑETA">	JUAN JOSE LARRAÑETA	</option>	'+
                '	<option value="PADRE JOSE ALVAREZ">	PADRE JOSE ALVAREZ	</option>	'+
                '	<option value="PEDRO PAULET">	PEDRO PAULET	</option>	'+
                '	<option value="PUNKIRI CHICO">	PUNKIRI CHICO	</option>	'+
                '	<option value="RVDO. PADRE PABLO ZAVALA MARTINEZ">	RVDO. PADRE PABLO ZAVALA MARTINEZ	</option>	'+
                '	<option value="VIRGEN MADRE DE DIOS">	VIRGEN MADRE DE DIOS	</option>	'+
                '	<option value="52079 BOCA COLORADO">	52079 BOCA COLORADO	</option>	'+
                '	<option value="52219 VIRGEN DE LA CANDELARIA">	52219 VIRGEN DE LA CANDELARIA	</option>	'+
                '	<option value="52230 SAGRADO CORAZON DE JESUS">	52230 SAGRADO CORAZON DE JESUS	</option>	'+
                '	<option value="OTRO">	OTRO	</option>	'

            );
          break;
        case 'Tahuamanu':
            $('#Ie_seleccion').html(
                '<option value="0">Elije una opción...</option>'+
                '	<option value="DOS DE MAYO">	DOS DE MAYO	</option>	'+
                '	<option value="EL ARCA DE PACAHUARA">	EL ARCA DE PACAHUARA	</option>	'+
                '	<option value="IÑAPARI">	IÑAPARI	</option>	'+
                '	<option value="JESUS DIVINO MAESTRO">	JESUS DIVINO MAESTRO	</option>	'+
                '	<option value="JUAN QUIROZ CHUECA">	JUAN QUIROZ CHUECA	</option>	'+
                '	<option value="NIÑA MARIA">	NIÑA MARIA	</option>	'+
                '	<option value="OLLANTA HUMALA TASSO">	OLLANTA HUMALA TASSO	</option>	'+
                '	<option value="SAN LORENZO">	SAN LORENZO	</option>	'+
                '	<option value="OTRO">	OTRO	</option>	'

            );
        break;
        case 'Tambopata':
          $('#Ie_seleccion').html(
            '<option value="0">Elije una opción...</option>'+
            '	<option value="52001 SANTA ROSA">	52001 SANTA ROSA	</option>	'+
            '	<option value="52008 SANTA CRUZ">	52008 SANTA CRUZ	</option>	'+
            '	<option value="52042">	52042	</option>	'+
            '	<option value="52043">	52043	</option>	'+
            '	<option value="52072 MARIO VARGAS LLOSA">	52072 MARIO VARGAS LLOSA	</option>	'+
            '	<option value="52183 ROMPEOLAS">	52183 ROMPEOLAS	</option>	'+
            '	<option value="52219">	52219	</option>	'+
            '	<option value="52237 JOSE SILVERIO OLAYA BALANDRA">	52237 JOSE SILVERIO OLAYA BALANDRA	</option>	'+
            '	<option value="ALEJANDRO TOLEDO">	ALEJANDRO TOLEDO	</option>	'+
            '	<option value="ALMIRANTE MIGUEL GRAU SEMINARIO">	ALMIRANTE MIGUEL GRAU SEMINARIO	</option>	'+
            '	<option value="ALTO LIBERTAD">	ALTO LIBERTAD	</option>	'+
            '	<option value="APLICACION NUESTRA SEÑORA DEL ROSARIO">	APLICACION NUESTRA SEÑORA DEL ROSARIO	</option>	'+
            '	<option value="AQUILES VELASQUEZ OROS">	AQUILES VELASQUEZ OROS	</option>	'+
            '	<option value="AUGUSTO BOURONCLE ACUÑA">	AUGUSTO BOURONCLE ACUÑA	</option>	'+
            '	<option value="BELEN">	BELEN	</option>	'+
            '	<option value="CAP. ALIPIO PONCE VASQUEZ">	CAP. ALIPIO PONCE VASQUEZ	</option>	'+
            '	<option value="CAP. FAP JOSE ABELARDO QUIÑONES">	CAP. FAP JOSE ABELARDO QUIÑONES	</option>	'+
            '	<option value="CARLOS FERMIN FITZCARRALD">	CARLOS FERMIN FITZCARRALD	</option>	'+
            '	<option value="COAR MADRE DE DIOS">	COAR MADRE DE DIOS	</option>	'+
            '	<option value="CRISTO REY I">	CRISTO REY I	</option>	'+
            '	<option value="CRISTO SALVADOR">	CRISTO SALVADOR	</option>	'+
            '	<option value="DOS DE MAYO">	DOS DE MAYO	</option>	'+
            '	<option value="ENAWIPA">	ENAWIPA	</option>	'+
            '	<option value="ENMANUEL">	ENMANUEL	</option>	'+
            '	<option value="FAUSTINO MALDONADO">	FAUSTINO MALDONADO	</option>	'+
            '	<option value="GUILLERMO BILLINGHURST">	GUILLERMO BILLINGHURST	</option>	'+
            '	<option value="HEROES DE ILLAMPU">	HEROES DE ILLAMPU	</option>	'+
            '	<option value="INDEPENDENCIA">	INDEPENDENCIA	</option>	'+
            '	<option value="JAIME WHITE">	JAIME WHITE	</option>	'+
            '	<option value="JARDIN TROPICAL">	JARDIN TROPICAL	</option>	'+
            '	<option value="JAVIER HERAUD">	JAVIER HERAUD	</option>	'+
            '	<option value="JORGE CHAVEZ RENGIFO">	JORGE CHAVEZ RENGIFO	</option>	'+
            '	<option value="JOSE C.MARIATEGUI">	JOSE C.MARIATEGUI	</option>	'+
            '	<option value="LA PASTORA">	LA PASTORA	</option>	'+
            '	<option value="M.J.M. LOS EMBAJADORES">	M.J.M. LOS EMBAJADORES	</option>	'+
            '	<option value="MARIA MOLINARI REATEGUI">	MARIA MOLINARI REATEGUI	</option>	'+
            '	<option value="MAX UHLE">	MAX UHLE	</option>	'+
            '	<option value="NUESTRA SEÑORA DE LA MERCED">	NUESTRA SEÑORA DE LA MERCED	</option>	'+
            '	<option value="NUESTRA SEÑORA DE LAS MERCEDES">	NUESTRA SEÑORA DE LAS MERCEDES	</option>	'+
            '	<option value="NUEVA AREQUIPA">	NUEVA AREQUIPA	</option>	'+
            '	<option value="PUERTO PARDO">	PUERTO PARDO	</option>	'+
            '	<option value="RAUL VARGAS QUIROZ">	RAUL VARGAS QUIROZ	</option>	'+
            '	<option value="RICARDO PALMA SORIANO">	RICARDO PALMA SORIANO	</option>	'+
            '	<option value="SAN BARTOLOME">	SAN BARTOLOME	</option>	'+
            '	<option value="SAN BERNARDO">	SAN BERNARDO	</option>	'+
            '	<option value="SAN ISIDRO">	SAN ISIDRO	</option>	'+
            '	<option value="SAN JUAN BAUTISTA DE LA SALLE">	SAN JUAN BAUTISTA DE LA SALLE	</option>	'+
            '	<option value="SANTA FE">	SANTA FE	</option>	'+
            '	<option value="SANTO DOMINGO">	SANTO DOMINGO	</option>	'+
            '	<option value="SEÑOR DE LOS MILAGROS">	SEÑOR DE LOS MILAGROS	</option>	'+
            '	<option value="SIMON BOLIVAR">	SIMON BOLIVAR	</option>	'+
            '	<option value="SUDADERO">	SUDADERO	</option>	'+
            '	<option value="TRILCE">	TRILCE	</option>	'+
            '	<option value="VIRGEN DEL ROSARIO">	VIRGEN DEL ROSARIO	</option>	'+
            '	<option value="COMUNIDAD INFIERNO">	COMUNIDAD INFIERNO	</option>	'+
            '	<option value="OTRO">	OTRO	</option>	'
  
            );
        break;
        default:
            $('#Ie_seleccion').prop('disabled', true);
            $('#Ie_seleccion').val("0");  // Reset to default
          break;
      }
  }

  function validar_fin(){

    if($('#Nivel').val() == 'SECUNDARIA'){   

    var grado = $('#Grado').val();
    var region = $('#Region').val();
    var provincia = $('#Provincia').val();
    var lugar_ie = $('#Lugar_ie').val();
    var nombre_ie = $('#Nombre_ie').val();
    var ie = $('#Ie_seleccion').val();

    var flag = 0;
  
    if(grado == 0 || grado == ' ' || grado == null){
      $('#Grado').addClass('is-invalid');
    }else{
      $('#Grado').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }

    if(region === 0 || region === ' ' || region == null){
        $('#Region').addClass('is-invalid');
      }else{
        $('#Region').removeClass('is-invalid').addClass('is-valid');
        flag ++;
      }

    if((provincia === 0 || provincia === ' ' || provincia == null) && (region === 'Madre de Dios')){
      $('#Provincia').addClass('is-invalid');
    }else{
      $('#Provincia').removeClass('is-invalid').addClass('is-valid');
      flag ++;
    }
    if(region === 'Otro' && (lugar_ie ==='' || lugar_ie == null)){
      $('#Lugar_ie').addClass('is-invalid');
        
      }else{        
        $('#Lugar_ie').removeClass('is-invalid').addClass('is-valid');
        flag ++;
      }

    if(region === 'Otro' && (nombre_ie ==='' || nombre_ie == null)){
        $('#Nombre_ie').addClass('is-invalid');
        
    }else{
        $('#Nombre_ie').removeClass('is-invalid').addClass('is-valid');
        flag ++;
    }

    if((ie === '' || ie === ' ' || ie == null) && (region === 'Madre de Dios')){
        $('#Ie_seleccion').addClass('is-invalid');
    }else{
        $('#Ie_seleccion').removeClass('is-invalid').addClass('is-valid');
        flag ++;
    }
  }else{
    alert('datos incompletos');
  }

    return flag;
  }