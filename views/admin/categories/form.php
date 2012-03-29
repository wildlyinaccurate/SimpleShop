<section class="title">
	<h4 class="breadcrumbs">
		<?php echo category_breadcrumbs($viewing_category_node, true); ?>
		<?php echo $page_title; ?>
	</h4>
</section>

<section class="item">

<?php echo form_open(uri_string(), 'class="crud"'); ?>

<div id="simpleshop-category" class="form_inputs">
	<ul>
		<li class="<?php echo alternator('even', ''); ?>">
			<label for="title"><?php echo lang('category_title_label'); ?> <span>*</span></label>
			<div class="input"><?php echo form_input('title', htmlspecialchars_decode($category->getTitle()), 'maxlength="130"'); ?></div>
		</li>

		<li class="<?php echo alternator('even', ''); ?>">
			<label for="parent_category"><?php echo lang('category_parent_label'); ?></label>
			<div class="input">
				<select name="parent_category" id="parent_category">
					<option value="0"><?php echo lang('none_label'); ?></option>

					<?php
					foreach ($root_categories as $root_category)
					{
						$category_tree = $nsm->fetchTreeAsArray($root_category->getId());

						foreach ($category_tree as $node_wrapper)
						{
							$selected = '';
							$node = $node_wrapper->getNode();

							if ($node->getId() == $viewing_category_id ||
								($category->getParentCategory() && $node->getId() == $category->getParentCategory()->getId()))
							{
								$selected = 'selected="selected"';
							}

							echo '<option value="' . $node->getId() . '" ' . $selected . '>' . str_repeat('&nbsp;&nbsp;', $node_wrapper->getLevel() * 2) . $node->getTitle() . '</option>';
						}
					}
					?>
				</select>
			</div>
		</li>

		<li class="editor <?php echo alternator('even', ''); ?>">
			<label for="description"><?php echo lang('category_description_label'); ?></label><br>
			<?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => $category->getDescription(), 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>
		</li>

	</ul>
</div>

<div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>

<?php echo form_close(); ?>

</section>
