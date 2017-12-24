<?php
require_once ('functions.php');
require_once ('data.php');
$link = mysqli_connect('interview', 'root', '', 'interview');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $counter = isset($_POST['counter']) ? $_POST['counter'] : 0;
    $next = $counter + 1;

    if (isset($_POST['start'])) {
        $question_set = get_question($link, $next);
        $question = $question_set[0]['question'];
        $type = $question_set[0]['multi'];
        $answers_set = [];
        foreach ($question_set[0] as $key => $value) {
            if (stristr($key, 'answer') && ($value != null)) {
                $answers_set[] = $value;
            };
        };
    $page_content = renderTemplate('./pages/question.php', ['question' => $question, 'answers' => $answers_set, 'counter' => $next, 'check' => ($type == 1)]);
   } else if ($_POST['counter']) {

       $answer = '';
       if(isset($_POST['radio'])) {
           $answer = $_POST['radio'][0];
       } elseif (isset($_POST['checkbox'])) {
           $answer = implode('; ', $_POST['checkbox']);
       }

       $other = (string) isset($_POST['other']) ? $_POST['other'] : '';
       $asked_question = $_POST['question'];
       $question_id = (int) get_question_id($link, $asked_question)[0]['id'];

       $sql = 'INSERT INTO results (question_id, answer, other_text) VALUES (?,?,?)';
       $stmt = mysqli_prepare($link, $sql);
       mysqli_stmt_bind_param($stmt, 'iss', $question_id, $answer, $other);
       mysqli_stmt_execute($stmt);

       if ($_POST['counter'] < (int) count_questions($link)[0]['COUNT(id)']) {
           $question_set = get_question($link, $next);
           $question = $question_set[0]['question'];
           $type = $question_set[0]['multi'];
           $answers_set = [];
           foreach ($question_set[0] as $key => $value) {
               if (stristr($key, 'answer') && ($value != null)) {
                   $answers_set[] = $value;
               };
           };
           $page_content = renderTemplate('./pages/question.php', ['question' => $question, 'answers' => $answers_set, 'counter' => $next, 'check' => ($type == 1)]);
        } else {
       $page_content = renderTemplate('./pages/index.php', ['header' => 'Спасибо за участие в опросе!', 'is_end' => true]);
        }
    }
}

$layout_content = renderTemplate('./pages/layout.php', ['content' => $page_content]);
print($layout_content);
?>