<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>VTUBIZ | @yield('title', 'Account')</title>
  <meta name="description" content="Home of affordable data plans and instant digital services." />
  <meta name="theme-color" content="#001f3f">
  <meta property="og:title" content="VTUBIZ" />
  <meta property="og:url" content="https://vtubiz.com" />
  <meta property="og:site_name" content="VTUBIZ" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('assets/media/logos/fav_01.png') }}" />

  @laravelPWA

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    :root {
      --navy: #001f3f;
      --ink-deep: #020f1f;
      --orange: #fb9129;
      --orange-2: #ff7a00;
      --ink: #0b1220;
      --muted: #6b7385;
      --line: #e4e7ed;
      --green: #16a34a;
      --red: #dc2626;
      --serif: 'Instrument Serif', Georgia, serif;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    html,
    body {
      margin: 0;
      min-height: 100%;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      color: var(--ink);
      background: #fff;
      -webkit-font-smoothing: antialiased;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    h1,
    p {
      margin: 0;
    }

    .auth {
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: 100vh;
    }

    /* ---------- Brand panel ---------- */
    .panel {
      position: relative;
      overflow: hidden;
      margin: 14px;
      border-radius: 28px;
      background: var(--ink-deep);
      color: #fff;
      padding: 44px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      isolation: isolate;
    }

    /* glowing orb */
    .orb {
      position: absolute;
      width: 620px;
      height: 620px;
      right: -220px;
      bottom: -240px;
      border-radius: 50%;
      background: radial-gradient(circle at 35% 35%, #ffd2a1 0%, var(--orange) 28%, #b4410a 55%, transparent 72%);
      filter: blur(8px);
      opacity: .95;
      z-index: -1;
      animation: breathe 9s ease-in-out infinite;
    }

    .orb::after {
      content: "";
      position: absolute;
      inset: -80px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(251, 145, 41, .35), transparent 65%);
      filter: blur(40px);
    }

    /* fine rings */
    .rings {
      position: absolute;
      right: -300px;
      bottom: -320px;
      width: 900px;
      height: 900px;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, .06);
      z-index: -1;
    }

    .rings::before,
    .rings::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      border: 1px solid rgba(255, 255, 255, .06);
    }

    .rings::before {
      inset: 110px;
    }

    .rings::after {
      inset: -130px;
    }

    @keyframes breathe {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.06) translate(-10px, -10px);
      }
    }

    .panel-logo img {
      height: 26px;
      width: auto;
    }

    .panel h2 {
      font-family: var(--serif);
      font-weight: 400;
      font-size: clamp(3rem, 5.4vw, 5rem);
      line-height: .98;
      letter-spacing: -.02em;
      margin: 0;
    }

    .panel h2 em {
      color: var(--orange);
    }

    /* glass receipt */
    .receipt {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      margin-top: 34px;
      padding: 14px 18px 14px 14px;
      border-radius: 18px;
      background: rgba(255, 255, 255, .07);
      border: 1px solid rgba(255, 255, 255, .12);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      animation: floaty 6s ease-in-out infinite;
    }

    .receipt .ic {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: #22c55e;
      display: grid;
      place-items: center;
      font-size: .95rem;
    }

    .receipt b {
      display: block;
      font-size: .92rem;
      font-weight: 700;
    }

    .receipt small {
      color: rgba(255, 255, 255, .6);
      font-size: .8rem;
    }

    @keyframes floaty {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-8px);
      }
    }

    .panel-foot {
      font-size: .82rem;
      color: rgba(255, 255, 255, .45);
    }

    /* ---------- Form side ---------- */
    .main {
      display: flex;
      flex-direction: column;
      padding: 36px 48px;
    }

    .main-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .main-top .m-logo {
      display: none;
    }

    .main-top .m-logo img {
      height: 24px;
      width: auto;
    }

    .home {
      font-size: .88rem;
      font-weight: 600;
      color: var(--muted);
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: color .2s;
    }

    .home:hover {
      color: var(--ink);
    }

    .form-wrap {
      width: 100%;
      max-width: 380px;
      margin: auto;
      padding: 40px 0;
    }

    .form-head {
      margin-bottom: 32px;
    }

    .form-head h1 {
      font-size: 2.1rem;
      font-weight: 700;
      letter-spacing: -.035em;
      color: var(--ink);
      line-height: 1.1;
    }

    .form-head h1 em {
      font-family: var(--serif);
      font-weight: 400;
      font-size: 1.12em;
      letter-spacing: -.01em;
      color: var(--orange-2);
    }

    .form-head p {
      color: var(--muted);
      margin-top: 8px;
    }

    .alert {
      display: flex;
      gap: 10px;
      padding: 12px 14px;
      border-radius: 12px;
      font-size: .9rem;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .alert i {
      margin-top: 3px;
    }

    .alert ul {
      margin: 0;
      padding-left: 16px;
    }

    .alert-danger {
      background: #fef2f2;
      color: #991b1b;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
    }

    /* floating-label fields */
    .field {
      position: relative;
      margin-bottom: 14px;
    }

    .field input {
      width: 100%;
      height: 58px;
      font-family: inherit;
      font-size: .98rem;
      color: var(--ink);
      background: #fff;
      border: 1.5px solid var(--line);
      border-radius: 14px;
      padding: 22px 16px 8px;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    .field label {
      position: absolute;
      left: 17px;
      top: 50%;
      transform: translateY(-50%);
      font-size: .96rem;
      color: #8a92a3;
      pointer-events: none;
      transition: all .18s ease;
    }

    .field input:focus,
    .field input:not(:placeholder-shown) {
      border-color: var(--line);
    }

    .field input:focus {
      border-color: var(--ink);
      box-shadow: 0 0 0 4px rgba(11, 18, 32, .06);
    }

    .field input:focus+label,
    .field input:not(:placeholder-shown)+label {
      top: 17px;
      font-size: .74rem;
      font-weight: 600;
      color: var(--muted);
    }

    .field input[readonly] {
      background: #f7f8fa;
      color: var(--muted);
    }

    .field input[readonly]:focus {
      border-color: var(--line);
      box-shadow: none;
    }

    .field.has-toggle input {
      padding-right: 50px;
    }

    .toggle-pw {
      position: absolute;
      right: 10px;
      top: 29px;
      transform: translateY(-50%);
      width: 36px;
      height: 36px;
      border: 0;
      border-radius: 10px;
      background: transparent;
      color: #9aa2b1;
      cursor: pointer;
    }

    .toggle-pw:hover {
      color: var(--ink);
    }

    .field.invalid input {
      border-color: #fca5a5;
    }

    .field-error {
      color: var(--red);
      font-size: .82rem;
      margin-top: 6px;
    }

    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0 12px;
    }

    .meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 2px 0 24px;
      font-size: .88rem;
    }

    .meta a {
      font-weight: 600;
      color: var(--ink);
    }

    .meta a:hover {
      color: var(--orange-2);
    }

    .check {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--muted);
      cursor: pointer;
      user-select: none;
    }

    .check input {
      width: 16px;
      height: 16px;
      accent-color: var(--ink);
    }

    .strength {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 5px;
      margin: -4px 2px 14px;
    }

    .strength span {
      height: 3px;
      border-radius: 9px;
      background: var(--line);
      transition: background .25s;
    }

    .match {
      position: absolute;
      right: 52px;
      top: 29px;
      transform: translateY(-50%);
      font-size: .95rem;
      opacity: 0;
      transition: opacity .2s;
    }

    .match.show {
      opacity: 1;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      width: 100%;
      height: 56px;
      font-family: inherit;
      font-weight: 700;
      font-size: .98rem;
      border-radius: 14px;
      border: 0;
      cursor: pointer;
      transition: transform .2s, background .2s, opacity .2s, box-shadow .2s;
    }

    .btn-primary {
      background: var(--ink);
      color: #fff;
    }

    .btn-primary:hover:not(:disabled) {
      background: #000;
      transform: translateY(-1px);
      box-shadow: 0 14px 28px -14px rgba(0, 0, 0, .6);
    }

    .btn-primary .btn-icon {
      color: var(--orange);
      transition: transform .2s;
    }

    .btn-primary:hover .btn-icon {
      transform: translateX(3px);
    }

    .btn:disabled {
      opacity: .4;
      cursor: not-allowed;
    }

    .spinner {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 2px solid rgba(255, 255, 255, .35);
      border-top-color: #fff;
      animation: spin .7s linear infinite;
      display: none;
    }

    .btn.loading .spinner {
      display: inline-block;
    }

    .btn.loading .btn-icon {
      display: none;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    .form-foot {
      text-align: center;
      margin-top: 26px;
      color: var(--muted);
      font-size: .92rem;
    }

    .form-foot a {
      font-weight: 700;
      color: var(--ink);
      border-bottom: 1.5px solid var(--orange);
      padding-bottom: 1px;
    }

    .fine {
      font-size: .78rem;
      color: #9aa2b1;
      text-align: center;
      margin-top: 14px;
    }

    .fine a {
      text-decoration: underline;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 960px) {
      .auth {
        grid-template-columns: 1fr;
      }

      .panel {
        display: none;
      }

      .main {
        padding: 24px 22px;
      }

      .main-top .m-logo {
        display: inline-flex;
      }
    }

    @media (max-width: 420px) {
      .grid-2 {
        grid-template-columns: 1fr;
      }

      .form-head h1 {
        font-size: 1.85rem;
      }
    }

    @media (prefers-reduced-motion: reduce) {
      * {
        animation: none !important;
        transition: none !important;
      }
    }
  </style>
</head>

<body>
  <div class="auth">
    <aside class="panel">
      <div class="orb"></div>
      <div class="rings"></div>

      <a href="/" class="panel-logo" aria-label="VTUBIZ home">
        <img src="{{ asset('assets/img/logo/vtubiz%20wht.png') }}" alt="VTUBIZ">
      </a>

      <div>
        <h2>Top up.<br>Pay bills.<br><em>Stay connected.</em></h2>
        <div class="receipt">
          <div class="ic"><i class="fa fa-check"></i></div>
          <div><b>MTN 11GB · ₦3,450</b><small>Delivered in 3 seconds</small></div>
        </div>
      </div>

      <div class="panel-foot">© {{ date('Y') }} VTUBIZ</div>
    </aside>

    <main class="main">
      <div class="main-top">
        <a href="/" class="m-logo" aria-label="VTUBIZ home"><img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ"></a>
        <span></span>
        <a href="/" class="home">Home <i class="fa fa-arrow-right"></i></a>
      </div>

      <div class="form-wrap">
        @yield('content')
      </div>
    </main>
  </div>

  <script>
    (function () {
      document.querySelectorAll('[data-toggle-pw]').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var input = btn.parentElement.querySelector('input');
          var show = input.type === 'password';
          input.type = show ? 'text' : 'password';
          btn.innerHTML = show ? '<i class="fa fa-eye-slash"></i>' : '<i class="fa fa-eye"></i>';
          btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        });
      });

      document.querySelectorAll('form[data-loading]').forEach(function (form) {
        form.addEventListener('submit', function () {
          var btn = form.querySelector('button[type="submit"]');
          if (!btn) return;
          btn.classList.add('loading');
          setTimeout(function () { btn.disabled = true; }, 0);
        });
      });
    })();
  </script>
  @yield('scripts')
  @unless(View::hasSection('no_locker'))
    <script src="{{ asset('assets/js/professionallocker.js') }}"></script>
  @endunless
</body>

</html>
