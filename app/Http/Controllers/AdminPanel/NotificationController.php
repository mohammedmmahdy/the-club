<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateNotificationRequest;
use App\Http\Requests\AdminPanel\UpdateNotificationRequest;
use App\Repositories\AdminPanel\NotificationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Events\NotificationPusher;
class NotificationController extends AppBaseController
{
    /** @var  NotificationRepository */
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepo)
    {
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the Notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $notifications = $this->notificationRepository->paginate(10);

        return view('adminPanel.notifications.index')
            ->with('notifications', $notifications);
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.notifications.create');
    }

    /**
     * Store a newly created Notification in storage.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $input = $request->all();

        $notification = $this->notificationRepository->create($input);

        event(new NotificationPusher(['send_to' => $notification->type, 'data' => $notification, 'type'=>'Notification']));

        Flash::success(__('messages.saved', ['model' => __('models/notifications.singular')]));

        return redirect(route('adminPanel.notifications.index'));
    }

    /**
     * Display the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));

            return redirect(route('adminPanel.notifications.index'));
        }

        return view('adminPanel.notifications.show')->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));

            return redirect(route('adminPanel.notifications.index'));
        }

        return view('adminPanel.notifications.edit')->with('notification', $notification);
    }

    /**
     * Update the specified Notification in storage.
     *
     * @param int $id
     * @param UpdateNotificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationRequest $request)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));

            return redirect(route('adminPanel.notifications.index'));
        }

        $notification = $this->notificationRepository->update($request->all(), $id);
        event(new NotificationPusher(['send_to' => $notification->type, 'data' => $notification, 'type'=>'Notification']));
        Flash::success(__('messages.updated', ['model' => __('models/notifications.singular')]));

        return redirect(route('adminPanel.notifications.index'));
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = $this->notificationRepository->find($id);

        if (empty($notification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/notifications.singular')]));

            return redirect(route('adminPanel.notifications.index'));
        }

        $this->notificationRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/notifications.singular')]));

        return redirect(route('adminPanel.notifications.index'));
    }
}
