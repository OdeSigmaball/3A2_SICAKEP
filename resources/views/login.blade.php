
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="../css/login.css">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="sb-admin-2.min.css" rel="stylesheet">
  <link href="body.css" rel="stylesheet">

  <!-- Bootstrap and Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    body {
      background-image: url('../images/background.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
    .login-card {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      margin: auto;
    }
    .img {

    }
  </style>
</head>

<body>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div>
      <div class="mb-4 text-center title-section">
        <img src="../images/Logo Tut Wuri Handayani.png" alt="Tut Wuri Handayani Logo" class="w-8" width="150">
        <img src="../images/Logo Dinas Pendidikan Kabupaten Bangli.png" alt="Tut Wuri Handayani Logo" class="w-8 mr-1" width="150">
        <img src="../images/Logo BPMP.png" alt="BPMP Logo" class="w-10 mr-1" width="150">

        <h3 class="font-weight-bold">Sistem Informasi Capaian Kinerja dan Realisasi Program</h3>
        <h5 style="font-weight: bold;">("SICAKEP")</h5>
        <h5>Dinas Pendidikan Kepemudaan dan Olahraga Kabupaten Bangli</h5>
      </div>


        @if($errors->any())
        <div class="mt-1 alert alert-danger alert-dismissible fade show text-decoration-none" role="alert">
            <ul>
                @foreach ($errors->all() as $error )
                    <li class="text-decoration-none">{{$error}}</li>
                @endforeach
            </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="px-5">
        <div class="px-5">
          <div class="card login-card">
            <h4 class="mb-3 text-center fw-bold">Login</h4>
            <form method="post" action="{{ route('login') }}">
              @csrf
              <div class="p-4">
                <div class="mb-3 text-start">
                  <label for="username" class="form-label font-weight-bold">Username</label>
                  <input type="text" id="username" class="form-control" placeholder="Masukkan username Anda" name="username">
                </div>
                <div class="mb-3 text-start">
                  <label for="password" class="form-label font-weight-bold">Password</label>
                  <div class="input-group">
                    <input type="password" id="password" class="form-control" placeholder="Masukkan password Anda" name="password">
                    <button class="btn btn-outline-secondary" type="button">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
