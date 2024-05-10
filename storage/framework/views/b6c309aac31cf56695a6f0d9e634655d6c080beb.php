<?php if(isset($pageConfigs)): ?>
<?php echo Helper::updatePageConfig($pageConfigs); ?>

<?php endif; ?>

        <!DOCTYPE html>
<?php $configData = Helper::applClasses(); ?>

<html class="loading <?php echo e(($configData['theme'] === 'light') ? '' : $configData['layoutTheme']); ?>"
      lang="<?php if(Session::has('locale')): ?><?php echo e(Session::get('locale')); ?><?php else: ?><?php echo e(config('app.locale')); ?><?php endif; ?>"
      data-textdirection="<?php echo e(env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr'); ?>"
      <?php if($configData['theme'] === 'dark'): ?> data-layout="dark-layout"<?php endif; ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="keywords" content="<?php echo e(config('app.keyword')); ?>" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(config('app.title')); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo asset(config('app.favicon')); ?>"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    
    <?php echo $__env->make('panels/styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>


<body class="vertical-layout vertical-menu-modern <?php echo e($configData['bodyClass']); ?> <?php echo e(($configData['theme'] === 'dark') ? 'dark-layout' : ''); ?> <?php echo e($configData['blankPageClass']); ?> blank-page"
      data-menu="vertical-menu-modern"
      data-col="blank-page"
      data-framework="laravel"
      data-asset-path="<?php echo e(asset('/')); ?>">

<!-- BEGIN: Content-->
<div class="app-content content <?php echo e($configData['pageClass']); ?>">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        <div class="content-body">

            
            <?php echo $__env->yieldContent('content'); ?>

        </div>
    </div>
</div>
<!-- End: Content-->


<?php echo $__env->make('panels/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
<script type="text/javascript">
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

</body>

</html>
<?php /**PATH /var/www/html/resources/views/layouts/fullLayoutMaster.blade.php ENDPATH**/ ?>