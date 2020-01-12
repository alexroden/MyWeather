@extends('layouts.site')

@section('content')
<section class="hero is-info is-fullheight">
    <div class="hero-head">
    <nav-bar :auth="{{ isset($auth) ? $auth->toJson() : "{}" }}"></nav-bar>
    </div>

<div class="hero-body hero-image--default">
    <container :auth="{{ isset($auth) ? $auth->toJson() : "{}" }}"></container>
</div>

</section>
@endsection
