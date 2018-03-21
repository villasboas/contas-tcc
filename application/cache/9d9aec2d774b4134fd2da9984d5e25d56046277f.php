<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Office</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Office</th>
        </tr>
    </tfoot>
</table>
<?php $__env->startSection( 'scripts' ); ?>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "<?php echo e(site_url( 'home/datatables' )); ?>",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        }
    });
});
</script>
<?php $__env->stopSection(); ?>