<?php
function SideBar($content, $close) {
    // add to give $content access to the menu
    global $view;
?>
    <div class="sidebar">
        <div class="sidebar-header">
            <?php
                Button(
                    icon: 'views/icons/close-icon.php',
                    onclick: $close
                );
            ?>
        </div>
        <div class="sidebar-content">
            <?php include $content; ?>
        </div>
    </div>
<?php
}
?>