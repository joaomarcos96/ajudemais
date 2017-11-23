

$(document).ready(function(){

		//  inicializa as animações
		new WOW().init();

	/*
		Função para buscar a lista de cidades de acordo com o Estado
	*/
		function buscarCidadesPeloEstado(desabilitar_titulo){
			var url = base_url + 'cidades/buscarCidades/' + document.getElementById('estado').value;
                        if(desabilitar_titulo){
                            url = url + '/1';
                        }
			$.get(url, function(dados) {
				$('#cidade').html(dados);
			});
		}

		// chama a função que busca as cidades quando o estado é selecionado
		$('#estado').change(function(){
			buscarCidadesPeloEstado();
			$('#cidade').removeAttr('disabled');
		});

		// para selecionar a cidade do usuário que será editado //
		$('#estado option').each(function(i){
			if(i > 0 && this.selected == true){
				buscarCidadesPeloEstado(1);
				$('#cidade').removeAttr('disabled');
			}
		});

	/*
		Fim função
	*/

});

/*
	Função para Google Maps API
*/
	function initMap() {
		var var_location = new google.maps.LatLng(-21.350747, -46.526857);

		var var_mapoptions = {
			center: var_location,

			zoom: 14
		};

		var var_marker = new google.maps.Marker({
			position: var_location,
			map: var_map,
			title: "IFSULDEMINAS - Campus Muzambinho"
		});

		var var_map = new google.maps.Map(document.getElementById("map-container"),
			var_mapoptions);

		var_marker.setMap(var_map);
	}

	$(window).on('load', function(){
		google.maps.event.addDomListener(window, 'load', initMap);
	});
/*
	Fim função
*/





/*
	Máscara para input celular
*/
	var opcoes = {onKeyPress: function(celular, e, field, opcoes){
		mascara = (celular.length > 14) ? '(00) 00000-0000' : '(00) 0000-00009';
		$('[name=celular]').mask(mascara, opcoes);
	}};
	$('[name=celular]').mask('(00) 0000-00009', opcoes);
/*
	Fim máscara
*/


/*
	Função para confirmar remoção - modal
*/
	$('#confirmar-delecao').on('show.bs.modal', function (e) {
		var id = $(e.relatedTarget).data('id');
		$('#linha-id').val(id);
	 });

	var base_url = window.location.origin + '/ajudemais/';
	 
	$('#botao-excluir').click(function() {
		var id = $('#linha-id').val();

		// Retira barra / do final da url atual //
		var url_atual = window.location.href.replace(/\/$/, "");

		if(url_atual == base_url + 'produtos/meus' || url_atual == base_url + 'produtos/todos'){
			window.location = base_url + 'produtos/excluir/' + id;
		}
		else if(url_atual == base_url + 'doacoes'){
			window.location = base_url + 'doacoes/excluir/' + id;
		}
		else {
			window.location = base_url + 'usuario/excluirUsuario/' + id;
		}
	});
/*
	Fim função
*/


/*
	Funções para chamar diferentes links de cadastro de acordo com o escolhido pelo usuário
*/
	$('#cadastro-doador').click(function(){
		$('.modal-title').html('Cadastro de doador');
		$('#modal-form').attr('action', base_url + 'login/cadastrarUsuario/1');
	});


	$('#cadastro-donatario').click(function(){
		$('.modal-title').html('Cadastro de donatário');
		$('#modal-form').attr('action', base_url + 'login/cadastrarUsuario/2');
	});
/*
	Fim funções
*/


/*
	Função para limpar campos ao fechar modal
*/

	function limparCampos() {
		$('.form-control').val('');
		$('#estado').prop('selectedIndex', 0);
		$('#cidade').html('<option selected hidden>Selecione um estado primeiro</option>');
		$('#cidade').attr('disabled', true);
	}

	$('#cadastro').on('hidden.bs.modal', function() {
		limparCampos();
	});
/*
	Fim função
*/


/*
	Função para colocar autofocus no input com autofocus em modal
*/
	$('.modal').on('shown.bs.modal', function() {
		$(this).find('[autofocus]').focus();
	});
/*
	Fim função
*/


/*
	Função para desabilitar o botão de alterar e excluir produtos já doados
*/

	$(function(){
		$('.tooltip-wrapper').tooltip({position: "bottom"});
	});
/*
	Fim função
*/


/*
	Função para rolagem suave após clique em um elemento da página inicial
*/
	!function(a) {
		"use strict";
		a('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
				var e = a(this.hash);
				if ((e = e.length ? e : a("[name=" + this.hash.slice(1) + "]")).length)
					return a("html, body").animate({
						scrollTop: e.offset().top - 54
					}, 1e3, "easeInOutExpo"),
					!1
			}
		}),
		a(".js-scroll-trigger").click(function() {
			a(".navbar-collapse").collapse("hide")
		}),
		a("body").scrollspy({
			target: "#mainNav",
			offset: 54
		}),
		a(window).scroll(function() {
			a("#mainNav").offset().top > 100 ? a("#mainNav").addClass("navbar-shrink") : a("#mainNav").removeClass("navbar-shrink")
		})
	}(jQuery);
/*
	Fim função
*/
