<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAM - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo-merch-light.png') }}" type="image/x-icon">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <form action="{{ url('register') }}" method="POST" style="min-width: 400px;">
            @csrf
            <div class="card p-4 d-flex d-column justify-content-center">
                <a href="#" onclick="history.back()" class="text-success small"><i class="fas fa-chevron-left"></i></a>
                <div class="d-flex flex-column gap-2 justify-content-center my-3 align-items-center">
                    <img src="{{ asset('images/logo-merch-light.png') }}" alt="" style="width:100px;">
                    <label class="text-muted">Sign Up</label>
                </div>

                @if (Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{Session::get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="email" class="form-label">Fullname</label>
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    @if($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    @if($errors->has('password'))
                        <div class="text-danger">{{ $errors->first('password') }}</div>
                    @endif
                    <div class="input-group">
                        <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="password">
                        <span class="input-group-append">
                            <button type="button" id="togglePassword" class="btn btn-outline-secondary border-start-0 border ms-n3">
                                <i id="icon" class="fa fa-eye-slash"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <button class="btn btn-sm btn-success px-3" type="submit">
                        Next
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script>
    const togglePassword = document
        .querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const icon = document.getElementById('icon');
    togglePassword.addEventListener('click', () => {
        const type = password
            .getAttribute('type') === 'password' ?
            'text' : 'password';
        password.setAttribute('type', type);
        icon.classList.toggle('fa-eye');
    });
</script>

</body>
</html>