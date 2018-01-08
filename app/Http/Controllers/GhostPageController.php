<?php

namespace App\Http\Controllers;

use App\GhostPage;
use App\Http\ImageHandler;
use App\Http\Misc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

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
            'sound' => 'mimes:mpga'
        ]);

        $locationPicture = null;
        $locationSound = null;
        $videoPath = null;

        if (Input::file('picture') != null)
            $locationPicture = Misc::uploadOnDisk('picture', 'images', true);
        if (Input::file('sound') != null)
            $locationSound = Misc::uploadOnDisk('sound', 'sounds', false);

        if ($request->input('video') != "")
            $videoPath = $this->YoutubeID($request->input('video'));

        GhostPage::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'picture' => $locationPicture,
            'sound' => $locationSound,
            'video' => $videoPath
        ])->push();

        return redirect('backoffice/pages')->with('successPage', 'Page créée avec succès !');
    }

    public function edition($id) {
        $page = GhostPage::find($id);
        if ($page->sound != null)
            $page->sound = base64_encode(Storage::disk('sounds')->get($page->sound));
        if ($page->picture != null)
            $page->picture = base64_encode(Storage::disk('images')->get($page->picture));

        return view('admin/ghostPages/editGhostPage', ['page' => $page]);
    }

    public function update(Request $request) {
        $page = GhostPage::find($request->input('id'));

        $request->validate([
            'title' => 'required|string|max:255|unique:ghost_pages,title,'.$page->id,
            'description' => 'required|string|max:2000',
            'sound' => 'mimes:mpga'
        ]);

        $locationPicture = $page->picture;
        $locationSound = $page->sound;
        $videoPath = $page->video;


        if (Input::file('picture') != null) {
            $item = $_FILES['picture'];
            $imageHandler = new ImageHandler();
            if ($page->picture != null)
                $locationPicture = $imageHandler->updateImageOnDisk($item, $page->picture);
            else
                $locationPicture = $imageHandler->uploadImageOnDisk($item);
        }

        if (Input::file('sound') != null) {
            $item = Input::file('sound');
            $locationSound = uniqid() . $item->getClientOriginalName();
            if ($page->sound != null)
                Storage::disk('sounds')->delete($page->sound);
            Storage::disk('sounds')->put($locationSound, file_get_contents($item->getRealPath()));
        }

        if ($request->input('video') != "")
            $videoPath = $this->YoutubeID($request->input('video'));

        $page->update([
           'title' => $request->input('title'),
           'description' => $request->input('description'),
            'picture' => $locationPicture,
            'sound' => $locationSound,
            'video' => $videoPath,
        ]);

        return redirect('backoffice/pages')->with('successPage', 'Page éditée avec succès !');
    }

    public function visualize($id) {
        $page = GhostPage::find($id);;
        if ($page->sound != null)
            $page->sound = base64_encode(Storage::disk('sounds')->get($page->sound));
        if ($page->picture != null)
            $page->picture = base64_encode(Storage::disk('images')->get($page->picture));

        return view('admin/ghostPages/visualizeGhostPage', ['page' => $page]);
    }

    public function delete($id)
    {
        $ghostpage = GhostPage::find($id);

        GhostPage::destroy($id);

        return redirect('backoffice/pages')->with('successDelete', 'Page '.$ghostpage->title.' supprimée avec succès');
    }

    function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return null;
        }

        return $url;
    }
}
