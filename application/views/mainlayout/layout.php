<!DOCTYPE html>
<html>

<?php $this->view('partialayout/headerlayout');  ?><!-- Dentro de esta vista esta el CSSLAYOUT -->

<body class="hold-transition skin-red-light sidebar-mini">

	<div id="carga_modal" class="modal fade" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">

	            <div class="modal-header">
	                <button type="button" class="close"  aria-label="Close">
	                </button>
	                <h4 class="modal-title" >Cargando.....</h4>
	            </div>
	            <div class="modal-body">
	               <img class="img-responsive img-circle" style="margin-left: 80px;" src="<?= base_url("/resources/images/loading.gif")?>"></img>
	            </div>
	        </div>
	    </div>
	</div>
	
	  <?php $this->view('partialayout/topbarlayout'); ?>

	  <?php $this->view('partialayout/sidebarlayout'); ?>    

	  <?php $this->load->view('contentlayout/'.$CONTENT); ?>

	  <?php $this->view('partialayout/footerlayout'); ?>

	  <?php $this->view('partialayout/jslayout'); ?>

	  <?php $this->view('partialayout/scriptmainlayout'); ?>

	  <?php if (function_exists('MISJAVASCRIPTPERSONALIZADO')) MISJAVASCRIPTPERSONALIZADO(); ?>
	
</body>
</html>
