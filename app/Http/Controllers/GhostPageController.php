<?php

namespace App\Http\Controllers;

use App\GhostPage;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class GhostPageController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255|unique:ghostpages',
            'description' => 'required|string|max:2000',
        ]);
    }

    public function index() {
        $pages = GhostPage::all();

        return view('admin/ghostPages/allGhostPages', ['pages' => $pages]);
    }

    public function creation() {
        return view('admin/ghostPages/createGhostPage');
    }

    public function create(Request $request) {

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



    public function delete($id) {
        $title = GhostPage::find($id)->pluck('title')->first();

        GhostPage::destroy($id);

        return redirect('backoffice/pages')->with('successDelete', 'Page '.$title.' supprimée avec succès');
    }
}
