	var executar = 0;
	var linhas;
	var total;
	var testadas = 0,lives = 0,dies = 0,erros = 0;

	function iniciar(){
		$('#iniciar').attr('disabled', true);
		$('#parar').attr('disabled', false);
		$('#limpar').attr('disabled', true);
		document.getElementById('iniciar').style.cursor = '';
		document.getElementById('parar').style.cursor = 'pointer';
		document.getElementById('limpar').style.cursor = '';
		document.getElementById('verde').style.backgroundColor = 'cyan';
		document.getElementById('amarelo').style.backgroundColor = '';
		document.getElementById('vermelho').style.backgroundColor = '';
		//if(executar == 0){
			removerr();
			$('#lista').attr('readonly', true);
			linhas = $('#lista').val().split('\n');
			total = linhas.length;
			$('#linhasC').text('LINHAS: '+total);
		//}
		executar = 1;
		start();		
	}

	function parar(){
		executar = 2;
	}

	function limpar(){
		executar = 0;
		testadas = 0,lives = 0,dies = 0,erros = 0;
		total = 0;
		$('#aprovadasC').text('APROVADAS: 0');
		$('#reprovadasC').text('REPROVADAS: 0');
		$('#testadasC').text('TESTADAS: 0');
		$('#errosC').text('ERROS: 0');
		$('#aprovadas').empty();
		$('#reprovadas').empty();
		$('#lista').val('');
		$('#lista').attr('readonly', false);
		document.getElementById('barra').style.width = '0%';
		document.getElementById('verde').style.backgroundColor = '';
		document.getElementById('amarelo').style.backgroundColor = '';
		document.getElementById('vermelho').style.backgroundColor = 'teal';
	}

	function testar(value){
		$.ajax({
			method: 'GET',
			url: 'arquivos/php/api.php',
			data: { linha: value },
			success: function(resultado){
				testadas++;
				$('#testadasC').text('TESTADAS: '+testadas);
				document.getElementById('barra').style.width = 100 * (testadas/total)+'%';
				if(isJson(resultado)){
					var obj = JSON.parse(resultado);
					if(obj.status == 0){
						dies++;
						$('#reprovadasC').text('REPROVADAS: '+dies);
						$('#reprovadas').prepend(obj.str);
					}else if(obj.status == 1){
						lives++;
						$('#aprovadasC').text('APROVADAS: '+lives);
						$('#aprovadas').prepend(obj.str);
					}else{
						erros++;
						$('#errosC').text('ERROS: '+erros);
						$('#erros').prepend(obj.str);
					}
				}else{
					erros++;
					$('#errosC').text('ERROS: '+dies);
				}
				start();
				remover();
			},
			error: function(){
				start();
			}
		});
	}

	function start(){
		if(!executar)return false;
		if((linhas[0]!==undefined)&&(linhas[0]!=='')&&(executar==1)){
			testar(linhas[0]);
			linhas.shift();
		}else{
			executar = false;
			testadas = 0,lives = 0,dies = 0,erros = 0;
			total = 0;
			$('#iniciar').attr('disabled', false);
			$('#parar').attr('disabled', true);
			$('#limpar').attr('disabled', false);
			$('#lista').attr('readonly', false);
			document.getElementById('iniciar').style.cursor = 'pointer';
			document.getElementById('parar').style.cursor = '';
			document.getElementById('limpar').style.cursor = 'pointer';
			document.getElementById('verde').style.backgroundColor = '';
			document.getElementById('amarelo').style.backgroundColor = 'aquamarine';
			document.getElementById('vermelho').style.backgroundColor = '';
		}
	}

	function unique(array){
		return array.filter(function (el, index, arr){
			return index == arr.indexOf(el);
		});
	}

	function clean(str){
		while (str.indexOf('\t') > -1){str = str.replace('\t', '');}
		while (str.indexOf(' ') > -1){str = str.replace(' ', '');}
		return str;
	}

	function removerr() {
		var array = $('#lista').val().split('\n');
		array = unique(array);
		for(i=0;i<array.length;i++){
			array[i] = clean(array[i]);
		}
		array = array.filter(function(n){return n!=0});
		$('#lista').val(array.join('\n'));
	}

	function remover() {
	    var linhas = $('#lista').val().split('\n');
	    linhas.splice(0, 1);
	    $('#lista').val(linhas.join('\n'));
	}

	function contar(){
		if(executar !== 1){
			linhas = $('#lista').val().split('\n');
			total = linhas.length;
			$('#linhasC').text('LINHAS: '+total);
		}
	}

	function isJson(str){
		try{JSON.parse(str);
		}catch(e){return false;
		}return true;
	}

	function abrirFechar(id){
		if(document.getElementById(id).style.display == 'block'){
			document.getElementById(id).style.display = 'none';
			document.getElementById(id+'i').className = 'fas fa-window-maximize';
		}else{
			document.getElementById(id).style.display = 'block';
			document.getElementById(id+'i').className = 'fas fa-window-minimize';
		}
	}

	function copiar(el) {
		var el = document.getElementById(el);
		var body = document.body, range, sel;
		if (document.createRange && window.getSelection) {
			range = document.createRange();
			sel = window.getSelection();
			sel.removeAllRanges();
			try {
				range.selectNodeContents(el);
				sel.addRange(range);
			} catch (e) {
				range.selectNode(el);
				sel.addRange(range);
			}
		} else if (body.createTextRange) {
			range = body.createTextRange();
			range.moveToElementText(el);
			range.select();
		}
		//window.getSelection());
		document.execCommand('copy')
	}

	function modal(id, id2, id3){
		if(document.getElementById(id).style.display == 'none'){
			document.getElementById(id).style.display = 'flex';
			if(id2 !== undefined && id3 !== undefined){
				document.getElementById(id2).style.display = 'none';
				document.getElementById(id3).style.display = 'none';
			}
		}else{
			document.getElementById(id).style.display = 'none';
			if(id2 !== undefined && id3 !== undefined){
				document.getElementById(id2).style.display = 'flex';
				document.getElementById(id3).style.display = 'flex';
			}
		}
	}