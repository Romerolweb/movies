<?php

namespace App\Http\Controllers\Api;

// use App\Service;
use App\Category;
use App\Traits\ApiCrypt;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class ApiController extends Controller
{
    use ApiResponser, ApiCrypt;

    //prueba deploy
    // public function buildSitemap()
    // {
    //     $records = [];
    //     $records[] = $this->builObjectSitemap('');
    //     $services = Service::where(['is_visible' => true])
    //     ->whereHas('category', function(Builder $query) {
    //         $query->where('is_active', true);
    //     })
    //     ->get();
    //     foreach ($services as $service) {
    //         $product = $service->products()->first();
    //         $name = "{$service->slug}/".strtolower($product->ciudad);
    //         array_push($records, $this->builObjectSitemap($name));
    //     }

    //     return $this->showData($records, 200);
    // }

    public function buildSitemapIndex()
    {
        $records = [];
        $records[] = $this->builObjectSitemap('sitemap-personas.xml');
        $records[] = $this->builObjectSitemap('sitemap-empresas.xml');
        $records[] = $this->builObjectSitemap('sitemap-conjuntos.xml');
        $records[] = $this->builObjectSitemap('sitemap-blog.xml');
        
        return $this->showData($records, 200);
    }

    public function builObjectSitemap($url, $freq = 'daily', $priority = '0.9')
    {
        $data = [];
        $data['url'] = $url;
        $data['lastmod'] = now()->format('Y-m-d');
        $data['changefreq'] = $freq;
        $data['priority'] = $priority;

        return $data;
    }
}
