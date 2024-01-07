<?php $__env->startSection('content'); ?>
    <div class="container" style="height: 100vh;">
        <div class="row justify-content-center align-items-center" style="height: 100%;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">HUT DAPENBUN KE-48</h5>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <img src="<?php echo e(asset('img/logo_dapenbun.png')); ?>" class="me-4" style="max-width: 100px;"
                            alt="Logo">

                        <form action="<?php echo e(route('checkin')); ?>" method="POST" class="w-100">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-11">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="Masukkan NIK" value="<?php echo e(old('nik')); ?>">
                                    <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-11">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukkan Nama" value="<?php echo e(old('name')); ?>">
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <input type="hidden" name="tz" id="tz" value="">
                            <div class="mt-3">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success">Check In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById("tz").value = tz;
    });
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\checkinout\resources\views/body/index.blade.php ENDPATH**/ ?>