<?php get_header();?>
<main class="subpage">
  <section class="categories">
    <ul>
      <li><a href="<?php echo site_url();?>/cat01.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat01.jpg" alt="ONE PIECE CARD GAME"></a></li>
      <li><a href="<?php echo site_url();?>/cat02.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat02.jpg" alt="ポケモンカードゲーム"></a></li>
      <li><a href="<?php echo site_url();?>/cat03.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat03.jpg" alt="ドラゴンボールカードゲーム"></a></li>
      <li><a href="<?php echo site_url();?>/cat04.html"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat04.jpg" alt="その他"></a></li>
    </ul>
  </section>

  <section class="search-filter">
    <div>
      <input type="text" placeholder="商品名で検索">
      <button>検索</button>
    </div>
  </section>

  <section class="wrap contact">
    <ul class="breadcrumb">
      <li><a href="<?php echo home_url(); ?>">トップページ</a></li>
      <li>お問い合わせ</li>
    </ul>
    <h2>お問い合わせ</h2>
    <p>ご不明な点等ございましたら、こちらからお問い合わせください。
      <span
        class="attention">※ご注文後にご注文内容等に関するお問い合わせはご注文時のお客様のお名前とメールアドレスをご入力ください。また、お客様よりいただく事の多いご質問につきましては「よくある質問」にてご紹介させていただいておりますので、こちらも合わせてご確認ください。</span>
    </p>
    <table>
      <tr>
        <th>お名前<span>必須</span></th>
        <td><input type="text" name="name"></td>
      </tr>
      <tr>
        <th>メールアドレス<span>必須</span></th>
        <td><input type="text" name="name"></td>
      </tr>
      <tr>
        <th>ご注文商品(商品名)</th>
        <td><input type="text" name="item"></td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td><textarea name="comment"></textarea></td>
      </tr>
      <tr>
        <td colspan="2"><button>送信する</button></td>
      </tr>
    </table>
  </section>
</main>
<?php get_footer(); ?>