@extends('layouts.all')

@push('append-head')
    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <x-page-title-no-breadcrumbs title="Selecciona tus imágenes a convertir" />
@endsection
@section('footer')
    <p>2021 &copy; Makech Tecnology &trade; All  right reserved.</p>
@endsection

@push('append-scripts')
    <!-- JavaScripts -->
    
    <!-- jQuery -->
    <script src="{{ asset('assets/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="{{ asset('assets/vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
    
    <!-- Form Flie Upload Data JavaScript -->
    <script src="{{ asset('assets/js/form-file-upload-data.js') }}"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('assets/js/dropdown-bootstrap-extended.js') }}"></script>
    
    <!-- Owl JavaScript -->
    <script src="{{ asset('assets/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

    <!-- Switchery JavaScript -->
    <script src="{{ asset('assets/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>

    <!-- Init JavaScript -->
    <script src="{{ asset('assets/js/init.js') }}"></script>
@endpush