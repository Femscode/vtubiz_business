<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Top up airtime, buy cheap data, pay electricity and cable bills instantly with VTUBIZ.">
  <meta name="keywords" content="VTU, cheap data, airtime, electricity token, DStv, GOtv, bulk SMS, VTU business Nigeria">
  <meta name="theme-color" content="#001f3f">
  <title>VTUBIZ | Top Up, Pay Bills, Stay Connected</title>
  <link rel="shortcut icon" href="{{ asset('assets/media/logos/fav_01.png') }}" />

  <meta name="google-adsense-account" content="ca-pub-9520357947525167">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    :root {
      --navy: #001f3f;
      --navy-2: #0a2d55;
      --navy-ink: #041a33;
      --orange: #fb9129;
      --orange-2: #ff7a00;
      --orange-soft: #fff3e6;
      --green: #16a34a;
      --ink: #0b1220;
      --muted: #5b6475;
      --line: #e8ebf1;
      --bg: #ffffff;
      --bg-soft: #f6f7fb;
      --radius-xl: 32px;
      --radius-lg: 22px;
      --radius-md: 14px;
      --shadow-sm: 0 1px 2px rgba(16, 24, 40, .05), 0 1px 3px rgba(16, 24, 40, .06);
      --shadow-md: 0 12px 32px -12px rgba(16, 24, 40, .18);
      --shadow-lg: 0 30px 60px -20px rgba(0, 31, 63, .35);
      --container: 1200px;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      margin: 0;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      color: var(--ink);
      background: var(--bg);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    img {
      max-width: 100%;
      display: block;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
      margin: 0;
      line-height: 1.15;
      letter-spacing: -0.02em;
    }

    p {
      margin: 0;
    }

    ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .container {
      width: 100%;
      max-width: var(--container);
      margin: 0 auto;
      padding: 0 24px;
    }

    section {
      padding: 96px 0;
    }

    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: .78rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--orange-2);
      background: var(--orange-soft);
      padding: 6px 14px;
      border-radius: 999px;
      margin-bottom: 18px;
    }

    .section-head {
      text-align: center;
      max-width: 680px;
      margin: 0 auto 56px;
    }

    .section-head h2 {
      font-size: clamp(2rem, 4vw, 2.9rem);
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 14px;
    }

    .section-head p {
      color: var(--muted);
      font-size: 1.08rem;
    }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      font-weight: 700;
      font-size: .98rem;
      padding: 14px 26px;
      border-radius: 999px;
      border: 2px solid transparent;
      cursor: pointer;
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
      white-space: nowrap;
      font-family: inherit;
    }

    .btn:hover {
      transform: translateY(-2px);
    }

    .btn-primary {
      background: var(--orange);
      color: #fff;
      box-shadow: 0 10px 24px -8px rgba(251, 145, 41, .7);
    }

    .btn-primary:hover {
      background: var(--orange-2);
    }

    .btn-dark {
      background: var(--navy);
      color: #fff;
    }

    .btn-dark:hover {
      background: var(--navy-2);
    }

    .btn-ghost {
      background: transparent;
      color: var(--navy);
      border-color: var(--line);
    }

    .btn-ghost:hover {
      border-color: var(--navy);
    }

    .btn-white {
      background: #fff;
      color: var(--navy);
    }

    .btn-sm {
      padding: 10px 20px;
      font-size: .9rem;
    }

    /* ---------- Header ---------- */
    .header {
      position: sticky;
      top: 0;
      z-index: 100;
      background: rgba(255, 255, 255, .82);
      backdrop-filter: saturate(180%) blur(14px);
      -webkit-backdrop-filter: saturate(180%) blur(14px);
      border-bottom: 1px solid transparent;
      transition: border-color .2s ease, box-shadow .2s ease;
    }

    .header.scrolled {
      border-bottom-color: var(--line);
      box-shadow: 0 6px 20px -16px rgba(0, 0, 0, .25);
    }

    .nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 76px;
      gap: 24px;
    }

    .nav-logo img {
      height: 28px;
      width: auto;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-links>li {
      position: relative;
    }

    .nav-links>li>a,
    .nav-links>li>button {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 14px;
      border-radius: 10px;
      font-weight: 600;
      font-size: .95rem;
      color: #2b3445;
      background: none;
      border: 0;
      cursor: pointer;
      font-family: inherit;
    }

    .nav-links>li>a:hover,
    .nav-links>li>button:hover {
      background: var(--bg-soft);
      color: var(--navy);
    }

    .nav-links .fa-angle-down {
      font-size: .8rem;
      transition: transform .2s;
    }

    .dropdown {
      position: absolute;
      top: calc(100% + 8px);
      left: 50%;
      transform: translate(-50%, 8px);
      min-width: 300px;
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 18px;
      box-shadow: var(--shadow-md);
      padding: 10px;
      opacity: 0;
      visibility: hidden;
      transition: all .2s ease;
    }

    .has-dropdown:hover .dropdown,
    .has-dropdown:focus-within .dropdown {
      opacity: 1;
      visibility: visible;
      transform: translate(-50%, 0);
    }

    .has-dropdown:hover .fa-angle-down {
      transform: rotate(180deg);
    }

    .dropdown a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 12px;
      border-radius: 12px;
      font-weight: 600;
      font-size: .92rem;
    }

    .dropdown a:hover {
      background: var(--bg-soft);
    }

    .dropdown a small {
      display: block;
      font-weight: 500;
      color: var(--muted);
      font-size: .8rem;
    }

    .dd-icon {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .nav-actions .login-link {
      font-weight: 700;
      padding: 10px 14px;
      color: var(--navy);
    }

    .menu-toggle {
      display: none;
      width: 44px;
      height: 44px;
      border-radius: 12px;
      border: 1px solid var(--line);
      background: #fff;
      font-size: 1.1rem;
      color: var(--navy);
      cursor: pointer;
    }

    /* Mobile drawer */
    .drawer-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(4, 26, 51, .5);
      opacity: 0;
      visibility: hidden;
      transition: .25s;
      z-index: 200;
    }

    .drawer {
      position: fixed;
      top: 0;
      right: 0;
      height: 100%;
      width: min(360px, 88vw);
      background: #fff;
      z-index: 201;
      transform: translateX(100%);
      transition: transform .3s ease;
      display: flex;
      flex-direction: column;
      padding: 22px;
      overflow-y: auto;
    }

    body.drawer-open .drawer {
      transform: none;
    }

    body.drawer-open .drawer-backdrop {
      opacity: 1;
      visibility: visible;
    }

    .drawer-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .drawer-head img {
      height: 26px;
      width: auto;
    }

    .drawer h6 {
      font-size: .75rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted);
      margin: 18px 0 8px;
    }

    .drawer a.d-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 6px;
      font-weight: 600;
      border-bottom: 1px solid var(--line);
    }

    .drawer a.d-link i {
      width: 20px;
      color: var(--orange-2);
    }

    .drawer-cta {
      margin-top: auto;
      padding-top: 24px;
      display: grid;
      gap: 10px;
    }

    .drawer-contact {
      margin-top: 18px;
      font-size: .88rem;
      color: var(--muted);
    }

    /* ---------- Hero ---------- */
    .hero {
      position: relative;
      padding: 72px 0 110px;
      overflow: hidden;
      background:
        radial-gradient(900px 500px at 85% 10%, rgba(251, 145, 41, .14), transparent 60%),
        radial-gradient(700px 500px at 0% 100%, rgba(0, 31, 63, .07), transparent 60%),
        #fff;
    }

    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image: radial-gradient(rgba(0, 31, 63, .08) 1px, transparent 1px);
      background-size: 22px 22px;
      mask-image: linear-gradient(to bottom, #000 0%, transparent 75%);
      -webkit-mask-image: linear-gradient(to bottom, #000 0%, transparent 75%);
      pointer-events: none;
    }

    .hero-grid {
      position: relative;
      display: grid;
      grid-template-columns: 1.05fr .95fr;
      gap: 56px;
      align-items: center;
    }

    .hero-pill {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: #fff;
      border: 1px solid var(--line);
      box-shadow: var(--shadow-sm);
      padding: 6px 14px 6px 6px;
      border-radius: 999px;
      font-size: .86rem;
      font-weight: 600;
      color: #334;
      margin-bottom: 26px;
    }

    .hero-pill .tag {
      background: var(--navy);
      color: #fff;
      border-radius: 999px;
      padding: 4px 10px;
      font-size: .74rem;
      font-weight: 700;
    }

    .hero h1 {
      font-size: clamp(2.6rem, 5.6vw, 4.6rem);
      font-weight: 800;
      color: var(--navy);
      letter-spacing: -0.045em;
      line-height: 1.02;
      margin-bottom: 22px;
    }

    .hero h1 .accent {
      color: var(--orange);
    }

    .flash-text {
      background: linear-gradient(90deg, var(--navy) 20%, var(--orange) 40%, #ffd29e 50%, var(--orange) 60%, var(--navy) 80%);
      background-size: 200% auto;
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: shine 3.5s linear infinite;
    }

    @keyframes shine {
      to {
        background-position: 200% center;
      }
    }

    .hero-lead {
      font-size: 1.15rem;
      color: var(--muted);
      max-width: 520px;
      margin-bottom: 34px;
    }

    .hero-ctas {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 36px;
    }

    .hero-trust {
      display: flex;
      flex-wrap: wrap;
      gap: 22px;
      color: #3a4354;
      font-weight: 600;
      font-size: .92rem;
    }

    .hero-trust span {
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .hero-trust i {
      color: var(--green);
    }

    /* Phone mockup */
    .hero-visual {
      position: relative;
      height: 580px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .hero-blob {
      position: absolute;
      width: 440px;
      height: 440px;
      border-radius: 50%;
      background: conic-gradient(from 200deg, var(--orange), #ffc27d, var(--navy), var(--orange));
      filter: blur(70px);
      opacity: .35;
    }

    .phone {
      position: relative;
      width: 290px;
      height: 570px;
      border-radius: 44px;
      background: #0b0f1a;
      padding: 12px;
      box-shadow: var(--shadow-lg), inset 0 0 0 2px #2a2f3d;
      z-index: 2;
    }

    .phone-screen {
      height: 100%;
      border-radius: 34px;
      background: #f4f6fa;
      overflow: hidden;
      position: relative;
    }

    .phone-notch {
      position: absolute;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      width: 92px;
      height: 24px;
      background: #0b0f1a;
      border-radius: 20px;
      z-index: 3;
    }

    .ps-top {
      background: linear-gradient(160deg, var(--navy) 0%, var(--navy-2) 100%);
      color: #fff;
      padding: 48px 20px 64px;
      position: relative;
    }

    .ps-top::after {
      content: "";
      position: absolute;
      right: -40px;
      top: -40px;
      width: 160px;
      height: 160px;
      border-radius: 50%;
      background: rgba(251, 145, 41, .25);
    }

    .ps-hello {
      font-size: .78rem;
      opacity: .7;
    }

    .ps-name {
      font-weight: 700;
      font-size: .95rem;
      margin-bottom: 16px;
    }

    .ps-label {
      font-size: .72rem;
      opacity: .7;
    }

    .ps-balance {
      font-size: 1.7rem;
      font-weight: 800;
      letter-spacing: -.02em;
    }

    .ps-card {
      margin: -42px 14px 0;
      background: #fff;
      border-radius: 20px;
      padding: 16px 12px;
      box-shadow: 0 12px 30px -16px rgba(0, 0, 0, .3);
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 6px;
      position: relative;
      z-index: 2;
    }

    .ps-action {
      text-align: center;
      font-size: .64rem;
      font-weight: 600;
      color: #3a4354;
    }

    .ps-action div {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      margin: 0 auto 6px;
      display: grid;
      place-items: center;
      font-size: .95rem;
    }

    .ps-section {
      padding: 18px 16px 0;
    }

    .ps-section h6 {
      margin: 0 0 10px;
      font-size: .78rem;
      color: #3a4354;
    }

    .ps-tx {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #fff;
      border-radius: 14px;
      padding: 10px 12px;
      margin-bottom: 8px;
      font-size: .72rem;
    }

    .ps-tx .ic {
      width: 32px;
      height: 32px;
      border-radius: 10px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
    }

    .ps-tx b {
      display: block;
      font-size: .76rem;
      color: var(--ink);
    }

    .ps-tx span {
      color: var(--muted);
    }

    .ps-tx .amt {
      margin-left: auto;
      font-weight: 700;
      color: var(--ink);
    }

    .float-card {
      position: absolute;
      z-index: 3;
      background: #fff;
      border-radius: 18px;
      padding: 14px 16px;
      box-shadow: var(--shadow-md);
      border: 1px solid rgba(0, 0, 0, .04);
      display: flex;
      align-items: center;
      gap: 12px;
      animation: floaty 6s ease-in-out infinite;
    }

    .float-card .ic {
      width: 42px;
      height: 42px;
      border-radius: 12px;
      display: grid;
      place-items: center;
      font-size: 1.05rem;
      flex-shrink: 0;
    }

    .float-card b {
      display: block;
      font-size: .9rem;
    }

    .float-card small {
      color: var(--muted);
      font-size: .78rem;
    }

    .fc-1 {
      top: 70px;
      left: -10px;
    }

    .fc-2 {
      bottom: 90px;
      right: -20px;
      animation-delay: -3s;
    }

    .fc-dark {
      background: var(--navy);
      color: #fff;
      border: 0;
      flex-direction: column;
      align-items: flex-start;
      gap: 4px;
      padding: 16px 18px;
    }

    .fc-dark .badge {
      background: rgba(255, 255, 255, .14);
      font-size: .7rem;
      font-weight: 700;
      padding: 3px 10px;
      border-radius: 999px;
    }

    .fc-dark .big {
      font-size: 1.25rem;
      font-weight: 800;
    }

    .fc-dark small {
      color: rgba(255, 255, 255, .7);
    }

    .fc-dark .ok {
      color: #4ade80;
      font-size: .76rem;
      font-weight: 700;
    }

    @keyframes floaty {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-12px);
      }
    }

    /* ---------- Stats / networks strip ---------- */
    .strip {
      padding: 0;
      margin-top: -56px;
      position: relative;
      z-index: 5;
    }

    .strip-card {
      background: var(--navy);
      border-radius: var(--radius-xl);
      color: #fff;
      padding: 34px 40px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      box-shadow: var(--shadow-lg);
      position: relative;
      overflow: hidden;
    }

    .strip-card::after {
      content: "";
      position: absolute;
      right: -80px;
      bottom: -120px;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: rgba(251, 145, 41, .18);
      filter: blur(30px);
    }

    .stat {
      position: relative;
      z-index: 1;
    }

    .stat+.stat {
      border-left: 1px solid rgba(255, 255, 255, .12);
      padding-left: 24px;
    }

    .stat b {
      display: block;
      font-size: 2rem;
      font-weight: 800;
      letter-spacing: -.03em;
    }

    .stat b em {
      font-style: normal;
      color: var(--orange);
    }

    .stat span {
      color: rgba(255, 255, 255, .72);
      font-size: .92rem;
    }

    .networks {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 14px 34px;
      margin-top: 44px;
      color: #8a93a5;
      font-weight: 700;
      font-size: 1.02rem;
    }

    .networks .lbl {
      font-weight: 600;
      font-size: .85rem;
      text-transform: uppercase;
      letter-spacing: .1em;
      color: #a3abbb;
      width: 100%;
      text-align: center;
      margin-bottom: 4px;
    }

    .networks span.net {
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      display: inline-block;
    }

    /* ---------- Services ---------- */
    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 22px;
    }

    .service {
      position: relative;
      background: #fff;
      border: 1px solid var(--line);
      border-radius: var(--radius-lg);
      padding: 30px;
      transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    .service:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-md);
      border-color: transparent;
    }

    .service .ic {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      display: grid;
      place-items: center;
      font-size: 1.35rem;
      margin-bottom: 22px;
    }

    .service h3 {
      font-size: 1.22rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: var(--navy);
    }

    .service p {
      color: var(--muted);
      font-size: .96rem;
      margin-bottom: 22px;
    }

    .service .more {
      margin-top: auto;
      font-weight: 700;
      font-size: .9rem;
      color: var(--navy);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .service .more i {
      transition: transform .2s;
    }

    .service:hover .more i {
      transform: translateX(4px);
    }

    .c-green {
      background: #e9f9ef;
      color: #16a34a;
    }

    .c-blue {
      background: #e8f1ff;
      color: #2563eb;
    }

    .c-purple {
      background: #f1ecff;
      color: #7c3aed;
    }

    .c-yellow {
      background: #fff7d6;
      color: #ca8a04;
    }

    .c-orange {
      background: #fff1e3;
      color: #ea580c;
    }

    .c-pink {
      background: #ffe9f1;
      color: #db2777;
    }

    .c-teal {
      background: #e3f8f6;
      color: #0d9488;
    }

    /* ---------- How it works ---------- */
    .how {
      background: var(--bg-soft);
    }

    .steps {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 22px;
      counter-reset: step;
    }

    .step {
      background: #fff;
      border-radius: var(--radius-lg);
      padding: 34px 30px;
      position: relative;
      box-shadow: var(--shadow-sm);
    }

    .step-num {
      width: 46px;
      height: 46px;
      border-radius: 14px;
      background: var(--navy);
      color: #fff;
      font-weight: 800;
      display: grid;
      place-items: center;
      margin-bottom: 20px;
      font-size: 1.05rem;
    }

    .step:nth-child(2) .step-num {
      background: var(--orange);
    }

    .step:nth-child(3) .step-num {
      background: var(--green);
    }

    .step h3 {
      font-size: 1.18rem;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 8px;
    }

    .step p {
      color: var(--muted);
      font-size: .96rem;
    }

    /* ---------- Features (bento) ---------- */
    .bento {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 20px;
    }

    .feat {
      border-radius: var(--radius-lg);
      padding: 32px;
      background: var(--bg-soft);
      border: 1px solid var(--line);
      position: relative;
      overflow: hidden;
      transition: transform .25s ease;
    }

    .feat:hover {
      transform: translateY(-4px);
    }

    .feat .ic {
      width: 50px;
      height: 50px;
      border-radius: 14px;
      display: grid;
      place-items: center;
      font-size: 1.2rem;
      margin-bottom: 18px;
      background: #fff;
      color: var(--navy);
      box-shadow: var(--shadow-sm);
    }

    .feat h3 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 8px;
      color: var(--navy);
    }

    .feat p {
      color: var(--muted);
      font-size: .96rem;
    }

    .feat.span-3 {
      grid-column: span 3;
    }

    .feat.span-2 {
      grid-column: span 2;
    }

    .feat.dark {
      background: linear-gradient(150deg, var(--navy) 0%, var(--navy-2) 100%);
      border: 0;
      color: #fff;
    }

    .feat.dark h3 {
      color: #fff;
    }

    .feat.dark p {
      color: rgba(255, 255, 255, .75);
    }

    .feat.dark .ic {
      background: rgba(255, 255, 255, .1);
      color: var(--orange);
      box-shadow: none;
    }

    .feat.orange {
      background: linear-gradient(150deg, #fb9129 0%, #ff7a00 100%);
      border: 0;
      color: #fff;
    }

    .feat.orange h3 {
      color: #fff;
    }

    .feat.orange p {
      color: rgba(255, 255, 255, .88);
    }

    .feat.orange .ic {
      background: rgba(255, 255, 255, .2);
      color: #fff;
      box-shadow: none;
    }

    .feat-visual {
      margin-top: 24px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .chip {
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .15);
      color: #fff;
      font-size: .8rem;
      font-weight: 600;
      padding: 7px 12px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .chip.light {
      background: #fff;
      color: var(--navy);
      border-color: var(--line);
    }

    /* ---------- Pricing ---------- */
    .pricing {
      background: var(--bg-soft);
    }

    .tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 8px;
      background: #fff;
      padding: 6px;
      border-radius: 999px;
      width: fit-content;
      margin: 0 auto 36px;
      border: 1px solid var(--line);
      box-shadow: var(--shadow-sm);
    }

    .tab {
      border: 0;
      background: transparent;
      font-family: inherit;
      font-weight: 700;
      font-size: .94rem;
      padding: 11px 22px;
      border-radius: 999px;
      cursor: pointer;
      color: #4a5366;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: background .2s, color .2s;
    }

    .tab:hover {
      color: var(--navy);
    }

    .tab.active {
      background: var(--navy);
      color: #fff;
    }

    .tab .dot {
      width: 9px;
      height: 9px;
    }

    .plans-panel {
      display: none;
    }

    .plans-panel.active {
      display: block;
      animation: fadeUp .35s ease;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: none;
      }
    }

    .plans-box {
      background: #fff;
      border-radius: var(--radius-xl);
      padding: 28px;
      border: 1px solid var(--line);
    }

    .plans-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
      margin-bottom: 22px;
    }

    .net-badge {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .net-logo {
      width: 52px;
      height: 52px;
      border-radius: 16px;
      display: grid;
      place-items: center;
      font-weight: 800;
      font-size: 1.2rem;
      color: #fff;
    }

    .net-badge h3 {
      font-size: 1.25rem;
      font-weight: 800;
      color: var(--navy);
    }

    .net-badge small {
      color: var(--muted);
      font-weight: 600;
    }

    .plans-search {
      position: relative;
    }

    .plans-search input {
      font-family: inherit;
      font-size: .92rem;
      padding: 12px 16px 12px 40px;
      border-radius: 999px;
      border: 1px solid var(--line);
      background: var(--bg-soft);
      width: 260px;
      outline: none;
    }

    .plans-search input:focus {
      border-color: var(--orange);
      background: #fff;
    }

    .plans-search i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #9aa2b1;
      font-size: .9rem;
    }

    .plans-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 14px;
      max-height: 470px;
      overflow-y: auto;
      padding-right: 6px;
    }

    .plans-grid::-webkit-scrollbar {
      width: 6px;
    }

    .plans-grid::-webkit-scrollbar-thumb {
      background: #d5dae3;
      border-radius: 10px;
    }

    .plan {
      border: 1px solid var(--line);
      border-radius: 16px;
      padding: 16px 18px;
      display: flex;
      flex-direction: column;
      gap: 6px;
      transition: border-color .2s, box-shadow .2s, transform .2s;
      background: #fff;
    }

    .plan:hover {
      border-color: var(--orange);
      box-shadow: 0 10px 24px -14px rgba(251, 145, 41, .6);
      transform: translateY(-2px);
    }

    .plan .price {
      font-size: 1.35rem;
      font-weight: 800;
      color: var(--navy);
      letter-spacing: -.02em;
    }

    .plan .name {
      color: #4a5366;
      font-size: .88rem;
      font-weight: 600;
      line-height: 1.4;
    }

    .plan a {
      margin-top: 8px;
      font-size: .82rem;
      font-weight: 700;
      color: var(--orange-2);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .plans-empty {
      grid-column: 1 / -1;
      text-align: center;
      padding: 40px 0;
      color: var(--muted);
    }

    .plans-foot {
      text-align: center;
      margin-top: 28px;
    }

    /* ---------- Reseller ---------- */
    .reseller {
      display: grid;
      grid-template-columns: 1.25fr 1fr;
      background: var(--navy-ink);
      border-radius: 36px;
      overflow: hidden;
      position: relative;
      color: #fff;
    }

    .reseller::before,
    .reseller::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
    }

    .reseller::before {
      width: 380px;
      height: 380px;
      background: rgba(37, 99, 235, .35);
      top: -140px;
      left: -100px;
    }

    .reseller::after {
      width: 380px;
      height: 380px;
      background: rgba(251, 145, 41, .3);
      bottom: -160px;
      left: 40%;
    }

    .reseller-left,
    .reseller-right {
      position: relative;
      z-index: 1;
      padding: 64px;
    }

    .reseller-left .eyebrow {
      background: rgba(74, 222, 128, .12);
      color: #4ade80;
    }

    .reseller-left h2 {
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 800;
      margin-bottom: 18px;
      letter-spacing: -.035em;
    }

    .reseller-left p {
      color: rgba(255, 255, 255, .75);
      font-size: 1.1rem;
      max-width: 480px;
      margin-bottom: 34px;
    }

    .reseller-right {
      background: rgba(255, 255, 255, .04);
      border-left: 1px solid rgba(255, 255, 255, .08);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .price-label {
      color: rgba(255, 255, 255, .6);
      font-weight: 600;
      font-size: .9rem;
      margin-bottom: 6px;
    }

    .price-big {
      font-size: clamp(2.8rem, 5vw, 3.8rem);
      font-weight: 800;
      letter-spacing: -.04em;
      line-height: 1;
    }

    .price-big small {
      font-size: 1rem;
      font-weight: 600;
      color: rgba(255, 255, 255, .6);
      letter-spacing: 0;
    }

    .checklist {
      margin-top: 28px;
      display: grid;
      gap: 14px;
    }

    .checklist li {
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 600;
    }

    .checklist i {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: rgba(74, 222, 128, .15);
      color: #4ade80;
      display: grid;
      place-items: center;
      font-size: .7rem;
      flex-shrink: 0;
    }

    /* ---------- Testimonials ---------- */
    .testi-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 22px;
    }

    .testi {
      background: #fff;
      border: 1px solid var(--line);
      border-radius: var(--radius-lg);
      padding: 30px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      transition: box-shadow .25s;
    }

    .testi:hover {
      box-shadow: var(--shadow-md);
    }

    .stars {
      color: #f59e0b;
      font-size: .88rem;
      letter-spacing: 2px;
    }

    .testi blockquote {
      margin: 0;
      font-size: 1.02rem;
      color: #2b3445;
      line-height: 1.7;
    }

    .testi-author {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-top: auto;
    }

    .avatar {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      font-weight: 800;
      color: #fff;
      font-size: .95rem;
      flex-shrink: 0;
    }

    .testi-author b {
      display: block;
      color: var(--navy);
    }

    .testi-author small {
      color: var(--muted);
    }

    .partners {
      margin-top: 64px;
      text-align: center;
    }

    .partners p {
      color: #8a93a5;
      font-weight: 600;
      font-size: .85rem;
      text-transform: uppercase;
      letter-spacing: .1em;
      margin-bottom: 22px;
    }

    .partners-row {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 56px;
      flex-wrap: wrap;
    }

    .partners-row img {
      height: 44px;
      width: auto;
      object-fit: contain;
      filter: grayscale(1);
      opacity: .65;
      transition: .2s;
    }

    .partners-row img:hover {
      filter: none;
      opacity: 1;
    }

    /* ---------- FAQ ---------- */
    .faq-wrap {
      max-width: 820px;
      margin: 0 auto;
      display: grid;
      gap: 12px;
    }

    .faq {
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 18px;
      overflow: hidden;
    }

    .faq summary {
      list-style: none;
      cursor: pointer;
      padding: 20px 24px;
      font-weight: 700;
      color: var(--navy);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
    }

    .faq summary::-webkit-details-marker {
      display: none;
    }

    .faq summary i {
      transition: transform .2s;
      color: var(--orange-2);
    }

    .faq[open] summary i {
      transform: rotate(45deg);
    }

    .faq .ans {
      padding: 0 24px 22px;
      color: var(--muted);
    }

    /* ---------- CTA ---------- */
    .cta {
      padding: 0 0 96px;
    }

    .cta-card {
      background: linear-gradient(120deg, #fb9129 0%, #ff7a00 100%);
      border-radius: 36px;
      padding: 64px;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 32px;
      position: relative;
      overflow: hidden;
    }

    .cta-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image: radial-gradient(rgba(255, 255, 255, .25) 1px, transparent 1px);
      background-size: 20px 20px;
      mask-image: linear-gradient(to left, #000, transparent 70%);
      -webkit-mask-image: linear-gradient(to left, #000, transparent 70%);
    }

    .cta-card>* {
      position: relative;
    }

    .cta-card h2 {
      font-size: clamp(1.8rem, 3.6vw, 2.6rem);
      font-weight: 800;
      max-width: 620px;
      letter-spacing: -.03em;
      margin-bottom: 10px;
    }

    .cta-card p {
      color: rgba(255, 255, 255, .9);
      font-size: 1.05rem;
    }

    .cta-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn-outline-white {
      border-color: rgba(255, 255, 255, .6);
      color: #fff;
      background: transparent;
    }

    .btn-outline-white:hover {
      background: rgba(255, 255, 255, .12);
    }

    /* ---------- Footer ---------- */
    .footer {
      background: var(--navy-ink);
      color: rgba(255, 255, 255, .72);
      padding: 80px 0 28px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr 1.4fr;
      gap: 40px;
    }

    .footer h4 {
      color: #fff;
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 18px;
    }

    .footer-brand img {
      height: 30px;
      width: auto;
      margin-bottom: 18px;
      background: #fff;
      padding: 6px 10px;
      border-radius: 10px;
      box-sizing: content-box;
    }

    .footer-brand p {
      font-size: .94rem;
      max-width: 300px;
      margin-bottom: 20px;
    }

    .socials {
      display: flex;
      gap: 10px;
    }

    .socials a {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: rgba(255, 255, 255, .08);
      display: grid;
      place-items: center;
      color: #fff;
      transition: background .2s;
    }

    .socials a:hover {
      background: var(--orange);
    }

    .footer ul li {
      margin-bottom: 10px;
    }

    .footer ul a {
      font-size: .94rem;
      transition: color .2s;
    }

    .footer ul a:hover {
      color: var(--orange);
    }

    .contact-line {
      display: flex;
      gap: 12px;
      align-items: flex-start;
      font-size: .94rem;
      margin-bottom: 12px;
    }

    .contact-line i {
      color: var(--orange);
      margin-top: 5px;
      width: 16px;
    }

    .newsletter {
      display: flex;
      background: rgba(255, 255, 255, .06);
      border: 1px solid rgba(255, 255, 255, .12);
      border-radius: 999px;
      padding: 5px;
      margin-top: 14px;
    }

    .newsletter input {
      flex: 1;
      min-width: 0;
      background: transparent;
      border: 0;
      outline: 0;
      color: #fff;
      padding: 0 16px;
      font-family: inherit;
      font-size: .92rem;
    }

    .newsletter input::placeholder {
      color: rgba(255, 255, 255, .5);
    }

    .footer-bottom {
      margin-top: 56px;
      padding-top: 24px;
      border-top: 1px solid rgba(255, 255, 255, .1);
      display: flex;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      font-size: .88rem;
    }

    .footer-bottom a:hover {
      color: var(--orange);
    }

    .to-top {
      position: fixed;
      right: 22px;
      bottom: 22px;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--navy);
      color: #fff;
      border: 0;
      cursor: pointer;
      box-shadow: var(--shadow-md);
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      transition: .25s;
      z-index: 90;
    }

    .to-top.show {
      opacity: 1;
      visibility: visible;
      transform: none;
    }

    /* Reveal on scroll */
    .reveal {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity .7s ease, transform .7s ease;
    }

    .reveal.in {
      opacity: 1;
      transform: none;
    }

    @media (prefers-reduced-motion: reduce) {

      *,
      *::before,
      *::after {
        animation: none !important;
        transition: none !important;
      }

      .reveal {
        opacity: 1;
        transform: none;
      }
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 1080px) {
      .nav-links {
        display: none;
      }

      .nav-actions .login-link,
      .nav-actions .btn {
        display: none;
      }

      .menu-toggle {
        display: grid;
        place-items: center;
      }

      .hero-grid {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .hero-lead {
        margin-left: auto;
        margin-right: auto;
      }

      .hero-ctas,
      .hero-trust {
        justify-content: center;
      }

      .hero-visual {
        height: 560px;
      }

      .footer-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 900px) {
      section {
        padding: 72px 0;
      }

      .services-grid,
      .steps {
        grid-template-columns: 1fr 1fr;
      }

      .bento {
        grid-template-columns: 1fr 1fr;
      }

      .feat.span-3,
      .feat.span-2 {
        grid-column: span 1;
      }

      .feat.wide-m {
        grid-column: 1 / -1;
      }

      .strip-card {
        grid-template-columns: 1fr 1fr;
        padding: 28px;
      }

      .stat:nth-child(3) {
        border-left: 0;
        padding-left: 0;
      }

      .reseller {
        grid-template-columns: 1fr;
      }

      .reseller-left,
      .reseller-right {
        padding: 44px 32px;
      }

      .reseller-right {
        border-left: 0;
        border-top: 1px solid rgba(255, 255, 255, .08);
      }

      .cta-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 44px 32px;
      }
    }

    @media (max-width: 640px) {
      .container {
        padding: 0 18px;
      }

      .hero {
        padding: 44px 0 100px;
      }

      .hero-visual {
        height: 520px;
        transform: scale(.9);
      }

      .fc-1 {
        left: -6px;
        top: 40px;
      }

      .fc-2 {
        right: -6px;
        bottom: 60px;
      }

      .services-grid,
      .steps,
      .bento,
      .testi-grid {
        grid-template-columns: 1fr;
      }

      .strip-card {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
      }

      .stat b {
        font-size: 1.6rem;
      }

      .stat+.stat {
        padding-left: 16px;
      }

      .tabs {
        border-radius: 20px;
        width: 100%;
      }

      .tab {
        flex: 1 1 40%;
        justify-content: center;
        padding: 10px 12px;
      }

      .plans-box {
        padding: 18px;
        border-radius: 24px;
      }

      .plans-search,
      .plans-search input {
        width: 100%;
      }

      .plans-grid {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
      }

      .plan {
        padding: 14px;
      }

      .plan .price {
        font-size: 1.1rem;
      }

      .footer-grid {
        grid-template-columns: 1fr;
      }

      .partners-row {
        gap: 32px;
      }
    }
  </style>
</head>

<body>

  <!-- ================= HEADER ================= -->
  <header class="header" id="header">
    <div class="container nav">
      <a href="/" class="nav-logo" aria-label="VTUBIZ home">
        <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ">
      </a>

      <ul class="nav-links">
        <li class="has-dropdown">
          <button type="button">Products <i class="fa fa-angle-down"></i></button>
          <div class="dropdown">
            <a href="/data"><span class="dd-icon c-blue"><i class="fa fa-signal"></i></span><span>Data Plans<small>Cheap data on every network</small></span></a>
            <a href="/airtime"><span class="dd-icon c-green"><i class="fa fa-mobile-screen"></i></span><span>Airtime Top Up<small>Instant recharge, better rates</small></span></a>
            <a href="/cable"><span class="dd-icon c-purple"><i class="fa fa-tv"></i></span><span>Cable TV<small>DStv, GOtv &amp; Startimes</small></span></a>
            <a href="/electricity"><span class="dd-icon c-yellow"><i class="fa fa-lightbulb"></i></span><span>Electricity<small>Prepaid &amp; postpaid meters</small></span></a>
            <a href="/examination"><span class="dd-icon c-orange"><i class="fa fa-graduation-cap"></i></span><span>Exam Pins<small>WAEC, NECO &amp; more</small></span></a>
            <a href="/bulksms"><span class="dd-icon c-pink"><i class="fa fa-comment-dots"></i></span><span>Bulk SMS<small>Reach thousands in one click</small></span></a>
          </div>
        </li>
        <li><a href="#features">Features</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#business">VTU Business</a></li>
        <li><a href="/blogs">Blog</a></li>
      </ul>

      <div class="nav-actions">
        <a href="/login" class="login-link">Login</a>
        <a href="/register" class="btn btn-dark btn-sm">Create free account</a>
        <button class="menu-toggle" type="button" aria-label="Open menu" data-drawer-open><i class="fa fa-bars"></i></button>
      </div>
    </div>
  </header>

  <!-- Mobile drawer -->
  <div class="drawer-backdrop" data-drawer-close></div>
  <aside class="drawer" aria-label="Mobile menu">
    <div class="drawer-head">
      <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ">
      <button class="menu-toggle" style="display:grid;place-items:center" type="button" aria-label="Close menu" data-drawer-close><i class="fa fa-xmark"></i></button>
    </div>
    <h6>Products</h6>
    <a class="d-link" href="/data"><i class="fa fa-signal"></i> Data Plans</a>
    <a class="d-link" href="/airtime"><i class="fa fa-mobile-screen"></i> Airtime Top Up</a>
    <a class="d-link" href="/cable"><i class="fa fa-tv"></i> Cable TV</a>
    <a class="d-link" href="/electricity"><i class="fa fa-lightbulb"></i> Electricity</a>
    <a class="d-link" href="/examination"><i class="fa fa-graduation-cap"></i> Exam Pins</a>
    <a class="d-link" href="/bulksms"><i class="fa fa-comment-dots"></i> Bulk SMS</a>
    <h6>Company</h6>
    <a class="d-link" href="#features" data-drawer-close><i class="fa fa-star"></i> Features</a>
    <a class="d-link" href="#pricing" data-drawer-close><i class="fa fa-tags"></i> Pricing</a>
    <a class="d-link" href="#business" data-drawer-close><i class="fa fa-briefcase"></i> Start a VTU Business</a>
    <a class="d-link" href="/blogs"><i class="fa fa-newspaper"></i> Blog</a>
    <div class="drawer-cta">
      <a href="/register" class="btn btn-primary">Create free account</a>
      <a href="/login" class="btn btn-ghost">Login</a>
    </div>
    <div class="drawer-contact">
      <a href="mailto:support@vtubiz.com">support@vtubiz.com</a><br>
      <a href="tel:+2349058744473">+234 905 874 4473</a>
    </div>
  </aside>

  <main>
    <!-- ================= HERO ================= -->
    <section class="hero">
      <div class="container hero-grid">
        <div>
          <div class="hero-pill"><span class="tag">NEW</span> Schedule purchases &amp; buy offline</div>
          <h1>
            Top Up, <span class="accent">Pay Bills,</span><br>
            Stay <span class="flash-text">Connected.</span>
          </h1>
          <p class="hero-lead">
            The cheapest way to buy data and airtime, pay electricity bills and renew TV subscriptions.
            Fast, secure and delivered instantly.
          </p>
          <div class="hero-ctas">
            <a href="/register" class="btn btn-primary">Get started free <i class="fa fa-arrow-right"></i></a>
            <a href="#pricing" class="btn btn-ghost">See data prices</a>
          </div>
          <div class="hero-trust">
            <span><i class="fa fa-circle-check"></i> Instant delivery</span>
            <span><i class="fa fa-shield-halved"></i> Secure wallet</span>
            <span><i class="fa fa-clock"></i> 24/7 automated</span>
          </div>
        </div>

        <div class="hero-visual" aria-hidden="true">
          <div class="hero-blob"></div>

          <div class="phone">
            <div class="phone-notch"></div>
            <div class="phone-screen">
              <div class="ps-top">
                <div class="ps-hello">Good morning 👋</div>
                <div class="ps-name">Welcome back</div>
                <div class="ps-label">Wallet balance</div>
                <div class="ps-balance">₦24,850.00</div>
              </div>
              <div class="ps-card">
                <div class="ps-action"><div class="c-blue"><i class="fa fa-signal"></i></div>Data</div>
                <div class="ps-action"><div class="c-green"><i class="fa fa-mobile-screen"></i></div>Airtime</div>
                <div class="ps-action"><div class="c-yellow"><i class="fa fa-lightbulb"></i></div>Power</div>
                <div class="ps-action"><div class="c-purple"><i class="fa fa-tv"></i></div>Cable</div>
              </div>
              <div class="ps-section">
                <h6>Recent transactions</h6>
                <div class="ps-tx">
                  <div class="ic c-blue"><i class="fa fa-signal"></i></div>
                  <div><b>MTN 11GB</b><span>Successful</span></div>
                  <div class="amt">₦3,450</div>
                </div>
                <div class="ps-tx">
                  <div class="ic c-yellow"><i class="fa fa-lightbulb"></i></div>
                  <div><b>Electricity</b><span>Token sent</span></div>
                  <div class="amt">₦10,000</div>
                </div>
                <div class="ps-tx">
                  <div class="ic c-purple"><i class="fa fa-tv"></i></div>
                  <div><b>GOtv Max</b><span>Activated</span></div>
                  <div class="amt">₦8,500</div>
                </div>
              </div>
            </div>
          </div>

          <div class="float-card fc-1">
            <div class="ic c-yellow"><i class="fa fa-lightbulb"></i></div>
            <div><b>Electricity Token</b><small>Same money. More light.</small></div>
          </div>

          <div class="float-card fc-2 fc-dark">
            <span class="badge"><i class="fa fa-mobile-screen"></i> Special offer on MTN</span>
            <span class="big">11GB for ₦3,450</span>
            <small>7 days of connectivity</small>
            <span class="ok"><i class="fa fa-circle-check"></i> Delivered instantly</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= STATS STRIP ================= -->
    <section class="strip">
      <div class="container">
        <div class="strip-card reveal">
          <div class="stat"><b>&lt;5<em>s</em></b><span>Average delivery time</span></div>
          <div class="stat"><b>24<em>/7</em></b><span>Automated service</span></div>
          <div class="stat"><b>6<em>+</em></b><span>Services in one wallet</span></div>
          <div class="stat"><b>99.9<em>%</em></b><span>Transaction success rate</span></div>
        </div>
        <div class="networks reveal">
          <div class="lbl">Works with all major networks &amp; billers</div>
          <span class="net"><i class="dot" style="background:#ffcc00"></i> MTN</span>
          <span class="net"><i class="dot" style="background:#00853f"></i> Glo</span>
          <span class="net"><i class="dot" style="background:#ff0000"></i> Airtel</span>
          <span class="net"><i class="dot" style="background:#006666"></i> 9mobile</span>
          <span class="net"><i class="dot" style="background:#0ea5e9"></i> DStv</span>
          <span class="net"><i class="dot" style="background:#22c55e"></i> GOtv</span>
          <span class="net"><i class="dot" style="background:#f97316"></i> Startimes</span>
          <span class="net"><i class="dot" style="background:#a855f7"></i> All DisCos</span>
        </div>
      </div>
    </section>

    <!-- ================= SERVICES ================= -->
    <section id="services">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><i class="fa fa-layer-group"></i> Our services</span>
          <h2>Everything you need, in one wallet.</h2>
          <p>One platform for all your daily digital payments. Fund once and pay for everything.</p>
        </div>

        <div class="services-grid">
          <a href="/airtime" class="service reveal">
            <div class="ic c-green"><i class="fa fa-mobile-screen"></i></div>
            <h3>Airtime Top-Up</h3>
            <p>Buy airtime and get more value for your money. Fast top-up, better rates, no dulling.</p>
            <span class="more">Buy airtime <i class="fa fa-arrow-right"></i></span>
          </a>
          <a href="/data" class="service reveal">
            <div class="ic c-blue"><i class="fa fa-signal"></i></div>
            <h3>Affordable Data Plans</h3>
            <p>Browse, stream and chat with cheap data that lasts longer. Stay online without draining your pocket.</p>
            <span class="more">Buy data <i class="fa fa-arrow-right"></i></span>
          </a>
          <a href="/cable" class="service reveal">
            <div class="ic c-purple"><i class="fa fa-tv"></i></div>
            <h3>TV (Cable) Subscriptions</h3>
            <p>Renew your cable in seconds and never miss your favourite shows. Easy payment, instant activation.</p>
            <span class="more">Renew cable <i class="fa fa-arrow-right"></i></span>
          </a>
          <a href="/electricity" class="service reveal">
            <div class="ic c-yellow"><i class="fa fa-lightbulb"></i></div>
            <h3>Electricity Token</h3>
            <p>Pay for light and get more units for your money. Recharge your meter fast and enjoy longer power.</p>
            <span class="more">Pay electricity <i class="fa fa-arrow-right"></i></span>
          </a>
          <a href="/examination" class="service reveal">
            <div class="ic c-orange"><i class="fa fa-graduation-cap"></i></div>
            <h3>Exam Result Checkers</h3>
            <p>Check your results instantly at giveaway prices. No queues. No stress. Just results.</p>
            <span class="more">Get exam pins <i class="fa fa-arrow-right"></i></span>
          </a>
          <a href="/bulksms" class="service reveal">
            <div class="ic c-pink"><i class="fa fa-comment-dots"></i></div>
            <h3>Bulk SMS</h3>
            <p>Send your message to thousands in one click. Perfect for business, promos and announcements.</p>
            <span class="more">Send bulk SMS <i class="fa fa-arrow-right"></i></span>
          </a>
        </div>
      </div>
    </section>

    <!-- ================= HOW IT WORKS ================= -->
    <section class="how">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><i class="fa fa-route"></i> How it works</span>
          <h2>Up and running in 3 simple steps.</h2>
          <p>No paperwork, no waiting. Get started in under a minute.</p>
        </div>
        <div class="steps">
          <div class="step reveal">
            <div class="step-num">1</div>
            <h3>Create a free account</h3>
            <p>Sign up with your name, email and phone number. It takes less than 60 seconds.</p>
          </div>
          <div class="step reveal">
            <div class="step-num">2</div>
            <h3>Fund your wallet</h3>
            <p>Top up your wallet by bank transfer or card. Your funds are kept secure and ready to use.</p>
          </div>
          <div class="step reveal">
            <div class="step-num">3</div>
            <h3>Buy instantly</h3>
            <p>Pick a service, enter the details and pay. Data, airtime and tokens arrive in seconds.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= FEATURES ================= -->
    <section id="features">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><i class="fa fa-wand-magic-sparkles"></i> Our features</span>
          <h2>Built to save you time and money.</h2>
          <p>Smart tools that make us stand out from every other VTU platform.</p>
        </div>

        <div class="bento">
          <div class="feat dark span-3 wide-m reveal">
            <div class="ic"><i class="fa fa-calendar-check"></i></div>
            <h3>Schedule Purchases</h3>
            <p>Plan your purchases ahead. Even when you're offline, we keep you connected and your data renews on time.</p>
            <div class="feat-visual">
              <span class="chip"><i class="fa fa-clock"></i> Every Monday, 8:00am</span>
              <span class="chip"><i class="fa fa-signal"></i> MTN 2GB</span>
              <span class="chip"><i class="fa fa-repeat"></i> Auto-renew</span>
            </div>
          </div>
          <div class="feat orange span-3 wide-m reveal">
            <div class="ic"><i class="fa fa-users"></i></div>
            <h3>Group &amp; Bulk Purchases</h3>
            <p>Create as many groups as you want (family, staff, customers) and send data or airtime to everyone in one click.</p>
            <div class="feat-visual">
              <span class="chip"><i class="fa fa-user-group"></i> Family · 5</span>
              <span class="chip"><i class="fa fa-briefcase"></i> Staff · 24</span>
            </div>
          </div>
          <div class="feat span-2 reveal">
            <div class="ic"><i class="fa fa-rotate-right"></i></div>
            <h3>Transaction Redo</h3>
            <p>Repeat any past transaction with a single click. No need to re-enter details.</p>
          </div>
          <div class="feat span-2 reveal">
            <div class="ic"><i class="fa fa-address-book"></i></div>
            <h3>Save Beneficiaries</h3>
            <p>Save phone, meter and decoder numbers for faster checkouts next time.</p>
          </div>
          <div class="feat span-2 wide-m reveal">
            <div class="ic"><i class="fa fa-wifi"></i></div>
            <h3>Offline &amp; Self Service</h3>
            <p>Buy even without internet, and resolve issues yourself with our self-service tools.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= PRICING ================= -->
    <section id="pricing" class="pricing">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><i class="fa fa-tags"></i> Data pricing</span>
          <h2>Honest prices. No hidden charges.</h2>
          <p>Live prices for data plans on every network. Pick a network to see all plans.</p>
        </div>

        @php
          $networks = [
            ['key' => 'mtn', 'name' => 'MTN', 'label' => 'MTN Data', 'tag' => 'Best network', 'letter' => 'M', 'bg' => '#ffcc00', 'fg' => '#000', 'plans' => $mtn],
            ['key' => 'glo', 'name' => 'Glo', 'label' => 'Glo Data', 'tag' => 'Most popular', 'letter' => 'G', 'bg' => '#00853f', 'fg' => '#fff', 'plans' => $glo],
            ['key' => 'airtel', 'name' => 'Airtel', 'label' => 'Airtel Data', 'tag' => 'Fast speed', 'letter' => 'A', 'bg' => '#ff0000', 'fg' => '#fff', 'plans' => $airtel],
            ['key' => '9mobile', 'name' => '9mobile', 'label' => '9mobile Data', 'tag' => 'Affordable', 'letter' => '9', 'bg' => '#006666', 'fg' => '#fff', 'plans' => $nmobile],
          ];
        @endphp

        <div class="tabs reveal" role="tablist">
          @foreach($networks as $i => $net)
            <button class="tab {{ $i === 0 ? 'active' : '' }}" type="button" role="tab"
              data-tab="{{ $net['key'] }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
              <i class="dot" style="background: {{ $net['bg'] }}"></i> {{ $net['name'] }}
            </button>
          @endforeach
        </div>

        <div class="plans-box reveal">
          @foreach($networks as $i => $net)
            <div class="plans-panel {{ $i === 0 ? 'active' : '' }}" data-panel="{{ $net['key'] }}" role="tabpanel">
              <div class="plans-head">
                <div class="net-badge">
                  <div class="net-logo" style="background: {{ $net['bg'] }}; color: {{ $net['fg'] }}">{{ $net['letter'] }}</div>
                  <div>
                    <h3>{{ $net['label'] }}</h3>
                    <small>{{ $net['tag'] }} · {{ count($net['plans']) }} plans</small>
                  </div>
                </div>
                <div class="plans-search">
                  <i class="fa fa-magnifying-glass"></i>
                  <input type="search" placeholder="Search e.g. 1GB, 30 days" data-search aria-label="Search {{ $net['name'] }} plans">
                </div>
              </div>
              <div class="plans-grid">
                @forelse($net['plans'] as $data)
                  <div class="plan" data-plan="{{ strtolower($data->plan_name) }}">
                    <span class="price">₦{{ number_format($data->data_price) }}</span>
                    <span class="name">{{ $data->plan_name }}</span>
                    <a href="/login">Buy now <i class="fa fa-arrow-right"></i></a>
                  </div>
                @empty
                  <div class="plans-empty">No {{ $net['name'] }} plans available right now. Please check back soon.</div>
                @endforelse
                <div class="plans-empty" data-no-results style="display:none">No plans match your search.</div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="plans-foot">
          <a href="/register" class="btn btn-dark">Create an account to buy <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </section>

    <!-- ================= VTU BUSINESS ================= -->
    <section id="business">
      <div class="container">
        <div class="reseller reveal">
          <div class="reseller-left">
            <span class="eyebrow"><i class="fa fa-rocket"></i> Best value</span>
            <h2>Start your own<br>VTU business.</h2>
            <p>Get a fully functional VTU website with your own branding, domain and admin panel.
              Set your own prices and earn on every transaction.</p>
            <div class="cta-actions">
              <a href="/business" class="btn btn-primary">Get started now <i class="fa fa-arrow-right"></i></a>
              <a href="https://wa.me/2349058744473" class="btn btn-outline-white" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Talk to us</a>
            </div>
          </div>
          <div class="reseller-right">
            <div class="price-label">One-time setup fee</div>
            <div class="price-big">₦45,000 <small>/ once</small></div>
            <ul class="checklist">
              <li><i class="fa fa-check"></i> Custom domain name</li>
              <li><i class="fa fa-check"></i> Your brand, logo &amp; colours</li>
              <li><i class="fa fa-check"></i> Full admin dashboard</li>
              <li><i class="fa fa-check"></i> API access</li>
              <li><i class="fa fa-check"></i> Unlimited transactions</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= TESTIMONIALS ================= -->
    <section class="how" id="community">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><i class="fa fa-heart"></i> Our community</span>
          <h2>Loved by customers and resellers.</h2>
          <p>Don't take our word for it. Here's what people say about VTUBIZ.</p>
        </div>

        <div class="testi-grid">
          <div class="testi reveal">
            <div class="stars">★★★★★</div>
            <blockquote>“VTUBIZ has simplified the way I handle my transactions. The option to schedule purchases is a
              game-changer, and the bulk SMS feature is a bonus. Fast, efficient and reliable.”</blockquote>
            <div class="testi-author">
              <div class="avatar" style="background:#2563eb">PM</div>
              <div><b>Patrick Mercy</b><small>Customer</small></div>
            </div>
          </div>
          <div class="testi reveal">
            <div class="stars">★★★★★</div>
            <blockquote>“Saving beneficiaries and group purchase have made VTUBIZ my go-to for airtime, data, bills and
              more. It's user-friendly, reliable and simply the best in the business!”</blockquote>
            <div class="testi-author">
              <div class="avatar" style="background:#fb9129">FV</div>
              <div><b>Fasanya Victor</b><small>Customer</small></div>
            </div>
          </div>
          <div class="testi reveal">
            <div class="stars">★★★★★</div>
            <blockquote>“As a reseller, partnering with VTUBIZ has significantly boosted my revenue. Transaction redo and
              bulk purchase have set my business apart. It's a reseller's key to success!”</blockquote>
            <div class="testi-author">
              <div class="avatar" style="background:#16a34a">AS</div>
              <div><b>Amusan Sanya</b><small>Reseller</small></div>
            </div>
          </div>
          <div class="testi reveal">
            <div class="stars">★★★★★</div>
            <blockquote>“Exceptional service! Saving beneficiaries and group purchases have made life so much easier. Now I
              manage all my transactions in one place without any hassle.”</blockquote>
            <div class="testi-author">
              <div class="avatar" style="background:#7c3aed">SO</div>
              <div><b>Somoye Hayinke Oluwatoba</b><small>Customer</small></div>
            </div>
          </div>
        </div>

        <div class="partners reveal">
          <p>Trusted by businesses</p>
          <div class="partners-row">
            <img src="{{ asset('assets/img/cttaste_logo.png') }}" alt="CT Taste">
            <img src="{{ asset('assets/img/cthostel_logo.png') }}" alt="CT Hostel">
            <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ">
          </div>
        </div>
      </div>
    </section>

    <!-- ================= FAQ ================= -->
    <section id="faq">
      <div class="container">
        <div class="section-head reveal">
          <span class="eyebrow"><i class="fa fa-circle-question"></i> FAQ</span>
          <h2>Frequently asked questions.</h2>
        </div>
        <div class="faq-wrap">
          <details class="faq reveal" open>
            <summary>How fast will I receive my data or airtime? <i class="fa fa-plus"></i></summary>
            <div class="ans">Almost instantly. Most transactions are delivered within seconds of payment, 24 hours a day.</div>
          </details>
          <details class="faq reveal">
            <summary>How do I fund my wallet? <i class="fa fa-plus"></i></summary>
            <div class="ans">After signing up, you can fund your wallet by bank transfer or card from your dashboard. Your balance reflects automatically.</div>
          </details>
          <details class="faq reveal">
            <summary>What happens if a transaction fails? <i class="fa fa-plus"></i></summary>
            <div class="ans">Failed transactions are automatically refunded to your wallet. You can also retry instantly with Transaction Redo.</div>
          </details>
          <details class="faq reveal">
            <summary>Can I start my own VTU business with VTUBIZ? <i class="fa fa-plus"></i></summary>
            <div class="ans">Yes. For a one-time fee of ₦45,000 you get your own branded VTU website with a custom domain, admin dashboard and API access. <a href="/business" style="color:var(--orange-2);font-weight:700">Learn more →</a></div>
          </details>
        </div>
      </div>
    </section>

    <!-- ================= CTA ================= -->
    <section class="cta">
      <div class="container">
        <div class="cta-card reveal">
          <div>
            <h2>Join thousands staying connected with VTUBIZ.</h2>
            <p>Create your free account today and enjoy the cheapest rates on data, airtime and bills.</p>
          </div>
          <div class="cta-actions">
            <a href="/register" class="btn btn-white">Create free account</a>
            <a href="/login" class="btn btn-outline-white">Login</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ================= FOOTER ================= -->
  <footer class="footer" id="about">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ">
          <p>A complete platform for your data, airtime, electricity and cable subscription needs. We power your
            digital lifestyle through affordability, automation and lightning-fast transactions.</p>
          <div class="socials">
            <a href="https://www.instagram.com/vtubiz/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/2349058744473" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            <a href="mailto:support@vtubiz.com" aria-label="Email"><i class="fa fa-envelope"></i></a>
          </div>
        </div>

        <div>
          <h4>Products</h4>
          <ul>
            <li><a href="/data">Data Plans</a></li>
            <li><a href="/airtime">Airtime Top Up</a></li>
            <li><a href="/cable">Cable TV</a></li>
            <li><a href="/electricity">Electricity</a></li>
            <li><a href="/examination">Exam Pins</a></li>
            <li><a href="/bulksms">Bulk SMS</a></li>
          </ul>
        </div>

        <div>
          <h4>Company</h4>
          <ul>
            <li><a href="#features">Features</a></li>
            <li><a href="#business">Start a VTU Business</a></li>
            <li><a href="/blogs">Blog</a></li>
            <li><a href="/terms-of-service">Terms of Use</a></li>
            <li><a href="/privacy-policy">Privacy Policy</a></li>
          </ul>
        </div>

        <div>
          <h4>Get in touch</h4>
          <div class="contact-line"><i class="fa fa-location-dot"></i><span>No 1, Igbelowowa Street, Kobape, Abeokuta, Ogun State</span></div>
          <div class="contact-line"><i class="fa fa-envelope"></i><a href="mailto:support@vtubiz.com">support@vtubiz.com</a></div>
          <div class="contact-line"><i class="fa fa-phone"></i><a href="tel:+2349058744473">+234 905 874 4473</a></div>
          <form class="newsletter" action="#" method="post" onsubmit="event.preventDefault(); this.querySelector('button').textContent='Subscribed ✓';">
            <input type="email" name="EMAIL" placeholder="Your email for deals" aria-label="Email address" required>
            <button type="submit" class="btn btn-primary btn-sm">Join</button>
          </form>
        </div>
      </div>

      <div class="footer-bottom">
        <span>© {{ date('Y') }} VTUBIZ. All rights reserved.</span>
        <span><a href="/terms-of-service">Terms</a> · <a href="/privacy-policy">Privacy</a></span>
      </div>
    </div>
  </footer>

  <button class="to-top" type="button" aria-label="Back to top" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fa fa-arrow-up"></i></button>

  <script>
    (function () {
      // Header shadow + back-to-top
      var header = document.getElementById('header');
      var toTop = document.querySelector('.to-top');
      function onScroll() {
        var y = window.scrollY;
        header.classList.toggle('scrolled', y > 10);
        toTop.classList.toggle('show', y > 600);
      }
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();

      // Mobile drawer
      document.querySelectorAll('[data-drawer-open]').forEach(function (el) {
        el.addEventListener('click', function () { document.body.classList.add('drawer-open'); });
      });
      document.querySelectorAll('[data-drawer-close]').forEach(function (el) {
        el.addEventListener('click', function () { document.body.classList.remove('drawer-open'); });
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') document.body.classList.remove('drawer-open');
      });

      // Pricing tabs
      var tabs = document.querySelectorAll('.tab');
      tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
          var key = tab.getAttribute('data-tab');
          tabs.forEach(function (t) {
            t.classList.toggle('active', t === tab);
            t.setAttribute('aria-selected', t === tab ? 'true' : 'false');
          });
          document.querySelectorAll('.plans-panel').forEach(function (p) {
            p.classList.toggle('active', p.getAttribute('data-panel') === key);
          });
        });
      });

      // Plan search
      document.querySelectorAll('[data-search]').forEach(function (input) {
        input.addEventListener('input', function () {
          var q = input.value.trim().toLowerCase();
          var panel = input.closest('.plans-panel');
          var plans = panel.querySelectorAll('.plan');
          var shown = 0;
          plans.forEach(function (p) {
            var text = p.getAttribute('data-plan') + ' ' + p.querySelector('.price').textContent.toLowerCase();
            var match = !q || text.indexOf(q) !== -1;
            p.style.display = match ? '' : 'none';
            if (match) shown++;
          });
          var none = panel.querySelector('[data-no-results]');
          if (none) none.style.display = (plans.length && !shown) ? '' : 'none';
        });
      });

      // Reveal on scroll
      var items = document.querySelectorAll('.reveal');
      if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('in');
              io.unobserve(entry.target);
            }
          });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        items.forEach(function (el) { io.observe(el); });
      } else {
        items.forEach(function (el) { el.classList.add('in'); });
      }
    })();
  </script>
</body>

</html>
