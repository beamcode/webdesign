<?php
function Button($text = null, $icon = null, $class = null, $id = null, $name = null, $onclick = null, $type = 'button') {
?>
    <button
        class="button <?php echo $icon ? 'icon' : ''; echo $class ? $class : ''; ?>"
        <?php echo $id ? 'id="' . $id . '"' : ''; ?>
        type="<?php echo $type ?>"
        <?php echo $name ? 'name="' . $name . '"' : ''; ?>
        <?php echo $onclick ? 'onclick="' . $onclick . '"' : ''; ?>
    >
        <?php 
        if ($text) {
            echo $text;
        }
        if ($icon) {
            include $icon;
        }
        ?>
    </button>
<?php
}
?>
