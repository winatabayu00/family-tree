<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function index()
    {
        return view('query.index');
    }

    public function executeQuery(Request $request)
    {
        $queryOption = $request->input('queryOption');

        $scriptQuery = '';
        $queryResult = '';

        switch ($queryOption) {
            case 3:
                $parent = Family::query()->find(1);
                $queryResult = Family::query()
                    ->with(['children'])
                    ->where('parent_id', $parent->id);
                $scriptQuery = $queryResult->toSql();
                break;
            case 4:
                $parent = Family::query()->find(1);
                $queryResult = Family::whereHas('parent', function ($query) use ($parent) {
                    $query->where('parent_id', $parent->id);
                });
                $scriptQuery = $queryResult->toSql();

                break;
            case 5:
                $parent = Family::query()->find(1);

                $queryResult = Family::whereHas('parent.parent', function ($query) use ($parent) {
                    $query->where('name', $parent->name);
                })->where('gender', 'female');
                $scriptQuery = $queryResult->toSql();

                break;
            case 6:
                $farah = Family::query()->find(4);

                $queryResult = Family::query()
                    ->where('parent_id', $farah->parent->parent_id)
                    ->where('gender', 'female');
                $scriptQuery = $queryResult->toSql();

                break;
            case 7:
                $hani = Family::query()->find(9)->name;

                $queryResult = Family::whereHas('parent', function ($query) use ($hani) {
                    $query->whereHas('parent', function ($query) use ($hani) {
                        $query->where('name', '!=', $hani);
                    });
                })->where('gender', 'male');

                $scriptQuery = $queryResult->toSql();

                break;
        }

        setDefaultRequest([
            'queryOption' => $request->queryOption
        ]);

        return view('query.index', [
            'scriptQuery' => $scriptQuery,
            'family' => $queryResult->get(),
        ]);
    }
}
