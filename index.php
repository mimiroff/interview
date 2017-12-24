<?php
require_once('functions.php');
require_once('data.php');

$page_content = renderTemplate('./pages/index.php', ['header' => 'Уважаемые работники Корпорации!',
    'text' => 'Lorem ipsum dolor sit amet, consectetur
            adipisicing elit. Ad alias aperiam consequuntur debitis delectus
            deleniti distinctio dolor dolorem ducimus, enim impedit labore maiores,
            officia, porro quae repellendus tempora tenetur voluptates.',
    'is_end' => false]);
$layout_content = renderTemplate('./pages/layout.php', ['content' => $page_content]);
print($layout_content);
?>