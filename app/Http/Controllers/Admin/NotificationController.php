<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\NotificationInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private NotificationInterface $notificationInterface;

    public function __construct(NotificationInterface $notificationInterface)
    {
        $this->notificationInterface = $notificationInterface;
    }

    public function index(Request $request)
    {
        return $this->notificationInterface->index($request);
    }

    public function showCreate()
    {
        return $this->notificationInterface->showCreate();
    }

    public function store(Request $request)
    {
        return $this->notificationInterface->store($request);
    }

    public function getUsers(Request $request)
    {
        return $this->notificationInterface->getUsers($request);
    }

    public function delete(Request $request)
    {
        return $this->notificationInterface->delete($request);
    }
}
