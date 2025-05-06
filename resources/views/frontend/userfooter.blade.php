<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<footer class="bg-light text-dark pt-5 pb-4">
    <div class="container text-md-start">
        <div class="row">

            <!-- About Info -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">About Info</h5>
                <p class="small">
                    This is the perfect place to find a nice and cozy spot to sip some tea. You'll find the best deals here.
                </p>
                <div>
                    <a href="#" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-dark me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="/about" class="text-dark text-decoration-none">About us</a></li>
                    <li><a href="/account" class="text-dark text-decoration-none">My Account</a></li>
                    <li><a href="/login" class="text-dark text-decoration-none">Login</a></li>
                    <li><a href="/register" class="text-dark text-decoration-none">Register</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Contact</h5>
                <p class="small"><strong>Address:</strong> 123 Pall Mall, London England</p>
                <p class="small"><strong>Email:</strong> hello@example.com</p>
                <p class="small"><strong>Phone:</strong> (812) 345-6789</p>
            </div>

            <!-- Gallery -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Gallery</h5>
                <div class="row g-2">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="col-4">
                            <img src="{{ asset('images/gallery' . $i . '.jpg') }}" alt="Gallery {{ $i }}" class="img-fluid rounded">
                        </div>
                    @endfor
                </div>
            </div>

        </div>
    </div>
</footer>

</body>
</html>