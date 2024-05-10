<!-- BEGIN: Vendor JS-->
<script src="<?php echo e(asset(mix('vendors/js/vendors.min.js'))); ?>"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo e(asset(mix('vendors/js/ui/jquery.sticky.js'))); ?>"></script>
<?php echo $__env->yieldContent('vendor-script'); ?>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo e(asset(mix('js/core/app-menu.js'))); ?>"></script>
<script src="<?php echo e(asset(mix('js/core/app.js'))); ?>"></script>

<!-- custom scripts file for user -->
<script src="<?php echo e(asset(mix('js/core/scripts.js'))); ?>"></script>

<!-- END: Theme JS-->


<script src="<?php echo e(asset(mix('vendors/js/extensions/toastr.min.js'))); ?>"></script>
<script>
    $(document).ready(function() {
        "use strict";

        var isRtl = $('html').attr('data-textdirection') === 'rtl';

        //show response message
        window.showResponseMessage = function(data, dataListView = null) {
            if (data.status === 'success') {
                toastr['success'](data.message, '<?php echo e(__('locale.labels.success')); ?>!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });
                if (dataListView) dataListView.draw();
            } else if (data.status === 'error') {
                toastr['warning'](data.message, '<?php echo e(__('locale.labels.attention')); ?>', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });
            } else if (data.status) {
                toastr['warning'](data.message, '<?php echo e(__('locale.labels.attention')); ?>', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });
                if (dataListView) dataListView.draw();
            } else {
                toastr['warning']("<?php echo e(__('locale.exceptions.something_went_wrong')); ?>",
                    '<?php echo e(__('locale.labels.warning')); ?>!', {
                        closeButton: true,
                        positionClass: 'toast-top-right',
                        progressBar: true,
                        newestOnTop: true,
                        rtl: isRtl
                    });
            }
        }

        //show error message
        window.showResponseError = function(reject) {
            try {
                if (reject.status === 422) {
                    let errors = reject.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        toastr['warning'](value[0],
                            "<?php echo e(__('locale.labels.attention')); ?>", {
                                closeButton: true,
                                positionClass: 'toast-top-right',
                                progressBar: true,
                                newestOnTop: true,
                                rtl: isRtl
                            });
                    });
                } else {
                    toastr['warning'](reject.responseJSON.message,
                        "<?php echo e(__('locale.labels.attention')); ?>", {
                            positionClass: 'toast-top-right',
                            progressBar: true,
                            newestOnTop: true,
                            rtl: isRtl
                        });
                }
            } catch (error) {
                var message = String(error);
                toastr['error'](message,
                    "<?php echo e(__('locale.labels.attention')); ?>", {
                        positionClass: 'toast-top-right',
                        progressBar: true,
                        newestOnTop: true,
                        rtl: isRtl
                    });
            }
        }
    });
</script>


<?php echo $__env->yieldContent('page-script'); ?>
<script>
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
</script>

<?php if(Session::has('message')): ?>
    <div id="session_message"><?php echo e(Session::get('message')); ?></div>
    <script>
        "use strict";
        var message = $('#session_message').html();
        $('#session_message').remove();
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        let type = "<?php echo e(Session::get('status', 'success')); ?>";
        
        switch (type) {
            case 'info':
                toastr['info'](message , "<?php echo e(__('locale.labels.information')); ?>!", {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });

                break;

            case 'warning':
                toastr['warning'](message, '<?php echo e(__("locale.labels.warning")); ?>!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });
                break;

            case 'success':
                toastr['success'](message, '<?php echo e(__("locale.labels.success")); ?>!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });
                break;

            case 'error':
                toastr['error'](message, '<?php echo e(__("locale.labels.ops")); ?>..!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    rtl: isRtl
                });
                break;
        }
    </script>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/panels/scripts.blade.php ENDPATH**/ ?>