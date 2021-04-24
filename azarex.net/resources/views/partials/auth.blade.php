<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl" >
<head>
    <meta charset="utf-8"/>
    <title>@yield('page.title') | {{config('app.name')}}</title>
    <meta name="description" content="@yield('page.description')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    @yield('styles')
    <link href="{{asset('passets/plugins/global/plugins.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('passets/plugins/custom/prismjs/prismjs.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('passets/css/style.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{asset('passets/media/logos/favicon.ico')}}"/>
</head>
<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled page-loading"  >
@yield('wrapper')
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
    };
</script>
<script src="{{asset('passets/plugins/global/plugins.bundle.js?v=7.0.6')}}"></script>
<script src="{{asset('passets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6')}}"></script>
<script src="{{asset('passets/js/scripts.bundle.js?v=7.0.6')}}"></script>
@yield('scripts')
</body></html>
