<?php $__env->startSection("content"); ?>
    <div class="container-fluid p-3">
        <h3 class="page-title text-white text-shadow mt-2">Pokémon Items</h3>
        <div class="nav-pokedex d-flex gap-1 flex-wrap my-3">
            <a href="<?php echo e(route('items.index', ['type' => 'All'])); ?>" class="bg-all-types text-black bg-warning">All Types</a>
            <a href="<?php echo e(route('items.index', ['type' => 'Medicine'])); ?>" class="bg-medicine">Medicine</a>
            <a href="<?php echo e(route('items.index', ['type' => 'Poké Balls'])); ?>" class="bg-poké-balls">Poké Balls</a>
            <a href="<?php echo e(route('items.index', ['type' => 'Berries'])); ?>" class="bg-berries">Berries</a>
            <a href="<?php echo e(route('items.index', ['type' => 'Vitamins'])); ?>" class="bg-vitamins">Vitamins</a>
            <a href="<?php echo e(route('items.index', ['type' => 'Battle Items'])); ?>" class="bg-battle-items">Battle Items</a>
            <a href="<?php echo e(route('items.index', ['type' => 'Other Items'])); ?>" class="bg-other-items">Other</a>
        </div>
        <small class="text-white">Showing <?php echo e(count($items)); ?> items</small>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4 mt-1">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('items.show', $item['id'])); ?>" class="col text-decoration-none" >
                <div class="card border-4 border-navy rounded-4">
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo e($item['icon']); ?>" class="img-fluid rounded-start py-4" alt="<?php echo e($item['name']); ?>" width="125" >
                    </div>
                    <div class="card-body bg-secondary-subtle rounded-4 rounded-top-0 d-flex flex-column gap-2">
                        <h5 class="card-title"><?php echo e($item['name']); ?></h5>
                        <div class="">
                            <span class="badge bg-<?php echo e(strtolower(str_replace(' ', '-', $item['category']))); ?> py-2 px-3 rounded-5"><?php echo e(strtoupper($item['category'])); ?></span>
                        </div>
                        <small class="fw-semibold text-muted"><?php echo e($item['effect']); ?></small>
                        <div class="d-flex justify-content-between">
                            <small class="fw-semibold text-muted">Price:</small>
                            <span class="text-price">₽<?php echo e(number_format($item['price'])); ?></span>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.template", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Files Kuliah\INF_Semester_3\Backend Web Programming\TugasM6\resources\views/pages/items/index.blade.php ENDPATH**/ ?>