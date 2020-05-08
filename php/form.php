<?php
echo<<<EOF
<form class="login-form bg-white p-6 mx-auto border bd-default win-shadow" data-role="validator"
data-on-submit="Login(document.getElementById('email').value,document.getElementById('password').value)"
style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);z-index:10;width:350px;height:auto;top:50%;"
data-clear-invalid="2000" data-on-error-form="invalidForm" data-on-validate-form="validateForm">
<span class="mif-vpn-lock mif-4x place-right" style="margin-top: -10px;"></span>
<h2 class="text-light">Login to service</h2>
<hr class="thin mt-4 mb-4 bg-white">
<div class="form-group">
    <input id="email" type="text" data-role="input" data-prepend="<span class='mif-envelop'>"
        placeholder="Enter your email..." data-validate="required email">
</div>
<div class="form-group">
    <input id="password" type="password" data-role="input" data-prepend="<span class='mif-key'>"
        placeholder="Enter your password..." data-validate="required minlength=6">
</div>
<div class="form-group mt-10">
    <input id="checkbox" type="checkbox" data-role="checkbox" data-caption="Remember me" class="place-right">
    <button class="button bg-cyan bg-lightGreen-hover bg-darkRed-active fg-white">Login</button>
    <input type="button" class="button" value="Cancel">
</div>
</form>
EOF;
?>