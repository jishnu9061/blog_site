@extends('layouts.home')
@section('content')
<section class="section-404">
    <div class="container">
        <div class="wrapper-1080">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('web_components/images/LostTourist-big2.png') }}">
                </div>
                <div class="col-md-6">
                    <h2>Oops!</h2>
                    <h3>Page not on the map</h3>
                    <p>We are very sorry for the inconvenience. You probably typed in the wrong URL directly. In that case, please check for the correct spelling. Perhaps you clicked on a link that no longer exist or outdated to get here; not to worry, it’s probably time to return home.</p>
                    <div class="flex">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Go back</a>
                        <a href="{{ route('admin.home') }}" class="btn btn-outline-secondary">Go home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
