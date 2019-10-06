<?php
    session_start();

    $quote = $_SESSION['question_set'][$_SESSION['question_number']];
    $response = [];

    if ($_POST['answer'] == 'yes'){
        if($_POST['given_name'] == $quote['author_name']){
            $_SESSION['correct_answers']++;

            $_SESSION['question_set'][$_SESSION['question_number']]['status'] = 'correct';

            $response['status'] = "correct";
            $response['message'] = "<b>Correct!</b> The right answer is <b>yes</b>";
        }
        else{
            $_SESSION['question_set'][$_SESSION['question_number']]['status'] = 'wrong';

            $response['status'] = "wrong";
            $response['message'] = "<b>Sorry, you are wrong!</b> The right answer is <b>no</b>";
        }
    }

    if ($_POST['answer'] == 'no'){
        if($_POST['given_name'] != $quote['author_name']){
            $_SESSION['correct_answers']++;

            $_SESSION['question_set'][$_SESSION['question_number']]['status'] = 'correct';

            $response['status'] = "correct";
            $response['message'] = "<b>Correct!</b> The right answer is <b>no</b>";
        }
        else{
            $_SESSION['question_set'][$_SESSION['question_number']]['status'] = 'wrong';

            $response['status'] = "wrong";
            $response['message'] = "<b>Sorry, you are wrong!</b> The right answer is <b>yes</b>";
        }
    }

    $_SESSION['question_number']++;

    if($_SESSION['question_number'] > 9){
        $response['finish'] = 'finished';
    }
    echo json_encode($response);
    
    
 ?>