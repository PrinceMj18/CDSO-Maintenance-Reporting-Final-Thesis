<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}?v=2">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-white">
    <div class="flex min-h-screen flex-col md:flex-row">
        <section class="relative flex min-h-[170px] w-full items-center justify-center bg-[#607844] px-5 py-6 text-white md:min-h-screen md:w-[40%] md:items-start md:justify-start md:px-0 md:py-0">
            <div class="md:absolute md:left-[52px] md:top-[49px]">
                <img src="{{ asset('img/logo.png') }}" alt="City College of Angeles" class="mx-auto h-auto w-[118px] object-contain md:mx-0 md:w-[148px]">
            </div>
            <div class="absolute bottom-[244px] left-[50px] hidden md:block">
                <h1 class="text-[30px] font-semibold leading-[36px] tracking-[-0.5px]">City College of Angeles</h1>
                <div class="mt-[9px] h-[2px] w-[min(350px,calc(40vw-70px))] bg-white"></div>
                <p class="mt-[8px] text-[17px] font-normal leading-[22px]">Totalis Humanae</p>
            </div>
        </section>

        <section class="relative flex min-w-0 flex-1 justify-center bg-white">
            <div class="relative mx-auto w-full max-w-[525px] px-6 py-8 sm:px-8 md:absolute md:left-1/2 md:top-[91px] md:-translate-x-1/2 md:px-0 md:py-0">
                <h2 class="text-center text-[30px] font-normal leading-[36px] text-[#526783]">Log in</h2>




                <form action="{{ url('/login') }}" method="POST" class="mt-8 md:mt-[68px]">
                    @csrf
                    @if ($errors->any())
    <div role="alert"
         class="mb-4 rounded-lg border border-red-300 bg-red-100
                px-4 py-3 text-sm text-red-800">
        {{ $errors->first() }}
    </div>
@endif

                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-gray-800">Email</label>
                        <input id="email" type="email" name="email" required autocomplete="email" value="{{ old('email') }}"
                            class="block h-[52px] w-full rounded-md border border-[#dbe3ef] bg-[#e8f0fe] px-4 text-base text-[#1f2937] outline-none focus:border-[#607844] focus:ring-2 focus:ring-[#607844]/30 md:h-[59px]">
                    </div>

                    <div class="mt-5">
                        <label for="password" class="mb-1 block text-sm font-medium text-gray-800">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="block h-[52px] w-full rounded-md border border-[#dbe3ef] bg-[#e8f0fe] px-4 pr-12 text-base text-[#1f2937] outline-none focus:border-[#607844] focus:ring-2 focus:ring-[#607844]/30 md:h-[59px]">
                            <button type="button" onclick="togglePassword()" id="passwordToggle"
                                class="absolute inset-y-0 right-0 inline-flex w-11 items-center justify-center text-[#607844] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#607844]"
                                aria-label="Show password" aria-controls="password" aria-pressed="false">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center">
                        <input id="remember" type="checkbox" name="remember" value="1" class="h-5 w-5 rounded border-gray-300 text-[#607844] focus:ring-[#607844]">
                        <label for="remember" class="ml-3 text-sm text-[#607844]">Remember me</label>
                    </div>


<div class="mt-8 flex justify-start md:mt-[58px]">
    <button type="submit"
        class="inline-flex h-[50px] w-full items-center justify-center rounded-lg bg-[#607844] px-5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#526a3c] focus:outline-none focus:ring-2 focus:ring-[#607844] focus:ring-offset-2 sm:w-[121px] md:h-[59px]">
        Log in
    </button>
</div>


                    <footer class="mt-10 flex flex-wrap items-center justify-center gap-x-2 gap-y-2 border-t border-gray-100 pt-5 text-center sm:mt-[46px] sm:flex-nowrap sm:whitespace-nowrap sm:border-t-0 sm:pt-0">
                        <span class="text-xs text-[#969696]">v1.75.86.88</span>
                        <span class="hidden text-[#607844] sm:inline">|</span>
                        <span class="text-xs text-[#607844]">[20260929]</span>
                        <span class="mx-1 hidden h-7 w-px bg-[#e5e5e5] sm:inline-block"></span>
                        <span class="text-sm font-semibold text-[#607844]">Powered by</span>
                        <span class="relative inline-block h-6 w-5 shrink-0" aria-hidden="true">
                            <span class="absolute left-[6px] top-0 h-[8px] w-[8px] rounded-full bg-[#f58220]"></span>
                            <span class="absolute left-[7px] top-[6px] h-[16px] w-[6px] rotate-[35deg] rounded-full bg-[#f58220]"></span>
                            <span class="absolute left-[7px] top-[6px] h-[16px] w-[6px] -rotate-[35deg] rounded-full bg-[#f58220]"></span>
                        </span>
                        <span class="text-left text-[11px] font-semibold leading-3 text-[#27304b]">Hurey<br>Campus</span>
                    </footer>
                </form>
            </div>
        </section>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const toggle = document.getElementById('passwordToggle');
            if (!password || !eyeIcon || !toggle) return;

            const isShowing = password.type === 'password';
            password.type = isShowing ? 'text' : 'password';
            toggle.setAttribute('aria-pressed', String(isShowing));
            toggle.setAttribute('aria-label', isShowing ? 'Hide password' : 'Show password');
            eyeIcon.innerHTML = isShowing
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.5 12s3.75 6.75 10.5 6.75c1.82 0 3.4-.45 4.73-1.14M6.23 6.23A10.45 10.45 0 0 1 12 5.25c6.75 0 10.5 6.75 10.5 6.75a18.17 18.17 0 0 1-3.09 3.89M6.23 6.23 3 3m3.23 3.23 3.18 3.18m0 0a3 3 0 0 0 4.24 4.24m-4.24-4.24L3 3m9.75 9.75L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>`;
        }
    </script>
</body>
</html>
