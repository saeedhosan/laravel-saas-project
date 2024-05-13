@extends('layouts/contentLayoutMaster')

@section('title', __('locale.menu.Plugins'))

@section('page-style')
    {{-- <link rel="stylesheet" href="{{ asset(mix('css/pages/checkout.css')) }}"> --}}
@endsection

@section('content')

    <!-- Ecommerce Products Starts -->
    <section id="plugins" class="mb-4">
        <div class="row">
            @foreach ($plugins as $plugin)
                @include('admin.plugins.plugin', ['plugin' => $plugin])
            @endforeach
        </div>
    </section>
    <!-- Ecommerce Products Ends -->

@endsection
