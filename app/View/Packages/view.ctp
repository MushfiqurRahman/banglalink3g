<div class="packages view">
<h2><?php  echo __('Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($package['Package']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($package['Package']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descr'); ?></dt>
		<dd>
			<?php echo h($package['Package']['descr']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Package'), array('action' => 'edit', $package['Package']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Package'), array('action' => 'delete', $package['Package']['id']), null, __('Are you sure you want to delete # %s?', $package['Package']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys'), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Surveys'); ?></h3>
	<?php if (!empty($package['Survey'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Promoter Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Occupation Id'); ?></th>
		<th><?php echo __('Package Id'); ?></th>
		<th><?php echo __('Mobile Brand Id'); ?></th>
		<th><?php echo __('Is 3g'); ?></th>
		<th><?php echo __('Is Smart Phone'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Mobile'); ?></th>
		<th><?php echo __('Age'); ?></th>
		<th><?php echo __('Date Time'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($package['Survey'] as $survey): ?>
		<tr>
			<td><?php echo $survey['id']; ?></td>
			<td><?php echo $survey['promoter_id']; ?></td>
			<td><?php echo $survey['location_id']; ?></td>
			<td><?php echo $survey['occupation_id']; ?></td>
			<td><?php echo $survey['package_id']; ?></td>
			<td><?php echo $survey['mobile_brand_id']; ?></td>
			<td><?php echo $survey['is_3g']; ?></td>
			<td><?php echo $survey['is_smart_phone']; ?></td>
			<td><?php echo $survey['name']; ?></td>
			<td><?php echo $survey['mobile']; ?></td>
			<td><?php echo $survey['age']; ?></td>
			<td><?php echo $survey['date_time']; ?></td>
			<td><?php echo $survey['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'surveys', 'action' => 'view', $survey['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'surveys', 'action' => 'edit', $survey['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'surveys', 'action' => 'delete', $survey['id']), null, __('Are you sure you want to delete # %s?', $survey['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Survey'), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
