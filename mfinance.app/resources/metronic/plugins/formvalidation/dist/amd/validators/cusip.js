define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    function cusip() {
        return {
            validate: function (input) {
                if (input.value === '') {
                    return { valid: true };
                }
                var v = input.value.toUpperCase();
                if (!/^[0-9A-Z]{9}$/.test(v)) {
                    return { valid: false };
                }
                var converted = v.split('').map(function (item) {
                    var code = item.charCodeAt(0);
                    return (code >= 'A'.charCodeAt(0) && code <= 'Z'.charCodeAt(0))
                        ? (code - 'A'.charCodeAt(0) + 10) + ''
                        : item;
                });
                var length = converted.length;
                var sum = 0;
                for (var i = 0; i < length - 1; i++) {
                    var num = parseInt(converted[i], 10);
                    if (i % 2 !== 0) {
                        num *= 2;
                    }
                    if (num > 9) {
                        num -= 9;
                    }
                    sum += num;
                }
                sum = (10 - (sum % 10)) % 10;
                return { valid: sum === parseInt(converted[length - 1], 10) };
            },
        };
    }
    exports.default = cusip;
});
