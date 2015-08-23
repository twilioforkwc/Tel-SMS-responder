<?php

    $callFrom = isset($_POST['From']) ? $_POST['From'] : "";
    $callFromStr = substr($callFrom, 3, 2);

    $callFromStrPHS = "false";
    if ($callFromStr == "70"){
      $callFromStrPHS = substr($callFrom, 3, 3);
    }

    header("content-type: text/xml");

    // 携帯判別 090/080/0705/0706 を携帯として認識
    if ($callFromStr == "90" || $callFromStr == "80" || (($callFromStrPHS != "705" && $callFromStrPHS != "706") && $callFromStrPHS != "false")) {
?>
      <Response>
        <Say language="ja-jp">
		<!--- 携帯電話からかかってきた時のアナウンス -->
        	ご連絡いただきましてありがとございます。
        	今お掛けいただいた携帯電話にゆうあーるえるをお送りいたします。
        	到着までしばらくお待ち下さい。
        	ご利用ありがとうございました。
        </Say>
        <Sms from="+1XXXXXXXXXX" to="<?php echo htmlspecialchars($callFrom, ENT_QUOTES, 'UTF-8'); ?>">URLをお送りしております。 twilio.kddi-web.com</Sms>
        <Hangup/>
      </Response>
<?php } else { ?>
      <Response>
        <Say language="ja-jp">
		<!--- 携帯電話以外からかかってきた時のアナウンス -->
	        ご連絡いただきましてありがとございます。
		お使いの電話が固定電話のためSMSを送信することができません。
		お手数ですが携帯電話からおかけ直し下さい。
		ご利用ありがとうございました。
        </Say>
        <Hangup/>
      </Response>
<?php } ?>
