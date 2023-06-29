<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the family tree.
     *
     * @return View|JsonResponse
     */
    public function index(): View | JsonResponse
    {
        $families = Family::all();

        if (\request()->is('api/*')) {
            return response()->json($families);
        } else {
            return view('family.index', ['families' => $families]);
        }
    }

    public function create()
    {
        $families = Family::all();

        return view('family.form', [
            'familyMembers' => $families
        ]);
    }

    /**
     * Store a newly created family member in storage.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required|in:male,female,other',
            'parent_id' => 'nullable|exists:family_tree,id',
        ]);

        $input = getFillableAttribute(Family::class, $request->input());

        $family = Family::query()->create($input);

        if (\request()->is('api/*')) {
            return response()->json($family);
        }

        return redirect()->route('family.index')->with('success', 'Family created successfully.');
    }

    /**
     * Display the specified family member.
     *
     * @param Family $family
     * @return View|JsonResponse
     */
    public function show(Family $family): View|JsonResponse
    {
        if (\request()->is('api/*')) {
            $family->load('children.children');
            $family->load('parent.children');
            return response()->json($family);
        }

        return view('family.show', ['family' => $family]);
    }

    /**
     * @param Family $family
     * @return View|JsonResponse
     */
    public function edit(Family $family): View|JsonResponse
    {
        setDefaultRequest([
            'id' => $family->id,
            'name' => $family->name,
            'gender' => $family->gender,
            'parent_id' => $family->parent_id,
        ]);
        $families = Family::all();

        return view('family.form', [
            'family' => $family,
            'familyMembers' => $families
        ]);
    }

    /**
     * Update the specified family member in storage.
     *
     * @param Request $request
     * @param Family $family
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, Family $family): RedirectResponse|JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required|in:male,female',
            'parent_id' => 'nullable|exists:family,id',
        ]);

        $input = getFillableAttribute(Family::class, $request->input());
        $family->fill($input);
        $family->save();

        if (\request()->is('api/*')) {
            return response()->json($family);
        }

        return redirect()->route('family.index')->with('success', 'Family updated successfully.');
    }

    /**
     * Remove the specified family member from storage.
     *
     * @param Family $family
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Family $family): RedirectResponse|JsonResponse
    {
        $family->delete();
        if (\request()->is('api/*')) {
            return response()->json($family);
        }
        return response()->json(['message' => 'Family member deleted successfully']);
    }
}
