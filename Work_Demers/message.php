<?php
if(isset($_SESSION['message']))
{
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">

        <span> <i class="bi bi-exclamation-octagon"></i> <?= $_SESSION['message']; ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
    <?php
    unset($_SESSION['message']);
}
?>