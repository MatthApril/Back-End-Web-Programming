<?php $__env->startSection("content"); ?>
    <div class="container-fluid p-3">
        <h3 class="fw-bold text-white text-shadow mt-2">Pokédex</h3>
        <div class="nav-pokedex d-flex gap-1 flex-wrap my-3">
            <a href="#" class="bg-all-types text-black bg-warning">All Types</a>
            <a href="#" class="bg-normal">Normal</a>
            <a href="#" class="bg-fire">Fire</a>
            <a href="#" class="bg-water">Water</a>
            <a href="#" class="bg-electric">Electric</a>
            <a href="#" class="bg-grass">Grass</a>
            <a href="#" class="bg-ice">Ice</a>
            <a href="#" class="bg-fighting">Fighting</a>
            <a href="#" class="bg-poison">Poison</a>
            <a href="#" class="bg-ground">Ground</a>
            <a href="#" class="bg-flying">Flying</a>
            <a href="#" class="bg-psychic">Psychic</a>
            <a href="#" class="bg-bug">Bug</a>
            <a href="#" class="bg-rock">Rock</a>
            <a href="#" class="bg-ghost">Ghost</a>
            <a href="#" class="bg-dragon">Dragon</a>
            <a href="#" class="bg-dark">Dark</a>
            <a href="#" class="bg-steel">Steel</a>
            <a href="#" class="bg-fairy">Fairy</a>
        </div>
        <small class="text-white">Showing <?php echo e(count($pokemons)); ?> pokémon</small>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4 justify-content-between mt-1">
            <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pokemon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('pokemon.show', $pokemon['id'])); ?>" class="col text-decoration-none" >
                <div class="card border-4 border-black rounded-4">
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo e($pokemon['url']); ?>" class="img-fluid rounded-start py-4" alt="<?php echo e($pokemon['name']); ?>" width="125" >
                    </div>
                    <div class="card-body bg-secondary-subtle rounded-4 rounded-top-0 d-flex flex-column gap-2">
                        <h5 class="card-title fw-bold"><?php echo e($pokemon['name']); ?></h5>
                        <div class="">
                            <span class="badge bg-<?php echo e(strtolower($pokemon['primary'])); ?> py-2 px-3 rounded-5"><?php echo e(strtoupper($pokemon['primary'])); ?></span>
                            <?php if($pokemon['secondary']): ?>
                                <span class="badge bg-<?php echo e(strtolower($pokemon['secondary'])); ?> py-2 px-3 rounded-5"><?php echo e(strtoupper($pokemon['secondary'])); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.template", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Files Kuliah\INF_Semester_3\Backend Web Programming\TugasM6\resources\views/pages/pokemon/store.blade.php ENDPATH**/ ?>