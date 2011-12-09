<?php if($sf_user->hasFlash('message')): ?>
<div class="ui-widget"><div class="ui-state-highlight ui-corner-all"><p style="margin: 10px"><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><?php echo a_($sf_user->getFlash('message')) ?></p></div></div>
<?php endif ?>

<?php if($sf_user->hasFlash('error')): ?>
<div class="ui-widget"><div class="ui-state-error ui-corner-all"><p style="margin: 10px"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><?php echo a_($sf_user->getFlash('error')) ?></p></div></div>
<?php endif ?>