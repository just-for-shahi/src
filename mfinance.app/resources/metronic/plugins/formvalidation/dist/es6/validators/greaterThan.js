import format from '../utils/format';
export default function greaterThan() {
    return {
        validate(input) {
            if (input.value === '') {
                return { valid: true };
            }
            const opts = Object.assign({}, { inclusive: true, message: '' }, input.options);
            const minValue = parseFloat(`${opts.min}`.replace(',', '.'));
            return opts.inclusive
                ? {
                    message: format(input.l10n ? opts.message || input.l10n.greaterThan.default : opts.message, `${minValue}`),
                    valid: parseFloat(input.value) >= minValue,
                }
                : {
                    message: format(input.l10n ? opts.message || input.l10n.greaterThan.notInclusive : opts.message, `${minValue}`),
                    valid: parseFloat(input.value) > minValue,
                };
        },
    };
}
