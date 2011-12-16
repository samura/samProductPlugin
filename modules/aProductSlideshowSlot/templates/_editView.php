<?php use_helper('JavascriptBase') ?>
<div class='product-slideshow-form'>
<?php echo $form; echo $id; ?>
</div>

<?php javascript_tag() ?>
$('#slot-form-<?php echo $id?>_engine').change(function() {
	$('.product-slideshow-form')
	.before("<input type='hidden' name='refresh' value='Y'>")
	.parent('form')
	.submit();
});
<?php end_javascript_tag() ?>