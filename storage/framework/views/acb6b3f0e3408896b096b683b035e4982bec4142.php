<?php
    $configData = Helper::applClasses();
?>



<?php $__env->startSection('title', __('locale.auth.login')); ?>

<?php $__env->startSection('page-style'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset(mix('css/base/pages/authentication.css'))); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="<?php echo e(route('login')); ?>">
                <img src="<?php echo e(asset(config('app.logo'))); ?>" alt="<?php echo e(config('app.name')); ?>" />
            </a>
            <!-- /Brand logo-->

            <div class="d-flex justify-content-center col-12 align-items-center p-5">
                <!-- Login-->
                <div class="col-md-4 col-lg-4 col-sm-12 align-items-center auth-bg px-2 p-lg-5 rounded">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                        <h2 class="card-title fw-bold mb-1"><?php echo e(__('locale.labels.welcome_to')); ?>

                            <?php echo e(config('app.name')); ?>

                        </h2>
                        <p class="card-text mb-2"><?php echo e(__('locale.auth.welcome_message')); ?></p>

                        <form class="auth-login-form mt-2" method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-1">
                                <label class="form-label" for="email"><?php echo e(__('locale.labels.email')); ?></label>
                                <input id="email" type="email"
                                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                    placeholder="<?php echo e(__('locale.labels.email')); ?>" value="<?php echo e(old('email')); ?>" required
                                    autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                        <div class="alert-body d-flex align-items-center">
                                            <i data-feather="info" class="me-50"></i>
                                            <span><?php echo e($message); ?></span>
                                        </div>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                        <div class="alert-body d-flex align-items-center">
                                            <i data-feather="info" class="me-50"></i>
                                            <span><?php echo e(__('locale.labels.g-recaptcha-response')); ?></span>
                                        </div>
                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>


                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password"><?php echo e(__('locale.labels.password')); ?></label>

                                    <?php if(Route::has('password.request')): ?>
                                        <a href="<?php echo e(route('password.request')); ?>">
                                            <small><?php echo e(__('locale.auth.forgot_password')); ?>?</small>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="input-group input-group-merge form-password-toggle">
                                    <input id="password" type="password" class="form-control" name="password"
                                        placeholder="<?php echo e(__('locale.labels.password')); ?>" required autocomplete="password">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>

                            <?php if(config('no-captcha.login')): ?>
                                <div class="mb-1">
                                    <?php echo e(no_captcha()->input('g-recaptcha-response')); ?>

                                </div>
                            <?php endif; ?>


                            <div class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" <?php echo e(old('remember') ? 'checked' : ''); ?> name="remember"
                                        id="remember-me" type="checkbox" tabindex="3" />
                                    <label class="form-check-label" for="remember-me">
                                        <?php echo e(__('locale.auth.remember_me')); ?></label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100"
                                tabindex="4"><?php echo e(__('locale.auth.login')); ?></button>

                            <?php if(config('app.stage') == 'demo'): ?>
                                <div class="d-flex justify-content-between mt-2">
                                    <button class="btn btn-secondary admin-login">
                                        Admin
                                    </button>
                                    <button class="btn btn-info client-login">
                                        Client
                                    </button>
                                </div>
                            <?php endif; ?>
                        </form>

                        <?php if(config('account.can_register')): ?>
                            <p class="text-center mt-2">
                                <span><?php echo e(__('locale.auth.new_on_our_platform')); ?>?</span>
                                <a href="<?php echo e(route('register')); ?>"><span>&nbsp;<?php echo e(__('locale.auth.register')); ?></span></a>
                            </p>
                        <?php endif; ?>

                        <?php if(config('services.facebook.active') ||
                                config('services.twitter.active') ||
                                config('services.google.active') ||
                                config('services.github.active')): ?>
                            <div class="divider my-2">
                                <div class="divider-text"><?php echo e(__('locale.auth.or')); ?></div>
                            </div>

                            <div class="auth-footer-btn d-flex justify-content-center">

                                <?php if(config('services.facebook.active')): ?>
                                    <a class="btn btn-facebook" href="<?php echo e(route('social.login', 'facebook')); ?>"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook">
                                        <i data-feather="facebook"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if(config('services.twitter.active')): ?>
                                    <a class="btn btn-twitter" href="<?php echo e(route('social.login', 'twitter')); ?>"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter">
                                        <i data-feather="twitter"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if(config('services.google.active')): ?>
                                    <a class="btn btn-google" href="<?php echo e(route('social.login', 'google')); ?>"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Google">
                                        <i data-feather="mail"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if(config('services.github.active')): ?>
                                    <a class="btn btn-github" href="<?php echo e(route('social.login', 'github')); ?>"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Github">
                                        <i data-feather="github"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>


                    </div>
                </div>
                <!-- /Login-->
            </div>
        </div>
    <?php $__env->stopSection(); ?>


    <?php if(config('no-captcha.login')): ?>
        <?php $__env->startPush('scripts'); ?>
            <?php echo e(no_captcha()->script()); ?>

            <?php echo e(no_captcha()->getApiScript()); ?>


            <script>
                grecaptcha.ready(() => {
                    window.noCaptcha.render('login', (token) => {
                        document.querySelector('#g-recaptcha-response').value = token;
                    });
                });
            </script>
        <?php $__env->stopPush(); ?>
    <?php endif; ?>

    <?php $__env->startPush('scripts'); ?>
        <script>
            $('.admin-login').on('click', function() {
                $('#email').val('<?php echo e(env("DEMO_ADMIN_USERNAME", "admin@demo.com")); ?>')
                $('#password').val('<?php echo e(env("DEMO_ADMIN_PASSWORD" , "12345678")); ?>')
            });

            $('.client-login').on('click', function() {
                $('#email').val('<?php echo e(env("DEMO_CLIENT_USERNAME", "client@demo.com")); ?>')
                $('#password').val('<?php echo e(env("DEMO_CLIENT_PASSWORD", "12345678")); ?>')
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts/fullLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views//auth/login.blade.php ENDPATH**/ ?>