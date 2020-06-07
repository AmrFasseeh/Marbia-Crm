<?php

namespace App\Http\Controllers;

use App\Building;
use App\Image;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $building = Building::findorfail($id);
        // dd($building->stage);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => $building->buildingGroup->title], ['name' => $building->building_name . ' view'],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isMenuCollapsed' => true];

        return view('pages.properties.app-properties',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'building' => $building,
            ]);
    }

    public function allProps()
    {
        $properties = Property::all();
        // dd($building->stage);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => 'Properties'], ['name' => 'All Properties'],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        return view('pages.properties.app-properties-all',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'properties' => $properties,
            ]);
    }

    public function sell($id)
    {
        $property = Property::findorfail($id);
        $property->status = 1; // sold
        $property->save();

        return redirect()->back()->with('status', $property->title . ' Property Sold!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $building = Building::findorfail($id);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => $building->building_name], ['name' => "Add Property"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        // $prop = Property::findorfail(1);
        // dd($prop->building->buildingGroup->project);
        // dd($stagee->project ,$build->buildingGroup->project);
        return view('pages.properties.app-properties-add',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'building' => $id,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validatedProperty = $request->validate([
            'name' => 'required|string',
            'property_type' => 'required|string',
            'num_of_properties' => 'required|numeric',
            'floor_no_from' => 'required|numeric',
            'floor_no_to' => 'required|numeric',
            'appartment_no_from' => 'required|numeric',
            'apartment_no_to' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'kitchen' => 'required|numeric',
            'area_sqm' => 'required|numeric',
            'value' => 'required|numeric',
            'payment_category' => 'string',
            'description' => 'string',
        ]);
        if (($validatedProperty['floor_no_to'] - $validatedProperty['floor_no_from'] + 1 == $validatedProperty['num_of_properties'])
            && (($validatedProperty['apartment_no_to'] - $validatedProperty['appartment_no_from']) / 100 + 1 == $validatedProperty['num_of_properties'])) {
            $k = 1;
            for ($i = 0; $i < $validatedProperty['num_of_properties']; $i++) {

                $newProperty = new Property();
                if ($k == 1) {
                    $apt_no[$k] = $validatedProperty['appartment_no_from'];
                }
                $newProperty->name = $validatedProperty['name'];
                $newProperty->property_type = $validatedProperty['property_type'];
                $newProperty->bedrooms = $validatedProperty['bedrooms'];
                $newProperty->bathrooms = $validatedProperty['bathrooms'];
                $newProperty->kitchen = $validatedProperty['kitchen'];
                $newProperty->area_sqm = $validatedProperty['area_sqm'];
                $newProperty->value = $validatedProperty['value'];
                // $newProperty->payment_category = $validatedProperty['payment_category']; // not needed in property
                $newProperty->floor_no = $validatedProperty['floor_no_from'];
                $newProperty->apartment_no = $apt_no[$k];
                $newProperty->building_id = $id;
                $k++;
                if (($validatedProperty['floor_no_from'] < $validatedProperty['floor_no_to'])
                    && ($validatedProperty['appartment_no_from'] < $validatedProperty['apartment_no_to'])) {
                    $validatedProperty['floor_no_from']++;

                    $apt_no[$k] = $apt_no[$k - 1] + 100;
                    // dd($apt_no[$k], $apt_no[$k - 1], $newProperty->apartment_no);
                }
                $newProperty->save();

                if ($request->file('image')) {
                    $path = $request->file('image')->storeAs('project_images/' . $newProperty->building->buildingGroup->project->title, 'project-' . $newProperty->building->buildingGroup->project->title . '-' . $newProperty->building->buildingGroup->title . '-' . $newProperty->building->building_name . '-' . $newProperty->name . '.' . $request->file('image')->guessExtension());
                    // $request->file('image')->store('avatars');
                    // dd($path, $request->file('image'));
                    if ($newProperty->image) {
                        // dd($user->image);
                        // Storage::delete($user->image->image_path);
                        $newProperty->image()->update(['image_path' => $path]);
                    } else {
                        $newProperty->image()->save(
                            Image::make(['image_path' => $path])
                        );
                    }
                }
            }
            // dd($validatedProperty); ///// HERE===================>
        } else {
            return redirect()->back()->with('warning', 'Floor numbers or Appartment numbers do not match Number of properties stated!');
        }

        $request->session()->flash('status', 'Properties created!');
        return redirect()->route('view.building', $id);
    }

    public function hold(Request $request, $id)
    {
        // dd($request);
        $property = Property::findorfail($id);
        $property->hold = 1;
        $property->hold_payment = $request->hold_payment;
        $property->save();

        return redirect()->back()->with('status', 'Property ' . $property->name . ' floor #: ' . $property->floor_no . ' is on hold!');
    }

    public function release($id)
    {
        $property = Property::findorfail($id);
        $property->hold = 0;
        $property->hold_payment = 0;
        $property->save();

        return redirect()->back()->with('status', 'Property ' . $property->name . ' floor #: ' . $property->floor_no . ' is released!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if ($property->status == 1) {
            return redirect()->back()->with('warning', 'Can\'t delete this property, it is already sold!');
        } else {
            $property->delete();
            return redirect()->back()->with('status', 'Property deleted!');
        }
    }
}
