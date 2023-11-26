<?php

namespace App\Http\Controllers;

use App\Models\Organism;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Example of controller for the Challenge
 */
class BiomeController extends Controller
{

    /**
     * Returns a list of samples
     */
    public function listSamples(){

        return Sample::query()
            ->withCount('abundances')
            ->with('crop')
            ->get();
    }

    /**
     * Creates a new organism
     */
    public function newOrganism(Request $request){
        
        if(isset($request['genus']) && strlen($request['genus']) > 0 && isset($request['species']) && strlen($request['species']) > 0){
            try {
                $organism = new Organism();
                $organism->genus = $request['genus'];
                $organism->species = $request['species'];
                $organism->save();
                return response()->json(['Succes' => 'Completed'], 200);
            } catch (\Throwable $th) {
                Log::error($th);
                return response()->json(['error' => 'Not completed'], 400);
            }
            
        }
    }

    /**
     * Returns a paginated list of organisms 
     */
    public function listOrganisms(){
        $org = Organism::paginate(10);
        return $org;
    }

    /**
     * Returns the top list of organisms
     */
    public function listOrganismsTop10(){

        $organism = Organism::withCount('abundances')
            ->with('abundances.sample.crop')
            ->orderByDesc('abundances_count')
            ->limit(10)
            ->get();

        return $organism;
        
    }

}
