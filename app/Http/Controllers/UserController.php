<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = $this->user->get_all_user();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {

            if ($request->ajax()) {

                if ($request->validator->fails()) {
                    return response()->json([
                        'code' => 400,
                        'data' => null,
                        'errors' => $request->validator->errors(),
                        'message' => 'Yêu cầu xử lý thất bại'
                    ], 200);
                }


                $user = $this->user->create_user([
                    'fullname' => $request->input('fullname'),
                    'email' => $request->input('email'),
                    'avatar' => $request->input('avatar'),
                    'role_id' => $request->input('role_id'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);

                return response()->json([
                    'code' => 200,
                    'data' => $user,
                    'errors' => null,
                    'message' => 'Yêu cầu xử lý thành công'
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'code' => $ex->getCode(),
                'data' => null,
                'errors' => $ex->getMessage(),
                'message' => 'Yêu cầu xử lý thất bại'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->user->get_single_user($id);
            if (empty($id)) {
                throw new Exception('Request không hợp lệ');
            }

            if (empty($user)) {
                throw new Exception('User không tồn tại');
            }

            return response()->json([
                'code' => 200,
                'data' => $user,
                'errors' => null,
                'message' => 'Yêu cầu xử lý thành công'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'code' => $ex->getCode(),
                'data' => null,
                'errors' => $ex->getMessage(),
                'message' => 'Yêu cầu xử lý thất bại'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            if ($request->ajax() && isset($request->validator)) {
                if ($request->validator->fails()) {
                    return response()->json([
                        'code' => 400,
                        'data' => null,
                        'errors' => $request->validator->errors(),
                        'message' => 'Yêu cầu xử lý thất bại'
                    ]);
                }

                $data = $this->user->update_user([
                    'fullname' => $request->input('fullname'),
                    'email' => $request->input('email'),
                    'avatar' => $request->input('avatar'),
                    'role_id' => $request->input('role_id'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ], $id);

                return response()->json([
                    'code' => 200,
                    'data' => $data,
                    'errors' => $request->validator->errors(),
                    'message' => 'Yêu cầu xử lý thành công'
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'code' => $ex->getCode(),
                'data' => null,
                'errors' => $ex->getMessage(),
                'message' => 'Yêu cầu xử lý thất bại'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (empty($id)) {
                throw new Exception('Request không hợp lệ');
            }

            $data = $this->user->delete_user($id);
            return response()->json([
                'code' => 200,
                'data' => $data,
                'errors' => null,
                'message' => 'Yêu cầu xử lý thành công'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'code' => $ex->getCode(),
                'data' => null,
                'errors' => $ex->getMessage(),
                'message' => 'Yêu cầu xử lý thất bại'
            ]);
        }
    }
}
