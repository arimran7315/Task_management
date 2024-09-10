<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <div class="main">
        <div class="row">
            <div class="login-img col-lg-8 p-5 text-center">
                <img src="assets/images/login-img.png" width="70%" alt="" />
            </div>
            <div class="col-lg-4 p-lg-5 form-login">
                <div class="container mt-5 px-5">
                    <x-form action="{{route('login.function')}}" method="POST">
                        <div class="row">
                            <h4 class="pt-5">Welcome Back</h4>
                            <p style="font-size: 0.8rem">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Repudiandae aspernatur quos sed, doloremque magnam dignissimos
                                exercitationem
                            </p>
                            <div class="form-field">
                                <div class="form-group mt-4">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email"
                                        name="email" />
                                </div>
                                <div class="form-group mt-4">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter password"
                                        name="password" />
                                </div>
                                <div class="forget-pass mt-2">
                                    <a href="">Forget Password?</a>
                                </div>
                            </div>
                            <div class="container">
                                <div class="submit-btn row mt-4">
                                    <input type="submit" class="btn btn-primary" value="Login">
                                </div>
                                <div class="submit-btn row mt-2">
                                    <a href="{{ route('register') }}" class="btn btn-primary"> Register </a>
                                </div>
                            </div>
                        </div>
                    </x-form>
                    <div class="row mt-4">
                        <div class="col">
                            <hr />
                        </div>
                        <div class="col">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        @if (session('type'))
                            <x-alert type="{{ session('type') }}" message="{{ session('message') }}"></x-alert>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
