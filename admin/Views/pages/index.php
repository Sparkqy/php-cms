<?php $this->theme->header(); ?>
<div class="container">
    <div class="col-12">
        <a href="/admin/pages/create" class="btn btn-primary my-3">Create new page</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Created at</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($pages !== null): ?>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <th scope="row"><?= $page['id'] ?></th>
                        <td><?= $page['title'] ?></td>
                        <td><?= $page['created_at'] ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $this->theme->footer(); ?>

