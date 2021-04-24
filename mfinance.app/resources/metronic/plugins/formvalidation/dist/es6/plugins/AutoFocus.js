import Plugin from '../core/Plugin';
import FieldStatus from './FieldStatus';
export default class AutoFocus extends Plugin {
    constructor(opts) {
        super(opts);
        this.fieldStatusPluginName = '___autoFocusFieldStatus';
        this.opts = Object.assign({}, {
            onPrefocus: () => { },
        }, opts);
        this.invalidFormHandler = this.onFormInvalid.bind(this);
    }
    install() {
        this.core
            .on('core.form.invalid', this.invalidFormHandler)
            .registerPlugin(this.fieldStatusPluginName, new FieldStatus());
    }
    uninstall() {
        this.core
            .off('core.form.invalid', this.invalidFormHandler)
            .deregisterPlugin(this.fieldStatusPluginName);
    }
    onFormInvalid() {
        const plugin = this.core.getPlugin(this.fieldStatusPluginName);
        const statuses = plugin.getStatuses();
        const invalidFields = Object.keys(this.core.getFields()).filter((key) => statuses.get(key) === 'Invalid');
        if (invalidFields.length > 0) {
            const firstInvalidField = invalidFields[0];
            const elements = this.core.getElements(firstInvalidField);
            if (elements.length > 0) {
                const firstElement = elements[0];
                const e = { firstElement, field: firstInvalidField };
                this.core.emit('plugins.autofocus.prefocus', e);
                this.opts.onPrefocus(e);
                firstElement.focus();
            }
        }
    }
}
