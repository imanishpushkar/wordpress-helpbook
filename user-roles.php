/*
role: these codes will create a separate new user role with custom capabilities
*/
add_action('wp_loaded', 'addNewUserRole');
function addNewUserRole()
{
    add_role(
        'new_role',
        __('New Role'),
        array(
            'edit_posts'   => true,
            'delete_posts' => true,
            'read'         => true,
            'upload_files' => true
        )
    );
}

/*
New role with cloned capabilities
*/
add_action('init', 'cloneRole');

function cloneRole()
{
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    $adm = $wp_roles->get_role('administrator');
    //Adding a 'new_role' with all admin caps
    $wp_roles->add_role('new_role', 'New Role', $adm->capabilities);
}

/*
remove role
*/
$wp_roles = new WP_Roles(); // create new role object
$wp_roles->remove_role('new_role');

/*
using conditions
*/
<?php global $user_login, $current_user; wp_get_current_user(); 
$user_info = get_userdata($current_user->ID); 
$roles = array ( 'administrator', 'yith_vendor', 'waiter', ); 
if (is_user_logged_in() && array_intersect( $roles, $user_info->roles)):?>
some condition here
<?php else : ?>
some another condition here
<?php endif;?>
