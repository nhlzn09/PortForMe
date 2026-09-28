@extends('layout')
@section('content')
<section class="hero"><h1 id="hero">Your work deserves a page that moves.</h1>
<p class="sub">Pick a template, add your skills and projects, and share one link. No code, no fuss.</p>
<a class="btn" href="{{ route('register') }}">Create your portfolio</a></section>
<section class="feat"><div class="glass"><h3>Three templates</h3><p>Aurora glass, Mono editorial or Neon terminal. Switch any time.</p></div>
<div class="glass"><h3>Skills and projects</h3><p>Show what you can do and link to what you have built.</p></div>
<div class="glass"><h3>One shareable link</h3><p>Your page lives at {{ url('/u/yourname') }}.</p></div></section>
@endsection
