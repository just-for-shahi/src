import format from '../utils/format';
export default function lessThan() {
    return {
        validate(input) {
            if (input.value === '') {
                return { valid: true };
            }
            const opts = Object.assign({}, { inclusive: true, message: '' }, input.options);
            const maxValue = parseFloat(`${opts.max}`.replace(',', '.'));
            return opts.inclusive
                ? {
                    message: format(input.l10n ? opts.message || input.l10n.lessThan.default : opts.message, `${maxValue}`),
                    valid: parseFloat(input.value) <= maxValue,
                }
                : {
                    message: format(input.l10n ? opts.message || input.l10n.lessThan.notInclusive : opts.message, `${maxValue}`),
                    valid: parseFloat(input.value) < maxValue,
                };
        },
    };
}
