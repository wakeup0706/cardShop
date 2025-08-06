<?php

add_theme_support( 'post-thumbnails' );

// Login form shortcode
add_shortcode( 'woocommerce_login_form', function() {
    if ( is_user_logged_in() ) {
        $current_user_id = get_current_user_id();
        $customer = new WC_Customer( $current_user_id );

        ob_start();
        ?>
        <h2>アカウント情報</h2>
        <div class="loginform">
            <p>Name: <?php echo esc_html( get_user_meta( $current_user_id, 'billing_full_name', true ) ); ?></p>
            <p>Email: <?php echo esc_html( $customer->get_email() ); ?></p>
            <p>Phone: <?php echo esc_html( $customer->get_billing_phone() ); ?></p>
            <p>Address: <?php echo esc_html( $customer->get_billing_address_1() ); ?></p>
        </div>
        <?php
        return ob_get_clean();
    }
    ob_start();
    woocommerce_login_form();
    return ob_get_clean();
} );

// Registration form shortcode
add_shortcode( 'woocommerce_register_form_custom', function() { 
    if ( 'yes' !== get_option( 'woocommerce_enable_signup_and_login_from_checkout' ) 
        && 'yes' !== get_option( 'woocommerce_enable_myaccount_registration' ) ) {
        return '<p>Registration is currently disabled.</p>';
    }

    ob_start();
    ?>
    <form method="post" class="woocommerce-form woocommerce-form-register register"> 
        <?php do_action( 'woocommerce_register_form_start' ); ?> 

        <!-- Name -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="billing_full_name"><?php esc_html_e( 'Name', 'woocommerce' ); ?> <span class="required">*</span></label> 
            <input type="text" name="billing_full_name" id="billing_full_name" value="<?php echo isset($_POST['billing_full_name']) ? esc_attr(wp_unslash($_POST['billing_full_name'])) : ''; ?>" /> 
        </p>

        <!-- Email -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label> 
            <input type="email" name="email" id="reg_email" value="<?php echo isset($_POST['email']) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /> 
        </p> 

        <!-- Password -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label> 
            <input type="password" name="password" id="reg_password" /> 
        </p>

        <!-- Password Confirm -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="reg_password_confirm"><?php esc_html_e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label> 
            <input type="password" name="password_confirm" id="reg_password_confirm" /> 
        </p>

        <!-- Phone -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="billing_phone"><?php esc_html_e( 'Phone Number', 'woocommerce' ); ?> <span class="required">*</span></label> 
            <input type="text" name="billing_phone" id="billing_phone" value="<?php echo isset($_POST['billing_phone']) ? esc_attr(wp_unslash($_POST['billing_phone'])) : ''; ?>" /> 
        </p>

        <!-- Address -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="billing_address_1"><?php esc_html_e( 'Address', 'woocommerce' ); ?> <span class="required">*</span></label> 
            <input type="text" name="billing_address_1" id="billing_address_1" value="<?php echo isset($_POST['billing_address_1']) ? esc_attr(wp_unslash($_POST['billing_address_1'])) : ''; ?>" /> 
        </p>

        <?php do_action( 'woocommerce_register_form' ); ?> 
        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?> 

        <p class="woocommerce-FormRow form-row"> 
            <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                <?php esc_html_e('Register', 'woocommerce' ); ?>
            </button> 
        </p> 

        <?php do_action( 'woocommerce_register_form_end' ); ?> 
    </form> 
    <?php

    if ( is_user_logged_in() ) {
        echo '<p style="margin-top:20px;color:green;">You are already registered and logged in.</p>';
    }

    return ob_get_clean();
} );

// Validate extra fields
add_action( 'woocommerce_register_post', function( $username, $email, $errors ) {
    if ( empty( $_POST['billing_full_name'] ) ) {
        $errors->add( 'billing_full_name_error', __( 'Name is required.', 'woocommerce' ) );
    }
    if ( isset($_POST['password'], $_POST['password_confirm']) && $_POST['password'] !== $_POST['password_confirm'] ) {
        $errors->add( 'password_mismatch', __( 'Passwords do not match.', 'woocommerce' ) );
    }
    if ( empty( $_POST['billing_phone'] ) ) {
        $errors->add( 'billing_phone_error', __( 'Phone number is required.', 'woocommerce' ) );
    }
    if ( empty( $_POST['billing_address_1'] ) ) {
        $errors->add( 'billing_address_error', __( 'Address is required.', 'woocommerce' ) );
    }
}, 10, 3 );

// Save extra fields
add_action( 'woocommerce_created_customer', function( $customer_id ) {
    if ( isset( $_POST['billing_full_name'] ) ) {
        $full_name = sanitize_text_field( $_POST['billing_full_name'] );
        update_user_meta( $customer_id, 'billing_full_name', $full_name );
        update_user_meta( $customer_id, 'billing_first_name', $full_name ); // For compatibility
        update_user_meta( $customer_id, 'first_name', $full_name );        // For WP profile
    }
    if ( isset( $_POST['billing_phone'] ) ) {
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
    if ( isset( $_POST['billing_address_1'] ) ) {
        update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
    }
});

// Redirect after registration
add_filter( 'woocommerce_registration_redirect', function() {
    return home_url(); // change URL as needed
} );
