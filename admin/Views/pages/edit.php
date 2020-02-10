<?php $this->theme->header(); ?>
<div class="container">
    <div class="col-12 mt-5">

        <?php if (\src\Helpers\Session::has('success')): ?>
            <div class="alert <?= \src\Helpers\Session::get('success', 'alert-class') ?>">
                <?= \src\Helpers\Session::flash('success', 'message') ?>
            </div>
        <?php endif; ?>

        <form action="/admin/pages/update/<?= $page['id'] ?>" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title" value="<?= $page['title'] ?>">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" class="form-control" id="content" cols="30" rows="10"><?= $page['content'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
<?php $this->theme->scripts(); ?>
<?php $this->theme->footer(); ?>

