<?php 

namespace App\Repositories\Interfaces;


Interface ProductImagesInterface {

    public function getAll();
    public function create_product();
    public function store($request);
    public function edit($id); 
    public function update($request, $id);
    public function destroy($id);
    public function search();
}