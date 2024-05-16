<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RadiologistDataTable;
use App\Http\Requests\Admin\CreateRadiologistRequest;
use App\Http\Requests\Admin\UpdateRadiologistRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\RadiologistRepository;
use Illuminate\Http\Request;
use Flash;

class RadiologistController extends AppBaseController
{
    /** @var RadiologistRepository $radiologistRepository*/
    private $radiologistRepository;

    public function __construct(RadiologistRepository $radiologistRepo)
    {
        $this->radiologistRepository = $radiologistRepo;
    }

    /**
     * Display a listing of the Radiologist.
     */
    public function index(RadiologistDataTable $radiologistDataTable)
    {
    return $radiologistDataTable->render('Admin.radiologists.index');
    }


    /**
     * Show the form for creating a new Radiologist.
     */
    public function create()
    {
        return view('admin.radiologists.create');
    }

    /**
     * Store a newly created Radiologist in storage.
     */
    public function store(CreateRadiologistRequest $request)
    {
        $input = $request->all();

        $radiologist = $this->radiologistRepository->create($input);

        Flash::success('Radiologist saved successfully.');

        return redirect(route('admin.radiologists.index'));
    }

    /**
     * Display the specified Radiologist.
     */
    public function show($id)
    {
        $radiologist = $this->radiologistRepository->find($id);

        if (empty($radiologist)) {
            Flash::error('Radiologist not found');

            return redirect(route('admin.radiologists.index'));
        }

        return view('admin.radiologists.show')->with('radiologist', $radiologist);
    }

    /**
     * Show the form for editing the specified Radiologist.
     */
    public function edit($id)
    {
        $radiologist = $this->radiologistRepository->find($id);

        if (empty($radiologist)) {
            Flash::error('Radiologist not found');

            return redirect(route('admin.radiologists.index'));
        }

        return view('admin.radiologists.edit')->with('radiologist', $radiologist);
    }

    /**
     * Update the specified Radiologist in storage.
     */
    public function update($id, UpdateRadiologistRequest $request)
    {
        $radiologist = $this->radiologistRepository->find($id);

        if (empty($radiologist)) {
            Flash::error('Radiologist not found');

            return redirect(route('admin.radiologists.index'));
        }

        $radiologist = $this->radiologistRepository->update($request->all(), $id);

        Flash::success('Radiologist updated successfully.');

        return redirect(route('admin.radiologists.index'));
    }

    /**
     * Remove the specified Radiologist from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $radiologist = $this->radiologistRepository->find($id);

        if (empty($radiologist)) {
            Flash::error('Radiologist not found');

            return redirect(route('admin.radiologists.index'));
        }

        $this->radiologistRepository->delete($id);

        Flash::success('Radiologist deleted successfully.');

        return redirect(route('admin.radiologists.index'));
    }
}
