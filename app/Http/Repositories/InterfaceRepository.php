<?php

namespace App\Repositories;


interface InterfaceRepository {
    public function index();
    public function store($id, array $attributes);
    public function update($id, array $attributes);
    public function destroy($id);
}
