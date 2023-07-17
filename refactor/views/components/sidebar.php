<?php
function SideBar($content, $close) {
?>
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
<?php
}
?>