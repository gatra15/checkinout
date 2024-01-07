<?php $__env->startSection('content'); ?>
    <div class="container" style="height: 100vh;">
        <div class="row justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">HUT DAPENBUN KE-48</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <img src="<?php echo e(asset('img/logo_dapenbun.png')); ?>" class="me-4" style="max-width: 100px;"
                            alt="Logo">


                        <form action="<?php echo e(route('checkout')); ?>" method="POST" class="w-100">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-11">
                                    <p class="fs-4">Welcome! <?php echo e($user->name); ?></p>
                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="col-auto">
                                    <p class="fs-6">Waktu Check in : <?php echo e($user->checkin_human); ?></p>
                                    <button type="submit" class="btn btn-danger">Check Out</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\checkinout\resources\views/body/dashboard.blade.php ENDPATH**/ ?>