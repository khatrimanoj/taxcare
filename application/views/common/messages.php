<?php if (($this->session->flashdata('success'))) { ?>

	<div class="alert alert-success alert-dismissible" role="alert">

		<button type="button" class="close" data-dismiss="alert">&times;</button>

		<div class="alert-icon">

			<i class="fa fa-check"></i>

		</div>

		<div class="alert-message">

			<span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>

		</div>

	</div>

<?php } ?>

<?php if (($this->session->flashdata('error'))) { ?>

	<div class="alert alert-danger alert-dismissible" role="alert">

		<button type="button" class="close" data-dismiss="alert">&times;</button>

		<div class="alert-icon">

			<i class="fa fa-check"></i>

		</div>

		<div class="alert-message">

			<span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>

		</div>

	</div>

<?php } ?>

<?php if (($this->session->flashdata('warning'))) { ?>

	<div class="alert alert-warning alert-dismissible" role="alert">

		<button type="button" class="close" data-dismiss="alert">&times;</button>

		<div class="alert-icon d-none">

			<i class="fa fa-check"></i>

		</div>

		<div class="alert-message">

			<span><strong>Warning!</strong> <?php echo $this->session->flashdata('error'); ?></span>

		</div>

	</div>

<?php } ?>

<?php if(validation_errors()) {?>

	<div class="alert alert-danger alert-dismissible" role="alert">

		<button type="button" class="close" data-dismiss="alert">&times;</button>

			<div class="alert-icon d-none">

				<i class="fa fa-times"></i>

			</div>

			<div class="alert-message">

				<span><strong><?php echo validation_errors(); ?></span>

			</div>

	</div>                     

<?php  }?>

