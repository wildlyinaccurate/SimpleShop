<section class="title">
    <h4><?php echo lang('simpleshop.products_title'); ?></h4>
</section>

<section class="item">
    <?php if ($products): ?>
        <?php $this->load->view('admin/tables/products', array('products' => $products)); ?>
    <?php else: ?>
        <p><?php echo lang('simpleshop.products.no_products'); ?></p>
    <?php endif; ?>
</section>
