<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

class ShowcaseController extends Controller
{
    /**
     * Obtener todas las categorías y proyectos.
     */
    public function index()
    {
        $showcase = Category::query()
            ->orderBy('name', 'asc')
            ->with('projects')
            ->get();

        $showcase = $showcase->map(function ($c) {
            $c->projects->map(function ($p) {
                $p->logo_url = $p->logo->url;
                $p->images_urls = $p->images->map(function ($i) {
                    return $i->url;
                });
                $p->videos_urls = $p->videos->map(function ($v) {
                    return $v->url;
                });
                unset($p->pivot);
                return $p;
            });
            return $c;
        });

        return response()->json($showcase, 200);
    }

    public function categories()
    {
        $category = Category::query()
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($c) {
                $c->url = url("api/showcase/categories/{$c->slug}");
                return $c;
            });

        return response()->json($category, 200);
    }

    public function category(String $slug)
    {
        $category = Category::query()
            ->whereSlug($slug)
            ->with('projects')
            ->firstOrFail();

        $category->projects->map(function ($p) {
            $p->logo_url = $p->logo->url;
            $p->images_urls = $p->images->map(function ($i) {
                return $i->url;
            });
            $p->videos_urls = $p->videos->map(function ($v) {
                return $v->url;
            });
            unset($p->pivot);
            return $p;
        });

        return response()->json($category, 200);
    }
}
