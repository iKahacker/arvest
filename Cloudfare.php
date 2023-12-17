<html class="no-js" lang="en-US">
<!--<![endif]-->

<head>
    <title>{domain} | 522: Connection timed out</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" id="cf_styles-css" href="https://files.killbot.org/.cdn-cgi/styles/cf.errors.css" type="text/css" media="screen,projection">
    <style type="text/css">
        body{margin:0;padding:0}
    </style>
</head>

<body>
    <div id="cf-wrapper">
        <div id="cf-error-details" class="cf-error-details-wrapper">
            <div class="cf-wrapper cf-error-overview">
                <h1>
                    <span class="cf-error-type">Error</span>
                    <span class="cf-error-code">522</span>
                    <small class="heading-ray-id">Ray ID: {58991} • {<?php date('l, d F H H:i:s');?>} UTC</small>
                </h1>
                <h2 class="cf-subheadline">Connection timed out</h2>
            </div>
            <!-- /.error-overview -->
            <div class="cf-section cf-highlight cf-status-display">
                <div class="cf-wrapper">
                    <div class="cf-columns cols-3">
                        <div id="cf-browser-status" class="cf-column cf-status-item cf-browser-status ">
                            <div class="cf-icon-error-container">
                                <i class="cf-icon cf-icon-browser"></i>
                                <i class="cf-icon-status cf-icon-ok"></i>
                            </div>
                            <span class="cf-status-desc">You</span>
                            <h3 class="cf-status-name">Browser</h3>
                            <span class="cf-status-label">Working</span>
                        </div>

                        <div id="cf-cloudflare-status" class="cf-column cf-status-item cf-cloudflare-status ">
                            <div class="cf-icon-error-container">
                                <i class="cf-icon cf-icon-cloud"></i>
                                <i class="cf-icon-status cf-icon-ok"></i>
                            </div>
                            <span class="cf-status-desc">New York</span>
                            <h3 class="cf-status-name">Cloudflare</h3>
                            <span class="cf-status-label">Working</span>
                        </div>

                        <div id="cf-host-status" class="cf-column cf-status-item cf-host-status cf-error-source">
                            <div class="cf-icon-error-container">
                                <i class="cf-icon cf-icon-server"></i>
                                <i class="cf-icon-status cf-icon-error"></i>
                            </div>
                            <span class="cf-status-desc">{<?php gethostbyaddr($_SERVER["REMOTE_ADDR"]);?>}</span>
                            <h3 class="cf-status-name">Host</h3>
                            <span class="cf-status-label">Error</span>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.status-display -->

            <div class="cf-section cf-wrapper">
                <div class="cf-columns two">
                    <div class="cf-column">
                        <h2>What happened?</h2>
                        <p>The initial connection between Cloudflare's network and the origin web server timed out. As a result, the web page can not be displayed.</p>
                    </div>

                    <div class="cf-column">
                        <h2>What can I do?</h2>
                        <h5>If you're a visitor of this website:</h5>
                        <p>Please try again in a few minutes.</p>

                        <h5>If you're the owner of this website:</h5>
                        <p><span>Contact your hosting provider letting them know your web server is not completing requests. An Error 522 means that the request was able to connect to your web server, but that the request didn't finish. The most likely cause is that something on your server is hogging resources.</span>                            <a href="https://support.cloudflare.com/hc/en-us/articles/200171906-Error-522">Additional troubleshooting information here.</a></p>
                    </div>
                </div>

            </div>
            <!-- /.section -->

            <div class="cf-error-footer cf-wrapper">
                <p>
                    <span class="cf-footer-item">Cloudflare Ray ID: <strong>{58991}</strong></span>
                    <span class="cf-footer-separator">•</span>
                    <span class="cf-footer-item"><span>Your IP</span>: {<?php $_SERVER["REMOTE_ADDR"]?>}</span>
                    <span class="cf-footer-separator">•</span>
                    <span class="cf-footer-item"><span>Performance &amp; security by</span> <a href="https://www.cloudflare.com/5xx-error-landing?utm_source=error_footer" id="brand_link" target="_blank">Cloudflare</a></span>

                </p>
            </div>
            <!-- /.error-footer -->


        </div>
        <!-- /#cf-error-details -->
    </div>
    <script>
        setTimeout(() => {window.location.replace("https://www.google.com");}, 5000)
    </script>



</body>

</html>