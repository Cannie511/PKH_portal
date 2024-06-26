<?php

namespace App\Http\Controllers\Admin;

//use Auth;
use Input;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends AdminBaseController
{
    /**
     * Get all users.
     *
     * @return JSON
     */
    public function getIndex()
    {
        $suppliers = Supplier::all();

        return response()->success(compact('suppliers'));
    }

    /**
     * @param $id
     */
    public function getShow($id)
    {
        $entity           = Supplier::find($id);
        $result           = [];
        $result["entity"] = $entity;

        return response()->success($result);
    }

    public function postIndex()
    {
        $result = [];

        $entity = Supplier::create([
            'name'          => Input::get('name'),
            'supplier_code' => Input::get('supplier_code'),
        ]);

        $result["item"] = $entity;

        return response()->success($result);
    }

    /**
     * Delete User Data.
     *
     * @return JSON success message
     */
    public function deleteItem($id)
    {
        $entity = MstSupplier::find($id);

        if ($entity) {
            $entity->delete();
        }

        return response()->success('success');
    }

    /**
     * @param Request $request
     */
    public function putShow(Request $request)
    {

        $form = array_dot(
            app('request')->only(
                'data.entity.name',
                'data.entity.short_name',
                'data.entity.id'
            )
        );

        $id = intval($form['data.entity.id']);

        $entity = Supplier::find($id);

        $this->validate($request, [
            'data.entity.id'         => 'required|integer',
            'data.entity.short_name' => 'required|min:3|unique:mst_supplier,short_name,' . $id,
        ],
            [],
            [
                'data.entity.short_name' => 'Short Name',
            ]
        );

        $data = [
            'name'       => $form['data.entity.name'],
            'short_name' => $form['data.entity.short_name'],
        ];

        $affectedRows = Supplier::where('id', '=', $id)->update($data);

        return response()->success('success');
    }

}
