<?php $this->theme->header(); ?>
<div class="container">
    <div class="col-12 mt-5">

        <?php if (\src\Helpers\Session::has('success')): ?>
            <div class="alert <?= \src\Helpers\Session::get('success', 'alert-class') ?>">
                <?= \src\Helpers\Session::get('success', 'message') ?>
            </div>
        <?php endif; ?>

        <form action="/admin/pages/store" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
    </div>
</div>
<?php $this->theme->scripts(); ?>
<?php $this->theme->footer(); ?>

