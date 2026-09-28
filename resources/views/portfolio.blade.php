<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $p->name }} | PortForMe</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Instrument+Serif&family=JetBrains+Mono&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box}body{margin:0;font:16px/1.65 Inter,system-ui,sans-serif;min-height:100vh}.w{max-width:820px;margin:0 auto;padding:80px 24px}h1{font-size:clamp(2.6rem,8vw,5rem);line-height:1;margin:.2em 0 .3em}h2{margin:2.4em 0 .6em}.chip{display:inline-block;padding:6px 15px;margin:4px 6px 4px 0;border-radius:99px}.card{display:block;padding:22px;margin:14px 0;text-decoration:none;color:inherit;transition:transform .4s}.card:hover{transform:translateY(-4px)}.card p{margin:.3em 0 0;opacity:.75}.card img{display:block;width:100%;max-height:380px;object-fit:cover;border-radius:14px;margin-bottom:14px}.in{animation:up 1s both}@keyframes up{from{opacity:0;transform:translateY(26px);filter:blur(12px)}}@media(prefers-reduced-motion:reduce){*{animation:none!important}}footer{margin-top:60px;opacity:.6;font-size:.85rem}
@if($p->template === 'aurora')
body{background:#0a0714;color:#f4f1ff}body:before,body:after{content:"";position:fixed;width:55vmax;height:55vmax;border-radius:50%;filter:blur(90px);z-index:-1;animation:d 18s ease-in-out infinite alternate}body:before{background:#6d3bff;top:-20vmax;left:-15vmax;opacity:.55}body:after{background:#ff4fa3;bottom:-25vmax;right:-15vmax;opacity:.4;animation-delay:-9s}@keyframes d{to{transform:translate(12vmax,8vmax) scale(1.2)}}.chip,.card{background:rgba(255,255,255,.07);backdrop-filter:blur(22px) saturate(160%);border:1px solid rgba(255,255,255,.16);box-shadow:inset 0 1px 0 rgba(255,255,255,.25)}.card{border-radius:24px}h1{font-family:'Instrument Serif',Georgia,serif;font-weight:400}
@elseif($p->template === 'mono')
body{background:#efefec;color:#161616;font-family:Georgia,serif}h1{letter-spacing:-.03em}.chip{border:1px solid #161616;border-radius:0}.card{border-top:2px solid #161616;padding:18px 0}.card:hover{transform:translateX(8px)}a{color:inherit}.card img{border-radius:0}
@else
body{background:#04070a;color:#d6ffe8;font-family:'JetBrains Mono',ui-monospace,monospace}h1{text-shadow:0 0 28px #00ff9d88;font-size:clamp(2.2rem,7vw,4rem)}.chip{border:1px solid #00ff9d;color:#00ff9d;box-shadow:0 0 14px #00ff9d44;border-radius:4px}.card{border:1px solid #00ff9d55;border-radius:6px;background:#00ff9d0a}.card:hover{box-shadow:0 0 26px #00ff9d44;border-color:#00ff9d}h2{color:#00ff9d}.card img{border-radius:4px}
@endif
</style></head><body><main class="w">
<p class="in">{{ $p->headline }}</p>
<h1 class="in" style="animation-delay:.15s">{{ $p->name }}</h1>
<p class="in" style="animation-delay:.3s">{!! nl2br(e($p->bio)) !!}</p>
@php $skills = array_filter(array_map('trim', explode(',', $p->skills ?? ''))); @endphp
@if($skills)<h2>Skills</h2>@foreach($skills as $s)<span class="chip">{{ $s }}</span>@endforeach @endif
@if(!empty($p->projects))<h2>Projects</h2>
@foreach($p->projects as $pr)<div class="card">@if(!empty($pr['image']))<img src="{{ asset($pr['image']) }}" alt="{{ $pr['title'] }}">@endif<strong>{{ $pr['title'] }}</strong><p>{{ $pr['desc'] ?? '' }}</p></div>@endforeach @endif
@if($p->contact)<h2>Contact</h2><p>{{ $p->contact }}</p>@endif
<footer>Made by Group 7</footer></main></body></html>
