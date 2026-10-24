import './bootstrap'
import Alpine from 'alpinejs'
import Chart from 'chart.js/auto'

window.Alpine = Alpine
window.Chart = Chart

Alpine.start()

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    if (!toggle || !password) return;

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
});