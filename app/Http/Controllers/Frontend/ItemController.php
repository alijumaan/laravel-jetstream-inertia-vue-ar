<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ItemController extends Controller
{
    public function index(Request $request): Response
    {
        $this->authorize('Access item');

        $request->validate([
            'page' => ['numeric', 'min:1', 'max:1000']
        ]);

        $pagination = 10;
        $page = 1;

        if ($request->has('page')) {
            $page = $request->input('page');
        }

        $key = "item_page_{$page}";

        $items = Cache::get($key);

        if (!$items) {
            $items = Item::orderBy('nomenclature')
                ->orderBy('nomenclature')
                ->latest()
                ->paginate($pagination);
            Cache::forever($key, $items);
        }

        return Inertia::render('Supply/Items/Index', [
            'items' => $items,
            'pagination' => $pagination
        ]);
    }

    public function create()
    {
        $this->authorize('Access item');

        return Inertia::render('Supply/Items/Create');
    }

    public function store(ItemRequest $request, Item $item)
    {
        $this->authorize('Access item');

        $item->create($request->validated());

        return Redirect::route('items.index')
            ->with('success', __('messages.save_successfully'));
    }

    public function edit(Item $item): Response
    {
        $this->authorize('Edit item');

        return Inertia::render('Supply/Items/Edit', [
            'item' => $item
        ]);
    }

    public function update(ItemRequest $request, Item $item)
    {
        $this->authorize('Edit item');

        $item->update($request->validated());

        return Redirect::route('items.index')
            ->with('success', __('messages.update_successfully'));
    }

    public function destroy(Item $item)
    {
        $this->authorize('Delete item');

        $item->delete();

        session()->flash('success', __('messages.delete_successfully'));
    }

    public function print()
    {
        return Inertia::render('Supply/Items/Print', [
            'items' => Item::all()
        ]);
    }
}
