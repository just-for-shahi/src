import format from '../utils/format';
export default function stringLength() {
    const utf8Length = (str) => {
        let s = str.length;
        for (let i = str.length - 1; i >= 0; i--) {
            const code = str.charCodeAt(i);
            if (code > 0x7f && code <= 0x7ff) {
                s++;
            }
            else if (code > 0x7ff && code <= 0xffff) {
                s += 2;
            }
            if (code >= 0xDC00 && code <= 0xDFFF) {
                i--;
            }
        }
        return `${s}`;
    };
    return {
        validate(input) {
            const opts = Object.assign({}, {
                message: '',
                trim: false,
                utf8Bytes: false,
            }, input.options);
            const v = (opts.trim === true || `${opts.trim}` === 'true') ? input.value.trim() : input.value;
            if (v === '') {
                return { valid: true };
            }
            const min = opts.min ? `${opts.min}` : '';
            const max = opts.max ? `${opts.max}` : '';
            const length = opts.utf8Bytes ? utf8Length(v) : v.length;
            let isValid = true;
            let msg = input.l10n ? (opts.message || input.l10n.stringLength.default) : opts.message;
            if ((min && length < parseInt(min, 10)) || (max && length > parseInt(max, 10))) {
                isValid = false;
            }
            switch (true) {
                case (!!min && !!max):
                    msg = format(input.l10n ? opts.message || input.l10n.stringLength.between : opts.message, [min, max]);
                    break;
                case (!!min):
                    msg = format(input.l10n ? opts.message || input.l10n.stringLength.more : opts.message, `${(parseInt(min, 10) - 1)}`);
                    break;
                case (!!max):
                    msg = format(input.l10n ? opts.message || input.l10n.stringLength.less : opts.message, `${(parseInt(max, 10) + 1)}`);
                    break;
                default:
                    break;
            }
            return {
                message: msg,
                valid: isValid,
            };
        },
    };
}
