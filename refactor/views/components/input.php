<?php
function Input($placeholder = null, $child = null, $class = null, $id = null, $type = 'text') {
?>
    <div
        class="input <?php echo $class ? $class : ''; ?>"
        <?php echo $id ? 'id="' . $id . '"' : ''; ?>
    >
        <input
            <?php echo $placeholder ? 'placeholder="' . $placeholder . '"' : ''; ?>
            type="<?php echo $type ?>"
        >
        <?php 
            if ($child) {
                include $child;
            }
        ?>
    </div>
<?php
}
?>