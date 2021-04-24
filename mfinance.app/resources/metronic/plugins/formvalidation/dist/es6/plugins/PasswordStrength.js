import Plugin from '../core/Plugin';
export default class PasswordStrength extends Plugin {
    constructor(opts) {
        super(opts);
        this.opts = Object.assign({}, {
            minimalScore: 3,
            onValidated: () => { },
        }, opts);
        this.validatePassword = this.checkPasswordStrength.bind(this);
        this.validatorValidatedHandler = this.onValidatorValidated.bind(this);
    }
    install() {
        this.core.registerValidator(PasswordStrength.PASSWORD_STRENGTH_VALIDATOR, this.validatePassword);
        this.core.on('core.validator.validated', this.validatorValidatedHandler);
        this.core.addField(this.opts.field, {
            validators: {
                [PasswordStrength.PASSWORD_STRENGTH_VALIDATOR]: {
                    message: this.opts.message,
                    minimalScore: this.opts.minimalScore,
                },
            },
        });
    }
    uninstall() {
        this.core.off('core.validator.validated', this.validatorValidatedHandler);
        this.core.disableValidator(this.opts.field, PasswordStrength.PASSWORD_STRENGTH_VALIDATOR);
    }
    checkPasswordStrength() {
        return {
            validate: (input) => {
                const value = input.value;
                if (value === '') {
                    return {
                        valid: true,
                    };
                }
                const result = zxcvbn(value);
                const score = result.score;
                const message = result.feedback.warning || 'The password is weak';
                if (score < this.opts.minimalScore) {
                    return {
                        message,
                        meta: {
                            message,
                            score,
                        },
                        valid: false,
                    };
                }
                else {
                    return {
                        meta: {
                            message,
                            score,
                        },
                        valid: true,
                    };
                }
            },
        };
    }
    onValidatorValidated(e) {
        if (e.field === this.opts.field && e.validator === PasswordStrength.PASSWORD_STRENGTH_VALIDATOR
            && e.result.meta) {
            const message = e.result.meta['message'];
            const score = e.result.meta['score'];
            this.opts.onValidated(e.result.valid, message, score);
        }
    }
}
PasswordStrength.PASSWORD_STRENGTH_VALIDATOR = '___PasswordStrengthValidator';
