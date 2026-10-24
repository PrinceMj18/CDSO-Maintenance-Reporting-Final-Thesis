<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CCA Login</title>
  <script src="https://cdn.tailwindcss.com/3.4.4"></script>
  
</head>
<body class="h-screen w-screen overflow-hidden font-sans">

  <div class="flex h-full w-full">
    
    <!-- Left Panel -->
    <div class="w-[30%] bg-[#667F45] text-white flex flex-col justify-between px-12 py-14">
      
      <!-- Logo -->
      <div>
        <img 
          src="/img/cca_logo.png" 
          alt="CCA Logo"
          class="w-28 object-contain"
        >
      </div>

      <!-- School Name -->
      <div>
        <h1 class="text-3xl font-semibold underline underline-offset-4">
          City College of Angeles
        </h1>
        <p class="mt-2 text-lg opacity-90">Totalis Humanae</p>
      </div>

    </div>

    <!-- Right Panel -->
    <div class="w-[70%] bg-gray-100 flex items-center justify-center">
      
      <div class="w-[420px]">
        
        <h2 class="text-2xl text-center text-gray-700 mb-10">
          Log in
        </h2>

        <!-- Email -->
        <div class="mb-4">
          <input 
            type="email" 
            placeholder="Email"
            class="w-full bg-gray-200 text-gray-700 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-[#667F45]"
          />
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
          <input 
            id="password"
            type="password"
            placeholder="Password"
            class="w-full bg-gray-200 text-gray-700 px-4 py-3 pr-10 rounded-md focus:outline-none focus:ring-2 focus:ring-[#667F45]"
          />

          <!-- Eye Icon -->
          <svg id="togglePassword"
               xmlns="http://www.w3.org/2000/svg"
               class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 cursor-pointer"
               fill="none"
               viewBox="0 0 24 24"
               stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                     c4.478 0 8.268 2.943 9.542 7
                     -1.274 4.057-5.064 7-9.542 7
                     -4.477 0-8.268-2.943-9.542-7z" />
          </svg>
        </div>

        <!-- Remember -->
        <div class="flex items-center mb-6">
          <input type="checkbox" class="mr-2 accent-[#667F45]" />
          <label class="text-gray-600 text-sm">Remember me</label>
        </div>

        <!-- Forgot -->
        <div class="text-sm text-gray-400 mb-6">
          <a href="#" class="hover:underline">Forgot password?</a>
        </div>

        <!-- Login Button -->
        <div class="flex justify-end mb-8">
          <button class="bg-[#667F45] hover:bg-[#5a713d] text-white px-8 py-3 rounded-md shadow-md">
            Log in
          </button>
        </div>

        <!-- Divider -->
        <div class="flex items-center mb-6">
          <div class="flex-1 h-px bg-gray-300"></div>
          <span class="px-4 text-gray-500 text-sm">Login with:</span>
          <div class="flex-1 h-px bg-gray-300"></div>
        </div>

        <!-- Email Activation -->
        <div class="text-center mb-10">
          <a href="#" class="text-blue-500 hover:underline text-sm">
            Email activation
          </a>
        </div>

        <!-- Footer -->
        <div class="text-center text-xs text-gray-400">
          v1.75.38.88 [20260225] | Powered by Campus
        </div>

      </div>

    </div>

  </div>

  <!-- Toggle Script -->
 <script>
  const toggle = document.getElementById("togglePassword");
  const password = document.getElementById("password");

  const eyeOpen = `
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M2.458 12C3.732 7.943 7.523 5 12 5
         c4.478 0 8.268 2.943 9.542 7
         -1.274 4.057-5.064 7-9.542 7
         -4.477 0-8.268-2.943-9.542-7z" />
  `;

  const eyeClosed = `
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M13.875 18.825A10.05 10.05 0 0112 19
         c-4.478 0-8.268-2.943-9.542-7
         a9.956 9.956 0 012.042-3.362M6.223 6.223
         A9.956 9.956 0 0112 5
         c4.478 0 8.268 2.943 9.542 7
         a9.97 9.97 0 01-4.132 5.411M3 3l18 18" />
  `;

  toggle.addEventListener("click", function () {
    const isPassword = password.type === "password";

    password.type = isPassword ? "text" : "password";
    toggle.innerHTML = isPassword ? eyeClosed : eyeOpen;
  });
</script>

</body>
</html>