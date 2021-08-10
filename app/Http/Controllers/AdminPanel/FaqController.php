<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class FaqController extends AppBaseController
{

    /**
     * Display a listing of the Faq.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $faqs = Faq::get();

        return view('adminPanel.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Response
     */
    public function create()
    {
        $faqCategories = FaqCategory::get()->pluck('name', 'id');

        return view('adminPanel.faqs.create', compact('faqCategories'));
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate(Faq::rules());
        $faq = Faq::create($input);

        Flash::success('Faq saved successfully.');

        return redirect(route('adminPanel.faqs.index'));
    }

    /**
     * Display the specified Faq.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faq = Faq::find($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('adminPanel.faqs.index'));
        }

        return view('adminPanel.faqs.show')->with('faq', $faq);
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faq = Faq::find($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('adminPanel.faqs.index'));
        }
        $faqCategories = FaqCategory::get()->pluck('name', 'id');


        return view('adminPanel.faqs.edit', compact('faqCategories', 'faq'));
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $faq = Faq::find($id);
        $request->validate(Faq::rules());
        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('adminPanel.faqs.index'));
        }

        $faq->update($request->all());

        Flash::success('Faq updated successfully.');

        return redirect(route('adminPanel.faqs.index'));
    }

    /**
     * Remove the specified Faq from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('adminPanel.faqs.index'));
        }

        $faq->delete($id);

        Flash::success('Faq deleted successfully.');

        return redirect(route('adminPanel.faqs.index'));
    }
}
