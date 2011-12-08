<?php use_helper('a') ?>
<?php $page = aTools::getCurrentPage() ?>
	
<div class="a-ui a-subnav-wrapper">
	<div class="a-subnav-inner">
		<?php $drag = $page->userHasPrivilege('manage') ?>
		<?php include_component('aNavigation', 'accordion', array('root' => '/', 'active' => $page, 'name' => 'subnav')) ?>
	</div>
</div>