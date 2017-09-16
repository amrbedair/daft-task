<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

require_once base_path("/lib/Pintlabs/Service/Brewerydb/Exception.php");
require_once base_path("/lib/Pintlabs/Service/Brewerydb.php");

class BreweryDbHelper {
    
    private $bdb;
    private $styles = [];
    
    public function __construct() {

        $this->bdb = new \Pintlabs_Service_Brewerydb(env('BREWERY_DB_API_KEY'));
        $this->bdb->setFormat('php');
        
        $this->init();
    }
    
    private function init() {
        
        // try to get styles from the cache
        $this->styles = Cache::get('styles');
        if(!$this->styles) {
            
            $result = $this->request('styles');
            $this->styles = $result['data'];
            /**
             * cache it for 24 hours, maybe we need more!
             * it depends on how often new style may be added
             * default chache in php is FileCache, we may use memcache or
             * anything else, but this is enough for simplicity
             */
            Cache::put('styles', $this->styles, 60 * 60 * 24);
        }
    }
    
    private function request($endpoint, $params=[], $method='GET') {
        try {
            $result = $this->bdb->request($endpoint, $params, $method);
            if($result['status'] == 'failure') {
                abort(500, $result['errorMessage']);
            }
            return $result;
        } catch (Exception $e) {
            // log
            Log::error('[ERR-00] Error while trying to access '.$endpoint.' endpoint '.$e->getMessage());
            abort(500, $e->getMessage());
        }
    }
    
    public function getRandomBeer() {

        /**
         * if empty for any reason like failed while constructing the
         * singleton instance .. try one more time
         */
        if(empty($this->styles)) {
            $this->init();
        }
        
        /**
         * still empty ... just log and return null
         * we may use hardcoded style id, if we are sure it will not go away!
         */
        if(empty($this->styles)) {
            Log::error('[ERR-02] Empty style list!');
            return null;
        }
        
        while(true) {
            $randomStyle = $this->styles[array_rand($this->styles)];
            $result = $this->request('beers', [
                'styleId' => $randomStyle['id'], 
                'order' => 'random', 
                'randomCount' => 1,
                'withBreweries' => 'Y',
            ]);
            
            if(!isset($result['data'])) {
                Log::error('[ERR-03] Error retreiving data '.$result['errorMessage']);
                return null;
            }
            
            $data = $result['data'];
            if( count($data) < 1 || // it may happen!
                !isset($data[0]['labels']) || 
                !isset($data[0]['description']) ) {
                continue; 
            }
            return $data[0];
        }
    }
    
    public function search($q='', $type='beer', $breweryId='', $page=1) {
        
        if(empty($q)) return[];
        
        $beers = [];        
        
        if($type == 'beer') { // TYPE_BEER
            $result = $this->request('search', [
                'p' => $page,
                'q' => $q,
                'type' => 'beer',
            ]);
            if(isset($result['data'])) {
                $this->mergeValidBeers($beers, $result['data']);
            }
            
        } else { // TYPE_BREWERY
            
            $breweryIds = empty($breweryId) ? [] :[$breweryId];
            
            if(empty($breweryId)) {
                // get brewery id first
                $result = $this->request('search', [
                    'q' => $q,
                    'type' => 'brewery',
                ]);
                
                // check valid result
                if(isset($result['data']) && is_array($result['data'])) {
                    $breweries = $result['data'];
                    foreach ($breweries as $brewery) { $breweryIds[] = $brewery['id']; }
                }
            }
            
            if(!empty($breweryIds)) {
                foreach ($breweryIds as $breweryId) {
                    // check if already cached
                    $result = Cache::get("BREWERY_".$breweryId."_RESULT");
                    if(!$result) {
                        $result = $this->request("/brewery/$breweryId/beers");
                        Cache::put("BREWERY_".$breweryId."_RESULT", $result, 60 * 60 * 24);
                    }
                    if(!isset($result['data'])) continue; 
                    $this->mergeValidBeers($beers, $result['data']);
                }
            }
        }
            
        return $beers;
    }
    
    /**
     * skip beers with no labels or description
     * @param array $array
     * @param array $beers
     */
    private function mergeValidBeers(&$array, $beers) {
        foreach ($beers as $beer) {
            if(!isset($beer['labels']) || !isset($beer['description'])) {
                continue;
            }
            $array[] = $beer;
        }
    }
}