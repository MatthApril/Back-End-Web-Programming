<?php $__env->startSection("content"); ?>
<div class="d-flex justify-content-center align-items-center" style="height: 85vh">
    <div class="container">
        <div class="row">
            <div class="col-md-4 bg-light border border-4 border-end-0 border-navy rounded-start-5 d-flex flex-column justify-content-between align-items-center p-4">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <a class="btn bg-navy btn-primary border-navy" href="<?php echo e(route('pokemon.index', ['type' => 'All'])); ?>"><i class="bi bi-arrow-left"></i> Back to Pokédex</a>
                    <span class="bg-navy rounded-pill fw-bold text-white p-2 px-3">#<?php echo e(sprintf("%03d", $pokemon['id'])); ?></span>
                </div>
                <img src="<?php echo e($pokemon['url']); ?>" class="img-fluid rounded-start" alt="<?php echo e($pokemon['name']); ?>" width="350">
                <div class="">
                    <h1 class="card-title mb-3"><?php echo e($pokemon['name']); ?></h1>
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge bg-<?php echo e(strtolower($pokemon['primary'])); ?> py-2 px-3 rounded-5"><?php echo e(strtoupper($pokemon['primary'])); ?></span>
                        <?php if($pokemon['secondary']): ?>
                            <span class="badge bg-<?php echo e(strtolower($pokemon['secondary'])); ?> py-2 px-3 rounded-5"><?php echo e(strtoupper($pokemon['secondary'])); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8 bg-navy rounded-end-5 text-white p-4">
                <h3 class="fw-bold mt-3 mb-4">Pokémon Data</h3>
                <div class="row row-cols-lg-5 g-3">
                    <div class="col">
                        <div class="bg-light-subtle rounded-3 p-2 px-3 mb-3 h-100 d-flex flex-column justify-content-center gap-2">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">SPECIES</small>
                            <h6 class="fw-bold text-dark"><?php echo e($pokemon['species']); ?></h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-light-subtle rounded-3 p-2 px-3 mb-3 h-100 d-flex flex-column justify-content-center gap-2">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">HEIGHT</small>
                            <h6 class="fw-bold text-dark"><?php echo e($pokemon['height']); ?></h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-light-subtle rounded-3 p-2 px-3 mb-3 h-100 d-flex flex-column justify-content-center gap-2">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">WEIGHT</small>
                            <h6 class="fw-bold text-dark"><?php echo e($pokemon['weight']); ?></h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-light-subtle rounded-3 p-2 px-3 mb-3 h-100 d-flex flex-column justify-content-center gap-2">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">GENDER</small>
                            <h6 class="fw-bold text-dark" style="font-size: 13px"><i class="bi bi-gender-male"></i> <?php echo e($pokemon['gender']['male']); ?>% / <i class="bi bi-gender-female"></i> <?php echo e($pokemon['gender']['female']); ?>%</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-light-subtle rounded-3 p-2 px-3 mb-3 h-100 d-flex flex-column justify-content-center gap-2">
                            <small class="text-muted fw-semibold" style="font-size: 11px;">EV YIELD</small>
                            <h6 class="fw-bold text-dark"><?php echo e($pokemon['ev_yield']); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <span class="fw-bold">Abilities</span>
                    <div class="d-flex">
                        <?php $__currentLoopData = $pokemon['abilities']['regular']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-regular py-2 px-3 mx-1"><?php echo e($ability); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($pokemon['abilities']['hidden'])): ?>
                            <span class="badge bg-hidden py-2 px-3 mx-1"><?php echo e($pokemon['abilities']['hidden']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-column gap-2">
                    <span class="fw-bold">Base Stats</span>
                    <div class="d-flex justify-content-between fw-bold">
                        <small>HP</small>
                        <small class="text-danger"><?php echo e($pokemon['hp_base']); ?></small>
                    </div>
                    <div class="progress w-100 rounded-pill" style="height: 0.75rem;">
                        <div class="progress-bar bg-danger"
                            role="progressbar"
                            style="width: <?php echo e(($pokemon['hp_base'] / 255) * 100); ?>%"
                            aria-valuenow="<?php echo e($pokemon['hp_base']); ?>"
                            aria-valuemin="0"
                            aria-valuemax="255">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <small>Attack</small>
                        <small class="text-orange"><?php echo e($pokemon['attack_base']); ?></small>
                    </div>
                    <div class="progress w-100 rounded-pill" style="height: 0.75rem;">
                        <div class="progress-bar bg-orange"
                            role="progressbar"
                            style="width: <?php echo e(($pokemon['attack_base'] / 255) * 100); ?>%"
                            aria-valuenow="<?php echo e($pokemon['attack_base']); ?>"
                            aria-valuemin="0"
                            aria-valuemax="255">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <small>Defense</small>
                        <small class="text-warning"><?php echo e($pokemon['defense_base']); ?></small>
                    </div>
                    <div class="progress w-100 rounded-pill" style="height: 0.75rem;">
                        <div class="progress-bar bg-warning"
                            role="progressbar"
                            style="width: <?php echo e(($pokemon['defense_base'] / 255) * 100); ?>%"
                            aria-valuenow="<?php echo e($pokemon['defense_base']); ?>"
                            aria-valuemin="0"
                            aria-valuemax="255">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <small>Sp. Atk</small>
                        <small class="text-primary"><?php echo e($pokemon['special_attack_base']); ?></small>
                    </div>
                    <div class="progress w-100 rounded-pill" style="height: 0.75rem;">
                        <div class="progress-bar bg-primary"
                            role="progressbar"
                            style="width: <?php echo e(($pokemon['special_attack_base'] / 255) * 100); ?>%"
                            aria-valuenow="<?php echo e($pokemon['special_attack_base']); ?>"
                            aria-valuemin="0"
                            aria-valuemax="255">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <small>Sp. Def</small>
                        <small class="text-success"><?php echo e($pokemon['special_defense_base']); ?></small>
                    </div>
                    <div class="progress w-100 rounded-pill" style="height: 0.75rem;">
                        <div class="progress-bar bg-success"
                            role="progressbar"
                            style="width: <?php echo e(($pokemon['special_defense_base'] / 255) * 100); ?>%"
                            aria-valuenow="<?php echo e($pokemon['special_defense_base']); ?>"
                            aria-valuemin="0"
                            aria-valuemax="255">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <small>Speed</small>
                        <small class="text-pink"><?php echo e($pokemon['speed_base']); ?></small>
                    </div>
                    <div class="progress w-100 rounded-pill" style="height: 0.75rem;">
                        <div class="progress-bar bg-pink"
                            role="progressbar"
                            style="width: <?php echo e(($pokemon['speed_base'] / 255) * 100); ?>%"
                            aria-valuenow="<?php echo e($pokemon['speed_base']); ?>"
                            aria-valuemin="0"
                            aria-valuemax="255">
                        </div>
                    </div>
                </div>
                <hr class="border border-2 border-light opacity-100">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total: </span>
                    <span class="ms-auto fw-bold"><?php echo e($pokemon['hp_base'] + $pokemon['attack_base'] + $pokemon['defense_base'] + $pokemon['special_attack_base'] + $pokemon['special_defense_base'] + $pokemon['speed_base']); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.template", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Files Kuliah\INF_Semester_3\Backend Web Programming\TugasM6\resources\views/pages/pokemon/show.blade.php ENDPATH**/ ?>