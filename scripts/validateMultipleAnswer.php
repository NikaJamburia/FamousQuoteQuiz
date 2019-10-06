<?php
    session_start();

    $quote = $_SESSION['question_set'][$_SESSION['question_number']];
    $response = [];

    if ($_POST['answer'] == $quote['author_id']){

        $_SESSION['correct_answers']++;

        $_SESSION['question_set'][$_SESSION['question_number']]['status'] = 'correct';

        $response['status'] = "correct";
        $response['message'] = "<b>Correct!</b> The right answer is <b>".$quote['author_name']."</b>";

    }
    else{
        $_SESSION['question_set'][$_SESSION['question_number']]['status'] = 'wrong';

        $response['status'] = "wrong";
        $response['message'] = "<b>Sorry, you are wrong!</b> The right answer is <b>".$quote['author_name']."</b>";
    }

    $_SESSION['question_number']++;

    if($_SESSION['question_number'] > 9){
        $response['finish'] = 'finished';
    }
    echo json_encode($response);
    
    
 ?>