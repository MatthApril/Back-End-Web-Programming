<nav class="navbar bg-navy fixed-top py-3">
    <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand text-white fw-bold">PokeDB</a>
        <div class="fw-semibold">
            <a href="<?php echo e(route('pokemon.index', ['type' => 'all'])); ?>" class="me-2 text-white text-decoration-none">Pokedex</a>
            <a href="<?php echo e(route('items.index', ['type' => 'all'])); ?>" class="me-2 text-white text-decoration-none">Items</a>
        </div>
    </div>
</nav>
<?php /**PATH D:\Files Kuliah\INF_Semester_3\Backend Web Programming\TugasM6\resources\views/partials/header.blade.php ENDPATH**/ ?>