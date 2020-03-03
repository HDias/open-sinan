<?php

namespace App\Http\Controllers\Admin;

use ACL\Http\Requests\CreateCidRequest;
use ACL\Http\Requests\UpdateCidRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CidController extends Controller
{
    public function index(Request $request)
    {
         try {
            $search = $request->input('search', '');

            $resources = app('app.model.cid')->all();

            return view('admin.cid.index', compact('resources'));
         } catch (\Exception $exception) {
             flash('danger', trans('flash.save.error'), $exception->getMessage());

             return redirect()->route('dashboard.index');
         }
    }

    public function create()
    {
        try {
            $roles = app('app.model.cid')->allRoleWithoutDeveloper()->get();

            return view('admin.cid.create', compact('roles'));
        } catch (\Exception $exception) {
            flash('danger', trans('flash.save.error'), $exception->getMessage());

            return redirect()->route('cid.index');
        }
    }

    public function store(CreateCidRequest $request)
    {
        try {
            \DB::beginTransaction();

            $resource = app('app.model.cid')->fill($request->except('roles'));
            $resource->save();

            \DB::commit();

            flash('success', trans('flash.save_success'));

            return redirect()->route('cid.index');
        } catch (\Exception $e) {
            \DB::rollBack();

            flash('danger', trans('flash.save_error'), $e->getMessage());

            return \Redirect::route('cid.create')
                ->withErrors($request->validate())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $user = app('app.model.cid')->findWithPersonById($id)->first();

            $selectedRoles = app('acl.model.role')->findToSelect($user->id)->get();

            $roles = app('app.model.cid')->allRoleWithoutDeveloper();

            return view('admin.cid.edit', compact('user', 'roles', 'selectedRoles'));
        } catch (\Exception $exception) {
            flash('danger', trans('flash.edit_error'), $exception->getMessage());

            return redirect()->route('cid.index');
        }
    }

    public function update(UpdateCidRequest $request, $id)
    {
        try {
            \DB::beginTransaction();

            $user = app('app.model.cid')->findWithPersonById($id)->first();
            $user->update($request->except('roles'));

            $person = Person::where('user_id', '=', $user->id)->first();
            $person->update($request->only(['sexo', 'dt_birth', 'cpf']));

            // Se não vier Role alguma deve passar um array vazio para syncRoles()
            $roles = explode(',', $request->roles);
            if (is_null($request->roles)) {
                $roles = [];
            }

            $user->syncRoles($roles);

            \DB::commit();

            flash('success', trans('flash.update_success'));

            return redirect()->route('cid.index');
        } catch (\Exception $e) {
            \DB::rollBack();
            flash('danger', trans('flash.save_error'), $e->getMessage());

            return \Redirect::route('cid.index')
                ->withErrors($request->validate())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            User::findOrfail($id)->delete();

            return response()->json([
                'success' => true,
                'route' => route('cid.index')
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'route' => route('cid.index'),
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function restore($id)
    {
        try {
            Cid::withTrashed()->where('id', $id)->restore();
            flash('success', trans('flash.restore_sucess'));

            return redirect()->route('cid.index');
        } catch (\Exception $e) {
            flash('danger', trans('flash.restore_error'), $e->getMessage());

            return \Redirect::route('cid.index');
        }
    }
}
