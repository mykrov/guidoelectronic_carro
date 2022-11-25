<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Categorias;
use App\Familias;

// Esta clase iba a ser implementada para características de marqueting
// donde se solcitaba el retorno de un XML con información del mapa del 
// sitio web, uitilizado para ciertos servicios.
class Url
{
    private $url;
    private $lastUpdate;
    private $frequency;
    private $priority;

    public static function create($url)
    {
        $newNode = new self();
        $newNode->url = url($url);
        return $newNode;
    }

    public function lastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }

    public function frequency($frequency)
    {
        $this->frequency = $frequency;
        return $this;
    }

    public function priority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    public function build()
    {
        // $url = 'https://programacionymas.com/';
        // $lastUpdate = '2019-07-31T01:06:39+00:00';
        // $frequency = 'monthly';
        // $priority = '1.00';
        return "<url>" .
            "<loc>$this->url</loc>" .
            "<lastmod>$this->lastUpdate</lastmod>" .
            "<changefreq>$this->frequency</changefreq>" .
            "<priority>$this->priority</priority>" .
        "</url>";
    }
}

class SiteMap
{
    const START_TAG = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    const END_TAG = '</urlset>';

    // to build the XML content
    private $content;

    public function add(Url $siteMapUrl)
    {
        $this->content .= $siteMapUrl->build();
    }

    public function build()
    {
        return self::START_TAG . $this->content . self::END_TAG;
    }
}


class SiteMapController extends Controller
{
    public function index(){
        
        $this->siteMap = new SiteMap();

        $this->addUniqueRoutes();
        $this->addCategories();
        $this->addTags();
        

        return response($this->siteMap->build(), 200)
            ->header('Content-Type', 'text/xml');
    }

    private function addUniqueRoutes()
    {
        $date = Carbon::now()->Format('Y-m-');
        $startOfMonth = $date.'01';

        $this->siteMap->add(
            Url::create('/')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('1.00')
        );
        
        $this->siteMap->add(
            Url::create('/nosotros')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.8')
        );
        $this->siteMap->add(
            Url::create('/contacto')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.9')
        );
        $this->siteMap->add(
            Url::create('/politicas')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.5')
        );
        $this->siteMap->add(
            Url::create('/guiacompra')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.6')
        );
        $this->siteMap->add(
            Url::create('/cuenta')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.6')
        );
        $this->siteMap->add(
            Url::create('/contacto')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.8')
        );
        $this->siteMap->add(
            Url::create('/tarifas')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.3')
        );

        $this->siteMap->add(
            Url::create('/login')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.7')
        );
        

    }

    private function addProfilePages()
    {
        // ...
    }

    private function addArticles()
    {
        // ...
    }

    private function addCategories()
    {
        $categories = Categorias::where('estado','=','A')
        ->get();

        $date = Carbon::now()->Format('Y-m-');
        $startOfMonth = $date.'01';

        foreach ($categories as $category) {
            $this->siteMap->add(
                Url::create("/categoria/$category->idcategoria")
                    ->lastUpdate($startOfMonth)
                    ->frequency('monthly')
                    ->priority('0.8')
            );
        }
    }

    private function addTags()
    {
        $categories = Familias::where('estado','=','A')
        ->get();

        $date = Carbon::now()->Format('Y-m-');
        $startOfMonth = $date.'01';

        foreach ($categories as $category) {
            $this->siteMap->add(
                Url::create("/familia/$category->idfamilia")
                    ->lastUpdate($startOfMonth)
                    ->frequency('monthly')
                    ->priority('0.7')
            );
        }
    }

    
}
