@extends('layout')
@section('title', 'Dashboard')
@section('content')
<section class="dash"><form class="glass card-form wide" method="POST" action="{{ route('dashboard.update') }}" enctype="multipart/form-data">@csrf @method('PUT')
<h2>Your portfolio</h2>
<p class="sub">Public link: <a href="{{ route('portfolio.show', auth()->user()->username) }}" target="_blank">{{ route('portfolio.show', auth()->user()->username) }}</a></p>
<div class="tpls">
@foreach($templates as $k => $d)
  <label class="tpl"><input type="radio" name="template" value="{{ $k }}" @checked(old('template', $p->template) === $k)><span>{{ ucfirst($k) }}<small>{{ $d }}</small></span></label>
@endforeach
</div>
<label>Name<input name="name" maxlength="80" value="{{ old('name', $p->name) }}"></label>
<label>Headline<input name="headline" maxlength="140" placeholder="Product designer based in Cebu" value="{{ old('headline', $p->headline) }}"></label>
<label>About you<textarea name="bio" rows="4">{{ old('bio', $p->bio) }}</textarea></label>
<label>Skills (comma separated)<input name="skills" placeholder="Figma, Laravel, Photography" value="{{ old('skills', $p->skills) }}"></label>
<label>Contact<input name="contact" placeholder="you@email.com" value="{{ old('contact', $p->contact) }}"></label>
<h3>Projects</h3><p class="sub" style="margin:0 0 12px;text-align:left">Add a photo for each project (JPG, PNG or WebP, up to 2 MB).</p><div id="projects">
@foreach(old('projects', $p->projects ?? []) as $i => $pr)
  <div class="prow"><input name="projects[{{ $i }}][title]" placeholder="Title" value="{{ $pr['title'] ?? '' }}"><input type="file" name="projects[{{ $i }}][photo]" accept="image/*" title="Project photo"><button type="button" class="btn sm rm">Remove</button><input class="d" name="projects[{{ $i }}][desc]" placeholder="One line about it" value="{{ $pr['desc'] ?? '' }}"><input type="hidden" name="projects[{{ $i }}][image]" value="{{ $pr['image'] ?? '' }}">@if(!empty($pr['image']))<img class="thumb" src="{{ asset($pr['image']) }}" alt="">@endif</div>
@endforeach
</div>
<button type="button" class="btn ghost" id="addp">Add project</button>
@foreach($errors->all() as $e)<p class="err">{{ $e }}</p>@endforeach
<p><button class="btn">Save changes</button> @if(session('status'))<span class="ok">{{ session('status') }}</span>@endif</p>
</form></section>
<template id="row"><div class="prow"><input name="projects[__I__][title]" placeholder="Title"><input type="file" name="projects[__I__][photo]" accept="image/*" title="Project photo"><button type="button" class="btn sm rm">Remove</button><input class="d" name="projects[__I__][desc]" placeholder="One line about it"></div></template>
@endsection
@push('scripts')
<script>
let n = Date.now();
document.getElementById('addp').onclick = () => {
  document.getElementById('projects').insertAdjacentHTML('beforeend', document.getElementById('row').innerHTML.replaceAll('__I__', n++));
};
document.getElementById('projects').onclick = e => e.target.classList.contains('rm') && e.target.parentElement.remove();
</script>
@endpush
