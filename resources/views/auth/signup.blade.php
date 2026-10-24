<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full">

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="/img/cca_logo.png" alt="CCA Logo" class="mx-auto h-32 w-auto" />

            <h2 class="mt-10 text-center text-2xl leading-9 font-bold tracking-tight text-white">
                Sign up your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="/register" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="fname" class="block text-sm leading-6 font-medium text-gray-100">
                        First Name
                    </label>

                    <div class="mt-2">
                        <input id="fname" type="fname" name="fname" required autocomplete="fname" value="{{ old('fname') }}" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white 
                            outline outline-1 -outline-offset-1 outline-white/10 
                            placeholder:text-gray-500 
                            focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 
                            sm:text-sm leading-6" />
                    </div>
                </div>

                <!-- Last -->
                <div>
                    <label for="lname" class="block text-sm leading-6 font-medium text-gray-100">
                        Last Name
                    </label>

                    <div class="mt-2">
                        <input id="lname" type="lname" name="lname" required autocomplete="lname" value="{{ old('lname') }}" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white 
                            outline outline-1 -outline-offset-1 outline-white/10 
                            placeholder:text-gray-500 
                            focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 
                            sm:text-sm leading-6" />
                    </div>
                </div>

                <!-- Role -->


                <!-- <div>
                    <label for="role" class="block text-sm leading-6 font-medium text-gray-100">
                        Role
                    </label>

                    <div class="mt-2">
                        <select id="role" name="role"
                            class="block w-full rounded-md px-3 py-1.5 text-base outline outline-1 -outline-offset-1 outline-white/10 
                   focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm leading-6">

                            <option value="" disabled selected>
                                Select role
                            </option>

                            <option value="User">User</option>
                            <option value="Personnel">Personnel</option>
                        </select>
                    </div>
                </div> -->

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm leading-6 font-medium text-gray-100">
                        Email address
                    </label>

                    <div class="mt-2">
                        <input id="email" type="email" name="email" required autocomplete="email"
                            pattern="^[a-zA-Z0-9._%+-]+@cca\.edu\.ph$" title="Please use your @cca.edu.ph email address" value="{{ old('email') }}"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white 
                            outline outline-1 -outline-offset-1 outline-white/10 
                            placeholder:text-gray-500 
                            focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 
                            sm:text-sm leading-6" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm leading-6 font-medium text-gray-100">
                            Password
                        </label>
                    </div>

                    <div class="mt-2">
                        <input id="password" type="password" name="password" required autocomplete="current-password" value="{{ old('password') }}"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white 
                            outline outline-1 -outline-offset-1 outline-white/10 
                            placeholder:text-gray-500 
                            focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 
                            sm:text-sm leading-6" />
                    </div>
                </div>

                <!-- Button -->
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 
                        text-sm leading-6 font-semibold text-white 
                        hover:bg-indigo-400 
                        focus-visible:outline focus-visible:outline-2 
                        focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Sign in
                    </button>
                </div>

            </form>

            <!-- Footer -->
            <p class="mt-10 text-center text-sm leading-6 text-gray-400">
                Already have an acconunt?
                <a href="/login" class="font-semibold text-indigo-400 hover:text-indigo-300">
                    Click here
                </a>
            </p>
        </div>
    </div>

</body>

</html>
<style>
    #role {
        background-color: #1f2937 !important;
        /* Tailwind bg-gray-800 */
        color: #fff !important;
        /* text-white */
    }

    #role option {
        background-color: #1f2937 !important;
        /* dark background for options */
        color: #fff !important;
        /* white text for options */
    }
</style>