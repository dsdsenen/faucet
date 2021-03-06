<?php
    global $config;
    $oDB = @new mysqli($config["mysql_host"],$config["mysql_user"],$config["mysql_password"],$config["mysql_database"]);
    $hRes = $oDB->query("SELECT * FROM `video_ids`");
    $aRow = $hRes->fetch_array();
    $sVideoID = isset($aRow['yuoutube_video_id'])?$aRow['yuoutube_video_id']:'';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="author" content="Cryptocurrency faucet script" />

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <!-- Default CSS -->
    <link rel="stylesheet" href="./css/default.css" type="text/css" />

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="http://www.youtube.com/player_api"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>


    <!-- Bootstrap CDN Minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Bootstrap CDN Minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    {{HEAD}}

	<title>{{TITLE}}</title>

    <!-- Recaptcha theme -->
     <script type="text/javascript">
        var RecaptchaOptions = {
        theme : 'white'
     };
    </script>

</head>
<body style="visibility: hidden !important;">

<div id="wrapper" class="container">
<div id="babasbmsgx" style="visibility: visible !important;">Please disable your adblock and script blockers to view this page</div>
<center><h2><img src="images/BITG-LOGO.png" alt="" width="125" height="165"/>{{TITLE}} Faucet</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">About {{TITLE}}</h3>
    </div>
    <div class="panel-body">
TEXT HERE
<br/>
<br/>


      {{ADS}}
    </div>
</div>





<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">TRADE Bitcoin Green here</h3>
    </div>
    <div class="panel-body">
	<a href="https://wallet.crypto-bridge.org?r=crymesomefiat4"> <img src="images/CBridge.jpg" style='height: 65%; width: 65%; object-fit: contain'; align="middle"'>
        </a>

        <a href="https://www.coinexchange.io/market/BITG/BTC?r=378f380e"> <img src="images/CEio.png" style='height: 65%; width: 65%; object-fit: contain'>
	</a>

	<a href="https://www.cryptopia.co.nz/Register?referrer=CryMeSomeCrypto"> <img src="images/Cryptopia.png" style='height: 50%; width: 50%; object-fit: contain'>
        </a><br/>



    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Faucet Promo Video</h3>
    </div>
    <div class="panel-body">
	<div id="youtubevideo"></div>



