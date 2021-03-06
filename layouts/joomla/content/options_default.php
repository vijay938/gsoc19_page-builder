<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\HTML\HTMLHelper;

?>

<fieldset class="<?php echo !empty($displayData->formclass) ? $displayData->formclass : ''; ?>">
	<legend><?php echo $displayData->name; ?></legend>
	<?php if (!empty($displayData->description)) : ?>
		<p><?php echo $displayData->description; ?></p>
	<?php endif; ?>
	<?php $fieldsnames = explode(',', $displayData->fieldsname); ?>
		<div class="column-count-lg-2">
		<?php foreach ($fieldsnames as $fieldname) : ?>
			<?php foreach ($displayData->form->getFieldset($fieldname) as $field) : ?>
				<?php $datashowon = ''; ?>
				<?php $groupClass = $field->type === 'Spacer' ? ' field-spacer' : ''; ?>
				<?php if ($field->showon) : ?>
					<?php HTMLHelper::_('script', 'system/showon.min.js', array('version' => 'auto', 'relative' => true)); ?>
					<?php $datashowon = ' data-showon=\'' . json_encode(FormHelper::parseShowOnConditions($field->showon, $field->formControl, $field->group)) . '\''; ?>
				<?php endif; ?>

					<?php if (isset($displayData->showlabel)) : ?>
					<div class="control-group<?php echo $groupClass; ?>"<?php echo $datashowon; ?>>
						<div class="controls"><?php echo $field->input; ?></div>
					</div>
					<?php else : ?>
						<?php echo $field->renderField(); ?>
					<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
		</div>
</fieldset>
