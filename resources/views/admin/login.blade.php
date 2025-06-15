<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fc;
        }
        .login-container {
            margin-top: 80px;
        }
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <h4 class="text-primary"><i class="fas fa-user-shield"></i> Admin Login</h4>
                </div>
                <form method="POST" action="admin/login">
                    <!-- CSRF untuk Laravel -->
                    @csrf
                    <div class="form-group">
                        <label for="username"><i class="fas fa-user"></i> Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Masuk</button>
                </form>
                <hr>
                <div class="text-center">
                    <a href="/" class="small"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
