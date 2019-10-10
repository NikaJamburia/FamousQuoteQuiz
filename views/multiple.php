<?php
    session_start();
    include_once "../config/Database.php";
    include_once "../models/Quote.php";
    include_once "../models/Author.php";

    $database = new Database();
    $db = $database->connect();

    if (!isset($_SESSION['mode']) || $_SESSION['mode'] == 'binary'){
        
        $_SESSION['mode'] = 'multiple';
        $_SESSION['question_number'] = 0;
        $_SESSION['correct_answers'] = 0;

        $quote = new Quote($db);

        $_SESSION['question_set'] = $quote->randomQuotes();

    }

    $quote = $_SESSION['question_set'][$_SESSION['question_number']];

    if(!isset($quote['wrong_authors'])){
        $author = new Author($db);
        $_SESSION['question_set'][$_SESSION['question_number']]['wrong_authors'] = $author->multiple_IncorrectAnswers($quote['author_id']);
    }

    $wrong_authors = $_SESSION['question_set'][$_SESSION['question_number']]['wrong_authors'];

    $variants[0] = ['id' => $quote['author_id'], 'name' => $quote['author_name']];
    $variants[1] = ['id' => $wrong_authors[0]['id'], 'name' => $wrong_authors[0]['name']];
    $variants[2] = ['id' => $wrong_authors[1]['id'], 'name' => $wrong_authors[1]['name']];
    shuffle($variants);

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
                <p>Who does this quote belong to?</p>

                <form action="../scripts/validateMultipleAnswer.php" method="post" class="form">
                <?php 
                    foreach($variants as $variant){ ?>
                    <input type="radio" name="answer" id="<?=$variant['id']?>" value="<?=$variant['id']?>" class="answerRadio">
                    <label for="<?=$variant['id']?>">- <?=$variant['name']?></label>
                    <br>
                <?php } ?>
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

            checked = false;
            answer = "";
            radios = document.getElementsByClassName('answerRadio');
            for(const i of radios){
                if(i.checked){
                    answer = i.value;
                    checked = true;
                    break;
                }
            }

            console.log(checked);
            if(!checked){
                document.getElementById('error').innerHTML = "<p style='color:red'>Chose one of the answers first</p>";
                return 0;
            }
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../scripts/validateMultipleAnswer.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
            var params = "answer="+answer;
            
            xhr.onload = function(){
                if(this.status == 200){
                    response = JSON.parse(this.responseText);

                    if(response.status == 'correct'){
                        document.getElementById('messageBox').innerHTML = "<div class='alert alert-success mt-2'>"+response.message+"</div>";
                    }
                    else{
                        document.getElementById('messageBox').innerHTML = "<div class='alert alert-danger mt-2'>"+response.message+"</div>";
                    }

                    for(const i of radios){
                        i.setAttribute('disabled', true);
                    }
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