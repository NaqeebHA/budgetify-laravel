<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apparel;
use App\Models\ApparelType;
use App\Models\Style;
use App\Models\Brand;
use App\Models\Budget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ApparelController extends Controller
{
    public function index()
    {
        $apparels = Apparel::all();
        return view('apparels.index', compact('apparels'));
    }

    // Show the form for creating a new apparel
    public function create()
    {
        $apparelTypes = ApparelType::all();
        $styles = Style::all();
        $brands = Brand::all();
        $budgets = Budget::all();
        return view('apparels.create', compact(['apparelTypes', 'styles', 'brands', 'budgets']));
    }

    // Store a newly created apparel in the database
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'price' => 'required',
            'color' => 'required',
            'description' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,jfif,gif,webp|max:2048',
            'purchased_date' => 'nullable',
            'qty' => 'required',
            'type_id' => 'required',
            'style_id' => 'required',
            'brand_id' => 'required',
            'budget_id' => 'nullable',
        ]);

        $created_apparel = Apparel::create($request->all());

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('apparel-attachments', 'public');
            $created_apparel->attachment = $path;
            $created_apparel->save();
        }
        return redirect()->route('apparels.index')->with('success', 'Apparel added successfully.');
    }

    // Show the form for editing a specific apparel
    public function edit(Apparel $apparel)
    {
        $apparelTypes = ApparelType::all();
        $styles = Style::all();
        $brands = Brand::all();
        $budgets = Budget::all();
        return view('apparels.edit', compact(['apparel', 'apparelTypes', 'styles', 'brands', 'budgets']));
    }

    // Update a specific apparel in the database
    public function update(Request $request, Apparel $apparel)
    {
        $request->validate([
            'note' => 'required',
            'price' => 'required',
            'color' => 'required',
            'description' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,jfif,gif,webp|max:2048',
            'purchased_date' => 'nullable',
            'qty' => 'required',
            'type_id' => 'required',
            'style_id' => 'required',
            'brand_id' => 'required',
            'budget_id' => 'nullable',
        ]);

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
        return redirect()->route('apparels.index')->with('success', 'Apparel updated successfully.');
    }

    // Delete a specific apparel from the database
    public function destroy(Apparel $apparel)
    {
        $apparel->delete();

        return redirect()->route('apparels.index')->with('success', 'Apparel deleted successfully.');
    }

    // Delete an attachment from the apparel
    public function deleteAttachment(Apparel $apparel)
    {
        Storage::delete('public/' . $apparel->attachment);
        $apparel->attachment = null;
        $apparel->save();

        return response()->json(['success' => 'Attachment deleted successfully.']);
    }

    public function analyticsByType()
    {
        $totalApparelByType = Apparel::select('apparel_types.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('apparel_types', 'apparels.type_id', '=', 'apparel_types.id')
        ->groupBy('name')
        ->get();
        return response()->json($totalApparelByType);
    }

    public function analyticsByTypeTimeframe(Request $request)
    {
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $totalApparelByType = Apparel::select('apparel_types.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('apparel_types', 'apparels.type_id', '=', 'apparel_types.id')
        ->whereBetween('apparels.purchased_date', [$date_from, $date_to])
        ->groupBy('name')
        ->get();
        return response()->json($totalApparelByType);
    }

    public function analyticsByStyle()
    {
        $totalApparelByStyle = Apparel::select('styles.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('styles', 'apparels.style_id', '=', 'styles.id')
        ->groupBy('name')
        ->get();
        return response()->json($totalApparelByStyle);
    }

    public function analyticsByStyleTimeframe(Request $request)
    {
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $totalApparelByStyle = Apparel::select('styles.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('styles', 'apparels.style_id', '=', 'styles.id')
        ->whereBetween('apparels.purchased_date', [$date_from, $date_to])
        ->groupBy('name')
        ->get();
        return response()->json($totalApparelByStyle);
    }

    public function analyticsByBrand()
    {
        $totalApparelByBrand = Apparel::select('brands.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('brands', 'apparels.brand_id', '=', 'brands.id')
        ->groupBy('name')
        ->get();
        return response()->json($totalApparelByBrand);
    }

    public function analyticsByBrandTimeframe(Request $request)
    {
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $totalApparelByBrand = Apparel::select('brands.name AS name', DB::raw('COUNT(apparels.id) AS count'))
        ->leftJoin('brands', 'apparels.brand_id', '=', 'brands.id')
        ->whereBetween('apparels.purchased_date', [$date_from, $date_to])
        ->groupBy('name')
        ->get();
        return response()->json($totalApparelByBrand);
    }
}
