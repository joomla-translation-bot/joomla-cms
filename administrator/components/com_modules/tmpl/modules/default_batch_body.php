<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_modules
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Component\Modules\Administrator\Helper\ModulesHelper;

$clientId  = $this->state->get('client_id');

// Show only Module Positions of published Templates
$published = 1;
$positions = HTMLHelper::_('modules.positions', $clientId, $published);
$positions['']['items'][] = ModulesHelper::createOption('nochange', Text::_('COM_MODULES_BATCH_POSITION_NOCHANGE'));
$positions['']['items'][] = ModulesHelper::createOption('noposition', Text::_('COM_MODULES_BATCH_POSITION_NOPOSITION'));

// Build field
$attr = array(
	'id' => 'batch-position-id',
);

Text::script('JGLOBAL_SELECT_NO_RESULTS_MATCH');
Text::script('JGLOBAL_SELECT_PRESS_TO_SELECT');

$this->document->getWebAssetManager()->enableAsset('choicesjs');
HTMLHelper::_('webcomponent', 'system/fields/joomla-field-fancy-select.min.js', ['version' => 'auto', 'relative' => true]);

?>

<p><?php echo Text::_('COM_MODULES_BATCH_TIP'); ?></p>
<div class="container">
	<div class="row">
		<?php if ($clientId != 1) : ?>
			<div class="form-group col-md-6">
				<div class="controls">
					<?php echo LayoutHelper::render('joomla.html.batch.language', array()); ?>
				</div>
			</div>
		<?php elseif ($clientId == 1 && ModuleHelper::isAdminMultilang()) : ?>
			<div class="form-group col-md-6">
				<div class="controls">
					<?php echo LayoutHelper::render('joomla.html.batch.adminlanguage', array()); ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="form-group col-md-6">
			<div class="controls">
				<?php echo LayoutHelper::render('joomla.html.batch.access', []); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if ($published >= 0) : ?>
			<div class="col-md-6">
				<div class="controls">
					<label id="batch-choose-action-lbl" for="batch-choose-action">
						<?php echo Text::_('COM_MODULES_BATCH_POSITION_LABEL'); ?>
					</label>
					<div id="batch-choose-action" class="control-group">
						<joomla-field-fancy-select allow-custom search-placeholder="<?php echo $this->escape(Text::_('COM_MODULES_TYPE_OR_SELECT_POSITION')); ?>">
						<?php echo HTMLHelper::_('select.groupedlist', $positions, 'batch[position_id]', $attr); ?>
						</joomla-field-fancy-select>
						<div id="batch-copy-move" class="control-group radio">
							<?php echo HTMLHelper::_('modules.batchOptions'); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
