<?php
date_default_timezone_set('Europe/Moscow');
require "../app.php";

use Controllers\IndexController;

if(!empty($_GET['route'])){
    switch ($_GET['route']){
        case 'check_winner':
            (new IndexController)->checkWinner();
            break;
    }
}
$data = (new IndexController)->index();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

<div class="container">

    <div class="card mt-5">
        <div class="card-body row">
            <div class="col-md-4 row">
                <div class="col-md-9">
                    <button class="btn btn-success " id="runEvent">Учавствовать</button>
                </div>
                <div class="col-md-3">
                    <div class="spinner-border position-fixed " id="loader" style="display: none" role="status">
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <span id="result" style="display: none"></span>
            </div>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $("#runEvent").on('click', function (){
        $('#loader').show();
        $.ajax({
            url: '/index.php?route=check_winner',
            method: 'get',
            dataType: 'html',
            data: {text: 'Текст'},
            success: function(data){
                let response = JSON.parse(data);
                let resultObj = $('#result');
                resultObj.removeClass()
                resultObj.show();
                if(response.participated){
                    console.log(response.result)
                    let text = 'Сегодня вы уже участвовали и вы' + (response.result ? ' выиграли !!!' : ' не выиграли :(')
                    resultObj.text(text);
                    resultObj.addClass('text-secondary');
                }else if(response.result){
                    resultObj.text('Вы победили!!!');
                    resultObj.addClass('text-success');
                }else{
                    resultObj.text('Вы не выиграли :(');
                    resultObj.addClass('text-danger');
                }
            }
        }).done(function (){
            $('#loader').hide();
        });

    });
</script>


</body>
</html>
