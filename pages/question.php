<form class="form question" action="action.php" method="post">
    <div class="form_container">
        <p class="text"><?=$question;?></p>
        <div class="answers_section">
            <?php for ($cur_el = 0; $cur_el < count($answers); $cur_el++): ?>
            <div class="answer_element">
                <?php $type = $check ? 'checkbox' : 'radio';?>
                <input id="answer_<?=$cur_el;?>" type="<?=$type;?>" name="<?=$type;?>[]" value="<?=$answers[$cur_el];?>" class="answers" requierd = "true" >
                <label for="answer_<?=$cur_el;?>" tabindex="0"><span class="answer_text"><?=$answers[$cur_el];?></span>
                    <span class="radio"></span>
                </label>
            </div>
            <?php endfor;?>
            <div class="other_field">
                <input id="other" type="text" name="other" class="other" title="other" required disabled>
            </div>
        </div>
        <input name="counter" title="counter" type="number" value="<?=$counter?>" hidden>
        <input name="question" title="question" type="text" value="<?=$question?>" hidden>
        <button type="submit" class="button submit">Ответить</button>
    </div>
</form>
<script type="text/javascript" src="../js/form.js"></script>