<script>

    // create player
    var youtubevideo;
    function onYouTubePlayerAPIReady() {
        youtubevideo = new YT.Player('youtubevideo', {
          height: '390',
          width: '640',
          videoId: '<?php  echo($sVideoID); ?>',

    //Here the video autoplays, the player hide controls and disable keyboard to prevent users from running past the video. NB: Autoplay only works on PCs. iOS 8 also forces Native controls.

          playerVars:{'rel':0,'showinfo':0,'autoplay':0,'controls':0,'disablekb':1,'modestbranding':1},
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
    }

function onPlayerReady(event) {
    event.target.playVideo();
}
    //This tells the youtube player to trigger the hello() function when done watching the video

    function onPlayerStateChange(event) {
        if(event.data === 0) {
            showCupon();
        }
    }
    //THe hello function uses ajax to bring up html after the video ends. It is achieved using jquery DOM manupulation
    function showCupon(){
        jQuery.ajax({
                url:'/code.php',
                type: "POST",
                data: { },
                dataType: "json"
                   })
                .done(function (json) {
                    jQuery('#Code').html(json.code);
                }
             );
    }
</script>
        <div style="text-align: center; font-size: 16px; padding: 10px;">Your coupon code:</div>
        <div style="text-align: center; font-size: 22px; padding: 10px;border: 4px dashed #90b92d;color: #90b92d; border-radius: 8px;" id="Code">Will be available after watching video</div>
  </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Faucet stats</h3>
    </div>
    <div class="panel-body">
	{{TITLE}} Value: USD <span class="highlight"> ${{USD_VALUE}}</span> | BTC {{BTC_VALUE}}</br></br>

        Already paid: <span class="highlight" >{{TOTAL_PAYOUT}}</span> with <span class="highlight" >{{TOTAL_PROMO_PAYOUTS}}</span> promo on <span class="highlight" >{{NUMBER_OF_PAYOUTS}}</span> payouts.</span><br/><br/>

        How many payments are currently staged: <span class="highlight" >{{STAGED_PAYMENT_COUNT}}</span> payments.<br/>

        Total BITG staged to be sent : <span class="highlight" >{{SUM_STAGED_PAYMENTS}}</span> <br/>

        Payments will be sent after <span class="highlight" >{{STAGED_PAYMENT_THRESHOLD}}</span> staged payments.<br/>
        Operator fee: <span class="highlight" >{{OPERATOR_FEE}}%</span><br/><br/>
        You can get free {{COINNAME}} every <b>3 HOURS</b>.
  </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Please donate to keep this faucet flowing</h3>
    </div>
    <div class="panel-body">
	This faucet is funded by donations, to support the faucet signup through one of the Exchanges so BITGfaucet can keep flowing. <br/> <br/>
       BITG: {{DONATION_ADDRESS}}
    </div>
</div>

    <?php
        switch ($this->status())
        {
            case SF_STATUS_FAUCET_INCOMPLETE:
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            This faucet is incomplete, it may be missing settings or the RPC client is not available.
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_DRY_FAUCET:
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
	    This faucet is dry! Please donate. </br>
	    Balance: <span class="highlight" >{{BALANCE}}</span>
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_RPC_CONNECTION_FAILED:
            case SF_STATUS_MYSQL_CONNECTION_FAILED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Cannot seem to connect at the moment, please come back later!
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_PAYOUT_ACCEPTED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Success! You have been awarded with {{PAYOUT_AMOUNT}} {{COINNAME}}!
        </div>
    </div>
    <?php
    break;
            case SF_STATUS_PAYOUT_AND_PROMO_ACCEPTED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Success! You have been awarded with {{PAYOUT_AMOUNT}} {{COINNAME}}!<br/>
            Additionally, you received a bonus of {{PROMO_PAYOUT_AMOUNT}} {{COINNAME}}!
        </div>
    </div>
	<?php
	break;
            case SF_STATUS_PAYOUT_ERROR:
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Something went wrong, could not send you {{COINNAME}}... Please try again later.
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_PAYOUT_DENIED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            No more {{COINNAME}} for you! Try again later.
        </div>
    </div>
    <?php
    break;
            case SF_STATUS_PROXY_DETECTED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            You are using a proxy! Proxies are not allowed.
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_CAPTCHA_INCORRECT:
            case SF_STATUS_INVALID_CHAIN_ADDRESS:
            case SF_STATUS_OPERATIONAL:
	?>

    <form method="post" action="">
        <div class="input-group input-group-sm">
            <span class="input-group-addon">{{COINNAME}} address</span>
            <input  name="chaincoin_address" type="text" class="form-control" value="" placeholder="Enter your {{COINNAME}} address here" />
        </div>
        <div class="input-group input-group-sm margintop">
            <span class="input-group-addon">Promo code</span>
            <input name="promo_code" type="text" value="" class="form-control" placeholder="Promo code (optional)" />
        </div>
        <div class="margintop" id="captcha">{{CAPTCHA}}</div>
        <input id="send" name="chaincoin_submit" type="submit" class="btn btn-warning btn-md margintop" value="Send {{COINNAME}}" />
    </form>

	<?php
        if ($this->status() == SF_STATUS_INVALID_CHAIN_ADDRESS)
        {
    ?>
    <div class="panel panel-default margintop">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            You entered an invalid {{COINNAME}} address!
        </div>
    </div>
    <?php
    }
	   elseif ($this->status() == SF_STATUS_CAPTCHA_INCORRECT)
	{
	?>
    <div class="panel panel-default margintop">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            The CAPTCHA code you entered was incorrect!
        </div>
    </div>
    <?php
	}
    break;
    }
    ?>

<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Social/News</h3>

<a class="twitter-follow-button"
  href="https://twitter.com/btc_green"
  data-size="large">
Follow @TwitterDev</a>

    </div>

    <div class="panel-body">

<a class="twitter-timeline" data-width="460" data-height="500" href="https://twitter.com/btc_green?ref_src=twsrc%5Etfw">Tweets by Bitcoin Green</a>



<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    </div>
</div>
</div>
</center>


</body>
</html>
