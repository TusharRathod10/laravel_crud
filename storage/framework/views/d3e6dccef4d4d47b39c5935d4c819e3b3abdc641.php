<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .err {
            color: red;
            margin-top: 5px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php if(session('success')): ?>
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                        <div class="alert alert-success my-2 p-2">
                            <?php echo e(session('success')); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(session('delete')): ?>
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                        <div class="alert alert-danger my-2 p-2">
                            <?php echo e(session('delete')); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if(!isset($update_admin)): ?>
                    <form action="<?php echo e(url('form')); ?>" method="post">
                    <?php else: ?>
                        <form action="<?php echo e(url('update_form')); ?>" method="post">
                <?php endif; ?>

                <?php echo csrf_field(); ?>
                <h1 class="my-3">Admin Data</h1>
                <div class="form-group mt-3">
                    <label for="name">Name: </label>
                    <input type="hidden" name="id" class="form-control"
                        value="<?php if(isset($update_admin)): ?> <?php echo e($update_admin->id); ?> <?php endif; ?>">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name"
                        value="<?php if(isset($update_admin)): ?> <?php echo e($update_admin->name); ?> <?php endif; ?>">
                </div>
                <?php if(!isset($update_admin)): ?>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="err"> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group mt-3">
                        <label for="email">Email: </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="err"> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group mt-3">
                        <label for="password">Password: </label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="err"> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group mt-3">
                        <label for="confirm_password">Confirm password: </label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Enter Confirm-Password">
                    </div>
                <?php endif; ?>
                <?php if(!isset($update_admin)): ?>
                    <button class="btn btn-primary mt-2" type="submit" name="submit">
                        Submit
                    </button>
                <?php else: ?>
                    <button class="btn btn-primary mt-2" type="submit" name="submit">
                        Update
                    </button>
                <?php endif; ?>
                </form>
                <br>
                <?php if(isset($admins)): ?>
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($admin->id); ?></td>
                                    <td><?php echo e($admin->name); ?></td>
                                    <td><?php echo e($admin->email); ?></td>
                                    <td><?php echo e($admin->password); ?></td>
                                    <td><a href="<?php echo e(url('update_admin')); ?>/<?php echo e($admin->id); ?>"><i
                                                class="fa fa-edit text-primary"></i></a></td>
                                    <td><a href="<?php echo e(url('delete_admin')); ?>/<?php echo e($admin->id); ?>"><i
                                                class="fa fa-trash text-danger"></i></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\laravelDemo\resources\views/index.blade.php ENDPATH**/ ?>