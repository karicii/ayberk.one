<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <h1><?= $pageTitle ?></h1>
    <form class="admin-form" action="/admin/posts" method="POST">
        <div class="form-group">
            <button type="submit" class="button button-primary">Kaydet</button>
        </div>
    </form>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>