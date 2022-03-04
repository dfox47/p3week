<script src="/modules/mod_one_event/tmpl/js/jquery.cookie.js"></script>
<style>
    .hidden {
        display: none;
    }
	.onetime {
		background: url(/images/hmm.png) 0 0 no-repeat;
		width: 918px;
		height: 612px;
		position: fixed;
		top: 50%;
		margin-top: -306px;
		left: 50%;
		margin-left: -459px;
		z-index: 1111;
	}
	.darkside {
		position: fixed;
		width: 100%;
		height: 100%;
		z-index:1110;
		background: #444455;
		opacity:0.8;
	}
	.onetime p {
		text-align: center;
		margin-top: 310px;
		font-family: "ProximaNovaRegular";
		font-size: 36px;
	}
	.onetime input {
	    border: none;
		color: #fff;
		background: #cf0000;
		display: block;
		font: 400 18px/52px 'ProximaNovaBold';
		height: 52px;
		text-align: center;
		width: 300px;
		margin: 0 auto;
		text-decoration: none;
		text-transform: uppercase;
		margin-top: 35px;
	}
	.closeicome {
		position:absolute;
		width: 24px;
		height: 24px;
		right:0;
		top:0;
		margin-right: 17px;
		margin-top: 13px;
		cursor: pointer;
	}
</style>

<div class="hidden weekchanges">
    <div class="darkside"></div>
    <div class="onetime">
		<div class="closeicome"><img src="/images/close-ico.png" /></div>
        <p>ВНИМАНИЕ! Изменения<br>в программе 31 марта</p>
        <input type="button" value="ПОСМОТРЕТЬ ИЗМЕНЕНИЯ">
    </div>
</div>