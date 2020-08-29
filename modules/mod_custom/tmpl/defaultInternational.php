<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


<?/*<div class="custom<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >*/?>
	<?php //echo strip_tags($module->content,'<span><br><b><a><div><ul><li><ol><iframe><img>');?>
<?/*</div>*/?>

<div class="col-md-6 col-sm-6 col-xs-12">
<div class="serviceBox">
<div class="iconWrap">
<div class="iconWrapIn">
<img src="<?php echo $params->get('backgroundimage');?>">
</div>
</div>
<?php echo $module->content; ?>
</div>
</div>
