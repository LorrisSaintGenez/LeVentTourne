<?php

namespace App\Http\Controllers;

use App\GhostPage;
use Illuminate\Http\Request;

class GhostPageController extends Controller
{

    public function index() {
        $pages = GhostPage::all();

        return view('admin/ghostPages/allGhostPages', ['pages' => $pages]);
    }

    public function creation() {
        return view('admin/ghostPages/createGhostPage');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:ghost_pages',
            'description' => 'required|string|max:2000',
        ]);

        GhostPage::create([
           'title' => $request->input('title'),
           'description' => $request->input('description')
        ])->push();

        return redirect('backoffice/pages')->with('successPage', 'Page créée avec succès !');
    }

    public function edition($id) {
        $page = GhostPage::find($id);

        return view('admin/ghostPages/editGhostPage', ['page' => $page]);
    }

    public function update(Request $request) {

        $request->validate([
            'title' => 'required|string|max:255|unique:ghost_pages',
            'description' => 'required|string|max:2000',
        ]);

        $page = GhostPage::find($request->input('id'));

        $page->update([
           'title' => $request->input('title'),
           'description' => $request->input('description')
        ]);

        return redirect('backoffice/pages')->with('successPage', 'Page éditée avec succès !');
    }

    public function visualize($id) {
        $page = GhostPage::find($id);

        return view('admin/ghostPages/visualizeGhostPage', ['page' => $page]);
    }

    public function delete($id)
    {
        $ghostpage = GhostPage::find($id);

        GhostPage::destroy($id);

        return redirect('backoffice/pages')->with('successDelete', 'Page '.$ghostpage->title.' supprimée avec succès');
    }
}
