import Plugin from '../core/Plugin';
export default class InternationalTelephoneInput extends Plugin {
    constructor(opts) {
        super(opts);
        this.intlTelInstances = new Map();
        this.countryChangeHandler = new Map();
        this.fieldElements = new Map();
        this.opts = Object.assign({}, {
            autoPlaceholder: 'polite',
            utilsScript: '',
        }, opts);
        this.validatePhoneNumber = this.checkPhoneNumber.bind(this);
        this.fields = (typeof this.opts.field === 'string') ? this.opts.field.split(',') : this.opts.field;
    }
    install() {
        this.core.registerValidator(InternationalTelephoneInput.INT_TEL_VALIDATOR, this.validatePhoneNumber);
        this.fields.forEach((field) => {
            this.core.addField(field, {
                validators: {
                    [InternationalTelephoneInput.INT_TEL_VALIDATOR]: {
                        message: this.opts.message,
                    },
                },
            });
            const ele = this.core.getElements(field)[0];
            const handler = () => this.core.revalidateField(field);
            ele.addEventListener('countrychange', handler);
            this.countryChangeHandler.set(field, handler);
            this.fieldElements.set(field, ele);
            this.intlTelInstances.set(field, intlTelInput(ele, this.opts));
        });
    }
    uninstall() {
        this.fields.forEach((field) => {
            const handler = this.countryChangeHandler.get(field);
            const ele = this.fieldElements.get(field);
            const intlTel = this.intlTelInstances.get(field);
            if (handler && ele && intlTel) {
                ele.removeEventListener('countrychange', handler);
                this.core.disableValidator(field, InternationalTelephoneInput.INT_TEL_VALIDATOR);
                intlTel.destroy();
            }
        });
    }
    checkPhoneNumber() {
        return {
            validate: (input) => {
                const value = input.value;
                const intlTel = this.intlTelInstances.get(input.field);
                if (value === '' || !intlTel) {
                    return {
                        valid: true,
                    };
                }
                return {
                    valid: intlTel.isValidNumber(),
                };
            },
        };
    }
}
InternationalTelephoneInput.INT_TEL_VALIDATOR = '___InternationalTelephoneInputValidator';
