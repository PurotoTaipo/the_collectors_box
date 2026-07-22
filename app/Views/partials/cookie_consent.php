<?php if (empty($_COOKIE['cookie_consent'])): ?>
<div class="cookie-overlay" id="cookie-banner">
    <div class="cookie-banner">

        <p>
            <img src="<?= BASE_URL ?>/images/svg/brush-shape.svg" width="100"/>
        </p>


        <p>This page uses cookies.</p>
        <button onclick="
            document.cookie = 'cookie_consent=1; max-age=31536000; path=/; SameSite=Lax';
            document.getElementById('cookie-banner').remove();
        ">Accept</button>
    </div>
</div>
<?php endif; ?>
