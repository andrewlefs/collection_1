<?php
if ( ! class_exists( 'IPSocialLocker_Admin' )) {

    /**
     * Class for handling administrator page
     */
    class IPSocialLocker_Admin
    {
        /**
         * Show content admin home
         *
         * @return void
         */
        public function index()
        {
        ?>
            <div class="wrap">
                <div id="icon-page-ipsociallocker" class="icon32">
                    <br>
                </div>
                <h2>
                    <?php echo IPSOCIALLOCKER_TITLE; ?>
                    <a class="add-new-h2" href="admin.php?page=wp-sociallocker-add" title="Add Locker">Add New</a>
                </h2>
                <div id="ipsp_messages"></div>
                
                <?php
                require_once( plugin_dir_path( __FILE__ ) . "list-table.php" );
                $paginArgs = array(
                    "per_page" => 20 
                );
                $listTable = new IPSocialLocker_ListTable();
                $listTable->prepare_items();
                $listTable->display();
                ?>
                
            </div>
        <?php
        }
        
        /**
         * Show content for meta box
         *
         * @return void
         */
        public function metaBox( $post )
        {
        ?>
            <div id="ip_metaBoxLocker">
                <p><strong><?php _e( 'Post Locker' ); ?></strong></p>
                <label for="ip_lockerSelect" class="screen-reader-text"><?php _e( 'Post Locker' ); ?></label>
                <select id="ip_lockerSelect" name="ip_locker_select">
                    <option value="">None</option>
                    <?php
                    $args = array(
                        'orderby'     => 'post_date',
                        'order'       => 'DESC', 
                        'post_type'   => 'ipsociallocker',
                        'post_status' => array(1)
                    );
                    $query   = new WP_Query;
                    $lockers = $query->query( $args );
                    $metas   = get_post_meta( $post->ID, '_ip_post_lock' );
                    $lockId  = 0;
                    if ( ! empty( $metas )) {
                        $lockId = array_shift( $metas );
                    }
                    if ( ! empty( $lockers )) {
                        foreach( $lockers as $locker ) {
                            $selected = '';
                            if ( $locker->ID == $lockId ) {
                                $selected = ' selected="selected"';
                            }
                            echo '<option' . $selected . ' value="' . $locker->ID . '">' . $locker->post_title . '</option>';
                        }
                    }
                    ?>
                </select>
                <?php wp_nonce_field( plugin_basename( __FILE__ ), 'ip_select_locker_nonce' ); ?>
            </div>
        <?php
        }
        
        /**
         * Show content admin for setting locker
         *
         * @return void
         */
        public function adminSetting()
        {
            $submit  = false;
            $success = true;
            if ( isset( $_POST['ip_setting_submit'] )) {
                $submit  = true;
                $appid   = trim( $_POST['fb_appid'] );
                $success = update_option( '_iplock_facebook_appid', $appid );
            }
        ?>
            <div class="wrap">
                <div id="icon-page-ipsociallocker-setting" class="icon32">
                    <br>
                </div>
                <h2>
                    <?php _e( 'Common Settings' ); ?>
                </h2>
                
                <?php
                if ( $submit ) {
                    echo '<div id="messages" class="updated"><p>' . __( 'Successfully save settings' ) . '</p></div>';
                }
                ?>
                
                <div class="ipsl-main">
                    <form id="ipsl-setting-form" action="" method="post">
                        <input type="hidden" name="ip_setting_submit" value="1">
                        <div class="ipsl-field ipsl-clear">
                            <div class="ipsl-label">
                                <label for="ipsl-fb-appid"><?php _e( 'Facebook App ID' ); ?></label>
                            </div>
                            <div class="ipsl-input">
                                <?php
                                $appid  = get_option( '_iplock_facebook_appid', '239219112897202' );
                                ?>
                                <input type="text" name="fb_appid" id="ipsp-fb-appid" value="<?php echo $appid; ?>">
                                <p class="ipsl-info"><?php _e( 'A facebook app id. By default, a developer app id is used. If you want to use a Facebook Share button you should register another app id specially for your domain.' ); ?></p>
                            </div>
                        </div>
                        <div class="ip_formButton clearfix">
                            <input type="submit" class="button button-primary" name="ip_saveSetting" id="ip_btnEditorLocker" value="<?php _e( 'Save change' ); ?>" />
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
        
        /**
         * Show content admin edit
         *
         * @return void
         */
        public function edit()
        {
            if ( empty( $_GET['id'] )) {
                wp_die( __('You attempted to edit an item that doesn&#8217;t exist. Perhaps it was deleted?') );
            }
            $id = absint( $_GET['id'] );
            if ( ! $locker = get_post( $id ) ) {
                wp_die( __('You attempted to edit an item that doesn&#8217;t exist. Perhaps it was deleted?') );
            }
            $this->manage( $locker );
        }
        
        /**
         * Show content admin manage
         *
         * @return void
         */
        public function manage( $locker = false )
        {
            $id = 0;
            if ( $locker ) {
                $id = $locker->ID;
            }
            $setting = new IPSocialLocker_Setting( $id );
            
            $plgurl  = plugin_dir_url( dirname(__FILE__) );
            $prvurl  = $plgurl . 'img/preview/';
            
            wp_enqueue_script('post');
            wp_enqueue_script('postbox');
            wp_enqueue_script('wp-color-picker');
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_style('jquery-ui-sortable');
        ?>
            <div id="ipsl-locker-form" class="wrap">
                <div id="icon-page-ipsociallocker" class="icon32">
                    <br>
                </div>
                <?php
                if ( $locker ) :
                ?>
                    <h2><?php _e( 'Edit Social Locker' ); ?></h2>
                <?php 
                else :
                ?>
                    <h2><?php _e( 'Add Social Locker' ); ?></h2>
                <?php
                endif;
                ?>
                <div id="ipsl_messages"></div>
                
                <div class="ipsl-main">
                <form id="ipsl-manage-form" action="" method="post">
                    
                    <input type="hidden" id="ipsp-locker-id" name="locker_id" value="<?php echo $id; ?>" />
                    
                    <div id="ipsl-fields">
                    
                        <div id="ipsl-field-name">
                            <label for="ipsl-input-name"><?php _e( 'Locker Name' ); ?></label>
                            <?php
                            $title = '';
                            if ( $locker ) {
                                $title = $locker->post_title;
                            }
                            ?>
                            <input type="text" name="post_title" id="title" value="<?php echo $title; ?>"/>
                        </div>
                        <div class="ipsl-field-group">
                            <div class="ipsl-fgroup-header">
                                <h3>Basic Options</h3>
                            </div>
                            <div class="ipsl-fgroup-content">
                                <div class="ipsl-field">
                                    <div class="ipsl-label">
                                        <label for="ipsl-input-title"><?php _e( 'Locker Title' ); ?></label>
                                    </div>
                                    <div class="ipsl-input">
                                        <input type="text" value="<?php echo $setting->getSetting( 'locker_header' ); ?>" id="ipsl-input-title" name="locker_header" />
                                        <p class="ipsl-info"><?php _e( 'The title of a locker that will be placed at the top of the social locker.' ); ?></p>
                                    </div>
                                </div>
                                <div class="ipsl-field">
                                    <div class="ipsl-label">
                                        <label for="ipsl-input-info"><?php _e( 'Locker Info' ); ?></label>
                                    </div>
                                    <div class="ipsl-input">
                                        <div class="ipsl-input-editor">
                                            <?php
                                            $tinymceInit = array(
                                                'editor_height' => 100
                                            );
                                            $tinymceInit['handle_event_callback'] = 'iplocker_editor_callback';
                                            $content = $setting->getSetting( 'locker_message' );
                                            wp_editor( $content, 'locker_message', array( 
                                                'editor_height' => 50,
                                                'tinymce'       => $tinymceInit
                                            )); 
                                            ?>
                                        </div>
                                        <p class="ipsl-info"><?php _e( 'Remarks that could be an explanation of the social locker and how to open social locker.' ); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ipsl-field-group">
                            <div class="ipsl-fgroup-header">
                                <h3>Social Buttons</h3>
                            </div>
                            <div class="ipsl-fgroup-content">
                                <p><strong><?php _e('Note'); ?>: </strong> <?php _e('Drop and drag the menu tab to determine the order of the social.'); ?></p>
                                <div class="ipsl-field-buttons ipsl-clear">
                                    <div class="ipsl-tab-menu">
                                        <ul class="ipsl-sortable">
                                            <?php
                                            $buttons = array(
                                                'fblike'    => 'FB Like',
                                                'fbshare'   => 'FB Share',
                                                'tweet'     => 'Tweet',
                                                'twfollow'  => 'Twitter Follow',
                                                'gplus'     => 'Google +1',
                                                'gpshare'   => 'Google Share',
                                                'inshare'   => 'LinkedIn Share',
                                            );
                                            $order = $setting->getSetting( 'button_order' );
                                            if ( $order ) {
                                                $order   = trim( $order, '|' );
                                                $orders  = explode( '|', $order );
                                            } else {
                                                $orders = array_keys( $buttons );
                                            }
                                            foreach ( $orders as $tag ) {
                                            
                                                $label  = '';
                                                if ( isset( $buttons[$tag] )) {
                                                    $label = $buttons[$tag];
                                                }
                                                $cllink = 'ui-state-default';
                                                $avail  = $setting->getSetting( $tag.'_available');
                                                if ( $avail == 'false' ) {
                                                    $cllink .= ' ipsl-social-off';
                                                }
                                                
                                                echo '<li class="'.$cllink.'" id="ipsl-link-'.$tag.'">
                                                        <a href="#ipsl-setting-'.$tag.'">
                                                            <span class="ipsl-sort-icon"></span>
                                                            <span class="ipsl-icon-'.$tag.'">'.$label.'</span>
                                                        </a>
                                                    </li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="ipsl-tab-content">
                                        
                                        <?php
                                        foreach ( $orders as $tag ) :
                                        ?>
                                        <div id="ipsl-setting-<?php echo $tag; ?>" class="ipsl-tab-item">
                                            <div class="ipsl-field ipsl-clear">
                                                <div class="ipsl-label">
                                                    <label><?php _e( 'Available' ); ?></label>
                                                </div>
                                                <div class="ipsl-input">
                                                    <div data-toggle="buttons-radio" class="ipsl-btn-radio button-group">
                                                        <?php
                                                        $val   = $setting->getSetting( $tag.'_available', 'true' );
                                                        if ( $val == 'false' ) {
                                                            $clon  = '';
                                                            $cloff = ' button-primary active';
                                                        } else {
                                                            $clon  = ' button-primary active';
                                                            $cloff = '';
                                                        }
                                                        ?>
                                                        <button data-value="true" class="button<?php echo $clon; ?> true" type="button">On</button>
                                                        <button data-value="false" class="button<?php echo $cloff; ?> false" type="button">Off</button>
                                                        <input type="hidden" class="ipsl-av-value" name="<?php echo $tag; ?>_available" value="<?php echo $val ?>" />
                                                    </div>
                                                    <p class="ipsl-info"><?php _e( 'Set Off to hide the Share Button.' ); ?></p>
                                                </div>
                                            </div>
                                            <div class="ipsl-field ipsl-clear">
                                                <div class="ipsl-label">
                                                    <label for="ipsl-sett-<?php echo $tag; ?>-url"><?php _e( 'URL to share' ); ?></label>
                                                </div>
                                                <div class="ipsl-input">
                                                    <input type="text" value="<?php echo $setting->getSetting($tag.'_url'); ?>" id="ipsl-sett-<?php echo $tag; ?>-url" name="<?php echo $tag; ?>_url">
                                                    <p class="ipsl-info"><?php _e( 'Set any URL to share. Leave this field empty to use a current page.' ); ?></p>
                                                </div>
                                            </div>
                                            <div class="ipsl-field ipsl-clear">
                                                <div class="ipsl-label">
                                                    <label for="ipsl-sett-<?php echo $tag; ?>-title"><?php _e( 'Button Title' ); ?></label>
                                                </div>
                                                <div class="ipsl-input">
                                                    <input type="text" value="<?php echo $setting->getSetting($tag.'_title'); ?>" id="ipsl-sett-<?php echo $tag; ?>-title" name="<?php echo $tag; ?>_title">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        endforeach;
                                        ?>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="ipsl-2column ipsl-clear">
                            
                            <div class="ipsl-leftcolumn">
                                <div class="ipsl-field-group">
                                
                                    <div class="ipsl-fgroup-header">
                                        <h3><?php _e( 'Locker Design' ); ?></h3>
                                    </div>
                                    <div class="ipsl-fgroup-content">
                                        <div class="ipsl-field-section">
                                            <div class="ipsl-field-subtitle">
                                                <h4><?php _e( 'Box Layout' ); ?></h4>
                                            </div>
                                            <div class="ipsl-option-list">
                                                <ul class="ipsl-clear">
                                                    <?php
                                                    $current = $setting->getSetting( 'box_layout',1 );
                                                    $options = array(
                                                        1 => __( 'Standard Center' ),
                                                        2 => __( 'Standard Left' ),
                                                        3 => __( 'Boxed Left' ),
                                                        4 => __( 'Boxed Right' )
                                                    );
                                                    foreach( $options as $key => $label ) {
                                                    
                                                        $checked = '';
                                                        if ( $key == $current ) {
                                                            $checked = ' checked="checked"';
                                                        }
                                                        $imgurl  = $prvurl . 'layout-' . $key . '.jpg';
                                                        echo '<li>
                                                            <label>
                                                                <input type="radio" name="box_layout" value="'.$key.'"'.$checked.'>
                                                                <span class="ipsl-prv-thumb">
                                                                    <strong>'.$label.'</strong>
                                                                    <img src="'.$imgurl.'" alt="'.$label.'">
                                                                </span>
                                                                <span class="ipsl-prv-big" style="display: none;">
                                                                    <img src="'.$imgurl.'" alt="'.$label.'">
                                                                </span>
                                                            </label>
                                                        </li>';
                                                    }
                                                    ?>
                                                    </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="ipsl-field-section">
                                            <div class="ipsl-field-subtitle">
                                                <h4><?php _e( 'Box Design' ); ?></h4>
                                            </div>
                                            <div class="ipsl-option-list">
                                                <ul class="ipsl-clear">
                                                <?php
                                                $current = $setting->getSetting( 'box_design' );
                                                $options = array(
                                                    1 => __( 'Theme 1' ),
                                                    2 => __( 'Theme 2' ),
                                                    3 => __( 'Theme 3' ),
                                                    4 => __( 'Theme 4' ),
                                                    5 => __( 'Theme 5' ),
                                                    6 => __( 'Theme 6' ),
                                                    7 => __( 'Theme 7' ),
                                                    8 => __( 'Theme 8' )
                                                );
                                                foreach( $options as $key => $label ) {
                                                
                                                    $checked = '';
                                                    if ( $key == $current ) {
                                                        $checked = ' checked="checked"';
                                                    }
                                                    $imgurl = $prvurl . 'box-theme-' . $key . '.jpg';
                                                    echo '<li>
                                                        <label>
                                                            <input type="radio" name="box_design" value="'.$key.'"'.$checked.'>
                                                            <span class="ipsl-prv-thumb">
                                                                <strong>'.$label.'</strong>
                                                                <img src="'.$imgurl.'" alt="'.$label.'">
                                                            </span>
                                                            <span class="ipsl-prv-big" style="display: none;">
                                                                <img src="'.$imgurl.'" alt="'.$label.'">
                                                            </span>
                                                        </label>
                                                    </li>';
                                                }
                                                ?>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div id="ipsl-section-bdesign" class="ipsl-field-section">
                                            <div class="ipsl-field-subtitle">
                                                <h4><?php _e( 'Button Design' ); ?></h4>
                                            </div>
                                            <div class="ipsl-option-list">
                                                <ul class="ipsl-clear">
                                                <?php
                                                $current = $setting->getSetting( 'button_design' );
                                                $options = array(
                                                    1 => __( 'Design 1' ),
                                                    2 => __( 'Design 2' ),
                                                    3 => __( 'Design 3' ),
                                                    4 => __( 'Design 4' ),
                                                    5 => __( 'Design 5' ),
                                                    6 => __( 'Design 6' ),
                                                    7 => __( 'Design 7' ),
                                                    8 => __( 'Design 8' ),
                                                    9 => __( 'Design 9' ),
                                                    10 => __( 'Design 10' ),
                                                );
                                                foreach( $options as $key => $label ) {
                                                
                                                    $checked = '';
                                                    if ( $key == $current ) {
                                                        $checked = ' checked="checked"';
                                                    }
                                                    $imgurl = $prvurl . 'button-' . $key . '.jpg';
                                                    echo '<li>
                                                        <label>
                                                            <input type="radio" name="button_design" value="'.$key.'"'.$checked.'>
                                                            <span class="ipsl-prv-thumb">
                                                                <strong>'.$label.'</strong>
                                                                <img src="'.$imgurl.'" alt="'.$label.'">
                                                            </span>
                                                            <span class="ipsl-prv-big" style="display: none;">
                                                                <img src="'.$imgurl.'" alt="'.$label.'">
                                                            </span>
                                                        </label>
                                                    </li>';
                                                }
                                                ?>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="ipsl-field-group">
                                
                                    <div class="ipsl-fgroup-header">
                                        <h3><?php _e( 'Preview' ); ?></h3>
                                    </div>
                                    <div class="ipsl-fgroup-content">
                                            <p style="margin: 0 0 15px;"><strong>Note:</strong> It's just preview. The Locker and the social buttons don't work correctly in the admin area.</p>
                                            <div id="ipsl-locker-preview-wrap">
                                                <?php
                                                if ( $locker ) :
                                                ?>
                                                <div id="ipsl-locker-preview">
                                                    <?php
                                                    $factory = new IPSocialLocker_Factory();
                                                    $preview = $factory->preview( $locker );
                                                    echo $preview;
                                                    ?>
                                                </div>
                                                <?php
                                                else:
                                                ?>
                                                <div id="ipsl-locker-preview" class="nopreview"></div>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div id="ipsl-advfunc-field" class="ipsl-rightcolumn ipsl-field-group">
                                <div class="ipsl-fgroup-header">
                                    <h3>Options</h3>
                                </div>
                                <div class="ipsl-fgroup-content">
                                    <ul class="ipsl-adv-funcs">
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Close Link' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <div data-toggle="buttons-radio" class="ipsl-btn-radio button-group">
                                                    <?php
                                                    $val   = $setting->getSetting( 'close_icon', 'false' );
                                                    if ( $val == 'false' ) {
                                                        $clon  = '';
                                                        $cloff = ' button-primary active';
                                                    } else {
                                                        $clon  = ' button-primary active';
                                                        $cloff = '';
                                                    }
                                                    ?>
                                                    <button data-value="true" class="button<?php echo $clon; ?> true" type="button">On</button>
                                                    <button data-value="false" class="button<?php echo $cloff; ?> false" type="button">Off</button>
                                                    <input type="hidden" class="ipsl-av-value" name="close_icon" value="<?php echo $val; ?>" />
                                                </div>
                                                <span class="ipsl-info"><?php _e( 'Set on to show close link' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Close Link Position' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <?php
                                                $val = $setting->getSetting( 'close_position', 1 );
                                                $pos = array(
                                                    1 => 'Top Right',
                                                    2 => 'Top Left',
                                                    3 => 'Bottom Right',
                                                    4 => 'Bottom Left',
                                                );
                                                ?>
                                                <select name="close_position">
                                                    <?php
                                                    foreach( $pos as $key => $label ) {
                                                        $sltd = '';
                                                        if ( $val == $key ) {
                                                            $sltd = ' selected="selected"';
                                                        }
                                                        echo '<option value="'.$key.'"'.$sltd.'>'.$label.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <span class="ipsl-info"><?php _e( 'Position of close link' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Timer Interval' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <input type="text" class="ipsl-small" name="time_interval" value="<?php echo $setting->getSetting( 'time_interval', 0 ); ?>">
                                                <span class="ipsl-info"><?php _e( 'Set a value to using timer' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Timer Position' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <?php
                                                $val = $setting->getSetting( 'timer_position', 1 );
                                                $pos = array(
                                                    1 => 'Bottom Right',
                                                    2 => 'Top Right',
                                                    3 => 'Top Left',
                                                    4 => 'Bottom Left',
                                                );
                                                ?>
                                                <select name="timer_position">
                                                    <?php
                                                    foreach( $pos as $key => $label ) {
                                                        $sltd = '';
                                                        if ( $val == $key ) {
                                                            $sltd = ' selected="selected"';
                                                        }
                                                        echo '<option value="'.$key.'"'.$sltd.'>'.$label.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <span class="ipsl-info"><?php _e( 'Position of timer info' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'AJAX Content Load' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <div data-toggle="buttons-radio" class="ipsl-btn-radio button-group">
                                                    <?php
                                                    $val   = $setting->getSetting( 'ajax_support', 'false' );
                                                    if ( $val == 'false' ) {
                                                        $clon  = '';
                                                        $cloff = ' button-primary active';
                                                    } else {
                                                        $clon  = ' button-primary active';
                                                        $cloff = '';
                                                    }
                                                    ?>
                                                    <button data-value="true" class="button<?php echo $clon; ?> true" type="button">On</button>
                                                    <button data-value="false" class="button<?php echo $cloff; ?> false" type="button">Off</button>
                                                    <input type="hidden" class="ipsl-av-value" name="ajax_support" value="<?php echo $val; ?>" />
                                                </div>
                                                <span class="ipsl-info"><?php _e( 'Set on to use ajax to load content' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Mobile Support' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <div data-toggle="buttons-radio" class="ipsl-btn-radio button-group">
                                                    <?php
                                                    $val   = $setting->getSetting( 'mobile_support', 'true' );
                                                    if ( $val == 'false' ) {
                                                        $clon  = '';
                                                        $cloff = ' button-primary active';
                                                    } else {
                                                        $clon  = ' button-primary active';
                                                        $cloff = '';
                                                    }
                                                    ?>
                                                    <button data-value="true" class="button<?php echo $clon; ?> true" type="button">On</button>
                                                    <button data-value="false" class="button<?php echo $cloff; ?> false" type="button">Off</button>
                                                    <input type="hidden" class="ipsl-av-value" name="mobile_support" value="<?php echo $val; ?>" />
                                                </div>
                                                <span class="ipsl-info"><?php _e( 'Set on to display locker in mobile' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Highlight Effect' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <div data-toggle="buttons-radio" class="ipsl-btn-radio button-group">
                                                    <?php
                                                    $val   = $setting->getSetting( 'highlight', 'true' );
                                                    if ( $val == 'false' ) {
                                                        $clon  = '';
                                                        $cloff = ' button-primary active';
                                                    } else {
                                                        $clon  = ' button-primary active';
                                                        $cloff = '';
                                                    }
                                                    ?>
                                                    <button data-value="true" class="button<?php echo $clon; ?> true" type="button">On</button>
                                                    <button data-value="false" class="button<?php echo $cloff; ?> false" type="button">Off</button>
                                                    <input type="hidden" class="ipsl-av-value" name="highlight" value="<?php echo $val; ?>" />
                                                </div>
                                                <span class="ipsl-info"><?php _e( 'Set on to use highlight effect' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Hide for members' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <div data-toggle="buttons-radio" class="ipsl-btn-radio button-group">
                                                    <?php
                                                    $val   = $setting->getSetting( 'hide_member', 'true' );
                                                    if ( $val == 'false' ) {
                                                        $clon  = '';
                                                        $cloff = ' button-primary active';
                                                    } else {
                                                        $clon  = ' button-primary active';
                                                        $cloff = '';
                                                    }
                                                    ?>
                                                    <button data-value="true" class="button<?php echo $clon; ?> true" type="button">On</button>
                                                    <button data-value="false" class="button<?php echo $cloff; ?> false" type="button">Off</button>
                                                    <input type="hidden" class="ipsl-av-value" name="hide_member" value="<?php echo $val; ?>" />
                                                </div>
                                                <span class="ipsl-info"><?php _e( 'Set on to hide locker for members' ); ?></span>
                                            </div>
                                        </li>
                                        <li class="ipsl-clear">
                                            <div class="ipsl-adf-label">
                                                <h4>
                                                    <?php _e( 'Alert Message' ); ?>
                                                </h4>
                                            </div>
                                            <div class="ipsl-adf-input">
                                                <div data-toggle="buttons-radio" class="ipsl-btn-radio button-group">
                                                    <?php
                                                    $val   = $setting->getSetting( 'show_alert_msg', 'false' );
                                                    if ( $val == 'false' ) {
                                                        $clon  = '';
                                                        $cloff = ' button-primary active';
                                                    } else {
                                                        $clon  = ' button-primary active';
                                                        $cloff = '';
                                                    }
                                                    ?>
                                                    <button data-value="true" class="button<?php echo $clon; ?> true" type="button">On</button>
                                                    <button data-value="false" class="button<?php echo $cloff; ?> false" type="button">Off</button>
                                                    <input type="hidden" class="ipsl-av-value" name="show_alert_msg" value="<?php echo $val; ?>" />
                                                </div>
                                                <span class="ipsl-info"><?php _e( 'Set on to show alert message' ); ?></span>
                                                <div id="ipsl-alert-message">
                                                    <p class="ipsl-info"><?php _e( 'Set message in here' ); ?></p>
                                                    <textarea name="alert_message"><?php echo $setting->getSetting( 'alert_message', '' ); ?></textarea>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div id="ipsl-form-submit">
                        <?php 
                        if ( $locker ) :
                        ?>
                            <input type="submit" accesskey="u" value="<?php _e( 'Update' ); ?>" class="button button-primary button-large ipsl-update" id="update" name="update">
                        <?php
                        else:
                        ?>
                            <input type="submit" accesskey="p" value="<?php _e( 'Publish' ); ?>" class="button button-primary button-large ipsl-publish" id="publish" name="publish">
                        <?php
                        endif;
                        ?>
                        <span class="spinner"></span>
                    </div>
                    
                </form>
                </div>
            </div>
        <?php
        }

        /**
         * Register TinyMce plugin
         *
         * @return void
         */
        public function editor()
        {
        ?>
            <div id="ip_socialLockerWrap" style="display: none;">
                <div id="ip_socialLockerEditor">
                    <form id="ip_editorFormLocker" action="" method="post">
                        <ol>
                            <li class="ipsl-clear">
                                <label for="ip_inputLocker"><?php _e( 'Select Locker' ); ?></label>
                                <div class="input">
                                    <select id="ip_inputLocker" name="ipsociallocker">
                                        <?php
                                        $args = array(
                                    'orderby'        => 'post_date',
                                    'order'          => 'DESC', 
                                    'post_type'      => 'ipsociallocker',
                                    'post_status'    => array(1),
                                        );
                                        $query   = new WP_Query;
                                        $lockers = $query->query( $args );
                                        foreach( $lockers as $locker ) {
                                    $id    = $locker->ID;
                                    $title = $locker->post_title;
                                    echo '<option value="'.$id.'">'.$title.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </li>
                        </ol>
                        <div class="ip_formButton clearfix">
                            <input type="submit" class="button button-primary" name="ip_saveSetting" id="ip_btnEditorLocker" value="Add Social Locker" />
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
        
        /**
         * Show content admin stats
         *
         * @return void
         */
        public function stats()
        {
            wp_enqueue_script('jquery-ui-datepicker');
            
            $postId = 0;
            if ( ! empty( $_REQUEST['cpostid'] )) {
                $postId = absint( $_REQUEST['cpostid'] );
            }
            $dateStart = 
            $dateEnd   = false;
            if ( ! empty( $_REQUEST['cdatestart'] )) {
                $dateStart = $_REQUEST['cdatestart'];
            }
            if ( ! empty( $_REQUEST['cdateend'] )) {
                $dateEnd = $_REQUEST['cdateend'];
            }
            $hrsOffset = get_option('gmt_offset');
            if (strpos($hrsOffset, '-') !== 0) $hrsOffset = '+' . $hrsOffset;
            $hrsOffset .= ' hours';
            
            $dateRangeEnd   = strtotime($dateEnd);
            $dateRangeStart = strtotime($dateStart);

            // by default shows a 30 days' range
            if ( empty( $dateEnd ) || $dateRangeEnd === false ) {
                $phpdate      = getdate( strtotime($hrsOffset, time()) );
                $dateRangeEnd = mktime(0, 0, 0, $phpdate['mon'], $phpdate['mday'], $phpdate['year']);
            }
            if ( empty( $dateStart ) || $dateRangeStart === false ) {
                $dateRangeStart = strtotime( "-1 month", $dateRangeEnd );
            }
            
            $dateStart = date('m/d/Y', $dateRangeStart);
            $dateEnd   = date('m/d/Y', $dateRangeEnd); 
            
            $urlBase  = 'admin.php?page=wp-sociallocker-stats';
            $postBase = $urlBase . '&cdatestart=' . $dateStart . '&cdateend=' . $dateEnd;
            
            $plgurl    = plugin_dir_url( dirname(__FILE__) );
            $chartData = $this->getChartData( $postId, $dateRangeEnd, $dateRangeStart );
        ?>
            <script type="text/javascript" src="<?php echo $plgurl; ?>js/statistic.js"></script>
            <div id="ipsl-locker-stats" class="wrap">
                <div id="icon-page-iplocker-stats" class="icon32">
                    <br>
                </div>
                <h2><?php _e( 'Table Stats' ); ?></h2>
                
                <p><?php _e( 'This page provides statistical data on the number of user interactions on your social buttons. Data on the number of interaction are presented in tabular.' ); ?></p>
                
                <div id="ipsl_messages"></div>
                
                <div class="ipsl-main">
                    <form method="get" action="">
                    
                    <div class="ipsl-stats-chart">
                        
                        <div class="ipsl-chart-selector">
                            <ul>
                                <li class="ipsl-selector facebook-like">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Facebook Like' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector facebook-share">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Facebook Share' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector twitter-tweet">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Twitter Tweet' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector twitter-follow">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Twitter Follow' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector google-plus">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Google Plus' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector google-share">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Google Share' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector linkedin-share">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'LinkedIn Share' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector timer">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Timer' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector close">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Close' ); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="ipsl-stats-table">
                        
                        <div class="ipsl-table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th id="ipsl-head-title"><?php _e( 'Post Title' ); ?></th>
                                        <th id="ipsl-head-total"><?php _e( 'Total Count' ); ?></th>
                                        <th class="ipsl-field-facebook-like"><?php _e( 'Facebook Like' ); ?></th>
                                        <th class="ipsl-field-facebook-share"><?php _e( 'Facebook Share' ); ?></th>
                                        <th class="ipsl-field-twitter-tweet"><?php _e( 'Twitter Tweet' ); ?></th>
                                        <th class="ipsl-field-twitter-follow"><?php _e( 'Twitter Follow' ); ?></th>
                                        <th class="ipsl-field-google-plus"><?php _e( 'Google Plusoner' ); ?></th>
                                        <th class="ipsl-field-google-share"><?php _e( 'Google Share' ); ?></th>
                                        <th class="ipsl-field-linkedin-share"><?php _e( 'LinkedIn Share' ); ?></th>
                                        <th class="ipsl-field-timer"><?php _e( 'via Timer' ); ?></th>
                                        <th class="ipsl-field-close"><?php _e( 'via Close' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $perpage = 50;
                                    $page    = 1;
                                    if ( ! empty( $_GET['n'] )) {
                                        $page = absint( $_GET['n'] );
                                    }
                                    $results = $this->getTableData( $dateRangeEnd, $dateRangeStart, $perpage, $page );
                                    if ( ! empty( $results )) :
                                        foreach( $results as $locker ) :
                                    ?>
                                        <tr>
                                    <td class="ipsl-field-title">
                                        <a href="<?php echo $postBase ?>&cpostid=<?php echo $locker->ID; ?>">
                                        <?php echo $locker->title; ?>
                                        </a>
                                    </td>
                                    <td class="ipsl-field-total"><?php echo $locker->total_count; ?></td>
                                    <td class="ipsl-field-facebook-like"><?php echo $locker->facebook_like_count; ?></td>
                                    <td class="ipsl-field-facebook-share"><?php echo $locker->facebook_share_count; ?></td>
                                    <td class="ipsl-field-twitter-tweet"><?php echo $locker->twitter_tweet_count; ?></td>
                                    <td class="ipsl-field-twitter-follow"><?php echo $locker->twitter_follow_count; ?></td>
                                    <td class="ipsl-field-google-plus"><?php echo $locker->google_plus_count; ?></td>
                                    <td class="ipsl-field-google-share"><?php echo $locker->google_share_count; ?></td>
                                    <td class="ipsl-field-linkedin-share"><?php echo $locker->linkedin_share_count; ?></td>
                                    <td class="ipsl-field-timer"><?php echo $locker->timer_count; ?></td>
                                    <td class="ipsl-field-close"><?php echo $locker->close_count; ?></td>
                                        </tr>
                                    <?php
                                        endforeach;
                                    else :
                                    ?>
                                        <tr>
                                    <td colspan="11"><?php _e( 'Empty Data'); ?></td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                    <input type="hidden" name="page" value="wp-sociallocker-stats" />
                    </form>
                </div>
            </div>
        <?php
        }
        
        /**
         * Show content admin stats
         *
         * @return void
         */
        public function graphStats()
        {
            wp_enqueue_script('jquery-ui-datepicker');
            
            $postId = 0;
            if ( ! empty( $_REQUEST['cpostid'] )) {
                $postId = absint( $_REQUEST['cpostid'] );
            }
            $dateStart = 
            $dateEnd   = false;
            if ( ! empty( $_REQUEST['cdatestart'] )) {
                $dateStart = $_REQUEST['cdatestart'];
            }
            if ( ! empty( $_REQUEST['cdateend'] )) {
                $dateEnd = $_REQUEST['cdateend'];
            }
            $hrsOffset = get_option('gmt_offset');
            if (strpos($hrsOffset, '-') !== 0) $hrsOffset = '+' . $hrsOffset;
            $hrsOffset .= ' hours';
            
            $dateRangeEnd   = strtotime($dateEnd);
            $dateRangeStart = strtotime($dateStart);

            // by default shows a 30 days' range
            if ( empty( $dateEnd ) || $dateRangeEnd === false ) {
                $phpdate      = getdate( strtotime($hrsOffset, time()) );
                $dateRangeEnd = mktime(0, 0, 0, $phpdate['mon'], $phpdate['mday'], $phpdate['year']);
            }
            if ( empty( $dateStart ) || $dateRangeStart === false ) {
                $dateRangeStart = strtotime( "-1 month", $dateRangeEnd );
            }
            
            $dateStart = date('m/d/Y', $dateRangeStart);
            $dateEnd   = date('m/d/Y', $dateRangeEnd); 
            
            $urlBase  = 'admin.php?page=wp-sociallocker-stats';
            $postBase = $urlBase . '&cdatestart=' . $dateStart . '&cdateend=' . $dateEnd;
        ?>
        
        <!--Load the GChart API-->
        <?php
        $plgurl    = plugin_dir_url( dirname(__FILE__) );
        $chartData = $this->getChartData( $postId, $dateRangeEnd, $dateRangeStart );
        ?>
        <script type="text/javascript" src="<?php echo $plgurl; ?>js/statistic.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1.0', {'packages':['corechart']});
            google.setOnLoadCallback(function(){
                ipsl_statistic.drawChart();
            });
            window.chartData = [
                <?php 
                foreach($chartData as $dataRow) { 
                ?>
                {
                    'date': new Date(<?php echo $dataRow['year'] ?>,<?php echo $dataRow['mon'] ?>,<?php echo $dataRow['day'] ?>),
                    'facebook-like': <?php echo $dataRow['facebook_like_count'] ?>,
                    'twitter-tweet': <?php echo $dataRow['twitter_tweet_count'] ?>,
                    'facebook-share': <?php echo $dataRow['facebook_share_count'] ?>,
                    'twitter-follow': <?php echo $dataRow['twitter_follow_count'] ?>,
                    'google-plus': <?php echo $dataRow['google_plus_count'] ?>,
                    'google-share': <?php echo $dataRow['google_share_count'] ?>,
                    'linkedin-share': <?php echo $dataRow['linkedin_share_count'] ?>,
                    'timer': <?php echo $dataRow['timer_count'] ?>,
                    'close': <?php echo $dataRow['close_count'] ?>
                },
                <?php } ?>
            ];
        </script>
        <link media="all" type="text/css" href="<?php echo $plgurl; ?>css/datepicker.css" rel="stylesheet">
            <div id="ipsl-locker-stats" class="wrap">
                <div id="icon-page-iplocker-stats" class="icon32">
                    <br>
                </div>
                <h2><?php _e( 'Graph Stats' ); ?></h2>
                
                <p><?php _e( 'This page provides statistical data on the number of user interactions on your social buttons. Data on the number of interaction presented in graphic.' ); ?></p>
                <p><?php _e( 'By default the chart shows the aggregate data for all posts. Click on the post title to view info for the one.' ); ?></p>
                
                <div id="ipsl_messages"></div>
                
                <div class="ipsl-main">
                    <form method="get" action="">
                    
                    <div class="ipsl-stats-chart">
                        
                        <div class="ipsl-chart-header ipsl-clear">
                            <div class="ipsl-chart-menu">
                               <div class="button-group" id="ipsl-chart-type" data-toggle="buttons-radio">
                                  <button type="button" class="button button-large active type-total" data-value="total"><i class="icon-total"></i> Total</button>
                                  <button type="button" class="button button-large type-detailed" data-value="detailed"><i class="icon-detail"></i> Detailed</button>
                                  <button type="button" class="button button-large type-helpers" data-value="helpers"><i class="icon-help"></i> Helpers</button>
                                </div>
                            </div>
                            <div class="ipsl-filter-date">
                                <input type="hidden" name="cpostid" value="<?php echo $postId; ?>" />
                                <span class="date-range-label">Date range:</span>
                                <input type="text" id="date-start" name="cdatestart" value="<?php echo $dateStart; ?>" />
                                <input type="text" id="date-end" name="cdateend" value="<?php echo $dateEnd; ?>" />
                                <input type="submit" id="date-range-apply" class="button button-large" value="Apply" />
                            </div>
                        </div>
                        <div class="ipsl-chart-body">
                            <div id="ipsl-chart">
                            
                            </div>
                        </div>
                        <div class="ipsl-chart-selector">
                            <ul>
                                <li class="ipsl-selector facebook-like">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Facebook Like' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector facebook-share">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Facebook Share' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector twitter-tweet">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Twitter Tweet' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector twitter-follow">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Twitter Follow' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector google-plus">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Google Plus' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector google-share">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Google Share' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector linkedin-share">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'LinkedIn Share' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector timer">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Timer' ); ?>
                                    </a>
                                </li>
                                <li class="ipsl-selector close">
                                    <a href="">
                                        <span class="ipsl-chart-color"></span>
                                        <?php _e( 'Close' ); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <input type="hidden" name="page" value="wp-sociallocker-graph" />
                    </form>
                </div>
            </div>
        <?php
        }

        /**
         * Get chart data
         *
         * @param  int    $postId
         * @param  string $dateRangeEnd
         * @param  string $dateRangeStart
         * @return void
         */
        public function getChartData( $postId = 0, $dateRangeEnd = '', $dateRangeStart = '' )
        {
            global $wpdb;
            
            $rangeStartStr = gmdate("Y-m-d", $dateRangeStart);
            $rangeEndStr   = gmdate("Y-m-d", $dateRangeEnd);
            
            $extraWhere = '';
            if ( ! empty( $postId ) ) {
                $extraWhere .= 'AND post_id=' . $postId;
            }
            
            $sql = "
                SELECT 
                    aggregate_date AS aggregate_date,
                    SUM(total_count) AS total_count,
                    SUM(facebook_like_count) AS facebook_like_count,
                    SUM(twitter_tweet_count) AS twitter_tweet_count,
                    SUM(google_plus_count) AS google_plus_count,
                    SUM(facebook_share_count) AS facebook_share_count,
                    SUM(twitter_follow_count) AS twitter_follow_count,
                    SUM(google_share_count) AS google_share_count,
                    SUM(linkedin_share_count) AS linkedin_share_count,
                    SUM(timer_count) AS timer_count,
                    SUM(close_count) AS close_count
                FROM 
                    {$wpdb->prefix}ip_social_tracking
                WHERE 
                    (aggregate_date BETWEEN '$rangeStartStr' AND '$rangeEndStr') $extraWhere
                GROUP BY 
                    aggregate_date";
        
            $data = $wpdb->get_results($sql, ARRAY_A);
            $resultData  = array();
            $currentDate = $dateRangeStart;
            while($currentDate <= $dateRangeEnd) {
       
                $phpdate = getdate($currentDate);
                $resultData[$currentDate] = array(
                    'day'                   => $phpdate['mday'],
                    'mon'                   => $phpdate['mon'] - 1,
                    'year'                  => $phpdate['year'],
                    'timestamp'             => $currentDate,

                    'total_count'           => 0,
                    'facebook_like_count'   => 0,
                    'twitter_tweet_count'   => 0,
                    'google_plus_count'     => 0,
                    'facebook_share_count'  => 0,
                    'twitter_follow_count'  => 0,
                    'google_share_count'    => 0,
                    'linkedin_share_count'  => 0,
                    'timer_count'           => 0,
                    'close_count'           => 0 
                );
                $currentDate = strtotime("+1 days", $currentDate);
            }
            
            foreach($data as $index => $row) {
                $timestamp = strtotime( $row['aggregate_date'] );
                $phpdate = getdate($timestamp);
                
                $data[$index]['day'] = $phpdate['mday'];
                $data[$index]['mon'] = $phpdate['mon'] - 1; 
                $data[$index]['year'] = $phpdate['year']; 
                $data[$index]['timestamp'] = $timestamp; 
                
                $resultData[$timestamp] = $data[$index];
            }

            return $resultData;
        }

        /**
         * Get table data
         *
         * @param  string $dateRangeEnd
         * @param  string $dateRangeStart
         * @param  int    $count
         * @param  int    $page
         * @param  string $order
         * @return void
         */
        public function getTableData( $dateRangeEnd = '', $dateRangeStart = '', $count = 40, $page = 1, $order = 'total_count' )
        {
            global $wpdb, $table_prefix;
            
            $table      = $table_prefix . 'ip_social_tracking';
            $postId     = 0;
            $extraWhere = '';
            if ( ! empty( $_GET['cpostid'] )) {
                $postId = absint( $_GET['cpostid'] );
                $extraWhere .= 'AND post_id=' . $postId;
            }
            $rangeStartStr = gmdate("Y-m-d", $dateRangeStart);
            $rangeEndStr   = gmdate("Y-m-d", $dateRangeEnd);
            
            $offset = $count*($page-1);
            
            $sql = "
                SELECT 
                    t.post_id AS ID,
                    p.post_title AS title,
                    SUM(t.total_count) AS total_count,
                    SUM(t.facebook_like_count) AS facebook_like_count,
                    SUM(t.twitter_tweet_count) AS twitter_tweet_count,
                    SUM(t.google_plus_count) AS google_plus_count,
                    SUM(t.facebook_share_count) AS facebook_share_count,
                    SUM(t.twitter_follow_count) AS twitter_follow_count,
                    SUM(t.google_share_count) AS google_share_count,
                    SUM(t.linkedin_share_count) AS linkedin_share_count, 
                    SUM(t.timer_count) AS timer_count,
                    SUM(t.close_count) AS close_count
                FROM 
                    {$wpdb->prefix}ip_social_tracking AS t
                INNER JOIN
                    {$wpdb->prefix}posts AS p ON p.ID = t.post_id
                WHERE 
                    (aggregate_date BETWEEN '{$rangeStartStr}' AND '{$rangeEndStr}') $extraWhere
                GROUP BY 
                    t.post_id
                ORDER BY $order DESC
                LIMIT $offset, $count";
                
            $results = $wpdb->get_results( $sql );
            
            return $results;
        }
    }
}
?>