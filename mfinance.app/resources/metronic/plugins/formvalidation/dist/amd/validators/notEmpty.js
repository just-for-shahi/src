define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    function notEmpty() {
        return {
            validate: function (input) {
                return { valid: input.value !== '' };
            },
        };
    }
    exports.default = notEmpty;
});
