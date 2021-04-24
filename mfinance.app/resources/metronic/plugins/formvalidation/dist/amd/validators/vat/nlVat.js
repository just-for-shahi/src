define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    function nlVat(value) {
        var v = value;
        if (/^NL[0-9]{9}B[0-9]{2}$/.test(v)) {
            v = v.substr(2);
        }
        if (!/^[0-9]{9}B[0-9]{2}$/.test(v)) {
            return {
                meta: {},
                valid: false,
            };
        }
        var weight = [9, 8, 7, 6, 5, 4, 3, 2];
        var sum = 0;
        for (var i = 0; i < 8; i++) {
            sum += parseInt(v.charAt(i), 10) * weight[i];
        }
        sum = sum % 11;
        if (sum > 9) {
            sum = 0;
        }
        return {
            meta: {},
            valid: "" + sum === v.substr(8, 1),
        };
    }
    exports.default = nlVat;
});
