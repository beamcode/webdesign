<?php
function Input($name = null, $required = false, $placeholder = null, $autoComplete = "on", $icon = null, $onclick = null, $class = null, $id = null, $type = 'text', $buttonType = 'button') {
?>
    <div
        class="input <?php echo $class ? $class : ''; ?>"
    >
        <input
            <?php echo $id ? 'id="' . $id . '"' : ''; ?>
            <?php echo $name ? 'name="' . $name . '"' : ''; ?>
            <?php echo $placeholder ? 'placeholder="' . $placeholder . '"' : ''; ?>
            type="<?php echo $type ?>"
            autocomplete="<?php echo $autoComplete ?>"
            <?php echo $required ? 'required' : ''; ?>
        >
        <?php
            if ($icon) {
                Button(
                    icon: $icon,
                    onclick: $onclick,
                    type: $buttonType
                );
            }
        ?>
    </div>
<?php
}
?>