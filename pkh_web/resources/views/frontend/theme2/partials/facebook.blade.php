<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
    FB.init({
    xfbml            : true,
    version          : 'v7.0'
    });
};

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
attribution=setup_tool
page_id="1754395411550628"
theme_color="#0084ff"
logged_in_greeting="Phan Khang Home kính chào quý khách!!! Chúng tôi có thề giúp gì cho quý khách?"
logged_out_greeting="Phan Khang Home kính chào quý khách!!! Chúng tôi có thề giúp gì cho quý khách?">
</div>