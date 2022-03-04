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
$types = $_GET['types'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = $_GET['email'];
$company = $_GET['company'];
echo "<input type='hidden' value='".$types[1]."' />";
echo "<input type='hidden' value='".$fname[1]."' />";
echo "<input type='hidden' value='".$lname[1]."' />";
echo "<input type='hidden' value='".$email[1]."' />";
echo "<input type='hidden' value='".$company[1]."' />";
?>
<?php
if ($types[1] != 'free') {
    echo '<a target="_blank" href="https://buy.ticketforevent.com/script/redirectForm.php?alias=p3week&promocode=deloros123&types[1]='.$types[1].'&fname[1]='.$fname[1].'&lname[1]='.$lname[1].'&email[1]='.$email[1].'&company[1]='.$company[1].'">
    <input type="button" name="subbutton" class="btn btn-default active" value="оплатить участие" />
</a>';
}
?>