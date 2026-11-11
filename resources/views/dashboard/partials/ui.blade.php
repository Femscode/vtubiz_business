{{--
    VTUBIZ dashboard UI kit.
    Shared, page-agnostic building blocks used by every page that extends dashboard.master1.
    Prefix: none for layout blocks (pg, panel), "-v" suffix where a Bootstrap class of the same name exists.
--}}
<style>
    /* ---------- Page ---------- */
    .pg {
        max-width: 1180px;
        margin: 0 auto;
        padding: 12px 8px 48px;
        width: 100%;
    }

    .pg-narrow {
        max-width: 760px;
    }

    .pg-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 26px;
    }

    .pg-head h1 {
        font-family: 'Fraunces', serif;
        font-weight: 400;
        font-size: clamp(1.8rem, 3vw, 2.4rem);
        letter-spacing: -0.02em;
        color: var(--ink);
        line-height: 1.12;
        margin: 0;
    }

    .pg-head h1 em {
        color: var(--brand-orange-2);
    }

    .pg-head p {
        color: var(--text-secondary);
        margin: 6px 0 0;
        font-size: .95rem;
    }

    .pg-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .pg-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: .85rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-decoration: none;
        margin-bottom: 12px;
    }

    .pg-back:hover {
        color: var(--ink);
    }

    /* ---------- Panels ---------- */
    .panel {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 24px;
        box-shadow: var(--shadow-card);
        padding: 26px;
        min-width: 0;
    }

    .pg>.panel+.panel,
    .pg>.panel+.grid-v,
    .pg>.grid-v+.panel,
    .pg>.grid-v+.grid-v {
        margin-top: 20px;
    }

    .tbl b {
        font-weight: 600;
        font-size: .92rem;
    }

    .panel-flush {
        padding: 0;
        overflow: hidden;
    }

    .panel-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .panel-flush .panel-head {
        padding: 22px 24px 0;
    }

    .panel-head h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.2rem;
        color: var(--ink);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .panel-head p {
        margin: 4px 0 0;
        color: var(--text-secondary);
        font-size: .86rem;
    }

    .grid-v {
        display: grid;
        gap: 20px;
        align-items: start;
    }

    .grid-v.cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .grid-v.cols-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .grid-v.main-side {
        grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr);
    }

    .grid-v.side-main {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1.5fr);
    }

    /* Dark hero card (matches the dashboard wallet card) */
    .hero-v {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        padding: 26px;
        color: #fff;
        background: linear-gradient(150deg, #04284d 0%, var(--primary-dark) 45%, #00162d 100%);
        isolation: isolate;
        box-shadow: 0 30px 60px -30px rgba(0, 31, 63, .7);
    }

    .hero-v::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        right: -120px;
        bottom: -170px;
        border-radius: 50%;
        background: radial-gradient(circle at 40% 40%, #ffcf99 0%, var(--brand-orange) 30%, rgba(180, 65, 10, .55) 55%, transparent 72%);
        opacity: .8;
        z-index: -1;
    }

    .hero-v .k {
        font-size: .74rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .6);
        font-weight: 600;
    }

    .hero-v .v {
        font-family: 'Fraunces', serif;
        font-size: 1.45rem;
        font-weight: 400;
        letter-spacing: -.01em;
        color: #fff;
        word-break: break-word;
    }

    /* ---------- Stats ---------- */
    .stats-v {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 14px;
        margin-bottom: 22px;
    }

    .stat-v {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 20px;
        padding: 16px 18px;
        box-shadow: var(--shadow-card);
        min-width: 0;
    }

    .stat-v .k {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: .8rem;
        color: var(--text-secondary);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .stat-v .k i {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        display: grid;
        place-items: center;
        font-size: .72rem;
    }

    .stat-v .v {
        font-family: 'Fraunces', serif;
        font-size: 1.45rem;
        font-weight: 500;
        color: var(--ink);
        font-variant-numeric: tabular-nums;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Tones */
    .t-blue { background: #EAF2FF; color: #2563EB; }
    .t-amber { background: #FFF4E5; color: #EA7A0C; }
    .t-yellow { background: #FEF7D7; color: #B88A00; }
    .t-pink { background: #FFECEF; color: #E11D48; }
    .t-purple { background: #F1ECFF; color: #7C3AED; }
    .t-green { background: #E7F7EE; color: #1F9D57; }
    .t-ink { background: #EEF0F3; color: var(--ink); }
    .t-teal { background: #E3F6F4; color: #0F8C80; }

    /* ---------- Forms ---------- */
    .f-group {
        margin-bottom: 18px;
    }

    .f-label {
        display: block;
        font-weight: 600;
        font-size: .86rem;
        color: #2B3445;
        margin-bottom: 8px;
    }

    #app .f-input,
    .f-input {
        width: 100%;
        font-family: 'DM Sans', sans-serif;
        font-size: 1rem;
        color: var(--ink);
        background: #FAFAF8;
        border: 1.5px solid rgba(11, 22, 37, .08);
        border-radius: 14px;
        padding: 13px 16px;
        outline: none;
        transition: border-color .2s, background .2s, box-shadow .2s;
        -webkit-appearance: none;
        appearance: none;
    }

    select.f-input {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }

    textarea.f-input {
        resize: vertical;
        min-height: 120px;
        line-height: 1.55;
    }

    .f-input:focus {
        background: #fff;
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 4px rgba(0, 31, 63, .06);
    }

    .f-input[readonly],
    .f-input:disabled {
        color: var(--text-secondary);
        background: #F3F3F0;
    }

    #app .f-input-lg,
    .f-input-lg {
        font-size: 1.35rem;
        font-weight: 600;
        padding: 16px 18px;
        font-variant-numeric: tabular-nums;
    }

    .f-affix {
        position: relative;
    }

    .f-affix>.pre {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-weight: 600;
        pointer-events: none;
        /* DM Sans has no Naira glyph; use a system font that does */
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1;
    }

    /* #app prefix needed to beat the global "#app .f-input" padding */
    #app .f-affix>.f-input,
    .f-affix>.f-input {
        padding-left: 40px;
    }

    #app .f-affix>.f-input-lg,
    .f-affix>.f-input-lg {
        padding-left: 44px;
    }

    .f-affix>.f-input-lg~.pre,
    .f-affix:has(.f-input-lg)>.pre {
        font-size: 1.2rem;
        left: 18px;
    }

    .f-hint {
        font-size: .8rem;
        color: var(--text-secondary);
        margin-top: 7px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .f-hint.warn {
        color: #B45309;
    }

    .f-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 14px;
    }

    .chips-v {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .chip-v {
        border: 1px solid var(--line);
        background: #fff;
        border-radius: 999px;
        padding: 7px 14px;
        font-size: .82rem;
        font-weight: 600;
        color: var(--ink);
        cursor: pointer;
        transition: border-color .15s, background .15s;
        font-family: inherit;
    }

    .chip-v:hover {
        border-color: var(--primary-dark);
    }

    /* Selectable option cards (radio / checkbox) */
    .choice {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        border: 1.5px solid var(--line);
        border-radius: 16px;
        cursor: pointer;
        transition: border-color .15s, background .15s, box-shadow .15s;
        background: #fff;
        margin-bottom: 10px;
    }

    .choice:hover {
        border-color: rgba(0, 31, 63, .25);
    }

    .choice:has(input:checked) {
        border-color: var(--primary-dark);
        background: #FBFAF7;
        box-shadow: 0 0 0 3px rgba(0, 31, 63, .06);
    }

    .choice input {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-dark);
        flex-shrink: 0;
    }

    .choice .ic {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .choice b {
        display: block;
        font-size: .93rem;
        color: var(--ink);
        font-weight: 600;
    }

    .choice small {
        color: var(--text-secondary);
        font-size: .8rem;
    }

    .check-v {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: .9rem;
        color: #374151;
        cursor: pointer;
    }

    .check-v input {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-dark);
    }

    /* ---------- Buttons ---------- */
    .btn-v {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 22px;
        border-radius: 999px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: .92rem;
        line-height: 1.2;
        text-decoration: none;
        border: 1.5px solid transparent;
        cursor: pointer;
        transition: transform .15s, box-shadow .2s, background .2s, color .2s, border-color .2s;
        white-space: nowrap;
    }

    .btn-v:hover {
        transform: translateY(-1px);
    }

    .btn-v:active {
        transform: scale(.98);
    }

    .btn-v:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none;
    }

    .btn-v.dark {
        background: var(--primary-dark);
        color: #fff;
    }

    .btn-v.dark:hover {
        color: #fff;
        background: #00152b;
        box-shadow: 0 12px 24px -12px rgba(0, 31, 63, .6);
    }

    .btn-v.orange {
        background: var(--brand-orange);
        color: #fff;
    }

    .btn-v.orange:hover {
        color: #fff;
        background: var(--brand-orange-2);
        box-shadow: 0 12px 24px -12px rgba(251, 145, 41, .7);
    }

    .btn-v.ghost {
        background: var(--surface);
        border-color: var(--line);
        color: var(--ink);
    }

    .btn-v.ghost:hover {
        color: var(--ink);
        border-color: rgba(11, 22, 37, .2);
    }

    .btn-v.light {
        background: #F2F1EC;
        color: var(--ink);
    }

    .btn-v.light:hover {
        color: var(--ink);
        background: #E9E7E0;
    }

    .btn-v.danger {
        background: #FEF2F2;
        color: #B91C1C;
    }

    .btn-v.danger:hover {
        color: #fff;
        background: #DC2626;
    }

    .btn-v.success {
        background: #E7F7EE;
        color: #1F7A47;
    }

    .btn-v.success:hover {
        color: #fff;
        background: #1F9D57;
    }

    .btn-v.sm {
        padding: 8px 14px;
        font-size: .82rem;
    }

    .btn-v.xs {
        padding: 6px 11px;
        font-size: .76rem;
        gap: 6px;
    }

    .btn-v.block {
        width: 100%;
        padding: 15px 22px;
        font-size: .98rem;
    }

    .btn-v.icon {
        width: 36px;
        height: 36px;
        padding: 0;
        border-radius: 12px;
    }

    /* ---------- Badges ---------- */
    .badge-v {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 700;
        white-space: nowrap;
        line-height: 1.4;
    }

    .badge-v::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .badge-v.ok { background: #E7F7EE; color: #1F7A47; }
    .badge-v.pend { background: #FFF6E0; color: #B45309; }
    .badge-v.fail { background: #FEECEC; color: #B91C1C; }
    .badge-v.info { background: #EAF2FF; color: #1D4ED8; }
    .badge-v.neutral { background: #F1F1EE; color: #4B5563; }

    /* ---------- Tables (become cards on mobile) ---------- */
    .tbl-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .tbl {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: .9rem;
    }

    .tbl thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--text-light);
        font-weight: 700;
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        background: #FBFAF7;
        white-space: nowrap;
        text-align: left;
    }

    .tbl tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
        color: var(--text-main);
    }

    .tbl tbody tr:last-child td {
        border-bottom: 0;
    }

    .tbl tbody tr {
        transition: background .15s;
    }

    .tbl tbody tr:hover {
        background: #FCFBF8;
    }

    .tbl .num {
        font-variant-numeric: tabular-nums;
        font-weight: 600;
        white-space: nowrap;
    }

    .tbl .muted {
        color: var(--text-secondary);
        font-size: .8rem;
    }

    .tbl .end {
        text-align: right;
    }

    .cell-main {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .cell-main .ic {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        font-size: .88rem;
    }

    .cell-main b {
        display: block;
        font-weight: 600;
        font-size: .9rem;
    }

    .cell-main small {
        color: var(--text-secondary);
        font-size: .78rem;
        display: block;
        word-break: break-word;
    }

    .row-actions {
        display: flex;
        gap: 6px;
        justify-content: flex-end;
        flex-wrap: wrap;
    }

    @media (max-width: 767px) {
        .tbl.stack thead {
            display: none;
        }

        .tbl.stack,
        .tbl.stack tbody,
        .tbl.stack tr,
        .tbl.stack td {
            display: block;
            width: 100%;
        }

        .tbl.stack tbody tr {
            padding: 14px 16px;
            border-bottom: 1px solid var(--line);
        }

        .tbl.stack tbody tr:last-child {
            border-bottom: 0;
        }

        .tbl.stack tbody td {
            border: 0;
            padding: 5px 0;
            display: grid;
            grid-template-columns: auto minmax(0, 1fr);
            column-gap: 12px;
            align-items: center;
            text-align: right;
        }

        .tbl.stack tbody td>* {
            grid-column: 2;
            justify-self: end;
        }

        .tbl.stack tbody td[data-label]::before {
            content: attr(data-label);
            grid-column: 1;
            grid-row: 1 / span 4;
            align-self: start;
            padding-top: 2px;
            font-size: .74rem;
            color: var(--text-secondary);
            font-weight: 600;
            text-align: left;
        }

        .tbl.stack tbody td.lead {
            display: block;
            text-align: left;
            padding-bottom: 8px;
        }

        .tbl.stack tbody td.lead::before {
            display: none;
        }

        .tbl.stack tbody td.lead>* {
            justify-self: stretch;
        }

        .tbl.stack .row-actions {
            justify-content: flex-end;
        }
    }

    /* ---------- Lists ---------- */
    .list-v {
        display: flex;
        flex-direction: column;
    }

    .list-v .item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid var(--line);
        min-width: 0;
    }

    .list-v .item:last-child {
        border-bottom: 0;
    }

    .kv {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px dashed var(--line);
        font-size: .92rem;
    }

    .kv:last-child {
        border-bottom: 0;
    }

    .kv span:first-child {
        color: var(--text-secondary);
    }

    .kv span:last-child {
        font-weight: 600;
        text-align: right;
        word-break: break-word;
    }

    /* ---------- Segmented tabs ---------- */
    .seg {
        display: inline-flex;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 999px;
        padding: 5px;
        gap: 4px;
        flex-wrap: wrap;
    }

    .seg a,
    .seg button {
        border: 0;
        background: transparent;
        padding: 8px 16px;
        border-radius: 999px;
        font-weight: 600;
        font-size: .86rem;
        color: var(--text-secondary);
        text-decoration: none;
        cursor: pointer;
        font-family: inherit;
    }

    .seg .active {
        background: var(--primary-dark);
        color: #fff;
    }

    /* ---------- Search / toolbar ---------- */
    .toolbar-v {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-v {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .search-v i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: .85rem;
    }

    #app .search-v input,
    .search-v input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border-radius: 999px;
        border: 1px solid var(--line);
        background: #fff;
        font-family: inherit;
        font-size: .9rem;
        outline: none;
    }

    .search-v input:focus {
        border-color: var(--primary-dark);
    }

    /* ---------- Notes / alerts ---------- */
    .note-v {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 14px 16px;
        border-radius: 16px;
        font-size: .88rem;
        line-height: 1.55;
        background: #F6F7F9;
        color: #374151;
    }

    .note-v>i {
        margin-top: 3px;
    }

    .note-v.warn {
        background: #FFF8EE;
        color: #7C4A0E;
    }

    .note-v.ok {
        background: #EEF9F2;
        color: #1F6B41;
    }

    .note-v.err {
        background: #FEF2F2;
        color: #991B1B;
    }

    .note-v.info {
        background: #EEF4FF;
        color: #1E3A8A;
    }

    /* ---------- Empty state ---------- */
    .empty-v {
        text-align: center;
        padding: 44px 16px;
        color: var(--text-secondary);
    }

    .empty-v .ic {
        width: 60px;
        height: 60px;
        border-radius: 20px;
        background: #F4F4F1;
        display: grid;
        place-items: center;
        margin: 0 auto 14px;
        font-size: 1.3rem;
        color: var(--text-light);
    }

    .empty-v b {
        display: block;
        color: var(--ink);
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .empty-v .btn-v {
        margin-top: 16px;
    }

    /* ---------- Copy row ---------- */
    .copy-v {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #FAFAF8;
        border: 1px dashed rgba(11, 22, 37, .15);
        border-radius: 14px;
        padding: 6px 6px 6px 14px;
    }

    .copy-v span {
        flex: 1;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: .88rem;
    }

    /* ---------- Pagination (Laravel / Bootstrap) ---------- */
    .pg .pagination {
        gap: 6px;
        flex-wrap: wrap;
        justify-content: center;
        margin: 18px 0 0;
    }

    .pg .pagination .page-link {
        border: 1px solid var(--line);
        border-radius: 10px !important;
        color: var(--ink);
        min-width: 38px;
        text-align: center;
        font-weight: 600;
        font-size: .85rem;
    }

    .pg .pagination .active .page-link {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: #fff;
    }

    /* ---------- Modals ---------- */
    .modal-content {
        border-radius: 24px;
    }

    .modal-header .btn-close {
        background-size: .7rem;
    }

    /* ---------- Balance pill (page header) ---------- */
    .bal-pill-v {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 999px;
        background: var(--surface);
        border: 1px solid var(--line);
        color: var(--ink);
        font-weight: 700;
        font-size: .9rem;
        text-decoration: none;
        font-variant-numeric: tabular-nums;
    }

    .bal-pill-v span {
        color: var(--text-secondary);
        font-weight: 500;
    }

    .bal-pill-v:hover {
        color: var(--ink);
        box-shadow: var(--shadow-card);
    }

    /* ---------- Purchase components (Vue: data, airtime, cable, electricity, exam) ---------- */
    .purchase-panel {
        padding: 28px;
    }

    #app .purchase-page {
        --c-text-main: #0B1625;
        --c-text-sec: #6B7280;
        --c-border: rgba(11, 22, 37, .1);
        --c-orange: #FB9129;
        --c-orange-light: #FFF3E6;
        font-family: 'DM Sans', sans-serif;
    }

    #app .purchase-page .input-field,
    #app .purchase-page select.input-field {
        background-color: #FAFAF8;
        border: 1.5px solid rgba(11, 22, 37, .08);
        border-radius: 14px;
        padding: 14px 16px;
    }

    #app .purchase-page .input-field:focus {
        background-color: #fff;
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 4px rgba(0, 31, 63, .06);
    }

    #app .purchase-page .section-label {
        font-size: .72rem;
        letter-spacing: .1em;
        color: var(--text-light);
    }

    #app .purchase-page .tabs-container {
        margin-bottom: 26px;
    }

    #app .purchase-page .tab.active {
        background: var(--primary-dark);
    }

    #app .purchase-panel .purchase-page .summary-card {
        border: 0 !important;
        border-radius: 24px !important;
        background: linear-gradient(150deg, #04284d 0%, var(--primary-dark) 45%, #00162d 100%) !important;
        box-shadow: none !important;
        color: #fff !important;
    }

    /* Older components (cable, electricity, exam) wrap the form in their own card + title */
    #app .purchase-panel .purchase-page .main-card {
        border: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
        border-radius: 0 !important;
    }

    #app .purchase-panel .purchase-page .main-card>.card-header {
        display: none;
    }

    #app .purchase-panel .purchase-page .main-card>.card-body {
        padding: 0 !important;
    }

    #app .purchase-panel .purchase-page .sticky-summary {
        top: 0;
    }

    #app .purchase-page .total-amount {
        font-family: 'Fraunces', serif;
        font-weight: 500;
    }

    #app .purchase-page .btn-primary {
        padding: 16px !important;
        font-size: 1rem !important;
    }

    #app .purchase-page .btn-primary:hover:not(:disabled) {
        background-color: var(--brand-orange-2) !important;
        transform: translateY(-1px);
    }

    #app .purchase-page .beneficiary-pill:hover {
        border-color: var(--primary-dark);
    }

    #app .purchase-page .grid-layout {
        gap: 28px;
    }

    @media (max-width: 1280px) {
        #app .purchase-page .grid-layout {
            grid-template-columns: minmax(0, 1fr) 340px;
        }

        #app .purchase-page .summary-column {
            width: 100%;
        }
    }

    @media (max-width: 1024px) {
        #app .purchase-page .grid-layout {
            grid-template-columns: minmax(0, 1fr);
        }
    }

    @media (max-width: 600px) {
        .purchase-panel {
            padding: 18px 16px;
        }

        #app .purchase-page .summary-card {
            padding: 22px;
        }

        #app .purchase-page .tabs-container {
            width: 100%;
        }

        #app .purchase-page .tab {
            padding: 10px 8px;
            font-size: 13px;
            justify-content: center;
            gap: 4px;
        }

        #app .purchase-page .tab .coming-soon {
            margin-left: 2px;
            padding: 2px 6px;
            font-size: 8px;
            letter-spacing: .02em;
        }

        .pg-head .bal-pill-v {
            display: none;
        }
    }

    #app .purchase-page .section-group {
        margin-bottom: 24px;
    }

    /* Older components: summary card internals */
    #app .purchase-panel .summary-card>.card-body {
        padding: 26px !important;
    }

    #app .purchase-panel .summary-card>.card-body>h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500 !important;
        font-size: 1.2rem !important;
        margin-bottom: 20px !important;
    }

    #app .purchase-panel .summary-card .summary-item {
        margin-bottom: 14px !important;
        font-size: .9rem;
        gap: 12px;
    }

    #app .purchase-panel .summary-card .total-section {
        margin-top: 18px !important;
        padding: 18px !important;
        border-radius: 16px;
        background: rgba(251, 145, 41, .12);
    }

    #app .purchase-panel .summary-card .total-section span {
        color: var(--brand-orange) !important;
        font-weight: 700;
        font-size: .88rem;
    }

    #app .purchase-panel .summary-card .total-section h1 {
        font-family: 'Fraunces', serif;
        font-weight: 500 !important;
        font-size: 1.9rem !important;
        color: var(--brand-orange) !important;
    }

    #app .purchase-panel .main-card .card-body>div,
    #app .purchase-panel .main-card .card-body>.mb-10 {
        margin-bottom: 22px;
    }

    #app .purchase-panel .main-card .mt-12 {
        margin-top: 26px;
    }

    #app .purchase-panel .main-card .btn-primary,
    #app .purchase-panel .main-card .btn-success {
        width: 100%;
        padding: 15px 22px !important;
        border-radius: 999px !important;
        background: var(--primary-dark) !important;
        color: #fff !important;
        text-transform: none !important;
        font-size: 1rem !important;
        letter-spacing: 0;
    }

    #app .purchase-panel .main-card .btn-success {
        background: var(--brand-orange) !important;
    }

    #app .purchase-panel .main-card .btn-primary:disabled,
    #app .purchase-panel .main-card .btn-success:disabled {
        opacity: .45;
    }

    /* Quick-tip card in older components */
    #app .purchase-panel .sticky-summary>.card:not(.summary-card) {
        margin-top: 14px;
        border: 0 !important;
        box-shadow: none !important;
        background: #F2F7FF !important;
        border-radius: 18px !important;
    }

    #app .purchase-panel .sticky-summary>.card:not(.summary-card) .card-body {
        padding: 18px 20px !important;
    }

    #app .purchase-panel .sticky-summary>.card:not(.summary-card) h5 {
        font-size: .92rem;
        font-weight: 700;
        color: #1D4ED8;
    }

    #app .purchase-panel .sticky-summary>.card:not(.summary-card) p {
        font-size: .85rem;
        color: #374151;
        margin: 8px 0 0;
    }

    /* Legacy Metronic utility classes still used inside older components / pages */
    .font-weight-bold { font-weight: 600 !important; }
    .font-weight-bolder { font-weight: 700 !important; }
    .text-dark-75 { color: #2B3445 !important; }
    .text-dark-50 { color: #6B7280 !important; }
    .font-size-sm { font-size: .85rem; }
    .font-size-lg { font-size: 1.05rem; }
    .mr-2 { margin-right: .5rem; }
    .mr-3 { margin-right: .75rem; }

    /* ---------- Responsive ---------- */
    @media (max-width: 991px) {

        .grid-v.cols-2,
        .grid-v.cols-3,
        .grid-v.main-side,
        .grid-v.side-main {
            grid-template-columns: minmax(0, 1fr);
        }

        .pg {
            padding: 4px 0 24px;
        }
    }

    @media (max-width: 600px) {
        .panel {
            padding: 20px 18px;
            border-radius: 22px;
        }

        .panel-flush {
            padding: 0;
        }

        .panel-flush .panel-head {
            padding: 18px 18px 0;
        }

        .pg-head {
            margin-bottom: 20px;
        }

        .f-row {
            grid-template-columns: minmax(0, 1fr);
        }

        .stats-v {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .stat-v {
            padding: 14px;
        }

        .stats-v .stat-v:last-child:nth-child(odd) {
            grid-column: 1 / -1;
        }

        .stat-v .v {
            font-size: clamp(1rem, 4.6vw, 1.25rem);
        }

        .pg-actions {
            width: 100%;
        }

        .pg-actions .btn-v {
            flex: 1;
        }
    }
</style>
