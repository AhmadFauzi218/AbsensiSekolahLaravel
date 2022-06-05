@extends('errors::minimal')

@section("page_title", "500")

@section("page_header", "Oops! Server error.")
@section("page_content")
          Sedang mengalami error.
          Kembali ke halaman <a href="{{ url('/page/dashboard') }}"> sebelumnya</a>.
@endsection
