<?php
// Optionally greet the customer by name if it was passed in the redirect.
$name = isset($_GET['name']) ? trim($_GET['name']) : '';
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

// Facebook Pixel ID, passed from the order form (hidden input name="pixel").
// Validate strictly: digits only. A non-numeric value is rejected so it can
// never be injected into the page (prevents XSS via the URL parameter).
$pixel = isset($_GET['pixel']) ? trim($_GET['pixel']) : '';
$pixel = preg_match('/^\d{5,20}$/', $pixel) ? $pixel : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Thank You — Nature's Solution Serum</title>
<?php if ($pixel !== ''): ?>
<!-- Meta Pixel Code -->
<script>
  (function(f,b,e,v,n,t,s){
    if(f.fbq)return; n=f.fbq=function(){
      n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
    };
    if(!f._fbq)f._fbq=n; n.push=n; n.loaded=!0; n.version='2.0';
    n.queue=[]; t=b.createElement(e); t.async=!0;
    t.src=v; s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)
  })(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '<?php echo $pixel; ?>');
  fbq('track', 'PageView');
  fbq('track', 'Lead');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id=<?php echo $pixel; ?>&ev=Lead&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code -->
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<style>
  :root {
    --pink: #cc2b5e;
    --purple: #642b73;
    --accent: #8701bd;
  }
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    padding: 24px;
    font-family: "Open Sans", sans-serif;
    background: linear-gradient(160deg, #ffe3ee 0%, #f3e3fb 100%);
  }
  .card {
    width: 100%; max-width: 420px;
    padding: 42px 28px 32px;
    background: #fff;
    border-radius: 28px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(100, 43, 115, .18);
    animation: rise .5s ease both;
  }
  @keyframes rise { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }
  .badge {
    width: 88px; height: 88px; margin: 0 auto 22px;
    display: grid; place-items: center;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--pink), var(--purple));
    box-shadow: 0 10px 24px rgba(204, 43, 94, .35);
    animation: pop .5s .15s cubic-bezier(.18, .89, .32, 1.28) both;
  }
  @keyframes pop { from { transform: scale(0); } to { transform: scale(1); } }
  .badge svg { width: 44px; height: 44px; stroke: #fff; }
  .script {
    font-family: "Dancing Script", cursive;
    font-size: 26px; color: var(--accent); margin-bottom: 4px;
  }
  h1 { font-size: 25px; font-weight: 700; color: var(--purple); margin-bottom: 12px; }
  p.text { font-size: 15px; line-height: 1.6; color: #555; margin-bottom: 8px; }
  .home {
    display: inline-block; margin-top: 22px;
    padding: 13px 30px; border-radius: 30px;
    font-size: 16px; font-weight: 700; color: #fff; text-decoration: none;
    background: linear-gradient(90deg, var(--pink), var(--purple));
    box-shadow: 0 8px 20px rgba(117, 58, 136, .3);
    transition: transform .15s;
  }
  .home:active { transform: translateY(1px); }
</style>
</head>
<body>
  <main class="card">
    <div class="badge" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 6 9 17l-5-5"/>
      </svg>
    </div>

    <p class="script">Thank you<?php if ($name !== '') { echo ', ' . $name; } ?>!</p>
    <h1>Your order has been received</h1>
    <p class="text">Our team will call you shortly to confirm your order and delivery details.</p>
    <p class="text">Please keep your phone nearby.</p>

    <a class="home" href="index.html">Back to Home</a>
  </main>
</body>
</html>