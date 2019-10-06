<?php
    session_start();

    if($_SESSION['question_number'] > 9){?>

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

            <div class="container mt-3">
                <h2 class="text-center">Your Score: <?=$_SESSION['correct_answers']?>/10</h2>
                <hr>

                <div class="clearfix">
                    <h5 class="float-left">Quotes in this quiz:</h5>
                    <a href="../scripts/restart.php" class=" float-right btn btn-primary btn-sm">Restart Quiz</a>
                </div>

                <?php foreach($_SESSION['question_set'] as $quote){?>

                <div class="card mt-3">
                    <div class="card-header">
                        <?php
                            if($quote['status'] == 'correct'){
                                echo "<span style='color:green;'>Correct Answer</span>";
                                
                            ?>
                                <svg class="ml-3" id="i-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="25" height="25" fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="" stroke-width="3">
                                    <path d="M2 20 L12 28 30 4" />
                                </svg>
                            <?php } 
                            
                            else{
                                echo "<span style='color:red;'>Wrong Answer</span>";
                            ?>
                                <svg class="ml-3" id="i-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="25" height="25" fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
                                    <path d="M2 30 L30 2 M30 30 L2 2" />
                                </svg>
                            <?php } ?>

                    </div>
                    <div class="card-body">
                        <p><b>Quote:</b> <?=$quote['body']?></p>
                        <p><b>Author:</b> <?=$quote['author_name']?></p>

                    </div>
                </div>

                <?php } ?>
                <div class="text-center my-3">
                    <a href="../scripts/restart.php" class="btn btn-primary">Restart Quiz</a>
                </div>
            </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
        </html>
        
    <?php } 
    else{
        header('Location:../index.php');
    }
?>