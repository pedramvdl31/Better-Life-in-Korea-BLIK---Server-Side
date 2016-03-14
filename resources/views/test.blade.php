@extends('layouts.default')

@section('content')
    <p id="power">0</p>
@stop

@section('footer')
    <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
    <script>
        //var socket = io('http://localhost:3000');
        var socket = io('http://192.168.10.10:3000');
        socket.emit("register", { user_id: "999" });
        // var socket = io.connect('http://192.168.10.10:3000');
        socket.on("test-channel:App\\Events\\EventName", function(message){
        // increase the power everytime we load test route
        $('#power').text(message.data.power);
        });
    </script>
@stop