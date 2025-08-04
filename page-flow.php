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

  <section class="wrap">

    <ul class="breadcrumb">
      <li><a href="<?php echo home_url(); ?>">トップページ</a></li>
      <li>お取引の流れ</li>
    </ul>
    <h2>お取引の流れ</h2>
    <dl>
      <dt class="flow_ttl"><span>1</span>購入したい商品を選ぶ</dt>
      <dd class="flow_txt">購入したい商品が決まりましたら、「カートに入れる」ボタンをクリックしてください。ショッピングカートに追加されます。</dd>
      <dt class="flow_ttl"><span>2</span>購入手続きに進む（レジに進む） </dt>
      <dd class="flow_txt">画面右上又はサイドのカートから、ショッピングカートのページへ進み「レジに進む」ボタンをクリックしてください。</dd>
      <dt class="flow_ttl"><span>3</span>ログインまたは会員登録をする</dt>
      <dd class="flow_txt">既に会員の方はログイン、初めての方は新規登録よりご登録をお済ませください。</dd>
      <dt class="flow_ttl"><span>4</span>購入手続きをする（会計をする） </dt>
      <dd class="flow_txt">カートの説明に従って、「購入者情報」「お届け先情報」「お支払い方法」などを決定します。</dd>
      <dt class="flow_ttl"><span>5</span>確認のメールが届きます </dt>
      <dd class="flow_txt">ご登録のメールアドレス宛てに購入内容のメールが届きます。</dd>
      <dt class="flow_ttl"><span>6</span>商品が届きます </dt>
      <dd class="flow_txt">商品発送のご連絡は、２営業日以内に指定住所へ発送いたします。</dd>
    </dl>
  </section>
</main>
<?php get_footer(); ?>