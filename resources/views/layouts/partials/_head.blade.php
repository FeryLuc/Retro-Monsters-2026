<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="images/favico.png" />

    <link
        href="https://fonts.googleapis.com/css2?family=Creepster&family=Roboto:wght@100;400;900&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css"
    />
    <script src="//unpkg.com/alpinejs" defer></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
    <style>
        .monster-card[data-monster-type="cosmique"] {
        background: linear-gradient(to right, #6e48aa, #9d50bb);
        }

        .monster-card[data-monster-type="aquatique"] {
        background: linear-gradient(to right, #395ca6, #546da4);
        }

        .monster-card[data-monster-type="terrestre"] {
        background: linear-gradient(to right, #3a4146, #657581);
        }

        .monster-card[data-monster-type="volant"] {
        background: linear-gradient(to right, #2e5063, #457791);
        }

        .monster-card[data-monster-type="spectral"] {
        background: linear-gradient(to right, #7b195a, #9d3078);
        }
        body {
        font-family: "Roboto", sans-serif;
        }
        .creepster {
        font-family: "Creepster", system-ui;
        font-size: 2rem;
        letter-spacing: 0.2rem;
        }

        .noUi-connect {
        background: #516ba4;
        }
    </style>
</head>
