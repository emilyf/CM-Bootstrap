<?php //dpm($node); ?>
<?php $block = module_invoke('custom_block', 'block_view', 'cb_archive_two_col'); ?>
<?php print render($block['content']); ?>