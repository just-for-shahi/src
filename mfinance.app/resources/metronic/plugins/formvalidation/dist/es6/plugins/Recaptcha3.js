import Plugin from '../core/Plugin';
import fetch from '../utils/fetch';
export default class Recaptcha3 extends Plugin {
    constructor(opts) {
        super(opts);
        this.opts = Object.assign({}, { minimumScore: 0 }, opts);
        this.iconPlacedHandler = this.onIconPlaced.bind(this);
    }
    install() {
        this.core.on('plugins.icon.placed', this.iconPlacedHandler);
        const loadPrevCaptcha = (typeof window[Recaptcha3.LOADED_CALLBACK] === 'undefined')
            ? () => { }
            : window[Recaptcha3.LOADED_CALLBACK];
        window[Recaptcha3.LOADED_CALLBACK] = () => {
            loadPrevCaptcha();
            const tokenField = document.createElement('input');
            tokenField.setAttribute('type', 'hidden');
            tokenField.setAttribute('name', Recaptcha3.CAPTCHA_FIELD);
            document.getElementById(this.opts.element).appendChild(tokenField);
            this.core.addField(Recaptcha3.CAPTCHA_FIELD, {
                validators: {
                    promise: {
                        message: this.opts.message,
                        promise: (input) => {
                            return new Promise((resolve, reject) => {
                                window['grecaptcha']
                                    .execute(this.opts.siteKey, { action: this.opts.action })
                                    .then((token) => {
                                    fetch(this.opts.backendVerificationUrl, {
                                        method: 'POST',
                                        params: {
                                            [Recaptcha3.CAPTCHA_FIELD]: token,
                                        },
                                    }).then((response) => {
                                        const isValid = `${response.success}` === 'true' &&
                                            response.score >= this.opts.minimumScore;
                                        resolve({
                                            message: response.message || this.opts.message,
                                            meta: response,
                                            valid: isValid,
                                        });
                                    }).catch((_) => {
                                        reject({
                                            valid: false,
                                        });
                                    });
                                });
                            });
                        },
                    },
                },
            });
        };
        const src = this.getScript();
        if (!document.body.querySelector(`script[src="${src}"]`)) {
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.async = true;
            script.defer = true;
            script.src = src;
            document.body.appendChild(script);
        }
    }
    uninstall() {
        this.core.off('plugins.icon.placed', this.iconPlacedHandler);
        const src = this.getScript();
        const scripts = [].slice.call(document.body.querySelectorAll(`script[src="${src}"]`));
        scripts.forEach((s) => s.parentNode.removeChild(s));
        this.core.removeField(Recaptcha3.CAPTCHA_FIELD);
    }
    getScript() {
        const lang = this.opts.language ? `&hl=${this.opts.language}` : '';
        return 'https://www.google.com/recaptcha/api.js?' +
            `onload=${Recaptcha3.LOADED_CALLBACK}&render=${this.opts.siteKey}${lang}`;
    }
    onIconPlaced(e) {
        if (e.field === Recaptcha3.CAPTCHA_FIELD) {
            e.iconElement.style.display = 'none';
        }
    }
}
Recaptcha3.CAPTCHA_FIELD = '___g-recaptcha-token___';
Recaptcha3.LOADED_CALLBACK = '___reCaptcha3Loaded___';
