<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {

        return view('pages.categories.create', [
            'mode' => 'create',
            'category' => new Category(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Successfully created!');
    }

    public function show(Category $category)
    {
        return view('pages.categories.view', compact('category'));
    }

    public function edit(Category $category)
    {

        return view('pages.categories.edit', [
            'mode' => 'edit',
            'category' => $category,

        ]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Successfully deleted!');
    }
}