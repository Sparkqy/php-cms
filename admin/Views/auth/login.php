<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login to CMS</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <form class="form-signin" role="form" action="/admin/auth" method="post">
        <h2 class="form-signin-heading">Login to CMS</h2>
        <?php if (\src\Helpers\Session::has('error')): ?>
            <div class="alert <?= \src\Helpers\Session::flash('error', 'type', false) ?>">
                <?= \src\Helpers\Session::flash('error', 'message') ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="email">Ваш Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Ваш пароль:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="remember_me" name="remember_me" class="form-check-inline">
            <label for="remember_me" class="form-check-label">Remember me</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
</div>
</body>
</html>