/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
        "/node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {
            backgroundImage: {
                'benefit-img': "url('https://caviar.com.kz/assets/images/benefit_bg.svg')",
                'benefit-m-img': "url('https://caviar.com.kz/assets/images/benefit-m.svg')",
                'footer-img': "url('https://caviar.com.kz/assets/images/footer-bg.jpg')",
                'footer-m-img': "url('https://caviar.com.kz/assets/images/footer-m-bg.svg')",
                'advantages': "url('https://caviar.com.kz/assets/images/footer_2_bg.png')"
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('preline/plugin'),
    ],
};
