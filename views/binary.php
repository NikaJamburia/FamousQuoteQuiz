<?php
    session_start();
    include_once "../config/Database.php";
    include_once "../models/Quote.php";
    include_once "../models/Author.php";

    $database = new Database();
    $db = $database->connect();

    if (!isset($_SESSION['mode']) || $_SESSION['mode'] == 'multiple'){

        $_SESSION['mode'] = 'binary';
        $_SESSION['question_number'] = 0;
        $_SESSION['correct_answers'] = 0;

        $quote = new Quote($db);
        $_SESSION['question_set'] = $quote->randomQuotes();

    }
    $quote = $_SESSION['question_set'][$_SESSION['question_number']];

    $author = new Author($db);
    $wrong_author = $author->binary_IncorrectAnswer($quote['author_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body>

    <?php 
        include_once "../includes/navbar.html";
    ?>


    <div class="container">

        <div id="messageBox"></div>

        <div class="card mt-2">
            <div class="card-head">
                <h3 class="card-header">Question <?=$_SESSION['question_number']+1?>/10</h3>
            </div>
            <div class="card-body">
                <p>"<?=$quote['body']?>"</p>
                <p>Is the author of this quote 
                    <?php 
                        if(mt_rand(0,1) == 0){
                            $given_name = $quote['author_name'];
                            echo $given_name." "; 
                        }
                        else{
                            $given_name = $wrong_author['name'];
                            echo $given_name." ";
                        } 
                    ?> 
                ?</p>

                <form action="../scripts/validateBinaryAnswer.php" method="post" class="form">
                    <input type="radio" name="answer" value="yes" id="yes" class="">
                    <label for="yes">- Yes</label>
                    <br>
                    <input type="radio" name="answer" value="no" id="no" class="">
                    <label for="no">- no</label>
                    <br>
                    <div id="error"></div>

                    <div id="buttonBox">
                        <input type="submit" id="submit" value="Confirm Answer" class="btn btn-success mt-3">
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>

        document.getElementById('submit').addEventListener('click', function(e){
            e.preventDefault();

            if(!document.getElementById('yes').checked && !document.getElementById('no').checked ){
                document.getElementById('error').innerHTML = "<p style='color:red'>Chose one of the answers first</p>";
                return 0;
            }
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../scripts/validateBinaryAnswer.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
            if(document.getElementById('yes').checked){
                answer = 'yes';
            }
            if(document.getElementById('no').checked){
                answer = 'no';
            }


            var params = "answer="+answer+"&quote_id="+<?=$quote['id']?>+"&given_name="+"<?=$given_name?>";
            
            xhr.onload = function(){
                if(this.status == 200){
                    response = JSON.parse(this.responseText);

                    if(response.status == 'correct'){
                        document.getElementById('messageBox').innerHTML = "<div class='alert alert-success mt-2'>"+response.message+"</div>";
                    }
                    else{
                        document.getElementById('messageBox').innerHTML = "<div class='alert alert-danger mt-2'>"+response.message+"</div>";
                    }

                    document.getElementById('yes').setAttribute('disabled', true);
                    document.getElementById('no').setAttribute('disabled', true);
                    document.getElementById('error').innerHTML = "";

                    if(typeof response.finish !== 'undefined'){
                        document.getElementById('buttonBox').innerHTML = "<a href='statistics.php' class='btn btn-primary mt-3'> Finish the quiz </a>";
                    }
                    else{
                        document.getElementById('buttonBox').innerHTML = "<a href='' class='btn btn-primary mt-3'> Next quote </a>";
                    }
                    
                }
            }
        
            xhr.send(params);
        });
    </script>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>