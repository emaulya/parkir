<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ParkirKu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Ganti warna tema cukup lewat variabel di bawah ini */
        :root {
            --bg: #E9DCC0;          /* kertas tiket */
            --bg-deep: #D9C79F;
            --ink: #2B1D14;         /* cokelat espresso */
            --ink-soft: #6B5442;
            --plate: #1F3A34;       /* hijau tua papan parkir */
            --plate-edge: #F3E9D2;
            --accent: #B8741A;      /* kuning tembaga */
            --accent-dark: #8F5710;
            --danger: #9B2C1F;
            --field: #F7F0DF;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body {
            font-family: "IBM Plex Sans", system-ui, -apple-system, "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                repeating-linear-gradient(90deg, transparent 0 46px, rgba(43,29,20,.045) 46px 47px),
                var(--bg);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .wrap {
            width: 100%;
            max-width: 880px;
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            background: var(--field);
            border: 2px solid var(--ink);
            border-radius: 6px;
            box-shadow: 10px 10px 0 var(--ink);
            overflow: hidden;
        }

        /* Sisi kiri: papan "P" */
        .sign {
            background: var(--bg-deep);
            padding: 40px 32px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 28px;
            position: relative;
        }
        .plate {
            width: 168px;
            height: 168px;
            border-radius: 28px;
            background: var(--plate);
            border: 6px solid var(--plate-edge);
            outline: 3px solid var(--plate);
            display: grid;
            place-items: center;
            font-family: "Alfa Slab One", Georgia, serif;
            font-size: 108px;
            line-height: 1;
            color: var(--plate-edge);
            transform: rotate(-4deg);
            box-shadow: 6px 8px 0 rgba(43,29,20,.35);
        }
        .sign h1 {
            font-family: "Alfa Slab One", Georgia, serif;
            font-weight: 400;
            font-size: 30px;
            letter-spacing: .5px;
        }
        .sign p {
            font-size: 14px;
            line-height: 1.6;
            color: var(--ink-soft);
            max-width: 240px;
        }

        /* Garis sobekan tiket */
        .sign::after {
            content: "";
            position: absolute;
            top: 0; bottom: 0; right: -1px;
            width: 2px;
            background: repeating-linear-gradient(to bottom, var(--ink) 0 8px, transparent 8px 16px);
        }

        /* Sisi kanan: form */
        .form-side { padding: 48px 44px; }
        .form-side h2 {
            font-family: "Alfa Slab One", Georgia, serif;
            font-weight: 400;
            font-size: 26px;
            margin-bottom: 6px;
        }
        .form-side .sub { font-size: 14px; color: var(--ink-soft); margin-bottom: 28px; }

        .alert {
            background: #F3D9D3;
            border: 1.5px solid var(--danger);
            color: var(--danger);
            padding: 10px 14px;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .field { margin-bottom: 18px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; }
        .input-box { position: relative; }
        input[type="email"], input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            font: inherit;
            color: var(--ink);
            background: #fff;
            border: 2px solid var(--ink);
            border-radius: 4px;
            transition: box-shadow .15s, border-color .15s;
        }
        input:focus {
            outline: none;
            border-color: var(--accent-dark);
            box-shadow: 3px 3px 0 var(--accent);
        }
        input.invalid { border-color: var(--danger); }
        .toggle {
            position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            font: inherit; font-size: 13px; font-weight: 600;
            color: var(--ink-soft); padding: 6px 8px; border-radius: 4px;
        }
        .toggle:hover { color: var(--ink); }
        .toggle:focus-visible { outline: 2px solid var(--accent-dark); }
        .err { color: var(--danger); font-size: 13px; margin-top: 5px; }

        button.submit {
            width: 100%;
            margin-top: 8px;
            padding: 14px;
            font: inherit;
            font-weight: 600;
            font-size: 16px;
            color: #fff;
            background: var(--plate);
            border: 2px solid var(--ink);
            border-radius: 4px;
            box-shadow: 4px 4px 0 var(--ink);
            cursor: pointer;
            transition: transform .1s, box-shadow .1s, background .15s;
        }
        button.submit:hover { background: #2A4C44; }
        button.submit:active { transform: translate(3px, 3px); box-shadow: 1px 1px 0 var(--ink); }
        button.submit:focus-visible { outline: 3px solid var(--accent); outline-offset: 2px; }

        .foot { margin-top: 26px; font-size: 13px; color: var(--ink-soft); }

        @media (max-width: 720px) {
            .wrap { grid-template-columns: 1fr; box-shadow: 6px 6px 0 var(--ink); }
            .sign { padding: 28px 20px; flex-direction: row; gap: 20px; text-align: left; }
            .sign::after { top: auto; bottom: -1px; left: 0; right: 0; width: auto; height: 2px;
                background: repeating-linear-gradient(to right, var(--ink) 0 8px, transparent 8px 16px); }
            .plate { width: 84px; height: 84px; font-size: 54px; border-width: 4px; border-radius: 16px; flex-shrink: 0; }
            .sign h1 { font-size: 22px; }
            .sign p { display: none; }
            .form-side { padding: 32px 24px; }
        }
        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>
    <main class="wrap">
        <section class="sign" aria-hidden="true">
            <div class="plate">P</div>
            <div>
                <h1>ParkirKu</h1>
                <p>Catat kendaraan masuk dan keluar, hitung tarif, dan pantau area parkir dalam satu tempat.</p>
            </div>
        </section>

        <section class="form-side">
            <h2>Masuk ke akun</h2>
            <p class="sub">Gunakan akun admin, petugas, atau owner.</p>

            @if ($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                   <label for="username">Username</label>
                   <input type="text" id="username" name="username" value="{{ old('username') }}"
                      class="{{ $errors->has('username') ? 'invalid' : '' }}"
                      autocomplete="username" required autofocus>
                   @error('username') <p class="err">{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-box">
                        <input type="password" id="password" name="password"
                               autocomplete="current-password" required>
                        <button type="button" class="toggle" id="toggle" aria-label="Tampilkan password">Lihat</button>
                    </div>
                    @error('password') <p class="err">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="submit">Masuk</button>
            </form>

            <p class="foot">Lupa password? Hubungi admin.</p>
        </section>
    </main>

    <script>
        const pw = document.getElementById('password');
        const btn = document.getElementById('toggle');
        btn.addEventListener('click', () => {
            const show = pw.type === 'password';
            pw.type = show ? 'text' : 'password';
            btn.textContent = show ? 'Sembunyi' : 'Lihat';
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    </script>
</body>
</html>