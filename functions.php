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
        return '<p>すでに登録され、ログインしています。</p>';
    }

    ob_start();
    ?>
    <h2>会員登録</h2>
    <div class="loginform">
    <form method="post" class="woocommerce-form woocommerce-form-register register"> 
        <?php do_action( 'woocommerce_register_form_start' ); ?> 

        <!-- 名前 -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="billing_full_name"><?php esc_html_e( '名前', 'woocommerce' ); ?></label> 
            <input type="text" name="billing_full_name" id="billing_full_name" value="<?php echo isset($_POST['billing_full_name']) ? esc_attr(wp_unslash($_POST['billing_full_name'])) : ''; ?>" /> 
        </p>

        <!-- メール -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="reg_email"><?php esc_html_e( 'メールアドレス', 'woocommerce' ); ?></label> 
            <input type="email" name="email" id="reg_email" value="<?php echo isset($_POST['email']) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /> 
        </p> 
        
        <!-- 電話番号 -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="billing_phone"><?php esc_html_e( '電話番号', 'woocommerce' ); ?></label> 
            <input type="text" name="billing_phone" id="billing_phone" value="<?php echo isset($_POST['billing_phone']) ? esc_attr(wp_unslash($_POST['billing_phone'])) : ''; ?>" /> 
        </p>
        
        <!-- 住所 -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="billing_address_1"><?php esc_html_e( '住所', 'woocommerce' ); ?></label> 
            <input type="text" name="billing_address_1" id="billing_address_1" value="<?php echo isset($_POST['billing_address_1']) ? esc_attr(wp_unslash($_POST['billing_address_1'])) : ''; ?>" /> 
        </p>
        
        <!-- Password -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="reg_password"><?php esc_html_e( 'パスワード', 'woocommerce' ); ?></label> 
            <input type="password" name="password" id="reg_password" /> 
        </p>

        <!-- Password Confirm -->
        <p class="woocommerce-form-row form-row-wide"> 
            <label for="reg_password_confirm"><?php esc_html_e( 'パスワード(確認用)', 'woocommerce' ); ?></label> 
            <input type="password" name="password_confirm" id="reg_password_confirm" /> 
        </p>
        
        <?php do_action( 'woocommerce_register_form' ); ?> 
        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?> 
        
        <p class="woocommerce-FormRow form-row"> 
            <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                <?php esc_html_e('送信する', 'woocommerce' ); ?>
            </button> 
        </p> 

        <?php do_action( 'woocommerce_register_form_end' ); ?> 
    </form> 
    </div>
    <?php

    if ( is_user_logged_in() ) {
        echo '<p style="margin-top:20px;color:green;">すでに登録され、ログインしています。</p>';
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


// 
add_action( 'init', function() {
    if ( isset($_POST['register']) && isset($_POST['woocommerce-register-nonce']) 
        && wp_verify_nonce($_POST['woocommerce-register-nonce'], 'woocommerce-register') ) {

        $email    = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $confirm  = $_POST['password_confirm'];
        $name     = sanitize_text_field($_POST['billing_full_name']);
        $phone    = sanitize_text_field($_POST['billing_phone']);
        $address  = sanitize_text_field($_POST['billing_address_1']);

        // Validation
        $errors = new WP_Error();
        if ( empty($name) ) {
            $errors->add('name_error', '名前を入力してください。');
        }
        if ( empty($email) || !is_email($email) ) {
            $errors->add('email_error', '正しいメールアドレスを入力してください。');
        } elseif ( email_exists($email) ) {
            $errors->add('email_exists', 'このメールアドレスは既に使われています。');
        }
        if ( empty($password) || $password !== $confirm ) {
            $errors->add('password_error', 'パスワードが一致していません。');
        }
        if ( empty($phone) ) {
            $errors->add('phone_error', '電話番号を入力してください。');
        }
        if ( empty($address) ) {
            $errors->add('address_error', '住所を入力してください。');
        }

        if ( ! empty($errors->errors) ) {
            foreach ( $errors->get_error_messages() as $message ) {
                wc_add_notice( $message, 'error' );
            }
            return;
        }

        // Create user
        $user_id = wp_create_user( $email, $password, $email );
        if ( is_wp_error($user_id) ) {
            wc_add_notice( 'ユーザーの作成中にエラーが発生しました。', 'error' );
            return;
        }

        // Set display name
        wp_update_user([
            'ID' => $user_id,
            'display_name' => $name
        ]);

        // Save meta data
        update_user_meta($user_id, 'billing_full_name', $name);
        update_user_meta($user_id, 'billing_first_name', $name);
        update_user_meta($user_id, 'first_name', $name);
        update_user_meta($user_id, 'billing_phone', $phone);
        update_user_meta($user_id, 'billing_address_1', $address);

        // Auto-login (optional)
        wc_set_customer_auth_cookie( $user_id );
        wp_set_current_user( $user_id );

        // Redirect to My Account or any other page
        wp_safe_redirect( site_url('/myaccount') );
        exit;
    }
});


// --------------------------------------------
// Enable [woocommerce_lost_password] shortcode
add_shortcode( 'woocommerce_lost_password', function () {
    if ( is_user_logged_in() ) {
        return '<p>すでにログインしています。</p>';
    }

    ob_start();
    wc_get_template( 'myaccount/form-lost-password.php' );
    return ob_get_clean();
});

// Override WooCommerce Lost Password redirect
add_filter( 'woocommerce_lost_password_redirect', function( $url ) {
    return site_url( '/lost-password/?reset-link-sent=true' );
});

add_action( 'template_redirect', function () {
    // Check if the reset link is being accessed
    if ( isset( $_GET['key'], $_GET['login'] ) && is_account_page() && is_user_logged_out() ) {
        // Redirect to your custom reset page with the same parameters
        wp_redirect( site_url( '/reset-password/' ) . '?' . http_build_query( $_GET ) );
        exit;
    }
});

// Redirect WooCommerce's default reset-password link to our custom page
add_action( 'template_redirect', function () {
    if (
        isset( $_GET['key'], $_GET['login'] )
        && is_account_page()
        && ! is_user_logged_in()
        && strpos( $_SERVER['REQUEST_URI'], 'reset-password' ) !== false
    ) {
        wp_redirect( site_url( '/reset-password/' ) . '?' . http_build_query( $_GET ) );
        exit;
    }
});

add_filter( 'woocommerce_account_reset-password_endpoint', function( $endpoint ) {
    return 'disable-reset-password'; // Just an invalid slug so Woo doesn't hijack the route
});