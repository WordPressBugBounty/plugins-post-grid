<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/
if (!defined('ABSPATH')) exit;  // if direct access
class class_post_grid_settings
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'post_grid_menu_init'));
        //add_action('admin_menu', array($this, '_access_non_admin'));
    }
    public function _access_non_admin()
    {
        if (!current_user_can('administrator')) :
            remove_menu_page('edit.php?post_type=post_grid');
            remove_menu_page('post-new.php?post_type=post_grid');
            remove_menu_page('edit.php?post_type=post_grid_templates');
            remove_menu_page('edit.php?post_type=post_grid_layout');
        endif;
    }
    public function post_grid_menu_init()
    {
        if (!current_user_can('administrator')) return;
        $post_grid_info = get_option('post_grid_info');
        $data_update_status = isset($post_grid_info['data_update_status']) ? $post_grid_info['data_update_status'] : 'pending';
        // add_menu_page(__('Combo Blocks', 'post-grid'), __('Combo Blocks', 'post-grid'), 'manage_options', 'post-grid', array($this, 'post_grid'), 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMzYiIGhlaWdodD0iMzYiIHZpZXdCb3g9IjAgMCAzNiAzNiIgdmVyc2lvbj0iMS4xIj4KPGcgaWQ9InN1cmZhY2UxIj4KPHBhdGggc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigwJSwwJSwwJSk7ZmlsbC1vcGFjaXR5OjE7IiBkPSJNIDYuOTYwOTM4IDQuNzUzOTA2IEMgNS45MDYyNSA1LjA0Mjk2OSA1LjE0ODQzOCA1Ljg5ODQzOCA0Ljk5MjE4OCA2Ljk2ODc1IEMgNC45MDIzNDQgNy41OTM3NSA0LjkwNjI1IDEzLjcwMzEyNSA1IDE0LjI3MzQzOCBDIDUuMTQwNjI1IDE1LjE2MDE1NiA1LjcxNDg0NCAxNS45MTc5NjkgNi41MjM0MzggMTYuMjk2ODc1IEwgNi45MjU3ODEgMTYuNDg4MjgxIEwgMTUuMTUyMzQ0IDE2LjQ4ODI4MSBMIDE1LjU1NDY4OCAxNi4yOTY4NzUgQyAxNi4wNzQyMTkgMTYuMDU4NTk0IDE2LjYyMTA5NCAxNS41MTE3MTkgMTYuODU5Mzc1IDE0Ljk5MjE4OCBMIDE3LjA1MDc4MSAxNC41ODk4NDQgTCAxNy4wNTA3ODEgNi41NzQyMTkgTCAxNi44MjQyMTkgNi4xNDQ1MzEgQyAxNi41NDI5NjkgNS42MDU0NjkgMTUuOTQ1MzEyIDUuMDU0Njg4IDE1LjQxNDA2MiA0LjgzNTkzOCBDIDE1LjAxMTcxOSA0LjY3NTc4MSAxNS4wMTE3MTkgNC42NzU3ODEgMTEuMTc5Njg4IDQuNjYwMTU2IEMgNy45NjQ4NDQgNC42NDg0MzggNy4yODUxNTYgNC42NjAxNTYgNi45NjA5MzggNC43NTM5MDYgWiBNIDE0LjY5NTMxMiA2Ljc4NTE1NiBDIDE0LjgwODU5NCA2LjgzOTg0NCAxNC45MzM1OTQgNi45NTMxMjUgMTQuOTc2NTYyIDcuMDIzNDM4IEMgMTUuMDE5NTMxIDcuMTE3MTg4IDE1LjA0Njg3NSA4LjM4NjcxOSAxNS4wNDY4NzUgMTAuNjM2NzE5IEwgMTUuMDQ2ODc1IDE0LjExMzI4MSBMIDE0Ljg2MzI4MSAxNC4zMDA3ODEgTCAxNC42NzU3ODEgMTQuNDg0Mzc1IEwgMTEuMDQ2ODc1IDE0LjQ4NDM3NSBDIDcuMDAzOTA2IDE0LjQ4NDM3NSA3LjE3MTg3NSAxNC41MDM5MDYgNy4wMzEyNSAxNC4wMDc4MTIgQyA2Ljk4ODI4MSAxMy44NDM3NSA2Ljk2MDkzOCAxMi41MzEyNSA2Ljk2MDkzOCAxMC41NDY4NzUgQyA2Ljk2MDkzOCA3LjY0NDUzMSA2Ljk3NjU2MiA3LjMyODEyNSA3LjA4NTkzOCA3LjEwMTU2MiBDIDcuMTUyMzQ0IDYuOTY4NzUgNy4yODUxNTYgNi44MjAzMTIgNy4zODI4MTIgNi43Njk1MzEgQyA3LjUxNTYyNSA2LjY5OTIxOSA4LjM5NDUzMSA2LjY3OTY4OCAxMS4wMjM0MzggNi42Nzk2ODggQyAxMy45NzY1NjIgNi42Nzk2ODggMTQuNTE5NTMxIDYuNjk1MzEyIDE0LjY5NTMxMiA2Ljc4NTE1NiBaIE0gMTQuNjk1MzEyIDYuNzg1MTU2ICIvPgo8cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gMjAuMTQ0NTMxIDQuNzgxMjUgQyAxOS40MjE4NzUgNS4xNDA2MjUgMTkuMzk4NDM4IDYuMjA3MDMxIDIwLjEwOTM3NSA2LjU3NDIxOSBDIDIwLjQxMDE1NiA2LjczMDQ2OSAzMC44MTY0MDYgNi43MzA0NjkgMzEuMTgzNTk0IDYuNTgyMDMxIEMgMzEuNzEwOTM4IDYuMzU1NDY5IDMxLjkwMjM0NCA1LjUxMTcxOSAzMS41MTk1MzEgNS4wNTQ2ODggQyAzMS4xNTYyNSA0LjYyNSAzMS4zNjcxODggNC42NDA2MjUgMjUuNjQ4NDM4IDQuNjQwNjI1IEMgMjAuNTc0MjE5IDQuNjQwNjI1IDIwLjQxNzk2OSA0LjY0ODQzOCAyMC4xNDQ1MzEgNC43ODEyNSBaIE0gMjAuMTQ0NTMxIDQuNzgxMjUgIi8+CjxwYXRoIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMCUsMCUsMCUpO2ZpbGwtb3BhY2l0eToxOyIgZD0iTSAyMC4yODUxNTYgOS42NDA2MjUgQyAxOS44MzU5MzggOS43ODEyNSAxOS42MDE1NjIgMTAuMTE3MTg4IDE5LjYwMTU2MiAxMC42MTcxODggQyAxOS42MDE1NjIgMTEuMDIzNDM4IDE5LjczMDQ2OSAxMS4yNjU2MjUgMjAuMDU4NTk0IDExLjQ2MDkzOCBDIDIwLjI3NzM0NCAxMS41OTM3NSAyMC40NTMxMjUgMTEuNjAxNTYyIDI1LjY2NDA2MiAxMS42MDE1NjIgQyAzMC44NzUgMTEuNjAxNTYyIDMxLjA1MDc4MSAxMS41OTM3NSAzMS4yNjk1MzEgMTEuNDYwOTM4IEMgMzEuNTk3NjU2IDExLjI2NTYyNSAzMS43MzA0NjkgMTAuOTUzMTI1IDMxLjY5NTMxMiAxMC40OTYwOTQgQyAzMS42NjAxNTYgMTAuMDU0Njg4IDMxLjQxNDA2MiA5Ljc0NjA5NCAzMS4wMTU2MjUgOS42MzI4MTIgQyAzMC42OTE0MDYgOS41NDI5NjkgMjAuNTgyMDMxIDkuNTQ2ODc1IDIwLjI4NTE1NiA5LjY0MDYyNSBaIE0gMjAuMjg1MTU2IDkuNjQwNjI1ICIvPgo8cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gMjAuMzIwMzEyIDE0LjU1NDY4OCBDIDIwLjAxOTUzMSAxNC42MjUgMTkuNjI1IDE1LjA0Njg3NSAxOS42MDE1NjIgMTUuMzA4NTk0IEMgMTkuNTc0MjE5IDE1Ljg5MDYyNSAxOS42ODc1IDE2LjE1NjI1IDIwLjA1ODU5NCAxNi4zODI4MTIgQyAyMC4yNzczNDQgMTYuNTE1NjI1IDIwLjQ1MzEyNSAxNi41MjM0MzggMjUuNjY0MDYyIDE2LjUyMzQzOCBDIDMwLjg3NSAxNi41MjM0MzggMzEuMDUwNzgxIDE2LjUxNTYyNSAzMS4yNjk1MzEgMTYuMzgyODEyIEMgMzEuODcxMDk0IDE2LjAxNTYyNSAzMS44NTkzNzUgMTUuMDQ2ODc1IDMxLjIzODI4MSAxNC42NDQ1MzEgQyAzMS4wNjI1IDE0LjUyNzM0NCAzMC43MzQzNzUgMTQuNTE5NTMxIDI1LjgwNDY4OCAxNC41MDM5MDYgQyAyMi45MjE4NzUgMTQuNSAyMC40NTMxMjUgMTQuNTE5NTMxIDIwLjMyMDMxMiAxNC41NTQ2ODggWiBNIDIwLjMyMDMxMiAxNC41NTQ2ODggIi8+CjxwYXRoIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMCUsMCUsMCUpO2ZpbGwtb3BhY2l0eToxOyIgZD0iTSA1LjQzMzU5NCAxOS42MTcxODggQyA1LjEwNTQ2OSAxOS44MTI1IDQuOTc2NTYyIDIwLjA1NDY4OCA0Ljk3NjU2MiAyMC40Njg3NSBDIDQuOTc2NTYyIDIwLjg1NTQ2OSA1LjA5NzY1NiAyMS4wNzgxMjUgNS40NDE0MDYgMjEuMzMyMDMxIEMgNS42MzI4MTIgMjEuNDgwNDY5IDUuNjg3NSAyMS40ODA0NjkgMTEuMDMxMjUgMjEuNDgwNDY5IEMgMTYuMTA5Mzc1IDIxLjQ4MDQ2OSAxNi40MzM1OTQgMjEuNDcyNjU2IDE2LjYxMzI4MSAyMS4zNTU0NjkgQyAxNy4yMzQzNzUgMjAuOTUzMTI1IDE3LjI0NjA5NCAxOS45ODQzNzUgMTYuNjQ0NTMxIDE5LjYxNzE4OCBDIDE2LjQyNTc4MSAxOS40ODQzNzUgMTYuMjUgMTkuNDc2NTYyIDExLjAzOTA2MiAxOS40NzY1NjIgQyA1LjgyODEyNSAxOS40NzY1NjIgNS42NTIzNDQgMTkuNDg0Mzc1IDUuNDMzNTk0IDE5LjYxNzE4OCBaIE0gNS40MzM1OTQgMTkuNjE3MTg4ICIvPgo8cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gMjEuMjk2ODc1IDE5LjYzNjcxOSBDIDIwLjYwOTM3NSAxOS45MjU3ODEgMjAuMTg3NSAyMC4zMTI1IDE5Ljg2MzI4MSAyMC45NTMxMjUgQyAxOS41NjY0MDYgMjEuNTM1MTU2IDE5LjUzMTI1IDIyLjAyNzM0NCAxOS41NjI1IDI1Ljc1IEMgMTkuNTgyMDMxIDI5LjEwOTM3NSAxOS41ODk4NDQgMjkuMjMwNDY5IDE5LjczODI4MSAyOS41ODU5MzggQyAyMC4wMjM0MzggMzAuMzA0Njg4IDIwLjU5Mzc1IDMwLjg3NSAyMS4zMjAzMTIgMzEuMTY3OTY5IEMgMjEuNjgzNTk0IDMxLjMyNDIxOSAyMS43NDYwOTQgMzEuMzI0MjE5IDI1LjY2NDA2MiAzMS4zMjQyMTkgTCAyOS42MzY3MTkgMzEuMzI0MjE5IEwgMzAuMDM5MDYyIDMxLjE2NDA2MiBDIDMwLjU3MDMxMiAzMC45NDUzMTIgMzEuMTY3OTY5IDMwLjM5NDUzMSAzMS40NDkyMTkgMjkuODU1NDY5IEwgMzEuNjc1NzgxIDI5LjQyNTc4MSBMIDMxLjY3NTc4MSAyMS40MTAxNTYgTCAzMS40OTIxODggMjEuMDIzNDM4IEMgMzEuMjE4NzUgMjAuNDQ1MzEyIDMwLjc5Njg3NSAyMC4wMTE3MTkgMzAuMjUgMTkuNzQyMTg4IEwgMjkuNzc3MzQ0IDE5LjUxMTcxOSBMIDI1LjczNDM3NSAxOS40OTYwOTQgTCAyMS42OTE0MDYgMTkuNDc2NTYyIFogTSAyOS40ODgyODEgMjEuNjk5MjE5IEwgMjkuNjcxODc1IDIxLjg4NjcxOSBMIDI5LjY3MTg3NSAyNS4zNjMyODEgQyAyOS42NzE4NzUgMjcuNjEzMjgxIDI5LjY0NDUzMSAyOC44ODI4MTIgMjkuNjAxNTYyIDI4Ljk3NjU2MiBDIDI5LjQxNzk2OSAyOS4zMTI1IDI5LjM1NTQ2OSAyOS4zMjAzMTIgMjUuNjQ4NDM4IDI5LjMyMDMxMiBDIDIzLjAxOTUzMSAyOS4zMjAzMTIgMjIuMTQwNjI1IDI5LjMwMDc4MSAyMi4wMDc4MTIgMjkuMjMwNDY5IEMgMjEuOTEwMTU2IDI5LjE3OTY4OCAyMS43NzczNDQgMjkuMDMxMjUgMjEuNzEwOTM4IDI4Ljg5ODQzOCBDIDIxLjYwMTU2MiAyOC42NzE4NzUgMjEuNTg1OTM4IDI4LjM1NTQ2OSAyMS41ODU5MzggMjUuMzk4NDM4IEMgMjEuNTg1OTM4IDIxLjk1NzAzMSAyMS42MDE1NjIgMjEuNzc3MzQ0IDIxLjkxNzk2OSAyMS41OTM3NSBDIDIyIDIxLjU0Mjk2OSAyMy4yMjI2NTYgMjEuNTIzNDM4IDI1LjY3MTg3NSAyMS41MTU2MjUgTCAyOS4zMDA3ODEgMjEuNTE1NjI1IFogTSAyOS40ODgyODEgMjEuNjk5MjE5ICIvPgo8cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gNS40MzM1OTQgMjQuNTM5MDYyIEMgNS4xMDU0NjkgMjQuNzM0Mzc1IDQuOTc2NTYyIDI0Ljk3NjU2MiA0Ljk3NjU2MiAyNS4zOTA2MjUgQyA0Ljk3NjU2MiAyNS43NzczNDQgNS4wOTc2NTYgMjYgNS40NDE0MDYgMjYuMjUzOTA2IEMgNS42MzI4MTIgMjYuNDAyMzQ0IDUuNzEwOTM4IDI2LjQwMjM0NCAxMC44NzEwOTQgMjYuNDIxODc1IEMgMTQuMjM4MjgxIDI2LjQzNzUgMTYuMTk5MjE5IDI2LjQxNzk2OSAxNi4zNjcxODggMjYuMzY3MTg4IEMgMTYuNzg1MTU2IDI2LjI2MTcxOSAxNy4wMzEyNSAyNS45NTMxMjUgMTcuMDcwMzEyIDI1LjUwMzkwNiBDIDE3LjEwNTQ2OSAyNS4wNDY4NzUgMTYuOTcyNjU2IDI0LjczNDM3NSAxNi42NDQ1MzEgMjQuNTM5MDYyIEMgMTYuNDI1NzgxIDI0LjQwNjI1IDE2LjI1IDI0LjM5ODQzOCAxMS4wMzkwNjIgMjQuMzk4NDM4IEMgNS44MjgxMjUgMjQuMzk4NDM4IDUuNjUyMzQ0IDI0LjQwNjI1IDUuNDMzNTk0IDI0LjUzOTA2MiBaIE0gNS40MzM1OTQgMjQuNTM5MDYyICIvPgo8cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gNS40NDkyMTkgMjkuNDUzMTI1IEMgNS4xMjUgMjkuNjQ0NTMxIDQuOTc2NTYyIDI5LjkyNTc4MSA0Ljk3NjU2MiAzMC4zMDQ2ODggQyA0Ljk3NjU2MiAzMC43NDIxODggNS4xNTIzNDQgMzEuMDQyOTY5IDUuNTE5NTMxIDMxLjIxODc1IEMgNS44MDA3ODEgMzEuMzUxNTYyIDUuOTY4NzUgMzEuMzU5Mzc1IDExLjAyMzQzOCAzMS4zNTkzNzUgQyAxNi43NDIxODggMzEuMzU5Mzc1IDE2LjUzMTI1IDMxLjM3NSAxNi44OTQ1MzEgMzAuOTQ1MzEyIEMgMTcuMTQwNjI1IDMwLjY1NjI1IDE3LjE2NDA2MiAzMC4xMTMyODEgMTYuOTQ1MzEyIDI5Ljc1NzgxMiBDIDE2LjY3MTg3NSAyOS4zMDQ2ODggMTYuODU5Mzc1IDI5LjMyMDMxMiAxMC45ODgyODEgMjkuMzIwMzEyIEMgNS45MjE4NzUgMjkuMzIwMzEyIDUuNjUyMzQ0IDI5LjMyODEyNSA1LjQ0OTIxOSAyOS40NTMxMjUgWiBNIDUuNDQ5MjE5IDI5LjQ1MzEyNSAiLz4KPC9nPgo8L3N2Zz4K', 10);
        add_submenu_page('post-grid', __('Create New', 'post-grid'), __('Create New', 'post-grid'), 'manage_options', 'post-new.php?post_type=post_grid', '', 20);
        add_submenu_page('edit.php?post_type=post_grid', __('Import Layouts', 'post-grid'), __('Import Layouts', 'post-grid'), 'manage_options', 'import_layouts', array($this, 'import_layouts'), 70);
        //add_submenu_page('post-grid', __('Layouts', 'post-grid'), __('All Layouts', 'post-grid'), 'manage_options', 'edit.php?post_type=post_grid_layout',);
        add_submenu_page('edit.php?post_type=post_grid', __('Settings', 'post-grid'), __('Settings', 'post-grid'), 'manage_options', 'post-grid-settings', array($this, 'settings'), 80);
        //add_submenu_page('post-grid', __('Dashboard', 'post-grid'), __('Dashboard', 'post-grid'), 'manage_options', 'post-grid-dashboard', array($this, 'dashboard'), 80);
        //add_submenu_page('post-grid', __('Overview', 'post-grid'), __('Overview', 'post-grid'), 'manage_options', 'post-grid-overview', array($this, 'overview'), 80);
        if ($data_update_status == 'pending') :
        //add_submenu_page('post-grid', __('Data Update', 'post-grid'), __('Data Update', 'post-grid'), 'manage_options', 'data_update', array($this, 'import_layouts'));
        endif;

        add_submenu_page('edit.php?post_type=post_grid', __('Builder', 'post-grid'), __('Builder', 'post-grid'), 'manage_options', 'post-grid-builder', array($this, 'builder'));
    }

    public function builder()
    {
        // include('menu/builder.php');
        include(post_grid_plugin_dir . 'includes/menu/builder.php');
    }

    public function overview()
    {
        include(post_grid_plugin_dir . 'includes/menu/overview.php');
    }
    public function dashboard()
    {
        include(post_grid_plugin_dir . 'includes/menu/dashboard.php');
    }
    public function settings()
    {
        include(post_grid_plugin_dir . 'includes/menu/settings.php');
    }
    public function data_update()
    {
        include(post_grid_plugin_dir . 'includes/menu/data-update.php');
    }
    public function import_layouts()
    {
        include(post_grid_plugin_dir . 'includes/menu/import-layouts.php');
    }
}
new class_post_grid_settings();
