const lngs = {
    en: { nativeName: 'English' },
    es: { nativeName: 'Spanish' }
};

const rerender = () => {
    // start localizing, details:
    // https://github.com/i18next/jquery-i18next#usage-of-selector-function
    $('body').localize();

    $('title').text($.t('regla1.title'));
}

$(function() {
    // use plugins and options as needed, for options, detail see
    // https://www.i18next.com
    i18next
    // detect user language
    // learn more: https://github.com/i18next/i18next-browser-languageDetector
        .use(i18nextBrowserLanguageDetector)
        // init i18next
        // for all options read: https://www.i18next.com/overview/configuration-options
        .init({
            debug: true,
            fallbackLng: 'es',
            resources: {
                en: {
                    translation: {
                        regla1: {
                            title: 'Rule 1 - The play field',
                        }
                    }
                },
                es: {
                    translation: {
                        regla1: {
                            title: 'Regla 1 - El terreno de juego',
                        }
                    }
                }
            }
        }, (err, t) => {
            if (err) return console.error(err);

            // for options see
            // https://github.com/i18next/jquery-i18next#initialize-the-plugin
            jqueryI18next.init(i18next, $, { useOptionsAttr: true });

            // fill language switcher
            Object.keys(lngs).map((lng) => {
                const opt = new Option(lngs[lng].nativeName, lng);
                if (lng === i18next.resolvedLanguage) {
                    opt.setAttribute("selected", "selected");
                }
                $('#languageSwitcher').append(opt);
            });
            $('#languageSwitcher').change((a, b, c) => {
                const chosenLng = $(this).find("option:selected").attr('value');
                i18next.changeLanguage(chosenLng, () => {
                    rerender();
                });
            });

            rerender();
        });
});