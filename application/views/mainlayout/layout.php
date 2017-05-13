<!DOCTYPE html>
<html>

<?php $this->view('partialayout/headerlayout');  ?><!-- Dentro de esta vista esta el CSSLAYOUT -->

<body class="hold-transition skin-red-light sidebar-mini">
	
	  <?php $this->view('partialayout/topbarlayout'); ?>

	  <?php $this->view('partialayout/sidebarlayout'); ?>    

	  <?php $this->load->view('contentlayout/'.$CONTENT); ?>

	  <?php $this->view('partialayout/footerlayout'); ?>

	  <?php $this->view('partialayout/jslayout'); ?>

	  <?php $this->view('partialayout/scriptmainlayout'); ?>

	  <?php if (function_exists('MISJAVASCRIPTPERSONALIZADO')) MISJAVASCRIPTPERSONALIZADO(); ?>
	
</body>
</html>
