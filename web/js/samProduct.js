$(function(){

  $('.add').hide();
    
  // button to add product or category
  $('.add-product-category, .add-product').click(function(event){
    $(this).hide();
    $(this).next().show();
    event.preventDefault();
    $('.save-product-category, .save-product').click(function(){
      $(this).parent().submit();
    });
  });
  
  // button to edit product or category
  $('.edit-product-category, .edit-product').click(function(event){
	event.preventDefault();
	// get the form
    var $wrap = $(this).parents('.product-category-title, .product-title');
    
    $wrap.children().hide();
    
    $wrap.prepend('<div class="edit-product-wrapper a-ui"><img src="/apostrophePlugin/images/a-icon-loader.gif"></div>');
    
    $('.edit-product-wrapper', $wrap).load(
      $('input[name=url]', $wrap).val(), 
      $('input[name=slug]', $wrap).serialize());
  });
});