<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Group;


class GroupController
{
    private Group $model;

    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Models/Group.php';
        $this->model = new Group();
    }

    /**
     * Listing of the resource.
     *
     */
    public function index(): array|false
    {
        return ($this->model->getAllGroups()) ? $this->model->getAllGroups() : false;
    }

    /**
     * Edit the specified resource in storage.
     *
     */
    public function edit(int $id): array|false
    {
        return ($this->model->getGroup($id)) ? $this->model->getGroup($id) : false;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(string $name): void
    {
        session_start();

        $this->checkStatusAction($this->model->setGroup($name), 'Added', $this->model->getModelName());

    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(int $id, string $name): void
    {
        session_start();

        $this->checkStatusAction($this->model->updateGroup($id, $name), 'Updated', $this->model->getModelName());
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(int $id): void
    {
        session_start();

        $this->checkStatusAction($this->model->deleteGroup($id), 'Deleted', $this->model->getModelName());

    }

    /**
     * Helper function.
     *
     */
    public function checkStatusAction(mixed $action, string $actionName, string $sabjectName): void
    {
        if ($action) {
            $_SESSION['message'] = "$sabjectName $actionName Successfully";
            $_SESSION['is_successful'] = 'yes';
            header("Location: /views/group/index.php/");
        } else {
            $_SESSION['message'] = "$sabjectName Not $actionName. Error: ";
            header("Location: /views/group/index.php/");
        }
    }


}