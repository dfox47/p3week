<style>
    .btn-default.active {
        background-color: rgb(0, 255, 61);
    }
    .moduletable-buybtn {
        float: right;
        margin-right: 10px;
    }
    .moduletable-buybtn input {
        text-transform: uppercase;
        color: #fff !important;
        -webkit-box-shadow: 0px 2px 4px 0px rgba(177,177,177,1) !important;
        -moz-box-shadow: 0px 2px 4px 0px rgba(177,177,177,1);
        box-shadow: 0px 2px 4px 0px rgba(177,177,177,1);
        background: #FFF;
        padding: 10px;
        margin-top: -7px;
        text-shadow: 1px 1px 2px rgba(150, 150, 150, 1);
        border-bottom:0;
    }
</style>
<?php

foreach ($items as $item) {
    $email = $item->Email;
    if($item->statusuchastiya == 'Стандарт (17-18 или 19 марта)'){$types = 'standard';}
    if($item->statusuchastiya == 'Бизнес (17-18 или 19 марта)'){$types = 'business';}
    if($item->statusuchastiya == 'Премиум (17-19 марта)'){$types = 'premium';}
    if($item->statusuchastiya == 'VIP (17-20 марта)'){$types = 'vip';}
    if($item->statusuchastiya == 'Образование (20 марта)'){$types = 'education';}
    if($item->statusuchastiya == 'Органы власти (17-19 марта)'){$types = 'free';}
    if($item->statusuchastiya == 'Спонсор'){$types = 'free';}
    if($item->statusuchastiya == 'СМИ'){$types = 'free';}
    $fname = $item->imya;
    $lname = $item->name;

}
?>
<a class="epts-cb" target="_blank" href="http://p3week.ticketforevent.com/ru/">Купить билет</a><style type="text/css">.epts-cb{font-family:Arial !important; display:inline-block !important; zoom:1 !important; border-radius:5px !important; -moz-border-radius:5px !important; -webkit-border-radius:5px !important; border-style:solid !important; border-width:1px !important; text-decoration:none !important; font-weight:bold !important; line-height:1 !important;color:#f8f8f8 !important; box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.8) inset; text-shadow:0 -1px 0 rgba(0,0,0,.2) !important; text-decoration:none; background-color:#80a048 !important; border-color:#4DA90F !important; background-clip: padding !important; background-image: -moz-linear-gradient(top, #93ED43, #80a048) !important; background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #93ED43),color-stop(1, #80a048)) !important; background-image: -webkit-linear-gradient(#93ED43, #80a048) !important; background-image: -o-linear-gradient(top, #93ED43, #80a048) !important; background-image: linear-gradient(top, #93ED43, #80a048) !important; filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#93ED43', EndColorStr='#80a048' ) !important;font-size: 16px !important; padding: 13px 20px !important;} .epts-cb:hover, .epts-cb:focus{border-color:#4DA90F !important; color:#fff !important; background-color:#709038 !important; box-shadow: 0 0 0 1px #fff inset, 0 0 0 2px rgba(100, 200, 50, 0.3);}</style>
<!--
<a target="_blank" href="https://buy.ticketforevent.com/script/redirectForm.php?alias=eventtest&promocode=test10&types[1]=<?php echo $types; ?>&fname[1]=<?php echo $fname; ?>&lname[1]=<?php echo $lname; ?>&email[1]=<?php echo $email; ?>">
    <input type="button" name="subbutton" class="btn btn-default active" value="оплатить участие" />
</a>
-->