<?php get_header();?>
<main class="subpage">
  <section class="categories">
    <ul>
      <li><a href="<?php echo site_url();?>/cat01"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat01.jpg" alt="ONE PIECE CARD GAME"></a></li>
      <li><a href="<?php echo site_url();?>/cat02"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat02.jpg" alt="ポケモンカードゲーム"></a></li>
      <li><a href="<?php echo site_url();?>/cat03"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat03.jpg" alt="ドラゴンボールカードゲーム"></a></li>
      <li><a href="<?php echo site_url();?>/cat04"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cat04.jpg" alt="その他"></a></li>
    </ul>
  </section>

  <section class="search-filter">
    <div>
      <input type="text" placeholder="商品名で検索">
      <button>検索</button>
    </div>
  </section>

  <section class="wrap contact tokushoho">
    <ul class="breadcrumb">
      <li><a href="<?php echo home_url(); ?>">トップページ</a></li>
      <li>特定商取引法に関する記述</li>
    </ul>
    <h2>特定商取引法に関する記述</h2>

    <table border="1" cellpadding="8" cellspacing="0">
      <tbody>
        <tr>
          <th>販売者名</th>
          <td>合同会社リベルタ</td>
        </tr>
        <tr>
          <th>運営統括責任者</th>
          <td>佐藤由紀夫</td>
        </tr>
        <tr>
          <th>所在地</th>
          <td>東京都港区浜松町2-2-15-503</td>
        </tr>
        <tr>
          <th>免許・資格</th>
          <td>東京都公安委員会　古物商許可番号　第11111号</td>
        </tr>
        <tr>
          <th>連絡先</th>
          <td>
            TEL：03-6435-9861<br>
            MAIL：info@aaaaa.net<br>
            または「お問い合わせ」ページよりご連絡ください。
          </td>
        </tr>
        <tr>
          <th>営業時間</th>
          <td>
            平日　9時～18時<br>
            土日祝　11時～17時<br>
            ※年末年始を除く
          </td>
        </tr>
        <tr>
          <th>お支払い方法</th>
          <td>クレジットカード払い、銀行振込</td>
        </tr>
        <tr>
          <th>商品引き渡し時期</th>
          <td>入金確認後２営業日以内に発送させていただきます。</td>
        </tr>
        <tr>
          <th>商品引き渡し方法</th>
          <td>ゆうパックにてお届けいたします。</td>
        </tr>
    </table>
  </section>
</main>
<?php get_footer(); ?>