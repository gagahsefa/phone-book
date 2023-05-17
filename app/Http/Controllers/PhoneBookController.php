<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneBook;
use Illuminate\Support\Facades\Storage;

class PhoneBookController extends Controller
{
    // set index page view
	public function index() {
		return view('index');
	}

	// handle fetch all eamployees ajax request
	public function fetchAll() {
		$emps = PhoneBook::all();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->first_name . ' ' . $emp->last_name . '</td>
                <td>' . $emp->phone . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editContactModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}

	// handle insert a new phoneBook ajax request
	public function store(Request $request) {

		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'phone' => $request->phone];
		PhoneBook::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle edit an phoneBook ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$emp = PhoneBook::find($id);
		return response()->json($emp);
	}

	// handle update an phoneBook ajax request
	public function update(Request $request) {

        $emp = PhoneBook::find($request->emp_id);

		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'phone' => $request->phone];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle delete an PhoneBook ajax request
	public function delete(Request $request) {
		$id = $request->id;
		$emp = PhoneBook::find($id);
		// if (Storage::delete('public/images/' . $emp->avatar)) {
		// 	PhoneBook::destroy($id);
		// }
        PhoneBook::destroy($id);
	}
}
