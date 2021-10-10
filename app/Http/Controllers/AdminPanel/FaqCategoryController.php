<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateFaqCategoryRequest;
use App\Http\Requests\AdminPanel\UpdateFaqCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Flash;
use Response;

class FaqCategoryController extends AppBaseController
{

    /**
     * Display a listing of the FaqCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $faqCategories = FaqCategory::get();

        return view('adminPanel.faq_categories.index')
            ->with('faqCategories', $faqCategories);
    }

    /**
     * Show the form for creating a new FaqCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.faq_categories.create');
    }

    /**
     * Store a newly created FaqCategory in storage.
     *
     * @param CreateFaqCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateFaqCategoryRequest $request)
    {
        $input = $request->all();

        $faqCategory = FaqCategory::create($input);

        Flash::success('Faq Category saved successfully.');

        return redirect(route('adminPanel.faqCategories.index'));
    }

    /**
     * Display the specified FaqCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faqCategory = FaqCategory::find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('adminPanel.faqCategories.index'));
        }

        return view('adminPanel.faq_categories.show')->with('faqCategory', $faqCategory);
    }

    /**
     * Show the form for editing the specified FaqCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faqCategory = FaqCategory::find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('adminPanel.faqCategories.index'));
        }

        return view('adminPanel.faq_categories.edit')->with('faqCategory', $faqCategory);
    }

    /**
     * Update the specified FaqCategory in storage.
     *
     * @param int $id
     * @param UpdateFaqCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqCategoryRequest $request)
    {
        $faqCategory = FaqCategory::find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('adminPanel.faqCategories.index'));
        }

        $faqCategory->update($request->all());

        Flash::success('Faq Category updated successfully.');

        return redirect(route('adminPanel.faqCategories.index'));
    }

    /**
     * Remove the specified FaqCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faqCategory = FaqCategory::find($id);

        if (empty($faqCategory)) {
            Flash::error('Faq Category not found');

            return redirect(route('adminPanel.faqCategories.index'));
        }

        $faqCategory->delete($id);

        Flash::success('Faq Category deleted successfully.');

        return redirect(route('adminPanel.faqCategories.index'));
    }
}
