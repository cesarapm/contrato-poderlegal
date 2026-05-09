/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/Filament/**/*.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                // Paleta Poder Legal - Morados
                'purple-bishop': '#4A148C',
                'purple-deep': '#1A0933',
                'primary-purple': '#663399',
                'purple-light': '#9C27B0',
                'purple-dark': '#311B92',
                
                // Paleta Poder Legal - Dorados
                'primary-gold': '#FFD700',
                'gold-accent': '#FFC107',
                'gold-warm': '#FFAA00',
                
                // Neutros
                'dark-primary': '#212121',
                'bg-light': '#FAFAFA',
                'bg-medium': '#F5F5F5',
                
                // Gradientes (usados en Filament y componentes)
                primary: {
                    50: '#f9f6ff',
                    100: '#f2ebff',
                    200: '#e4d4ff',
                    300: '#d1b3ff',
                    400: '#b380ff',
                    500: '#9C27B0',  // light-purple
                    600: '#663399',  // primary-purple
                    700: '#4A148C',  // purple-bishop (DEFAULT)
                    800: '#311B92',  // dark-purple
                    900: '#1A0933',  // purple-deep
                    950: '#0d0419',
                },
                secondary: {
                    50: '#fffef0',
                    100: '#fffbd6',
                    200: '#fff6ad',
                    300: '#ffed7a',
                    400: '#ffdc3f',
                    500: '#FFD700',  // primary-gold (DEFAULT)
                    600: '#FFC107',  // gold-accent
                    700: '#FFAA00',  // gold-warm
                    800: '#cc8800',
                    900: '#996600',
                    950: '#664400',
                },
            },
            fontFamily: {
                'display': ['Poppins', 'sans-serif'],
                'sans': ['Inter', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
            },
            fontSize: {
                'hero': '3.052rem',     // h1
                '2xl-custom': '2.441rem', // h2
                'xl-custom': '1.953rem',  // h3
                'lg-custom': '1.563rem',  // h4
                'md-custom': '1.25rem',   // h5
            },
            borderRadius: {
                'sm-custom': '8px',
                'md-custom': '16px',
                'lg-custom': '24px',
                'xl-custom': '32px',
                'hero': '40px',
            },
            boxShadow: {
                'sm-purple': '0 2px 4px rgba(74, 20, 140, 0.08)',
                'md-purple': '0 4px 12px rgba(74, 20, 140, 0.12)',
                'lg-purple': '0 8px 24px rgba(74, 20, 140, 0.16)',
                'xl-purple': '0 12px 32px rgba(74, 20, 140, 0.2)',
                'gold': '0 4px 20px rgba(255, 215, 0, 0.25)',
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                'float': 'float 3s ease-in-out infinite',
                'shimmer': 'shimmer 2s linear infinite',
            },
            keyframes: {
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
        require('@tailwindcss/typography'),
    ],
}
