<div class="asap-section" id="asap-section-settings" <?php if ($active_tab != 'settings') { ?>style="display: none;"<?php } ?>>
    <div class="asap-network-wrap">
        <h4 class="asap-network-title"><?php _e('Facebook Account Details', AFAP_TD); ?></h4>

        <?php
        $account_details = get_option('afap_settings');
        $account_extra_details = get_option('afap_extra_settings');
        $authorize_status = $account_extra_details['authorize_status'];
        //$this->print_array($account_details);
//        $this->print_array($account_extra_details);
        ?>
        <?php if (isset($_SESSION['asap_message'])) { ?><p class="asap-authorize_note"><?php
            echo $_SESSION['asap_message'];
            unset($_SESSION['asap_message']);
            ?></p><?php } ?>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <input type="hidden" name="action" value="afap_fb_authorize_action"/>
            <?php wp_nonce_field('afap_fb_authorize_action', 'afap_fb_authorize_nonce'); ?>
            <input type="submit" name="asap_fb_authorize" value="<?php echo ($authorize_status == 0) ? __('Authorize', AFAP_TD) : __('Reauthorize', AFAP_TD); ?>" style="display: none;"/>
        </form>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <input type="hidden" name="action" value="afap_form_action"/>

            <?php wp_nonce_field('afap_form_action', 'afap_form_nonce') ?>
            <div class="asap-network-inner-wrap">
                <?php
                if ($authorize_status == 0) {
                    ?>
                    <p class="asap-authorize-note"><?php _e('It seems that you haven\'t authorized your account yet.The auto publish for this account won\'t work until you will authorize.Please authorize using below button', AFAP_TD); ?></p>
                    <?php
                }
                ?>
                <input type="button" class="asap-authorize-btn" id="asap-fb-authorize-ref" value="<?php echo ($authorize_status == 0) ? __('Authorize', AFAP_TD) : __('Reauthorize', AFAP_TD); ?>"/>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Auto Publish', AFAP_TD); ?></label>
                    <div class="asap-network-field"><input type="checkbox" value="1" name="account_details[auto_publish]" <?php checked($account_details['auto_publish'], true); ?>/></div>
                </div>

                <div class="asap-network-field-wrap">
                    <label><?php _e('Application ID', AFAP_TD); ?></label>
                    <div class="asap-network-field"><input type="text" name="account_details[application_id]" value="<?php echo isset($account_details['application_id']) ? esc_attr($account_details['application_id']) : ''; ?>"/></div>
                </div>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Application Secret', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <input type="text" name="account_details[application_secret]" value="<?php echo isset($account_details['application_secret']) ? esc_attr($account_details['application_secret']) : ''; ?>"/>
                        <div class="asap-field-note">
                            <?php
                            $site_url = site_url();
                            _e("Please visit <a href='https://developers.facebook.com/apps' target='_blank'>here</a> and create new Facebook Application to get Application ID and Application Secret.<br/><br/> Also please make sure you follow below steps after creating app.<br/><br/>Navigate to Apps > Settings > Edit settings > Website > Site URL. Set the site url as : $site_url ", AFAP_TD);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Facebook User ID', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <input type="text" name="account_details[facebook_user_id]" value="<?php echo isset($account_details['facebook_user_id']) ? esc_attr($account_details['facebook_user_id']) : ''; ?>"/>
                        <div class="asap-field-note">
                            <?php _e('Please visit <a href="http://findmyfacebookid.com/" target="_blank">here</a> to get your facebook ID', AFAP_TD); ?>
                        </div>
                    </div>
                </div>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Post Message Format', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <textarea name="account_details[message_format]"><?php echo $account_details['message_format']; ?></textarea>
                        <div class="asap-field-note">
                            <?php _e('Please use #post_title,#post_content,#post_excerpt,#post_link,#author_name for the corresponding post title, post content, post excerpt, post link, post author name respectively.', AFAP_TD); ?>
                        </div>
                    </div>
                </div>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Post Format', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <select name="account_details[post_format]">
                            <option value="simple" <?php echo (isset($account_details['post_format']) && $account_details['post_format'] == 'simple') ? 'selected="selected"' : ''; ?>><?php _e('Simple Text Message', AFAP_TD); ?></option>
                            <option value="link" <?php echo (isset($account_details['post_format']) && $account_details['post_format'] == 'link') ? 'selected="selected"' : ''; ?>><?php _e('Attach Blog Post', AFAP_TD); ?></option>
                        </select>
                    </div>
                </div>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Include Image', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <label class="asap-full-width"><input type="checkbox" name="account_details[include_image]" <?php if(isset($account_details['include_image'])){checked($account_details['include_image'], true); }?> value="1"/><?php _e('Check if you want to include the image in the post while attaching the blog post.', AFAP_TD); ?></label>
                    </div>
                </div>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Post Image', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <select name="account_details[post_image]">
                            <option value="featured_image" <?php selected($account_details['post_image'], 'featured_image'); ?>><?php _e('Featured Image', AFAP_TD); ?></option>
                            <option value="custom_image" <?php selected($account_details['post_image'], 'custom_image'); ?>><?php _e('Custom Image', AFAP_TD); ?></option>
                        </select>
                    </div>
                </div>
                <div class="asap-network-field-wrap asap-custom-image">
                    <label><?php _e('Custom Image URL', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <input type="text" name="account_details[custom_image_url]" placeholder="<?php _e('Enter URL of the image here', AFAP_TD); ?>" value="<?php echo esc_attr($account_details['custom_image_url']) ?>"/>
                    </div>
                </div>
                <div class="asap-network-field-wrap">
                    <label><?php _e('Auto Post Pages', AFAP_TD); ?></label>
                    <div class="asap-network-field">
                        <select name="account_details[auto_post_pages][]" multiple="">
                            <option value="1" <?php echo (isset($account_details['auto_post_pages']) && in_array(1, $account_details['auto_post_pages'])) ? 'selected="selected"' : ''; ?>><?php _e('Profile Page') ?></option>
                            <?php
                            if (isset($account_extra_details['pages']) && is_array($account_extra_details['pages'])) {
                                $pages = $account_extra_details['pages'];
                                //$this->print_array($pages);
                                if (count($pages) > 0) {
                                    foreach ($pages as $page) {
                                        ?>
                                        <option value="<?php echo $page->id; ?>" <?php echo (isset($account_details['auto_post_pages']) && is_array($account_details['auto_post_pages']) && in_array($page->id, $account_details['auto_post_pages'])) ? 'selected="selected"' : ''; ?>><?php echo $page->name; ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                        <div class="asap-field-note">
                            <?php _e('Note: Please use control or command key to select multiple options', AFAP_TD); ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('post-settings.php'); ?>

        </form>
    </div>

</div>