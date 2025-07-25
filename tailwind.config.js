/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

export default {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './src/**/*.{js,ts,jsx,tsx}',
    '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './node_modules/flowbite/**/*.js' // penting untuk plugin Flowbite
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: [

          'Inter',
          ...defaultTheme.fontFamily.sans,
        ],
        body: [
          'Inter',
          ...defaultTheme.fontFamily.sans,
        ],
      },
      transitionProperty: {
        'width': 'width'
      },
       textDecoration: ['active'],
      colors: {
        primary: {
          50:  '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
          950: '#172554',
        },
      },
    },
  },
  plugins: [
    require('flowbite/plugin')({
        charts: true
    }),
    require('flowbite-typography'),

  ],
  safelist: [
    'bg-red-100',
    'bg-blue-100',
    'bg-green-100',
    'bg-purple-100',
    'bg-orange-100',
    'bg-zinc-100',
    'bg-emerald-100',
    'bg-pink-100',
    'bg-amber-100',
    'bg-teal-100',
    'bg-stone-100',
    'bg-cyan-100',
    'bg-sky-100',
    'bg-indigo-100',
    'bg-violet-100',
    'bg-rose-100',
    'bg-lime-100',
    'w-64',
    'w-1/2',
    'rounded-l-lg',
    'rounded-r-lg',
    'bg-gray-200',
    'grid-cols-4',
    'grid-cols-7',
    'h-6',
    'leading-6',
    'h-9',
    'leading-9',
    'shadow-lg',
    'bg-opacity-50',
    'dark:bg-opacity-80'
  ],
}
