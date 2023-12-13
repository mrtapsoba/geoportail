@extends('layouts.allFrameClient')


@section('headLinks')
    <link rel="stylesheet" href="/css/contribution.css">
    <link rel="stylesheet" href="/css/contribcouche.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/style.css">

    @livewireStyles
@endsection

@section('contribution')
    class="active"
@endsection
@section('contributionPhone')
    class="active"
@endsection

@section('sectiontitle')
    Contribution
@endsection

@section('content')
    <livewire:search />
@endsection
@section('scripts')
    @livewireScripts
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/theme.js') }}"></script>
    <script src="{{ asset('/js/alpine.min.js') }}"></script>
@endsection
