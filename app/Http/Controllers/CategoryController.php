<?php

namespace App\Http\Controllers;

use GetCandyClient;
use App\Http\Requests\Request;


class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // List all parent categories
        return view('categories');
    }

    public function show(Request $request, $slug)
    {
        try {
            $routes = GetCandyClient::Routes($slug.'?includes=element')->get();
            if (!isset($routes['data']['element']['data']['id']) || $routes['data']['type'] !== 'category') {
                return abort(404);
            }

            // Get Category
            $categoryID = $routes['data']['element']['data']['id'];
            $categoryParams['includes'] = 'routes,assets,channels';

            $category = GetCandyClient::Categories($categoryID.'?'.http_build_query($categoryParams))->get();

            // Get snapshot of search results
            $sortBy = $request->sortby ?? 'created_at-desc';
            list($sortField, $sortDir) = explode('-', $sortBy);

            $productParams = [
                'page' => $request->page ?? 1,
                'per_page' => $request->display ?? 10,
                'sort_by' => [
                    $sortField => $sortDir
                ],
                'type' => 'product',
                'filters' => ['categories' =>
                    ['values' => [$categoryID]]
                ]
            ];

            $productParams['includes'] = "routes,first_variant";
            $productParams['type'] = "product";

            $searchResults = GetCandyClient::Products($productParams)->search();

        } catch (\Exception $e) {
            return abort(404);
        }

        // TODO: use rel canonical to keep querystrings from affecting SEO (duplicate content)
        return view('category')
            ->with('category', $category['data'])
            ->with('page', $request->page)
            ->with('display', $request->display)
            ->with('sortBy', $request->sortby)
            ->with('searchResults', $searchResults);
    }
}
