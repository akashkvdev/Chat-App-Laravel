<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
    background:#eee;    
}
.chat-list {
    padding: 0;
    font-size: .8rem;
}

.chat-list li {
    margin-bottom: 10px;
    overflow: auto;
    color: #ffffff;
}

.chat-list .chat-img {
    float: left;
    width: 48px;
}

.chat-list .chat-img img {
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    width: 100%;
}

.chat-list .chat-message {
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    background: #5a99ee;
    display: inline-block;
    padding: 10px 20px;
    position: relative;
}

.chat-list .chat-message:before {
    content: "";
    position: absolute;
    top: 15px;
    width: 0;
    height: 0;
}

.chat-list .chat-message h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
    line-height: 100%;
    font-size: .9rem;
}

.chat-list .chat-message p {
    line-height: 18px;
    margin: 0;
    padding: 0;
}

.chat-list .chat-body {
    margin-left: 20px;
    float: left;
    width: 70%;
}

.chat-list .in .chat-message:before {
    left: -12px;
    border-bottom: 20px solid transparent;
    border-right: 20px solid #5a99ee;
}

.chat-list .out .chat-img {
    float: right;
}

.chat-list .out .chat-body {
    float: right;
    margin-right: 20px;
    text-align: right;
}

.chat-list .out .chat-message {
    background: #fc6d4c;
}

.chat-list .out .chat-message:before {
    right: -12px;
    border-bottom: 20px solid transparent;
    border-left: 20px solid #fc6d4c;
}

.card .card-header:first-child {
    -webkit-border-radius: 0.3rem 0.3rem 0 0;
    -moz-border-radius: 0.3rem 0.3rem 0 0;
    border-radius: 0.3rem 0.3rem 0 0;
}
.card .card-header {
    background: #17202b;
    border: 0;
    font-size: 1rem;
    padding: .65rem 1rem;
    position: relative;
    font-weight: 600;
    color: #ffffff;
}

.content{
    margin-top:40px;    
}



    </style>
</head>
<body>
 <div class="container content">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">Chat</div>
                    <div class="card-body">
                        <ul class="chat-list" id="chat-section">
                            <!-- Chat messages will be appended here -->
                        </ul>
                    </div>
                    <div class="input-group">
                        <input type="text" id="username" value="{{ $name }}" hidden>
                        <input type="text" id="chat_message" class="form-control" placeholder="Type a message...">
                        <button class="btn btn-primary" onclick="broadcastMessage()">SEND</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/bootstrap.js')

    <script>
        setTimeout(() => {
            window.Echo.channel('chatMessage').listen('chat', (data) => {
                const username = $('#username').val();
                let newMessage = `
                    <li class="${data.username === username ? 'out' : 'in'}">
                        <div class="chat-img">
                            <img alt="Avatar" src="${data.username === username ? 'https://bootdey.com/img/Content/avatar/avatar6.png' : 'https://bootdey.com/img/Content/avatar/avatar1.png'}">
                        </div>
                        <div class="chat-body">
                            <div class="chat-message">
                                <h5>${data.username}</h5>
                                <p>${data.message}</p>
                            </div>
                        </div>
                    </li>
                `;
                $('#chat-section').append(newMessage);
            });
        }, 100);

        function broadcastMessage() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('broadCast.chat') }}",
                type: 'POST',
                data: {
                    username: $('#username').val(),
                    message: $('#chat_message').val()
                },
                success: function(result) {
                    console.log(result);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
</body>
</html>