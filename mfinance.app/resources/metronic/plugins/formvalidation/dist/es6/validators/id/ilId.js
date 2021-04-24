import luhn from '../../algorithms/luhn';
export default function ilId(value) {
    if (!/^\d{1,9}$/.test(value)) {
        return {
            meta: {},
            valid: false,
        };
    }
    return {
        meta: {},
        valid: luhn(value),
    };
}
