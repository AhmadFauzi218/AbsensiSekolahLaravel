@extends('errors::minimal')

@section("page_title", "404")

@section("page_header", "Oops! Halaman Tidak Ditemukan.")
@section("page_content")
          Sistem ini tidak menemukan halaman yang anda cari.
          Sementara itu, akan di alihkan ke halaman <a href="{{ url('/page/dashboard') }}"> dashboard</a>.
@endsection
