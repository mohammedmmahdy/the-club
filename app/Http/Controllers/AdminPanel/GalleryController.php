<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\Gallery;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class GalleryController extends AppBaseController
{
    public function index()
    {
        $gallery = Gallery::latest()->get();

        return view('adminPanel.gallery.index', compact('gallery'));
    }

    public function create()
    {
        return view('adminPanel.gallery.create');
    }

    public function store()
    {

        foreach (request('photos') as $photo) {
            Gallery::create([
                'photo' => $photo
            ]);
        }

        Flash::success(__('messages.saved', ['model' => __('models/academies.singular')]));

        return redirect(route('adminPanel.gallery.index'));
    }

    public function destroy(Gallery $gallery)
    {

        $gallery->delete();

        Flash::success(__('messages.deleted', ['model' => __('models/information.singular')]));

        return redirect(route('adminPanel.gallery.index'));
    }
}
