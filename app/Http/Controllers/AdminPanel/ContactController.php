<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateContactRequest;
use App\Http\Requests\AdminPanel\UpdateContactRequest;
use App\Repositories\AdminPanel\ContactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ContactController extends AppBaseController
{
    /** @var  ContactRepository */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
    }

    /**
     * Display a listing of the Contact.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contacts = $this->contactRepository->paginate(10);

        return view('adminPanel.contacts.index')
            ->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.contacts.create');
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param CreateContactRequest $request
     *
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $input = $request->all();

        $contact = $this->contactRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/contacts.singular')]));

        return redirect(route('adminPanel.contacts.index'));
    }

    /**
     * Display the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));

            return redirect(route('adminPanel.contacts.index'));
        }

        return view('adminPanel.contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));

            return redirect(route('adminPanel.contacts.index'));
        }

        return view('adminPanel.contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param int $id
     * @param UpdateContactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactRequest $request)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));

            return redirect(route('adminPanel.contacts.index'));
        }

        $contact = $this->contactRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/contacts.singular')]));

        return redirect(route('adminPanel.contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));

            return redirect(route('adminPanel.contacts.index'));
        }

        $this->contactRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/contacts.singular')]));

        return redirect(route('adminPanel.contacts.index'));
    }
}
