<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat App Login</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            body {
            background-color: #f8f9fa; /* Light background */
        }
        .card {
            max-width: 400px; /* Set max width for the card */
            margin: auto; /* Center the card */
            margin-top: 100px; /* Space from the top */
            padding: 20px; /* Padding inside the card */
        }
        .card img {
            width: 60%; /* Adjust image width */
            height: auto; /* Maintain aspect ratio */
            display: block; /* Center the image */
            margin: 0 auto 20px; /* Center horizontally and add space below */
        }

        .login-button {
    color: white; /* Text color */
    width: 100%; /* Full width */
    background-color: #FB812B; /* Background color */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    padding: 10px; /* Padding for spacing */
    font-size: 18px; /* Font size */
    cursor: pointer; /* Pointer on hover */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.login-button:hover {
    background-color: #f5b98e; /* Darker shade on hover */
    color: white    
}

    </style>
    
      
</head>

<body>
    <div class="card">
        <img src="{{url('Gif/chat.gif')}}" alt="Login Image" class="card-img-top">
        <div class="card-body">
            <form method="post" action="{{route('chat')}}">
                @csrf
                <div class="mb-2">
                    <input type="text" style="border: none" class="form-control text-center" name="username" id="text" required placeholder="Enter Your Name">
                </div>
                <button type="submit" class=" login-button fw-bolder w-100" >LOGIN</button>
            </form>
            <div class="text-center mt-2">
                <a href="#">Forgot password?</a>
            </div>
        </div>
    </div>


   


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
