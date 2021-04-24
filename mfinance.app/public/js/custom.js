$(document).ready(function () {
    $('.redirect-on-change').on('change', function () {
        let value = this.value;
        let url = $(this).data('url');
        let key = $(this).data('key') || 'value';

        console.log(url);
        window.location = url + `/?${key}=${value}`;
    });
});
