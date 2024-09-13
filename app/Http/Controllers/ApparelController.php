<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apparel;
use App\Services\ApparelService;
use App\Http\Requests\StoreApparelRequest;
use App\Http\Requests\UpdateApparelRequest;

class ApparelController extends Controller
{
    protected $apparelService;

    public function __construct(ApparelService $apparelService)
    {
        $this->apparelService = $apparelService;
    }

    public function index()
    {
        $apparels = $this->apparelService->getAllApparels();
        return view('apparels.index', compact('apparels'));
    }

    // Show the form for creating a new apparel
    public function create()
    {
        $dropdowns = $this->apparelService->apparelDropdowns();
        return view('apparels.create', $dropdowns);
    }

    // Store a newly created apparel in the database
    public function store(StoreApparelRequest $request)
    {
        $this->apparelService->addApparel($request);
        return redirect()->route('apparels.index')->with('success', 'Apparel added successfully.');
    }

    // Show the form for editing a specific apparel
    public function edit(Apparel $apparel)
    {
        $dropdowns = $this->apparelService->apparelDropdowns();
        return view('apparels.edit', compact('apparel'), $dropdowns);
    }

    // Update a specific apparel in the database
    public function update(UpdateApparelRequest $request, Apparel $apparel)
    {
        $this->apparelService->updateApparelByRequest($request, $apparel);
        return redirect()->route('apparels.index')->with('success', 'Apparel updated successfully.');
    }

    // Delete a specific apparel from the database
    public function destroy(Apparel $apparel)
    {
        $this->apparelService->deleteApparel($apparel);
        return redirect()->route('apparels.index')->with('success', 'Apparel deleted successfully.');
    }

    // Delete an attachment from the apparel
    public function deleteAttachment(Apparel $apparel)
    {
        $this->apparelService->deleteApparelAttachment($apparel);
        return response()->json(['success' => 'Attachment deleted successfully.']);
    }

    public function analyticsByType()
    {
        $totalApparelByType = $this->apparelService->analyticsByType();
        return response()->json($totalApparelByType);
    }

    public function analyticsByTypeTimeframe(Request $request)
    {
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $totalApparelByType = $this->apparelService->analyticsByTypeTimeframe($date_from, $date_to);
        return response()->json($totalApparelByType);
    }

    public function analyticsByStyle()
    {
        $totalApparelByStyle = $this->apparelService->analyticsByStyle();
        return response()->json($totalApparelByStyle);
    }

    public function analyticsByStyleTimeframe(Request $request)
    {
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $totalApparelByStyle = $this->apparelService->analyticsByStyleTimeframe($date_from, $date_to);
        return response()->json($totalApparelByStyle);
    }

    public function analyticsByBrand()
    {
        $totalApparelByBrand = $this->apparelService->analyticsByBrand();
        return response()->json($totalApparelByBrand);
    }

    public function analyticsByBrandTimeframe(Request $request)
    {
        $date_from = $request->query('from');
        $date_to = $request->query('to');

        $totalApparelByBrand = $this->apparelService->analyticsByBrandTimeframe($date_from, $date_to);
        return response()->json($totalApparelByBrand);
    }
}
