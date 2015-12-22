<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="container">
	<legend>
		Foire aux questions 
	</legend>
	
	<p>N'hésitez pas à nous <a href="<?php echo site_url('Accueil/Contact') ?>">contacter</a>, nous vous réponderons avec plaisir dans les meilleurs délais !  
	</p>
	<br>
	
    <div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Question #1 : Blablablabla ?</h3>
				<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<!-- <div class="collapse panel-collapsed"> -->
			
			<div class="panel-body">
                Founded in 1892 and headquartered in Fairfield, CT, LexisNexis Corporate Affiliations 
                is a technology and financial services company. 
                The company offers products and services ranging from aircraft engines, power generation, 
                water processing, and household appliances, among others. 
                
			</div>
			<!-- </div> -->
		</div>
	</div>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Question #2: Blablablabla ?</h3>
				<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<!-- <div class="collapse panel-collapsed"> -->
			
			<div class="panel-body">
                Founded in 1892 and headquartered in Fairfield, CT, LexisNexis Corporate Affiliations 
                is a technology and financial services company. 
                The company offers products and services ranging from aircraft engines, power generation, 
                water processing, and household appliances, among others. 
                
			</div>
			<!-- </div> -->
		</div>
	</div>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Question #3 : Blablablabla ?</h3>
				<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<!-- <div class="collapse panel-collapsed"> -->
			
			<div class="panel-body">
                Founded in 1892 and headquartered in Fairfield, CT, LexisNexis Corporate Affiliations 
                is a technology and financial services company. 
                The company offers products and services ranging from aircraft engines, power generation, 
                water processing, and household appliances, among others. 
                
			</div>
			<!-- </div> -->
		</div>
	</div>

	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Question #4 : Blablablabla ?</h3>
				<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<!-- <div class="collapse panel-collapsed"> -->
			
			<div class="panel-body">
                Founded in 1892 and headquartered in Fairfield, CT, LexisNexis Corporate Affiliations 
                is a technology and financial services company. 
                The company offers products and services ranging from aircraft engines, power generation, 
                water processing, and household appliances, among others. 
                
			</div>
			<!-- </div> -->
		</div>
	</div>


</div>

<script type="text/javascript">
    jQuery(function ($) {
        $('.panel-heading span.clickable').on("click", function (e) {
            if ($(this).hasClass('panel-collapsed')) {
                // expand the panel
                $(this).parents('.panel').find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
            else {
                // collapse the panel
                $(this).parents('.panel').find('.panel-body').slideUp();
                $(this).addClass('panel-collapsed');
                $(this).find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            }
        });
    });
</script>

</html>