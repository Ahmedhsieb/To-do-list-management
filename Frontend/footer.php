<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>

<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script>
    $('#btn-update-notes').on('click', function (event) {
        $('#notesMailModal').modal('show');
        $('#btn-n-save').hide();
        $('#btn-n-add').show();
    });
    $('.action-dropdown .dropdown-menu .edit.dropdown-item').click(function () {

        event.preventDefault();

        var $_outerThis = $(this);

        $('.add-tsk').hide();
        $('.edit-tsk').show();
    });
</script>
<?php if (isset($_GET['id'])): ?>
    <script>
        $('#notesMailModal').modal('show');
        $('.edit-tsk').show();
    </script>
<?php endif; ?>


<script src="assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/js/ie11fix/fn.fix-padStart.js"></script>
<script src="assets/js/apps/notes.js"></script>
<script src="plugins/editors/quill/quill.js"></script>
<script src="assets/js/apps/todoList.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>