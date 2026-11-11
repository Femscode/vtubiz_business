{{--
    Page announcements (admin "notifications" + deal of the day).
    Expects $announcements (built in master1): [['kind' => 'notice'|'deal', 'item' => Notification]]
    - Shows once per announcement version; "Got it" remembers it in localStorage until the admin edits it.
    - Closing (×, backdrop, Esc) snoozes for the browser session.
    - A slim ribbon (dashboard.partials.announcement-ribbon) stays on the page so it can be reopened any time.
--}}
@if($announcements->count())
<style>
    .anx { position: fixed; inset: 0; z-index: 3000; display: flex; align-items: center; justify-content: center; padding: 20px; }
    .anx[hidden] { display: none; }
    .anx-backdrop { position: absolute; inset: 0; background: rgba(6, 14, 26, .6); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); animation: anx-fade .3s ease; }
    .anx-card { position: relative; width: 100%; max-width: 460px; max-height: calc(100dvh - 40px); display: flex; flex-direction: column; background: #fff; border-radius: 30px; overflow: hidden; box-shadow: 0 50px 100px -30px rgba(0, 0, 0, .6); animation: anx-pop .5s cubic-bezier(.2, .9, .25, 1.15); font-family: 'DM Sans', sans-serif; }
    .anx-x { position: absolute; top: 14px; right: 14px; z-index: 3; width: 36px; height: 36px; border: 0; border-radius: 50%; background: rgba(255, 255, 255, .18); color: #fff; display: grid; place-items: center; cursor: pointer; backdrop-filter: blur(6px); transition: background .15s; }
    .anx-x:hover { background: rgba(255, 255, 255, .3); }

    .anx-slide { display: flex; flex-direction: column; min-height: 0; flex: 1; animation: anx-slide .35s ease; }
    .anx-slide[hidden] { display: none; }

    .anx-hero { position: relative; flex-shrink: 0; height: 168px; display: flex; align-items: center; justify-content: center; overflow: hidden; color: #fff; }
    .anx-notice .anx-hero { background: radial-gradient(120% 120% at 100% 0%, #FB9129 0%, transparent 45%), linear-gradient(150deg, #0A3A66, #001f3f 60%, #00142a); }
    .anx-deal .anx-hero { background: radial-gradient(120% 120% at 0% 0%, #FFD36E 0%, transparent 45%), linear-gradient(150deg, #FF9A3C, #FF6A00 55%, #E0457B); }
    .anx-hero::before, .anx-hero::after { content: ''; position: absolute; border-radius: 50%; border: 1.5px solid rgba(255, 255, 255, .14); }
    .anx-hero::before { width: 260px; height: 260px; left: -70px; bottom: -150px; }
    .anx-hero::after { width: 180px; height: 180px; right: -50px; top: -90px; }
    .anx-spark { position: absolute; width: 6px; height: 6px; border-radius: 50%; background: rgba(255, 255, 255, .75); animation: anx-float 3.2s ease-in-out infinite; }
    .anx-spark:nth-child(1) { left: 18%; top: 28%; }
    .anx-spark:nth-child(2) { left: 78%; top: 62%; width: 4px; height: 4px; animation-delay: .6s; }
    .anx-spark:nth-child(3) { left: 30%; top: 74%; width: 3px; height: 3px; animation-delay: 1.2s; }
    .anx-spark:nth-child(4) { left: 66%; top: 22%; width: 5px; height: 5px; animation-delay: 1.8s; }

    .anx-icon { position: relative; z-index: 1; width: 76px; height: 76px; border-radius: 24px; display: grid; place-items: center; font-size: 30px; background: rgba(255, 255, 255, .16); border: 1px solid rgba(255, 255, 255, .28); backdrop-filter: blur(6px); box-shadow: 0 18px 36px -12px rgba(0, 0, 0, .35); animation: anx-bob 3s ease-in-out infinite; }
    .anx-icon::before, .anx-icon::after { content: ''; position: absolute; inset: -1px; border-radius: 24px; border: 2px solid rgba(255, 255, 255, .45); animation: anx-ring 2.4s ease-out infinite; }
    .anx-icon::after { animation-delay: 1.2s; }
    .anx-tag { position: absolute; z-index: 1; left: 20px; bottom: 16px; font-size: .68rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; padding: 6px 11px; border-radius: 999px; background: rgba(255, 255, 255, .18); backdrop-filter: blur(6px); }

    .anx-content { padding: 24px 26px 6px; overflow-y: auto; min-height: 0; }
    .anx-content h2 { font-family: 'Fraunces', serif; font-weight: 500; font-size: 1.6rem; line-height: 1.15; letter-spacing: -.02em; color: #0B1625; margin: 0 0 10px; }
    .anx-desc { color: #4B5563; font-size: .95rem; line-height: 1.65; }
    .anx-deal .anx-desc { font-size: 1.05rem; font-weight: 600; color: #0B1625; }
    .anx-desc p { margin: 0 0 10px; }
    .anx-desc img { max-width: 100%; height: auto; border-radius: 14px; }
    .anx-desc a { color: #FF7A00; font-weight: 600; }

    .anx-foot { flex-shrink: 0; display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 18px 26px 24px; }
    .anx-dots { display: flex; gap: 6px; }
    .anx-dot { width: 7px; height: 7px; border-radius: 999px; border: 0; padding: 0; background: #E2E2DC; cursor: pointer; transition: width .25s, background .25s; }
    .anx-dot.on { width: 22px; background: #0B1625; }
    .anx-btn { margin-left: auto; display: inline-flex; align-items: center; gap: 8px; padding: 14px 26px; border: 0; border-radius: 999px; background: linear-gradient(135deg, #FFA23F, #FF7A00); color: #fff; font-weight: 700; font-size: .95rem; font-family: inherit; cursor: pointer; box-shadow: 0 12px 24px -10px rgba(255, 122, 0, .65); transition: transform .15s; }
    .anx-btn:hover { transform: translateY(-1px); }
    .anx-btn:focus-visible, .anx-x:focus-visible { outline: 3px solid rgba(251, 145, 41, .5); outline-offset: 2px; }

    @keyframes anx-fade { from { opacity: 0; } }
    @keyframes anx-pop { from { opacity: 0; transform: translateY(30px) scale(.94); } }
    @keyframes anx-up { from { transform: translateY(100%); } }
    @keyframes anx-slide { from { opacity: 0; transform: translateX(16px); } }
    @keyframes anx-bob { 50% { transform: translateY(-6px) rotate(-4deg); } }
    @keyframes anx-ring { from { opacity: .8; transform: scale(1); } to { opacity: 0; transform: scale(1.6); } }
    @keyframes anx-float { 50% { transform: translateY(-10px); opacity: .35; } }

    @media (max-width: 575px) {
        .anx { align-items: flex-end; padding: 0; }
        .anx-card { max-width: none; border-radius: 28px 28px 0 0; max-height: 90dvh; animation: anx-up .4s cubic-bezier(.2, .9, .3, 1); padding-bottom: env(safe-area-inset-bottom); }
        .anx-hero { height: 140px; }
        .anx-content { padding: 20px 20px 4px; }
        .anx-content h2 { font-size: 1.4rem; }
        .anx-foot { padding: 16px 20px 20px; }
    }

    /* Ribbon (markup in announcement-ribbon.blade.php) */
    .anx-ribbon { max-width: 1180px; margin: 0 auto 14px; padding: 0 8px; display: flex; align-items: stretch; gap: 6px; animation: anx-ribbon-in .4s ease; }
    .anx-ribbon[hidden] { display: none; }
    .anx-ribbon-main { flex: 1; min-width: 0; display: flex; align-items: center; gap: 12px; padding: 8px 16px 8px 8px; border: 1px solid rgba(11, 22, 37, .07); border-radius: 999px; background: #fff; box-shadow: 0 1px 2px rgba(11, 22, 37, .04), 0 8px 24px rgba(11, 22, 37, .04); cursor: pointer; font-family: inherit; text-align: left; color: #0B1625; transition: box-shadow .15s, transform .15s; }
    .anx-ribbon-main:hover { transform: translateY(-1px); box-shadow: 0 12px 28px -12px rgba(11, 22, 37, .25); }
    .anx-ribbon-icon { width: 32px; height: 32px; flex-shrink: 0; border-radius: 50%; display: grid; place-items: center; font-size: 13px; color: #fff; background: linear-gradient(135deg, #0A3A66, #001f3f); }
    .anx-ribbon.is-deal .anx-ribbon-icon { background: linear-gradient(135deg, #FFA23F, #FF6A00); }
    .anx-ribbon-text { flex: 1; min-width: 0; font-size: .88rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .anx-ribbon-cta { flex-shrink: 0; font-size: .8rem; font-weight: 700; color: #FF7A00; }
    .anx-ribbon-x { width: 44px; flex-shrink: 0; border: 1px solid rgba(11, 22, 37, .07); border-radius: 50%; background: #fff; color: #A0A6B1; cursor: pointer; }
    .anx-ribbon-x:hover { color: #0B1625; }
    @keyframes anx-ribbon-in { from { opacity: 0; transform: translateY(-6px); } }

    @media (prefers-reduced-motion: reduce) {
        .anx-ribbon,
        .anx-card, .anx-icon, .anx-icon::before, .anx-icon::after, .anx-spark, .anx-slide { animation: none !important; }
    }
</style>

<div class="anx" id="anx" hidden role="dialog" aria-modal="true" aria-labelledby="anx-title-0">
    <div class="anx-backdrop" data-anx-dismiss></div>
    <div class="anx-card">
        <button type="button" class="anx-x" data-anx-dismiss aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>

        @foreach($announcements as $i => $a)
            @php $isDeal = $a['kind'] === 'deal'; @endphp
            <article class="anx-slide {{ $isDeal ? 'anx-deal' : 'anx-notice' }}" data-key="{{ $a['key'] }}" hidden>
                <div class="anx-hero">
                    <span class="anx-spark"></span><span class="anx-spark"></span><span class="anx-spark"></span><span class="anx-spark"></span>
                    <div class="anx-icon"><i class="fa-solid {{ $isDeal ? 'fa-tags' : 'fa-bullhorn' }}"></i></div>
                    <span class="anx-tag">{{ $isDeal ? 'Deal of the day' : 'Announcement' }}</span>
                </div>
                <div class="anx-content">
                    <h2 id="anx-title-{{ $i }}">{{ $a['item']->title }}</h2>
                    <div class="anx-desc">{!! $a['item']->description !!}</div>
                </div>
            </article>
        @endforeach

        <footer class="anx-foot">
            <div class="anx-dots" id="anx-dots"></div>
            <button type="button" class="anx-btn" id="anx-next">Got it</button>
        </footer>
    </div>
</div>

<script>
    (function () {
        var SEEN = 'vtubiz_anx_seen', SNOOZE = 'vtubiz_anx_snoozed';
        var root = document.getElementById('anx');
        if (!root) return;
        var all = Array.prototype.slice.call(root.querySelectorAll('.anx-slide'));
        var btn = document.getElementById('anx-next');
        var dotsEl = document.getElementById('anx-dots');
        var queue = [], idx = 0, lastFocus = null;

        function read(store, key) { try { return JSON.parse(store.getItem(key) || '[]'); } catch (e) { return []; } }
        function write(store, key, val) { try { store.setItem(key, JSON.stringify(val.slice(-50))); } catch (e) {} }
        function remember(store, key, k) { var l = read(store, key); if (l.indexOf(k) === -1) { l.push(k); write(store, key, l); } }

        function render() {
            all.forEach(function (s) { s.hidden = true; });
            var s = queue[idx];
            s.hidden = false;
            root.setAttribute('aria-labelledby', s.querySelector('h2').id);
            dotsEl.innerHTML = '';
            if (queue.length > 1) {
                queue.forEach(function (_, i) {
                    var d = document.createElement('button');
                    d.type = 'button';
                    d.className = 'anx-dot' + (i === idx ? ' on' : '');
                    d.setAttribute('aria-label', 'Announcement ' + (i + 1) + ' of ' + queue.length);
                    d.onclick = function () { idx = i; render(); };
                    dotsEl.appendChild(d);
                });
            }
            btn.innerHTML = idx < queue.length - 1 ? 'Next <i class="fa-solid fa-arrow-right"></i>' : 'Got it';
        }

        function open(slides) {
            if (!slides.length) return;
            queue = slides; idx = 0;
            lastFocus = document.activeElement;
            root.hidden = false;
            render();
            setTimeout(function () { btn.focus(); }, 50);
            toggleRibbon(false);
        }

        function close() {
            root.hidden = true;
            toggleRibbon(true);
            if (lastFocus && lastFocus.focus) lastFocus.focus();
        }

        function toggleRibbon(show) {
            var r = document.getElementById('anx-ribbon');
            if (r && !read(sessionStorage, SNOOZE + '_ribbon').length) r.hidden = !show;
        }

        btn.addEventListener('click', function () {
            remember(localStorage, SEEN, queue[idx].getAttribute('data-key'));
            if (idx < queue.length - 1) { idx++; render(); } else { close(); }
        });

        root.addEventListener('click', function (e) {
            if (e.target.closest('[data-anx-dismiss]')) {
                queue.forEach(function (s) { remember(sessionStorage, SNOOZE, s.getAttribute('data-key')); });
                close();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (root.hidden) return;
            if (e.key === 'Escape') root.querySelector('.anx-x').click();
            if (e.key === 'ArrowRight' && idx < queue.length - 1) { idx++; render(); }
            if (e.key === 'ArrowLeft' && idx > 0) { idx--; render(); }
        });

        // Ribbon lives inside the Vue root, so use delegation (Vue re-creates those nodes on mount).
        document.addEventListener('click', function (e) {
            if (e.target.closest('[data-anx-open]')) { open(all); }
            if (e.target.closest('[data-anx-ribbon-close]')) {
                write(sessionStorage, SNOOZE + '_ribbon', ['1']);
                var r = document.getElementById('anx-ribbon');
                if (r) r.hidden = true;
            }
        });

        var seen = read(localStorage, SEEN), snoozed = read(sessionStorage, SNOOZE);
        var fresh = all.filter(function (s) {
            var k = s.getAttribute('data-key');
            return seen.indexOf(k) === -1 && snoozed.indexOf(k) === -1;
        });

        if (fresh.length) setTimeout(function () { open(fresh); }, 700);
        else toggleRibbon(true);
    })();
</script>
@endif
