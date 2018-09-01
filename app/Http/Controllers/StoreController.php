<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreRequest;
use App\Models\Store;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    const CACHE_TAG = 'stores';

    const CACHE_DURATION_MINUTES = 30;

    public function index(Request $request)
    {
        $page = 1;
        $search = null;

        if ($request->has('page')) {
            $page = $request->input('page');
        }

        if ($request->has('q')) {
            $search = $request->input('q');
        }

        $cache_name = "search:{$search}:page:{$page}";

        if (Cache::tags(self::CACHE_TAG)->has($cache_name)) {
            $stores = Cache::tags(self::CACHE_TAG)->get($cache_name);
        } else {
            $stores = Store::search($search)
                             ->orderBy('name')
                             ->paginate(20);

            Cache::tags(self::CACHE_TAG)->put($cache_name, $stores, self::CACHE_DURATION_MINUTES);
        }

        return response()->json($stores);
    }

    public function show(Store $store)
    {
        return response()->json($store);
    }

    public function store(StoreRequest $request)
    {
        if (Auth::check()) {
            $store = Store::create(array_filter($request->only(['name', 'description'])));

            // Give store admin role to the user who created the store.
            Auth::user()->stores()->attach($store->id, [
                'role_id' => Role::name(Role::ROLE_ADMIN)
                    ->roleScope(RoleScope::ROLE_SCOPE_STORE)
                    ->first()->id
            ]);

            return response()->json($store);
        }
    }

    public function destroy(Store $store)
    {
        if (Auth::check()
            && (Auth::user()->isSiteAdmin()
                || $store->hasUser(Auth::user()->id)
            )
        ) {
            $store->destroy();

            return response()->json([
                'status' => 'success',
                'message' => 'The store has been removed.'
            ]);
        }
    }
}
