<?php

namespace App\Services;

use App\Models\Apparel;
use App\Models\ApparelType;
use App\Models\Style;
use App\Models\Brand;
use App\Models\Budget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreApparelRequest;
use App\Http\Requests\UpdateApparelRequest;

class ApparelService
{
    public function getAllApparels()
    {
        return Apparel::all();
    }

    public function findApparelById($id)
    {
        return Apparel::find($id);
    }

    public function updateApparel($id, array $data)
    {
        $apparel = Apparel::find($id);

        if ($apparel) {
            return $apparel->update($data);
        }

        return false;
    }

    public function updateApparelByRequest(UpdateApparelRequest $request, Apparel $apparel)
    {
        if ($request->hasFile('attachment')) {
            if ($apparel->attachment ?? false) {
                Storage::delete('public/' . $apparel->attachment);
                $apparel->update($request->all());
            }
            $file = $request->file('attachment');
            $path = $file->store('apparel-attachments', 'public');
            $apparel->attachment = $path;
            $apparel->save();
        } else {
            $apparel->update($request->all());
        }
    }

    public function apparelDropdowns()
    {
        $apparelTypes = ApparelType::all();
        $styles = Style::all();
        $brands = Brand::all();
        $budgets = Budget::all();
        return ['apparelTypes' => $apparelTypes, 'styles' => $styles, 'brands' => $brands, 'budgets' => $budgets];
    }

    public function addApparel(StoreApparelRequest $request)
    {
        $created_apparel = Apparel::create($request->all());

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('apparel-attachments', 'public');
            $created_apparel->attachment = $path;
            $created_apparel->save();
        }
    }

    public function deleteApparel(Apparel $apparel)
    {
        $apparel->delete();
    }

    public function deleteApparelAttachment(Apparel $apparel)
    {
        Storage::delete('public/' . $apparel->attachment);
        $apparel->attachment = null;
        $apparel->save();
    }

    public function analyticsByType()
    {
        $totalApparelByType = Apparel::select('apparel_types.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('apparel_types', 'apparels.type_id', '=', 'apparel_types.id')
        ->groupBy('name')
        ->get();
        return $totalApparelByType;
    }

    public function analyticsByTypeTimeframe($date_from, $date_to)
    {
        $totalApparelByType = Apparel::select('apparel_types.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('apparel_types', 'apparels.type_id', '=', 'apparel_types.id')
        ->whereBetween('apparels.purchased_date', [$date_from, $date_to])
        ->groupBy('name')
        ->get();
        return $totalApparelByType;
    }

    public function analyticsByStyle()
    {
        $totalApparelByStyle = Apparel::select('styles.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('styles', 'apparels.style_id', '=', 'styles.id')
        ->groupBy('name')
        ->get();
        return $totalApparelByStyle;
    }

    public function analyticsByStyleTimeframe($date_from, $date_to)
    {
        $totalApparelByStyle = Apparel::select('styles.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('styles', 'apparels.style_id', '=', 'styles.id')
        ->whereBetween('apparels.purchased_date', [$date_from, $date_to])
        ->groupBy('name')
        ->get();
        return $totalApparelByStyle;
    }

    public function analyticsByBrand()
    {
        $totalApparelByBrand = Apparel::select('brands.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('brands', 'apparels.brand_id', '=', 'brands.id')
        ->groupBy('name')
        ->get();
        return $totalApparelByBrand;
    }

    public function analyticsByBrandTimeframe($date_from, $date_to)
    {
        $totalApparelByBrand = Apparel::select('brands.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('brands', 'apparels.brand_id', '=', 'brands.id')
        ->whereBetween('apparels.purchased_date', [$date_from, $date_to])
        ->groupBy('name')
        ->get();
        return $totalApparelByBrand;
    }
}
