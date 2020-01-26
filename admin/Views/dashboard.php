<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Panel - Dashboard</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Admin CMS</a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                <i class="icon-speedometer icons"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="icon-doc icons"></i> Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="icon-pencil icons"></i> Posts
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link">
                                <i class="icon-equalizer icons"></i> Settings
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="right-toolbar">
                    <a href="/admin/logout">
                        <i class="icon-logout icons"></i> Logout
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
</body>
</html>
