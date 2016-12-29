<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\DepartmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EmployeeController extends AppBaseController
{
    /** @var  EmployeeRepository */
    private $employeeRepository;
    private $departmentRepository;

    public function __construct(EmployeeRepository $employeeRepo, DepartmentRepository $departmentRepo)
    {
        $this->employeeRepository = $employeeRepo;
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * Display a listing of the Employee.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $department = [null =>'Department'];
        $employees = $this->employeeRepository->all();
        $departments = $this->departmentRepository->all()->pluck('name','id');
        foreach ($departments as $id => $name) {
            $department[$id] = $name;
        }

        if ($request->has('name') || $request->has('department_id')) {
            $searchData = [['name', 'like', '%'.$request->input('name').'%']];
            if ($request->has('department_id')) {
                $searchData['department_id'] = intval($request->input('department_id'));
            }
            $employees = $this->employeeRepository->findWhere($searchData);
        } else {
            $employees = $this->employeeRepository->all();
        }

        return view('employees.index')->with('employees', $employees)->with('department', $department);
    }

    /**
     * Show the form for creating a new Employee.
     *
     * @return Response
     */
    public function create()
    {   
        $departments = $this->departmentRepository->all()->pluck('name','id');
        foreach ($departments as $id => $name) {
            $list[$id] = $name;
        }
        return view('employees.create')->with('list',$list);
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param CreateEmployeeRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('photo')) {
            $input['photo'] = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('images/employees'), $input['photo']);
        } else {
            $input['photo'] = time().'.png';
            \File::copy(public_path('images').'/icon-profile.png', public_path('images/employees').'/'.$input['photo']);
        }
        $employee = $this->employeeRepository->create($input);
        Flash::success('Employee saved successfully.');
        return redirect(route('employees.index'));
    }

    /**
     * Display the specified Employee.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified Employee.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);
        $departments = $this->departmentRepository->all()->pluck('name','id');
        foreach ($departments as $id => $name) {
            $list[$id] = $name;
        }
        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        return view('employees.edit')->with('employee', $employee)->with('list',$list);
    }

    /**
     * Update the specified Employee in storage.
     *
     * @param  int              $id
     * @param UpdateEmployeeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);
        if ($request->hasFile('photo')) {
            $request->photo->move(public_path('images/employees'), $employee->photo);
        }
        if (empty($employee)) {
            Flash::error('Employee not found');
            return redirect(route('employees.index'));
        }
        $employee = $this->employeeRepository->update($request->except(['photo']), $id);
        Flash::success('Employee updated successfully.');
        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('employees.index'));
        }

        $this->employeeRepository->delete($id);

        Flash::success('Employee deleted successfully.');

        return redirect(route('employees.index'));
    }
}
