<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HEY!</title>

    <!-- bootstrap style -->
    <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,400&display=swap"
        rel="stylesheet">

    <!-- own style -->
    <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center ">
            <div class="col-12 col-md-8 text-center">
                <img class="position-relative" width="100px" src="{{ URL::asset('img/website/logo/lam_logo.svg') }}"
                    alt="" style="bottom: -20px">
                <img class="img-fluid p-md-2 mb-3" width="500px"
                    src="{{ URL::asset('img/dashboard/undraw_stars_re_6je7.svg') }}" alt="">
                <h1 class="main-color fw-bold">Opps!</h1>
                <h4 class="text-gray-300 fw-light">Sorry, the page is not found</h4>
            </div>
        </div>
    </div>

</body>

</html>