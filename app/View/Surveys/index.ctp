<div class="surveys index">
	<h2><?php echo __('Surveys'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('promoter_id'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('occupation_id'); ?></th>
			<th><?php echo $this->Paginator->sort('package_id'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile_brand_id'); ?></th>
			<th><?php echo $this->Paginator->sort('is_3g'); ?></th>
			<th><?php echo $this->Paginator->sort('is_smart_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile'); ?></th>
			<th><?php echo $this->Paginator->sort('age'); ?></th>
			<th><?php echo $this->Paginator->sort('date_time'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($surveys as $survey): ?>
	<tr>
		<td><?php echo h($survey['Survey']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($survey['Promoter']['name'], array('controller' => 'promoters', 'action' => 'view', $survey['Promoter']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($survey['Location']['title'], array('controller' => 'locations', 'action' => 'view', $survey['Location']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($survey['Occupation']['title'], array('controller' => 'occupations', 'action' => 'view', $survey['Occupation']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($survey['Package']['title'], array('controller' => 'packages', 'action' => 'view', $survey['Package']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($survey['MobileBrand']['title'], array('controller' => 'mobile_brands', 'action' => 'view', $survey['MobileBrand']['id'])); ?>
		</td>
		<td><?php echo h($survey['Survey']['is_3g']); ?>&nbsp;</td>
		<td><?php echo h($survey['Survey']['is_smart_phone']); ?>&nbsp;</td>
		<td><?php echo h($survey['Survey']['name']); ?>&nbsp;</td>
		<td><?php echo h($survey['Survey']['mobile']); ?>&nbsp;</td>
		<td><?php echo h($survey['Survey']['age']); ?>&nbsp;</td>
		<td><?php echo h($survey['Survey']['date_time']); ?>&nbsp;</td>
		<td><?php echo h($survey['Survey']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $survey['Survey']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $survey['Survey']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $survey['Survey']['id']), null, __('Are you sure you want to delete # %s?', $survey['Survey']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Survey'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Promoters'), array('controller' => 'promoters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promoter'), array('controller' => 'promoters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Occupations'), array('controller' => 'occupations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Occupation'), array('controller' => 'occupations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('controller' => 'packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('controller' => 'packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mobile Brands'), array('controller' => 'mobile_brands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mobile Brand'), array('controller' => 'mobile_brands', 'action' => 'add')); ?> </li>
	</ul>
</div>
