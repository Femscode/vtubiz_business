@section('header')
<style>
    .verify-form {
        display: flex;
        gap: 10px;
    }

    .verify-form .f-input {
        flex: 1;
    }

    .result-head {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-bottom: 18px;
        margin-bottom: 6px;
        border-bottom: 1px solid var(--line);
    }

    .result-head .ic {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .result-head b {
        display: block;
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.25rem;
    }

    .result-head small {
        color: var(--text-secondary);
        font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
        font-size: .78rem;
        word-break: break-all;
    }

    @media (max-width: 600px) {
        .verify-form {
            flex-direction: column;
        }
    }

    @media print {
        .sidebar, .top-navbar, .tabbar, #fixedbutton, .pg-head, .verify-search, .no-print {
            display: none !important;
        }
    }
</style>
@endsection
