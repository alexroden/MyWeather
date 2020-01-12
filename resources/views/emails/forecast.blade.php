@extends('layouts.email')

@section('title', '')

@section('header')
    Your weekly weather forecast
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff" align="center">
                <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
                    Your weekly weather forecast
                </div>
            </td>
        </tr>
    </table>
@stop

@section('content')
    <h1>Your weekly weather forecast</h1>
    <br>
    <p>Hey {{ $user->first_name }},</p>
    <p>Here is your weekly weather forecast.</p>
    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td align="center" style="text-align: center;">
                This week it is expected to be: {{ $forecast['summary']['summary'] }}}
            </td>
        </tr>
        @foreach($forecast['breakdown'] as $breakdown)
        <tr>
            <td align="center" style="text-align: center;">
                {{ Carbon::parse($breakdown['time'])->format('l') }}}
            </td>
            <td align="center" style="text-align: center;">
                {{ $breakdown['summary'] }}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@stop
