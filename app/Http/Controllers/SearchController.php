<?php

namespace App\Http\Controllers;

use GetCandyClientClient;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(SearchRequest $request)
    {
        // List all parent categories
        return view('search')
            ->with('searchTerm', $request->q)
            ->with('page', $request->page)
            ->with('display', $request->display);
    }

    public function search(SearchRequest $request)
    {

        $params = [];
        // Keywords
        if ($request->has('keywords')) {
            $params['keywords'] = $request->keywords;
        }

        // Apply Filters
        if ( $request->has('filters') ) {
            foreach ($request->filters as $appliedFilter) {
                $params['filters']['categories']['values'][] = $appliedFilter['value'];
            }
        }

        // Apply SortBy
        if ($request->has('sortBy')) {
            $sortBy = explode("-", $request->sortBy);
            $params['sort_by'][$sortBy[0]] = $sortBy[1];
        }

        // Apply Pagination
        if ( $request->has('pagination.per_page') ) {
            $params['per_page'] = (int) $request->pagination['per_page'];
        }
        if( $request->has('pagination.current_page') ) {
            $params['page'] = (int) $request->pagination['current_page'];
        }

        $params['includes'] = "routes,first_variant";
        $params['type'] = "product";
        $params['currency'] = $this->currency['code'];

        try {
            $results = GetCandyClient::Products($params)->search();
        } catch(\Exception $e) {
            echo $e->getMessage();exit;
            return abort(404);
        }

        return response()->json($results);
    }
}
