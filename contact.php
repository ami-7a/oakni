<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // POSTでのアクセスでない場合
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    // フォームがサブミットされた場合（POST処理）
    // 入力された値を取得する
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // エラーメッセージ・完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    // 空チェック
    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
    }
    
    // エラーなし（全ての項目が入力されている）
    if ($err_msg == '') {
        $to = "ami7a121@gmail.com"; // 管理者のメールアドレスなど送信先
        // Yudaiより下記を追加
        $from = "Amy <" . $email . ">";

        // Yudaiより下記の1行変更
        // $headers = "From: " . $email . "\r\n"
        // Yudaiより下記を追加
        // 下記コメントアウトはコードの説明
            // Content-Type – メール形式
            // Return-Path – 送信先メールアドレスが受け取り不可の場合に、エラー通知のいくメールアドレス
            // From – 送信者の名前（または組織名）とメールアドレス
            // Sender – 送信者の名前（または組織名）とメールアドレス
            // Reply-To – 受け取った人に表示される返信の宛先
            // Organization – 送信者名（または組織名）
            // X-Sender – 送信者のメールアドレス
            // X-Priority – メールの重要度を表す
        $headers = '';
        $header .= "Content-Type: text/plain \r\n";
        $header .= "Return-Path: " . $to . " \r\n";
        $header .= "From: " . $from ." \r\n";
        $header .= "Sender: " . $from ." \r\n";
        $header .= "Reply-To: " . $email . " \r\n";
        $header .= "Organization: " . $name . " \r\n";
        $header .= "X-Sender: " . $email . " \r\n";
        $header .= "X-Priority: 3 \r\n";


        // 本文の最後に名前を追加
        $message .= "\r\n\r\n" . $name;

        // メール送信
        mb_send_mail($to, $subject, $message, $headers);

        // 完了メッセージ
        $complete_msg = "It's done!<br>Thank you for contacting me. <br>We will contact you by email within 3 days. <br>Please wait a moment.";

        // 全てクリア
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オークニエステート：お問い合わせ</title>
    <meta name="description" content="福岡でのお住まい探し、ワークスペース探し">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/ress.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/contact.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ibarra+Real+Nova&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=WindSong&display=swap" rel="stylesheet">


    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">


    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- ハンバーガーメニュー -->
    <script>
      $(function() {
        $('.three_line').on("click", function(){
    
        $(this).toggleClass('open');
        $('#gnav').toggleClass('open');
      });
    });
    
    // メニューをクリックされたら、非表示にする
    $(function() {
      $('.gnav-menu li a').on("click", function(){
        $('#gnav').removeClass('open');
      });
    });
    </script>
    
  </head>
  <body>

    <header class="header">
      <!-- ヘッダー左（ロゴ、会社名） -->
      <section class="header-left">
        <div class="site-logo"><img src="img/site-logo.png" alt="ロゴ"></div>
        <p class="site-title">OAKNI ESTATE</p>
      </section>
      
      <!-- ヘッダー右（グロナビ） -->
      <section class="header-right">
        <nav id="nav">

          <li><a href="index.html" target="_blank" rel="noopener noreferrer">
            <span class="en">TOP</span>
            <span class="jp">トップ</span></a>
          </li>

          <li><a href="rooms.html" target="_blank" rel="noopener noreferrer" >
            <span class="en">ROOMS</span>
            <span class="jp">賃貸物件</span></a>
          </li>
            

          <li><a href="furniture.html" target="_blank" rel="noopener noreferrer" >
            <span class="en">FURNITURE</span>
            <span class="jp">家具のリース</span></a>
          </li>

          <li><a href="company.html" target="_blank" rel="noopener noreferrer" >
            <span class="en">COMPANY</span>
            <span class="jp">会社について</span></a>
          </li>

          <li><a href="contact.php" target="_blank" rel="noopener noreferrer" >
            <span class="en">CONTACT</span>
            <span class="jp">お問い合わせ</span></a>
          </li>

        </nav>
      </section>


      <!-- ハンバーガーメニュー -->
      <div id="hamburger">
        <section>
          <div class="three_line" id="btnA">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </section>

        <!--ハンバーガー内のグロナビ-->
        <nav id="gnav">
          <div class="gnav-menu">

            <div class="gnav-img"><img src="img/oakni-logo.png" alt=""></div>

            <ul>
              <li><a href="index.html" target="_blank" rel="noopener noreferrer">
                <span>トップページ</span></a>
              </li>
    
              <li><a href="rooms.html" target="_blank" rel="noopener noreferrer" >
                <span>賃貸物件情報</span></a>
              </li>
                
    
              <li><a href="furniture.html" target="_blank" rel="noopener noreferrer" >
                <span>家具のリース</span></a>
              </li>
    
              <li><a href="company.html" target="_blank" rel="noopener noreferrer" >
                <span>会社概要</span></a>
              </li>
            </ul>

            <!-- ハンバーガーお問い合わせボタン -->
            <section class="contact02">
              <a class="contact-btn02" href="contact.php">
                <span>お問い合わせ</span>
              </a>
            </section>
          </div>

          <!--ハンバーガー内SNSセクション-->
          <ul class="sns-btns">
  
            <li><a href="https://www.instagram.com/oakni_estate/?hl=ja" class="flowbtn insta"><i class="fab fa-instagram"></i></a></li>
      
            <li><a href="https://line.me/ti/p/%ライン＠のアカウント" class="flowbtn line"><i class="fab fa-line"></i></a></li>

            <li><a href="mailto:oak@oakni-estate.co.jp" class="flowbtn mail"><i class="far fa-envelope"></i></a></li>
            </ul>
        </nav>
      </div>

    </header>

    <main class="second-main">

      <!-- 共通h1・h2 -->
      <h2>Contact us</h2>
      <h3>コンタクトフォーム</h3>

      <?php if ($err_msg != ''): ?>
          <div class="alert alert-danger">
      <?php echo $err_msg; ?>
          </div>
      <?php endif; ?>

      <?php if ($complete_msg != ''): ?>
          <div class="alert alert-success">
              <?php echo $complete_msg; ?>
          </div>
      <?php endif; ?> 
            
      <form class="form" method="post">

        <li class="form-left">
          <img src="img/contact-img.jpg" alt="">
        </li>

        <li class="form-right">
          
            <!-- Name -->
          <div class="txt-area">
            <p>お名前</p>
            <input type="text"  name="name"  value="<?php echo $name; ?>">
          </div>
          

          <!-- Email -->
          <div class="txt-area">
            <p>メールアドレス</p>
            <input type="text"  name="email"  value="<?php echo $email; ?>">
          </div>
          

          <!-- Subject -->
          <div class="txt-area">
            <p>件名</p>
            <input type="text"  name="subject" value="<?php echo $subject; ?>">
          </div>
          

          <!-- Content -->
          <div class="txt-area">
            <p>お問い合わせ内容</p>
          <textarea  name="message" rows="5" ><?php echo $subject; ?></textarea>
          </div>
          

          <div class="sent-btn">
            <button type="submit">Submit</button>
          </div>

        </li>

      </form> 


    </main>
    
    <footer class="footer">
      <!-- 共通フッター -->
      <section class="main-footer">
        <section class="footer-left">
          <img class="footer-logo" src="img/oakni-logo.png" alt="">
          <div class="footer-adress">
            <p class="comapny-name">株式会社オークニエステート</p>
            <p class="adress">〒810-0023<br><a href="company.html" target="_blank" rel="noopener noreferrer" >福岡市中央区警固2-1-17-902</a></p>
            <p class="footer-tel"><a href="tel:092-716-8265" target="_blank" rel="noopener noreferrer" >tel:092-716-8265</a></p>
          </div>
        </section>

        <section class="footer-right">
          <li><a href="index.html" target="_blank" rel="noopener noreferrer" >
            <span>TOP</span></a>
          </li>

          <li><a href="rooms.html" target="_blank" rel="noopener noreferrer" >
          <span>ROOMS</span></a>
          </li>
          
          <li><a href="furniture.html" target="_blank" rel="noopener noreferrer" >
          <span>FURNITURE</span></a>
          </li>

          <li><a href="company.html" target="_blank" rel="noopener noreferrer" >
          <span>COMPANY</span></a>
          </li>

          <li><a href="contact.php" target="_blank" rel="noopener noreferrer" >
          <span>CONTACT</span></a>
          </li>

        </section>
      </section>

      <section class="copy-right">
        <p>©︎ 2021, Oakni Estate, All Rights Reserved.</p>
      </section>
    
    </footer>
  
  </body>
</html>