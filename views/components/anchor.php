<?php
function Anchor($text = null, $icon = null, $class = null, $id = null,  $link = null) {
?>
    <a
        class="anchor <?php echo $icon ? 'icon ' : ' '; echo $class ? $class : ''; ?>"
        <?php echo $id ? 'id="' . $id . '"' : ''; ?>
        <?php echo $link ? 'href="' . $link . '"' : ''; ?>
    >
        <?php 
        if ($icon) {
            include $icon;
        }
        if ($text) {
            echo $text;
        }
        ?>
    </a>
<?php
}
?>
