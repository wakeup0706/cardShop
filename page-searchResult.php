<?php
get_header();
set_post_views(get_the_ID());

$search_key = isset($_GET["search_key"]) ? sanitize_text_field($_GET["search_key"]) : '';
$tag_key    = isset($_GET["tag_key"]) ? sanitize_text_field($_GET["tag_key"]) : '';
$initial_key    = isset($_GET["initial_key"]) ? sanitize_text_field($_GET["initial_key"]) : '';
$summary_key    = isset($_GET["summary_key"]) ? sanitize_text_field($_GET["summary_key"]) : '';
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/Pages/recent.css" />   
    <main>
        <section class="allVision inConteiner">
            <div class="breadcrumb"><span><a href="<?php echo home_url(); ?>">TOP</a></span><?php if (!empty($search_key) || !empty($tag_key)): ?><span>> すべてのカテゴリ</span><?php else : ?><span>> <a href="<?php echo get_stylesheet_directory_uri(); ?>/eyeglossary">目の用語辞典</a></span><?php endif; ?></div>
            <div class="space"></div>
            <div class="visionDictionaryTitle">
                <div class="visionDictionaryIcon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/Icons/testResult.png" alt="testResult"></div>
                <div class="section-title">
                    <div id="searchID">
                        <?php if (!empty($search_key)): ?>
                            <p class='text-top'>検索結果 : <span style='font-size:14px'>"<?php echo esc_html($search_key); ?>"</span><span style='font-size:18px'>の検索結果</span></p>
                        <?php elseif (!empty($tag_key)): ?>
                            <p class='text-top'>タグ検索 : <span style='font-size:14px'>"<?php echo esc_html($tag_key); ?>"</span><span style='font-size:18px'>の検索結果</span></p>
                        <?php elseif (!empty($initial_key)): ?>
                            <p class='text-top'>頭文字 : <span style='font-size:14px'>"<?php echo esc_html($initial_key); ?>"</span><span style='font-size:18px'>の検索結果</span></p>
                        <?php elseif (!empty($summary_key)): ?>
                            <p class='text-top'>分類 : <span style='font-size:14px'>"<?php echo esc_html($summary_key); ?>"</span><span style='font-size:18px'>の検索結果</span></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div>
                <script type="text/javascript">
                    $(document).ready(function($) {
                        const url = new URL(window.location.href);
                        const params = new URLSearchParams(url.search);
                        const search_key = params.get('search_key');
                        const summary_key = params.get('summary_key');
                        const initial_key = params.get('initial_key');
                        if(!search_key && !initial_key && !summary_key) return;
                        console.log("search_key",search_key, "------initial_key",initial_key, "------summary_key",summary_key);
                        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                        let sort = "post_date DESC";
                        function cvf_load_all_posts(page){
                            $(".cvf_pag_loading").fadeIn().css('background','#ccc');// the value in 'action' is the key that will be identified by the 'wp_ajax_' hook
                            var data = {
                                page: page,
                                action: "demo-all-load-posts",
                                sort: sort,
                                per_page: 15,
                                search_key: search_key,
                                summary_key: summary_key,
                                initial_key: initial_key,
                            };
                            $.post(ajaxurl, data, function(response) {
                                $(".cvf_all_universal_container").html(response);
                                $(".cvf_pag_loading").css({'background':'none', 'transition':'all 1s ease-out'});
                            });
                        }
                        $(document).on('click', '.cvf_all_universal_container .cvf-universal-pagination li.active', function(){ 
                            var page = $(this).attr('p');
                            cvf_load_all_posts(page);
                        });
                        cvf_load_all_posts(1);
                    });
                </script>
                <div class = "cvf_all_pag_loading">
                    <div class = "cvf_all_universal_container">
                   		<div class="popularArticle">
                <?php
                if ( $tag_key ) {
                    $args = array(
                        'post_type' => get_post_types( array( 'public' => true ) ),
                        'tag'       => $tag_key, // tag slug
                        'posts_per_page' => 15
                    );
                
                    $query = new WP_Query( $args );
                
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            echo '<div class="seeMoreArticle" onclick="location.href=\'' . get_permalink() . '\';">
                                ' . (has_post_thumbnail($post->ID) ? get_the_post_thumbnail($post->ID, 'full', array('class' => 'article-thumbnail')) : '<img src="' . get_stylesheet_directory_uri() . '/assets/img/articles/default-article.jpg" alt="' . esc_attr(get_the_title($post->ID)) . '">') . '
                                <div class="articleContent">
                                    <div class="articleType">
                                        <div class="articleType-text"><p>' . wp_get_post_terms($post->ID, 'category', array('fields' => 'names'))[0] . '</p></div>
                                        <div class="articleType-mark"><img src="'.get_stylesheet_directory_uri().'/assets/img/Icons/mark.png" alt="mark"></div>
                                    </div>
                                    <div class="articleContent-date"><p>'. get_the_date('Y.m.d', $post->ID) .'</p></div>
                                    <div class="articleContent-text">
                                        <p>' . get_the_title() . '</p>
                                    </div>
                                </div>
                            </div>';
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<p>No posts found with this tag.</p>';
                    }
                }
                ?>
                </div>
                 </div>
                </div>
            </div>
        </section>
        <section class="visionImproment">
            <div class="backgroundImg"></div>
            <div class="baners flex space-between">
                <div class="baner leftBaner" onclick="javascript:window.open('https://www.heallite.com/c/desklight/gentlite/M0002', '_blank');"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/land_banner1.jpg" alt=""></div>
                <div class="baner rightBaner" onclick="location.href='<?php echo site_url();?>/visionpossibility';"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/land_banner2.jpg" alt=""></div>
            </div>
        </section>
        <section class="endBanner">
            <div class="container"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/eyetest_baner.jpg" alt="eyetest_baner"></div>
        </section>
    </main>
    <?php get_footer(); ?>