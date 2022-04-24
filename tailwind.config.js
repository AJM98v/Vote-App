const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'gray-background': '#f7f8fc',
                'blue': "#328af1",
                'blue-hover': "#2879bd",
                'yellow': "#ffc73c",
                'red': "#ec454f",
                'green': "#1aab8b",
                "purple": "#8b60ed"
            },
            fontSize: {
                xxs: "0.65rem"
            },
            boxShadow : {
               'card' : "4px 4px 15px 0 rgba(36 , 37 ,38 , 0.08)"
            }

        },
    },

    plugins: [require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
