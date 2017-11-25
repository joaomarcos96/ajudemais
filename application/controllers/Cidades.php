<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidades extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if($this->input->is_ajax_request() == false){
			show_404();
		}
	}

	public function buscarCidades($estado_id, $desabilitar_titulo = null){
		$cidades = $this->cidade->buscarCidadesPeloEstado($estado_id);

		$cidade_id = $this->session->flashdata('cidade_id');

		if($desabilitar_titulo == null):
		?>
			<option selected disabled hidden>Selecione uma cidade</option>
		<?php
		endif;
		?>

		<?php
		foreach($cidades as $cidade):
		?>
			<option value=<?php
							echo $cidade['id'];
							if($cidade['id'] == $cidade_id){
								echo '" selected';
							}
							?>>
				<?php echo $cidade['nome']; ?>
			</option>
		<?php
		endforeach;
	}

}
