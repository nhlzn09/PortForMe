<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public const TEMPLATES = ['aurora' => 'Liquid glass', 'mono' => 'Editorial', 'neon' => 'Terminal glow'];

    public function dashboard(Request $r)
    {
        return view('dashboard', ['p' => $r->user()->portfolio, 'templates' => self::TEMPLATES]);
    }

    public function update(Request $r)
    {
        $d = $r->validate([
            'template' => 'required|in:aurora,mono,neon',
            'name' => 'nullable|max:80', 'headline' => 'nullable|max:140',
            'bio' => 'nullable|max:2000', 'skills' => 'nullable|max:500', 'contact' => 'nullable|max:200',
            'projects' => 'nullable|array|max:12',
            'projects.*.title' => 'nullable|max:80', 'projects.*.desc' => 'nullable|max:300',
            'projects.*.photo' => 'nullable|image|max:4096',
            'projects.*.image' => 'nullable|string|max:120',
        ], ['projects.*.photo.image' => 'Project photos must be JPG, PNG, WebP or GIF.']);

        $p = $r->user()->portfolio;
        $old = collect($p->projects ?? [])->pluck('image')->filter()->all();
        $projects = [];
        foreach ($r->input('projects', []) as $i => $row) {
            if (empty($row['title'])) continue;
            $img = in_array($row['image'] ?? null, $old, true) ? $row['image'] : null; // keep only this user's own images
            if ($file = $r->file("projects.$i.photo")) {
                $name = Str::random(24) . '.' . $file->extension();
                $file->move(public_path('uploads'), $name);
                $img = "uploads/$name";
            }
            $projects[] = ['title' => $row['title'], 'desc' => $row['desc'] ?? '', 'image' => $img];
        }
        foreach (array_diff($old, array_column($projects, 'image')) as $f) @unlink(public_path($f)); // remove replaced/removed photos

        unset($d['projects']);
        $p->update($d + ['projects' => $projects]);
        return back()->with('status', 'Saved.');
    }

    public function show(string $username)
    {
        $u = User::where('username', strtolower($username))->firstOrFail();
        return view('portfolio', ['p' => $u->portfolio]);
    }
}
