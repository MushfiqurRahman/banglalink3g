<div class="surveys view">
<h2><?php  echo __('Survey'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promoter'); ?></dt>
		<dd>
			<?php echo $this->Html->link($survey['Promoter']['name'], array('controller' => 'promoters', 'action' => 'view', $survey['Promoter']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($survey['Location']['title'], array('controller' => 'locations', 'action' => 'view', $survey['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Occupation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($survey['Occupation']['title'], array('controller' => 'occupations', 'action' => 'view', $survey['Occupation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Package'); ?></dt>
		<dd>
			<?php echo $this->Html->link($survey['Package']['title'], array('controller' => 'packages', 'action' => 'view', $survey['Package']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile Brand'); ?></dt>
		<dd>
			<?php echo $this->Html->link($survey['MobileBrand']['title'], array('controller' => 'mobile_brands', 'action' => 'view', $survey['MobileBrand']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is 3g'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['is_3g']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Smart Phone'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['is_smart_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Age'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['age']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Time'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['date_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Survey'), array('action' => 'edit', $survey['Survey']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Survey'), array('action' => 'delete', $survey['Survey']['id']), null, __('Are you sure you want to delete # %s?', $survey['Survey']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey'), array('action' => 'add')); ?> </li>
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
