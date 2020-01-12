<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title')</title>
    <style media="screen">
        {!! file_get_contents(public_path(elixir('css/email.css'))) !!}
    </style>
</head>
<body>
<table class="email-wrapper" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
                <!-- Logo -->
                <tr>
                    <td class="email-masthead">
                        <a class="email-masthead_name">@yield('header')</a>
                    </td>
                </tr>
                <!-- Email Body -->
                <tr>
                    <td class="email-body" width="100%">
                        <table class="email-body_inner" align="center" cellpadding="0" cellspacing="0">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" width="100%">
                                    @yield('content')
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-cell">
                                    <p class="sub center">&copy; {{ date('Y') }} myweather.co.uk. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
