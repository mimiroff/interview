<form class="form greetings" action="action.php" method="post">
    <div class="form_container">
        <h3 class="greetings_header"><?=$header;?></h3>
        <?php if(isset($text)):?>
            <p class="text"><?=$text?></p>
        <?php endif;?>
        <?php if(!$is_end):?>
        <input title="start" type="text" value="start" name="start" hidden>
        <button type="submit" class="button">Начать опрос</button>
        <?php endif;?>
        <?php if($is_end): ?>
            <script>
                var tm = setTimeout(function () {
                    window.close();
                    clearTimeout(tm);
                }, 3000);
            </script>
        <?php endif;?>
    </div>
