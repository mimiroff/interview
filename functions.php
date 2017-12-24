<?php

function renderTemplate ($template_path, $data) {
    if(is_file($template_path)) {
        foreach($data as $key => $value) {
            ${$key} = $value;
        }
        ob_start();
        require_once($template_path);
        return ob_get_clean();        
        } else {
            return '';
        }
};

function get_question($link, $num) {
    $sql = 'SELECT * FROM questions WHERE id = ' .$num;
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return false;
    }
};

function count_questions($link) {
    $sql = 'SELECT COUNT(id) FROM questions';
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return false;
    }
};

function get_question_id($link, $text) {
    $sql = 'SELECT id FROM questions WHERE question = "' .$text.'"';
    $result = mysqli_query($link, $sql);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return false;
    }
};

 ?>