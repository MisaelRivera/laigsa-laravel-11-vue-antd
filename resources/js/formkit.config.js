import { es } from '@formkit/i18n'

const config = {
  locales: { es },
  locale: 'es',
  iconLoaderUrl: (iconName) =>  `https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/svgs/solid/${iconName}.svg`,
}

export default config